@extends('user.dashboard.layout')

@section('title', 'My Account')
@section('style-top')
    <style>
        .user-content {
            padding: 80px 0px !important;
        }
    </style>
@endsection

@section('tabcontent')

    <div class="container-fluid box-width profile">
        <div class="row">
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                {{--<div class="section-title">--}}
                    {{--<h1 class="text-center">Text Message Settings</h1>--}}
                    {{--<hr>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="section-title">
                            {{--<h1 class="text-center">Text Message Settings</h1>--}}
                            {{--<hr>--}}
                        </div>
                        <div class="left-menu move-up">
                            <a href="#" class="active">
                                <h3>Settings</h3>
                            </a>
                            <a href="/dashboard/transaction">
                                <h3>Transactions</h3>
                            </a>
                            <a href="#">
                                <h3>Travel Credits</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h1 class="">Text Message Settings</h1>
                        <div class="row">
                            <div class="col-xs-12">
                                <div>
                                    Receive SMS notifications to:
                                </div>

                                <div class="checkbox offer-check messaging-checkboxes">
                                    <label>
                                        <input name="smsOptions[]" type="checkbox" value="1" @if(auth()->user()->profile->sms_messages) checked @endif>
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        Messages<br />
                                        <span class="hints">From hosts and guests</span>
                                    </label>
                                </div>
                                <div class="checkbox offer-check">
                                    <label>
                                        <input name="smsOptions[]" type="checkbox" value="2" @if(auth()->user()->profile->sms_reservation) checked @endif>
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        Reservation Updates<br />
                                        <span class="hints">Requests, confirmations, changes and more</span>
                                    </label>
                                </div>
                                <div class="checkbox offer-check">
                                    <label>
                                        <input name="smsOptions[]" type="checkbox" value="3" @if(auth()->user()->profile->sms_other) checked @endif>
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        Other<br />
                                        <span class="hints">Feature updates and more</span>
                                    </label>
                                </div>

                                <div class="col-md-4 col-xs-6 col-xs-offset-3 col-md-offset-0 listing-types">
                                    <a class="btn btn-block btn-danger" data-toggle="modal" data-target="#managePhone" id="manage-phone-number">Manage phone numbers</a>
                                    <span style="display: block;height: 15px;"></span>
                                </div>

                                <div class="info-content">
                                    <div class="form-group">
                                        <div class="next-btn">
                                            <a href="#" class="tab-btn" id="saveSettings" style="">Save Settings</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-heading">
                                    <h3>Payment Methods</h3>
                                </div>
                                <div class="info-content">
                                    @if(isset($stripeCustCards) && count($stripeCustCards) > 0)
                                        @foreach($stripeCustCards as $key => $obj)
                                            @if($loop->first)
                                                @php
                                                    $style = 'padding-left:0px;';
                                                @endphp
                                            @else
                                                @php
                                                    $style = 'padding-left:0px;';
                                                @endphp
                                            @endif
                                            @if($loop->index != 0 && ($loop->index % 2) == 0)
                                                <br>
                                            @endif
                                            <div class="col-md-4" style="{{ $style }}">
                                                <div class="add-payment-method" style="width:auto;">
                                                    <div class="plus-icon">
                                                        <p>********{{ $obj->last4 }}</p>
                                                    </div>
                                                    <div class="payment-card checkout-payment" style="padding-top: 0px;">
                                                        <ul  style="max-height:70px; padding:10px;">
                                                            @if($obj->brand == 'Visa')
                                                                <li>
                                                                    <img src="{{asset('images/visa.jpg')}}">
                                                                </li>
                                                            @elseif($obj->brand == 'Amex')
                                                                <li>
                                                                    <img src="{{asset('images/amex.png')}}">
                                                                </li>
                                                            @elseif($obj->brand == 'Master')
                                                                <li>
                                                                    <img src="{{asset('images/master.png')}}">
                                                                </li>
                                                            @elseif($obj->brand == 'Discover')
                                                                <li>
                                                                    <img src="{{asset('images/Discover.jpg')}}">
                                                                </li>
                                                            @else
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <br>

                                    <div class="add-payment-method" style="clear:both;">
                                        <div class="plus-icon">
                                            <a data-toggle="modal" data-target="#payment">
                                                <i class="fa fa-plus fa-4x"></i>
                                            </a>
                                        </div>
                                        <p>
                                            Add Payment Method
                                        </p>
                                    </div>
                                    <p>
                                        Remember: Muzbnb will never ask you to wire money. <a href="javascript:return false;">Learn More</a>
                                    </p>
                                </div>

                                <div class="section-heading">
                                    <h3>Payout Methods</h3>
                                </div>
                                <div class="info-content">

                                    @if(isset($recipientAccounts) && count($recipientAccounts) > 0)
                                        @foreach($recipientAccounts as $k => $val)
                                            @if($loop->first)
                                                @php
                                                    $style = 'padding-left:0px;';
                                                @endphp
                                            @else
                                                @php
                                                    $style = 'padding-left:0px;';
                                                @endphp
                                            @endif
                                            @if($loop->index != 0 && ($loop->index % 2) == 0)
                                                <br>
                                            @endif
                                            <div class="col-md-4" style="{{ $style }}">
                                             @if( isset($val['type'] ) && $val['type']== "paypal")
                                                <div class="add-payment-method" style="width:auto;">
                                                    <div class="plus-icon">
                                                        <p>{{ isset($val['type'] )? $val['type'] : "N/A"}}, {{ isset($val['currency']  )? $val['currency']: "N/A"}}</p>
                                                    </div>
                                                    <div class="payment-card checkout-payment" style="padding-top: 0px;">
                                                        <ul style="max-height:70px; padding:10px;">
                                                            <li>{{ isset($val['emailAddress'] )? $val['emailAddress'] : "N/A" }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="add-payment-method" style="width:auto;">
                                                    <div class="plus-icon">
                                                        <p>{{ isset($val['bankName'])? $val['bankName'] : "N/A" }}, {{ isset($val['country'])? $val['country'] : "N/A" }}</p>
                                                    </div>
                                                    <div class="payment-card checkout-payment" style="padding-top: 0px;">
                                                        <ul style="max-height:70px; padding:10px;">
                                                            <li>{{ isset($val['accountNum'] )? $val['accountNum'] : "N/A"  }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 @endif


                                            </div>
                                        @endforeach
                                    @endif
                                    <br>

                                    <div class="add-payment-method" style="clear:both;">
                                        <div class="plus-icon"><a href="/dashboard/method"><i class="fa fa-plus fa-4x"></i></a></div>
                                        <p>
                                            Add Payout Method
                                        </p>
                                    </div>
                                    <p>
                                        Remember: Muzbnb will never ask you to wire money. <a href="javascript:return false;">Learn More</a>
                                    </p>
                                </div>

                                <div class="section-heading">
                                    <h3>Change Your Password</h3>
                                </div>
                                <div class="info-content listing-types row">
                                    <div class="col-md-5">
                                        <div class="form-group place-listing">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                    <label class="label">Old Password</label>
                                                    <input class="form-control" type="password" name="old-password" id="oldPassword" required="required" placeholder="******">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group place-listing">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                    <label class="label">New Password</label>
                                                    <input class="form-control" type="password" name="new-password" id="newPassword" required="required" placeholder="******">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group place-listing">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                    <label class="label">Confirm Password</label>
                                                    <input class="form-control" type="password" name="verify-password" id="verifyPassword" required="required" placeholder="******">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="next-btn">
                                            <a href="#" id="updatePassword" class="tab-btn">Update Password</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-heading">
                                    <h3>Deactivate Account</h3>
                                </div>
                                <div class="info-content">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="next-btn">
                                                <a href="#" id="deactivateUser" class="tab-btn">Deactivate now</a>
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

    <div class="modal fade form" id="managePhone">
        <div class="model-vertical">
            <div class="modal-dialog modal-sm" role="document">
                <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg"
                                                        alt="logo icon"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                    src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                        <h4 class="modal-title" id="myModalLabel">Your Numbers</h4>
                    </div>
                    <div class="modal-body phone-numbers">
                        @foreach(auth()->user()->phoneNumbers as $number)
                        <p>
                            {{ $number->code . $number->number }}
                            <span class="pull-right" data-id="{{ $number->id }}">
                                <a class="verifyNow" href="#" {!! $number->verified ? 'disabled title="Verified"' : 'title="Verify Now"' !!}>
                                    <i class="fa fa-check-circle{{ $number->verified ? '' : '-o' }}"></i>
                                </a>
                                <a class="makeDefault" href="#" {!! $number->is_default ? 'disabled title="Default"' : 'title="Make Default"' !!}>
                                    <i class="fa fa-star{{ $number->is_default ? '' : '-o' }}"></i>
                                </a>
                                <a class="delete" href="#" title="Delete"><i class="fa fa-trash-o"></i></a>
                            </span>
                        </p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-5">
                                <label class="label">Country Code</label>
                                {!! \App\Model\Country::listAll('phone_code', null, ['dial_code', 'name'], 'dial_code', ['id'=>'phoneCode', 'class'=> 'form-control']) !!}
                            </div>
                            <div class="col-xs-7">
                                <label class="label">Phone Number</label>
                                <input class="form-control" type="text" name="phone_number" placeholder="_______" id="phoneNumber">
                            </div>
                        </div>
                        <a href="javascript:void(addNumber())" class="form-control btn btn-login">Add Number</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Phone Modal -->
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



    <!-- payment method Modal -->
    <div id="payment" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalHeight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="payment-title">Add New Payment Method</h4>
                </div>
                <form action="{{ route('in-method') }}" class="payment-method" id="paymentMethodForm" method="post">
                    {{ csrf_field() }}
                    <div class="payment-card">
                        <ul>
                            <li><img src="/images/visa.jpg"/> </li>
                            <li><img src="/images/master.png"/> </li>
                            <li><img src="/images/amex.png"/> </li>
                            <li><img src="/images/Discover.jpg"/> </li>
                        </ul>
                    </div>
                    <div class="row" id="errDiv" style="display:none;">
                        <div id="stripeErrMsg" class="alert alert-danger">
                        </div>
                    </div>
                    <div class="modal-body payment-method-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cardNumber">Card Number *</label>
                                    <input type="number" class="form-control" id="cardNumber" name="cardNumber" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label for="expire">Expires on *</label>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input type="number" class="form-control" id="expityMonth" name="expityMonth" required="required" placeholder="MM">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input type="number" class="form-control" id="expityYear" name="expityYear" required="required" placeholder="YYYY">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="expCvc">Security code *</label>
                                            <input type="number" class="form-control" id="expCvc" name="expCvc" required="required">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fname">First Name *</label>
                                            <input type="text" class="form-control" id="fname" name="fname" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lname">Last Name *</label>
                                            <input type="text" class="form-control" id="lname" name="lname" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address1">Address Line 1 </label>
                                    <input type="text" class="form-control" id="address1" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address2">Address Line 2 </label>
                                    <input type="text" class="form-control" id="address2" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcode">Zip Code *</label>
                                    <input type="number" class="form-control" id="pcode" required="required" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city">City *</label>
                                    <input type="text" class="form-control" id="city" required="required" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="state">State </label>
                                    <input type="text" class="form-control" id="state"  placeholder="AL" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ccode">Country</label>
                                    <select class="form-control" name="ccode" id="ccode">
                                        <option value="AF">Afghanistan</option>
                                        <option value="AX">Åland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia, Plurinational State of</option>
                                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Côte d'Ivoire</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CW">Curaçao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran, Islamic Republic of</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao</option>
                                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestinian Territory, Occupied</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Réunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="BL">Saint Barthélemy</option>
                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin (French part)</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SX">Sint Maarten (Dutch part)</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands, British</option>
                                        <option value="VI">Virgin Islands, U.S.</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-md" id="addPaymentInfo">Add Card</button>
                </div>
                </form>
            </div>

        </div>
    </div>
@endsection



@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">

        function addNumber() {
            var code = $("#phoneCode").val();
            var number = $("#phoneNumber").val();
            if(number.length < 5) {
                toastr.error('Wrong Number.', 'Sorry!');
                return;
            }
            loading();
            $.ajax({
                url: '{{ route('add-number') }}',
                type: 'post',
                data: {
                    code: code,
                    number: number,
                    _token: $('[name=_token]').val()
                },
                success: function (data) {
                    var code = JSON.parse(data.code);
                    var id = JSON.parse(data.id);
                    if (code == 200) {
                        $(".phone-numbers").append("<p>" + code + number
                            + '<span class="pull-right" data-id="' + id + '">'
                            + '<a class="makeDefault" href="#" title="Verify Now"><i class="fa fa-check-circle-o"></i></a>'
                            + '<a class="makeDefault" href="#" title="Make Default"><i class="fa fa-star-o"></i></a>'
                            + '<a class="delete" href="#" title="Delete"><i class="fa fa-trash-o"></i></a>'
                            + '</span>');
                        $("#phoneNumber").val('');
                    } else {
                        toastr.error('Something went wrong.', 'Sorry!');
                    }
                },
                error: function (data) {
                    toastr.error('Something went wrong.', 'Sorry!');
                },
                complete: function (data) {
                    loaded();
                }
            });
        }

        $(".phone-numbers").on('click', '.makeDefault', function(e) {
            e.preventDefault();
            var $this = $(this);
            if(this.hasAttribute('disabled')) {
                return false;
            }
            var id = $(this).closest('span').data('id');
            loading();
            $.ajax({
                url: '{{ route('change-default-phone') }}',
                type: 'post',
                data: {
                    id: id,
                    _token: $('[name=_token]').val()
                },
                success: function (data) {
                    var code = JSON.parse(data.code);
                    if (code == -1) {
                        toastr.error('Something went wrong.', 'Sorry!');
                    } else {
                        $(".makeDefault")
                            .removeAttr('disabled')
                            .attr('title', 'Make Default')
                            .children('i.fa-star').removeClass('fa-star').addClass('fa-star-o');
                        $this.attr('disabled', 'disabled').attr('title', 'Default').children('i').removeClass('fa-star-o').addClass('fa-star');
                    }
                },
                error: function (data) {
                    toastr.error('Something went wrong.', 'Sorry!');
                },
                complete: function (data) {
                    loaded();
                }
            });
        });

        $(".phone-numbers").on('click', '.delete', function(e) {
            e.preventDefault();
            var $this = $(this);
            if($this.siblings('.makeDefault')[0].hasAttribute('disabled')) {
                toastr.error('You cannot delete your default phone number.', 'Sorry!');
                return;
            }

            var id = $(this).closest('span').data('id');
            console.log($this);
            if(confirm('Are you sure to delete this phone number?')) {
                loading();
                $.ajax({
                    url: '{{ route('delete-phone') }}',
                    type: 'post',
                    data: {
                        id: id,
                        _token: $('[name=_token]').val()
                    },
                    success: function (data) {
                        var code = JSON.parse(data.code);
                        if (code == 200) {
                            $this.closest('p').remove();
                        } else {
                            toastr.error('Something went wrong.', 'Sorry!');
                        }
                    },
                    error: function (data) {
                        toastr.error('Something went wrong.', 'Sorry!');
                    },
                    complete: function (data) {
                        loaded();
                    }
                });
            }
        });

        $(".verifyNow").click(function(e) {
            e.preventDefault();
            var id = $(this).closest('span').data('id');
            loading();
            $.ajax({
                url: '{{ route('send-sms') }}',
                type: 'post',
                data: {
                    id: id,
                    _token: $('[name=_token]').val()
                },
                success: function (data) {
                    var return_code = JSON.parse(data.return_code);
                    if (return_code == -1) {
                        toastr.error('SMS verification failed.', 'Sorry!');
                    } else {
                        $('#managePhone').modal('hide');
                        setTimeout(function () {
                            $('#phoneVerify').modal('show');
                        }, 500);
                    }
                },
                error: function (data) {
                    toastr.error('SMS verification failed.', 'Sorry!');
                },
                complete: function (data) {
                    loaded();
                }
            });
        });

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
                dataType:"json",
                success: function (data) {
                    var code = data.code;
                    var id = data.id;
                    if (code == 200) {
                        $('span[data-id="' + id + '"] .verifyNow').attr('disabled', 'disabled')
                            .attr('title', 'Verified').children('i').removeClass('fa-check-circle-o').addClass('fa-check-circle');
                        $('#phoneVerify').modal('hide');
                        setTimeout(function () {
                            $('#managePhone').modal('show');
                        }, 500);
                    } else {
                        $(".hint-box").text('Wrong Code!')
                    }
                },
                error: function (data) {
                    toastr.error('Something went wrong.', 'Sorry!')
                },
                complete: function (data) {
                    loaded();
                }
            });
        }

        $('input[name="smsOptions[]"]').change(function () {
            $("#saveSettings").not(':visible').slideDown();
        });

        $("#saveSettings").click(function (e) {
            e.preventDefault();
            var arr = $('input[name="smsOptions[]"]:checked').map(function(){
                return $(this).val();
            }).get();

            var $this = $(this);

            loading();
            $.ajax({
                url: '{{ route('update-sms-settings') }}',
                type: 'post',
                data: {
                    arr: arr,
                    _token: $('[name=_token]').val()
                },
                success: function (data) {
                    var code = JSON.parse(data.code);
                    if (code == -1) {
                        toastr.error('Something went wrong.', 'Sorry!');
                    } else {
                        toastr.success('Successfully saved.', 'All Done!');
                        $this.slideUp();
                    }
                },
                error: function (data) {
                    toastr.error('Something went wrong.', 'Sorry!');
                },
                complete: function (data) {
                    loaded();
                }
            });
        });

        $("#deactivateUser").click(function (e) {
            if(confirm('Are you sure? You\'ll be logged out of your account.')) {
                $.ajax({
                    url: '{{ route('deactivate') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=_token]').val()
                    },
                    complete: function (data) {
                        location.href  = '/';
                    }
                });
            }
        });

        $("#updatePassword").click(function (e) {
            e.preventDefault();
            var op = $("#oldPassword").val();
            var np = $("#newPassword").val();
            var vp = $("#verifyPassword").val();

            if(op.length < 6 || np.length < 6 || vp.length < 6 ) {
                toastr.error('Password length must be at least 6.', 'Error!');
                return;
            }
            if(np !== vp) {
                toastr.error('Passwords do not match.', 'Error!');
                return;
            }
            loading();
            $.ajax({
                url: '{{ route('update-password') }}',
                type: 'post',
                data: {
                    op: op,
                    np: np,
                    vp: vp,
                    _token: $('[name=_token]').val()
                },
                success: function (data) {
                    console.log(data);
                    var code = JSON.parse(data.code);
                    if (code == -1) {
                        toastr.error('Given password doesn\'t match your existing password.', 'Sorry!');
                    } else {
                        toastr.success('Password successfully changed.', 'All Done!');
                        $("#oldPassword").val("");
                        $("#newPassword").val("");
                        $("#verifyPassword").val("");
                    }
                },
                error: function (data) {
                    toastr.error('Something went wrong.', 'Sorry!');
                },
                complete: function (data) {
                    loaded();
                }
            });
        });

        $('#addPaymentInfo').click(function(e){
            e.preventDefault();
            var form  = document.getElementById('paymentMethodForm');
            for(var i=0; i < form.elements.length; i++){
                if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
                    alert('There are some required fields!');
                    return false;
                }
            }

            loading();

            $(this).prop('disabled', true);
            Stripe.setPublishableKey('{{ env('STRIPE_KEY') }}');

            Stripe.card.createToken({
                number: $('#cardNumber').val(),
                cvc: $('#expCvc').val(),
                exp_month: $('#expityMonth').val(),
                exp_year: $('#expityYear').val().slice(-2),
                name: $('#fname').val() + ' ' + $('#lname').val(),
                address_line1: $('#address1').val(),
                address_line2: $('#address2').val(),
                address_city: $('#city').val(),
                address_state: $('#state').val(),
                address_zip: $('#pcode').val(),
                address_country: $('#ccode').val(),
            }, stripeResponseHandler);
            return false;
        });

        function stripeResponseHandler(status, response) {
            loaded();
            if(response.error){
//                console.log(response.error.message);
                $('#stripeErrMsg').html('');
                $('#stripeErrMsg').html('<p>'+response.error.message+'</p>');
                $('#errDiv').show();
                $('#addPaymentInfo').prop('disabled', false);
            }
            else{
                $('#errDiv').hide();
                var token = response.id;
                //$('addBooking').html('');
                $('#paymentMethodForm').append($('<input type="hidden" name="stripeToken" />').val(token));
                {{--$('#addBooking').append($('<input type="hidden" name="bookingId" />').val('{{ $booking->id }}'));--}}
                // Submit the form:
                $('#paymentMethodForm').submit();
            }
        }
    </script>
@endsection