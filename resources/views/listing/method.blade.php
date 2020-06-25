@extends('layouts.master')

@section('style-top')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{mix('style/add-listing.css')}}" rel="stylesheet">
    <style>
        .listing::before{
            border-bottom: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="main-wrapper">
        <div class="user-detail-wrap">

            <!-- Tab panes -->
            <div class="tab-content user-content">
                <div role="tabpanel" class="tab-pane active" id="profile">
                    <div class="container-fluid box-width listing" style="border-bottom: none !important;">

                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <header role="heading">
                                <h3>Payout Method</h3>
                            </header>
                        </div>
                        @if (Session::has('message'))
                            <div class="col-xs-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {!! Session::get('message') !!}</div>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="col-xs-12">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {!! Session::get('error') !!}</div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="listing-types">
                                    {{--<form id="login-form" method="POST" action="{{ route('save-method') }}" role="form" style="display: block;">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<input type="hidden" name="user_id" id="user_id" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->user_id :0 }}">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Street Address</label>--}}
                                            {{--<input type="text" name="street_address" id="street_address" tabindex="1" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->street_address :'' }}">--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('street_address') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('street_address','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Locality</label>--}}
                                            {{--<input type="text" name="locality" id="locality" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->locality :'' }}">--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('locality') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('locality','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Region</label>--}}
                                            {{--<input type="text" name="region" id="region" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->region :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('region') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('region','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Postal Code</label>--}}
                                            {{--<input type="text" name="postal_code" id="postal_code" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->postal_code :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('postal_code') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('postal_code','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Descriptor</label>--}}
                                            {{--<input type="text" name="descriptor" id="descriptor" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->descriptor :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('descriptor') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('descriptor','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Email</label>--}}
                                            {{--<input type="email" name="email" id="email" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->email :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('email','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Mobile Phone</label>--}}
                                            {{--<input type="text" name="mobile_phone" id="mobile_phone" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->mobile_phone :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('mobile_phone') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('mobile_phone','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Account Number</label>--}}
                                            {{--<input type="text" name="account_number" id="account_number" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->account_number :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('account_number') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('account_number','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Routing Number</label>--}}
                                            {{--<input type="text" name="rounting_number" id="rounting_number" tabindex="2" class="form-control" value="{{ isset($userPayoutInfo) ? $userPayoutInfo->rounting_number :'' }}" >--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group {{ $errors->has('rounting_number') ? 'has-error' :'' }}">--}}
                                            {{--{!! $errors->first('rounting_number','<span class="help-block">:message</span>') !!}--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-sm-12">--}}
                                                    {{--<input type="submit" name="submit" tabindex="4" class="btn btn-success btn-lg" value="Submit">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}

                                    {{--PAYMENT RAILS WIDGET--}}

                                    @php
                                        $WIDGET_BASE_URL = "https://widget.paymentrails.com";
                                        $KEY = env('PAYMENT_RAILS_ACCESS_KEY');
                                        $SECRET = env('PAYMENT_RAILS_SECRET_KEY');
                                        $RECIPIENT_EMAIL = \Auth::user()->email;
                                        $RECIPIENT_REFERENCEID = \Auth::user()->email;

                                        $ts = time();
                                        $method = 'GET';
                                        $reqPath = '/v1/recipients?search=danyalsheikh.vbase%40gmail.com';

                                        $querystring = "email=".$RECIPIENT_EMAIL."&refid=".$RECIPIENT_REFERENCEID."&ts=".$ts."&key=".$KEY;

                                        $querystring2 = $ts . $method . $reqPath;

                                        $signature = hash_hmac("sha256", $querystring, $SECRET);
                                        $signature2 = hash_hmac("sha256", $querystring2, $SECRET);

                                        $widget_link = $WIDGET_BASE_URL."?". $querystring."&sign=".$signature
                                    @endphp
                                    <iframe id="widgetIframe" style="width:100%;min-height:800px;" src="{{ $widget_link }}"></iframe>
                                    {{--<p>{{ $signature2 }}</p>--}}
                                    {{--<p>{{ $ts }}</p>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{--<script type="text/javascript">--}}
        {{--jQuery( document ).ready(function( $ ) {--}}
            {{--setTimeout(function () {--}}
                {{--</script>--}}
                {{--@php--}}
{{--                    use PaymentRails;--}}

                    {{--\PaymentRails\Configuration::publicKey(env('PAYMENT_RAILS_ACCESS_KEY'));--}}
                    {{--\PaymentRails\Configuration::privateKey(env('PAYMENT_RAILS_SECRET_KEY'));--}}
                    {{--\PaymentRails\Configuration::environment(env('PAYMENT_RAILS_ENVIRONMENT'));--}}



                    {{--$recipients = \PaymentRails\Recipient::search(['email' => \Auth::user()->email]);--}}
                    {{--foreach ($recipients as $recipient) {--}}
                        {{--dump($recipient->id);--}}
                    {{--}--}}
                {{--@endphp--}}
            {{--<script type="text/javascript">--}}
                {{--console.log('{!! dd($recipients) !!} ');--}}
            {{--}, 5000);--}}
        {{--});--}}
    {{--</script>--}}

@endsection