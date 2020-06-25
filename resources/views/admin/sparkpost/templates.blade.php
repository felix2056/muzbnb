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
            <a href="{{ route('admin.email.templates.index') }}">Templates</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('assign_template') }}" class="btn btn-primary">Assign Spark Template</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Templates
        <small>Recent Templates</small>
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Templates </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                <tr>
                    <th> ID </th>
                    <th> Email Title </th>
                    <th> Spark Template ID</th>
                    <th>Action </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($sparkTemplate as $key => $template)
                <tr id="trolic-">
                    <td>{{$i++}}</td>
                    <td> {{$template->title}} </td>
                    <td> @if(empty($template->email_spark[0]))
                            Not Assign
                             @else
                            {{$template->email_spark[0]->sparktemplate_id}}
                        @endif
                    </td>
                    <td class="text-center">
                            <span>
                                @if(empty($template->email_spark[0]))
                                    <a href="{{ route('assign_template') }}" class="btn btn-primary">Assign Spark Template</a>
                                @else
                                    <a href="{{route('edit_template',$template->email_spark[0]->emailslist_id)}}" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                @endif
                            </span>
                    </td>
                </tr>
                @endforeach
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
