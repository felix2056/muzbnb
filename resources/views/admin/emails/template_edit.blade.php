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
            <a href="{{ route('admin.email.templates.index') }}">Templates</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('admin.email.templates.index') }}" class="btn btn-primary">Templates</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Templates
        <small>Recent Update Template</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Update Template </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.email.templates.update',$template->id) }}" id="news_add" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" name="name" class="form-control capital" placeholder="Enter Name Here..." value="{{!empty(old('name')) ? old('name') : $template->name}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Subject</label>
                                <input type="text" name="subject" class="form-control capital" placeholder="Enter Subject Here..." value="{{!empty(old('subject')) ? old('subject') : $template->subject}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <textarea id="description" name="description" class="form-control" rows="10">{{!empty(old('description')) ? old('description') : $template->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Macros</label>
                                <input type="text" name="macros" class="form-control capital" placeholder="Enter Mecros Here..." value="{{!empty(old('macros')) ? old('macros') : $template->macros}}">
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="btn-set pull-left">
                                <button type="submit" class="btn green">Update</button>
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
