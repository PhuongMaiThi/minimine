<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class homeController extends Controller
{
    //
    public function index(){
        //dd(123);
        $data=[];
        $category = Category::get();
        // foreach ($category->products as $product) {
        //         $product->latestPrice();
        //     }
        //     $category = Category::get();
        //     $arrCategories = $category->toArray();
        //     if (!empty($category)) {
        //         foreach ($category as $key => $category) {
        //             $products = $category->limitProducts();
        //             // dd($products);
        //             $arrCategories[$key]['products'] = $products;
        //         }
        //     }

        $data['category'] = $category;
        return view('welcome', $data);
    }
}