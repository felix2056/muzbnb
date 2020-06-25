@extends('user.dashboard.layout')

@section('title', 'My Profile')

@section('style-top')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <style>
        .user-content {
            padding: 80px 0px !important;
        }
    </style>
@endsection

@section('tabcontent')
    <div class="container-fluid box-width profile">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 profile-pic">
                <div class="profile-box">
                    <div class="text-center bg-form">
                        <div class="img-section">
                            <span class="glyphicon glyphicon-camera camera"></span>
                            <div class="browse" id="ProPic">
                            </div>
                            <h3>Profile <span>Photo</span></h3>
                            <div class="clearfix">
                                {{--<div class="view-btn">
                                    <a href="" data-toggle="modal" data-target="#webcam" class="btn btn-blue">Webcam</a>
                                </div>--}}
                                <div class="edit-btn">
                                    <h4 class="btn btn-blue browse">Upload</h4>
                                    <input type="checkbox" class="form-control" id="checker">
                                </div>
                            </div>
                            <div class="clearfix">
                                <p>Please upload a photo that clearly shows your face.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-box">
                    <div class="text-center bg-form">
                        <div class="img-section">
                            <h3>Public Profile</h3>
                            <div class="clearfix">
                                <div class="edit-btn">
                                    <a href="/public-profile/{{Auth::user()->id}}" ><h4 class="btn btn-blue">View</h4></a>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p>Your profile allows others to learn more about you before they book your space or host you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 profile-detail">
                <div class="section-title">
                    <h1>My Profile</h1>
                </div>
                @if ($errors->any())
                    <div class="col-xs-12">
                        {!!  implode('', $errors->all('<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         :message</div>'))  !!}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="col-xs-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         {!! Session::get('success') !!}</div>
                    </div>
                @endif
                {!! Form::open(['route'=>'update-user', 'method'=>'POST']) !!}
                    <div class="section-heading">
                        <h3>1. About You</h3>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="label"><span class="required">*</span> First Name</label>
                                <input class="form-control first_name" type="text" name="first_name" required="required" value="{{Auth::user()->first_name}}">
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="label"><span class="required">*</span> Last Name</label>
                                <input class="form-control" type="text" value="{{Auth::user()->last_name}}" name="last_name" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <span class="required">*</span>
                                <select class="form-control gender" name="gender">
                                    <option value="Male" @if(strtolower(Auth::user()->gender)=='male') selected @endif>Male</option>
                                    <option value="Female" @if(strtolower(Auth::user()->gender)=='female') selected @endif>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 birth-day-row">
                                <label class="label"><span class="required">*</span> Birth Date</label>
                                <?php
                                $date_of_birth = date('m j Y',strtotime(Auth::user()->date_of_birth));
                                $date_of_birth = explode(" ", $date_of_birth);
                                ?>
                                {!! Form::select('month', list_for('', 1, 12), $date_of_birth[0], ['class'=>'form-control birth-date']) !!}
                                {!! Form::select('date', list_for('', 1, 31), $date_of_birth[1], ['class'=>'form-control birth-date']) !!}
                                {!! Form::select('year', list_for('', 1901, intval(date('Y')) - 18), $date_of_birth[2], ['class'=>'form-control birth-date']) !!}
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="info-text">That amazing day Allah sent you into this world.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-11 col-sm-12 col-xs-12">
                                <label class="label"><span class="required">*</span> Describe Yourself</label>
                                <textarea class="form-control" rows="11" name="self_description" min="2" required>{{  $profile->self_description }}</textarea>
                            </div>
                            <div class="col-md-11 col-sm-12 col-xs-12">
                                <p class="info-text">Muzbnb is built on relationships. Help other people get to know you.</p>
                                </div>
                        </div>
                    </div>
                    <div class="section-heading heading-space">
                        <h3>2. Contacts &amp; Location</h3>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label class="label"><span class="required">*</span> Country</label>
                                <select class="form-control country" name="country" required>
                                    <option value="{{Auth::user()->country}}">{{Auth::user()->country}}</option>
                                    @include('layouts.userCountry')
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label class="label"><span class="required">*</span> Email Address</label>
                                <input class="form-control" type="email" disabled value="{{Auth::user()->email}}" name="Email" required="required">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="info-text">We won't share your private email address with other users.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4 col-xs-5">
                                <label class="label"><span class="required">*</span> Country Code</label>
                                {!! \App\Model\Country::listAll('phone_code', (!empty($phone->code)) ? $phone->code:'', ['name', 'dial_code'], 'dial_code', ['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-sm-5 col-xs-7">
                                <label class="label"><span class="required">*</span>  Phone Number</label>
                                <input class="form-control" type="text" id="phone_number" name="phone_number" value="{{ (!empty($phone->number)) ? $phone->number:''}}" placeholder="_______" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <p class="info-text">This is only shared once you confirmed booking with another user. This is how we can all get in touch.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group language-group">
                        <div class="row">
                            {{--<div class="col-md-5 col-sm-8 col-xs-8">
                                <label class="label">Preferred Language</label>
                                <select class="form-control language" name="language">
                                    <option value="{{$profile->preferred_lang}}">{{$profile->preferred_lang}}</option>
                                    @if(count($langs)>0)
                                        @foreach($langs as $lang)
                                            @if($lang->lang!=$profile->preferred_lang)
                                                <option value="{{$lang->lang}}">{{$lang->lang}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @include('layouts._languages')
                                    @endif
                                    --}}{{--<option>Roman</option>--}}{{--
                                </select>
                                <p class="info-text">We'll send you message in this language.</p>
                            </div>--}}
                            <div class="col-md-5 col-sm-8 col-xs-8">
                                <label class="label"><span class="required">*</span> Preferred Currency</label>
                                {!! Form::select('preferred_currency', for_select($currencies), $profile->preferred_currency, ['class'=>'form-control currency']) !!}
                                <p class="info-text">We'll show you prices in this currency.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label class="label"><span class="required">*</span> Where you live</label>
                                <input class="form-control" type="text" name="location" value="{{ $profile->location}}" id="address" required>
                            </div>
                        </div>
                    </div>

                    <div class="section-heading heading-space">
                        <h3>3. Optional Details</h3>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label class="label">School</label>
                                <input class="form-control school-input" name="school" type="text" value="{{$profile->school}}" name="School" placeholder="Your School Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label class="label">Work</label>
                                <input class="form-control" type="text" name="work" value="{{$profile->work}}" placeholder="Your work organization name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label class="label"> Timezone</label>
                                {{--<input class="form-control" type="text" name="timezone" value="{{$profile->timezone}}" placeholder="(GMT+03:00) RIYADH">--}}
                                {!! Timezonelist::create('timezone', $profile->timezone, ['class'=>'form-control']) !!}

                                <p class="info-text">Your home time zone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <label class="label">Emergency Contact</label>
                                <input class="form-control" type="text" name="emergency_contact" value="{{$profile->emergency_contact}}" name="Emergency Contact" placeholder="name">
                            </div>
                            <div class="col-sm-4 col-xs-5">
                                <label class="label">&nbsp;</label>
                                {!! \App\Model\Country::listAll('emergency_contact_code', $profile->emergency_contact_code, ['name', 'dial_code'], 'dial_code', ['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-md-4 col-sm-8 col-xs-12">
                                <label class="label">&nbsp;</label>
                                <input class="form-control phone-number" type="text" name="emergency_contact_number" value="{{$profile->emergency_contact_number}}" placeholder="___-____">
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <p class="info-text">Give our Customer Experience team a trusted contact we can alert in a urgent situation.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <label class="label">Language</label>
                                        <a href="javascript:void(0)" class="add-btn add-language"><img src="{{url('')}}/style/assets/img/icon/add-plus.svg" alt="add"> Add Language</a>
                                        <select name="multi[]" id="multi" class="hidden"  multiple>
                                            @foreach(auth()->user()->languages as $language)
                                            <option value="{{$language->lang}}" selected>{{$language->lang}}</option>
                                            @endforeach
                                            @include('layouts._languages')
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <p class="info-text">Add any language that others can use to speak with you.</p>
                            </div>
                        </div>
                    </div>

                    <div class="section-heading heading-space">
                        <h3>4. Verification</h3>
                    </div>
                    <div class="id-box">
                        @if(!auth()->user()->verified)
                            @if(!file_exists(base_path('public') . '/files/users/' . auth()->id()))

                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 style="font-size: 15px;">Be ready to book</h4>
                                        <p style="font-size: 16px;text-align: left;">
                                            You'll need to provide identification before you book, so get a head start by
                                            doing it now.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="next-btn" id="dropfile">
                                            <a href="#" id="uploadId" class="tab-btn profile-provide-btn">Provide ID</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h4>Your profile validation request is in the queue, you'll be notified shortly.</h4>
                            @endif
                        @else
                            <h4>Congratulations, your profile is verified!</h4>
                        @endif
                    </div>
                    <div class="info-content row">
                    <div class="col-sm-12">
                        <div class="section-heading">
                            <h3 style="font-size: 25px;">Email Address</h3>
                        </div>
                        @if(!empty(auth()->user()->email_verified))
                            <p style="font-size: 16px;text-align: left;">
                                You have confirmed your email: {!! auth()->user()->email !!}. A confirmed email is important to allow
                                us to securely communicate with you.
                            </p>
                        @else
                            <p style="font-size: 16px;text-align: left;">
                                Your email address is not verified. <a href="javascript:;" id="sendMail">Verify  {!! auth()->user()->email !!} now</a>
                            </p>
                        @endif
                        <div class="section-heading">
                            <h3 style="font-size: 25px;">Phone Number</h3>
                        </div>

                        @if(!empty(auth()->user()->phoneNumber->number))
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="text-align: left;font-size: 16px;">{!! auth()->user()->phoneNumber->code . auth()->user()->phoneNumber->number !!}
                                        <span class="pull-right phone-status">
                                        @if(auth()->user()->phoneNumber->verified)
                                                Verified
                                            @else
                                                Unverified <a href="#" id="sendSms">Verify now</a>
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endif
                        <p  style="text-align: left;font-size: 16px;">
                            Your number is only shared with Muzbnb member once you have a confirmed booking.
                        </p>
                    </div>
                </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <input type="submit" class="btn btn-red" name="save" value="Save">
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}



            </div>
        </div>
    </div>

    <!-- Webcam Modal -->
    <div class="modal fade form" id="webcam">
        <div class="model-vertical">
            <div class="modal-dialog modal-sm" role="document">
                <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg" alt="logo icon"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                        <h4 class="modal-title" id="myModalLabel">Take a Photo.</h4>
                    </div>
                    <div class="modal-body">

                        <div id="my_camera" style="width:390px; height:390px;"></div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(take_snapshot())" class="form-control btn btn-login">Take Snapshot</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade form" id="phoneVerify">
        <div class="model-vertical">
            <div class="modal-dialog modal-sm" role="document">
                <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg"
                                                        alt="logo icon"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                    src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                        <h4 class="modal-title" id="myModalLabel">Verify Your Number.</h4>
                    </div>
                    <div class="modal-body">
                        <p>We have sent you a sms with a verification code, please put that code bellow.</p>
                        <span style="display: block;height: 25px;"></span>
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                                <input type="number" id="code" class="form-control" name="verification-code"/>
                            </div>
                        </div>
                        <span style="display: block;height: 25px;"></span>
                        <p class="hint-box">
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(checkCode())" class="form-control btn btn-login">Verify</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{mix('js/dashboard.js')}}" rel="stylesheet"></script>
    {{--<script type="text/javascript" src="{{'js/input-mask.js'}}" rel="stylesheet"></script>
    <script type="text/javascript" src="{{'js/input-mask-multi.js'}}" rel="stylesheet"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
        var $dropzone = $("div#ProPic").dropzone({
            url: "/update/user-pro-pic",
            thumbnailWidth: 250,
            thumbnailHeight: 250,
            clickable: '.browse',
            maxFiles: 1,
            init: function() {
                <?php if($profile->avatar) { ?>
                var myDropzone = this, turl = "/images/user/<?= $profile->avatar?>";
                var mockFile = {
                    name: "<?= $profile->avatar?>",
                    size: 1,
//                    type: 'image/jpeg',
                    status: Dropzone.ADDED,
                    url: turl
                };

                // Call the default addedfile event handler
                myDropzone.emit("addedfile", mockFile);

                // And optionally show the thumbnail of the file:
                myDropzone.emit("thumbnail", mockFile, turl);

                myDropzone.files.push(mockFile);
                <?php } else { ?>
                var myDropzone = this, turl = "/images/if_profle.png";
                var mockFile = {
                    name: "<?= $profile->avatar?>",
                    size: 1,
//                    type: 'image/jpeg',
                    status: Dropzone.ADDED,
                    url: turl
                };
                // Call the default addedfile event handler
                myDropzone.emit("addedfile", mockFile);
                // And optionally show the thumbnail of the file:
                myDropzone.emit("thumbnail", mockFile, turl);
                myDropzone.files.push(mockFile);
                <?php }?>
                this.on("addedfile", function() {
                    if (this.files[1]!=null){
                        this.removeFile(this.files[0]);
                    }
                });
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            }
        });

//        Webcam.set({
//            width: 390,
//            height: 390,
//            image_format: 'jpeg',
//            jpeg_quality: 100,
//            force_flash: false,
//            fps: 45
//        });
//        Webcam.attach( '#my_camera' );
//
//        Webcam.on( 'error', function(err) {
//            alert('Sorry, No Camera was found!');
//            $("#webcam").modal('hide');
//        } );
        function addBlob(blob) {
            blob.name = 'myfilename.png';
            if(window.myDropzone) {
                window.myDropzone.addFile(blob);
                console.log(blob);
            }
        }

        function dataURItoBlob(dataURI) {
            // //stackoverflow.com/a/12300351/4578017
            var byteString = atob(dataURI.split(',')[1]);

            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            var blob = new Blob([ab], {type: mimeString});
            return blob;
        }
//        function take_snapshot() {
//            var myDropzone = $dropzone[0].dropzone;
//            Webcam.snap( function(data_uri) {
//                var blob = dataURItoBlob(data_uri);
//                blob.name = 'aac.jpg';
//                myDropzone.addFile(blob);
//
//                $("#webcam").modal('hide');
//            } );
//        }
//        $(".phone-number").mask("(999) 999-9999");
//        var maskList = $.masksSort($.masksLoad("/files/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
//        var maskOpts = {
//            inputmask: {
//                definitions: {
//                    '#': {
//                        validator: "[0-9]",
//                        cardinality: 1
//                    }
//                },
//                //clearIncomplete: true,
//                showMaskOnHover: false,
//                autoUnmask: true
//            },
//            match: /[0-9]/,
//            replace: '#',
//            list: maskList,
//            listKey: "mask",
//            onMaskChange: function(maskObj, completed) {
//                if (completed) {
//                    var hint = maskObj.name_ru;
//                    if (maskObj.desc_ru && maskObj.desc_ru != "") {
//                        hint += " (" + maskObj.desc_ru + ")";
//                    }
//                    $("#descr").html(hint);
//                } else {
//                    $("#descr").html("Маска ввода");
//                }
//                $(this).attr("placeholder", $(this).inputmask("getemptymask"));
//            }
//        };
//        $('.phone-number').inputmasks(maskOpts);
    </script>

    <script>
        function initFind () {

            var input = document.getElementById('address');
            var searchBox = new google.maps.places.Autocomplete(input);

            searchBox.addListener('place_changed', function() {
                var place = searchBox.getPlace();

                if (place.length == 0) {
                    input.value = '';
                    return;
                }
            });
        }
        $(document).ready(function(){initFind()})
    </script>

    @if(!empty(auth()->user()->verified) && !file_exists(base_path('public') . '/files/users/' . auth()->id()))

        <script type="text/javascript" src="{{url('') . '/js/dropzone.js'}}" rel="stylesheet"></script>
        <script type="text/javascript">

            var myDropzone = new Dropzone("div#dropfile", {
                url: "/dashboard/submit",
                clickable: 'a#uploadId',
                maxFilesize: 2, // MB
                acceptedFiles: 'image/*',
                sending: function (file, xhr, formData) {
                    formData.append("_token", $('[name=_token]').val());
                },
                accept: function (file, done) {
                    done();
                    $(".id-box").html("<h4>Thank you for submitting the documents. We'll contact you soon after reviewing your documents.</h4>");
                }
            });

        </script>
    @endif
    @if(!empty(auth()->user()->phoneNumber->verified) || empty(auth()->user()->email_verified))
        <script type="text/javascript">

            var alreadySentEmail = alreadySentSMS = false;
            $(document).on('click', "#sendMail", function (e) {
                if (!alreadySentEmail) {
                    loading();
                    $.ajax({
                        url: '{{ route('send-verification-mail') }}',
                        type: 'post',
                        data: {
                            _token: $('[name=_token]').val()
                        },
                        success: function (data) {
                            alreadySentEmail = true;
                            var return_code = JSON.parse(data.return_code);
                            if (return_code == -1) {
                                toastr.error('Something went wrong! Please try again later.', 'Opps!!!');
                            } else {
                                toastr.success('Please check your inbox.', 'Mail Sent');
                            }
                        },
                        error: function (data) {
                            toastr.error('Something went wrong! Please try again later.', 'Opps!!!');
                        },
                        complete: function (data) {
                            loaded();
                        }
                    });
                }
            });
            $("#sendSms").click(function (e) {
                e.preventDefault();
                if (!alreadySentSMS) {
                    loading();
                    $.ajax({
                        url: '{{ route('send-sms') }}',
                        type: 'post',
                        data: {
                            _token: $('[name=_token]').val()
                        },
                        success: function (data) {
                            alreadySentSMS = true;
                            console.log(data);
                            var return_code = JSON.parse(data.return_code);
                            if (return_code == -1) {
                                alert("SMS verification failed");
                            } else {
                                $('#phoneVerify').modal('show');
                            }
                        },
                        error: function (data) {
                            alert("SMS verification failed");
                        },
                        complete: function (data) {
                            loaded();
                        }
                    });
                }
            })
            function checkCode() {
                var val = $("#code").val();
                if(val.length != 5) {
                    alert('Wrong Code');
                    return;
                }
                loading();
                $.ajax({
                    url: '{{ route('verify-number') }}',
                    type: 'post',
                    data: {
                        code: val,
                        _token: $('[name=_token]').val()
                    },
                    success: function (data) {
                        alreadySent = true;
                        var code = JSON.parse(data.code);
                        console.log(code);
                        if (code == 200) {
                            $(".phone-status").text("Verified!");
                            $('#phoneVerify').modal('hide');
                        } else {
                            $(".hint-box").text('Wrong Code!')
                        }
                    },
                    error: function (data) {
                        alert("SMS verification failed");
                    },
                    complete: function (data) {
                        loaded();
                    }
                });
            }
            function loading() {
                $(".muz-loading").show();
            }
            function loaded() {
                $(".muz-loading").hide();
            }
        </script>
    @endif


@endsection
