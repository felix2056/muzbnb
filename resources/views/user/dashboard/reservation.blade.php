@extends('user.dashboard.layout')

@section('title', 'My Account')

@section('style-top')
    <link href="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <style>
        @media (max-width:1280px) {
            .reserv-text.guestNameText p {
                text-align: center !important;
            }
            .reserv-text {
                float: none !important;
                width: auto;

            }
            .reserv-image {
                float: none !important;

            }
        }
        .user-content {
            padding: 80px 0px !important;
        }
        .reserv-image{
            float:none !important;
        }
    </style>

@endsection
@section('tabcontent')

    <div class="container-fluid profile my-listing" >
        <div class="container-fluid">
            <div class="reservation-title">
                <div class="row">
                    @if (Session::get('error'))
                        <div class="alert alert-danger">{!! Session::get('error') !!}</div>
                    @endif
                    @if (Session::get('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Reservations</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="left-menu">
                                <a href="{{ route('my-listings') }}">
                                    <h3>My Listings</h3>
                                </a>
                                <a href="" class="active">
                                    <h3>My Reservations</h3>
                                </a>
                                <a href="{{route('add-listing')}}" class="red">
                                    <h3>
                                        Add New Listings
                                    </h3>
                                </a>
                            </div>
                            <div class="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="reservation-detail">

                                <div class="trips-table table-responsive transaction-table">
                                    <table class="table table-striped reservation-widget">
                                        <tr>
                                            <th>Status</th>
                                            <th>Date and Location</th>
                                            <th style="text-align: center;">Guest</th>
                                            <th>Details</th>
                                        </tr>
                                        @if(count($reservations) > 0)
                                            @foreach($reservations as $reservation)
                                                {{--{{ dd($reservation) }}--}}
                                                <tr>
                                                    <td>
                                                        @if($reservation->status == 1 )
                                                            <p class="success">Accepted</p>
                                                        @elseif($reservation->status == 2)
                                                            <p class="success">Booked</p>
                                                        @elseif($reservation->status == 0)
                                                            {{--<p class="cancel">Pending</p>--}}
                                                            <a href="/dashboard/changestatus/{{ $reservation->id }}/{{ $reservation->card_id }}" class="btn btn-success btn-sm">Accept</a>
                                                            <a href="#" data-id="{{$reservation->listingInfo->id}}" data-book="{{ $reservation->id }}" class="btn btn-danger btn-sm delete-btn">Cancel</a>
                                                        @elseif($reservation->status == 4)
                                                            <p class="pending">Refunded</p>
                                                        @else
                                                            <p    class="pending">Cancelled</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ Carbon\Carbon::parse($reservation->date_from)->format('M d') }} -
                                                            {{ Carbon\Carbon::parse($reservation->date_to)->format('M d, Y') }}
                                                            <span>
                                                                <a href="{{url('')}}/rooms/{{ $reservation->listingInfo->id }}">{{ $reservation->listingInfo->name }} in
                                                                    {{ $reservation->listingInfo->address1 }}</a>
                                                            </span>
                                                            {{ $reservation->listingInfo->address2 }}
                                                            @if($reservation->listingInfo->address2)
                                                                <br>
                                                            @endif
                                                            {{ $reservation->listingInfo->state }}, {{ $reservation->listingInfo->city }}
                                                            <br>
                                                            <strong> Booking No: </strong> {{ $reservation->id }}
                                                        </p>

                                                    </td>
                                                    <td>
                                                        <div class="reserv-image">
                                                            <img src="{{ URL('/images/user/'.$reservation->guestInfo->profile->avatar) }}"/>
                                                        </div>
                                                        <div class="reserv-text guestNameText">
                                                            <p>
                                                                <a href="{{ url('')}}/public-profile/{{ $reservation->guestInfo->id }}"> {{ $reservation->guestInfo->first_name.' '.$reservation->guestInfo->last_name }}</a>
                                                                <br>
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li><a href="#" class="viewDetail">View Detail</a></li>
                                                            {{--<li><a href="#">Change or Cancel</a></li>--}}
                                                            <li><a href="mailto:salaam@muzbnb.com?subject=BOOKING ID# {{ $reservation->id }}">Report A problem</a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th colspan="3">No Record Found.</th>
                                            </tr>
                                        @endif
                                    </table>
                                </div>

                            </div>
                        </div>
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
                    title: "Do you want to cancel this reservation?",
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
                    console.log(response)
                    response = JSON.parse(response);
                    if(response){
                        swal("Deleted!", "Entry Deleted.", "success");
                        location.reload();
                    }else{
                        swal("Cancelled", "Please try again.", "error");
                    }
                }
            })
        }

        $('.viewDetail').click(function () {
            var id = $(this).data('id');
            var book = $(this).data('book');
            swal({
                    title: "This page is under construction",
                    text: "Please wait for the next release",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true, },
                function(){

                });
        });
    </script>
@endsection