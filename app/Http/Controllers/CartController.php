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
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');

        // validate ID of table product ? available TRUE | FALSE
        // check quantity of products.quantity compare with order_detail.quantity
        $product = Product::findOrFail($id);


        #check have param $id ?
        $newProduct = [
            'id' => $id,
            'quantity' => $request->quantity,
            'price_id' => $request->price_id,
        ];
        $carts[$id] = $newProduct;

        // set data for SESSION
        session(['carts' => $carts]);

        return redirect()->route('cart.cart-info')
            ->with('success', 'Add Product to Cart successful!');
    }

    public function getCartInfo(Request $request)
    {
        $data = [];

        //get cart info from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        $data['carts'] = $carts;

        $dataCart = [];
        if (!empty($carts)) {
            // create list product id
            $listProductId = [];
            foreach ($carts as $cart) {
                $listProductId[] = $cart['id'];
            }

            // get data product from list product id
            $dataCart = Product::whereIn('id', $listProductId)
                ->get();

            // add step by step to SESSION
            session(['step_by_step' => 1]);
        }
        $data['products'] = $dataCart;

        return view('carts.card_info', $data);
    }

    

    public function checkout(Request $request)
    {
        $data = [];

        //get cart info from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        $data['carts'] = $carts;

        if (!empty($carts)) {
            $dataCart = [];

            // create list product id
            $listProductId = [];
            foreach ($carts as $cart) {
                $listProductId[] = $cart['id'];
            }

            // get data product from list product id
            $dataCart = Product::whereIn('id', $listProductId)
                ->get();
            $data['products'] = $dataCart;

            // add step by step to SESSION
            session(['step_by_step' => 2]);
        }

        return view('carts.checkout', $data);
    }

    public function checkoutComplete(Request $request)
    {
        // get cart info
        $carts = Session::get('carts');
        
        // validate quanity of product -> Available (in-stock | out-stock)


        // create data to save into table orders
        $dataOrder = [
            'user_id' => Auth()->id(),
            'status' => Order::STATUS[0],
        ];

        DB::beginTransaction();

        try {
            // save data into table orders
            $order = Order::create($dataOrder);
            $orderId = $order->id;

            if (!empty($carts)) {
                foreach ($carts as $cart) {
                    $productId = $cart['id'];
                    $quantity = $cart['quantity'];
                    $priceId = $cart['price_id'];

                    $orderDetail = [
                        'product_id' => $productId,
                        'order_id' => $orderId,
                        'price_id' => $priceId,
                        'quantity' => $quantity,
                    ];
                    // save data into table order_details
                    OrderDetail::create($orderDetail);
                }
            }
            
            DB::commit();

            // remove session carts, step_by_step
            $request->session()->forget(['carts', 'step_by_step']);

            return redirect()->route('home')->with('success', 'Your Order was successful!');
        } catch (Exception $exception) {
            DB::rollBack();

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
            return response()->json(['message' => 'We sent code to your email about 15 minutes ago. Please check email to get code.']);
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

                return response()->json(['message' => 'We sent code to email. Please check email to get code.']);
            } catch (\Exception $exception) {
                // rollback data and dont insert into table
                DB::rollBack();

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
}
