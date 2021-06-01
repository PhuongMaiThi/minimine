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
    <section class="product-detail">
        <div class="row">
            <div class="col-6">
                <div class="product-thumbnail" style="width:500px">
                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="product-description">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="price_id" value="{{ $product->latestPrice()->id }}">
                        <h4>{{ $product->name }}</h4>
                        <hr>
                        <p class="product-comment">
                            <span>(Xem đánh giá)</span>
                        </p>
                        <hr>
                        <h4 class="product-price">{{ number_format($product->price) }} VND</h4>
                        <hr>
                        <p class="product-quantity">
                            <label>Quantity: </label>
                            <span><input type="number" name="quantity" required></span>
                        </p>
                        <p>
                            <button type="submit" class="site-btn">Add Cart</button>
                        </p>
                    </form>
                    <hr>
                    <div>
                        <h4>Mô tả sản phẩm:</h4>
                        <p>{{$product->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="row"><hr></div>

{{-- footer --}}
@include('layouts.footer')
{{-- end footer --}}