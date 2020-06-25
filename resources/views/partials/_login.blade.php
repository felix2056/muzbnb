{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet"/>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>--}}
<script src="/js/jquery.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>--}}
<script src="/js/bootstrap-new.min.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>--}}
<!-- login Modal -->
<div class="modal fade form" id="login">
    <div class="model-vertical">
        <div class="modal-dialog modal-sm" role="document">
            <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg" alt="logo icon"></div>
            <div class="modal-content modalHeight" id="login_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                    <h4 class="modal-title" id="myModalLabel">Welcome! Please login.</h4>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form id="login-form" method="POST" action="{{ route('login') }}" role="form" style="display: block;">
                            <input type="hidden" id="redirect" value="{{ session('url.intended') }}" />
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Sign in with your e-mail address</label>
                                <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/mail.svg" alt="mail"></span>
                                <input type="email" name="email" id="username" tabindex="1" class="form-control" placeholder="MUZ@MUZBNB.COM" value="">
                                <input type="hidden" name="redirectToField" id="redirectToField" value="">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/lock.png" class="lock-icon" alt="lock"></span>
                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="LogIn">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="pull-left">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label class="text-small" for="remember"> <span></span> Remember</label>
                                </div>
                                <div class="pull-right">
                                    <a href="javascript:;" class="forgot-password">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="title-line">
                        <span>Login via social networks</span>
                    </div>
                    <ul class="login-social">
                        <li class="facebook"><a href="{{ url('login/facebook') }}"><img src="{{ url('style/assets') }}/img/fb-social.png" alt="facebook"></a></li>
                        <li class="twitter"><a href="{{ url('login/twitter') }}"><img src="{{ url('style/assets') }}/img/twitter-social.png" alt="twitter"></a></li>
                        <li class="linkedin"><a href="{{ url('login/linkedin') }}" ><img src="{{ url('style/assets') }}/img/linkedin-social.png" alt="linkedin"></a></li>
                        <li class="google-plus"><a href="{{ url('login/google') }}"><img src="{{ url('style/assets') }}/img/google-plus-social.png" alt="google plus"></a></li>
                    </ul>
                </div>
            </div>

            <div class="modal-content hide" id="reset_password" style="padding:40px 30px 30px;"></div>
        </div>
    </div>
</div>

<!-- signup social Model -->
<div class="modal fade form" id="signup-social">
    <div class="model-vertical">
        <div class="modal-dialog modal-sm" role="document">
            <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg" alt="logo icon"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                    <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <div class="title-line">
                        <span>Signup via social networks</span>
                    </div>
                    <ul class="login-social">
                        <li class="facebook"><a href="{{ url('login/facebook') }}"><img src="{{ url('style/assets') }}/img/fb-social.png" alt="facebook"></a></li>
                        <li class="twitter"><a href="{{ url('login/twitter') }}"><img src="{{ url('style/assets') }}/img/twitter-social.png" alt="twitter"></a></li>
                        <li class="linkedin"><a href="{{ url('login/linkedin') }}" ><img src="{{ url('style/assets') }}/img/linkedin-social.png" alt="linkedin"></a></li>
                        <li class="google-plus"><a href="{{ url('login/google') }}"><img src="{{ url('style/assets') }}/img/google-plus-social.png" alt="google plus"></a></li>
                    </ul>
                    <div class="title-line text"><span>or</span></div>
                    <div class="form-group">
                        <input type="submit" name="login-submit" id="signup-submit" data-dismiss="modal" tabindex="4" class="form-control btn btn-login"  value="Sign up with email">
                    </div>
                    <p class="terms-text">By signing up I agree to Muzbnb’s <br><a href="#">Terms & Policies</a></p>
                </div>
                <div class="modal-footer">
                    <div class="login">
                        <span>Already have an Account?</span> <a href="javascript:;" class="btn btn-default login-btn" style="height:40px; padding:10px 25px;">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- signup Modal -->
<div class="modal fade form" id="signup">
    <div class="model-vertical signup-inner">
        <div class="modal-dialog modal-lg" role="document">
            <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg" alt="logo icon"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-fad" data-dismiss="modal" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                    <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form id="signup-form" method="POST" action="{{ route('register') }}" role="form" style="display: block;">
                            {{ csrf_field() }}
                            <div class="user-field">
                                <div class="row">
                                    {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" name="username" id="signup_username" tabindex="1" class="form-control" placeholder="USERNAME" value="">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/mail.svg" alt="mail"></span>
                                            <input type="email" name="email" id="signup_email" tabindex="2" class="form-control" placeholder="EMAIL">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/lock.png" class="lock-icon" alt="lock"></span>
                                            <input type="password" name="password" id="signup_password" tabindex="2" class="form-control" placeholder="PASSWORD">
                                        </div>
                                    </div>
                                    <input type="hidden" id="referralCode" name="referralCode" value="{{ isset($_REQUEST['referralCode']) && $_REQUEST['referralCode'] != '' ? $_REQUEST['referralCode'] : '' }}">
                                    <input type="hidden" id="refSource" name="refSource" value="{{ isset($_REQUEST['refSource']) && $_REQUEST['refSource'] != '' ? $_REQUEST['refSource'] : '' }}">
                                    {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<span class="input-group-addon"><img src="{{ url('style/assets') }}/img/lock.png" class="lock-icon" alt="lock"></span>--}}
                                            {{--<input type="password" name="password_confirmation" id="signup_password" tabindex="2" class="form-control" placeholder="CONFIRM PASSWORD">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="user-field blue_bg">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="signup_first_name" tabindex="1" class="form-control" placeholder="FIRST NAME" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="signup_last_name" tabindex="2" class="form-control" placeholder="LAST NAME">
                                        </div>
                                    </div>
                                    {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<select class="form-control" name="country" id="country" onChange="stateChange(this.value)">--}}
                                                {{--<option>SELECT COUNTRY</option>--}}
                                                {{--@include('layouts.userCountry')--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<select class="form-control" name="city" id="state">--}}
                                                {{--<option>SELECT CITY</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/time-icon.png" alt="time"></span>
                                            <input type="text" readonly name="date_of_birth" data-date-format="yyyy-mm-dd" id="signup_birth" tabindex="2" class="form-control" placeholder="DATE OF BIRTH">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="input-button">
                                                <ul>
                                                    <li class="male-li">
                                                        <label for="male" class="male-radio">Male</label>
                                                        <input type="radio" name="gender" id="male" value="Male">
                                                    </li>
                                                    <li class="female-li">
                                                        <label for="female" class="female-radio">Female</label>
                                                        <input type="radio" name="gender" id="female" value="Female">
                                                    </li>

                                                    <script>
                                                        $('.male-radio').click(function (e) {
                                                            $('.male-li').addClass('active');
                                                            $('#male').attr('checked','checked');
                                                            $('.female-li').removeClass('active');
                                                            $('#female').removeAttr('checked');
                                                        });
                                                        $('.female-radio').click(function (e) {
                                                            $('.female-li').addClass('active');
                                                            $('#female').attr('checked','checked');
                                                            $('.male-li').removeClass('active');
                                                            $('#male').removeAttr('checked');
                                                        });
                                                    </script>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group btn-field">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" id="create-account" tabindex="4" class="form-control btn btn-login" value="CREATE ACCOUNT">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="title-line">
                        <span>Signup via social networks</span>
                    </div>
                    <ul class="login-social">
                        <li class="facebook"><a href="{{ url('login/facebook') }}"><img src="{{ url('style/assets') }}/img/fb-social.png" alt="facebook"></a></li>
                        <li class="twitter"><a href="{{ url('login/twitter') }}"><img src="{{ url('style/assets') }}/img/twitter-social.png" alt="twitter"></a></li>
                        <li class="linkedin"><a href="{{ url('login/linkedin') }}" ><img src="{{ url('style/assets') }}/img/linkedin-social.png" alt="linkedin"></a></li>
                        <li class="google-plus"><a href="{{ url('login/google') }}"><img src="{{ url('style/assets') }}/img/google-plus-social.png" alt="google plus"></a></li>
                    </ul>
                    <p class="terms-text">By signing up I agree to Muzbnb’s <a href="#">Terms &amp; Policies</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty($script))
<!-- login Modal -->
<div class="modal fade form" id="confirm_password" data-backdrop="static">
    <div class="model-vertical">
        <div class="modal-dialog modal-sm" role="document">
            <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg" alt="logo icon"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close redirect-home" data-home="{{ route('home') }}"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                    <h4 class="modal-title" id="myModalLabel">Reset Password.</h4>
                </div>
                <div class="modal-body">
                    @include('partials.password_reset')
                </div>
            </div>

        </div>
    </div>
</div>
@endif

{{--<script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>--}}



<script type="text/javascript">
    $(document).ready(function(){

        $("#signup_birth").datepicker({
            format: "yyyy-mm-dd",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage: "images/calendar.gif",
            buttonImageOnly: true,
            autoclose: 1,
            startView: 2,
            minView: 2,
            startDate : new Date('1900-01-01'),
            endDate : new Date('1999-12-30'),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#signup_birth').datepicker('setStartDate', minDate);
        });
    });
</script>
<script type="text/javascript">

    /* --- Signup --- */
    $('#signup-submit').click(function(){
        $('#signup-social')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $('#signup').modal('show');
                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
            });

    });
    /* --- Login --- */
    $('#log-in-submit').click(function(){
        $('#signup-social')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $('#login').modal('show');
                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
            });

    });
    if(location.hash == "#signup") {
        $('#signup').modal('show');
    }
    if(location.hash == "#login") {
        $('#login').modal('show');
    }
    $('#login-submit').click(function (e) {
        e.preventDefault();
        var url = $('#login-form').attr('action');
        var email = $('#username').val();
        var password = $('#password').val();
        var remember = $("#remember").is(":checked");
        var redirectToField = $('#redirectToField').val();
        if(redirectToField != ''){
            window.redirectTo = redirectToField;
        }

        setTimeout(function(){
            ajax_login_call(url, email, password, remember);
        }, 0);
    });

    function ajax_login_call(url, email, password, remember){
        loading();
        $.ajax({
            type: "POST",
            url   : url,
            data  : {
                email:email,
                password: password,
                remember: remember,
                _token : "{{csrf_token()}}"
            },
            success: function (response) {
                //console.log(response);
                if(response.errors){
                    toastr.error(response.errors, 'Error Loggin in!');
                } else {
                    if(window.redirectTo) {
                        var to = window.redirectTo;
                        window.redirectTo = false;
                        window.location.href = to;
                        return false;
                    } else {
                        var to = $("#redirect").val();
                        location.hash = "";
                        if(to.length > 1) {
                            window.location.href = to;
                            return false;
                        } else {
                            if(window.location.pathname == '/become-a-host'){
                                window.location.href = '/add-listing';
                                return false;
                            } else {
                                window.location.href = '/';
                                return false;
                            }
                        }
                    }
                }
            },
            error: function (response) {
                var data = response.responseJSON;
                toastr.error(Object.values(data)[0], 'Error Loggin in!')
            },
            complete: function (data) {
                loaded();
            }
        });
    }

    $('#create-account').click(function (e) {
        e.preventDefault();
        var url = $('#signup-form').attr('action');
        setTimeout(function(){
            ajax_call(url);
        }, 0);
    });

    function ajax_call(url){
//        var username = $('#signup_username').val();
        var email = $('#signup_email').val();
        var password = $('#signup_password').val();
        var first_name = $('#signup_first_name').val();
        var last_name = $('#signup_last_name').val();
//        var country = $('#country option[selected=\"selected\"]').text();
//        var city = $('#state option:selected').text();
        var date_of_birth = $('#signup_birth').val();
        var gender = $('input[name=gender]:checked').val();
//        var passCon = $('#signup_password').val();
        var referralCode = $('#referralCode').val();
        var refSource = $('#refSource').val();

        loading();
        $.ajax({
            type: "POST",
            url   : url,
            data  : {
//                username:username,
                first_name: first_name,
                last_name: last_name,
                email: email,
                date_of_birth: date_of_birth,
                password: password,
//                password_confirmation: passCon,
                gender: gender,
                refSource: refSource,
                referralCode: referralCode,
//                country: country,
//                city: city,
                _token : "{{csrf_token()}}"
            },
            success: function (responce) {
                debugger;
                if(responce.errors){
                    toastr.error(responce.errors, 'Error in Signup!');
                    return;
                }
                if(window.redirectTo) {
                    var to = window.redirectTo;
                    window.redirectTo = false;
                    window.location.href = to;
                } else {
                    location.hash = "";
                    var to = $("#redirect").val();
                    if(to.length > 1) {
                        window.location.href = to;
                    } else {
                        if(window.location.pathname == '/become-a-host'){
                            window.location.href = '/add-listing';
                        } else {
                            window.location.reload();
                        }
                    }
                }
            },
            error: function (response) {
                var data = response.responseJSON;
                toastr.error("Check the form data", 'Error Logging in!');
            },
            complete: function (data) {
                loaded();
            }
        });

    }

    $(".login-social li a").click(function (e) {
        if(window.redirectTo) {
            e.preventDefault();
            var a = $(this).attr('href') + '?redirect=' + redirectTo;
            window.location.href = a;
        }
    });
    function loginTo(to) {
        window.redirectTo = to;
        $("#login").modal('show');
    }

