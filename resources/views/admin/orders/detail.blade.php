@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Detail Order')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Order Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Detail Order')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/orders/order-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/orders/order-list.js"></script>
@endpush

@section('content')
    {{-- show message --}}
    @include('errors.error')

    @if (!empty($order->orderDetails))
    <div class="order-detail">
        <table class="table table-bordered table-striped">
            <thead class="bg-info">
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Money</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalMoney = 0;
                    $totalQuantity = 0;
                @endphp
                @foreach ($order->orderDetails as $key => $orderDetail)
                    @php
                        $money = $orderDetail->quantity * $orderDetail->price;
                        $totalMoney += $money;

                        $quan = $orderDetail->quantity;
                        $totalQuantity += $quan;

                        $pri = $orderDetail->price;
                    @endphp
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td><img src="{{ $orderDetail->product->thumbnail }}" alt="{{ $orderDetail->product->name }}" class="img-fluid img-thumbnail" style="width: 100px;"></td>
                        <td>{{ $quan }}</td>
                        <td>{{ $pri }}</td>
                        <td>{{ number_format($money) }}</td>
                    </tr>
                @endforeach
                <tfoot class="bg-secondary">
                    <tr>
                        <td colspan="2" class="text-right">Total Quantity</td>
                        <td class="text-bold">{{ number_format($totalQuantity) }}</td>
                        <td class="text-right">Total Money</td>
                        <td class="text-bold">{{ number_format($totalMoney) }}</td>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
@endif
<a href="{{route('admin.order.index')}}"><button class="btn btn-primary">Back</button></a>
@endsection