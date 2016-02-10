@extends('admin.layouts.app')

@section('title', 'All Brand')

@section('admin_content')
    <div class="content-wrapper" ng-app="Brand" ng-controller="BrandController">
        @include('admin.layouts.breadcrumb')
        <section class="content-header">
            <a href="{{ url('/admin/brands/create') }}">Go to Brand Create</a>
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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Show?</th>
                                    <th>Ordering</th>
                                    <th>Create At</th>
                                    <th>Delete?</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat='Brand in Brands'>
                                    <td><% Brand.id %></td>
                                    <td><% Brand.title %></td>
                                    <td><img ng-src="{{ URL::asset('<% Brand.image_path %>')}}" class="img-responsive" style="width:250px;"/></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="Brand.show" ng-change="updateBrand(Brand)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="ordering" ng-model="Brand.ordering" onClick="this.setSelectionRange(0, this.value.length)" size="3" ng-change="updateBrand(Brand)">
                                    </td>
                                    <td><% Brand.created_at %></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="4" ng-false-value="1" ng-model="Brand.status" ng-change="deleteBrand(Brand)">
                                    </td>
                                    <td><a href="/admin/brands/<% Brand.id %>">edit</a></td>
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
        var app = angular.module('Brand', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('BrandController', function($scope, $http) {

            $scope.Brands = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/admin/brands/available').
                success(function(data, status, headers, config) {
                    $scope.Brands = data;
                    $scope.loading = false;
                    setTimeout(dataTable, 100);
                });
            }


            $scope.updateBrand = function(Brand) {
                $scope.loading = true;
                $("#success_message").hide().empty();
                $http.post('/admin/brands/' + Brand.id, {
                    status: Brand.status,
                    ordering: Brand.ordering,
                    show: Brand.show,
                }).success(function(data, status, headers, config) {
                    $scope.Brand = data;
                    $scope.loading = false;
                    $("#success_message").append('<p class="alert alert-success"><strong>Update Success!</strong></p>');
                    $("#success_message").show().delay(2000).fadeOut();
                });;
            };

            $scope.deleteBrand = function(Brand) {
                $scope.loading = true;

                $http.post('/admin/brands/' + Brand.id, {
                    status: Brand.status,
                }).success(function(data, status, headers, config) {
                    $scope.Brand = data;
                    $scope.loading = false;
                    location.reload();
                });;
            };

            $scope.init();

        });



    </script>
@stop