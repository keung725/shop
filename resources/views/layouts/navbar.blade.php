<!-- Fixed navbar start -->
<div class="navbar navbar-default navbar-hero  navbar-fixed-top megamenu" role="navigation">

    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                    class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span
                    class="icon-bar"> </span> <span class="icon-bar"> </span></button>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-cart"><i
                    class="fa fa-shopping-cart colorWhite"> </i> <span
                    class="cartRespons colorWhite">($210.00)</span></button>
            <a class="navbar-brand " href="/"> <img src="{{ URL::asset('images/logo-dark.png')}}" alt="KCBRoom"> </a>

            <!-- this part for mobile -->
            <div class="search-box pull-right hidden-lg hidden-md hidden-sm">
                <div class="input-group">
                    <button class="btn btn-nobg search-trigger" type="button"><i class="fa fa-search"> </i></button>
                </div>
                <!-- /input-group -->

            </div>
        </div>

        @include('layouts.minicart')

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class=" "><a href="#"> New </a></li>

                <!-- change width of megamenu = use class > megamenu-fullwidth, megamenu-60width, megamenu-40width -->
                <li class="dropdown megamenu-fullwidth "><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    Browse
                    <b class="caret"> </b> </a>
                    <ul class="dropdown-menu hero-submenu">
                        <li class="megamenu-content">

                            <!-- megamenu-content -->


                            <ul class="col-lg-2  col-sm-2 col-md-2  unstyled">
                                <li>
                                    <p class="menu-title"><strong> Men Collection </strong></p>
                                </li>
                                <li><a href="#"> Male Fragrances </a></li>
                                <li><a href="#"> Scarf </a></li>
                                <li><a href="#"> Underwear </a></li>

                                <li><a href="#"> Coats & Jackets </a></li>
                                <li><a href="#"> Basics </a></li>
                            </ul>
                            <ul class="col-lg-2  col-sm-2 col-md-2  unstyled">
                                <li>
                                    <p class="menu-title"><strong> Women Collection </strong></p>
                                </li>

                                <li><a href="#"> Tops </a></li>
                                <li><a href="#"> Bottoms </a></li>
                                <li><a href="#"> Dresses </a></li>
                                <li><a href="#"> Coats & Jackets </a></li>
                                <li><a href="#"> Trends </a></li>


                            </ul>

                            <ul class="col-lg-2  col-sm-2 col-md-2  unstyled">
                                <li>
                                    <p class="menu-title"><strong> Accessories </strong></p>
                                </li>


                                <li><a href="#"> Sunglasses </a></li>
                                <li><a href="#"> Scarves </a></li>
                                <li><a href="#"> Watches </a></li>
                                <li><a href="#"> Belts </a></li>
                                <li><a href="#"> Socks </a></li>
                            </ul>

                            <ul class="col-lg-2  col-sm-2 col-md-2  unstyled">
                                <li>
                                    <p class="menu-title"><strong> Top Brands </strong></p>
                                </li>
                                <li><a href="#"> Diesel </a></li>
                                <li><a href="#"> Farah </a></li>
                                <li><a href="#"> G-Star RAW </a></li>
                                <li><a href="#"> Lyle & Scott </a></li>
                                <li><a href="#"> Pretty Green </a></li>
                            </ul>

                            <ul class="col-lg-2  col-sm-2 col-md-2  unstyled">
                                <li>
                                    <p class="menu-title"><strong> Shoes </strong></p>
                                </li>
                                <li><a href="#"> Flats </a></li>
                                <li><a href="#"> Sandals </a></li>
                                <li><a href="#"> Wedges </a></li>
                                <li><a href="#"> Sneakers </a></li>
                                <li><a href="#"> Heels & Pumps </a></li>
                            </ul>

                            <ul class="col-lg-2  col-sm-2 col-md-2  unstyled">
                                <li>
                                    <p class="menu-title"><strong> Popular </strong></p>
                                </li>
                                <li><a href="#">Denim</a></li>
                                <li><a href="#">Essentials</a></li>
                                <li><a href="#">Shirts</a></li>
                                <li><a href="#">Pants</a></li>
                                <li><a href="#">Outerwear</a></li>
                            </ul>

                        </li>
                    </ul>
                </li>
                <li class="dropdown "><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    SHOP <b class="caret"> </b> </a>

                    <ul class="dropdown-menu">
                        <li><a href="#">New</a></li>
                        <li><a href="#">Denim</a></li>
                        <li><a href="#">Essentials</a></li>
                        <li><a href="#">Shirts</a></li>
                        <li><a href="#">Pants</a></li>
                        <li><a href="#">Outerwear</a></li>
                        <li><a href="#">Sweaters</a></li>
                        <li><a href="#">Shorts</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="hide-xs"><a class="btn btn-nobg  search-trigger"><i class="fa fa-search"> </i></a></li>
                @if (Auth::check())
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa fa-user"></i> 會員中心<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasRole(['siteowner', 'admin']))
                                <li><a href="{{ url('/admin') }}">管理頁面</a></li>
                            @endif
                                <li> <a href="{{ url('/profile') }}">用戶資料</a></li>
                                <li> <a href="{{ url('/logout') }}">登出</a></li>
                        </ul>
                    </li>
                @else
                    <li><a data-target="#ModalLogin" data-toggle="modal"><i class="fa fa-user"></i> 登入</a></li>
                    <li><a data-target="#ModalSignup" data-toggle="modal"><i class="fa fa-user-plus"></i> 註冊</a></li>
                @endif


                <li class="hide-xs cart-sidebar-toggle"><a><i
                                class="glyphicon-shopping-cart glyphicon"></i> 購物車</a></li>
            </ul>

        </div>
        <!--/.nav-collapse -->

    </div>
    <!--/.container -->

    <div class="search-full text-right"><a class="pull-right search-close"> <i class=" fa fa-times-circle"> </i> </a>

        <div class="searchInputBox pull-right">
            <input type="search" data-searchurl="search?=" name="q" placeholder="start typing and hit enter to search"
                   class="search-input">
            <button class="btn-nobg search-btn" type="submit"><i class="fa fa-search"> </i></button>
        </div>
    </div>
    <!--/.search-full-->

</div>
<!-- /.Fixed navbar  -->