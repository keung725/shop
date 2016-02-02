@extends('admin.layouts.app')

@section('title', 'Home Banner Edit')

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
                    <form class="form" id="upload" enctype="multipart/form-data" method="post" action="{{ url('admin/homebanners/'.$HomeBanner->id)}}" autocomplete="off">
                        <div id="validation-errors"></div>
                        <div id="success_message"></div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group">
                            <label>Home Banner</label>
                            <img id="image_banner" src="{{ URL::asset($HomeBanner->image_path)}}" class="img-responsive" style="width:250px;"/>
                            <input type="file"  class="form-control" name="image" id="image" />
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{!! $HomeBanner->title !!}">
                        </div>
                        <div class="form-group">
                            <label>Link Path</label>
                            <input type="text" class="form-control" id="link_path" name="link_path" value="{!! $HomeBanner->link_path !!}">
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
                dataType: 'json'
            };
            $('#upload').ajaxForm(options);

        });
        function showRequest(formData, jqForm, options) {
            $("#validation-errors").hide().empty();
            $("#success_message").hide().empty();
            $("#output").css('display','none');
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
                    }
                });
                $("#validation-errors").show().delay(2000).fadeOut();
            } else {
                var success = response.message;
                var image_location = response.file;

                $("#image_banner").attr("src", image_location);
                $("#success_message").append('<p class="alert alert-success"><strong>'+ success +'</strong></p>');
                $("#success_message").show().delay(2000).fadeOut();
            }
        }
    </script>
@stop