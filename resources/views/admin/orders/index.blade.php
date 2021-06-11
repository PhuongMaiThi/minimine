@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Order')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Order Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Order')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/admin/css/categories/category-list.css">
@endpush

@section('content')
    {{-- form search --}}
    {{-- @include('admin.orders._search') --}}
    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    {{-- display list Order table --}}
    <table id="product-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Fullname</th>
                <th>Total Quantity</th>
                <th>Total Money</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($orders))
                @foreach ($orders as $key => $order)
                    @php
                        $totalQuantity = 0;
                        $totalMoney = 0;
                        if (!empty($order->orderDetails)) {
                            foreach ($order->orderDetails as $od) {
                                // get quantity
                                $totalQuantity += $od->quantity;
    
                                // get price
                                $productPrice = $od->price;
                                $totalMoney += $od->quantity * $productPrice;
                            }
                        }
                    @endphp
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            {{ number_format($totalQuantity) }}
                        </td>
                        <td>
                            {{ number_format($totalMoney) }}
                        </td>
                        <td>
                            @include('admin.orders._status')
                        </td>
                        <td><a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-secondary">Order Detail</a></td>
                        <td><a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-info">Update Status</a></td>
                        <td>
                            <form action="{{ route('admin.order.destroy', $order->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure DELETE Order?')" class="btn btn-danger" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
    {{ $orders->appends(request()->input())->links() }}
@endsection