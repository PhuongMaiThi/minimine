@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Product')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Product Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Product')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/products/product-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/products/product-list.js"></script>
@endpush
@section('content')
    <section class="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="product-thumbnail">
                    {{-- <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" > --}}
                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid" style="width:400px">
                </div>
            </div>
            <div class="col-5">
                <div class="product-description">
                    <div class="product-name">
                        <h2>{{$product->name}}</h2>
                    </div>
                    <div>
                        <h4>Price: {{ number_format($product->price)}} VNĐ</h4>
                    </div>
                    <div class="product-description">
                        <h4> Description: </h4>
                        <p>{{$product->description}}</p>
                    </div>
                    
                    <div class="quantity">
                        <h4>Quantity: {{$product->quantity}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <h5>{{$product->name}}</h5>
        </div>
        <hr>
        <div class="row">
            <p>{{$product->content}}</p>
        </div>
    </div>
    </section>
@endsection
