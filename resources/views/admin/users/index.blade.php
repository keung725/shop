@extends('admin.layouts.app')

@section('title', 'All users')

@section('admin_content')
    <div class="content-wrapper" ng-app="Users" ng-controller="UsersController">
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
                                <table id="dataListingTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Create At</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat='User in Users'>
                                            <td><% User.id %></td>
                                            <td><% User.name %></td>
                                            <td><% User.email %></td>
                                            <td>
                                                <div ng-repeat="Roles in User.roles">
                                                    <% Roles.display_name %> <br/>
                                                </div>
                                            </td>
                                            <td><% User.created_at %></td>
                                            <td><a href="/admin/users/<% User.id %>">edit</a></td>
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
        var app = angular.module('Users', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('UsersController', function($scope, $http) {

            $scope.Users = [];
            $scope.loading = false;

            $scope.init = function() {
                $scope.loading = true;
                $http.get('/api/users').
                success(function(data, status, headers, config) {
                    $scope.Users = data;
                    $scope.loading = false;
                    setTimeout(dataTable, 100);
                });
            }

            $scope.init();

        });



    </script>
@stop