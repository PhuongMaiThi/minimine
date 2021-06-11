<h4>Thông tin đơn hàng</h4>
<div class="border p-2">
    @if (!empty($carts))
        @foreach ($carts as $cart)
            <div class="list-product">
                <div class="product-detail">
                    <img src="{{ $cart['thumbnail'] }}" alt="{{ $cart['name'] }}" class="img-fluid"><hr>
                    <h5>{{ $cart['name']}}</h5>
                    <p>Đơn giá: {{ number_format($cart['price']) }} VND</p>
                    <p>Số lượng: {{ $cart['quantity'] }}</p>
                    
                    <p>Thành tiền: {{ number_format($cart['quantity'] * $cart['price']) . 'VND' }}</p>
                
                    
                </div>
            </div>
        @endforeach
    @endif
</div>