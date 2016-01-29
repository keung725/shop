<!-- Modal Login start -->
<div class="modal signUpContent fade" id="ModalLogin" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h3 class="modal-title-site text-center"> 會員登入</h3>
            </div>

            <div class="modal-body">
                <div class="control-group"><a class="fb_button btn  btn-block btn-lg " href="#">FACEBOOK 登入</a></div>
                <h5 style="padding:10px 0 10px 0;" class="text-center"> 或 </h5>
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input type="email" class="form-control" name="email" placeholder="電子郵件" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password" placeholder="密碼">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                            <input type="checkbox" name="remember" checked> 記住我
                    </div>
                </div>

                <div>
                    <div>
                        <input name="submit" class="btn  btn-block btn-lg btn-primary" value="登入" type="submit">
                    </div>
                </div>
                <!--userForm-->
                </form>

            </div>
            <div class="modal-footer">
                <p class="text-center"> <a class="btn btn-link" data-toggle="modal" data-dismiss="modal"
                                                            href="#ModalSignup"> 會員註冊 </a>
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">忘記密碼?</a>  </p>
            </div>
        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->

</div>
<!-- /.Modal Login -->