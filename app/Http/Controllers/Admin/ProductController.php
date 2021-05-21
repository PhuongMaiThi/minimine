<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\product\StoreProductRequest;
use App\Http\Requests\Admin\product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Method: GET
        $data = [];
        // dd(1234);
        $products = Product::with('category');
        
        // search product by name
        if (!empty($request->name)) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
        }
        // search product by category_id
        if (!empty($request->category_id)) {
            $products = $products->where('category_id', $request->category_id);
        }
        
        //phan Trang
        $products = $products->paginate(4);
       
        $categories = Category::pluck('name', 'id')
            ->toArray();
        $data['categories'] = $categories;
        // dd(5678);
        $data['products'] = $products;
        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Method: GET
        $data = [];
        $categories = Category::pluck('name', 'id')
            ->toArray();
        // dd($categories);
        $data['categories'] = $categories;
        return view('admin.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // Method: POST
        // dd($request->all());

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail') 
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/thumbnail
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $fileName = 'thumbnail_' . time() . '.' . $extension;
            $thumbnailPath = $image->move('thumbnail', $fileName);
        }

        // insert to DB
        $productInsert = [
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
            'quatity' => $request->quatity,
            'is_feater' => $request->is_feater,
            'category_id' => $request->category_id,
        ];

        DB::beginTransaction();

        try {
            $product = Product::create($productInsert);

            // $productDetail = new ProductDetail([
            //     'content' => $request->content,
            // ]);
            // $product->post_detail()->save($productDetail);
            // insert into data to table category (successful)
            DB::commit();

            return redirect()->route('admin.product.index')->with('sucess', 'Insert into data to Category Sucessful.');
        } catch (\Exception $ex) {
            // insert into data to table category (fail)
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     // Method: GET
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     // Method: GET
    //     $data = [];
    //     $category = Category::findOrFail($id);
    //     $data['category'] = $category;

    //     return view('admin.categories.edit', $data);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(UpdateCategoryRequest $request, $id)
    // {
    //     // Method: PUT
    //     // dd($request->all());

    //     DB::beginTransaction();

    //     try {
    //         // create $category
    //         $category = Category::find($id);
    //         // set value for field name
    //         $category->name = $request->category_name;
    //         $category->save();

    //         DB::commit();

    //         return redirect()->route('admin.category.index')
    //             ->with('success', 'Update Category successful!');
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         // have error so will show error message
    //         return redirect()->back()->with('error', $ex->getMessage());
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     // Method: DELETE
    //     DB::beginTransaction();

    //     try {
    //         $category = Category::find($id);
    //         $category->delete();

    //         DB::commit();

    //         return redirect()->route('admin.category.index')
    //             ->with('success', 'Delete Category successful!');
    //     }  catch (\Exception $ex) {
    //         DB::rollBack();
    //         // have error so will show error message
    //         return redirect()->back()->with('error', $ex->getMessage());
    //     }
    // }
}
