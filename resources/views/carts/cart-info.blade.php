@extends('layouts.master')

{{-- import external file css --}}
@push('css')
    
@endpush

@section('content')
    <section class="list-product">
        @if(!empty($carts))
            <table class="table table-bordered table-hover" id="tbl-list-product">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng tiền</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($carts as $key => $cart)
                    <tbody>
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="cart-name">
                                    {{ $cart['name'] }}
                                </div>
                            </td>
                            <td>
                                <div class="product-thumbnail" style="width:60px">
                                    <img src="{{ $cart['thumbnail'] }}" alt="{{ $cart['name'] }}" class="img-fluid">
                                </div>
                            </td>
                            <td>
                                <div class="product-quantity">
                                    <input type="number" value="{{ $cart['quantity'] }}" style="width:50px" >
                                </div>
                            </td>
                            <td>
                                <div class="product-price">
                                    {{ number_format($cart['price']) }}
                                </div>
                            </td>
                            <td>
                                <div class="product-price">
                                    @php
                                    $money = $cart['quantity'] * $cart['price'];
                                    echo number_format($money) . 'VND';
                                @endphp
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy',['id' => $cart['id']]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="submit" value="X" class="btn btn-danger">
                                </form>
                            </td>
                            
                        </tr>
                    </tbody>
                @endforeach
            </table>
            
            <div class="row">
                
            </div>
            <div class="mt-2">
                {{-- tiến hành thanh toán --}}
                {{-- <a href="{{ route('cart.checkout') }}"><button type="submit" class="btn btn-primary">Thanh toán</button></a> --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-send-code">Tiến hành thanh toán</button>
                
                {{-- <button type="submit" class="btn btn-primary">Thanh toán</button> --}}
                <a href="/"><button type="button" class="btn btn-primary">Tiếp tục mua hàng</button></a>
            </div>
        @else
            <h4>Chưa có sản phẩm nào trong giỏ hàng. <a href="/">Tiếp tục mua hàng</a></h4>
        @endif
    </section>
   {{-- import modal --}}
   @include('carts.parts.modal_send_code')
   @endsection
   
   @push('css')
       <link rel="stylesheet" href="{{ asset('css/carts/cart-info.css') }}">
   @endpush
   
   @push('js')
       <script>
           const URL_CHECKOUT = "{{ route('cart.checkout') }}";
       </script>
       <script src="{{ asset('js/carts/cart-info.js') }}"></script>
   @endpush
    
