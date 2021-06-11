<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductAjaxController extends Controller
{
    public function checkQuantity($id, Request $request)
    {
        // get quantity from Form Request
        $quantity = $request->quantity;

        // get product fron Database
        $product = Product::findOrFail($id);
        $quantityDB = $product->quantity;

        /**
         * check if Quantity Form Request > Quantity DB
         * 
         * @if true then show error message
         * @else then show success message
         */
        if ($quantity > $quantityDB) {
            return response()->json(['message' => 'Chỉ còn '.$product->quantity .' sản phẩm trong giỏ hàng']);
        }
    }
}