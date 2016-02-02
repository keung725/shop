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

                <form class="form" id="log-form" method="post" action="{{ url('/login') }}" autocomplete="off" novalidate>
                    <div id="log-validation-errors"></div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="電子郵件" value="{{ old('email') }}">

                    </div>

                    <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="密碼">
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


@section('login-script')
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showLoginRequest,
                success:       showLoginResponse,
                dataType: 'json'
            };
            $('#log-form').ajaxForm(options);

        });
        function showLoginRequest(formData, jqForm, options) {
            $("#log-validation-errors").empty();
            return true;
        }
        function showLoginResponse(response, statusText, xhr, $form)  {

            if(response.success == false)
            {

                var error = response.errors;
                            $("#log-validation-errors").append('<p class="alert alert-danger"><strong>' + error + '</strong></p>');


            } else {

                $('#ModalLogin').modal('toggle');

                $(".navbar-toggle").collapse('hide');

                location.reload();

            }
        }
    </script>
@endsection