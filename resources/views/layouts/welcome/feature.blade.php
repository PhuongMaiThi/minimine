<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm HOT</h2>
                </div>
            </div>
        </div>
        
        <div class="row featured__filter">
            @if (!empty($hotProducts))
            @foreach ($hotProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__text">                          
                        <div class="product-image">
                            <a href="{{ route('product.detail', $product['id']) }}"><img src="{{ $product['thumbnail'] }}" alt="image" style="height:240px"></a>
                        </div>
                        <h6>{{ $product['name'] }}</h6>
                        <div class="product-description">
                            <h4 clas price>{{ $product['price'] }}.000 VNĐ</h4>
                        </div>
                        <div class="product-buy">
                            <a href="{{ route('product.detail', $product['id']) }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>                                            
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>