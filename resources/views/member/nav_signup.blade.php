<!-- Modal Signup start -->
<div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h3 class="modal-title-site text-center"> 會員註冊 </h3>
            </div>
            <div class="modal-body">
                <div class="control-group"><a class="fb_button btn  btn-block btn-lg " href="#">FACEBOOK 登入</a></div>
                <h5 style="padding:10px 0 10px 0;" class="text-center"> 或 </h5>

                <form class="form" id="reg-form" method="post" action="{{ url('/register') }}" autocomplete="off" novalidate>
                    <div id="reg-success_message"></div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <div class="form-group">

                    <input type="email" class="form-control" name="email" placeholder="電子郵件" value="{{ old('email') }}">
                    <div id="reg-validation-errors-email"></div>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="密碼">

                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="重複輸入密碼">
                    <div id="reg-validation-errors-password"></div>
                </div>
                <div>
                    <div>
                        <input name="submit" class="btn  btn-block btn-lg btn-primary" value="註冊" type="submit">
                    </div>
                </div>
                <!--userForm-->
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center"><a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
                    會員登入 </a></p>
            </div>
        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->

</div>
<!-- /.ModalSignup End -->

@section('register-script')
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRegisterRequest,
                success:       showRegisterResponse,
                dataType: 'json'
            };
            $('#reg-form').ajaxForm(options);

        });
        function showRegisterRequest(formData, jqForm, options) {
            $("#reg-validation-errors-email").empty();
            $("#reg-validation-errors-password").empty();
            return true;
        }
        function showRegisterResponse(response, statusText, xhr, $form)  {

            if(response.success == false)
            {
                if(response.errors.hasOwnProperty('email')) {
                    var email_error = response.errors.email;

                    $.each(email_error, function (index, value) {
                        if (value.length != 0) {
                            $("#reg-validation-errors-email").append('<p class="alert alert-danger"><strong>' + value + '</strong></p>');
                        }
                    });
                }

                if(response.errors.hasOwnProperty('password')) {
                    var password_error = response.errors.password;
                    $.each(password_error, function (index, value) {
                        if (value.length != 0) {
                            $("#reg-validation-errors-password").append('<p class="alert alert-danger"><strong>' + value + '</strong></p>');
                        }
                    });
                }

            } else {

                $('#ModalSignup').modal('toggle');

                $(".navbar-toggle").collapse('hide');

                location.reload();

            }
        }
    </script>
@endsection