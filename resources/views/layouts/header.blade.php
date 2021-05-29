<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>maiphuong8523@gmail.com</li>
                            <li><i class="fa fa-phone"></i>0971409499</h5></li>
                            <li>Free ship với tất cả đơn hàng trên 500K</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>Tiếng Việt</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Tiếng Việt</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        
                        <div class="header__top__right__language">                          
                            <img src="#" alt="">
                            <div>Login</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                                       <li>
                                          <hr class="dropdown-divider">
                                       </li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Tạo tài khoản</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"><i class="far fa-sign-out-alt"></i><span class="text">Logout</span></button>
                                    </form>
                                </li>
                            </ul>                           
                        </div>
                        {{-- <div class="header__top__right__language"><p><a href="{{route('register')}}">Register</a></p>
                        </div> --}}
                        {{-- <div><span class="arrow_carrot-down"></span><span class="text"> </span><span>{{ Auth::user()->name }}</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="frontend/img/LOGO1.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Trang chủ</a></li>
                            <li><a href="./shop-grid.html">Giới thiệu</a></li>
                            <li><a href="#">Làm vườn</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Hạt giống rau củ</a></li>
                                    <li><a href="./shoping-cart.html">Hạt giống hoa</a></li>
                                    <li><a href="./checkout.html">Dụng cụ làm vườn</a></li>
                                    <li><a href="./blog-details.html">Phân bón</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <div class="hero__search__form">
                        <form action="#">
                            {{-- <div class="hero__search__categories">
                                Danh mục
                                <span class="arrow_carrot-down"></span>
                            </div> --}}
                            <input type="text" placeholder="Tìm kiếm">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                </div>               
            </div>
    </div>
</header>