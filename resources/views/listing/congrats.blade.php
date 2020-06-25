@extends('layouts.master')

@section('title', 'Congrats')

@section('content')
    <!-- Slick -->
    {{--<link rel="stylesheet" href="{{ URL::asset('css/slick.css') }}">--}}
    <!-- Custom -->
    {{--<link rel="stylesheet" href="{{ asset('css/style-ethics.css') }}">--}}
    <!-- Mobile -->
    {{--<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">--}}
    @php
        $socialShareText = 'Hey, I just listed my home on Muzbnb! Please check it out! :) ';
        $url = \URL::to('/') . '/rooms/' . $listing->id;
        $socialShareText = $socialShareText . $url;
    @endphp

    <section class="page-cotnent congrats-page">
        <div class="congrats-section">
            <div class="container" style="padding: 1% 0%;">
                <div class="congrats-popup">
                    <div class="congrats-popup-top">
                        <div class="congrats-right-img">
                            <img class="congrats-right-mark" src="{{ asset('images/congrats-right-mark.png') }}">
                            <img class="congrats-place-img" src="{{ $listing->showFeaturedImage('m') }}">
                            <img class="congrats-user-img" src="{{ $listing->user->profile->getPhoto() }}">
                        </div>
                        <div class="congrats-popup-info">
                            <h2>Congrats!</h2>
                            <div class="congrats-popup-home">
                                <img src="{{ asset('images/congrats-house-icon.svg') }}">
                                <h6>Your listing is now live and ready to be booked!</h6>
                            </div>
                            <p>Share your listing to get more reservations, or make changes via <a href="/dashboard/listings">my listings</a> in the dashboard.</p>
                            <div class="congrats-popup-icon">
                                <span>share</span>
                                <ul>
                                    {{--<li>--}}

                                        {{--<a class="twitter-share-button"--}}
                                           {{--href="https://twitter.com/share"--}}
                                           {{--data-size="large"--}}
                                           {{--data-text="custom share text"--}}
                                           {{--data-url="https://dev.twitter.com/web/tweet-button"--}}
                                           {{--data-hashtags="example,demo"--}}
                                           {{--data-via="twitterdev"--}}
                                           {{--data-related="twitterapi,twitter">--}}
                                            {{--Tweet--}}
                                        {{--</a>--}}

                                    {{--</li>--}}

                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank">
                                            <img src="{{ asset('images/congrats-facebook.svg') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?text={{ $socialShareText }}" target="_blank">
                                            <img src="{{ asset('images/congrats-twitter.svg') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url={{ urlencode($url) }}" target="_blank">
                                            <img src="{{ asset('images/congrats-google-plus.svg') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/shareArticle?url={{ urlencode($url) }}&mini=true&summary={{ $socialShareText }}" target="_blank">
                                            <img src="{{ asset('images/congrats-linkedin.svg') }}">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="congrats-popup-bottom">
                        <a class="congrats-popup-btn" href="/add-listing">Add Another Listing</a>
                        <a class="congrats-popup-btn-right congrats-popup-btn" href="/rooms/{{ $listing->id }}">View Listing</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /section -->

    {{--************************************************************************************--}}

    {{--<div class="congrest-content">--}}
        {{--<div class="container">--}}
            {{--<div class="congrates-box">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="congrates-widgets">--}}
                            {{--<h1>Congrats! </h1>--}}
                            {{--<h3>Your listing is now live and ready to be booked!</h3>--}}
                            {{--<h4>Share your listing to get more reservations, or make changes via <span><a href="/dashboard/listings">my listings</a></span> in the dashboard.</h4>--}}
                            {{--<ul>--}}
                                {{--<li>--}}
                                    {{--<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=large&mobile_iframe=true&width=73&height=28&appId" width="133" height="43" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>--}}
                                {{--</li>--}}
                                {{--<li class="tweet-plus-iframe">--}}
                                    {{--<iframe--}}
                                            {{--src="https://platform.twitter.com/widgets/tweet_button.html?size=l&url=https%3A%2F%2Fdev.twitter.com%2Fweb%2Ftweet-button&via=twitterdev&related=twitterapi%2Ctwitter&text=custom%20share%20text&hashtags=example%2Cdemo"--}}
                                            {{--width="75"--}}
                                            {{--scrolling="no"--}}
                                            {{--height="28"--}}
                                            {{--title="Twitter Tweet Button"--}}
                                            {{--style="border: 1px solid #0073B9; overflow: hidden; ">--}}
                                    {{--</iframe></li>--}}
                                {{--<li class="google-plus-iframe"><!-- Place this tag in your head or just before your close body tag. -->--}}
                                    {{--<script src="https://apis.google.com/js/platform.js" async defer></script>--}}

                                    {{--<!-- Place this tag where you want the share button to render. -->--}}
                                    {{--<div class="g-plus" data-action="share" data-height="24" data-href="https://plus.google.com/108182204830812691386" ></div>--}}
                                {{--</li>--}}
                                {{--<li class="linkedin-plus-iframe">--}}
                                    {{--<script src="https://platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>--}}
                                    {{--<script type="IN/Share" data-url="https://www.linkedin.com/company/bsquaresoft"></script>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="congrates-widgets-img-right">--}}
                                {{--<div class="congrats-right-img">--}}
                                    {{--<img class="congrats-right-mark" src="{{ asset('images/congrats-right-mark.png') }}">--}}
                                    {{--<img class="congrats-place-img" src="{{ $listing->showFeaturedImage('m') }}">--}}
                                    {{--<img class="congrats-user-img" src="{{ $listing->user->profile->getPhoto() }}">--}}
                                {{--</div>--}}
                                {{--<img src="{{ asset('images/success-page-info-img.png') }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="congrates-btm">--}}
                            {{--<a class="left" href="/add-listing">Add Another Listing</a>--}}
                            {{--<a class="right listing" href="/dashboard/listings">My Listing</a>--}}
                            {{--<a class="right" href="/rooms/{{ $listing->id }}">View Listing</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}



@endsection