@extends('layouts.app')

@section('title', '會員資料')

@section('content')

    <div class="container main-container headerOffset">
        <div class="row">
            <div class="breadcrumbDiv col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}">首頁</a></li>
                    <li class="active">忘記密碼</li>
                </ul>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-7">
                <h1 class="section-title-inner"><span><i
                                class="fa fa-unlock-alt"></i>忘記密碼</span></h1>
                <div class="userInfo">
                    <h2 class="block-title-2">要重置密碼，請輸入您使用登錄到我們網站的電子郵件地址。然後，我們會送你一個新的密碼。</h2>
                </div>
                <form class="form" id="dataForm" method="post" action="{{ url('/password/email')}}" novalidate>
                    <div id="success_message"></div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> 電子郵件 </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="xyz@hotmail.com" value="{{ old('email') }}" name="email">
                    </div>
                    <div id="validation-errors-email"></div>
                    <button type="submit" class="btn   btn-primary"><i class="fa fa-envelope-o"> </i> 找回密碼
                    </button>
                </form>
                <div class="col-lg-12 clearfix">
                    <ul class="pager">
                        <li class="next pull-left"><a href="{{ url('/') }}"> &larr; 首頁</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/row-->

        <div style="clear:both"></div>
    </div>
    <!-- /main-container -->

    @include('member.nav_login')

    @include('member.nav_signup')

@endsection

@section('page-script')
    <script type="text/javascript">
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
            $("#validation-errors-email").empty();
            return true;
        }
        function showResponse(response, statusText, xhr, $form)  {

            if(response.success == false)
            {

                var email_error = response.errors.email;

                $.each(email_error, function (index, value) {
                    if (value.length != 0) {
                        $("#validation-errors-email").append('<p class="alert alert-danger"><strong>' + value + '</strong></p>');
                    }
                });


            } else {
                var success = response.message;
                $("#success_message").append('<p class="alert alert-success"><strong>'+ success +'</strong></p>');
                $("#success_message").show();

            }
        }
    </script>
@endsection