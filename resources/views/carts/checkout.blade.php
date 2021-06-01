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
    <section class="checkout">
        <div class="row">
            <div class="col-4">
                {{-- thong tin don hang --}}
                @include('carts.parts.cart_info')
            </div>
            <div class="col-4">
                {{-- thong tin ca nhan --}}
                @include('carts.parts.personal_info')
            </div>
            <div class="col-4">
                {{-- thong tin thanh toan --}}
                @include('carts.parts.payment_info')
            </div>
        </div>
    </section>  
</div>
<div class="row"><hr></div>
{{-- footer --}}
@include('layouts.footer')
{{-- end footer --}}