<footer class="main-footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">

                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-col">
                        <h4 class="footer-title">客服</h4>
                        <ul>
                            <li>
                                <a class="inline" href="tel:+85268258193"> <strong> <i class="fa fa-whatsapp"></i> +85268258193 </strong> </a>
                            </li>
                            <li>
                                <a class="inline" href="tel:+85268258193"> <strong> <i class="fa fa-phone"> </i> +85268258193 </strong> </a>
                            </li>
                            <li>
                                <a class="inline" href="mailto:cs@kcbroom.com"> <i class="fa fa-envelope-o"> </i> cs@kcbroom.com </a>
                            </li>
                            <li>
                                <a class="inline" href="https://www.facebook.com/"> <i class="fa fa-facebook-square"> </i> KCBRoom </a>
                            </li>
                            <li>
                                <a class="inline" href="http://instagram.com/"> <i class="fa fa-instagram"> </i> KCBRoom </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-col">
                        <h4 class="footer-title">我的會員中心</h4>
                        <ul>
                            @if (Auth::check())
                                @if(Auth::user()->hasRole(['siteowner', 'admin']))
                                    <li><a href="{{ url('/admin') }}">管理頁面</a></li>
                                @endif
                                <li> <a href="{{ url('/profile') }}">用戶資料</a></li>
                                <li> <a href="{{ url('/logout') }}">登出</a></li>
                            @else
                            <li> <a a="" href="#" data-toggle="modal" data-target="#ModalLogin"> 登入 </a> </li>
                            <li> <a href="#" data-toggle="modal" data-target="#ModalSignup">登記會員 </a> </li>
                            @endif

                        </ul>

                    </div>
                </div>
                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-col">
                        <h4 class="footer-title">重要資料</h4>
                        <ul>
                            <li><a href="#">條款及細則</a></li>
                            <li><a href="#">私隱政策‏</a></li>
                        </ul>
                    </div>
                </div>
                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-col">
                        <h4 class="footer-title">接觸我們更多</h4>
                        <ul>
                            <li>
                                <div class="input-append newsLatterBox text-center">
                                    <input type="text" class="full text-center" name="edm" id="edm_field" placeholder="電子郵件 ">
                                    <button class="btn  bg-gray" type="button" id="edm_button"> 訂閱電子報 <i class="fa fa-long-arrow-right"> </i> </button>
                                    <h3 id="txtedm" class="incaps">
                                    </h3></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="clear: both"></div>

                <div class="col-lg-12">
                    <div class=" text-center paymanet-method-logo">
                        <img src="{{ URL::asset('images/site/payment/master_card.png')}}" alt="img">
                        <img alt="img" src="{{ URL::asset('images/site/payment/visa_card.png')}}">
                        <img alt="img" src="{{ URL::asset('images/site/payment/paypal.png')}}">
                    </div>

                    <div class="copy-info text-center">
                        &copy; 2016 KCBRoom 保留所有的權利
                    </div>

                </div>

            </div>
        </div>
    </div>
</footer>