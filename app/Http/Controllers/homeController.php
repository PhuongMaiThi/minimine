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

        $data['category'] = $category;
        $data['hotProducts'] = Product::paginate(8);
        return view('welcome', $data);
    }
}