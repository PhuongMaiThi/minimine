<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minimine Garden</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <base href="{{asset('')}}">
    <!-- Css Styles -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/style.css" type="text/css">
</head>
<body>
    <!-- Header Section Begin -->
    @include('layouts.header')
    <!-- Header Section End -->
<div class="container">
    <section class="list-product">
        @if(!empty($products))
            <table class="table table-bordered table-hover" id="tbl-list-product">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th></th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                @foreach ($products as $key => $product)
                    <tbody>
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="product-name">
                                    {{ $product->name }}
                                </div>
                            </td>
                            <td>
                                <div class="product-thumbnail" style="width:60px">
                                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid">
                                </div>
                            </td>
                            <td>
                                <div class="product-quantity">
                                    {{ $carts[$product->id]['quantity'] }}
                                    
                                </div>
                            </td>
                            <td>
                                <div class="product-price">
                                    {{ number_format($product->price) }}
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="submit" value="X" class="btn btn-danger">
                                </form>
                            </td>
                            <td>
                                <div class="cart-money">
                                    @php
                                        $money = $carts[$product->id]['quantity'] * $product->price;
                                        echo number_format($money) . ' VND';
                                    @endphp
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            
            <div class="row">
                
            </div>
            <div class="mt-2">
                {{-- tiến hành thanh toán --}}
                <a href="{{ route('cart.checkout') }}"><button type="submit" class="btn btn-primary">Thanh toán</button></a>
                <a href="/"><button type="button" class="btn btn-primary">Tiếp tục mua hàng</button></a>
            </div>
        @else
            <h4>Chưa có sản phẩm nào trong giỏ hàng. <a href="/">Tiếp tục mua hàng</a></h4>
        @endif
    </section>

</div>
<div class="row"><hr></div>
{{-- footer --}}
@include('layouts.footer')
{{-- end footer --}}