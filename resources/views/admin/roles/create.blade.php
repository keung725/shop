@extends('admin.layouts.app')

@section('title', 'Roles Create')

@section('admin_content')

<div class="content-wrapper">

    @include('admin.layouts.breadcrumb')
    <!-- Main content -->
    <section class="content">

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="form" id="dataForm" method="post" action="{{ url('admin/roles/store')}}">
                    <div id="success_message"></div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <div id="name"></div>
                    </div>
                    <div class="form-group">
                        <label>Display Name</label>
                        <input type="display_name" class="form-control" name="display_name" id="display_name">
                        <div id="display_name"></div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description" id="description"></textarea>
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

        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json',
                clearForm: true
            };
            $('#dataForm').ajaxForm(options);

        });
        function showRequest(formData, jqForm, options) {
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
                        $("div#" + index).hide().empty();
                        $("div#" + index).append('<p class="alert-danger"><strong>'+ value +'</strong></p>');
                        $("div#" + index).show().delay(2000).fadeOut();
                    }
                });

            } else {
                var success = response.message;
                $("#success_message").append('<p class="alert alert-success"><strong>'+ success +'</strong></p>');
                $("#success_message").show().delay(2000).fadeOut();
            }
        }
    </script>
@stop