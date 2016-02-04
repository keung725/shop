@extends('layouts.app')

@section('title', '重設密碼')

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">重設密碼</div>

                <div class="panel-body">
                    <form class="form-horizontal" id="dataForm" role="form" method="POST" action="{{ url('/password/reset') }}">
                        <div id="success_message"></div>
                        <div id="validation-errors-password"></div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">電子郵件</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">密碼</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">重新輸入密碼</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>重設密碼
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('member.nav_login')

@include('member.nav_signup')

@endsection

@section('page-script')
    <script type="text/javascript">
        var delayedRedirect = function () {
            location.reload();
        }

        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#dataForm').ajaxForm(options);

        });
        function showRequest(formData, jqForm, options) {
            $("#success_message").empty();
            $("#validation-errors-password").empty();
            return true;
        }
        function showResponse(response, statusText, xhr, $form)  {

            if(response.success == false)
            {

                var password_error = response.errors.password;

                $.each(password_error, function (index, value) {
                    if (value.length != 0) {
                        $("#validation-errors-password").append('<p class="alert alert-danger"><strong>' + value + '</strong></p>');
                    }
                });


            } else {
                var success = response.message;
                $("#success_message").append('<p class="alert alert-success"><strong>'+ success +'</strong></p>');
                $("#success_message").show();


                setTimeout(delayedRedirect(), 7000)

            }

        }
    </script>
@endsection