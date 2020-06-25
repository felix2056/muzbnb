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
                                    <p>You should not provide a false name or date of birth, use listings for commercial purposes without your host’s permission, have events or parties without your host’s approval, maintain duplicate accounts, or create an account if you’re under 18.</p>
                                </div>
                                <div class="ethics-section3-box">
                                    <h6>Misrepresenting your spaces</h6>
                                    <p>You should not provide inaccurate location information, have incorrect availability, mislead people about the type, nature, or details of your listing, substitute one listing for another, set up fake or fraudulent listings, leave fraudulent reviews, engage in deceptive pricing, or fail to disclose hazards and habitability issues.</p>
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
                                <p>You should treat everyone with respect in every interaction. So, you should follow all applicable laws and not treat others in a discriminatory manner. Similarly, insulting others on this platform is not allowed.</p>
                            </div>
                            <div class="ethics-section3-box">
                                <h6>Bullying or harassing others</h6>
                                <p>You should not share personal information to shame or blackmail others, repeatedly target others with unwanted behavior, engage in coercive or persistent and unwanted sexual advances, defame others, or violate our review and content standards.</p>
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
                                    <p>You should not commit physical or sexual assault, sexual abuse, domestic violence, robbery, human trafficking, other acts of violence, or hold anyone against their will. Members of dangerous organizations, including terrorist, organized criminal, and violent racist groups, are not welcome in this community.</p>
                                </div>
                                <div class="ethics-section3-box">
                                    <h6>Spam, phishing, or fraud</h6>
                                    <p>You should not make transactions outside of Muzbnb’s payments system; commit booking fraud, credit card fraud, or launder money; attempt to drive traffic to other sites or market unrelated products; divert payments meant for others; abuse our referrals system; or make false claims against other members of the community.</p>
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
                            <p>Guests pay through Muzbnb when they book a listing. Hosts receive payment through Muzbnb 24 hours after guest check-in.</p>
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
                            <p>Guests and hosts can scan a government ID and connect other online profiles to their Muzbnb account.</p>
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
                            <p>Use our messaging system to learn more about a host or ask a guest about their trip.</p>
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
                            <p>Get to know your guest or host through detailed profiles and confirmed reviews.</p>
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
                                <p>Your guests will have the opportunity to rate the accuracy of the information you provide. Creating a detailed profile and listing page will attract guests who match your hosting style and help you earn great ratings.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Availability</h2>
                                <p>You should always feel confident that you’re able to host a reservation. Keeping your calendar and listing information updated increases the likelihood of receiving reservation requests you can accommodate.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Communication</h2>
                                <p>Every time a guest reaches out—whether you have a reservation with them or not—responding quickly shows that you’re an attentive and considerate host.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Cleanliness</h2>
                                <p>A clean and tidy listing will always look its best and most inviting. Your guests can rate the cleanliness of your listing and the average of your ratings appears on your listing page.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Check-In</h2>
                                <p>Your guests will be invited to rate their check-in experience at the end of their stay, so it’s an opportunity to devote extra care to making them comfortable.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ethics-section7-bottom-box">
                                <h2>Extras</h2>
                                <p>Personalize each guest’s experience to suit their travel needs and personality—small gestures can leave big, lasting impressions.</p>
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