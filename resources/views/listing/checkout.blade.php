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

                <div class="container">
                    <div class="row">

                        <form  action="{{ route('checkout')  }}" method="post" >
                            {{ csrf_field() }}

                            <input type="hidden" name="encryptlistid" value="{{ $encryptlistid }}">
                            <input type="hidden" name="encryptprice" value="{{ $encryptprice }}">
                            <input type="hidden" name="cardCVC" value="{{ $cardCVC }}">
                            <input type="hidden" name="cardExpiry" value="{{ $cardExpiry }}">
                            <input type="hidden" name="cardNumber" value="{{ $cardNumber }}">

                            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="col-md-6 main-logo-wrap">
                                            <div class="logo">
                                                <a href="/">
                                                    <img src="https://127.0.0.1:8000/images/Muzbnb Logo.png" alt="Logo" style="width: auto;height: 40px;">
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <address>
                                            MUZbnb
                                            <br>
                                            Los Angeles, CA 90026
                                            <br>
                                            <abbr title="Phone">Ph:</abbr> (213) 123-4567
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <h1>Receipt</h1>
                                    </div>
                                    </span>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Days Stay</th>
                                            <th class="text-center">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="col-md-9"><em>{{ $listing->name }}</em></td>
                                            <td class="col-md-1" style="text-align: center"> 1 </td>
                                            <td class="col-md-1 text-center">{{ $listing->price }}</td>
                                        </tr>

                                        <tr>

                                            <td>   </td>
                                            <td class="text-left">
                                                <p>
                                                    <strong>Subtotal: </strong>
                                                </p>
                                                <p>
                                                    <strong>Tax: </strong>
                                                </p></td>
                                            <td class="text-center">
                                                <p>
                                                    <strong>{{ $listing->price }}</strong>
                                                </p>
                                                <p>
                                                    <strong>{{ number_format((7/1000)*$listing->price,2) }}</strong>
                                                </p></td>
                                        </tr>
                                        <tr>

                                            <td>   </td>
                                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                            <td class="text-center text-danger"><h4><strong>{{ number_format((7/1000)*$listing->price,2) + $listing->price }}</strong></h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
                                    </button></td>
                                </div>
                            </div>
                        </form>
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