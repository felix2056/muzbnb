@extends('user.dashboard.layout')

@section('title', 'My Account')

@section('style-top')
    <link href="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <style>
        .user-content {
            padding: 80px 0px !important;
        }
    </style>
@endsection
@section('tabcontent')
    <div class="container-fluid profile my-listing" >
        <div class="container-fluid">
            <div class="mytrip-title">
                <div class="row">
                    @if (Session::get('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @if (Session::get('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Trips</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trips-table table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Booked On</th>
                                <th>Property Name</th>
                                <th>Host</th>
                                <th class="text-left">Dates and Location</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Host Approval</th>
                                <th>Details</th>
                            </tr>
                            @if(count($trips) > 0)
                                @foreach($trips as $trip)
                                    {{--{{ dd($trip) }}--}}
                                  @if(isset($trip->listingInfo))

                                    <tr>
                                        <td>
                                            <p>{{ Carbon\Carbon::parse($trip->created_at)->format('M d, Y')   }}</p>
                                        </td>
                                        <td>
                                            <div class="property-image">
                                                <img src="{{ $trip->listingInfo->showFeaturedImage('s') }}"/>
                                                <span><a href="{{url('')}}/rooms/{{ $trip->listingInfo->id }}">{{ $trip->listingInfo->name }}</a> </span>
                                            </div>

                                        </td>
                                        <td>
                                            <a href="{{ url('')}}/public-profile/{{ $trip->listingInfo->user->id }}"> {{ $trip->listingInfo->user->first_name.' '.$trip->listingInfo->user->last_name }}</a>
                                            {{--<span>{{ $trip->listingInfo->user->first_name.' '.$trip->listingInfo->user->last_name }}</span>--}}
                                        </td>
                                        <td class="text-left">
                                            <p>
                                                {{ Carbon\Carbon::parse($trip->date_from)->format('M d') }} -
                                                {{ Carbon\Carbon::parse($trip->date_to)->format('M d, Y') }}
                                                <span>
                                                    {{ $trip->listingInfo->name }}
                                                </span>
                                                <strong> Booking No: </strong> {{ $trip->id }}
                                                @if($trip->transaction)

                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            {{--@if($trip->transaction)--}}
                                                <p>$ {{ $trip->amount + $trip->service_charges }}</p>
                                            {{--@endif--}}
                                        </td>
                                        <td>
                                            @if($trip->status == 0)
                                                <p class="pending">Pending</p>
                                            @elseif($trip->status == 1)
                                                <span class="pending" style="color:red;">
                                                    {{--<a href="/reservation-status/{{ $trip->id }}" style="color:red;text-decoration: underline;">--}}
                                                        Awaiting <br/> Payment
                                                    {{--</a>--}}
                                                </span>
                                            @elseif($trip->status == 2)
                                                <span class="pending" style="color:green;">
                                                    {{--<a href="/reservation-status/{{ $trip->id }}" style="color:green;text-decoration: underline;">--}}
                                                        Paid
                                                    {{--</a>--}}
                                                </span>
                                            @else
                                                <p class="pending">N/A</p>
                                            @endif
                                            {{--@if($trip->status != 3)--}}
                                                {{--@if($trip->transaction)--}}
                                                    {{--@if($trip->transaction->status == 'hold_pending')--}}
                                                        {{--<p class="pending">Paid</p>--}}
                                                    {{--@endif--}}
                                                {{--@endif--}}
                                            {{--@endif--}}
                                        </td>
                                        <td>
                                            @if($trip->status == 0)
                                                <p>Pending <br/> Confirmation</p>
                                            @elseif($trip->status == 1)
                                                <p>Approved</p>
                                            @elseif($trip->status == 2)
                                                <p>Booked</p>
                                            @else
                                                <p class="pending">N/A</p>
                                            @endif
                                        </td>
                                        <td>
                                            <span>
                                                <a style="color:#FF9C9F;" href="mailto:salaam@muzbnb.com?subject=TRIP ID# {{ $trip->id }}">Report A problem</a>
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="6">No Record Found.</th>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/ui-sweetalert.min.js" type="text/javascript"></script>
    {{--<script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>--}}
    <script type="text/javascript">

        $('.delete-btn').click(function () {
            console.log('come');
            var id = $(this).data('id');
            var book = $(this).data('book');
            swal({
                    title: "Do you want to delete this entry?",
                    text: "Are you sure?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true, },
                function(){
                    setTimeout(function(){
                        ajax_delete(book);
                    }, 2000);
                });
        });

        function ajax_delete(id){
            $.ajax({
                method: 'GET',
                url   : "{{url('')}}/dashboard/cancel/" + id,
                success: function(response){
                    // console.log(response)
                    if(response == 'success'){
                        swal("Deleted!", "Entry Deleted.", "success");
                        $("#listing-" + id).remove();
                    }else{
                        swal("Cancelled", "Please try again.", "error");
                    }
                }
            })
        }


        $('.makepayment').click(function () {
            var id = $(this).data('id');
            swal({
                    title: "Do you want to make payment?",
                    text: "Are you sure?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true, },
                function(){
                    ajax_payment(id);
                });
        });

        function ajax_payment(id){
            $.ajax({
                method: 'POST',
                url   : "{{url('')}}/paid",
                data  : {
                    _token : "{{csrf_token()}}",booking_id:id
                },
                success: function(response){
                    window.location.reload();
                }
            })
        }
    </script>

@endsection