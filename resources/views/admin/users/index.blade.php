@extends('admin.layouts.app')

@section('title', 'All users')

@section('admin_content')
    <div class="content-wrapper">
        @include('admin.layouts.breadcrumb')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@yield('title')</h3>
                        </div><!-- /.box-header -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($users->isEmpty())
                            <p> There is no user.</p>
                        @else
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
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{!! $user->id !!}</td>
                                            <td>{!! $user->name !!}</td>
                                            <td>{!! $user->email !!}</td>
                                            <td>@foreach($user->roles as $role)
                                                    {!! $role->display_name !!} <br/>
                                                @endforeach</td>
                                            <td>{!! $user->created_at !!}</td>
                                            <td><a href="{!! action('Admin\UsersController@edit', $user->id) !!}">edit</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        @endif
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection