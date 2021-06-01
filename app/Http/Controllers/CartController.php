<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Support\Facades\DB;

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
        return view('carts.card', $data);
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
            // 'product_id' => $carts['id'],
            'user_id' => Auth()->id(),
            'status' => Order::STATUS[0],
        ];
        // dd($dataOrder);
        DB::beginTransaction();
        // dd($dataOrder);
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
            // dd(123);
            echo $exception->getMessage();
            // DB::rollBack();

            // return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        // dd($id);die;
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
