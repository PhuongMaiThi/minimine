@extends('layouts.master')

{{-- import external file css --}}
@push('css')
    
@endpush

{{-- import external file js --}}
@push('js')
    <script>
        var AJAX_PRODUCT_CHECK_QUANTITY_URL = "{{ route('ajax.product.check-quantity', request()->route('id')) }}";
    </script>
    <script src="/js/carts/product-check-quantity.js"></script>
@endpush


@section('content')
    <section class="product-detail">
        <div class="row">
            <div class="col-6">
                <div class="product-thumbnail" style="width:500px">
                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="product-description">
                    <form action="{{ route('cart.add-cart', $product->id) }}" method="POST">
                        @csrf
                        
                        <h4>{{ $product->name }}</h4>
                        <hr>
                        <p class="product-comment">
                            <span>(Xem đánh giá)</span>
                        </p>
                        <hr>
                        <h4 class="product-price">{{ number_format($product->price) }} VND</h4>
                        <hr>
                        <p class="product-quantity">
                            <label>Số lượng: </label>
                            <span><input type="number" name="quantity" id="product-quantity" onchange="checkQuantity('{{ $product->id }}')" required ></span>
                        </p>
                        <button type="submit">Thêm vào giỏ hàng</button>
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
@endsection
