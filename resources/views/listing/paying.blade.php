@extends('layouts.master')

@section('content')

    <!-- /slider -->

    <div class="single_listing_slider slider">
        @foreach($listing->images as $image)
            <div class="single_listing-box">
                <img src="{{url('')}}/images/listings/l_{{$image->name}}" alt="">
            </div>
        @endforeach
    </div>
    <!-- /slider -->

    <style>

        /* CSS for Credit Card Payment form */
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }
        .credit-card-box .form-control.error {
            border-color: red;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
        }
        .credit-card-box label.error {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
        .credit-card-box .payment-errors {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
        .credit-card-box label {
            display: block;
        }
        /* The old "center div vertically" hack */
        .credit-card-box .display-table {
            display: table;
        }
        .credit-card-box .display-tr {
            display: table-row;
        }
        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }
        /* Just looks nicer */
        .credit-card-box .panel-heading img {
            min-width: 180px;
        }
    </style>


    <div class="single_listing_contant">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-12 col-xs-12">
                    @if(session('Success'))
                        <p class="alert alert-success">
                            <strong>Success!</strong> {{session('Success') }}
                        </p>
                    @endif



                    @if(session('Error'))
                        <p class="alert alert-danger">
                            <strong>Danger!</strong>{{ session('Error') }}.
                        </p>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Payment Details
                            </h3>

                        </div>
                        <div class="panel-body">

                            <form  action="{{ route('showcheckout') }}" method="post" >
                                {{ csrf_field() }}
                                <input type="hidden" name="listingid" value="{{ $listing->id }}" >
                                <div class="form-group">
                                    <span for="cardNumber"> CARD NUMBER</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Valid Card Number" autofocus value="{{ isset($userPaymentInfo) ? $userPaymentInfo->card_number :'' }}" />
                                        @if($errors->first('cardNumber'))
                                            <p class=" alert-danger"> {{ $errors->first('cardNumber') }}</p>
                                        @endif
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">

                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                <span for="expityMonth"> EXPIRY Month</span>
                                                <input type="text" class="form-control" id="expityMonth" name="cardExpiryMonth" placeholder="MM" value="{{ isset($userPaymentInfo) ? $userPaymentInfo->month :'' }}"  />
                                                @if($errors->first('cardExpiryMonth'))
                                                    <p class=" alert-danger"> {{ $errors->first('cardExpiryMonth') }}</p>
                                                @endif
                                            </div>

                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                <span for="exipryyear">EXPIRY YEAR</span>
                                                <input type="text" class="form-control" id="expityYear"  name="cardExpiryYear" placeholder="YY" value="{{ isset($userPaymentInfo) ? $userPaymentInfo->year :'' }}"  />
                                                @if($errors->first('cardExpiryYear'))
                                                    <p class=" alert-danger"> {{ $errors->first('cardExpiryYear') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <span for="cvCode">CVC CODE</span>
                                            <input type="password" class="form-control" id="cvCode" name="cardCVC" placeholder="Card CVC"  />
                                            @if($errors->first('cardCVC'))
                                                <p class=" alert-danger"> {{ $errors->first('cardCVC') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            <span class="badge pull-right">{{ $listing->currency->symbol }} {{ $listing->price }} / Night</span>
                                            Proceed
                                        </button>
                                    </li>
                                </ul>

                            </form>
                        </div>
                    </div>



                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Country Name
                            </h3>

                        </div>
                        <div class="panel-body">

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">

                            </div>

                            <form role="form">
                                <div class="form-group">
                                    <label for="cardNumber">
                                        CARD NUMBER</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                               required autofocus />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label for="expityMonth">
                                                EXPIRY DATE</label>
                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                            </div>
                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label for="cvCode">
                                                CV CODE</label>
                                            <input type="password" class="form-control" id="cvCode" placeholder="CV" required />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"><span class="badge pull-right"><span class="glyphicon glyphicon-usd"></span>4200</span> Final Payment</a>
                        </li>
                    </ul>
                    <br/>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
@endsection