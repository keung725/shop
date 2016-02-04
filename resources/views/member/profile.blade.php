@extends('layouts.app')

@section('title', '會員資料')

@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">首頁</a></li>
                <li class="active">用戶資料</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-9">
            <h1 class="section-title-inner"><span><i
                            class="glyphicon glyphicon-user"></i>用戶資料</span></h1>
                <div class="userInfo">
                    <h2 class="block-title-2"></h2>
                </div>
                <form class="form" id="dataForm" method="post" action="{{ url('/profile')}}">
                    <div id="success_message"></div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="role">會員角色</label> <br/>
                        @foreach($user->roles as $role)
                            {!! $role->display_name !!} <br/>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="InputName">姓名 </label>
                        <input type="text" class="form-control" id="name"  name="name" placeholder="陳大文" value="{!! $user->name !!}">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail"> 電子郵件 </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="xyz@hotmail.com" value="{!! $user->email !!}">
                        <div id="validation-errors-email"></div>
                    </div>
                    <div class="form-group ">
                        <p class=" clearfix">
                            <input type="checkbox" value="1" name="newsletter" id="newsletter" checked>
                            <label for="newsletter">收取推廣電子郵件</label>
                        </p>
                    </div>
                    <button type="submit" class="btn   btn-primary"><i class="fa fa-save"></i> &nbsp; 儲存</button>
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
            $("#validation-errors-email").empty();
            $("#success_message").empty();
            return true;
        }
        function showResponse(response, statusText, xhr, $form)  {

            if(response.success == false)
            {
                if(response.errors.hasOwnProperty('email')) {
                    var email_error = response.errors.email;

                    $.each(email_error, function (index, value) {
                        if (value.length != 0) {
                            $("#validation-errors-email").append('<p class="alert alert-danger"><strong>' + value + '</strong></p>');
                        }
                    });
                }
            } else {
                var success = response.message;
                $("#success_message").append('<p class="alert alert-success"><strong>'+ success +'</strong></p>');
                $("#success_message").show().delay(2000).fadeOut();

            }
        }
    </script>
@endsection