<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Requests\promotion\StorePromotionRequest;
use Illuminate\Http\Requests\promotion\UpdatePromotionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Method: GET
        $data = [];
        $promo = Promotion::get();
        // dd($categories);
        $data['promo'] = $promo;
        return view('admin.promotion.index', $data);
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
        // dd(12345);
        return view('admin.promotion.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        // Method: POST
        // dd($request->all());


        // insert to DB
        $proInsert = [
            'name' => $request->category_name
        ];

        DB::beginTransaction();

        try {
            Promotion::create($proInsert);

            // insert into data to table promotion (successful)
            DB::commit();

            return redirect()->route('admin.promotion.index')->with('sucess', 'Insert into data to Promotion Sucessful.');
        } catch (\Exception $ex) {
            // insert into data to table category (fail)
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Method: GET
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Method: GET
        $data = [];
        $promo = Promotion::findOrFail($id);
        $data['promo'] = $promo;

        return view('admin.promotion.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, $id)
    {
        // Method: PUT
        // dd($request->all());

        DB::beginTransaction();

        try {
            // create $category
            $promo = Promotion::find($id);
            // set value for field name
            $promo->name = $request->category_name;
            $promo->save();

            DB::commit();

            return redirect()->route('admin.promo.index')
                ->with('success', 'Update Promotion successful!');
        } catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Method: DELETE
        DB::beginTransaction();

        try {
            $promo = Promotion::find($id);
            $promo->delete();

            DB::commit();

            return redirect()->route('admin.promotion.index')
                ->with('success', 'Delete Promotion successful!');
        }  catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
