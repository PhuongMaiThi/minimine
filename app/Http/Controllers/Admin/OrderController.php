<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private const RECORD_LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        // get orders
        $orders = Order::with('orderDetails')
            ->with('user')
            ->paginate(self::RECORD_LIMIT);
        $data['orders'] = $orders;

        return view('admin.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = [];

        // get orders
        $orders = Order::with('orderDetails')
            ->with('user')
            ->paginate(self::RECORD_LIMIT);
        $data['orders'] = $orders;

        return view('admin.orders.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        // get order
        $order = Order::findOrFail($id);
        $data['order'] = $order;

        return view('admin.orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        DB::beginTransaction();

        try {
            $order->update([
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.order.index')->with('success', 'Update Status of Order successful.');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
