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
            <a href="{{url('')}}/admin/currency">Add Currency</a>
        </li>
    </ul>
@endsection

@section('title')
    <h1 class="page-title">
        Add Currency
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Currency </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($currency, ['route' => ['currency.store']]) !!}

            <div class="form-group">
                <label >Name</label>
                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=> 'Name']) !!}
            </div>
            <div class="form-group">
                <label >Short Name</label>
                {!! Form::text('short_name', null, ['class'=>'form-control', 'placeholder'=> 'Name']) !!}
            </div>
            <div class="form-group">
                <label >Symbol</label>
                {!! Form::text('symbol', null, ['class'=>'form-control', 'placeholder'=> 'Name']) !!}
            </div>
            <div class="form-action">
                {!! Form::submit('Create', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    <script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
@endsection
