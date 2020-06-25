@extends('layouts.masterCheckout')

@section('content')
    <style>
        .checkout {
            padding-top: 0px;
        }
        #trip label {
            font-size: 16px;
            font-weight: 400;
            padding-top: 15px;
        }


        #comment::-webkit-input-placeholder
        {
            color: #888;
            font-size: 14px;
            font-weight: 400;
        }


        #comment:-moz-placeholder
        {
            color: #888;
            font-size: 14px;
            font-weight: 400;
        }

        .tab-info {
            padding-top: 0px !important;
        }

        #comment::-moz-placeholder
        {
            color: #888;
            font-size: 14px;
            font-weight: 400;
        }


        #comment:-ms-input-placeholder
        {
            color: #888;
            font-size: 14px;
            font-weight: 400;
        }
        #trip h2 {
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 30px;
            margin-top: 30px;
        }
        .trip-list ul li {
            border-bottom: 1px solid #ccc;
            display: inline-block;
            font-size: 16px;
            padding-bottom: 15px;
            padding-top: 15px;
            width: 100%;
        }
        .trip-list li:last-child {
            border-bottom: medium none;
        }
        .remember ul li {
            border-bottom: medium none !important;
            list-style: inside none disc !important;
            padding-bottom: 0 !important;
            padding-left: 0;
            padding-right: 0 !important;
            padding-top: 0 !important;
        }
        .remember ul {
            padding-top: 10px;
        }
        .trip-list ul li i {
            float: right;
            color: #1D7699;
        }
        .checkout-image {
            position: relative;
        }
        .image-auther {
            position: absolute;
            height: 70px;
            width: 70px;
            right: 30px;
            bottom: -35px;
        }
        .image-auther img {
            border-radius: 50px;
        }
        .checkout-detail h3 {
            font-size: 24px;
        }
        .checkout-detail span {
            text-align: left;
            font-size: 16px;
            padding-bottom: 15px;
            display: inline-block;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            width: 100%;
        }
        .checkout-detail {
            margin: 15px;
            padding-bottom: 20px;
            padding-top: 5px;
        }
        .checkout-detail ul {
            display: inline-block;
        }
        .checkout-detail ul li{
            display: inline-block;
            color: #1D7699;
        }
        .checkout-detail h3 {
            font-size: 24px;
            font-weight: 400;
        }
        .check-in-out p {
            font-family: 'Montserrat', sans-serif;
            text-align: left;
            font-size: 16px;
            margin: 0;
        }
        .check-in-out {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .check-in-out i {
            font-size: 40px;
            color: #5F5D5E;
        }
        .check-price-left ul li, .check-price-right ul li {
            color: #5F5D5E;
            font-size: 16px;
            display: inline-block;
            width: 100%;
        }
        .check-price-right {
            text-align: right;
        }
        .check-price-left li.blue {
            color: #1D7699;
        }
        .check-in-out span {
            padding-bottom: 0;
        }
        .check-price {
            padding-top: 15px;
        }
        .total-price-left {
            float: left;
        }
        .total-price-right {
            float: right;
        }
        .checkout-total-price {
            padding-top: 20px;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }
        .total-price-left p, .total-price-right p {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            text-align: left;
        }
        .total-price-right span {
            display: inline-block;
            width: auto;
            font-size: 10px;
            vertical-align: top;
            position: relative;
            top: -3px;
        }
        .additonal-rules {
            padding-top: 15px;
        }
        .additonal-rules span.more {
            line-height: 30px;
        }
        .morecontent span {
            display: none;
        }
        .morelink {
            display: block;
        }
        .checkout-sidebar {
            border-left: 1px solid #ccc;
            padding-bottom: 50px;
            margin-top: 0px;
        }
        .payment-main p {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            text-align: left;
        }
        .payment-card.checkout-payment {
            padding-top: 20px;
        }
        .payment-main label {
            font-size: 16px;
            font-weight: 400;
        }
        .expire-year input {
            margin-top: 6px;
        }
        .submit-checkout {
            margin-top: 20px;
        }
        .submit-checkout span {
            font-size: 14px;
            display: block;
            margin-top: 5px;
            margin-bottom: 30px;
        }
        .charity-checkout span {
            width: auto;
            color: #ccc;
            font-size: 16px;
            font-weight: lighter;
            padding-left: 5px;
        }
        .charity-checkout p {
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 16px;
            text-align: left;
            margin-bottom: 25px;
        }
        .charity-checkout img {
            display: inline-block;
            width: 200px;
            vertical-align: top;
        }
        .charity-checkout .checkbox {
            margin-bottom: 20px;
        }
        label.textbox-width{
            width: 100%;
        }
        .user-content {
            padding: 80px 0px !important;
        }
        @media (max-width: 992px){
            .expire-year input {
                margin-top: 0px;
            }
            .payment-card.checkout-payment {
                padding-top: 0px;
            }
        }
    </style>

    <div class="checkout">
        <div class="container">

        </div>
    </div>
    <div class="main-wrapper">
        <div class="user-detail-wrap">

            <!-- Tab panes -->
            <div class="tab-content user-content">
                <div role="tabpanel" class="tab-pane active" id="profile">
                    <div class="container-fluid box-width listing">
                        <div class="row">

                            @if(isset($error) && $error != '')
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        {{ $error }}
                                    </div>
                                </div>
                            @endif

                            <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable amenities-tab">
                                <div id="wid-id-0">
                                    <div class="col-md-4 col-sm-12 col-xs-12">

                                    </div>
                                    <!-- widget div-->
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <div role="content">
                                            <!-- widget content -->
                                            <div class="widget-body">

                                                <div class="row" style="display: none;">
                                                    <form id="wizard-1" novalidate="novalidate">
                                                        <div id="bootstrap-wizard-1">
                                                            <div class="form-bootstrapWizard">
                                                                <ul class="bootstrapWizard form-wizard">
                                                                    <li class="active" data-target="#step1">
                                                                        <a href="#tab1"  class="active"> <span class="step">1</span> <span class="title">About Your Trip</span> </a>
                                                                    </li>
                                                                    <li data-target="#step2" class="step2">
                                                                        <a href="#tab2"  > <span class="step">2</span> <span class="title">Payment Inforamtion</span> </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="clearfix"></div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end widget content -->
                                        </div>
                                    </div>
                                    <!-- end widget div -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="tab-content">
                                                <div class="tab-info tab-pane active" id="tab1">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="trip-main">
                                                                <div class="trip-heading">
                                                                    <a href="#trip" data-toggle="collapse">1. About Your Trip</a>
                                                                </div>
                                                                <div id="trip" class="panel-collapse collapse in">
                                                                    <form action="/payWithStripe" method="post" id="addBooking">
                                                                        <div class="row">
                                                                            <div class="col-md-4 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="sel1">Who's coming?</label>
                                                                                    <select class="form-control" id="sel1" name="guest">
                                                                                        <option value="1">1 guest</option>
                                                                                        <option value="2">2 guest</option>
                                                                                        <option value="3">3 guest</option>
                                                                                        <option value="4">4 guest</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="comment">Say hello to your host and tell them why you're coming:</label>
                                                                            <textarea required class="form-control" name="commit" rows="5" id="comment" placeholder="Visiting family or friends? Seeing the sights? This helps your host plan for your trip." >{{ $booking->comment }}</textarea>
                                                                            <span id="textarea_feedback" style="display:none;font-size: 16px;float: right;color:red;">Please enter atleast 140 characters!</span>
                                                                        </div>
                                                                        <h2>{{ $listing->user->first_name.' '.$listing->user->last_name }}'s house rules</h2>
                                                                        <div class="trip-list">
                                                                            <ul>
                                                                                @foreach($allRules as $rule)
                                                                                    @if(in_array($rule->id, $listingRules))
                                                                                        <li>{{ $rule->name }}
                                                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                                                        </li>
                                                                                    @else
                                                                                        <li>{{ $rule->name }}
                                                                                            <i class="fa fa-close" aria-hidden="true"></i>
                                                                                        </li>
                                                                                    @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="payment-main">
                                                                <div id="payment" class="panel-collapse collapse in">

                                                                    <input type="hidden" name="listingid" value="{{ $listing->id }}" >
                                                                    {{ csrf_field() }}
                                                                    <div class="row">
                                                                        <div class="col-md-12 submit-checkout">
                                                                            {{--<button type="button" class="btn btn-danger submit-checkout addBooking">--}}
                                                                                {{--<i class="glyphicon glyphicon-lock"></i> Confirm--}}
                                                                            {{--</button>--}}
                                                                            <button class="btn btn-primary submit-checkout second-page">
                                                                                Continue
                                                                            </button>
                                                                            {{--<input type="button" class="btn btn-primary submit-checkout second-page" value="Continue">--}}
                                                                            <span>Next you'll enter your payment information</span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-info tab-pane" id="tab2">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="payment-main">
                                                                <div class="payment-heading">
                                                                    <a href="#payment" data-toggle="collapse">2. Payment</a>
                                                                </div>
                                                                <div id="payment" class="panel-collapse collapse in">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5>Partially refundable</h5>
                                                                            @if(\App\Model\Listing::cancellationOptions($listing->cancellation_type == 'Strict'))
                                                                                <p><strong>This host is Strict:</strong> Receive a 50% refund up to 1 week prior to arrival, except fees.</p>
                                                                            @elseif(\App\Model\Listing::cancellationOptions($listing->cancellation_type == 'Understanding'))
                                                                                <p><strong>This host is Flexible:</strong> Receive a full refund 1 day prior to arrival, except fees.</p>
                                                                            @else
                                                                                <p><strong>This host is Moderate:</strong> Receive a full refund 5 days prior to arrival, except fees.</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="billing">Billing Country</label>
                                                                                <select class="form-control" id="billing" name="cardcountry">
                                                                                    <option value="Afghanistan">Afghanistan</option>
                                                                                    <option value="Albania">Albania</option>
                                                                                    <option value="Algeria">Algeria</option>
                                                                                    <option value="American Samoa">American Samoa</option>
                                                                                    <option value="Andorra">Andorra</option>
                                                                                    <option value="Angola">Angola</option>
                                                                                    <option value="Anguilla">Anguilla</option>
                                                                                    <option value="Antartica">Antarctica</option>
                                                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                                    <option value="Argentina">Argentina</option>
                                                                                    <option value="Armenia">Armenia</option>
                                                                                    <option value="Aruba">Aruba</option>
                                                                                    <option value="Australia">Australia</option>
                                                                                    <option value="Austria">Austria</option>
                                                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                                                    <option value="Bahamas">Bahamas</option>
                                                                                    <option value="Bahrain">Bahrain</option>
                                                                                    <option value="Bangladesh">Bangladesh</option>
                                                                                    <option value="Barbados">Barbados</option>
                                                                                    <option value="Belarus">Belarus</option>
                                                                                    <option value="Belgium">Belgium</option>
                                                                                    <option value="Belize">Belize</option>
                                                                                    <option value="Benin">Benin</option>
                                                                                    <option value="Bermuda">Bermuda</option>
                                                                                    <option value="Bhutan">Bhutan</option>
                                                                                    <option value="Bolivia">Bolivia</option>
                                                                                    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                                                                    <option value="Botswana">Botswana</option>
                                                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                                                    <option value="Brazil">Brazil</option>
                                                                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                                    <option value="Bulgaria">Bulgaria</option>
                                                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                                                    <option value="Burundi">Burundi</option>
                                                                                    <option value="Cambodia">Cambodia</option>
                                                                                    <option value="Cameroon">Cameroon</option>
                                                                                    <option value="Canada">Canada</option>
                                                                                    <option value="Cape Verde">Cape Verde</option>
                                                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                                                    <option value="Central African Republic">Central African Republic</option>
                                                                                    <option value="Chad">Chad</option>
                                                                                    <option value="Chile">Chile</option>
                                                                                    <option value="China">China</option>
                                                                                    <option value="Christmas Island">Christmas Island</option>
                                                                                    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                                                                    <option value="Colombia">Colombia</option>
                                                                                    <option value="Comoros">Comoros</option>
                                                                                    <option value="Congo">Congo</option>
                                                                                    <option value="Congo">Congo, the Democratic Republic of the</option>
                                                                                    <option value="Cook Islands">Cook Islands</option>
                                                                                    <option value="Costa Rica">Costa Rica</option>
                                                                                    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                                                                    <option value="Croatia">Croatia (Hrvatska)</option>
                                                                                    <option value="Cuba">Cuba</option>
                                                                                    <option value="Cyprus">Cyprus</option>
                                                                                    <option value="Czech Republic">Czech Republic</option>
                                                                                    <option value="Denmark">Denmark</option>
                                                                                    <option value="Djibouti">Djibouti</option>
                                                                                    <option value="Dominica">Dominica</option>
                                                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                                                    <option value="East Timor">East Timor</option>
                                                                                    <option value="Ecuador">Ecuador</option>
                                                                                    <option value="Egypt">Egypt</option>
                                                                                    <option value="El Salvador">El Salvador</option>
                                                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                                    <option value="Eritrea">Eritrea</option>
                                                                                    <option value="Estonia">Estonia</option>
                                                                                    <option value="Ethiopia">Ethiopia</option>
                                                                                    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                                                    <option value="Fiji">Fiji</option>
                                                                                    <option value="Finland">Finland</option>
                                                                                    <option value="France">France</option>
                                                                                    <option value="France Metropolitan">France, Metropolitan</option>
                                                                                    <option value="French Guiana">French Guiana</option>
                                                                                    <option value="French Polynesia">French Polynesia</option>
                                                                                    <option value="French Southern Territories">French Southern Territories</option>
                                                                                    <option value="Gabon">Gabon</option>
                                                                                    <option value="Gambia">Gambia</option>
                                                                                    <option value="Georgia">Georgia</option>
                                                                                    <option value="Germany">Germany</option>
                                                                                    <option value="Ghana">Ghana</option>
                                                                                    <option value="Gibraltar">Gibraltar</option>
                                                                                    <option value="Greece">Greece</option>
                                                                                    <option value="Greenland">Greenland</option>
                                                                                    <option value="Grenada">Grenada</option>
                                                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                                                    <option value="Guam">Guam</option>
                                                                                    <option value="Guatemala">Guatemala</option>
                                                                                    <option value="Guinea">Guinea</option>
                                                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                                    <option value="Guyana">Guyana</option>
                                                                                    <option value="Haiti">Haiti</option>
                                                                                    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                                                                    <option value="Holy See">Holy See (Vatican City State)</option>
                                                                                    <option value="Honduras">Honduras</option>
                                                                                    <option value="Hong Kong">Hong Kong</option>
                                                                                    <option value="Hungary">Hungary</option>
                                                                                    <option value="Iceland">Iceland</option>
                                                                                    <option value="India">India</option>
                                                                                    <option value="Indonesia">Indonesia</option>
                                                                                    <option value="Iran">Iran (Islamic Republic of)</option>
                                                                                    <option value="Iraq">Iraq</option>
                                                                                    <option value="Ireland">Ireland</option>
                                                                                    <option value="Israel">Israel</option>
                                                                                    <option value="Italy">Italy</option>
                                                                                    <option value="Jamaica">Jamaica</option>
                                                                                    <option value="Japan">Japan</option>
                                                                                    <option value="Jordan">Jordan</option>
                                                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                                                    <option value="Kenya">Kenya</option>
                                                                                    <option value="Kiribati">Kiribati</option>
                                                                                    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                                                                    <option value="Korea">Korea, Republic of</option>
                                                                                    <option value="Kuwait">Kuwait</option>
                                                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                                    <option value="Lao">Lao People's Democratic Republic</option>
                                                                                    <option value="Latvia">Latvia</option>
                                                                                    <option value="Lebanon">Lebanon</option>
                                                                                    <option value="Lesotho">Lesotho</option>
                                                                                    <option value="Liberia">Liberia</option>
                                                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                                                    <option value="Lithuania">Lithuania</option>
                                                                                    <option value="Luxembourg">Luxembourg</option>
                                                                                    <option value="Macau">Macau</option>
                                                                                    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                                                                    <option value="Madagascar">Madagascar</option>
                                                                                    <option value="Malawi">Malawi</option>
                                                                                    <option value="Malaysia">Malaysia</option>
                                                                                    <option value="Maldives">Maldives</option>
                                                                                    <option value="Mali">Mali</option>
                                                                                    <option value="Malta">Malta</option>
                                                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                                                    <option value="Martinique">Martinique</option>
                                                                                    <option value="Mauritania">Mauritania</option>
                                                                                    <option value="Mauritius">Mauritius</option>
                                                                                    <option value="Mayotte">Mayotte</option>
                                                                                    <option value="Mexico">Mexico</option>
                                                                                    <option value="Micronesia">Micronesia, Federated States of</option>
                                                                                    <option value="Moldova">Moldova, Republic of</option>
                                                                                    <option value="Monaco">Monaco</option>
                                                                                    <option value="Mongolia">Mongolia</option>
                                                                                    <option value="Montserrat">Montserrat</option>
                                                                                    <option value="Morocco">Morocco</option>
                                                                                    <option value="Mozambique">Mozambique</option>
                                                                                    <option value="Myanmar">Myanmar</option>
                                                                                    <option value="Namibia">Namibia</option>
                                                                                    <option value="Nauru">Nauru</option>
                                                                                    <option value="Nepal">Nepal</option>
                                                                                    <option value="Netherlands">Netherlands</option>
                                                                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                                    <option value="New Caledonia">New Caledonia</option>
                                                                                    <option value="New Zealand">New Zealand</option>
                                                                                    <option value="Nicaragua">Nicaragua</option>
                                                                                    <option value="Niger">Niger</option>
                                                                                    <option value="Nigeria">Nigeria</option>
                                                                                    <option value="Niue">Niue</option>
                                                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                                    <option value="Norway">Norway</option>
                                                                                    <option value="Oman">Oman</option>
                                                                                    <option value="Pakistan">Pakistan</option>
                                                                                    <option value="Palau">Palau</option>
                                                                                    <option value="Panama">Panama</option>
                                                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                                                    <option value="Paraguay">Paraguay</option>
                                                                                    <option value="Peru">Peru</option>
                                                                                    <option value="Philippines">Philippines</option>
                                                                                    <option value="Pitcairn">Pitcairn</option>
                                                                                    <option value="Poland">Poland</option>
                                                                                    <option value="Portugal">Portugal</option>
                                                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                                                    <option value="Qatar">Qatar</option>
                                                                                    <option value="Reunion">Reunion</option>
                                                                                    <option value="Romania">Romania</option>
                                                                                    <option value="Russia">Russian Federation</option>
                                                                                    <option value="Rwanda">Rwanda</option>
                                                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                                    <option value="Saint LUCIA">Saint LUCIA</option>
                                                                                    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                                                                    <option value="Samoa">Samoa</option>
                                                                                    <option value="San Marino">San Marino</option>
                                                                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                                                    <option value="Senegal">Senegal</option>
                                                                                    <option value="Seychelles">Seychelles</option>
                                                                                    <option value="Sierra">Sierra Leone</option>
                                                                                    <option value="Singapore">Singapore</option>
                                                                                    <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                                                                    <option value="Slovenia">Slovenia</option>
                                                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                                                    <option value="Somalia">Somalia</option>
                                                                                    <option value="South Africa">South Africa</option>
                                                                                    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                                                                    <option value="Span">Spain</option>
                                                                                    <option value="SriLanka">Sri Lanka</option>
                                                                                    <option value="St. Helena">St. Helena</option>
                                                                                    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                                                                    <option value="Sudan">Sudan</option>
                                                                                    <option value="Suriname">Suriname</option>
                                                                                    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                                                                    <option value="Swaziland">Swaziland</option>
                                                                                    <option value="Sweden">Sweden</option>
                                                                                    <option value="Switzerland">Switzerland</option>
                                                                                    <option value="Syria">Syrian Arab Republic</option>
                                                                                    <option value="Taiwan">Taiwan, Province of China</option>
                                                                                    <option value="Tajikistan">Tajikistan</option>
                                                                                    <option value="Tanzania">Tanzania, United Republic of</option>
                                                                                    <option value="Thailand">Thailand</option>
                                                                                    <option value="Togo">Togo</option>
                                                                                    <option value="Tokelau">Tokelau</option>
                                                                                    <option value="Tonga">Tonga</option>
                                                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                                    <option value="Tunisia">Tunisia</option>
                                                                                    <option value="Turkey">Turkey</option>
                                                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                                                    <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                                                                    <option value="Tuvalu">Tuvalu</option>
                                                                                    <option value="Uganda">Uganda</option>
                                                                                    <option value="Ukraine">Ukraine</option>
                                                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                                                    <option value="United Kingdom">United Kingdom</option>
                                                                                    <option value="United States" selected>United States</option>
                                                                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                                    <option value="Uruguay">Uruguay</option>
                                                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                                                    <option value="Vanuatu">Vanuatu</option>
                                                                                    <option value="Venezuela">Venezuela</option>
                                                                                    <option value="Vietnam">Viet Nam</option>
                                                                                    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                                                    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                                                                    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                                                                    <option value="Western Sahara">Western Sahara</option>
                                                                                    <option value="Yemen">Yemen</option>
                                                                                    <option value="Yugoslavia">Yugoslavia</option>
                                                                                    <option value="Zambia">Zambia</option>
                                                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6"></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="payment-type">Payment Type</label>
                                                                                <input type="text" name="cardType" class="form-control" id="cardType" value="Credit Card" readonly>
                                                                                {{--<label for="payment-type">Payment Type</label>--}}
                                                                                {{--<select class="form-control" id="payment-type">--}}
                                                                                    {{--<option>Credit Card</option>--}}
                                                                                    {{--<option>Cash</option>--}}
                                                                                    {{--<option>paypal</option>--}}
                                                                                    {{--<option>Amex</option>--}}
                                                                                {{--</select>--}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="useOldCard" id="useOldCard">
                                                                    <input type="hidden" name="userId" id="userId" >
                                                                    <input type="hidden" name="cardId" id="cardId" >

                                                                    <input type="hidden" name="listingid" value="{{ $listing->id }}" >
                                                                    {{ csrf_field() }}

                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="card-num">Card Number *</label>
                                                                                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Valid Card Number" value="" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="expire">Expire On *</label>
                                                                                        <input type="number" class="form-control" id="expityMonth" name="cardExpiryMonth" placeholder="MM" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57 && this.value.length <= 1" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group expire-year">
                                                                                        <label for="expire"></label>
                                                                                        <input type="number" class="form-control" id="expityYear"  name="cardExpiryYear" placeholder="YYYY" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57 && this.value.length <= 3"  />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group expire-year">
                                                                                        <label for="expire"></label>
                                                                                        <input type="number" class="form-control" id="expCvc"  name="expCvc" placeholder="CVC" maxlength="3" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57 && this.value.length <= 2" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="fname">First Name *</label>
                                                                                <input type="text" class="form-control" id="fname" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="lname">Last Name *</label>
                                                                                <input type="text" class="form-control" id="lname" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="pcode">Postal Code *</label>
                                                                                <input type="number" class="form-control" id="pcode" required="required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" id="errDiv" style="display:none;">
                                                                        <div id="stripeErrMsg" class="alert alert-danger">

                                                                        </div>
                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-md-12 submit-checkout">
                                                                            <br>
                                                                            <p>* Required fields</p>
                                                                            <br>

                                                                            <p>
                                                                                I agree to the <a href="#">House Rules</a>,  <a href="#">Cancellation policy</a>, and to the <a href="#">Guest Refund Poilcy</a>. I also agree to pay the total amount shown, which includes <a href="#">Occupancy Taxes</a> and Service Fees.
                                                                            </p>

                                                                            <button type="button" class="btn btn-primary submit-checkout first-page"><i class="glyphicon glyphicon-chevron-left"></i>Back
                                                                            </button>
                                                                            <button type="button" class="btn btn-danger submit-checkout addBooking">
                                                                                <i class="glyphicon glyphicon-lock"></i> Confirm & Pay
                                                                            </button>
                                                                            @php
                                                                                $total = $listing->price * $booking['totaldays'];

                                                                                $fee = number_format(($total * 0.075),2);
                                                                            @endphp


                                                                            <input id="amount" type="hidden" name="amount" value="{{ number_format($total,2) }}">
                                                                            <input id="serviceCharges" type="hidden" name="serviceCharges" value="{{ $fee }}">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-4">

                                            {{-- Side Bar --}}

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
                                                                <span>{{ $booking->date_from }}</span>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2">
                                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                                <p>Checkout</p>
                                                                <span>{{ $booking->date_to }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="check-price">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <div class="check-price-left">
                                                                    <ul>
                                                                        <li>${{ $listing->price }} * {{ $booking['totaldays'] }} nights</li>
                                                                        <li>Service fee</li>
                                                                        {{--<li>Occupancy Taxes</li>--}}
                                                                        {{--<li class="blue">Coupon</li>--}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <div class="check-price-right">
                                                                    <ul>
                                                                        <li>${{ $total2 = $listing->price * $booking['totaldays'] }}</li>
                                                                        <li>${{ $fee2 = number_format(($total2 * 0.075),2) }}</li>
                                                                        {{--<li>$110</li>--}}
                                                                        @php
                                                                            $total2 = $total2 + $fee2
                                                                        @endphp
                                                                    </ul>
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

                                            {{-- /Side Bar --}}

                                        </div>
                                    </div>


                                </div>
                                <!-- end widget -->
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    {{--<script>--}}
    {{--var maskValue = function(CCInput){--}}
    {{--CCInput.data('value', CCInput.val());--}}
    {{--if (CCInput.val().length > 4) {--}}
    {{--CCInput.val(new Array(CCInput.val().toString().length-3).join('•')+CCInput.data('value').substr(-4)); // change all but the last 4 digits to *--}}
    {{--}--}}
    {{--};--}}
    {{--</script>--}}

    <script>
        $(function () {
            var status = '{{ isset($error) && $error != '' ? true : false }}';
            if(status){
                $("#profile input").prop("disabled", true);
                $("#profile select").prop("disabled", true);
                $("#profile textarea").prop("disabled", true);
//                $(".second-page"").prop("disabled", false);
                $('.addBooking').remove();
            }
            window.originalAmount = $('#amount2').val();

//            var text_max = document.getElementById("comment").attributes.maxLength.value;
//            $('#textarea_feedback').html( text_max + ' characters remaining');
            $('#comment').keyup(function() {
                if($('#comment').val().length < 140){
                    $('#textarea_feedback').show();
                } else {
                    $('#textarea_feedback').hide();
                }
//                var text_length = $('#comment').val().length;
//                var text_remaining = text_max - text_length;
//                $('#textarea_feedback').html(text_remaining + ' characters remaining');
            });

            {{--var card = GetCardType('{{ $userPaymentInfo->card_number }}');--}}
            {{--$('#cardImg').html('<li><img src="/images/'+card+'.jpg"/></li>');--}}

            $('.useSavedCard').click(function(e){
                var cardid = $(this).data('cardid');
                if($(this).is(':checked')) {
                    $('.useSavedCard').prop('checked', false);
                    $(this).prop('checked', true);
                    $('#cardNumber').prop('disabled', true);
                    $('#cardNumber').val('');
                    $('#expityMonth').prop('disabled', true);
                    $('#expityMonth').val('');
                    $('#expityYear').prop('disabled', true);
                    $('#expityYear').val('');
                    $('#expCvc').prop('disabled', true);
                    $('#expCvc').val('');
                    $('.cvc').addClass('hidden');
                    $('.cvc').val('');
                    $('#cvc_'+cardid).val('');
                    $('#cvc_'+cardid).removeClass('hidden');
                    $('#useOldCard').val('1');
                    $('#userId').val('{{ \Auth::user()->id }}');
                    $('#cardId').val(cardid);
                } else {
                    $('.useSavedCard').prop('checked', false);
                    $('#cardNumber').prop('disabled', false);
                    $('#cardNumber').val('');
                    $('#expityMonth').prop('disabled', false);
                    $('#expityMonth').val('');
                    $('#expityYear').prop('disabled', false);
                    $('#expityYear').val('');
                    $('#expCvc').prop('disabled', false);
                    $('#expCvc').val('');
                    $('#cvc_'+cardid).val('');
                    $('#cvc_'+cardid).addClass('hidden');
                    $('.cvc').addClass('hidden');
                    $('.cvc').val('');
                    $('#useOldCard').val('0');
                    $('#userId').val('0');
                    $('#cardId').val('0');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#manully').click(function () {
            if ($("#charity:checkbox:checked").length > 0) {
                $("#charity").trigger('click');
            }
            if(!$('#manully').is(':checked')){
                $('#charitymanual').val('');
                $('#totalamount').html('$'+window.originalAmount+'<span>USD</span>');
                $('#amount2').val(window.originalAmount);
            }
            //$("#charityLabel").toggleClass("hide");
        });
        $('#charity').click(function () {
//            if(!$('#charity').is(':checked')){
//
//            } else {
//
//            }
            if(!$('#charity').is(':checked')){
                if ($("#manully:checkbox:checked").length > 0) {
                    $("#manully").trigger('click');
                    $('#charitymanual').val('');
                    $('#totalamount').html('$'+window.originalAmount+'<span>USD</span>');
                    $('#amount2').val(window.originalAmount);
                    //$("#charityLabel").toggleClass("hide");
                } else {
                    $('#charitymanual').val('');
                    $('#totalamount').html('$'+window.originalAmount+'<span>USD</span>');
                    $('#amount2').val(window.originalAmount);
                }
            } else {
                if ($("#manully:checkbox:checked").length > 0) {
                    $("#manully").trigger('click');
                    $('#charitymanual').val('');
                    $('#totalamount').html('$'+window.originalAmount+'<span>USD</span>');
                    $('#amount2').val(window.originalAmount);
                    //$("#charityLabel").toggleClass("hide");
                }
                var donation2 = 1.00;
                //var amount = $('#amount').val();
                var newsum = parseFloat(donation2) + parseFloat(window.originalAmount);
                $('#amount2').val(newsum);
                $('#totalamount').html('$'+newsum+'<span>USD</span>');
            }
        });
        $('#charitymanual').on('blur',function () {
            if($(this).val() != '') {
                var donation = $(this).val();
                //var amount = $('#amount').val();
                var newsum = parseFloat(donation) + parseFloat(window.originalAmount);
                $('#amount2').val(newsum);
                $('#totalamount').html('$'+newsum+'<span>USD</span>');
                if(!$('#manully').is(':checked')){
                    $("#manully").trigger('click');
                }
            } else {
                $('#totalamount').html('$'+window.originalAmount+'<span>USD</span>');
                $('#amount2').val(window.originalAmount);
                if($('#manully').is(':checked')){
                    $("#manully").trigger('click');
                }
            }
        });
        $('.addBooking').click(function(e){
            loading();
            e.preventDefault();
            $(this).prop('disabled', true);
            Stripe.setPublishableKey('{{ env('STRIPE_KEY') }}');

            Stripe.card.createToken({
                number: $('#cardNumber').val(),
                cvc: $('#expCvc').val(),
                exp_month: $('#expityMonth').val(),
                exp_year: $('#expityYear').val().slice(-2),
                name: $('#fname').val() + ' ' + $('#lname').val()
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
                $('.addBooking').prop('disabled', false);
            }
            else{
                $('#errDiv').hide();
                var token = response.id;
                //$('addBooking').html('');
                $('#addBooking').append($('<input type="hidden" name="stripeToken" />').val(token));
                $('#addBooking').append($('<input type="hidden" name="bookingId" />').val('{{ $booking->id }}'));
                // Submit the form:
                $('#addBooking').submit();
            }
        }

        $(".second-page").click(function (e) {
            e.preventDefault();
            if($('#comment').val() != '' && $('#comment').val().length > 140){
                $('a[href="#tab2"]').tab('show');
                $("html, body").stop().animate({scrollTop: 0}, '500', 'swing');
                $('a[href="#tab1"]').addClass('process-success');
            } else {
                $('#comment').focus();
                $('#textarea_feedback').show();
                $('html, body').animate({
                    scrollTop: $("#comment").position().top
                }, 'fast');
            }
        });

        $(".first-page").click(function (e) {
            e.preventDefault();
            $('a[href="#tab1"]').tab('show');
            $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
        });
    </script>
    {{--<script type="text/javascript">--}}
    {{--function GetCardType(number)--}}
    {{--{--}}
    {{--var re = new RegExp("^4");--}}
    {{--if (number.match(re) != null)--}}
    {{--return "visa";--}}

    {{--re = new RegExp("^(34|37)");--}}
    {{--if (number.match(re) != null)--}}
    {{--return "amex";--}}

    {{--re = new RegExp("^5[1-5]");--}}
    {{--if (number.match(re) != null)--}}
    {{--return "master";--}}

    {{--re = new RegExp("^6011");--}}
    {{--if (number.match(re) != null)--}}
    {{--return "discover";--}}

    {{--return "";--}}
    {{--}--}}
    {{--</script>--}}
@endsection