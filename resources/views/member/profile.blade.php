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
        <div class="col-lg-9 col-md-9 col-sm-7">
            <h1 class="section-title-inner"><span><i
                            class="glyphicon glyphicon-user"></i>用戶資料</span></h1>

            <div class="row userInfo">
                <div class="col-lg-12">
                    <h2 class="block-title-2"> 如需要更改資料，必需填寫個人密碼。 如不需重設密碼，請不要填寫新密碼及重複新密碼欄位。</h2>

                    <p class="required"><sup>*</sup> 必填項目</p>
                </div>
                <form>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group required">
                            <label for="InputName">姓名 </label>
                            <input type="text" class="form-control" id="name"  name="name "placeholder="陳大文">
                        </div>
                        <div class="form-group">
                            <label for="InputEmail"> 電子郵件 </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="xyz@hotmail.com">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group required">
                            <label for="InputPasswordCurrent"><sup>*</sup> 密碼 </label>
                            <input type="password" name="current_password" class="form-control"
                                   id="current_password">
                        </div>
                        <div class="form-group required">
                            <label for="InputPasswordnew"> 新密碼 </label>
                            <input type="password" name="new_password" class="form-control" id="new_password">
                        </div>
                        <div class="form-group required">
                            <label for="InputPasswordnewConfirm"> 重複新密碼 </label>
                            <input type="password" name="new_password_confirm" class="form-control"
                                   id="new_password_confirm">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <p class=" clearfix">
                                <input type="checkbox" value="1" name="newsletter" id="newsletter" checked>
                                <label for="newsletter">收取推廣電子郵件</label>
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn   btn-primary"><i class="fa fa-save"></i> &nbsp; 儲存</button>
                    </div>
                </form>
                <div class="col-lg-12 clearfix">
                    <ul class="pager">
                        <li class="next pull-left"><a href="{{ url('/') }}"> &larr; 首頁</a></li>
                    </ul>
                </div>
            </div>
            <!--/row end-->

        </div>
        <div class="col-lg-3 col-md-3 col-sm-5"></div>
    </div>
    <!--/row-->

    <div style="clear:both"></div>
</div>
<!-- /main-container -->

@include('member.nav_login')

@include('member.nav_signup')

@endsection