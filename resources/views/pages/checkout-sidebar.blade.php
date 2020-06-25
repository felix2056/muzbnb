<div class="checkout-sidebar">
    <div class="checkout-image">
        <img style="width: 100%;" src="{{ $listing->showFeaturedImage('s') }}"/>
        <div class="image-auther">
            <img src="{{ URL('/images/user/'.$listing->user->profile->avatar) }}"/>
        </div>
    </div>
    <div class="checkout-detail">
        <h5>Hosted by {{ $listing->user->first_name.' '.$listing->user->last_name }}</h5>
        <h3>{{ $listing->name }}</h3>
        {{--<span>Entire home/apt.--}}
        {{--<ul>--}}
        {{--<li><i class="fa fa-star" aria-hidden="true"></i></li>--}}
        {{--<li><i class="fa fa-star" aria-hidden="true"></i></li>--}}
        {{--<li><i class="fa fa-star" aria-hidden="true"></i></li>--}}
        {{--<li><i class="fa fa-star" aria-hidden="true"></i></li>--}}
        {{--<li><i class="fa fa-star" aria-hidden="true"></i></li>--}}
        {{--</ul>--}}
        {{--.140 reviews {{ $listing->state }}, {{ $listing->city }}--}}
        </span>
        <div class="check-in-out">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <p>Check-in</p>
                    <span>{{ $requestObj->date_from }}</span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <p>Checkout</p>
                    <span>{{ $requestObj->date_to }}</span>
                </div>
            </div>
        </div>
        <div class="check-price">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="check-price-left">
                        <ul>
                            <li>${{ $listing->price }} * {{ $requestObj->totaldays }} nights</li>
                            <li>Service fee</li>
                            {{--<li>Occupancy Taxes</li>--}}
                            {{--<li class="blue">Coupon</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="check-price-right">
                        <ul>
                            <li>${{ $total2 = $listing->price * $requestObj->totaldays   }}</li>
                            <li>${{ $fee2 = number_format(($total2 * 0.075),2) }}</li>
                            {{--<li>$110</li>--}}
                            @php
                                $total2 = $total2 + $fee2;
                                $donation= ceil($total2) - $total2 ;
                            @endphp
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="charity-checkout">
                        <h3>Round up for charity<span>(optional)</span></h3>
                        <p>Round up to the nearest dollar and we'll donate 100% of the difference</p>

                        <div class="checkbox">
                            <label>
                                <input id="charity" name="charity" type="radio" value="{{$donation}}">
                                <img src="/images/charity-image.png"/>
                            </label>
                            <span>+{{$donation}} </span>
                        </div>
                        <h4>Donate manual amount<span>(optional)</span></h4>
                        <div class="checkbox">
                            <label>
                                <input id="manully" name="charity" type="radio" value="manual">
                                <img src="/images/charity-image.png"/>
                            </label>
                            <span class="manualCharityBox" style="width:22%;"> <label class="textbox-width" id="charityLabel">
                                            <input class="form-control"  type="number" min="0" name="charitymanual" id="charitymanual" size="3" placeholder="$10" checked="checked"  value="0">
                                            </label></span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="checkout-total-price">
                <div class="total-price-left">
                    <p>Total</p>
                </div>
                <div class="total-price-right">
                    <p id="totalamount">${{ number_format($total2,2) }}<span>USD</span></p>
                    <input type="hidden" id="amount2" name="amount2" value="{{ $total2 }}">
                </div>
            </div>

        </div>
    </div>
</div>