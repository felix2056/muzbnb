@extends('admin.layout.master')

@section('header_scripts')

    <link href="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
@endsection

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
            <a href="{{ route('admin.email.templates.index') }}">Template</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('admin.email.templates.edit',$template->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Templates
        <small>Recent View Templates</small>
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Template </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <tbody>
                <tr>
                    <td>Name:</td>
                    <td>{{ $template->name }}</td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td>{{$template->subject}}</td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><iframe src="{{ route('admin.email.raw', $template->id) }}" width="800" height="800"></iframe></td>
                    {{--<td>{!! $template->description !!}</td>--}}
                </tr>
                <tr>
                    <td>Macros:</td>
                    <td>{{$template->macros}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    <script src="{{url('')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweet-alert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>


@endsection
