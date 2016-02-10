@extends('admin.layouts.app')

@section('title', 'Category Create')

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
                    <form class="form" id="upload" enctype="multipart/form-data" method="post" action="{{ url('admin/category/store') }}" autocomplete="off">
                            <div id="success_message"></div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group">
                            <label>Category image</label>
                            <input type="file"  class="form-control" name="image" id="image" />
                            <div id="image"></div>
                        </div>
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <div id="title"></div>
                        </div>
                        <div class="form-group">
                            <label for="levelTwo">Categories Level Two (not a must):</label>
                            <select class="form-control" id="level2" name="level2">
                                <option value="">不適用</option>
                                @foreach($levelOnes as $levelOne)
                                    <option value="{!! $levelOne->id !!}">{!! $levelOne->title !!}</option>
                                @endforeach
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
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json',
                clearForm: true
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