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
            <a href="{{route('admin.bookings')}}">Bookings</a>
        </li>
    </ul>
@endsection

@section('title')
    <h1 class="page-title"> Bookings
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>Bookings </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body" style="overflow-x: scroll;">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Place </th>
                    <th> Guest </th>
                    <th> No. of Guests </th>
                    <th> Host </th>
                    <th> Booking From </th>
                    <th> Booking To </th>
                    <th> Amount </th>
                    <th> Status </th>
                    <th> Transaction ID </th>
                    <th> Actions </th>
                </tr>
                </thead>
                <tbody>
                @if(isset($bookings) && count($bookings) > 0)
                    @foreach($bookings as $booking)
                        @if(isset($booking->guestInfo) && $booking->guestInfo != null && isset($booking->hostInfo) && $booking->hostInfo != null && isset($booking->listing) && $booking->listing != null)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>
                                <a href="{{url('')}}/rooms/{{ $booking->listing->id }}">{{ $booking->listing->name }}</a>
                            </td>
                            <td>{{ $booking->guestInfo->first_name . ' ' . $booking->guestInfo->last_name }} ({{ $booking->guestInfo->email }}) </td>
                            <td>{{ $booking->number_of_guest }}</td>
                            <td>{{ $booking->hostInfo->first_name . ' ' . $booking->hostInfo->last_name }} ({{ $booking->hostInfo->email }}) </td>
                            <td>{{ $booking->date_from }}</td>
                            <td>{{ $booking->date_to }}</td>
                            <td>{{ $booking->amount + $booking->service_charges }}</td>
                            <td>
                                @if($booking->status == 1)
                                    <p class="success">Accepted</p>
                                @elseif($booking->status == 0)
                                    <p class="cancel">Pending</p>
                                @elseif($booking->status == 2)
                                    <p class="cancel">Released</p>
                                @elseif($booking->status == 3)
                                    <p class="cancel">Cancelled</p>
                                @elseif($booking->status == 4)
                                    <p class="cancel">Refunded</p>
                                @endif
                            </td>
                            <td>{{ isset($booking->transaction) ? $booking->transaction->transction_id : '' }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-left" role="menu" style="left: -110px;">
                                        @if((int)$booking->status==0 )
                                            <li>
                                                <a href="javascript:;" class="row-delete cancelBtn" data-bookingid="{{ $booking->id }}">
                                                    <i class="glyphicon glyphicon-remove"></i> Cancel
                                                </a>
                                            </li>
                                        @elseif( (int)$booking->status!=4 &&  (int)$booking->status!=3)
                                            @if((int)$booking->status!=2)
                                                <li>
                                                    <a href="javascript:;" class="row-delete releaseBtn" data-bookingid="{{ $booking->id }}" data-id="{{ isset($booking->transaction) ? $booking->transaction->transction_id : '' }}" data-hostid="{{ $booking->hostInfo->id }}" data-amount="{{ $booking->amount + $booking->service_charges }}" >
                                                        <i class="glyphicon glyphicon-ok"></i> Release
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="javascript:;" class="row-delete refundBtn" data-bookingid="{{ $booking->id }}" data-id="{{ isset($booking->transaction) ? $booking->transaction->transction_id : '' }}" data-amount="{{ $booking->amount + $booking->service_charges }}" >
                                                    <i class="glyphicon glyphicon-ban-circle"></i> Refund
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                Transaction already refunded or cancelled!
                                            </li>
                                        @endif
                                        {{--<li>--}}
                                            {{--<a href="javascript:;" class="row-delete" data-id="{{ isset($booking->transaction) ? $booking->transaction->transction_id : '' }}" >--}}
                                                {{--<i class="glyphicon glyphicon-remove"></i> Terminate--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <th colspan="10">No Record Found.</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <!-- Release Modal -->
        <div id="releaseModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="dialogue_text">Release </span>Booking Funds</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure, You want to <span class="dialogue_text">Release $<span id="bookingAmount"></span></span> to Host?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger confirm-release" >Yes</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box -->

        <!-- Terminate Modal -->
        <div id="cancelModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="dialogue_text">Cancel </span>Booking</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure, You want to <span class="dialogue_text">Cancel</span> this Booking?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger confirm-cancel" >Yes</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box -->

        <!-- Refund Modal -->
        <div id="refund" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="dialogue_text">Refund</span> Booking</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure, You want to <span class="dialogue_text">Refund</span> this Booking?</p>
                        {{--<div class="form-group">--}}
                            {{--<label >Amount to Refund:</label>--}}
                            {{--{!! Form::number('refundAmount', null, ['class'=>'form-control refundBookingAmount', 'placeholder'=> 'Amount', 'required'=>'required']) !!}--}}
                        {{--</div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger confirm-refund" >Yes</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box -->

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    {{--<script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>--}}

    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--setTimeout(function(){--}}
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

    <script  type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                $("#custom-alerts").remove();
            }, 3000);
        });
        $(document).on('click', '.releaseBtn', function(){
            var id = $(this).attr('data-id');
            var bookingid = $(this).attr('data-bookingid');
            var hostId = $(this).attr('data-hostid');
            var amount = $(this).attr('data-amount');

            if(hostId != '') {
                $("#releaseModal").modal('show');
                $("#releaseModal").find('#bookingAmount').html(amount);
                $("#releaseModal").find('.confirm-release').attr('data-hostid', hostId);
                $("#releaseModal").find('.confirm-release').attr('data-bookingid', bookingid);
                $("#releaseModal").find('.confirm-release').attr('data-amount', amount);
//                $("#refund").find('.confirm-refund').attr('data-type', 'refund');
            } else {
//                $("#refund").modal('show');
//                $("#refund").find('.confirm-refund').attr('data-bookingid', bookingid);
//                $("#refund").find('.confirm-refund').attr('data-type', 'cancel');
                alert('Incorrect Host Id!');
                $("#releaseModal").modal('hide');
            }
        });

        $(document).on('click', '.refundBtn', function(){
            var id = $(this).attr('data-id');
            var bookingid = $(this).attr('data-bookingid');
            var amount = $(this).attr('data-amount');

            if(id != '') {
                $("#refund").modal('show');
                $("#refund").find('.confirm-refund').attr('data-id', id);
                $("#refund").find('.confirm-refund').attr('data-amount', amount);
//                $("#refund").find('.confirm-refund').attr('data-type', 'refund');
            } else {
//                $("#refund").modal('show');
//                $("#refund").find('.confirm-refund').attr('data-bookingid', bookingid);
//                $("#refund").find('.confirm-refund').attr('data-type', 'cancel');
                alert('Incorrect Transaction Id!');
                $("#refund").modal('hide');
            }
        });

        $(document).on('click', '.cancelBtn', function(){
            var bookingid = $(this).attr('data-bookingid');
            $("#cancelModal").modal('show');
            $("#cancelModal").find('.confirm-cancel').attr('data-bookingid', bookingid);
        });

        $(document).on('click', '.confirm-refund', function(e){
            e.preventDefault();

            var id = $(this).attr('data-id');
            var amount = $(this).attr('data-amount');
//            var enteredAmount = $('.refundBookingAmount').val();
//            if(enteredAmount > amount)  {
//                alert('Amount to refund cannot be greater than transaction amount!');
//                return false;
//            }
            $.ajax({
                url: '/admin/bookings/refund',
                type: 'POST',
                data: {'_token':'{{ csrf_token() }}', id:id, amount:amount},
                success:function(response){
//                    console.log(response);
                    if(response.status == 'success'){
                        $("#refund").modal('hide');
                        alert(response.msg);
                    } else {
                        $("#refund").modal('hide');
                        alert(response.msg);
                        window.location.reload();
                    }
                }
            });
        });

        $(document).on('click', '.confirm-cancel', function (e) {
            e.preventDefault();
            var bookingid = $(this).attr('data-bookingid');
            $.ajax({
                url : "/admin/bookings/cancel",
                type : 'POST',
                data: {'_token': '{{ csrf_token() }}', id:bookingid},
                success: function(response){
                    if(response.status == 'success'){
                        alert(response.msg);
                        location.reload();
                    }else{
                        alert(response.msg);
                    }
                },
                error: function (err) {
                    alert(err.msg);
                }
            });
        });

        $(document).on('click', '.confirm-release', function(e){
            e.preventDefault();

            var hostid = $(this).attr('data-hostid');
            var bookingid = $(this).attr('data-bookingid');
            var amount = $(this).attr('data-amount');
            $.ajax({
                url: '/admin/bookings/release',
                type: 'POST',
                data: {'_token':'{{ csrf_token() }}', bookingid:bookingid, hostid:hostid, amount:amount},
                success:function(response){
//                    console.log(response);
                    if(response.status == 'success'){
                        $("#releaseModal").modal('hide');
                        alert(response.msg);
                    } else {
                        $("#releaseModal").modal('hide');
                        alert(response.msg);
                        window.location.reload();
                    }
                }
            });
        });

    </script>


@endsection
