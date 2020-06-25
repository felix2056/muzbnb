<!DOCTYPE html>
<html lang="en">
<head>
    @if(\Route::currentRouteName() == 'congrats')
        @php
            $socialShareText = 'Hey, I just listed my home on Muzbnb! Please check it out! :) ';
            $url = \URL::to('/') . '/rooms/' . $listing->id;
            $socialShareText = $socialShareText . urlencode($url);
        @endphp
        <meta property="og:description" content="{{ $socialShareText }}"/>
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    @yield('meta-box')
    <meta name="csrf-token" content="<?php echo csrf_token() ?>">
    <title>@yield('title', 'HOME') | Muzbnb</title>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @auth
    <script>
        window.User = {!! json_encode(Auth::user()) !!};
        window.Avatar = {!! json_encode(Auth::user()->photo()) !!};
    </script>
    @endauth

    <link rel="manifest" href="/manifest.json">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
            appId: "93d3288e-af3e-4d07-8ee3-8a52be681444",
            autoRegister: false,
            notifyButton: {
                enable: false /* Set to false to hide */
            }
        }]);
        OneSignal.push(function() {
            OneSignal.registerForPushNotifications();
        });
    </script>

    <link rel="shortcut icon" href="{{{ asset('images/favicon.png') }}}">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i' rel='stylesheet' type='text/css'>
    <link href='{{ asset('css/nouislider.min.css') }}' rel='stylesheet' type='text/css'>
    @yield('style-top')
    {{-- <link href="{{mix('style/all.css')}}" rel="stylesheet"> --}}
    <link href="/style/allone.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    $listingUrl = route('become-a-host');
    ?>

    <style>
        #myScrollToTopBtn {
            width: 40px;
            height: 40px;
            position: fixed;
            bottom: 50px;
            right: 15px;
            display: none;
            background-color: transparent;
            border-radius:50px;
            border:none;
        }
        .mainmenu{ margin-left : 0px !important; }
    </style>

</head>
<body>

<header class="header fixed">
    <div class="container ">
        <div class="row" >

            <div class="col-md-2 main-logo-wrap">
                <div class="logo">
                    <a href="/">
{{--                        <img src="{{ url('style/assets')}}/img/muzbnb-logo1.svg" alt="Logo">--}}
                        <img src="{{ url('')}}/images/Muzbnb Logo.png" alt="Logo" style="width: auto;height: 40px;">
                    </a>
                </div>
                <div class="nav-button">
                    <button id="mobile-menu-show" type="button" class="nav-icon collapsed" data-toggle="collapse"
                            data-target="#mobile-menu-display">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-4 main-search-bar-wrap">
                <div class="header-search-bar">
                        <form id="search-form" name="search-form" >
                            <input type="text" id="userInput" name="query" value="" placeholder="WHERE DO YOU WANT TO GO?">
                            <input type="hidden" name="lat" id="lat" value="{{ request('lat') }}" />
                            <input type="hidden" name="flag" id="flag" value="@if(request('country')) 1 @else 0 @endif" />

                            <input type="hidden" name="lng" id="lng" value="{{ request('lng') }}"/>
                            <input type="hidden" name="address1" id="search_address1" value="{{ request('address1') }}"/>
                            <input type="hidden" name="address2" id="search_address2" value="{{ request('address2') }}"/>
                            <input type="hidden" name="city" id="search_city" value="{{ request('city') }}"/>
                            <input type="hidden" name="state" id="search_state" value="{{ request('state') }}"/>
                            <input type="hidden" name="country" id="search_country" value="{{ request('country') }}"/>
                            <input type="hidden" name="zip_code" id="search_zip_code" value="{{ request('zip_code') }}"/>
                            <input type="submit" id="searchSubmit"  alt="Submit"/>
                        </form>
                </div>
            </div>
            <div class="col-md-4 main-menu-wrap">
                <div class="mainmenu">
                    <ul id="navigation">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{$listingUrl}}">Become a Host</a></li>
                        <li><a href="#" class="support-btn">Help</a></li>
                    </ul>
                </div>
            </div>
            @if(Auth::guard('web')->check())
                <div class="col-md-2 user-wrap">
                    <div class="notification-holder">
                        <a class="not-btn">
                            0
                        </a>
                        <div class="all-notification">
                            <p>
                                Settings <a class="pull-right markAll" href="#">Mark all as read</a>
                            </p>
                            <ul>
                            </ul>
                        </div>
                    </div>
                    <ul class="user-info pull-left">
                        <li class="profile-info dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                                <img class="img-circle avatar" alt="" src="{{auth()->user()->profile->getPhoto()}}">
                                <span class="dropdown-arrow"><img
                                            src="{{url('style/assets')}}/img/dropdown-arrow-blue.svg"
                                            alt="arrow"></span>
                            </a>
                            <!-- User action menu -->
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard">My Profile</a></li>
                                <li><a href="/dashboard/messages">My Messages</a></li>
                                <li><a href="/dashboard/listings">My Listings</a></li>
                                <li><a href="/dashboard/trips">My Trips</a></li>
                                <li><a href="/dashboard/reviews">My Reviews</a></li>
                                <li><a href="/dashboard/account">My Account</a></li>
                                {{--<li><a href="/dashboard/booking">Booking Requests</a></li>--}}
                                {{--<li><a href="/dashboard/transaction">Transaction</a></li>--}}
                                <li class="divider"></li>
                                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                            <!-- /user action menu -->

                        </li>
                    </ul>
                </div>
            @else
                <div class="col-md-2 main-login-wrap">
                    <div class="loginandsingup">
                        {{--<a href="" data-toggle="modal" data-target="#login">login &nbsp;/&nbsp;</a>--}}
                        <a href="javascript:;" class="login-btn">login &nbsp;/&nbsp;</a>
                        <a href="javascript:;" class="signup-btn">signup</a>

                        
                        {{--<a href="" data-toggle="modal" data-target="#signup-social">signup</a>--}}
                    </div>
                </div>
            @endif
            <div id="mobile-menu-display" class="col-md-12 col-sm-12 col-xs-12 mobile-menu">
                <div class="mainmenu">
                    <ul id="navigation">
                        <li class="active"><a href="">Home</a></li>
                        <li><a href="{{route('become-a-host')}}">Become a Host</a></li>
                        <li><a href="" class="support-btn">Help</a></li>
                        <li><a href="" data-toggle="modal" data-target="#login">Login</a></li>
                        <li><a href="" data-toggle="modal" data-dismiss="modal" data-target="#signup-social">Signup</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /header -->