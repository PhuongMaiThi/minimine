<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerifyCode;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderVerify;
use App\Models\Price;
use App\Utils\CommonUtil;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addCart($id, Request $request)
    {
        //get data from SESSION
        $sessionAll = Session::all();
        $carts = empty($sessionAll['carts']) ? [] : $sessionAll['carts'];

        if(!empty($carts[$id])){
            $carts[$id]['quantity'] += $request->quantity;
            session(['carts' => $carts]);
        }
        // validate ID of table product ? available TRUE | FALSE
        // check quantity of products.quantity compare with order_detail.quantity
        $product = Product::findOrFail($id);


        #check have param $id ?
        $newProduct = [
            'id'         => $id,
            'name'       => $product->name,
            'quantity'   => $request->quantity, // price này đúng ko dạ vì ko truyền đúng giá trị hén ko vao//hồi nãy e có suwarw lại giá trị pirce nhưng vẫn k ra đó
            'price'      => $product->price,// cais price ở đây k còn là price-id nữa a, vì e thêm field price vào luôn trong product
            'thumbnail'      => $product->thumbnail, //
        ];
        $carts[$id] = $newProduct;

        // set data for SESSION
        session(['carts' => $carts]);
// dd($newProduct);
        return redirect()->route('cart.cart-info')
            ->with('success', 'Add Product to Cart successful!');
    }

    public function getCartInfo(Request $request)
    {
        $data = [];
        $sessionAll = Session::all();

        $carts = empty($sessionAll['carts']) ? [] : $sessionAll['carts'];
       
        //get cart info from SESSION
        // $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        $data['carts'] = $carts;

        // $dataCart = [];
        // if (!empty($carts)) {
        //     // create list product id
        //     $listProductId = [];
        //     foreach ($carts as $cart) {
        //         $listProductId[] = $cart['id'];
        //     }

        //     // get data product from list product id
        //     $dataCart = Product::whereIn('id', $listProductId)
        //         ->get();
        session(['step_by_step' => 1]);

        //     // add step by step to SESSION
        // }
        $data['products'] = $carts;

        return view('carts.cart-info', $data);
    }

    

    public function checkout(Request $request)
    {
        $data = [];

        //get cart info from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        $data['carts'] = $carts;

        return view('carts.checkout', $data);
    }

    public function checkoutComplete(Request $request)
    {
        // get cart info
        $carts = Session::all();
        $carts = Session::get('carts');
        // dd($carts);
        
        // validate quanity of product -> Available (in-stock | out-stock)


        // create data to save into table orders
        $dataOrder = [
            'user_id' => Auth()->id(),
            'status' => Order::STATUS[0],
        ];
        // dd($dataOrder);
        DB::beginTransaction();
        
        try {

            // save data into table orders
            $order = Order::create($dataOrder);

            $orderId = $order->id;
            
            if (!empty($carts)) {
                foreach ($carts as $cart) {

                    $productId  =   $cart['id'];

                    $quantity   =   $cart['quantity'];

                    $price      =   $cart['price']; 
                    
                    $orderDetail = [
                        'product_id' => $productId,
                        'order_id' => $orderId,
                        'quantity' => $quantity,
                        'price' => $price,
                    ];
                    // dd($orderDetail);
                    // save data into table order_details
                    OrderDetail::create($orderDetail);
                }        
            }          
                DB::commit();
            // remove session carts, step_by_step
            $request->session()->forget(['carts', 'step_by_step']);
            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
            // dd(123);
            } catch (Exception $exception) {
                // echo  $exception->getMessage();
                // DB::rollBack();
            // dd(123);
                return redirect()->back()->with('error', $exception->getMessage());
            }
    }

    public function sendVerifyCode(Request $request)
    {
        // send code to verify Order
        // check exist send code ?
        $userId = Auth::id();
        $email = Auth::user()->email;
        $currentDate = date('Y-m-d H:i:s');
        $dateSubtract15Minutes = date('Y-m-d H:i:s', (time() - 60 * 15)); // current - 15 minutes
        Log::info('dateSubtract15Minutes');
        Log::info($dateSubtract15Minutes);
        $orderVerify = OrderVerify::where('user_id', $userId)
            ->whereBetween('expire_date', [$dateSubtract15Minutes, $currentDate])
            ->where('status', OrderVerify::STATUS[0])
            ->first();

        if (!empty($orderVerify)) { // already sent code and this code is available
            return response()->json(['message' => 'Mã code đã được gửi. Hãy kiểm tra ở hộp thư gmail của bạn!']);
        } else { // not send code
            $dataSave = [
                'user_id' => $userId,
                'status'  => OrderVerify::STATUS[0], // default 0
                'code'  => CommonUtil::generateUUID(),
                'expire_date'  => $currentDate,
            ];
            DB::beginTransaction();

            try {
                OrderVerify::create($dataSave);

                // commit insert data into table
                DB::commit();

                // send code to email
                Mail::to($email)->send(new SendVerifyCode($dataSave));

                Log::info('sent mail OK');
                return response()->json(['message' => 'Chúng tôi đã gửi Code vào email. Hãy kiểm tra email để lấy code!']);
            } catch (\Exception $exception) {
                // rollback data and dont insert into table
                DB::rollBack();
                Log::error('sent mail FAIL');

                return response()->json(['message' => $exception->getMessage()]);
            }
        }
    }

    public function confirmVerifyCode(Request $request)
    {
        $code = $request->code;
        $userId = Auth::id();

        $orderVerify = OrderVerify::where('code', $code)
            ->where('user_id', $userId)
            ->where('status', OrderVerify::STATUS[0])
            ->first();
        //  validate code

        DB::beginTransaction();

        try {
            $orderVerify->status = OrderVerify::STATUS[1];
            $orderVerify->save();

            DB::commit();

            // add step by step to SESSION
            session(['step_by_step' => 2]);

            return response()->json(['message' => 'Confirmed code is OK.']);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $sessionAll = Session::all();

        $carts = empty($sessionAll['carts']) ? [] : $sessionAll['carts'];
        if (!empty($carts[$id])) {

            unset($carts[$id]);
            
            session()->put('carts', $carts);
            
            return redirect()->back()->with(['message' => 'success']);
        }
        
        return redirect()->back()->with(['message' => 'failed']);
    }
}
