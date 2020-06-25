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
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Payment Details
                                    </h3>
                                </div>
                                <div class="panel-body">

                                    <form action="{{ route('in-method') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <span for="cardNumber"> CARD NUMBER</span>
                                            <div class="input-group">
                                                <input class="form-control" id="card_number" name="card_number" placeholder="Valid Card Number" autofocus="" type="text" value="{{ isset($userPaymentInfo) ? $userPaymentInfo->card_number :0 }}">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group">

                                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                                        <span for="expityMonth"> EXPIRY Month</span>
                                                        <input class="form-control" id="month" name="month" placeholder="MM" type="text" value="{{ isset($userPaymentInfo) ? $userPaymentInfo->month :0 }}">
                                                    </div>

                                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                                        <span for="exipryyear">EXPIRY YEAR</span>
                                                        <input class="form-control" id="year" name="year" placeholder="YY" type="text" value="{{ isset($userPaymentInfo) ? $userPaymentInfo->year :0 }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>&nbsp;</div>

                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <button type="submit" class="btn btn-success btn-lg btn-block">
                                                    Save
                                                </button>
                                            </li>
                                        </ul>

                                    </form>
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
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ) {
        });
    </script>

@endsection