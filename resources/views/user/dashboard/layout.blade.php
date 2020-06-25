@extends('layouts.master')

@section('content')
    <?php $rname = Route::getCurrentRoute()->getActionName();?>
    <div class="main-wrapper">
        <div class="user-detail-wrap">

            <div class="nav-tabs-wrap">
                <div class="container-fluid coutomwidth">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?= strpos($rname, 'dashboard') !== false ? 'active' : '' ?>">
                            <a href="/dashboard" aria-controls="profile"><span class="notification"><img src="{{url('')}}/style/assets/img/icon/profile.svg" alt="profile"></span> My Profile</a>
                        </li>
                        <li role="presentation" class="<?= strpos($rname, 'messages') !== false ? 'active' : '' ?>">
                            <a href="/dashboard/messages" aria-controls="messages">
                                <span class="notification">
                                    {{--<span class="red-bg">999+</span>--}}
                                    <img src="{{url('')}}/style/assets/img/icon/message.svg" alt="profile"></span>
                                My Messages
                            </a>
                        </li>
                        <li role="presentation" class="<?= strpos($rname, 'listing') !== false ? 'active' : '' ?>">
                            <a href="/dashboard/listings" aria-controls="my_listings">
                                <span class="notification">
                                    {{--<span class="yellow-bg">11</span>--}}
                                    <img src="{{url('')}}/style/assets/img/icon/listing.svg" alt="profile"></span>
                                My Listings
                            </a>
                        </li>
                        <li role="presentation" class="<?= strpos($rname, 'trips') !== false ? 'active' : '' ?>">
                            <a href="/dashboard/trips" aria-controls="trips"><span class="notification"><img src="{{url('')}}/style/assets/img/icon/trip.png" alt="profile"></span> My Trips</a>
                        </li>
                        <li role="presentation" class="<?= strpos($rname, 'reviews') !== false ? 'active' : '' ?>">
                            <a href="/dashboard/reviews" aria-controls="verification"><span class="notification"><img src="{{url('')}}/style/assets/img/icon/verification.png" alt="profile"></span> My Reviews</a>
                        </li>
                        <li role="presentation" class="<?= strpos($rname, 'account') !== false ? 'active' : '' ?>">
                            <a href="/dashboard/account" aria-controls="account"><span class="notification"><img src="{{url('')}}/style/assets/img/icon/account.png" alt="profile"></span> My Account</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tab panes -->
            <div class="tab-content user-content">
                <div role="tabpanel" class="tab-pane active">
                    @yield('tabcontent')
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{mix('js/dashboard.js')}}" rel="stylesheet"></script>
@endsection