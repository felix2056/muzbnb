@extends('layouts.master')

@section('content')
    <style>
        .btn-block{
            max-width: 230px;
            margin: 0 auto;
        }
        .btn-group-lg>.btn, .btn-lg {
            border-radius: 25px;
            background: red;
            border-color: red;
        }
        .btn-success:hover {
            color: #fff;
            background-color: red;
            border-color: red;
        }
        .btn-success[disabled]:hover {
            background-color: red;
            border-color: red;
        }
        .btn-success:active:hover {
            color: #fff;
            background-color: red;
            border-color: red;
        }
        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus{
            color: #fff;
            background-color: red;
            border-color: red;
        }

    </style>
    <div class="single_listing_slider slider">
        @if(count($listing->images) == 1)
            <div class="single_listing-box">
                <img src="{{url('')}}/images/listings/l_{{$listing->images[0]->name}}" alt="">
            </div>
            <div class="single_listing-box">
                <img src="{{url('')}}/images/listings/l_{{$listing->images[0]->name}}" alt="">
            </div>
            <div class="single_listing-box">
                <img src="{{url('')}}/images/listings/l_{{$listing->images[0]->name}}" alt="">
            </div>
        @else
            @foreach($listing->images as $image)
                <div class="single_listing-box">
                    <img src="{{url('')}}/images/listings/l_{{$image->name}}" alt="">
                </div>
            @endforeach
        @endif
    </div>
    <!-- /slider -->

    <div class="single_listing_contant">
        <div class="container">
            @if (Session::has('error'))
                <div class="row">
                <div class="col-xs-10">
                   <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!! Session::get('error')!!}
                   </div>
                </div>
                </div>
            @endif
            @if (Session::has('success'))
                    <div class="row">
                <div class="col-xs-10">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!! Session::get('success') !!}
                    </div>
                </div>
                    </div>
            @endif
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="user_info">
                        <div class="user_info_pic">
                            <img src="{{ $listing->user->photo() }}" alt="" class="user-img-sm img-circle" />
                            <h6>{{ $listing->user->fullName() }}</h6>
                        </div>
                        <div class="user_info_right">
                            <div class="user_info_right_head">
                                <h3>{{$listing->name}}</h3>
                                <h6>@if($listing->city != null) {{$listing->city.',' }}@endif @if($listing->state  != null){{$listing->state.','}} @endif @if($listing->country != null) {{$listing->country}} @endif</h6>
                                <div class="reviews">
                                    <ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    </ul>
                                    <span>0 REVIEWS</span>
                                </div>
                            </div>
                            <div class="user_info_bottom">
                                <ul>
                                    <li>
                                        <div class="user_info_icon"><img src="{{url('')}}/style/assets/img/private-icon.svg" alt=""></div>
                                        <span>{{ \App\Model\Listing::roomTypeOptions($listing->room_type) }}</span>
                                    </li>
                                    <li>
                                        <div class="user_info_icon"><img src="{{url('')}}/style/assets/img/guests-icon.svg" alt=""></div>
                                        <span>{{ $listing->no_of_guest }} guests</span>
                                    </li>
                                    <li>
                                        <div class="user_info_icon"><img src="{{url('')}}/style/assets/img/bedrooms-icon.svg" alt=""></div>
                                        <span>{{ $listing->no_of_bedroom }} bedroom</span>
                                    </li>
                                    <li>
                                        <div class="user_info_icon"><img src="{{url('')}}/style/assets/img/beds-icon.svg" alt=""></div>
                                        <span>{{ $listing->no_of_bed }} beds</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="about_listing">
                        <h3>About this listing</h3>

                        @if(isset($listing->customDescription) && count($listing->customDescription) > 0)
                            @foreach($listing->customDescription as $para)
                                <p style="overflow-wrap:break-word;">
                                    {!! $para !!}
                                </p>
                            @endforeach
                        @else
                            @if(strlen($listing->description) > 0)
                                <p style="overflow-wrap:break-word;">
                                    {!! $listing->description !!}
                                </p>
                            @else
                                <p style="overflow-wrap:break-word;">
                                    N/A
                                </p>
                            @endif
                        @endif

                        {{--<ul>
                            <li>15min from</li>
                            <li>25min from</li>
                            <li>30min from</li>
                        </ul>--}}
                        {{-- <a href="{{ route('start-chat', $listing->user->id) }}">contact host</a> --}}
                        <form action="{{ route('messages') }}" method="post" id="wizard-1" novalidate="novalidate">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $listing->user->id }}">
                            <div class="place-tab edit-tab">
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <div class="listing-types">
                                        <div class="listing-heading">
                                            <h4>Still have a question for {{ $listing->user->fullName() }}?</h4>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                    {!! Form::textarea('message', null, ['class' => 'form-control description removeError','id' => 'description', 'placeholder' => 'Your message here']) !!}
                                                    <div class='description_error' style='color:red;margin-bottom: 20px; display: none'>Error</div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 mt-20" style="margin-top: 20px;">
                                                <button type="submit" class="btn btn-success btn-lg btn-block">
                                                    Send Message
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="single_listing_the_space single_listing_details">
                        <div class="listing_details_head">
                            <h5>the space</h5>
                        </div>
                        <div class="listing_details_info_center">
                            <ul>
                                <li>Accomodates: {{$listing->no_of_guest}}</li>
                                <li>Bathrooms: {{$listing->no_of_bath}}</li>
                                <li>Bed Type:
                                    @if($listing->no_of_king_bed > 0) King Size: ({{ $listing->no_of_king_bed }}) @endif
                                    @if($listing->no_of_queen_bed > 0) Queen Size: ({{ $listing->no_of_queen_bed }}) @endif
                                    @if($listing->no_of_full_bed > 0) Full: ({{ $listing->no_of_full_bed }}) @endif
                                    @if($listing->no_of_twin_bed > 0) Twin: ({{ $listing->no_of_twin_bed }}) @endif
                                    @if($listing->no_of_couch_bed > 0) Couch/Futon: ({{ $listing->no_of_couch_bed }}) @endif
                                    @if($listing->no_of_airbed > 0) Airbed: ({{ $listing->no_of_airbed }}) @endif
                                </li>
                                <li>Bedrooms: {{$listing->no_of_bedroom}}</li>
                                <li>Beds: {{$listing->no_of_bed}}</li>
                            </ul>
                            <a href="#houseRule">house rules</a>
                        </div>
                        <div class="listing_details_info_right">
                            <ul>
                                <li>Check In: {{getTime($listing->check_in_time_from)}} - {{getTime($listing->check_in_time_to)}}</li>
                                <li>Check Out: {{getTime($listing->check_out_time_from)}} - {{getTime($listing->check_out_time_to)}}</li>
                                <li>Pet Owner: {{ implode(', ', $listing->findAmenities('pet')) }}</li>
                                <li>Property type: {{ \App\Model\Listing::propertyOptions($listing->property_type) }}</li>
                                <li>Room type: {{ \App\Model\Listing::roomTypeOptions($listing->room_type) }}</li>
                            </ul>
                        </div>
                    </div>

                    {{--<div class="single_listing_amenities single_listing_details">--}}
                    {{--<div class="listing_details_head">--}}
                    {{--<h5>unavailable dates</h5>--}}
                    {{--</div>--}}
                    {{--<div class="listing_details_info_center">--}}
                    {{--<ul>--}}
                    {{--@if(isset($listing->events) && count($listing->events) > 0)--}}
                    {{--@foreach($listing->events as $key => $val)--}}
                    {{--<li>{{ \Carbon\Carbon::parse($val->start)->format('d F Y') }}</li>--}}
                    {{--@endforeach--}}
                    {{--@else--}}
                    {{--<li>N/A</li>--}}
                    {{--@endif--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="listing_details_info_right">--}}
                    {{--<ul>--}}
                    {{--@if(isset($listing->events) && count($listing->events) > 0)--}}
                    {{--@foreach($listing->events as $key => $val)--}}
                    {{--<li>{{ \Carbon\Carbon::parse($val->end)->format('d F Y') }}</li>--}}
                    {{--@endforeach--}}
                    {{--@else--}}
                    {{--<li>N/A</li>--}}
                    {{--@endif--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="single_listing_amenities single_listing_details">
                        <div class="listing_details_head">
                            <h5>amenities</h5>
                        </div>
                        <div class="listing_details_info_center">
                            <ul>
                                @foreach($options['amenity'] as $i => $amenity)
                                    @if($i <= count($options['amenity']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="listing_details_info_right">
                            <ul>
                                @foreach($options['amenity'] as $i => $amenity)
                                    @if($i > count($options['amenity']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single_listing_amenities single_listing_details">
                        <div class="listing_details_head">
                            <h5>specifications</h5>
                        </div>
                        <div class="listing_details_info_center">
                            <ul>
                                @foreach($options['spec'] as $i => $amenity)
                                    @if($i <= count($options['spec']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="listing_details_info_right">
                            <ul>
                                @foreach($options['spec'] as $i => $amenity)
                                    @if($i > count($options['spec']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single_listing_prices single_listing_details">
                        <div class="listing_details_head">
                            <h5>prices</h5>
                        </div>
                        <div class="listing_details_info_center">
                            <ul>
                                <li>Price: {{ $listing->currency->symbol }} {{ $listing->price }} / night</li>
                            </ul>
                        </div>
                        <div class="listing_details_info_right">
                            <ul>
                                <li>Cancellation: {{ \App\Model\Listing::cancellationOptions($listing->cancellation_type) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="single_listing_description single_listing_details">
                        <div class="listing_details_head">
                            <h5>description</h5>
                        </div>
                        <div class="listing_description_details_info">
                            <h6>the space</h6>
                            <p style="overflow-wrap:break-word;">{!! $listing->description !!}</p>
                        </div>
                    </div>
                    <div class="single_listing_house_rules single_listing_details" id="houseRule">
                        <div class="listing_details_head">
                            <h5>house rules</h5>
                        </div>
                        <div class="listing_house_rules_details_info">
                            @foreach($allRules as $rule)
                                @if(in_array($rule->id, $listingRules))
                                    <h6>{{ $rule->name }}</h6>
                                @else
                                    <h6><strike>{{ $rule->name }}</strike></h6>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="single_listing_safety_features single_listing_details">
                        <div class="listing_details_head">
                            <h5>safety features</h5>
                        </div>
                        <div class="listing_details_info_center">
                            <ul>
                                @foreach($options['safety'] as $i => $amenity)
                                    @if($i <= count($options['safety']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @else
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="listing_details_info_right">
                            <ul>
                                @foreach($options['safety'] as $i => $amenity)
                                    @if($i > count($options['safety']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single_listing_amenities single_listing_details">
                        <div class="listing_details_head">
                            <h5>Spaces</h5>
                        </div>
                        <div class="listing_details_info_center">
                            <ul>
                                @foreach($options['space'] as $i => $amenity)
                                    @if($i <= count($options['space']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="listing_details_info_right">
                            <ul>
                                @foreach($options['space'] as $i => $amenity)
                                    @if($i > count($options['space']) / 2)
                                        <li>{{ $amenity }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single_listing_availability single_listing_details">
                        <div class="listing_details_head">
                            <h5>availability</h5>
                        </div>
                        <div class="listing_details_info_center listing_availability_details_center">
                            <p>Minimum stay: {{ $listing->minimum_night }} Nights</p>
                            <p>Maximum stay: {{ $listing->maximum_night }} Nights</p>
                        </div>
                        <div class="listing_details_info_right">
                            <a href="#">view calendar</a>
                        </div>
                    </div>
                    <div class="single_listing_details single_listing_details_reviews">
                        <h2>0 reviews</h2>
                        <ul>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
                    </div>

                    <div class="single_listing_about_host single_listing_details">
                        <h2><span>about</span> your host</h2>
                        <div class="listing_details_head">
                            <img src="{{ $listing->user->photo() }}" alt="" class="user-img img-circle" />
                        </div>
                        <div class="single_listing_about_host_info">
                            <h3>{{ $listing->user->fullName() }}   </h3>
                            <span class="single_listing_about_post">
                                @if($listing->user->profile->work)
                                    Works at {{$listing->user->profile->work}}@if($listing->user->profile->school){{ ' / Attends '.$listing->user->profile->school }} @endif
                                @endif

                            </span>
                            <p>{!!  $listing->user->profile->self_description  !!}</p>
                            <div class="single_listing_host_reviews_box">
                                <div class="single_listing_host_reviews">
                                    <img src="{{url('')}}/style/assets/img/reviews-icon.svg" alt="" />
                                    <span>reviews</span>
                                </div>
                                <h4>0</h4>
                            </div>
                            @if($listing->user->verified)
                                <div class="single_listing_host_verfied">
                                    <img src="{{url('')}}/style/assets/img/verified-icon.svg">
                                    <span>verified</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 single_listing_right">
                    <div class="single_listing_book_form">
                        <h6>{{ $listing->currency->symbol }} {{ $listing->price }} / night</h6>
                        <form action="{{ route('bookingProcess') }}" method="post" id="bookingprocess">
                            {{ csrf_field() }}
                            <input type="hidden" name="listingid" id="listingid" value="{{ $listing->id }}">
                            <div class="single_listing_book_form_info">
                                <div class="single_listing_book_date_info single_listing_book_date_in">
                                    <span>check in</span>
                                    <input id="datepicker-disable-past" type="text" name="date_from" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">
                                </div>
                                <div class="single_listing_book_date_info single_listing_book_date_out">
                                    <span>check out</span>
                                    <input id="datepicker-disable-out" type="text" name="date_to" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">
                                </div>
                                <div class="guests_dropdown">
                                    <span>how many</span>
                                    <select name="number_of_guest" id="number_of_guest">
                                        <option value="1">1 guests</option>
                                        <option value="2">2 guests</option>
                                        <option value="3">3 guests</option>
                                        <option value="4">4 guests</option>
                                    </select>
                                </div>
                                {{--<br/><br/>--}}
                                <span style="display: none; color: red;" id="notavailable">Not available in above dates</span>
                                <span style="display: none; color: red;" id="notavailable2">Already booked in above dates!</span>
                                <span style="display: none; color: red;" id="notavailable3">Checkin date must be smaller than Checkout date!</span>
                                <br/><br/>
                                @if(Auth::user() && Auth::user()->id != $listing->user_id)
                                    <button type="submit" id="booking" class="btn btn-success btn-lg btn-block">
                                        Request booking
                                    </button>
                                @else
                                    <button onclick="return false;"  id="requestBookingLogin" class="login-btn1 btn btn-success btn-lg btn-block">
                                        Request booking
                                    </button>
                                @endif
                                <div class="single_listing_book_form_info_p">
                                    <p>You won’t be charged yet<br>
                                        This location is trending.<br>
                                        It’s been viewed 350 time today</p>
                                    <img src="{{url('')}}/style/assets/img/book_form_icon.png">
                                </div>
                            </div>
                        </form>
                        <div class="single_listing_map">
                            <div id="map_holder2" style="width: 100%; height: 450px;"></div>
                        </div>
                    </div>
                </div>
                <div class="single_listing_map">
                    <div id="map_holder" style="width: 100%; height: 450px;"></div>
                </div>
            </div>
            <div class="single_listing_similar">
                <h2>similar listings</h2>
                <div class="row">
                    <div class="single_listing_similar_slider">
                        <div class="col-md-4 col-sm-4 col-xs-12 single_listing_similar_slider_box">
                            <div class="single_listing_similar_box">
                                <div class="single_listing_similar_img">
                                    <img src="{{url('')}}/style/assets/img/camels-caravan.png">
                                    <a class="single_listing_similar_fav" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span>$109</span>
                                    <img class="similar_pro_img" src="{{url('')}}/style/assets/img/avatar1.jpg">
                                </div>
                                <div class="single_listing_similar_info">
                                    <h3>Charming house facing the Ocean</h3>
                                    <span>Private room · 1 bed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 single_listing_similar_slider_box">
                            <div class="single_listing_similar_box">
                                <div class="single_listing_similar_img">
                                    <img src="{{url('')}}/style/assets/img/camels-caravan.png">
                                    <a class="single_listing_similar_fav" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span>$109</span>
                                    <img class="similar_pro_img" src="{{url('')}}/style/assets/img/avatar1.jpg">
                                </div>
                                <div class="single_listing_similar_info">
                                    <h3>Belle Chambre sur Balcon Bleu</h3>
                                    <span>Entire home/apt · 4 beds</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 single_listing_similar_slider_box">
                            <div class="single_listing_similar_box">
                                <div class="single_listing_similar_img">
                                    <img src="{{url('')}}/style/assets/img/camels-caravan.png">
                                    <a class="single_listing_similar_fav" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span>$109</span>
                                    <img class="similar_pro_img" src="{{url('')}}/style/assets/img/avatar1.jpg">
                                </div>
                                <div class="single_listing_similar_info">
                                    <h3>Green Oasis Bougainvillea in Casa</h3>
                                    <span>Private room · 1 bed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 single_listing_similar_slider_box">
                            <div class="single_listing_similar_box">
                                <div class="single_listing_similar_img">
                                    <img src="{{url('')}}/style/assets/img/camels-caravan.png">
                                    <a class="single_listing_similar_fav" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span>$109</span>
                                    <img class="similar_pro_img" src="{{url('')}}/style/assets/img/avatar1.jpg">
                                </div>
                                <div class="single_listing_similar_info">
                                    <h3>Charming house facing the Ocean</h3>
                                    <span>Private room · 1 bed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 single_listing_similar_slider_box">
                            <div class="single_listing_similar_box">
                                <div class="single_listing_similar_img">
                                    <img src="{{url('')}}/style/assets/img/camels-caravan.png">
                                    <a class="single_listing_similar_fav" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span>$109</span>
                                    <img class="similar_pro_img" src="{{url('')}}/style/assets/img/avatar1.jpg">
                                </div>
                                <div class="single_listing_similar_info">
                                    <h3>Belle Chambre sur Balcon Bleu</h3>
                                    <span>Entire home/apt · 4 beds</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 single_listing_similar_slider_box">
                            <div class="single_listing_similar_box">
                                <div class="single_listing_similar_img">
                                    <img src="{{url('')}}/style/assets/img/camels-caravan.png">
                                    <a class="single_listing_similar_fav" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span>$109</span>
                                    <img class="similar_pro_img" src="{{url('')}}/style/assets/img/avatar1.jpg">
                                </div>
                                <div class="single_listing_similar_info">
                                    <h3>Green Oasis Bougainvillea in Casa</h3>
                                    <span>Private room · 1 bed</span>
                                </div>
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
    <script>
        window.datesArray = <?php echo $datesToDisable; ?>;

        function dateToYMD(date) {
            var d = date.getDate();
            var m = date.getMonth() + 1; //Month from 0 to 11
            var y = date.getFullYear();
            return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
        }

    </script>
    <script type="text/javascript">

        $('.single_listing_slider').slick({
            centerMode: true,
            centerPadding: '500px',
            slidesToShow: 1,
            responsive: [
                {
                    breakpoint: 1500,
                    settings: {
                        centerMode: true,
                        centerPadding: '300px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        centerMode: true,
                        centerPadding: '300px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        centerMode: true,
                        centerPadding: '200px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: true,
                        centerPadding: '30px',
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.single_listing_portfolio').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });

        $('.single_listing_similar_slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 640,
                    settings: {
                        autoplaySpeed: 1500,
                        slidesToShow: 1
                    }
                }
            ]
        });
        var now = Date.now();
        // var datesArray2 = ['2017-12-26'];
        $("#datepicker-disable-past").datepicker({
            isDisabled: function(date) {
                if (date.valueOf() < now) {
                    return true;
                } else if (window.datesArray.includes(dateToYMD(date))) {
                    return true;
                } else {
                    return false;
                }
//                return date.valueOf() < now ? true : false;
            }
        });
        $("#datepicker-disable-out").datepicker({
            isDisabled: function(date) {
                if (date.valueOf() < now) {
                    return true;
                } else if (window.datesArray.includes(dateToYMD(date))) {
                    return true;
                } else {
                    return false;
                }
//                return date.valueOf() < now ? true : false;
            }
        });

        function initMap() {
            var center = {lat: {{ (!empty($listing->lat) ? $listing->lat:0.0) }}, lng: {{ (!empty($listing->lng) ? $listing->lng:0.0) }}};
            var map = new google.maps.Map(document.getElementById('map_holder'), {
                zoom: 12,
                center: center,
//                mapTypeId: 'terrain'
            });

            // Add the circle for this city to the map.
            var cityCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: center,
                radius: 1000
            });
        }
        function initMap2() {
            var center = {lat: {{ (!empty($listing->lat) ? $listing->lat:0.0) }}, lng: {{ (!empty($listing->lng) ? $listing->lng:0.0) }}};
            var map = new google.maps.Map(document.getElementById('map_holder2'), {
                zoom: 12,
                center: center,
//                mapTypeId: 'terrain'
            });

            // Add the circle for this city to the map.
            var cityCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: center,
                radius: 1000
            });
        }
        $(document).ready(function(){
            initMap();
            initMap2();
        })
        //        $(".book_form_request_btn").click(function (e) {
        //            alert("Homes cannot be booked yet");
        //        });

        $('#booking').click(function (e) {
            e.preventDefault();
            var start = $('#datepicker-disable-past').val();
            var end = $('#datepicker-disable-out').val();
            var checkStart = new Date(start);
            var checkEnd = new Date(end);
            if(checkEnd < checkStart){
                $('#notavailable3').show();
                //$('#datepicker-disable-past').focus();
                $('html, body').animate({
                    scrollTop: $("#datepicker-disable-past").position().top
                }, 'fast');
            } else {
                $('#notavailable3').hide();
                start = start.replace("/", "-");
                start = start.replace("/", "-");
                end = end.replace("/", "-");
                end = end.replace("/", "-");

                $.ajax({
                    method: 'GET',
                    url   : "{{url('')}}/dashboard/checklisting/" + '{{ $listing->id }}'+"/"+start+"/"+end,
                    success: function(response){
//                        console.log(response);
                        if(response.booking > response.event){
                            $('#notavailable2').show();
                        } else {
                            if(response.booking === 0 && response.event === 0){
                                $('#bookingprocess').submit();
                            } else {
                                $('#notavailable').show();
                            }
                        }
                    }
                });
            }
        });

        $('#requestBookingLogin').click(function (e) {
            e.preventDefault();
            var redirectTo = window.location.href;
            $('#redirectToField').val(redirectTo);
        });
    </script>
@endsection