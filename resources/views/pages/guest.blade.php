@extends('layouts.master')

@section('content')
    <div class="header-section-host">
        <div class="guest-header-text">
            <h1 style="color: #ffffff;text-align: left;">Guest & Host Ethics</h1>
            <p style="color: #ffffff;text-align: left;">A marketplace of truthful, equitable, & trustworthy hosts and guests</p>
        </div>
    </div>
    <div class="page-inner guest-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="guest-top text-center">
                        <h1>A pledge to protect</h1>
                        <p>At Muzbnb, we aim to facilitate a symbiotic experience for our hosts and guests. The two-sided relationship can be immensely fruitful and we aim to nurture an environment that lets it flourish. As we begin our journey, we hope to outline standards within which we expect our vast community to operate. The three pillars below, serve as our core ethics guidelines and affirm our commitment to an open, trustworthy and inclusive community.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid full-length">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <img src="{{url('')}}/style/assets/img/1495486440_honesty_256x256.png" class="icon-guest-text" alt="">
                            <h3 class="text-center">Truthful</h3>
                            <p>
                                Our team believes you, the traveler and host, deserve the best in service. We'll strive to provide you with an honest and authentic experience. Supported by a strict verification process, you'll have access to real profiles, ensuring a transparent and open process.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <div class="guest-img-holder guest-img-right">
                        <img src="/style/assets/img/Hadi_Replica03.png" class="img-responsive" />
                        {{--<div class="phone-popup">
                            <img src="/style/assets/img/phone.png" />
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid full-length">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <div class="guest-img-holder guest-img-left">
                        <img src="/style/assets/img/Hadi_Replica01.png"  class="img-responsive" />
                        {{--<div class="phone-popup">
                            <img src="/style/assets/img/phone.png" />
                        </div>--}}
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <img src="{{url('')}}/style/assets/img/1495486451_choose_256x256.png" class="icon-guest-text" alt="">
                            <h3 class="text-center">Equitable</h3>
                            <p>
                                We are committed to providing an inclusive and non-discriminatory environment for our guests and hosts. We celebrate their diversity and hope to create a vibrant community in which all are treated fairly and with consideration.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid full-length">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <img src="{{url('')}}/style/assets/img/1495486442_myself_256x256.png" class="icon-guest-text" alt="">
                            <h3 class="text-center">Trustworthy</h3>
                            <p>
                                Whether you are a host or a guest, you can count on us to provide a safe and wholesome experience. With a shared expectation of respecting each other’s space and property, you can trust that you will feel protected.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <div class="guest-img-holder guest-img-right">
                        <img src="/style/assets/img/Hadi_Replica02.png"  class="img-responsive" />
                        {{--<div class="phone-popup">
                            <img src="/style/assets/img/phone.png" />
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection