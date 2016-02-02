@extends('layouts.app')

@section('title', '403 網頁不存在')

@section('content')



    <div class="container main-container headerOffset">

        <div class="row innerPage">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row userInfo">

                    <h1 class="h1error"><span class="err404">403</span></h1>

                    <p class="lead text-center" style="font-size: 30px; font-weight: bold;">拒絕訪問</p>

                    <h1 class="h1error"><span class="err404"> <i class="fa fa-frown-o"></i></span></h1>


                </div>
                <!--/row end-->
            </div>
        </div>
        <!--/.innerPage-->
        <div style="clear:both"></div>
    </div>
    <!-- /.main-container -->


    @include('member.nav_login')

    @include('member.nav_signup')

@endsection