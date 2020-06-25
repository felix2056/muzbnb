@extends('layouts.master')

@section('title', 'Invite Friends')

@section('content')
    <style>
        @media (max-width: 767px){
            .invite-page .form-group {
                width: 100%;
                margin-right: 0;
            }
            .invite-page .form-inline button {
                width: 100%;
            }
        }
    </style>

{{--    {{ dd($urls) }}--}}
    <div class="invite-page">
        <div class="top-banner"></div>
        <div class="container ">
            <div class="header-text ">
                <h1 class="">
                    Invite friends to<br/>
                    join Muzbnb & earn!
                </h1>
                <p class="">
                    You can earn rewards simply by<br />
                    inviting others to enjoy our platform.
                </p>
            </div>
            <div class="invite-form">
                <div class="form-inner form-top">
                    <form class="form-inline" id="inviteForm" method="post" action="{{ route('sendInviteEmail') }}">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <input type="email" id="" {{ isset($urls) && $urls != null ? '' : 'disabled' }} required name="email" class="form-control" placeholder="Enter email Address">
                            <input type="hidden" id="" name="inviteLink" value="{{ isset($urls) && $urls != null  ? $urls->referralUrls->referralUrl : '' }}">
                        </div>
                        <button type="submit" id="sendInviteBtn" {{ isset($urls) && $urls != null ? '' : 'disabled' }} class="btn btn-primary">Send Invite</button>
                    </form>
                    {{--<p>--}}
                        {{--Import contacts: <a href=""><img src="/style/assets/img/google.jpg" /> Gmail</a> |--}}
                        {{--<a href=""><img src="/style/assets/img/yahoo.jpg" /> Yahoo! Mail</a> |--}}
                        {{--<a href=""><img src="/style/assets/img/outlook.jpg" /> Outlook</a>--}}
                        {{--<span class="">--}}
                            {{--<i class="fa fa-question-circle-o"></i>--}}
                        {{--</span>--}}
                    {{--</p>--}}
                    {{--<p class="middle-line"><span>or</span></p>--}}
                    <p class="middle-line"><span></span></p>
                    <div class="row">
                        @if(\Auth::user())
                            <div class="col-md-1 col-sm-2 col-xs-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{  $urls->referralUrls->facebookRefUrl }}" target="_blank">
                                    <img src="{{ asset('images/congrats-facebook.svg') }}">
                                </a>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-2">
                                <a href="https://twitter.com/intent/tweet?text={{ $urls->referralUrls->twitterRefUrl }}" target="_blank">
                                    <img src="{{ asset('images/congrats-twitter.svg') }}">
                                </a>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-2">
                                <a href="fb-messenger://share/?link={{ urlencode($urls->referralUrls->facebookRefUrl) }}&app_id=1306411512731198" >
                                    <img style="border-radius:4px;" src="{{ asset('images/invite-messenger.png') }}">
                                </a>
                            </div>

                            <div class="col-md-9 col-sm-6 col-xs-6">
                            <div class="form-group" style="float:right;width:100%;">
                                <input type="text" class="form-control" disabled value="{{ $urls->referralUrls->referralUrl }}" style="cursor: text;">
                            </div>
                        </div>
                        @else
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p style="text-align: center;">Please <a href="javascript:;" onclick="return false;" id="invitePageLogin" class="login-btn1">Log-In</a> to get your referral links and invite your friends!</p>
                            </div>
                        @endif
                    </div>
                </div>
                {{--<div class="form-inner form-top hidden-xs hidden-md hidden-sm hidden-lg">--}}
                    {{--<a href="#" class="btn btn-danger btn-block">Email</a>--}}
                    {{--<a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Facebook</a>--}}
                {{--</div>--}}
                <h3 class="text-center">‘Easy as 1, 2, 3!'</h3>
                <div class="row">
                    <div class="col-sm-12 col-sm-offset-0 col-xs-offset-1 col-xs-10">
                        <div class="row">
                            <div class="col-sm-4"><p><img src="/style/assets/img/icon/box-up.jpg"> Refer your friends to Muzbnb with your link or via email.</p></div>
                            <div class="col-sm-4"><p><img src="/style/assets/img/icon/briefcase.jpg"> Get $10 when they take their first trip of $75 or more.</p></div>
                            <div class="col-sm-4"><p><img src="/style/assets/img/icon/handshake.jpg"> Get $10 when they welcome their first guest.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        $('#invitePageLogin').click(function (e) {
            e.preventDefault();
            var redirectTo = window.location.href;
            $('#redirectToField').val(redirectTo);
        });
    </script>
@endsection