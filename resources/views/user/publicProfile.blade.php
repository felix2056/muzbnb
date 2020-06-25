@extends('layouts.master')

@section('title', 'Public Profile')

@section('content')
{{--   {{ dd($userInfo) }}--}}
    <section class="publicProfile-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="public-sidebar">
                        <div class="public-image">
                            @if($userInfo->photo())
                                <img src="{{ $userInfo->photo() }}"/>
                            @else
                                <img src="/images/dummy.jpg"/>
                            @endif
                        </div>
                    </div>
                    <div class="public-verify-info">
                        <h2>Verified info</h2>
                        <div class="public-verify-inner">
                            <ul>
                                <li>Email Address
                                    @if($userInfo->email_verified)
                                        <i class="fa fa-check" aria-hidden="true" style="border:none;"></i>
                                    @else
                                        <i class="fa fa-close" aria-hidden="true" style="border:none;"></i>
                                    @endif
                                </li>

                                <li>Phone number
                                    @if($userInfo->phoneNumber->verified)
                                        <i class="fa fa-check" aria-hidden="true" style="border:none;"></i>
                                    @else
                                        <i class="fa fa-close" aria-hidden="true" style="border:none;"></i>
                                    @endif
                                </li>
                            </ul>
                            <a href="">Learn more >></a>
                        </div>
                    </div>
                    <div class="public-verify-info">
                        <h2>Connected accounts</h2>
                        <div class="public-verify-inner">
                            <ul>
                                @foreach($userInfo->socialProviders as $social)
                                <li>{{ ucwords($social->provider) }}
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </li>
                                    @endforeach
                            </ul>
                            <a href="">Learn more >></a>
                        </div>
                    </div>
                    <div class="public-verify-info">
                        <h2>About me</h2>
                        <div class="public-verify-inner">
                            <p>School</p>
                            <span>{{ $userInfo->profile->school }}</span>
                            <p>Work</p>
                            <span>{{ $userInfo->profile->work }}.</span>
                            <p>Languages</p>
                            <span>English, Espanol</span>
                        </div>
                    </div>
                    <div class="listing-profile">
                        <h2>Listings<span>({{ count($userInfo->listings) }})</span></h2>
                        @foreach($userInfo->listings as $listing)
                            <a href="/rooms/{{  $listing->id }}">
                            <img src="{{ $listing->showFeaturedImage('s') }}"/>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="public-right-content">
                        <div class="profile-biodata">
                            <h2>Salaam, <span>I'm {{ $userInfo->first_name }}!</span></h2>
                            <h3>
                                @if($userInfo->profile->location)
                                    {{ $userInfo->profile->location }}.
                                @else
                                    @if( $userInfo->city)
                                        {{ $userInfo->city }},
                                    @endif
                                    @if($userInfo->country)
                                        {{ $userInfo->country }}.
                                    @endif
                                @endif
                                Joined in  {{ Carbon\Carbon::parse($userInfo->created_at)->format('F Y') }}</h3>
                            <p><span><i class="fa fa-flag-o" aria-hidden="true"></i></span><a href="mailto:salaam@muzbnb.com?subject=REPORT USER: ID#{{ $userInfo->id }}">Report this user</a></p>
                        </div>
                        <div class="profile-info-detail">
                            <p>{{ $userInfo->profile->self_description }}.</p>
                        </div>
                        {{--<div class="reviews-section">--}}
                            {{--<div class="review-title">--}}
                                {{--<span>2</span>--}}
                                {{--<p>Reviews</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="listing-profile">--}}
                            {{--<h2>Reviews<span>(2)</span></h2>--}}
                        {{--</div>--}}
                        {{--<div class="review-widget">--}}
                            {{--<h2>Review From Guests</h2>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-2">--}}
                                    {{--<div class="review-img">--}}
                                        {{--<img src="images/truthful-photo.png"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="review-name">--}}
                                        {{--<p>David</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-10">--}}
                                    {{--<div class="review-public-profile-detail">--}}
                                        {{--<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab </p>--}}
                                        {{--<span>From Puebla, Mexico . April 2017<i class="fa fa-flag-o" aria-hidden="true"></i></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="review-widget">--}}
                            {{--<h2>Review From Hosts</h2>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-2">--}}
                                    {{--<div class="review-img">--}}
                                        {{--<img src="images/trusthworthy-photo.png"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="review-name">--}}
                                        {{--<p>Rodrigo</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-10">--}}
                                    {{--<div class="review-public-profile-detail">--}}
                                        {{--<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium. </p>--}}
                                        {{--<span>From Heroica, Veracruz, Moxico . April 2017<i class="fa fa-flag-o" aria-hidden="true"></i></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection