@extends('admin.layout.master')


@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Emails</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('assign_template') }}">Update Template</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('assign_template') }}" class="btn btn-primary">Assign Template</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Templates
        <small>Assign Template</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Assign Template </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('save_template') }}" id="news_add" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label">Spark Template ID</label>
                                <select class="form-control capital" name="sparktemplate_id">
                                    @foreach($sparkData as $Template)
                                        <option value="{{ $Template->id }}"> {{ $Template->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Emails Name</label>
                                <select class="form-control capital" name="emailslist_id">
                                    @foreach($emailname as $email)
                                        <option value="{{ $email->id }}"> {{ $email->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn-set pull-left">
                                <button type="submit" class="btn green">Assign</button>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ url('vendor') }}/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '{{ url('') }}/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '{{ url('') }}/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url('') }}/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '{{ url('') }}/laravel-filemanager/upload?type=Files&_token=',
            allowedContent: true
        };
        CKEDITOR.replace( 'description', options );
    </script>

@endsection
