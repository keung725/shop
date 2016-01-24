@extends('admin.layouts.app')

@section('title', 'All roles')

@section('admin_content')
<div class="content-wrapper" ng-app="Roles" ng-controller="RolesController">
    @include('admin.layouts.breadcrumb')
    <section class="content-header">
        <a href="{{ url('/admin/roles/create') }}">Go to Roles Create</a>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@yield('title')</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataListingTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='Role in Roles'>
                                    <td><% Role.id %></td>
                                    <td><% Role.name %></td>
                                    <td><% Role.display_name %></td>
                                    <td><% Role.description %></td>
                                    <td><a href="/admin/roles/<% Role.id %>">edit</a></td>
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
        var app = angular.module('Roles', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('RolesController', function($scope, $http) {

            $scope.Roles = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/api/roles').
                success(function(data, status, headers, config) {
                    $scope.Roles = data;
                    $scope.loading = false;
                    setTimeout(dataTable, 100);
                });
            }

            $scope.init();

        });



    </script>
@stop