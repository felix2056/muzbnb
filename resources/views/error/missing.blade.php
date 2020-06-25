@extends('layouts.master')

@section('content')
    <?php
    if(auth()->id()) {
        $listingUrl = route('add-listing');
    } else {
        $listingUrl = "javascript:loginTo('" . route('add-listing') . "')";
    }
    ?>
    <div class="container error-page">
        <div class="row">
            <div class="col-md-6">
                <h1 class="extra-bold">Sorry!</h1>
                <h3>
                    "You seem to have the wrong page" replied the Hodja.
                </h3>
                <p>Error code: 404</p>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2 hidden-md hidden-lg">
                        <img src="/style/assets/img/NASREDDIN-HODJA.jpg" class="img-responsive" />
                    </div>
                </div>
                <p>Try these helpful links instead, my friend:</p>
                <p><a href="/">Home</a> </p>
                <p><a href="{{$listingUrl}}">Become a Host</a> </p>
                <p><a href="/blog">Blog</a> </p>
                <p><a href="/ambassadors">Ambassadors</a> </p>
                {{--<p><a href="/invite">Invite Friends</a> </p>--}}
            </div>
            <div class="col-sm-6 hidden-xs hidden-sm">
                <div class="col-xs-8 col-xs-offset-2">
                    <img src="/style/assets/img/NASREDDIN-HODJA.jpg" class="img-responsive" />
                </div>
            </div>
        </div>
    </div>
@endsection