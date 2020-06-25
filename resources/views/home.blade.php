@extends('layouts.master')

@section('style-top')
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '507371919639437');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=507371919639437&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
@endsection
@section('content')
<style>

</style>
    <div class="homepage-slides-wrapper  text-center">

        <div class="homepage-slides">
            <div class="slide-bg-2 bgfix"></div>
            <div class="slide-bg-3 bgfix"></div>
            <div class="slide-bg-4 bgfix"></div>
            <div class="slide-bg-1 bgfix"></div>
            <div class="single-slide-item ">
                <div class="slide-item-table ">
                    <div class="slide-item-tablecell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12 slider-text">
                                    <h1>Make The World Your Home</h1>
                                    <p>Rent welcoming &amp; affordable homes <br/>from amazing Muslims worldwide</p>
                                    @if(!auth()->user())
                                    <div class="muzbnb-btn">
                                        <a href="javascript:;" class="slide-btn signup-btn">Get Started – Sign Up</a>
                                    </div>
                                    @endif
                                    <div class="muzbnb-video-btn">
                                        <a href="" class="slide-video-btn" data-toggle="modal" data-target="#watch-video">
                                            <img src="{{ url('style/assets') }}/img/play%20button%20white.png" alt="">
                                        </a>
                                        <span>Watch Video</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row hidden">
                                <div class="relpos">
                                    <div class="posab">
                                        <div class="col-md-10">
                                            <div class="main-search">
                                                <div class="col-md-3 border-right">
                                                    <p>WHERE</p>
                                                    <input type="text" value="ISTANBUL" class="active">
                                                </div>
                                                <div class="col-md-3">
                                                    <p>CHECK IN</p>
                                                    <input class="myDate" type="text" name="date_from" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">
                                                    {{--<input id="datepicker-disable-past" type="text" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">--}}
                                                </div>
                                                <div class="col-md-3 border-right">
                                                    <p>CHECK OUT</p>
                                                    <input class="myDate" type="text" name="date_to" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">
                                                    {{--<input id="datepicker-disable-out" type="text" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">--}}
                                                </div>
                                                <div class="col-md-3">
                                                    <p>
                                                        HOW MANY
                                                    </p>
                                                    <input type="text" value="3 Guests">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="muzbnb-go-button">
                                                <a href="" class="">GO</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /slider -->

    <section id="select_box" class="home-select-box">
        <div class="container">
            <div class="row">
                <form id="banner_select_area">

                    <div class="col-md-11 col-sm-11 col-xs-12">
                        <div class="select_area">
                            <div class="col-lg-3 col-md-3 col-sm-6 single_select_box active-input">
                                <div class="box_title">
                                    <label class="text-upper text-14-18-2 text-grayB3" for="country">WHERE</label>
                                </div>
                                <input type="text" id="userInput2" name="query" value="{{ request('query') }}" style="border: 0px;">
                                <input type="hidden" name="lat" id="lat2" value="{{ request('lat') }}" />
                                <input type="hidden" name="lng" id="lng2" value="{{ request('lng') }}"/>
                                <input type="hidden" name="address1" id="search_address12" value="{{ request('address1') }}"/>
                                <input type="hidden" name="address2" id="search_address22" value="{{ request('address2') }}"/>
                                <input type="hidden" name="city" id="search_city2" value="{{ request('city') }}"/>
                                <input type="hidden" name="state" id="search_state2" value="{{ request('state') }}"/>
                                <input type="hidden" name="country" id="search_country2" value="{{ request('country') }}"/>
                                <input type="hidden" name="zip_code" id="search_zip_code2" value="{{ request('zip_code') }}"/>
                                {{--<select name="country" id="country" class="text-14-18-2">--}}
                                    {{--<option disabled>Select a country</option>--}}
                                    {{--<option value="DZ">Algeria</option>--}}
                                    {{--<option value="AO">Angola</option>--}}
                                    {{--<option value="BJ">Benin</option>--}}
                                    {{--<option value="BW">Botswana</option>--}}
                                    {{--<option value="BF">Burkina Faso</option>--}}
                                    {{--<option value="BI">Burundi</option>--}}
                                    {{--<option value="CM">Cameroon</option>--}}
                                    {{--<option value="CV">Cape Verde</option>--}}
                                    {{--<option value="CF">Central African Republic--}}
                                    {{--</option>--}}
                                {{--</select>--}}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 single_select_box border-none">
                                <div class="box_title">
                                    <label class="text-upper text-14-18-2 text-grayB3" for="check_in_date">CHECK IN</label>
                                </div>
                                <input name="check_in_date" type="text" id="check_in_date" class="form-control datepicker myDate" value="{{ date("Y-m-d") }}">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 single_select_box">
                                <div class="box_title">
                                    <label class="text-upper text-14-18-2 text-grayB3" for="check_out_date">CHECK OUT</label>
                                </div>
                                <input name="check_out_date" type="text" id="check_out_date" class="form-control datepicker myDate" value="{{ date("Y-m-d") }}">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 single_select_box">
                                <div class="box_title">
                                    <label class="text-upper text-14-18-2 text-grayB3" for="guests">HOW MANY</label>
                                </div>
                                <select name="no_of_guest" id="guests" class="text-14-18-2">
                                    <option value="0">Guests Count</option>
                                    <option value="1">1 guests</option>
                                    <option value="2">2 guests</option>
                                    <option value="3">3 guests</option>
                                    <option value="4">4 guests</option>
                                    <option value="5">5 guests</option>
                                    <option value="6">6 guests</option>
                                    <option value="7">7 guests</option>
                                    <option value="8">8 guests</option>
                                    <option value="9">9 guests</option>
                                    <option value="10+">10+ guests</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <button class="back-red" id="select_go">GO</button>
                    </div>
                </form>
            </div>
            <div class="row" id="dateErrorRow" style="display:none">
                <div class="text-center" style="width: 50%;margin: 0 auto;margin-top: 10px;">
                    <p class="alert alert-danger" id="errText"></p>
                </div>
            </div>
        </div>
    </section>

    <div class="muzbnb-content-block text-center big-bg-section">
        <div class="container-fluid coutomwidth">
            <div class="row big-bg-title">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <h1>A Global Community Starting <br/> a Travel Revolution</h1>
                        <p>Join this growing community of travelers, hosts and adventurers.</p>
                    </div>
                </div>
            </div>
            <div class="row big-bg-box">
                <div class="travel-revolution slider">
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="traveler_color" src="{{ url('style/assets') }}/img/traveler_color.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="community_color" src="{{ url('style/assets') }}/img/community_color.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="traveler_color" src="{{ url('style/assets') }}/img/home-middleslide-4.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="hosts_color" src="{{ url('style/assets') }}/img/hosts_color.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="traveler_color" src="{{ url('style/assets') }}/img/traveler_color.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="community_color" src="{{ url('style/assets') }}/img/community_color.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="traveler_color" src="{{ url('style/assets') }}/img/home-middleslide-4.png" alt=""></div>
                        </div>
                    </div>
                    <div class="item-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="bg-one bg-fix"><img class="hosts_color" src="{{ url('style/assets') }}/img/hosts_color.png" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="slick-content-container">
                    <div class="slick-content-wrapper">
                        <div class="slider slider-for slick--next">
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="red">Travelers</span>
                                        <span class="black">who live for</span>
                                        <span class="red">Adventure</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="blue">Communities</span>
                                        <span class="black">who love to</span>
                                        <span class="blue">Connect</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="red">Business Travelers</span>
                                        <span class="black">who appreciate</span>
                                        <span class="red">Comfort</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="blue">Hosts</span>
                                        <span class="black">who enjoy creating</span>
                                        <span class="blue">Experiences</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="red">Travelers</span>
                                        <span class="black">who live for</span>
                                        <span class="red">Adventure</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="blue">Communities</span>
                                        <span class="black">who love to</span>
                                        <span class="blue">Connect</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="red">Business Travelers</span>
                                        <span class="black">who appreciate</span>
                                        <span class="red">Comfort</span>
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="top-section">
                                    <p>MUZBNB IS FOR</p>
                                    <h1>
                                        <span class="blue">Hosts</span>
                                        <span class="black">who enjoy creating</span>
                                        <span class="blue">Experiences</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="muzbnb-content-block info-banner">
        <div class="section-bg-1 bgfix">
            <div class="container ">
                <div class="row">
                    <div class="text-wrapper">
                        <div class="col-md-5 col-md-offset-7 col-sm-12 col-xs-12 section-bg-1-inner">
                            <h2>Feel welcome &amp; have fun when you travel</h2>
                            <p>Create lasting experiences with family, friends or even solo when you travel with Muzbnb.</p>
                            <div class="muzbnb-video-btn">
                                <a href="" class="#slide-video-btn"  data-toggle="modal" data-target="#watch-video2"><img src="{{ url('style/assets') }}/img/Watch%20Video%20Button%20Red.svg" alt=""></a> <span>Watch Video</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="muzbnb-content-block popular-destinations">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="section-title">
                        <h1>Visit The World’s <br/> Most Popular Destinations</h1>
                        <p>Travel the globe, experiencing each city like a local.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-6">
                            <div class="fixingbgissue paris">
                                <div class="gallery-image-title paristext">Paris</div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-6">
                            <div class="fixingbgissue4 morocco">
                                <div class="gallery-image-title moroccotext">Morocco</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="fixingbgissue2 dubai">
                                <div class="gallery-image-title dubaitext">Dubai</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="fixingbgissue3 la">
                                <div class="gallery-image-title latext">L.A.</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="fixingbgissue3 london">
                                <div class="gallery-image-title lotext">London</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="gallery-section-title-2 text-center">
                        <h3>Open your home to the world and become a host</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="fixingbgissue7 newyork">
                        <div class="gallery-image-title newyorktext">New York</div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-6">
                    <div class="fixingbgissue7 indonesia">
                        <div class="gallery-image-title indonesiatext">Indonesia</div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <div class="become-a-host">
                        <div class="bah-inner"><a href="{{route('become-a-host')}}" class=" ">BECOME A HOST</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="muzbnb-content-block section-grey section-mentioned text-center">
        <div class="custom-witdth">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title mart">
                            <h1>As Mentioned In</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="press-slider">
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/Retina.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/Business-Journal-logo.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/the_memo.png" alt=""></div>
                        </div>
                        <div class="item-box item-box-salam">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/salaam_logo.png" class="salam-gateway-logo" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/popsugar.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/layali-header6.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/frommers.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/buzzfeed.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/the tempest.png" alt=""></div>
                        </div>
                        {{--<div class="item-box">--}}
                            {{--<div class="flex-box"><img src="{{ url('style/assets') }}/img/Australian Muslim Times Logo.png" alt=""></div>--}}
                        {{--</div>--}}
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/Washingtonian Logo.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/bnn-logo.png" class="logo-for-mobile-bnn" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/Quartz Logo.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/numerama-lettres-orange.png" class="logo-for-mobile" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/Australasian.png" alt=""></div>
                        </div>
                        <div class="item-box">
                            <div class="flex-box"><img src="{{ url('style/assets') }}/img/salaam-retail-logo-orange.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="muzbnb-content-block text-center ">
        <div class="container section-grey">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-title text-center">
                        <p class="feedback-title">FEEDBACK</p>
                        <h2>See what community influencers are saying</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="testimonials slider">
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/testimonial-1.png" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Imam Johari Abdul-Malik</h2>
                            <p class="subtitle">Director of Outreach for Dar Al Hijrah Islamic Center of Northern Virginia</p>
                            <p class="lessb">"Now is the perfect time for Muzbnb. We owe it to ourselves, Muslims and other people of faith &amp; moral conviction to open our hearts and our homes with Muzbnb. This venture is on the ball."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img text-center">
                            <img src="{{ url('style/assets') }}/img/testimonial-2.png" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Amany Killawi</h2>
                            <p class="subtitle">Co-founder &amp; COO <br> of LaunchGood</p>
                            <p class="lessb">"Muzbnb offers frequent travelers like me an opportunity to further connect and support a Burgeoning Islamic global ecosystem through the simple act of staying in a fellow Muslim's home."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img text-center">
                            <img src="{{ url('style/assets') }}/img/testimonial-9.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Suhaib Webb</h2>
                            <p class="subtitle">American Scholar</p>
                            <p class="lessb">"Muzbnb affords Muslims the blessing of travel while ensuring that the places they stay conform to religious dictates. Additionally, it is a great way to keep the dollar in our community. As a frequent traveler, I look forward to using Muzbnb."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/testimonial-4.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Nana Firman</h2>
                            <p class="subtitle">Co-Founder <br/>of Global Muslim Climate Network</p>
                            <p class="lessb">"I have been a world traveler since I was very young and often dreamed of an easy way to stay with Muslim families in different places. Muzbnb seems to give the answer to my quest! I look forward for more exciting moments."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img text-center">
                            <img src="{{ url('style/assets') }}/img/testimonial-5.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Youssef Kromah</h2>
                            <p class="subtitle">Presenter <br/>on Huda TV Egypt</p>
                            <p class="lessb">"The Prophet Muhammad ﷺ taught us, Muslims, the art of hospitality and courtesy to our guests, so there is no reason why Muzbnb should not only be effective as a business but also as a platform of da'wah. And we ask Allah to make it so."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img text-center">
                            <img src="{{ url('style/assets') }}/img/testimonial-6.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Yasmeen Bint Haneef</h2>
                            <p class="subtitle">Founder &amp; Owner <br/>at Carver's Produce </p>
                            <p class="lessb">"My husband and I travel often and we love connecting with people from diverse backgrounds. We're so excited that we'll be able to connect with Muslims from all over using Muzbnb!"</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/rabia_chaudry.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Rabia Chaudry</h2>
                            <p class="subtitle">National Security Fellow <br />
                                at The New America Foundation</p>
                            <p class="lessb">"Muzbnb is an exciting new venture catering not only to the needs of Muslim travelers but also anyone who wants a family friendly environment.  I'm looking forward to being welcomed by hosts who understand my needs. I highly encourage everyone give it a try."</p>
                        </div>
                    </div>

                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Walid Darab.png" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Walid Darab</h2>
                            <p class="subtitle">Host
                                <br />
                                of the Greed for Ilm podcast</p>
                            <p class="lessb">"Muzbnb offers a platform for Muslim hosts and travelers to keep their hard-earned money within the community, build and expand our social network as well as provide piece of mind when traveling. Our younger generation will thank us for providing a great service like Muzbnb."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Amirah Sackett.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Amirah Sackett</h2>
                            <p class="subtitle">Teacher, Choreographer, Dancer
                                <br />
                                at We’re Muslim, Don’t Panic</p>
                            <p class="lessb">“I always love searching out halal restaurants and mosques while I travel to connect with the local Muslim community. Muzbnb makes finding these connections easier and fills a much needed niche in the lodging industry! “</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Oussama Mezoui.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Oussama Mezoui</h2>
                            <p class="subtitle">President & CEO
                                <br />
                                of Penny Appeal USA</p>
                            <p class="lessb">“Great social entrepreneurs see a problem & through market forces try to provide a solution. That’s exactly what the Muzbnb team is doing. Their desire to use their platform to support humanitarian causes makes their endeavor even more impressive!”</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Hanan Challouki.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Hanan Challouki</h2>
                            <p class="subtitle">Co-founder
                                <br />
                                of Mvslim.com</p>
                            <p class="lessb">"Muzbnb is an initiative that caters to certain needs Muslim travelers have. To be able to connect with Muslims from around the world. And of course, locals always know the best halal restaurants in town, which is also pretty handy."</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Sally Elbassir.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Sally El Bassir</h2>
                            <p class="subtitle"> Blogger
                                <br />
                                at PassportandPlates.com</p>
                            <p class="lessb">"I'm looking forward to using Muzbnb to better connect with fellow Muslims when I'm abroad. It will be nice to support my global "family" away from home!"</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Zobaida Falah.jpeg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Zobaida Falah</h2>
                            <p class="subtitle">Owner<br/>
                                of Cure Bar</p>
                            <p class="lessb">“I will absolutely be using Muzbnb for my next trip and feel it will offer a lot of lucidity to my travel experience. It is such a unique idea and there is definitely a gap in the market for a platform such as this.”</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Zain _ Huda.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Zain & Huda</h2>
                            <p class="subtitle">Bloggers<br/>
                                at MuslimTravelers.com</p>
                            <p class="lessb">“Traveling and meeting Muslims across the world has taught us that the Muslim ummah truly is one family and that we have a home no matter where we go. It's great to see Muzbnb develop a platform that makes this idea a reality!”</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Yvonne Maffei.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Yvonne Maffei</h2>
                            <p class="subtitle">Founder, Publisher<br/>
                                at MyHalalKitchen.com</p>
                            <p class="lessb">“I am so thrilled to see Muzbnb available for our use. What a fantastic opportunity to travel and stay in interesting places that are also comfortable with regards to our lifestyle. It's a phenomenal idea mashaAllah and I wish you guys all the best!”</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Fayaz Nawabi.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Fayaz Nawabi</h2>
                            <p class="subtitle">Public Relations<br/>
                                at CAIR (San Diego)</p>
                            <p class="lessb">“I look forward to using Muzbnb because it not only makes it easier on my wallet, but it also gives me the opportunity to support my fellow Muslim brothers and sisters financially.”</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img">
                            <img src="{{ url('style/assets') }}/img/Preacher Moss.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Preacher Moss</h2>
                            <p class="subtitle">Stand-up Comedian and Writer</p>
                            <p class="lessb">“Muzbnb is a breakthrough for ending the phenomenon of strange Muslims showing up at your house acting like they know you. On behalf of Tablighi Jammat… Go Muzbnb!!”</p>
                        </div>
                    </div>
                    <div class="testimonials-box">
                        <div class="single-testimonial-img text-center">
                            <img src="{{ url('style/assets') }}/img/testimonial-9.jpg" alt="">
                        </div>
                        <div class="single-testimonial-item text-center">
                            <h2>Suhaib Webb</h2>
                            <p class="subtitle">American Scholar</p>
                            <p class="lessb">"Muzbnb affords Muslims the blessing of travel while ensuring that the places they stay conform to religious dictates. Additionally, it is a great way to keep the dollar in our community. As a frequent traveler, I look forward to using Muzbnb."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <div class="muzbnb-content-block section-bg-3 bgfix marfix">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title text-center">
                            <h3>With Muzbnb<sup>TM</sup>, finding a welcoming and accommodating space to rent when you travel is a thing of the past</h3>
                        </div>
                        <p>Join us today as we revive the tradition of exceptional hospitality and adventure.</p>
                        <div class="signup-button">
                            <div class="cta-red-btn"><a href="javascript:;"  class="muzbnn-btn signup-btn">SIGN UP TODAY</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Phone Modal -->
    <div class="modal fade form" id="watch-video">
        <div class="model-vertical">
            <div class="modal-dialog modal-lg video-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="stopVideo()" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                        <p style="font-size: 14px; text-align: left;"><a href="https://vimeo.com/183586043">Introducing Muzbnb: Make The World Your Home</a></p>
                    </div>
                    <div class="modal-body">
                        <iframe src="https://player.vimeo.com/video/183586043?color=1d7899&title=0&byline=0&portrait=0" width="100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade form" id="watch-video2">
        <div class="model-vertical">
            <div class="modal-dialog modal-lg video-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="stopVideo()" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                        <p style="font-size: 14px; text-align: left;"><a href="https://vimeo.com/220155947">Travel &amp; Have Fun</a></p>
                    </div>
                    <div class="modal-body">
                        <iframe src="https://player.vimeo.com/video/220155947?title=0&byline=0&portrait=0" width="100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
