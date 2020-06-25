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
                <a href="{{ route('admin.email.config') }}" class="btn btn-primary">Config</a>
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
                    <form method="post" action="{{ route('admin.email.config.update') }}" id="news_add">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label">From Name</label>
                                <input type="text" name="from_name" class="form-control capital"  value="{{$from_name->value}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">From Email</label>
                                <input type="email" name="from_email" class="form-control capital"  value="{{$from_email->value}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reply To Name</label>
                                <input type="text"  class="form-control capital"  value="{{$from_name->value}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reply To Email</label>
                                <input type="email"  class="form-control capital"  value="{{$from_email->value}}">
                            </div>

                            <div class="form-actions">
                                <div class="btn-set pull-left">
                                    <button type="submit" class="btn green">Update</button>
                                </div>
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
