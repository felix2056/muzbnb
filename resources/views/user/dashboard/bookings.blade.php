@extends('user.dashboard.layout')

@section('title', 'Bookings Request')

@section('tabcontent')

    <div class="container-fluid box-width profile" >
        <div class="row">
            @if (Session::get('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h1 class="text-center">Bookings</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="reservation-detail">

                                <div class="trips-table table-responsive transaction-table">
                                    <table class="table table-striped reservation-widget">
                                        <tr>
                                            <th>Status</th>
                                            <th>Date and Location</th>
                                            <th>Guest</th>
                                            <th>Details</th>
                                        </tr>
                                        @if($bookings)
                                            @foreach($bookings as $booking)
                                                {{--{{ dd($booking) }}--}}
                                                <tr>
                                                    <td>
                                                        @if($booking->status == 1)
                                                            <p class="success">Accepted</p>
                                                        @elseif($booking->status == 0)
                                                            <p class="cancel">Pending</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ Carbon\Carbon::parse($booking->date_from)->format('M d') }} -
                                                            {{ Carbon\Carbon::parse($booking->date_to)->format('M d, Y') }}
                                                            <span>
                                                            {{ $booking->listingInfo->name }} in
                                                                {{ $booking->listingInfo->address1 }}
                                                        </span>
                                                            {{ $booking->listingInfo->address2 }}
                                                            @if($booking->listingInfo->address2)
                                                                <br>
                                                            @endif
                                                            {{ $booking->listingInfo->state }}, {{ $booking->listingInfo->city }}
                                                        </p>

                                                    </td>
                                                    <td>
                                                        <div class="reserv-image">
                                                            <img src="{{ URL('/images/user/'.$booking->guestInfo->profile->avatar) }}"/>
                                                        </div>
                                                        <div class="reserv-text">
                                                            <p>
                                                                {{ $booking->guestInfo->first_name.' '.$booking->guestInfo->last_name }}<br>
                                                                {{ $booking->listingInfo->address1 }}
                                                                <span>{{ $booking->listingInfo->name }}</span>
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($booking->transaction)
                                                            <p class="price">${{ $booking->transaction->amount }} total</p>
                                                        @endif
                                                        <ul>
                                                            <li><a href="#">Print Confirmation</a></li>
                                                            <li><a href="#">Change or Cancel</a></li>
                                                            <li><a href="#">Report A problem</a></li>
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
        @foreach($bookings as $booking)
            <div class="single-listing" id="listing-{{ $booking->id }}">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $booking->listingInfo->showFeaturedImage('s') }}" alt="..." class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('room', $booking->listing_id)}}">
                            <h4>{{$booking->listingInfo->name}}</h4>
                        </a>
                        <p style="text-align: left; font-size: medium;">Request Generated on {{ $booking->created_at->format('M d, Y') }}</p>
                        <p style="text-align: left; font-size: medium;">Request Generated on {{ $booking->created_at->format('M d, Y') }}</p>
                        <p style="text-align: left; font-size: medium;">Request Generated on {{ $booking->created_at->format('M d, Y') }}</p>
                        <div class="button use">
                            @if(auth()->user()->id == $booking->host_id)
                                @if($booking->status == 1)
                                    <label class="btn btn-default">Waiting for Guest Payment</label>
                                @elseif($booking->status == 2)
                                    <label class="btn btn-success btn-lg">Paid</label>
                                @else
                                    <a href="{{route('changestatus', $booking->id) }}" class="btn btn-success btn-lg">Accept</a>
                                    <a href="{{route('cancelbooking', $booking->id) }}" data-id="{{$booking->listingInfo->id}}" class="btn btn-danger btn-lg delete-btn">Cancel</a>
                                @endif
                            @else
                                @if($booking->status == 1)
                                    <a href="{{route('confirmation', $booking->listing_id.'-'.$booking->id) }}" class="btn btn-success btn-lg">Make Payment</a>
                                @elseif($booking->status == 2)
                                    <label class="btn btn-success btn-lg">Booked</label>
                                @else
                                    <a href="{{route('cancelbooking', $booking->id) }}" data-id="{{$booking->listingInfo->id}}" class="btn btn-danger btn-lg delete-btn">Cancel</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection



@section('scripts')

@endsection