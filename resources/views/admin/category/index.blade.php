@extends('admin.layouts.app')

@section('title', 'All Categories')

@section('admin_content')
    <div class="content-wrapper" ng-app="Category" ng-controller="CategoryController">
        @include('admin.layouts.breadcrumb')
        <section class="content-header">
            <a href="{{ url('/admin/category/create') }}">Go to CategoryCreate</a>
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
                                    <th>Under Level1</th>
                                    <th>Title</th>
                                    <th>Show?</th>
                                    <th>Ordering</th>
                                    <th>Create At</th>
                                    <th>Favor?</th>
                                    <th>Delete?</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat='Category in Categories'>
                                    <td><% Category.id %></td>

                                    <td><% Category.parent_title %></td>

                                    <td><% Category.title %></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="Category.show" ng-change="updateCategory(Category)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="ordering" ng-model="Category.ordering" onClick="this.setSelectionRange(0, this.value.length)" size="3" ng-change="updateCategory(Category)">
                                    </td>
                                    <td><% Category.created_at %></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="Category.favor" ng-change="updateCategory(Category)">
                                    </td>
                                    <td>
                                        <input type="checkbox" ng-true-value="4" ng-false-value="1" ng-model="Category.status" ng-change="deleteCategory(Category)">
                                    </td>
                                    <td><a href="/admin/category/<% Category.id %>">edit</a></td>
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
        var app = angular.module('Category', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('CategoryController', function($scope, $http) {

            $scope.Categories = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/admin/category/available').
                success(function(data, status, headers, config) {
                    $scope.Categories = data;
                    $scope.loading = false;
                    setTimeout(dataTable, 100);
                });
            }


            $scope.updateCategory = function(Category) {
                $scope.loading = true;
                $("#success_message").hide().empty();
                $http.post('/admin/category/' + Category.id, {
                    status: Category.status,
                    ordering: Category.ordering,
                    show: Category.show,
                    favor: Category.favor,
                }).success(function(data, status, headers, config) {
                    $scope.Category = data;
                    $scope.loading = false;
                    $("#success_message").append('<p class="alert alert-success"><strong>Update Success!</strong></p>');
                    $("#success_message").show().delay(2000).fadeOut();
                });;
            };

            $scope.deleteCategory= function(Category) {
                $scope.loading = true;

                $http.post('/admin/category/' + Category.id, {
                    status: Category.status,
                }).success(function(data, status, headers, config) {
                    $scope.Category = data;
                    $scope.loading = false;
                    location.reload();
                });;
            };

            $scope.init();

        });



    </script>
@stop