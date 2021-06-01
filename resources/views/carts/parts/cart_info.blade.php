<h4>Thông tin đơn hàng</h4>
<div class="border p-2">
    @if (!empty($products))
        @foreach ($products as $product)
            <div class="list-product">
                <div class="product-detail">
                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid"><hr>
                    <h5>{{ $product->name }}</h5>
                    <p>Đơn giá: {{ number_format($product->price) }} VND</p>
                    <p>Số lượng: {{ $carts[$product->id]['quantity'] }}</p>
                    @php
                        $money = number_format($carts[$product->id]['quantity'] * $product->price);
                    @endphp
                    <p>Thành tiền: {{ $money . ' VND' }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>