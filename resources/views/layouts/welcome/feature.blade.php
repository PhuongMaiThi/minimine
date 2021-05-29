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
            {{-- foreach --}}
            @if (!empty($product))
            @foreach ($product as $product)
            
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6>{{ $product['name'] }}</h6>
                        <div class="product-image">
                            <a href="{{ route('product.detail', $product['id']) }}"><img src="{{ $product['thumbnail'] }}" alt="image" class="img-fluid"></a>
                        </div>
                        <div class="product-description">
                            <p clas price>{{ $product['price'] }}</p>
                        </div>
                        <div class="product-buy">
                            <a href="{{ route('product.detail', $product['id']) }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            {{-- endforeach --}}
        </div>
    </div>
</section>