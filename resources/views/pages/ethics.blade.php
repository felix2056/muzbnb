@extends('layouts.master')

@section('title', 'Our Standards')

@section('content')
    <!-- Slick -->
    {{--<link rel="stylesheet" href="{{ URL::asset('css/slick.css') }}">--}}
    <!-- Custom -->
    {{--<link rel="stylesheet" href="{{ asset('css/style-ethics.css') }}">--}}
    <!-- Mobile -->
    {{--<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">--}}

    <section class="page-cotnent ethics-page">
        {{--<div class="ethics-banner">--}}
        {{--<div class="container">--}}
        {{--<div class="ethics-banner-text">--}}
        {{--<h1>Ethics, Trust, & Hospitality</h1>--}}
        {{--<p>At Muzbnb, we aim to facilitate a symbiotic experience for our hosts and guests.</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        <div class="ethics-banner">
            <div class="container">
                <div class="ethics-banner-text">
                    <h1>Ethics, Trust, &amp; Hospitality</h1>
                    <p>At Muzbnb, we aim to facilitate a symbiotic experience for our hosts and guests.</p>
                </div>
            </div>
        </div>

        <div class="ethics-section2">
            <div class="container">
                <div class="ethics-section2-head">
                    <h1>A Pledge to Protect</h1>
                    <p>As we begin our journey, we hope to outline standards within which we expect our vast community to operate. The three pillars below, serve as our core ethics guidelines and affirm our commitment to an open, trustworthy and inclusive community.</p>
                </div>
                <div class="ethics-section2-info">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 brd-right ethics-section2-full-width">
                            <div class="ethics-section2-box">
                                <img src="{{ asset('images/truthful icon.png') }}">
                                <h6>Truthful</h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 brd-right ethics-section2-full-width">
                            <div class="ethics-section2-box">
                                <img src="{{ asset('images/equitable icon.png') }}">
                                <h6>Equitable</h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 ethics-section2-full-width">
                            <div class="ethics-section2-box">
                                <img src="{{ asset('images/trusthworthy icon.png') }}">
                                <h6>Trustworthy</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ethics-section3">
            <div class="ethics-section3-img">
                <img src="{{ asset('images/truthful-photo.png') }}">
            </div>
            <div class="ethics-section3-info">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 ethics-section3-left-width">
                            <div class="ethics-section3-info-box">
                                <h2>Truthful</h2>
                                <div class="ethics-section3-box">
                                    <h6>Misrepresenting yourself</h6>
                                    <p>As a user of Muzbnb, you must be authentic and only offer information that is 100% accurate. Make sure to provide your true name, date of birth (must be18 or older to use Muzbnb), location, etc. Also make sure to use only one account. When communicating with other users, always be truthful when representing who you are and your intentions as a guest and host.</p>
                                </div>
                                <div class="ethics-section3-box">
                                    <h6>Misrepresenting your spaces</h6>
                                    <p>A lot of trust is put in the hands of our hosts and we expect them to be completely truthful when listing their properties. This includes accurate location information, home details (e.g. property type, amenities, safety details, etc), and calendar availability among other information. </br></p>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ethics-section4">
            <div class="ethics-section3-info ethics-section4-info">
                <div class="row">
                    <div class="ethics-section4-left-section">
                        <div class="ethics-section4-info-box">
                            <h2>Equitable</h2>
                            <div class="ethics-section3-box">
                                <h6>Discriminatory behavior or hate speech</h6>
                                <p>Muzbnb was created with the intention of inclusivity and acceptance for all our users. No user, whether a host or guest should have to deal with rude or unjust behavior from a fellow Muzbnb user, and that’s what we expect – respectful and dignified interactions amongst each other. Any interaction between users that is deemed discriminatory in any manner will not be tolerated, and may result in the suspension or termination of a user’s account.
</p>
                            </div>
                            <div class="ethics-section3-box">
                                <h6>Bullying or harassing others</h6>
                                <p>It is forbidden to continually target fellow users with unsolicited behavior which may include; defamation, sexual advances, shaming, extortion, intimidation, and unauthorized sharing of personal information.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ethics-section3-img">
                <img src="{{ asset('images/Mockup-05.png') }}">
            </div>
        </div>

        <div class="ethics-section5 ethics-section3">
            <div class="ethics-section3-img ethics-section5-img">
                <img src="{{ asset('images/trusthworthy-photo.png') }}">
                <div class="ethics-section5-img-info">
                    <div class="">
                        <div class="">
                            <div class="ethics-section5-left-width">
                                <p>“I feel very comfortable using Muzbnb when traveling alone or with my family.”</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ethics-section3-info">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="ethics-section3-info-box">
                                <h2>Trustworthy</h2>
                                <div class="ethics-section3-box">
                                    <h6>Harming yourself or others</h6>
                                    <p>The safety of our users is paramount, so causing any harm to yourself or others is completely prohibited and will leave you legally liable. Physical or sexual assault, sexual abuse, domestic violence, robbery, human trafficking, kidnapping, or other acts of violence and/or misconduct which is deemed an illegal offence is prohibited while using Muzbnb. </p>
                                </div>
                                <div class="ethics-section3-box">
                                    <h6>Spam, phishing, or fraud</h6>
                                    <p>To protect yourself and others from financial risk, make sure to never make transactions outside of Muzbnb’s payments system. This may lead to credit card fraud, money laundering, and other scams which are completely prohibited by Muzbnb.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ethics-section6">
            <div class="container">
                <h1 class="ethics-section6-title">Muzbnb is a safe and secure system that allows you to worry about the fun stuff</h1>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 ethics-section6-fullwidth-box">
                        <div class="ethics-section6-box">
                            <div class="ethics-section6-box-img-wrap">
                                <div class="ethics-section6-box-img">
                                    <img src="{{ asset('images/payments icon.png') }}">
                                </div>
                            </div>
                            <h2>Payments</h2>
                            <p>Guests pay through Muzbnb when they book a home. Hosts receive payment through Muzbnb 24 hours after guest check-in.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 ethics-section6-fullwidth-box">
                        <div class="ethics-section6-box">
                            <div class="ethics-section6-box-img-wrap">
                                <div class="ethics-section6-box-img">
                                    <img src="{{ asset('images/verification icon.png') }}">
                                </div>
                            </div>
                            <h2>Verification</h2>
                            <p>Guests and hosts are able to verify themselves using a government approved ID or other online profiles.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 ethics-section6-fullwidth-box">
                        <div class="ethics-section6-box">
                            <div class="ethics-section6-box-img-wrap">
                                <div class="ethics-section6-box-img">
                                    <img src="{{ asset('images/messaging icon.png') }}">
                                </div>
                            </div>
                            <h2>Messaging</h2>
                            <p>Easily message hosts or guests to learn more about them, their trip or their property. </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 ethics-section6-fullwidth-box">
                        <div class="ethics-section6-box">
                            <div class="ethics-section6-box-img-wrap">
                                <div class="ethics-section6-box-img">
                                    <img src="{{ asset('images/reviews icon.png') }}">
                                </div>
                            </div>
                            <h2>Reviews</h2>
                            <p>What better way to learn about your potential host or guest than from confirmed reviews.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ethics-section7">
            <div class="container">
                <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 ethics-section7-padding">
                    <div class="ethics-section7-head">
                        <h1>Superior Hospitality</h1>
                        <p>Take your guest’s experiences to the next level by implementing our six pillars of hosting</p>
                    </div>
                    <div class="row ethics-section7-top-section">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="ethics-section7-top-img">
                                <img src="{{ asset('images/hospitality photo.png') }}">
                            </div>
                            <div class="ethics-section7-img-name">
                                <span>Muhammad</span>
                                <span class="ethics-section7-user-name-wrap">Diallo</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="ethics-section7-top-info">
                                <p>“To say that Muhammad was an excellent host would be an understatement. He truly made me and my family feel comfortable and even gave us a personalized tour of Toronto. Our family made a new friend for life!”</p>
                                <div class="ethics-section7-user">
                                    <img src="{{ asset('images/ethics-user-img.png') }}">
                                    <div class="ethics-section7-user-name">
                                        <span>James</span>
                                        <span class="ethics-section7-user-name-wrap">Bashir</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ethics-section7-bottom-section">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Accuracy</h2>
                                <p>The accuracy of the information you provide is critical to a good review. Your guests will have the opportunity to rate your accuracy. Be sure to be as accurate as possible so your guests won’t be let down.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Availability</h2>
                                <p>Being available to host when you say you are is very important and can make or break your guest’s stay. Keep your calendar updated so you can receive more reservation requests you can accommodate.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Communication</h2>
                                <p>Being responsive puts everyone at ease. It also shows that you’re a responsible and considerate guest or host. Keep the lines of communication open and never leave someone hanging.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Cleanliness</h2>
                                <p>As they say, “cleanliness is next to godliness.” Don’t burden your guest with a home that is less than sparkling clean. Make sure everything is tidy and in place. It will surely reflect on your hosting rating.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Check-In</h2>
                                <p>The check-in experience is usually the biggest impression of you as a host. Make it easy for your guest to check-in so they’ll leave you a great check-in score.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Extras</h2>
                                <p>All those extra perks you surprised your guest with wasn’t for nothing. They’ll be able to rate you on extras and give potential guests an idea of the type of hospitality you offer.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="ethics-section7-btn" href="/become-a-host">become a host</a>
            </div>
        </div>
    </section>
    <!-- /slider -->

@endsection