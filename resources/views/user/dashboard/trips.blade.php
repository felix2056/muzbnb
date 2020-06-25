@extends('user.dashboard.layout')

@section('title', 'My Trips')

@section('tabcontent')

    <div class="container-fluid box-width profile" >
        <div class="row">
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h1 class="text-center">My Trips</h1>
                    <hr>
                </div>
            </div>
        </div>
        @foreach($trips as $booking)
            <div class="single-listing" id="listing-{{ $booking->id }}">
                <div class="row">
                    <div class="col-md-4">
                        @if($booking->listingInfo->listingImage)
                            @foreach($booking->listingInfo->listingImage as $images)
                                <img src="{{ $booking->listingInfo->showFeaturedImage('s') }}" alt="..." class="img-thumbnail">
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('room', $booking->listing_id)}}">
                            <h4>{{$booking->listingInfo->name}}</h4>
                        </a>
                        <p style="text-align: left; font-size: medium;">Request Generated on {{ $booking->created_at->format('M d, Y') }}</p>
                        <p style="text-align: left; font-size: medium;">Request Generated on {{ $booking->created_at->format('M d, Y') }}</p>
                        <p style="text-align: left; font-size: medium;">Request Generated on {{ $booking->created_at->format('M d, Y') }}</p>
                        <div class="button use" style="float: left;">
                            @if(auth()->user()->id == $booking->host_id)
                                @if($booking->status == 1)
                                    <label class="btn btn-default">Waiting for Guest Payment</label>
                                @elseif($booking->status == 2)
                                    <label class="btn btn-success btn-lg">Paid</label>
                                @else
                                    <a href="{{route('changestatus', $booking->id) }}" class="btn btn-success btn-lg">Accept</a>
                                    <a href="#" data-id="{{$booking->listingInfo->id}}" class="btn btn-danger btn-lg delete-btn">Cancel</a>
                                @endif
                            @else
                                @if($booking->status == 1)
                                    <a href="{{route('confirmation', $booking->listing_id.'-'.$booking->id) }}" class="btn btn-success btn-lg">Make Payment</a>
                                @elseif($booking->status == 2)
                                    <label class="btn btn-success btn-lg">Booked</label>
                                @else
                                    <a href="#" data-id="{{$booking->listingInfo->id}}" class="btn btn-danger btn-lg delete-btn">Cancel</a>
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