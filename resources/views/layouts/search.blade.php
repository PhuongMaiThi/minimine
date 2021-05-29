<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục sản phẩm</span>
                    </div>
                    
                    <ul>
                        @foreach ($category as $key => $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    
                    <div class="hero__item set-bg" data-setbg="frontend/img/banner/banner.jpg">
                        <div class="hero__text">
                            <span>Cây xanh</span>
                            <h2>Có thật sự <br />cần thiết</h2>
                            <p>Mang thiên nhiên đến gần bạn</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>