@extends('admin.layout.master')

@section('header_scripts')

    <link href="{{url('public')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
    <ul class="page-breadcrumb col-xs-4">
        <li>
            <a href="javascript:;">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{route('admin.transactions')}}">Transactions</a>
        </li>
    </ul>
@endsection

@section('title')
    <h1 class="page-title"> Transactions
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-exchange"></i>Transactions </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body" style="overflow-x: scroll;">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Place </th>
                    <th> Host </th>
                    <th> Amount </th>
                    <th> Status </th>
                    <th> Transaction ID </th>
                    <th> Refund </th>
                </tr>
                </thead>
                <tbody>
                @if(isset($transactions) && count($transactions) > 0)
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ isset($transaction->id) ? $transaction->id : '' }}</td>
                            <td>
                                @if(isset($transaction->listing))
                                    <a href="{{url('')}}/rooms/{{ $transaction->listing->id }}">{{ $transaction->listing->name }}</a>
                                @endif
                            </td>

                            <td>{{ isset($transaction->user) ? $transaction->user->first_name : '' }}  {{ isset($transaction->user) ? $transaction->user->last_name : '' }} ({{ isset($transaction->user) ? $transaction->user->email : '' }}) </td>
                            <td>{{ isset($transaction->amount) ? $transaction->amount : '' }}</td>
                            <td>
                                @if(isset($transaction->status))
                                    {{ ucwords(str_replace("_", " ", $transaction->status)) }}
                                @endif
                            </td>
                            <td>{{ isset($transaction->transction_id) ?  $transaction->transction_id : '' }}</td>
                            <td>{{ isset($transaction->refund) && $transaction->refund == 1 ? 'True' : 'False' }}</td>
                            {{--<td>--}}
                                {{--<div class="btn-group">--}}
                                    {{--<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions--}}
                                        {{--<i class="fa fa-angle-down"></i>--}}
                                    {{--</button>--}}
                                    {{--<ul class="dropdown-menu pull-left" role="menu" style="left: -110px;">--}}
                                        {{--<li>--}}
                                            {{--<a href="javascript:;" class="row-delete" data-status="">--}}
                                                {{--<i class="glyphicon glyphicon-remove"></i> Refund--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="6">No Record Found.</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <!-- Delete Modal -->
    {{--<div id="confirmDelete" class="modal fade" role="dialog">--}}
    {{--<div class="modal-dialog">--}}
    {{--<!-- Modal content-->--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    {{--<h4 class="modal-title"><span class="dialogue_text">Delete</span> User</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<p>Are you sure, You want to <span class="dialogue_text">Delete</span> this User?</p>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">No</button>--}}
    {{--<button type="button" class="btn btn-danger confirm-delete" data-url="{{route('admin.user.list')}}">Yes</button>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
    <!-- /.box -->
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--setTimeOut(function(){--}}
                {{--$("#custom-alerts").remove();--}}
            {{--}, 3000);--}}
        {{--});--}}
        {{--$(document).on('click', '.deleteBtn', function(){--}}
            {{--var id = $(this).attr('data-id');--}}
            {{--var status = $(this).attr('data-status');--}}
            {{--if(status != ''){--}}
                {{--$(".dialogue_text").html((status == 0) ? 'Banned':'Activate');--}}
            {{--} else {--}}
                {{--$(".dialogue_text").html('Delete');--}}
            {{--}--}}
            {{--$("#confirmDelete").modal('show');--}}
            {{--$("#confirmDelete").find('.confirm-delete').attr('data-id', id);--}}
            {{--$("#confirmDelete").find('.confirm-delete').attr('data-status', status);--}}
        {{--});--}}
        {{--$(document).on('click', '.confirm-delete', function(){--}}
            {{--var id = $(this).attr('data-id');--}}
            {{--var status = $(this).attr('data-status');--}}
            {{--var url = $(this).attr('data-url');--}}
            {{--$.ajax({--}}
                {{--url: '/admin/users/delete/'+id,--}}
                {{--type: 'GET',--}}
                {{--data: {status:status},--}}
                {{--success:function(response){--}}
                    {{--if(response.status){--}}
                        {{--$("#confirmDelete").modal('hide');--}}
                        {{--window.location = ''+url+'';--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}


@endsection
