<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function detail($id, Request $request)
    {
        $data = [];

        $product = Product::findOrFail($id);
        
        $data['product'] = $product;

        // display create sucess
        return view('products.detail', $data);
    }
}
