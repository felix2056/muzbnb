@extends('layouts.master')

@section('style-top')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<link href="{{ asset('css/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <style>
        .ambassador-page {
            padding-top: 0px !important;
        }
        .help-block {
            font-size: 14px !important;
            float: left;
        }
        .lowercase {
            text-transform: lowercase !important;
        }
        .notification-div {
            margin-top: 10px;
        }
        .notification-div .alert {
            background-color: white !important;
            border-color: white !important;
            border-radius: 10px;
            margin-bottom: 0px !important;
        }
    </style>
@endsection

@section('content')
    <section class="page-cotnent ambassador-page">
        <div class="ambassador-section1">
            <div class="ambassador-section1-left">
                <img src="{{ asset('images/a-section-img1.png') }}">
                <div class="ambassador-section1-info">
                    <h2>Be an Ambassador</h2>
                    <h6>You will love it.</h6>
                    <p>An honorary group of individuals who will represent Muzbnb in online and offline communities worldwide.</p>
                </div>
            </div>
            <div class="ambassador-section1-right">
                <div class="ambassador-section1-right-img">
                    <img src="{{ asset('images/ambassador-pic1.png') }}">
                    <img src="{{ asset('images/ambassador-pic2.png') }}">
                </div>
            </div>
        </div>
        <div class="ambassador-section2">
            <div class="ambassador-section2-box ambassador-section2-box-hidden">
                <img src="{{ asset('images/ambassador-pic3.png') }}">
            </div>
            <div class="ambassador-section2-box ambassador-section2-box-hidden">
                <img src="{{ asset('images/ambassador-pic4.png') }}">
            </div>
            <div class="ambassador-section2-box">
                <img src="{{ asset('images/ambassador-pic5.png') }}">
            </div>
            <div class="ambassador-section2-right ambassador-section2-box">
                <div class="ambassador-section2-top-full">
                    <div class="ambassador-section2-top">
                        <h2>Join</h2>
                        <h6>Our Team</h6>
                    </div>
                </div>
                <div class="ambassador-section2-bottom-full">
                    <div class="ambassador-section2-bottom">
                        <h5>Apply below</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="ambassador-section3">
            <div class="container ambassador-section3-container">
                <div class="ambassador-section3-left">
                    <div class="ambassador-section3-left-info">
                        <div class="ambassador-section3-head">
                            <h1>The Program</h1>
                            <h6>At A Glance</h6>
                        </div>
                        <div class="ambassador-section3-tab-section">
                            <ul class="nav nav-tabs ambassador-section3-tab">
                                <li class="active"><a data-toggle="tab" href="#description">description</a></li>
                                <li><a data-toggle="tab" href="#benefits">benefits</a></li>
                                <li><a data-toggle="tab" href="#positions">positions</a></li>
                            </ul>

                            <div class="tab-content ambassador-section3-tab-content">
                                <div id="description" class="tab-pane ambassador-tab-description fade in active">
                                    <p>As an ambassador, you will become the gateway in which countless people come to know, love, and understand our organization around the globe. Ambassadors seek to enhance the Muzbnb brand by engaging in fun & innovative marketing projects. Ambassadors will demonstrate leadership, communication skills and high work standards.</p>
                                    <h4>Requirements</h4>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Must be 18+</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Must complete an Ambassador application</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Must be able to commit a consistent amount of work during your tenure as an Ambassador</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Must be a Muzbnb supporter and believe in our mission of encouraging travel, hospitable hosting & the sharing of experiences</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Must be willing to promote Muzbnb to your network of friends, family and associates</p></div>
                                </div>
                                <div id="benefits" class="tab-pane ambassador-tab-description ambassador-tab-benefits fade">
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Monetary compensation</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Travel credits</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Travel merchandise</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Work recognition</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Access to public and private events</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Leadership opportunities</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Internship opportunities</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Employment opportunities</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Training in marketing & communications</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>A résumé-building experience</p></div>
                                    <div class="ambassador-tab-p"><i class="fa fa-circle" aria-hidden="true"></i><p>Association with a highly-visible organization</p></div>
                                </div>
                                <div id="positions" class="tab-pane ambassador-tab-description ambassador-tab-positions fade">
                                    <h4 class="ambassador-tab-positions-m-n">Social Superstar</h4>
                                    <p>Love connecting with friends, family and followers on social media? Join our team as a Social Superstar and do what you do best. Muzbnb Social Superstars utilize social media, namely; Facebook, Twitter, Instagram, Youtube, Snapchat and LinkedIn to promote this new movement in the Muslim community in fun and creative ways. Help us get the message out about Muzbnb all while earning rewards along the way.</p>
                                    <h4>Community Captain</h4>
                                    <p>Muzbnb wants to partner with your mosque, MSA, or organization and bring awareness to our community. Lead the way by becoming a Community Captain and help us spread the word to those in your community. Host events and share travel experiences. Pass out flyers and meet new people. Build your résumé and be privy to special internship opportunities within the Muzbnb organization.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ambassador-section3-right">
                    <div class="ambassador-section3-right-info">
                        <div class="ambassador-section3-head">
                            <img src="{{ asset('images/ambassador-join-icon.png') }}">
                            <div class="ambassador-section3-head-info">
                                <h1>Join Us</h1>
                                <h6>Apply Today</h6>
                            </div>
                        </div>
                        <div class="ambassador-section3-form">
                            <form method="post" id="joinUsForm" action="{{route('saveAmbassador')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="ambassador-form-box ambassador-form-box-left {{ $errors->has('first_name') ? 'has-error':'' }}">
                                    <label class="require-input">First Name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box ambassador-form-box-right {{ $errors->has('last_name') ? 'has-error':'' }}">
                                    <label class="require-input">Last Name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box ambassador-form-date-box {{ $errors->has('date_of_birth') ? 'has-error':'' }}">
                                    <label class="require-input">birth date (MM/DD/YYYY)</label>
                                    <input type="text" class="numeric-only" name="month" value="{{ old('month') }}" id="month" size="2" maxlength="2" required />
                                    <input type="text" class="numeric-only" name="day" value="{{ old('day') }}" id="day" size="2" maxlength="2" required />
                                    <input type="text" class="numeric-only" name="year" value="{{ old('year') }}" id="year" size="4" maxlength="4" required />
                                    <div class="ambassador-date-input">
                                        <input type='text' class="hasDatepicker" id='full' name='fulldate' @if(old('day')) value="{{ old('day').'/'.old('month').'/'.old('year') }}" @endif>
                                    </div>
                                    @if ($errors->has('date_of_birth'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('email') ? 'has-error':'' }}">
                                    <label class="require-input">Email Address</label>
                                    <input type="text" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('facebook') ? 'has-error':'' }}">
                                    <label>Facebook URL {{--<small class="lowercase"> (http://facebook.com)</small>--}}</label>
                                    <input type="text" name="facebook" value="{{ old('facebook') }}">
                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('twitter') ? 'has-error':'' }}">
                                    <label>Twitter URL {{--<small class="lowercase"> (http://twitter.com)</small>--}}</label>
                                    <input type="text" name="twitter" value="{{ old('twitter') }}">
                                    @if ($errors->has('twitter'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('instagram') ? 'has-error':'' }}">
                                    <label>Instagram URL {{--<small class="lowercase"> (http://instagram.com)</small>--}}</label>
                                    <input type="text" name="instagram" value="{{ old('instagram') }}">
                                    @if ($errors->has('instagram'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('instagram') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('country_city') ? 'has-error':'' }}">
                                    <label class="require-input">Country/City</label>
                                    <input type="text" name="country_city" value="{{ old('country_city') }}" required>
                                    @if ($errors->has('country_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('position_apply') ? 'has-error':'' }}">
                                    <label class="require-input">Position Applying For</label>
                                    <select name="position_apply" required>
                                        <option @if(old('position_apply') == 'Social Superstar') selected @endif value="Social Superstar">Social Superstar</option>
                                        <option @if(old('position_apply') == 'Community Captain') selected @endif value="Community Captain">Community Captain</option>
                                    </select>
                                    @if ($errors->has('position_apply'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('position_apply') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="ambassador-form-box {{ $errors->has('reason') ? 'has-error':'' }}">
                                    <label class="require-input">Why are you a good fit for our team?</label>
                                    <textarea rows="7" name="reason" min="150" required>{{ old('reason') }}</textarea>
                                    @if ($errors->has('reason'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <a class="ambassador-form-btn" href="javascript:;">send</a>
                                <div class="hide">
                                    <button type="submit" class="btn btn-small btn-danger submitBtn">submit</button>
                                </div>

                                @if(Session::has('success'))
                                    <div class="notification-div">
                                        <div class="col-md-12 alert alert-success" style="text-align: center;">
                                            <strong>Success!</strong> {!! Session::get('success') !!}
                                        </div>
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="notification-div">
                                        <div class="col-md-12 alert alert-danger" style="text-align: center;">
                                            <strong>Error!</strong> {!! Session::get('error') !!}
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('page_script')
    <script type="text/javascript" src="{{ asset('js/numeric.js') }}"></script>
    @if(Session::has('success') || Session::has('error'))
        <script type="text/javascript">
            $(document).ready(function(){
                $('html, body').scrollTop(parseInt($('#joinUsForm').offset().top) + parseInt(500));
                setTimeout(function(){
                    $('.notification-div').remove();
                }, 5000);
            });
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            $("#full").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                startDate : new Date('1900-01-01'),
                endDate : new Date('1999-12-30')
            }).on("changeDate", function (e) {
                var pieces = $(this).val().split('/');
                $('#day').val(pieces[1]);
                $('#month').val(pieces[0]);
                $('#year').val(pieces[2]);
            });
            $('.numeric-only').numeric();

            $(document).on('click', '.ambassador-form-btn', function(){
                $(".submitBtn").click();
            });
        });
    </script>
@endsection