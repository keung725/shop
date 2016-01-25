@extends('admin.layouts.app')

@section('title', 'Users Edit')

@section('admin_content')

    <div class="content-wrapper" ng-app="Users" ng-controller="UsersController" ng-init="showUsers({{$user->id}})">

        @include('admin.layouts.breadcrumb')
                <!-- Main content -->
        <section class="content">

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">@yield('title')</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form class="form" id="dataForm" method="post" action="{{ url('admin/users/'.$user->id)}}">
                        <div id="validation-errors"></div>
                        <div id="success_message"></div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" ng-model="Users.name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" ng-model="Users.email"  disabled>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" id="role" name="role[]" multiple>
                                <option ng-repeat="Roles in Users.roles" value="<% Roles.id %>"
                                        ng-selected="<% Roles.selected %>"><% Roles.display_name %>
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section>
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

            $scope.showUsers = function(id) {
                $scope.loading = true;
                $http.get('/api/users/'+ id ).
                success(function(data, status, headers, config) {
                    //console.log(data);
                    $scope.Users = data;
                    $scope.loading = false;

                });
            }

        });

        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#dataForm').ajaxForm(options);

        });
        function showRequest(formData, jqForm, options) {
            $("#validation-errors").hide().empty();
            $("#success_message").hide().empty();
            return true;
        }
        function showResponse(response, statusText, xhr, $form)  {

            if(response.success == false)
            {
                var error = response.errors;
                $.each(error, function(index, value)
                {
                    if (value.length != 0)
                    {
                        $("#validation-errors").append('<p class="alert alert-danger"><strong>'+ value +'</strong></p>');
                        $("#validation-errors").show().delay(2000).fadeOut();
                    }
                });
                $("#validation-errors").show();
            } else {
                var success = response.message;
                $("#success_message").append('<p class="alert alert-success"><strong>'+ success +'</strong></p>');
                $("#success_message").show().delay(2000).fadeOut();
            }
        }



    </script>
@stop