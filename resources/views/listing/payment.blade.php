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

                                            <form  action="{{ route('addOrder') }}" method="post" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="listingid" value="{{ $listing->id }}" >
                                            <div class="form-group">
                                                <span for="cardNumber"> CARD NUMBER</span>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Valid Card Number"   autofocus value="{{ isset($userPaymentInfo) ? $userPaymentInfo->card_number :'' }}" />
                                                    @if($errors->first('cardNumber'))
                                                    <p class=" alert-danger"> {{ $errors->first('cardNumber') }}</p>
                                                    @endif
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                {{--<div class="col-xs-7 col-md-7">--}}
                                                    <div class="form-group">

                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                            <span for="expityMonth"> EXPIRY Month</span>
                                                            <input type="text" class="form-control" id="expityMonth" name="cardExpiryMonth" placeholder="MM"  value="{{ isset($userPaymentInfo) ? $userPaymentInfo->month :'' }}" />
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
                                                {{--</div>--}}
                                                {{--<div class="col-xs-5 col-md-5 pull-right">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<span for="cvCode">CVC CODE</span>--}}
                                                        {{--<input type="password" class="form-control" id="cvCode" name="cardCVC" placeholder="Card CVC"  />--}}
                                                        {{--@if($errors->first('cardCVC'))--}}
                                                            {{--<p class=" alert-danger"> {{ $errors->first('cardCVC') }}</p>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                                <br/> <br/>

                                            <ul class="nav nav-pills nav-stacked">
                                                <li class="active">
                                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                                        {{--<span class="badge pull-right">{{ $listing->currency->symbol }} {{ $listing->price }} / Night</span>--}}
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
<script>

    // Use If Payment Via Ajax

//    var $form = $('#payment-form');
//    $form.on('submit', payWithStripe);
//
//    /* If you're using Stripe for payments */
//    function payWithStripe(e) {
//        e.preventDefault();
//
//        /* Visual feedback */
//        $form.find('[type=submit]').html('Validating <i class="fa fa-spinner fa-pulse"></i>');
//
//        var PublishableKey = 'pk_test_b1qXXwATmiaA1VDJ1mOVVO1p'; // Replace with your API publishable key
//        Stripe.setPublishableKey(PublishableKey);
//
//        /* Create token */
//        var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
//        var ccData = {
//            number: $form.find('[name=cardNumber]').val().replace(/\s/g,''),
//            cvc: $form.find('[name=cardCVC]').val(),
//            exp_month: expiry.month,
//            exp_year: expiry.year
//        };
//
//        Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
//            if (response.error) {
//                /* Visual feedback */
//                $form.find('[type=submit]').html('Try again');
//                /* Show Stripe errors on the form */
//                $form.find('.payment-errors').text(response.error.message);
//                $form.find('.payment-errors').closest('.row').show();
//            } else {
//                /* Visual feedback */
//                $form.find('[type=submit]').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
//                /* Hide Stripe errors on the form */
//                $form.find('.payment-errors').closest('.row').hide();
//                $form.find('.payment-errors').text("");
//                // response contains id and card, which contains additional card details
//                console.log(response.id);
//                console.log(response.card);
//                var token = response.id;
//                // AJAX - you would send 'token' to your server here.
//                $.post('/account/stripe_card_token', {
//                    token: token
//                })
//                // Assign handlers immediately after making the request,
//                        .done(function(data, textStatus, jqXHR) {
//                            $form.find('[type=submit]').html('Payment successful <i class="fa fa-check"></i>').prop('disabled', true);
//                        })
//                        .fail(function(jqXHR, textStatus, errorThrown) {
//                            $form.find('[type=submit]').html('There was a problem').removeClass('success').addClass('error');
//                            /* Show Stripe errors on the form */
//                            $form.find('.payment-errors').text('Try refreshing the page and trying again.');
//                            $form.find('.payment-errors').closest('.row').show();
//                        });
//            }
//        });
//    }
//    /* Fancy restrictive input formatting via jQuery.payment library*/
//    $('input[name=cardNumber]').payment('formatCardNumber');
//    $('input[name=cardCVC]').payment('formatCardCVC');
//    $('input[name=cardExpiry').payment('formatCardExpiry');
//
//    /* Form validation using Stripe client-side validation helpers */
//    jQuery.validator.addMethod("cardNumber", function(value, element) {
//        return this.optional(element) || Stripe.card.validateCardNumber(value);
//    }, "Please specify a valid credit card number.");
//
//    jQuery.validator.addMethod("cardExpiry", function(value, element) {
//        /* Parsing month/year uses jQuery.payment library */
//        value = $.payment.cardExpiryVal(value);
//        return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
//    }, "Invalid expiration date.");
//
//    jQuery.validator.addMethod("cardCVC", function(value, element) {
//        return this.optional(element) || Stripe.card.validateCVC(value);
//    }, "Invalid CVC.");
//
//    validator = $form.validate({
//        rules: {
//            cardNumber: {
//                required: true,
//                cardNumber: true
//            },
//            cardExpiry: {
//                required: true,
//                cardExpiry: true
//            },
//            cardCVC: {
//                required: true,
//                cardCVC: true
//            }
//        },
//        highlight: function(element) {
//            $(element).closest('.form-control').removeClass('success').addClass('error');
//        },
//        unhighlight: function(element) {
//            $(element).closest('.form-control').removeClass('error').addClass('success');
//        },
//        errorPlacement: function(error, element) {
//            $(element).closest('.form-group').append(error);
//        }
//    });
//
//    paymentFormReady = function() {
//        if ($form.find('[name=cardNumber]').hasClass("success") &&
//                $form.find('[name=cardExpiry]').hasClass("success") &&
//                $form.find('[name=cardCVC]').val().length > 1) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    $form.find('[type=submit]').prop('disabled', true);
//    var readyInterval = setInterval(function() {
//        if (paymentFormReady()) {
//            $form.find('[type=submit]').prop('disabled', false);
//            clearInterval(readyInterval);
//        }
//    }, 250);


    /*
     https://goo.gl/PLbrBK
     */
</script>
@endsection