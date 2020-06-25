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
            <a href="{{ route('admin.email.campaigns.index') }}">Campaigns</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('admin.email.campaigns.index') }}" class="btn btn-primary">Campaigns</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Campaigns
        <small>Recent Campaign</small>
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Campaign </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <tbody>
                    <tr>
                        <td>Title:</td>
                        <td>{{$campaign->title}}</td>
                    </tr>
                    <tr>
                        <td>Email Name:</td>
                        <td>{{$campaign->email->name}}</td>
                    </tr>
                    <tr>
                        <td>Email Subject:</td>
                        <td>{{$campaign->email->subject}}</td>
                    </tr>
                    <tr>
                        <td>Email Description:</td>
                        <td>{!! $campaign->email->description !!}</td>
                    </tr>
                    <tr>
                        <td>Email Macros:</td>
                        <td>{{ $campaign->email->macros }}</td>
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
