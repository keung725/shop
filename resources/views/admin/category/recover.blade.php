@extends('admin.layouts.app')

@section('title', 'All Recover Categories')

@section('admin_content')
    <div class="content-wrapper" ng-app="Category" ng-controller="CategoryController">
        @include('admin.layouts.breadcrumb')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@yield('title')</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            <table id="dataListingTable" class="table table-bordered table-striped" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Show?</th>
                                    <th>Ordering</th>
                                    <th>Create At</th>
                                    <th>Favor?</th>
                                    <th>Delete?</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat='Category in Categories'>
                                    <td><% Category.id %></td>
                                    <td><% Category.title %></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="Category.show" ng-change="updateCategory(Category)" readonly disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="ordering" ng-model="Category.ordering" onClick="this.setSelectionRange(0, this.value.length)" size="3" ng-change="updateCategory(Category)" readonly>
                                    </td>
                                    <td><% Category.created_at %></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="Category.favor" ng-change="updateCategory(Category)" readonly disabled>
                                    </td>
                                    <td>
                                        <input type="checkbox" ng-true-value="4" ng-false-value="1" ng-model="Category.status" ng-change="updateCategory(Category)">
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
        var app = angular.module('Category', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('CategoryController', function($scope, $http) {

            $scope.Categories = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/admin/category/recovers').
                success(function(data, status, headers, config) {
                    $scope.Categories = data;
                    $scope.loading = false;
                    setTimeout(dataTable, 100);
                });
            }

            $scope.updateCategory = function(Category) {
                $scope.loading = true;

                $http.post('/admin/category/' + Category.id, {
                    status: Category.status,
                    ordering: Category.ordering,
                    show: Category.show,
                    favor: Category.favor,
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