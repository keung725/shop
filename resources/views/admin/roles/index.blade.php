@extends('admin.layouts.app')

@section('title', 'All roles')

@section('admin_content')
<div class="content-wrapper">
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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($roles->isEmpty())
                        <p> There is no role.</p>
                    @else
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
                            @foreach($roles as $role)
                                <tr>
                                    <td>{!! $role->id !!}</td>
                                    <td>{!! $role->name !!}</td>
                                    <td>{!! $role->display_name !!}</td>
                                    <td>{!! $role->description !!}</td>
                                    <td><a href="{!! action('Admin\RolesController@edit', $role->id) !!}">edit</a></td>
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