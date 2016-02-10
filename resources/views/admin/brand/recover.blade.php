@extends('admin.layouts.app')

@section('title', 'All Recover Brand')

@section('admin_content')
    <div class="content-wrapper" ng-app="Brand" ng-controller="BrandController">
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
                                    <th>Image</th>
                                    <th>Show?</th>
                                    <th>Ordering</th>
                                    <th>Create At</th>
                                    <th>Delete?</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat='Brand in Brands'>
                                    <td><% Brand.id %></td>
                                    <td><% Brand.title %></td>
                                    <td><img ng-src="{{ URL::asset('<% Brand.image_path %>')}}" class="img-responsive" style="width:250px;"/></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="1" ng-false-value="'0'" ng-model="Brand.show" ng-change="updateBrand(Brand)" readonly disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="ordering" ng-model="Brand.ordering" onClick="this.setSelectionRange(0, this.value.length)" size="3" ng-change="updateBrand(Brand)" readonly>
                                    </td>
                                    <td><% Brand.created_at %></td>
                                    <td>
                                        <input type="checkbox" ng-true-value="4" ng-false-value="1" ng-model="Brand.status" ng-change="updateBrand(Brand)">
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
        var app = angular.module('Brand', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('BrandController', function($scope, $http) {

            $scope.Brands = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/admin/brands/recovers').
                success(function(data, status, headers, config) {
                    $scope.Brands = data;
                    $scope.loading = false;
                    setTimeout(dataTable, 100);
                });
            }

            $scope.updateBrand = function(Brand) {
                $scope.loading = true;

                $http.post('/admin/brands/' + Brand.id, {
                    status: Brand.status,
                    ordering: Brand.ordering,
                    show: Brand.show,
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