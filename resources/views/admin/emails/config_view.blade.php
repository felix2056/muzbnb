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
            <a href="{{ route('admin.email.config') }}">Config</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('admin.email.config.edit') }}" class="btn btn-primary">Edit Config</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Config
        <small>Recent Config</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Email Config</div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="news_add">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label">From Name</label>
                                <input type="text" class="form-control capital" disabled value="{{$from_name->value}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">From Email</label>
                                <input type="text" class="form-control capital" disabled value="{{$from_email->value}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reply To Name</label>
                                <input type="text" class="form-control capital" disabled value="{{$from_name->value}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reply To Email</label>
                                <input type="text" class="form-control capital" disabled value="{{$from_email->value}}">
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
    <script src="{{url('')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweet-alert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>


@endsection