//    $(window).on("load",function(){
//        $("#signup-social .modal-content, #signup .modal-content, #login .modal-content").mCustomScrollbar({
//            mouseWheelPixels: 1000
//        });
//    });

    $(document).on('click', '.forgot-password', function(){
        $("#login_form").addClass('hide');
        $.ajax({
            url: '/password/reset',
            type: 'GET',
            success:function(response){
                $("#reset_password").html(response).removeClass('hide');
            }
        });
    });
    $(document).on('click', '.send-reset-link', function(){
        var formData = $("#send_reset_link").serialize();
        var url = $("#send_reset_link").attr('action');
        $(this).prop('disabled', true);
        if($("#reset_email").val() != ''){
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success:function(response){
                    if(response.status){
                        $("#reset_password").html(response.message).removeClass('hide');
                    } else {
                        $("#notification_message").html(response.message).removeClass('alert-success hide').addClass('alert-danger');
                        $('.send-reset-link').prop('disabled', false);
                    }
                }
            });
        } else {
            $(this).prop('disabled', false);
            $("#notification_message").html('Please enter valid email address.').removeClass('alert-success hide').addClass('alert-danger');
        }
    });
    $(document).on('click', '.back-to-login', function(){
        $("#login_form").removeClass('hide');
        $("#reset_password").addClass('hide');
    });
    $(document).on('click', '.login-btn', function(){
        $('#redirectToField').val('');
        $("#login_form").removeClass('hide');
        $("#reset_password").addClass('hide');
        $("#signup-social").modal('hide');
        setTimeout(function(){
            $("#login").modal('show');
        }, 500);
    });
    $(document).on('click', '.login-btn1', function(){
        $("#login_form").removeClass('hide');
        $("#reset_password").addClass('hide');
        $("#signup-social").modal('hide');
        setTimeout(function(){
            $("#login").modal('show');
        }, 500);
    });
    $(document).on('click', '.signup-btn', function(){
        $("#signup-social").modal('show');
    });
    $(document).on('click', '.redirect-home', function(){
        window.location = ''+($(this).attr('data-home'))+'';
    });
    $(document).on('click', '.save-continue', function(){
        var formData = $("#update_password").serialize();
        var url = $("#update_password").attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success:function(response){
                if(response.status){
                    $("#confirm_password").find('.modal-content').html(response.message);
                } else {
                    $("#confirm_password").find('.modal-body').html(response.message);
                }
            }
        });
    });
</script>
@if(!empty($script))
    {!! $script !!}
@endif
