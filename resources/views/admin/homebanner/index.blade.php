@extends('admin.layouts.app')

@section('title', 'All Home Banner')

@section('admin_content')
    <div class="content-wrapper" ng-app="HomeBanner" ng-controller="HomeBannerController">
        @include('admin.layouts.breadcrumb')
        <section class="content-header">
            <a href="{{ url('/admin/homebanner/create') }}">Go to Home Banner Create</a>
        </section>
        <!-- Main content -->
        <section class="content" id="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@yield('title')</h3>
                        </div><!-- /.box-header -->
                        <div id="success_message"></div>
                        <div class="box-body table-responsive">
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            <table id="dataListingTable" class="table table-bordered table-striped" datatable="ng">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Show?</th>
                                    <th>Ordering</th>
                                    <th>Create At</th>
                                    <th>Delete?</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='HomeBanner in HomeBanners'>
                                        <td><% HomeBanner.id %></td>
                                        <td><img ng-src="{{ URL::asset('<% HomeBanner.image_path %>')}}" class="img-responsive" style="width:250px;"/></td>
                                        <td>
                                            <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="HomeBanner.show" ng-change="updateHomeBanner(HomeBanner)">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="ordering" ng-model="HomeBanner.ordering" size="3" ng-change="updateHomeBanner(HomeBanner)">
                                        </td>
                                        <td><% HomeBanner.created_at %></td>
                                        <td>
                                            <input type="checkbox" ng-true-value="4" ng-false-value="1" ng-model="HomeBanner.status" ng-change="deleteHomeBanner(HomeBanner)">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection

@section('page-script')
    <script type="text/javascript">
        var app = angular.module('HomeBanner', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('HomeBannerController', function($scope, $http) {

            $scope.HomeBanners = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/api/homebanners').
                success(function(data, status, headers, config) {
                    $scope.HomeBanners = data;
                    $scope.loading = false;
                });
            }


            $scope.updateHomeBanner = function(HomeBanner) {
                $scope.loading = true;
                $("#success_message").hide().empty();
                $http.put('/api/homebanner/' + HomeBanner.id, {
                    status: HomeBanner.status,
                    ordering: HomeBanner.ordering,
                    show: HomeBanner.show,
                }).success(function(data, status, headers, config) {
                    $scope.HomeBanner = data;
                    $scope.loading = false;
                    $("#success_message").append('<p class="alert alert-success"><strong>Update Success!</strong></p>');
                    $("#success_message").show().delay(2000).fadeOut();;
                });;
            };

            $scope.deleteHomeBanner = function(HomeBanner) {
                $scope.loading = true;

                $http.put('/api/homebanner/' + HomeBanner.id, {
                    status: HomeBanner.status,
                }).success(function(data, status, headers, config) {
                    $scope.HomeBanner = data;
                    $scope.loading = false;
                    location.reload();
                });;
            };

            $scope.init();

        });



    </script>
@stop