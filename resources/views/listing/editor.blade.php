@extends('layouts.master')

@section('style-top')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{mix('style/add-listing.css')}}" rel="stylesheet">
    <style>
        .user-content {
            padding: 80px 0px !important;
        }
        .listing:before {
             border-bottom: 1px solid #D4D4D4 ;
        }

    </style>
@endsection
@section('content')
    {!! Form::model($listing, ['route' => $listing->id ? ['update-listing', $listing->id] : 'save-listing', 'files' => true, 'method'=>'put', 'id'=>'listingForm']) !!}
    {!! Form::hidden('lat', $listing->lat, ['id'=>'formLat']) !!}
    {!! Form::hidden('lng', $listing->lng, ['id'=>'formLng']) !!}
    {!! Form::hidden('events', json_encode($events), ['id'=>'events']) !!}
    {!! Form::hidden('deleted-events', '[]', ['id'=>'deleted-events']) !!}
    <style>
        #latitude, #longitude {
            width: 100%;
            border-radius: 28px;
            border: 1px solid #ccc;
            font-size: 12px;
            padding-left: 10px;
        }
        .lat-lang {
            text-transform: uppercase;
            color: #1e7ba6;
            font-size: 16px;
            padding-left: 10px;
            margin-top: 15px;
        }
        .map-h4{
            padding-left: 10px;
            color: #424242;
            font-weight: 600;
        }
        .map-p{
            padding-left: 10px;
            font-size: 12px !important;
        }
    </style>
    <div class="main-wrapper">
        <div class="user-detail-wrap">

            <!-- Tab panes -->
            <div class="tab-content user-content">
                <div role="tabpanel" class="tab-pane active" id="profile">
                    <div class="container-fluid box-width listing">
                        <div class="row">
                            <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable amenities-tab">
                                <div id="wid-id-0">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <header role="heading">
                                            <h2>Add a Listing</h2>
                                        </header>
                                    </div>
                                    <!-- widget div-->
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <div role="content">
                                            <!-- widget content -->
                                            <div class="widget-body">

                                                <div class="row">
                                                    <form id="wizard-1" novalidate="novalidate">
                                                        <div id="bootstrap-wizard-1">
                                                            <div class="form-bootstrapWizard">
                                                                <ul class="bootstrapWizard form-wizard">
                                                                    <li class="active" data-target="#step1">
                                                                        <a href="#tab1"  class="active"> <span class="step">1</span> <span class="title">Listing Type</span> </a>
                                                                    </li>
                                                                    <li data-target="#step2" class="step2">
                                                                        <a href="#tab2"  > <span class="step">2</span> <span class="title">Amenities</span> </a>
                                                                    </li>
                                                                    <li data-target="#step3" class="step3">
                                                                        <a href="#tab3" class="show-calender"> <span class="step">3</span> <span class="title">Description</span> </a>
                                                                    </li>
                                                                    <li  class="step4">
                                                                        <a href="#tab4" > <span class="step steps">4</span> <span class="title">Extras</span> </a>
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
                                    <div class="tab-content">
                                        <div class="tab-info tab-pane active" id="tab1">
                                            <div class="info-tab">
                                                @if ($errors->any())
                                                    <div class="col-xs-12">
                                                        {!!  implode('', $errors->all('<div class="alert alert-danger alert-dismissible" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                         :message</div>'))  !!}
                                                    </div>
                                                @endif
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>What Kind of place are you listing?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    <label class="tab-text">What type of property is this?</label>
                                                                    {!! Form::select('property_type', \App\Model\Listing::propertyOptions()) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    <label class="tab-text">What will guests have?</label>
                                                                    {!! Form::select('room_type', \App\Model\Listing::roomTypeOptions()) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 nopadding">
                                                    <div class="listing-box list_box">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/spaces icon.svg" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <h3>ENTIRE PLACE</h3>
                                                            <p>Guests will rent entire place. Includes in law uniits.</p>
                                                        </div>
                                                        <div class="box-content">
                                                            <h3>PRIVATE ROOM</h3>
                                                            <p>Guests share some spaces but they'll have their own private room for sleeping</p>
                                                        </div>
                                                        <div class="box-content">
                                                            <h3>SHARED ROOM</h3>
                                                            <p>Guests don't have a room to themselves</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-tab last-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types list2_heading">
                                                        <div class="listing-heading list2_heading">
                                                            <h3><span class="required"></span>How many bedrooms?</h3>
                                                        </div>
                                                        <div class="center form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus" disabled="disabled" data-type="minus" data-field="no_of_bedroom">
                                                                        </button>
                                                                        {!! Form::text('no_of_bedroom', $listing->id ? null : 1, ['class' => 'form-control input-number no_of_bedroom donottype', 'min' => 1, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="no_of_bedroom">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="listing-types list2_heading">
                                                        <div class="listing-heading list2_heading">
                                                            <h3><span style="color:#F62C10; font-size: 30px;font-weight: normal;"></span>How many beds?</h3>
                                                        </div>
                                                        <div class="center form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus custom-minus" disabled="disabled" data-type="minus" data-field="no_of_bed">
                                                                        </button>
                                                                        {!! Form::text('no_of_bed', $listing->id ? null : 1, ['class' => 'form-control input-number no_of_bed donottype', 'min' => 1, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbed" data-type="plus" data-field="no_of_bed">
                                                                        </button>
                                                                        <div class='no_of_bed_error' style='color:red;margin-bottom: 20px; display: none'>Please Enter Number of Bed </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="listing-types list2_heading small-number">
                                                        <div class="row">
                                                            <div class="col-sm-4 col-xs-6">
                                                                <div class="listing-heading list2_heading">
                                                                    <h3><span class="required">*</span>Bed Type?</h3>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-6 text-center">
                                                                <div class="listing-heading list2_heading">
                                                                    <h3>Number</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="center form-group">
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="checkbox offer-check">
                                                                        <label>
                                                                            <input type="checkbox" value="" class="bed-size-changer  " @if($listing->no_of_king_bed > 0) checked @endif>
                                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                            King Size
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus minusbutton removeBedError" @if($listing->no_of_king_bed == 0) disabled="disabled" @endif data-type="minus" data-field="no_of_king_bed">
                                                                        </button>
                                                                        {!! Form::text('no_of_king_bed', $listing->id ? null : 0, ['class' => 'form-control input-number change-checkbox no_of_king_bed donottype', 'min' => 0, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbutton removeBedError" data-type="plus" data-field="no_of_king_bed">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="checkbox offer-check">
                                                                        <label>
                                                                            <input type="checkbox" value="" class="bed-size-changer " @if($listing->no_of_queen_bed > 0) checked @endif>
                                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                            Queen Size
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="input-group ">
                                                                        <button type="button" class="btn btn-default btn-number minus minusbutton removeBedError" @if($listing->no_of_queen_bed == 0) disabled="disabled" @endif data-type="minus" data-field="no_of_queen_bed">
                                                                        </button>
                                                                        {!! Form::text('no_of_queen_bed', $listing->id ? null : 0, ['class' => 'form-control input-number change-checkbox no_of_queen_bed donottype', 'min' => 0, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbutton removeBedError" data-type="plus" data-field="no_of_queen_bed">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="checkbox offer-check">
                                                                        <label>
                                                                            <input type="checkbox" value="" class="bed-size-changer" @if($listing->no_of_full_bed > 0) checked @endif>
                                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                            Full
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus minusbutton removeBedError" @if($listing->no_of_full_bed == 0) disabled="disabled" @endif data-type="minus" data-field="no_of_full_bed">
                                                                        </button>
                                                                        {!! Form::text('no_of_full_bed', $listing->id ? null : 0, ['class' => 'form-control input-number change-checkbox no_of_full_bed donottype', 'min' => 0, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbutton removeBedError" data-type="plus" data-field="no_of_full_bed">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="checkbox offer-check">
                                                                        <label>
                                                                            <input type="checkbox" value="" class="bed-size-changer" @if($listing->no_of_twin_bed > 0) checked @endif>
                                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                            Twin
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="input-group ">
                                                                        <button type="button" class="btn btn-default btn-number minus minusbutton removeBedError" @if($listing->no_of_twin_bed == 0) disabled="disabled" @endif data-type="minus" data-field="no_of_twin_bed">
                                                                        </button>
                                                                        {!! Form::text('no_of_twin_bed', $listing->id ? null : 0, ['class' => 'form-control input-number change-checkbox no_of_twin_bed donottype', 'min' => 0, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbutton removeBedError" data-type="plus" data-field="no_of_twin_bed">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="checkbox offer-check">
                                                                        <label>
                                                                            <input type="checkbox" value="" class="bed-size-changer" @if($listing->no_of_couch_bed > 0) checked @endif>
                                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                            Couch/Futon
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus minusbutton removeBedError" @if($listing->no_of_couch_bed == 0) disabled="disabled" @endif data-type="minus" data-field="no_of_couch_bed">
                                                                        </button>
                                                                        {!! Form::text('no_of_couch_bed', $listing->id ? null : 0, ['class' => 'form-control input-number change-checkbox no_of_couch_bed donottype', 'min' => 0, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbutton removeBedError" data-type="plus" data-field="no_of_couch_bed">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="checkbox offer-check">
                                                                        <label>
                                                                            <input type="checkbox" value="" class="bed-size-changer" @if($listing->no_of_airbed > 0) checked @endif>
                                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                            Airbed
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-xs-6">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus minusbutton removeBedError" @if($listing->no_of_airbed == 0) disabled="disabled" @endif data-type="minus" data-field="no_of_airbed">
                                                                        </button>
                                                                        {!! Form::text('no_of_airbed', $listing->id ? null : 0, ['class' => 'form-control input-number change-checkbox no_of_airbed donottype', 'min' => 0, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus plusbutton removeBedError" data-type="plus" data-field="no_of_airbed">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='bedtype_error' style='color:red;margin-bottom: 20px; display: none'>Please choose correct number of beds and bed type</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 ">
                                                    <div class="listing-box list_box list_box2">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/bed.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <p>If you have additional rooms without beds which do not serve the purpose of a bedroom, do not include them. Count only the rooms guests can use as a bedroom.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-tab last-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types list2_heading">
                                                        <div class="listing-heading list2_heading">
                                                            <h3>How many bathrooms?</h3>
                                                        </div>
                                                        <div class="center form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    <div class="input-group">
                                                                        <button type="button" class="btn btn-default btn-number minus" disabled="disabled" data-type="minus" data-field="no_of_bath">
                                                                        </button>
                                                                        {!! Form::text('no_of_bath', $listing->id ? null : 1, ['class' => 'form-control input-number donottype','id'=>'no_of_bath', 'min' => 1, 'max'=> 10, 'step'=>'0.5']) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="no_of_bath">
                                                                        </button>
                                                                        <div class='no_of_bath_error' style='color:red;margin-bottom: 20px; display: none'>Count must be multiple of 0.5</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 ">
                                                    <div class="listing-box list_box list_box2">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/shower.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <p>If you have a toilet seperate from the shower, count it as a 0.5 bathroom.</p>
                                                        </div>
                                                        <div class="box-content">
                                                            <p>Count only the bathrooms guests can use.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="place-tab last-tab3">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3><span class="required">*</span>Where is your place?</h3>
                                                        </div>
                                                        <div class="form-group place-listing country-listing">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <label class="label">Country</label>
                                                                    {!! Form::text('country', null, ['id'=>'country', 'class' => 'form-control', 'placeholder' => 'COUNTRY' ,'readonly'=> 'readonly']) !!}
                                                                    <div class='country_error' style='color:red;margin-bottom: 20px; display: none'>Please enter country </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="address1_err" id="address1_err" value="@if($listing->address1) 1 @else  0 @endif">
                                                        <div class="form-group place-listing">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <label class="label"><span class="required">*</span>Enter Full Address and Select from Dropdown Results</label>
                                                                    {!! Form::text('address1', null, ['id'=>'address1','required' => '', 'class' => 'form-control removeError changeaddress', 'placeholder' => 'Enter Full Address and Select from Dropdown Results']) !!}
                                                                    <div class='address1_error' style='color:red;margin-bottom: 20px; display: none'>Enter full address and select from results </div>
                                                                    <input type="hidden" id="address1_backup" value="{{ $listing->address1 }}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group place-listing city-listing">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <label class="label"><span class="required"></span>APT, SUITE. BLOG, (OPTIONAL)</label>
                                                                    {!! Form::text('address2', null, ['id'=>'address2', 'class' => 'form-control', 'placeholder' => 'APT, SUITE. BLOG']) !!}
                                                                    <div class='address2_error' style='color:red;margin-bottom: 20px; display: none'>Please enter address 2 </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group place-listing zip-listing">
                                                            <div class="row">
                                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                                    <label class="label"><span class="required">*</span>CITY</label>
                                                                    {!! Form::text('city', null, ['id'=>'city', 'class' => 'form-control removeError cityname', 'placeholder' => 'CITY' ]) !!}
                                                                    <div class='city_error' style='color:red;margin-bottom: 20px; display: none'>Please enter city </div>

                                                                </div>
                                                                <div class="col-md-5 col-sm-12 col-xs-12 state-form">
                                                                    <label class="label">STATE</label>
                                                                    {!! Form::text('state', null, ['id'=>'state', 'class' => 'form-control removeError', 'placeholder' => 'STATE' ,'readonly'=> 'readonly']) !!}
                                                                    <div class='state_error' style='color:red;margin-bottom: 20px; display: none'>Please enter state </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group place-listing">
                                                            <div class="row">
                                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                                    <label class="label">{{--<span class="required">*</span>--}}ZIP CODE {{--(OPTIONAL)--}}</label>
                                                                    {!! Form::text('zip_code', null, ['id'=>'zip_code', 'class' => 'form-control', 'placeholder' => 'ZIP CODE','readonly'=> 'readonly' ]) !!}
                                                                    {{--
                                                                     {!! Form::text('zip_code', null, ['id'=>'zip_code', 'class' => 'form-control removeError', 'placeholder' => 'ZIP CODE' ]) !!}
                                                                     <div class='zip_code_error' style='color:red;margin-bottom: 20px; display: none'>Please enter zip code </div>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="listing-box list-box3 with-map">
                                                        {{--<input id="pac-input" class="controls" type="text" placeholder="Search Box">--}}
                                                        <div class="box-content">
                                                            <h4 class="map-h4">Verify Location</h4>
                                                            <p class="map-p">Move the map to pin your listing's exact location.</p>
                                                        </div>
                                                        <div id="map_div" style="width: 100%;height: 400px;"></div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <label class="lat-lang">longitude</label>
                                                                <input type="text" name="longitude" id="longitude" onblur="getLocation()" value="{{ $listing->lng }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="lat-lang">Latitude</label>
                                                                <input  type="text" name="latitude" id="latitude" onblur="getLocation()" value="{{ $listing->lat }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="listing-box list-box3">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/place.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <p>Your exact address will only be shared with confirmed guests.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="next-btn">
                                                <a href="#" class="tab-btn second-page">NEXT</a>
                                                <button name="status" class="tab-btn save-btn" type="submit" value="1">SAVE & EXIT</button>
                                            </div>
                                        </div>
                                        <div class="tab-info tab-pane" id="tab2">
                                            <div class="info-tab offer-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>What amenities do you offer?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    @foreach($options['amenity'] as $id => $name)
                                                                        <div class="checkbox">
                                                                            <label style="width:100%;">
                                                                                {!! Form::checkbox('amenities[]', $id) !!}
                                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                {!! $name !!}
                                                                                @if($id == 1)
                                                                                    <br> <small style="color:#ccc; text-transform: initial;">Towels, bed sheets, soap, and toilet paper</small>
                                                                                @endif
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div  class="listing-box amenities-box">
                                                        <img src="{{url('')}}/style/assets/img/offer.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-tab facilities-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>Additional Specifications</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    @foreach($options['spec'] as $id => $name)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                {!! Form::checkbox('amenities[]', $id) !!}
                                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                {{$name}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div  class="listing-box facilities-box">
                                                        <img src="{{url('')}}/style/assets/img/fire.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="place-tab last-tab3 fire-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>Pets in the home?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    @foreach($options['pet'] as $id => $name)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                {!! Form::checkbox('amenities[]', $id) !!}
                                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                {{$name}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div  class="listing-box fire-box">
                                                        <img src="{{url('')}}/style/assets/img/pet_cat.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="place-tab last-tab3 fire-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>Safety amenities</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    @foreach($options['safety'] as $id => $name)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                {!! Form::checkbox('amenities[]', $id) !!}
                                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                {{$name}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div  class="listing-box fire-box">
                                                        <img src="{{url('')}}/style/assets/img/facilities.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="row tab-btns">
                                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <div class="back-btn">
                                                            <div class="perivous-btn" id="1">
                                                                <a href="#" class="first-page">
                                                                    <img src="{{url('')}}/style/assets/img/back.png" alt=""><span>BACK</span>
                                                                </a>
                                                            </div>
                                                            <br>
                                                            {{--<div class="next-btn">--}}
                                                            {{--<a href="#" class="tab-btn third-page">NEXT</a>--}}
                                                            {{--</div>--}}
                                                            <div class="next-btn">
                                                                <a href="#" class="tab-btn third-page">NEXT</a>
                                                                <button name="status" class="tab-btn save-btn" type="submit" value="1">SAVE & EXIT</button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{--<div class="col-md-5 col-sm-12 col-xs-12">--}}
                                                    {{--<div class="back-btn">--}}
                                                    {{--<div class="next-btn">--}}
                                                    {{--<button name="status" class="tab-btn" type="submit" value="1">SAVE & EXIT</button>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-info tab-pane" id="tab3">
                                            <div class="place-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3><span class="required">*</span>Name Your place</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    {!! Form::text('name', null, ['class' => 'form-control name removeError isNumeric','id' => 'name', 'placeholder' => 'MUZBNB PALACE']) !!}
                                                                    <div id="name_error" class='name_error' style='color:red;margin-bottom: 20px; display: none'>Please enter listing name</div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 nopadding">
                                                    <div class="listing-box post_box">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/place_house.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="post">
                                                            <div class="post-img">
                                                                <a href="#">
                                                                    <img class="post-object" src="{{url('')}}/style/assets/img/treehouse.jpg" alt="...">
                                                                </a>
                                                            </div>
                                                            <div class="post-body">
                                                                <h4 class="post-heading">Treehouse in the woods</h4>
                                                                <p>In Adams Morgan</p>
                                                            </div>
                                                        </div>
                                                        <div class="post">
                                                            <div class="post-img">
                                                                <a href="#">
                                                                    <img class="post-object" src="{{url('')}}/style/assets/img/cozy_studio.jpg" alt="...">
                                                                </a>
                                                            </div>
                                                            <div class="post-body">
                                                                <h4 class="post-heading">Charming, Cozy Studio</h4>
                                                                <p>In the Forest</p>
                                                            </div>
                                                        </div>
                                                        <div class="post">
                                                            <div class="post-img">
                                                                <a href="#">
                                                                    <img class="post-object" src="{{url('')}}/style/assets/img/cottage_on_the_coast.jpg" alt="...">
                                                                </a>
                                                            </div>
                                                            <div class="post-body">
                                                                <h4 class="post-heading">Cottage on the coast</h4>
                                                                <p>Along the Coast</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab edit-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3><span class="required">*</span>Edit your description</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <label class="label"><span class="required">*</span>Summary</label>
                                                                    {!! Form::textarea('description', null, ['class' => 'form-control description removeError','id' => 'description', 'placeholder' => 'Describe your place']) !!}
                                                                    <div class='description_error' style='color:red;margin-bottom: 20px; display: none'>Please enter description min 150 characters</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 nopadding">
                                                    <div class="listing-box list_box">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/sweet_home.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <p>Your summary description is meant to be a brief overview of your place that guests read before they get into the details.</p>
                                                        </div>
                                                        <div class="box-content">
                                                            <p>You can also use your description to remind guests that people from all backgrounds are welcome in your home.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab price-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3><span class="required">*</span>Price</h3>
                                                        </div>
                                                        <div class="form-group place-listing">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <label class="label"><span class="required">*</span>Price per night </label>
                                                                    {!! Form::text('price', null, ['class' => 'form-control price removeError pricecheck','id'=>'price','min' => 1, 'max'=> 1000, 'placeholder' => 'Base Price (1 - 1000)']) !!}
                                                                    <div class='price_error' id="price_error" style='color:red;margin-bottom: 20px; display: none'>Please enter price between 1 to 1000</div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <label class="label"><span class="required">*</span>Currency</label>
                                                                    {!! Form::select('currency_id', for_select($currencies)) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 nopadding">
                                                    <div class="listing-box doller-box">
                                                        <img src="{{url('')}}/style/assets/img/doller.png" alt="doller">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab number-tab">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading ">
                                                            <h3>Booking Type?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    <select name="bookingtype">
                                                                        {{--<option value="Instant Book">Instant Book</option>--}}
                                                                        <option value="Request to Book">Request to Book</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md=4 col-sm-4 col-xs-12">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab number-tab">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading ">
                                                            <h3>Cancellation type?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    {!! Form::select('cancellation_type', \App\Model\Listing::cancellationOptions()) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md=4 col-sm-4 col-xs-12">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab photos-tab featured-photo">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="listing-heading img-head">
                                                        <h3><span class="required">*</span>Featured Photo</h3>
                                                        <img class="pull-right" src="{{url('')}}/style/assets/img/doc.png" alt="doc">
                                                    </div>
                                                    <div class="gallery-wrap">
                                                        <div class="gallery-box">
                                                            <input type="hidden" class="TestClass" value="1">
                                                            <input type="file" title="Upload Photo"
                                                                   images="{{ $listing->oldFeaturedImage() }}"
                                                                   del-src="{{route('delete-image', $listing->id) }}"
                                                                   name="featured" accept="image/*" data-max-size="1024" id="image-file">
                                                            @if($listing->oldFeaturedImage())
                                                                <input type="hidden" name="image-file-data" id="image-file-data" value="{{ count($listing->oldFeaturedImage()) }}">
                                                            @else
                                                                <input type="hidden" name="image-file-data" id="image-file-data" value="0">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class='image_file_error' id="image_file_error" style='color:red;margin-bottom: 20px; display: none'>Please choose at least 1 Image and size must be less than 2 MB</div>
                                                </div>
                                            </div>

                                            <hr>
                                            {{--<div class="place-tab photos-tab">--}}
                                                {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                                                    {{--<div class="listing-heading img-head">--}}
                                                        {{--<h3><span class="required">*</span>Photos</h3>--}}
                                                        {{--<img class="pull-right" src="{{url('')}}/style/assets/img/doc.png" alt="doc">--}}
                                                    {{--</div>--}}
                                                    {{--<div class="gallery-wrap">--}}
                                                        {{--<div class="gallery-box">--}}
                                                            {{--<input type="file" title="Upload Photos" name="photos[]"--}}
                                                                   {{--images="{{ $listing->oldImages() }}"--}}
                                                                   {{--del-src="{{route('delete-image', $listing->id) }}"--}}
                                                                   {{--accept="image/*" multiple id="photos">--}}
                                                            {{--<input type="hidden" name="photos-data" id="photos-data" value="{{ count(explode(";",$listing->oldImages())) }}">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class='photos_error' id="photos_error" style='color:red;margin-bottom: 20px; display: none'>Please choose atleast 2 images and size must be less than 2 MB</div>--}}

                                                {{--</div>--}}
                                            {{--</div>--}}
                                            
                                            <div class="place-tab photos-tab">
                                                <div class="col-md-12 col-sm-12 col-xs-12 listing-photos-grid" id="photosGrid">
                                                    <div class="listing-heading img-head">
                                                        <h3>Photos</h3>
                                                        <img class="pull-right" src="{{url('')}}/style/assets/img/doc.png" alt="doc">
                                                    </div>
                                                   <iframe src="/dz?edit={{$edit}}&id={{isset($listingId) ? $listingId : ''}}" style="width: 100%;height: 340px;border: 2px dotted #2d639c; border-radius: 17px;" id="myupPhts"></iframe>
                                                    <div class='photos_error' id="photos_error" style='color:red;margin-bottom: 20px; display: none'>Please choose at least 2 images</div>

                                                </div>
                                            </div>
                                            
                                            
                                            <hr>
                                            <div class="place-tab calender-tab">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="listing-heading img-head">
                                                        <h3>Select Unavailable Dates</h3>
                                                        <img class="pull-right" src="{{url('')}}/style/assets/img/doc.png" alt="doc">
                                                    </div>
                                                    <div id='calendar'></div>
                                                </div>
                                            </div>
                                            <div class="row tab-btns">
                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                    <div class="back-btn">
                                                        <div class="perivous-btn" id="2">
                                                            <a href="#" class="second-page">
                                                                <img src="{{url('')}}/style/assets/img/back.png" alt=""><span>BACK</span>
                                                            </a>
                                                        </div>
                                                        {{--<div class="next-btn">--}}
                                                        {{--<a href="#" class="tab-btn forth-page">NEXT</a>--}}
                                                        {{--</div>--}}
                                                        <div class="next-btn">
                                                            <a href="#" class="tab-btn forth-page">NEXT</a>
                                                            <button name="status" class="tab-btn save-btn" type="submit" value="1">SAVE & EXIT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-md-5 col-sm-12 col-xs-12">--}}
                                                {{--<div class="back-btn">--}}
                                                {{--<div class="next-btn">--}}
                                                {{--<button name="status" class="tab-btn" type="submit" value="1">save&nbsp;&amp;&nbsp;exit</button>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}

                                            </div>
                                        </div>
                                        <div class="tab-info tab-pane" id="tab4">
                                            <div class="place-tab offer-tab gusets-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>What spaces can guests use?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                                    @foreach($options['space'] as $id => $name)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                {!! Form::checkbox('amenities[]', $id) !!}
                                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                {{$name}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="listing-box list-box3 gustes-box">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/gusets.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <p>Spaces should be on the property Don't include laundromats or nearby  places that aren't part of your property. If it's ok with youur neighnors, you can include a pool, hot tub, or other shared space.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab number-tab">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading ">
                                                            <h3>Number of Guests?</h3>
                                                        </div>
                                                        <div class="center form-group">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="input-group number-input">
                                                                        <button type="button" class="btn btn-default btn-number plus1" data-type="plus" data-field="no_of_guest">
                                                                        </button>

                                                                        {!! Form::text('no_of_guest', $listing->id ? null : 1, ['class' => 'form-control input-number gusets-input donottype', 'min' => 1, 'max'=> 10]) !!}
                                                                        <button type="button" class="btn btn-default btn-number minus1 minusmax" disabled="disabled" data-type="minus" data-field="no_of_guest">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md=4 col-sm-4 col-xs-12">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab number-tab">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading ">
                                                            <h3>How long can guests stay?</h3>
                                                        </div>
                                                        <div class="center form-group">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="input-group number-input number-with-label">
                                                                        <label class="label">Minimum nights</label>
                                                                        <button type="button" class="btn btn-default btn-number minus1" disabled="disabled" data-type="minus" data-field="minimum_night">
                                                                        </button>
                                                                        {!! Form::text('minimum_night', $listing->id ? null : 1, ['class' => 'form-control input-number gusets-input donottype', 'min' => 1, 'max'=> 30, 'id' => 'minimum_night']) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus1" data-type="plus" data-field="minimum_night">
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="input-group number-with-label">
                                                                        <label class="label">Maximum nights</label>
                                                                        <button type="button" class="btn btn-default btn-number minus1 minus_max_night" data-type="minus" data-field="maximum_night">
                                                                        </button>
                                                                        {!! Form::text('maximum_night', $listing->id ? null : 2, ['class' => 'form-control input-number gusets-input donottype', 'min' => 1, 'max'=> 30, 'id' => 'maximum_night']) !!}
                                                                        <button type="button" class="btn btn-default btn-number plus1" data-type="plus" data-field="maximum_night">
                                                                        </button>
                                                                    </div>
                                                                    <div class='max_error' id="max_error" style='color:red;margin-bottom: 20px; display: none;'>Maximum must be greater then minimum</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-md=4 col-sm-4 col-xs-12">--}}
                                                {{--<div class="listing-types rang-slider">--}}
                                                {{--<input type="range" min="10" max="1000" step="10" value="300" data-rangeslider="">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab  number-tab">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading ">
                                                            <h3>Check-in/out times?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-5 col-sm-6 col-xs-12">
                                                                    <label class="label">Check in From:</label>
                                                                    {!! Form::select('check_in_time_from', time_select()) !!}
                                                                </div>
                                                                <div class="col-md-5 col-sm-6 col-xs-12">
                                                                    <label class="label">To:</label>
                                                                    {!! Form::select('check_in_time_to', time_select()) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-5 col-sm-6 col-xs-12">
                                                                    <label class="label">Check out From:</label>
                                                                    {!! Form::select('check_out_time_from', time_select()) !!}
                                                                </div>
                                                                <div class="col-md-5 col-sm-6 col-xs-12">
                                                                    <label class="label">To:</label>
                                                                    {!! Form::select('check_out_time_to', time_select()) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md=4 col-sm-4 col-xs-12">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab number-tab">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading ">
                                                            <h3>How far in advance can guest book?</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                                    {!! Form::select('advanced_booking_time', \App\Model\Listing::bookingOptions()) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md=4 col-sm-4 col-xs-12">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab place-tab last-tab3 rules-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3><span style="color:#F62C10; font-size: 30px;font-weight: normal;">*</span>Set house rules for your guests</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-10 col-sm-12 col-xs-12 rules-list">
                                                                    @if($listing->id)
                                                                        <?php $count = 1; ?>
                                                                        @foreach($rules as $rule)
                                                                            @if($rule->id != 10)
                                                                                <div class="rule-toggle">
                                                                                    <label>
                                                                                        <span>{{$rule->name}}</span>
                                                                                    </label>
                                                                                    <div class="btn-group" id="status" data-toggle="buttons">
                                                                                        <label class="btn btn-default btn-on btn-lg {{ in_array($rule->id, $currentRules) ? 'active' : '' }} ">
                                                                                            {!! Form::radio('all_rules[' . $rule->id . ']', 1, in_array($rule->id, $currentRules)) !!}
                                                                                            YES
                                                                                        </label>
                                                                                        <label class="btn btn-default btn-off btn-lg {{ in_array($rule->id, $currentRules) ? '' : 'active' }}">
                                                                                            {!! Form::radio('all_rules[' . $rule->id . ']', 0, !in_array($rule->id, $currentRules)) !!}
                                                                                            NO
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='{{ $count }}' style='color:red;margin-bottom: 15px; display: none'>Please Select Any One Yes/No </div>

                                                                            @endif
                                                                            <?php $count++; ?>
                                                                        @endforeach
                                                                    @else
                                                                        <?php $count = 1; ?>
                                                                        @foreach($rules as $rule)
                                                                            @if($rule->id != 10)
                                                                                <div class="rule-toggle">
                                                                                    <label>
                                                                                        <span>{{$rule->name}}</span>
                                                                                    </label>
                                                                                    <div class="btn-group" id="status" data-toggle="buttons">
                                                                                        <label class="btn btn-default btn-on btn-lg {{ old('all_rules.' . $rule->id ) === '1' ? 'active' : '' }} ">
                                                                                            {!! Form::radio('all_rules[' . $rule->id . ']', 1) !!}
                                                                                            YES
                                                                                        </label>
                                                                                        <label class="btn btn-default btn-off btn-lg {{ old('all_rules.' . $rule->id ) === '0' ? 'active' : '' }}">
                                                                                            {!! Form::radio('all_rules[' . $rule->id . ']', 0) !!}
                                                                                            NO
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            <?php $count++; ?>
                                                                        @endforeach
                                                                        <div class='Radio_error' style='color:red;margin-bottom: 15px; display: none'>Please select each rule yes/no </div>

                                                                    @endif
                                                                    @if(is_array(old('custom_rules')))
                                                                        @foreach(old('custom_rules') as $crule)
                                                                            <div class="rule-toggle">
                                                                                <label><span>{{ $crule }}</span></label><input type="checkbox" name="custom_rules[]" value="{{ $crule }}" checked /> <span class="del-btn">X</span>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--<div class="form-group">--}}
                                                        {{--<div class="row">--}}
                                                        {{--<div class="col-md-11 col-sm-12 col-xs-12">--}}
                                                        {{--<input id="c-rule" class="form-control" placeholder="ADD YOUR OWN RULE HERE">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="form-group">--}}
                                                        {{--<div class="next-btn">--}}
                                                        {{--<a href="#" class="tab-btn add-rule" style="width: 250px!important;margin-right:65px;">Add</a>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="listing-box list-box3 rules-box">
                                                        <div class="info-icon">
                                                            <img src="{{url('')}}/style/assets/img/doc.png" alt="" class="pull-left">
                                                            <img src="{{url('')}}/style/assets/img/hand.png" alt="" class="pull-right box-img">
                                                        </div>
                                                        <div class="box-content">
                                                            <p>In addition to Muzbnb�s requirements, guests must agree to all your House Rules before they book.</p>
                                                            <p>
                                                                If you�re ever uncomfortable with a reservation, you can cancel penalty-free before or during a trip.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab photos-tab">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="listing-heading img-head">
                                                        <h3><span style="color:#F62C10; font-size: 30px;font-weight: normal;"></span>Proof of Residency </h3>
                                                        <img class="pull-right" src="{{url('')}}/style/assets/img/doc.png" alt="doc">
                                                    </div>
                                                    <div class="gallery-wrap">
                                                        <div class="gallery-box verify-box">
                                                            <input type="file" name="docs[]" id="proof_residency" title="Upload Files" accept=".xlsx,.xls,image/*,.doc,.docx,.ppt,.pptx,.txt,.pdf" multiple>
                                                            <div class='proof_residency_error' style='color:red;margin-bottom: 20px; display: none'>Please choose atleast 1 file and size must be less than 2 MB</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="place-tab last-tab3 lows-tab">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="listing-types">
                                                        <div class="listing-heading">
                                                            <h3>Muzbnb policies and Local laws</h3>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-10 col-sm-12 col-xs-12">
                                                                    <p class="low-text">Make sure you familiarize yourself with your local laws, as well as
                                                                        <a href="#" target="_blank"><b>Muzbnb�s Terms & Policies.</b></a></p>
                                                                    <P class="low-text">Please educate yourself about the laws in your jurisdiction before listing your space.<p>
                                                                    <p class="low-text">Most cities have rules covering homesharing, and specific codes and ordinances can appear in many places (such as zoning, building, licensing or tax codes). In most places, you must register, get a permit, or obtain a license before you list your property or accept guests. You may also be responsible for collecting and remitting taxes. In some places, short-term rentals could be prohibited altogether.</p>
                                                                    <p class="low-text">By accepting our Terms of Service and listing your space, you certify that you will follow applicable laws and regulations.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
                                                {{--<div  class="listing-box low-box">--}}
                                                {{--<img src="{{url('')}}/style/assets/img/low.png" alt="">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <input type="hidden" id="profile_pic" value="@if($profile->avatar) 1 @else 0 @endif">
                                                <div class="col-md-4 col-sm-4 col-xs-12 profile-pic">
                                                    <span style="color:#F62C10; font-size: 30px;font-weight: normal;">*</span>
                                                    <div class="profile-box" id="profile_pic_box">
                                                        <div class="text-center bg-form">
                                                            <div class="img-section">
                                                                <span class="glyphicon glyphicon-camera camera"></span>
                                                                <div class="browse" id="ProPic">
                                                                </div>
                                                                <h3>Profile <span>Photo</span></h3>
                                                                <div class="clearfix">
                                                                    {{--<div class="view-btn">--}}
                                                                        {{--<a href="" data-toggle="modal" data-target="#webcam" class="btn btn-blue">Webcam</a>--}}
                                                                    {{--</div>--}}
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
                                                    <div class='profile_pic_error' style='color:red;display: none'>Please upload a photo.</div>
                                                </div>

                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                    <div class="">
                                                        <div class="perivous-btn" id="3">
                                                            <a href="#" class="third-page">
                                                                <img src="{{url('')}}/style/assets/img/back.png" alt=""><span>BACK</span>
                                                            </a>
                                                        </div>
                                                        {{--<div class="next-btn">--}}
                                                        {{--<button name="status" class="tab-btn" type="submit" value="1">save&nbsp;&amp;&nbsp;exit</button>--}}
                                                        {{--</div>--}}
                                                        <input type="hidden" name="getstus" id="getstus" value="0">
                                                        <div class="next-btn" style="width:100%!important;margin-top: 20px;">
                                                            <div class="col-xs-6"><button status123="save-form" name="status" class="tab-btn save-btn class-status-123" id="save-btn"type="submit" value="1" style="width: 100%!important">SAVE & EXIT</button></div>
                                                            <div class="col-xs-6"><button status123="publish-form" type="submit" class="tab-btn save-btn class-status-123" value="2" id="save-btn" name="status" style="width: 100%!important">FINISH</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-md-5 col-sm-12 col-xs-12">--}}
                                                {{--<div class="back-btn">--}}
                                                {{--<div class="next-btn">--}}
                                                {{--<button type="submit" class="tab-btn" value="2" name="status">FINISH</button>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}

                                            </div>
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
    </form>


    <!-- Confirm Modal -->
    <div class="modal fade form" id="confirmModal">
        <div class="model-vertical">
            <div class="modal-dialog modal-sm" role="document">
                <div class="logo-icon text-center"><img src="{{ url('style/assets') }}/img/logo-icon.svg" alt="logo icon"></div>
                <div class="modal-content modalHeight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
                        <h4 class="modal-title" id="myModalLabel">Please verify your address ok.</h4>
                    </div>
                    <div class="modal-body">
                        <div class="confirm-box">
                            <div id="map2-div" style="height: 200px;width: 100%; margin-bottom: 15px;"></div>
                            <p>Street Address: <span style="width: 100%; overflow: auto
;" id="conf_address1"></span></p>
                            <p>Apt, Suite. Block: <span id="conf_address2"></span></p>
                            <p>City: <span id="conf_city"></span></p>
                            <p>State: <span id="conf_state"></span></p>
                            <p>Country: <span id="conf_country"></span></p>
                            <p>Zip Code: <span id="conf_zip_code"></span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="title-line">
                            <span>Is this correct?</span>
                        </div>
                        <span style="display: block; height: 15px"></span>
                        <div class="row">
                            <div class="col-xs-6">
                                <p class="text-center">
                                    <a href="#" id="confirmAddr" class="btn btn-block btn-success">Yes</a>
                                </p>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-center">
                                    <a href="#" data-dismiss="modal" aria-label="Close" class="btn btn-block btn-danger">No</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="{{mix('js/add-listing.js')}}" rel="stylesheet"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            var edit_bed_type = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
            if($('.no_of_bed').val() <= edit_bed_type){
                $('.bed-size-changer').each(function(){
                    if(!$(this).is(':checked')){
                        $(this).prop('disabled', true);
                    }
                });
                $('.plusbutton').prop('disabled', true);
            }
            /*$(document).on('click', '.custom-minus', function(){
             $('.plusbutton').parent().find("input[type='text']").val(0);
             $('.plusbutton').parent().find(".plusbutton").removeAttr('disabled');
             $('.plusbutton').parent().parent().parent().find('.bed-size-changer').prop('checked', false);
             });*/
        });
        var countImage = 0;
        var photos = $('#photos-data').val();
        if(photos > 0)
            countImage = photos;

        var featureImageCount = 0;
        var photoinfo = $('#image-file-data').val();
        if(photoinfo > 0)
            featureImageCount = photoinfo;

        $('select').select2();
        $('.btn-number').click(function(e){
            e.preventDefault();

            var fieldName = $(this).attr('data-field');
            var type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var step      = input.attr('step') ? parseFloat(input.attr('step')) : 1;

            var currentVal = parseFloat(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    if(currentVal > input.attr('min')) {
                        var maximum_night = parseInt($("#maximum_night").val());
                        var minimum_night = parseInt($("#minimum_night").val());
                        input.val(currentVal - step).change();
                    }
                    if(maximum_night == 1){
                        $(".minus_max_night").prop('disabled', true);
                        $(this).attr('disabled', true);
                    }else
                    if(maximum_night == minimum_night ){
                        if(maximum_night == undefined){
                            $(this).attr('disabled', true);
                            $(".minus_max_night").prop('disabled', true);
                        }else{
                            var minimum_night = minimum_night - 1;
                            $("#minimum_night").val(minimum_night);
                        }

                    }else
                        if(parseFloat(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        var maximum_night = parseInt($("#maximum_night").val());
                        var minimum_night = parseInt($("#minimum_night").val());
                        if(maximum_night == minimum_night){
                        var maximum_night = maximum_night + 1;
                        $("#maximum_night").val(maximum_night);
                        }
                        input.val(currentVal + step).change();

                    }
                    if(parseFloat(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }
                    var maximum_night = $("#maximum_night").val();
                    var minimum_night = $("#minimum_night").val() ;
                    if((maximum_night == minimum_night) && minimum_night == 1){
                        $(".minus_max_night").prop('disabled', true);
                    }
                    if(maximum_night > 30){
                        $("#maximum_night").val(30);
                    }


                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            var minValue =  parseInt($(this).attr('min'));
            var maxValue =  parseInt($(this).attr('max'));
            var valueCurrent = parseFloat($(this).val());
            var otherField = $(this).closest('.col-md-12').siblings().find('input');
            var otherValue;
            if(otherField.attr('name')=='maximum_night'&&otherField.val()<=valueCurrent)
            {
                otherField.val(valueCurrent);
            }
            var name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled');
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if($(this).hasClass('change-checkbox')) {
                if(valueCurrent > 0) {
                    if(!$(this).closest('.row').find('.bed-size-changer').is(':checked')) {
                        $(this).closest(".row").find('label').click();
                    }
                } else {
                    if($(this).closest('.row').find('.bed-size-changer').is(':checked')) {
                        $(this).closest(".row").find('label').click();
                    }
                }
            }

        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $(document).ready(function() {
            $('.help-tooltip').tooltip();
            $('input[type="file"]').imageuploadify();
            //$("#image-file-data").imageuploadify();
            //$("#photos").imageuploadify();

            var events = JSON.parse($("#events").val());
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next,title',
                    right: 'month,agendaWeek,agendaDay,listWeek,today',
                    allDay:true
                },
                height: 600,
                contentHeight: 600,
                defaultDate: '{{date('Y-m-d')}}',
                editable: true,
                selectable: true,

                selectHelper: true,
                select: function(start, end) {
                    if(start.isBefore(moment())) {
                        $('#calendar').fullCalendar('unselect');
                        return false;
                    }
                    var title = 'Unavailable';
                    var eventData;
                    if (title) {
                        eventData = {
                            dbId: 0,
                            allDay: true,
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                        saveEvents();
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                eventRender: function(event, element) {
                    element.find('.fc-content').append( "<span class='closeon pull-right'>X</span>" );
                    element.find(".closeon").click(function() {
                        $('#calendar').fullCalendar('removeEvents',event._id);
                        deletedEvents(event.dbId);
                    });
                    saveEvents();
                },
                eventResize: function(event, delta, revertFunc, jsEvent) {
                    saveEvents();
                },
                eventDrop: function(event, delta, revertFunc) {
                    if(event.start.isBefore(moment())) {
                        revertFunc();
                        return false;
                    }
                    saveEvents();
                },
                eventOverlap: false,
                selectOverlap: false,
                events: events
//                    {
//                        title: 'All Day Event',
//                        start: '2017-5-11',
//                        end: '2017-5-13',
//                        allDay: true,
//                        editable: false
//                    },
//                ]

            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                $("#calendar").fullCalendar('render');
                console.log('yes');
            });
            $(document).on('click','.third-page', function () {
                $("#calendar").fullCalendar('render');
            });
        });
        $('#listingForm').submit(function () {
            window.submitting = true;
        });
        var deletedEventsArr = [];
        function deletedEvents(id) {
            if(id > 0) {
                deletedEventsArr.push(id);
            }
            $("#deleted-events").val(JSON.stringify(deletedEventsArr));
        }
        function saveEvents() {
            var allEvents = $('#calendar').fullCalendar('clientEvents');
            var arr = [];
            allEvents.forEach(function(e){
                if(e) {
                    arr.push({
                        id: e.dbId,
                        start: e.start.format(),
                        end: e.end.format()
                    });
                }
            })
            if(allEvents.length) {
                $("#events").val(JSON.stringify(arr));
            }
        };
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };
        var fields = {
            street_number: 'address1',
            route: 'address1',
            locality: 'city',
            administrative_area_level_1: 'state',
            country: 'country',
            postal_code: 'zip_code'
        };
        window.confirmedAddress = false;
        var valueBubble = '<output class="rangeslider__value-bubble" />';

        function updateValueBubble(pos, value, context) {
            pos = pos || context.position;
            value = value || context.value;
            var $valueBubble = $('.rangeslider__value-bubble', context.$range);
            var tempPosition = pos + context.grabPos;
            var position = (tempPosition <= context.handleDimension) ? context.handleDimension : (tempPosition >= context.maxHandlePos) ? context.maxHandlePos : tempPosition;

            if ($valueBubble.length) {
                $valueBubble[0].style.left = Math.ceil(position) + 'px';
                $valueBubble[0].innerHTML = value;
            }
        }

        $('input[type="range"]').rangeslider({
            polyfill: false,
            onInit: function() {
                this.$range.append($(valueBubble));
                updateValueBubble(null, null, this);
            },
            onSlide: function(pos, value) {
                updateValueBubble(pos, value, this);
            }
        });
        $(".bed-size-changer").bind('change', function(){
            if(this.checked) {
                $(this).closest(".row").find('.input-number').val(1);
                var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
                var no_of_bed = $('.no_of_bed').val();
                if(no_of_bed == bedtype){
                    $('.plusbutton').attr('disabled','disabled');
                    $('.bed-size-changer').attr('disabled','disabled');

                }

            } else {
                $(this).closest(".row").find('.input-number').val(0);
            }
        });
        $("#confirmAddr").click(function(){
            window.confirmedAddress = true;
            $("#confirmModal").modal("hide");
            $('a[href="#tab2"]').tab('show');
            $("html, body").stop().animate({scrollTop: 0}, '500', 'swing');
            $('a[href="#tab1"]').addClass('process-success');
        });
        $(".first-page").click(function (e) {
            e.preventDefault();
            $('a[href="#tab1"]').tab('show');
            $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
        });
        $(".second-page").click(function (e) {
            e.preventDefault();
            if(!window.confirmedAddress)
            {
                var no_of_bedroom = $('.no_of_bedroom').val();
                var no_of_bed = $('.no_of_bed').val();

                var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());

                if(no_of_bedroom > no_of_bed){
                    $(".no_of_bed_error").css("display", "block");
                    $(".no_of_bed").css("border-color", "red");
                    $(window).scrollTop(700);
                    return false;
                }else{
                    $(".no_of_bed_error").css("display", "none");
                    $(".no_of_bed").css("border-color", "");
                }
                if(no_of_bed != bedtype ){
                    $(".bedtype_error").css("display", "block");
                    $(window).scrollTop(1000);
                    return false;
                }else{
                    $(".bedtype_error").css("display", "none");
                }

                var no_of_bath = $('#no_of_bath').val();
                if(no_of_bath){
                    if(parseInt((no_of_bath*10)%5) != 0) {
                        $(".no_of_bath_error").css("display", "block");
                        $("#no_of_bath").css("border-color", "red");
                        $(window).scrollTop(1500);
                        return false;
                    }
                }
                /**/

//                var country = $('#country').val();
//                if(country == ''){
//                    $(".country_error").css("display", "block");
//                    $("#country").css("border-color", "red");
//                    $("#country").focus();
//                    return false;
//                }

                var address1 = $('#address1').val();
                if(address1 == ''){/*the iframe DOM object*/;
                    $(".address1_error").css("display", "block");
                    $("#address1").css("border-color", "red");
                    $("#address1").focus();
                    return false;
                }
                var address1_err = $("#address1_err").val();
                if(address1_err == 0){
                    $(".address1_error").css("display", "block");
                    $("#address1").css("border-color", "red");
                    return false;
                }
                var address2 = $('#address2').val();
                /*if(address2 == ''){
                 $(".address2_error").css("display", "block");
                 $("#address2").css("border-color", "red");
                 $("#address2").focus();
                 return false;
                 }*/
                var city = $('#city').val();
                if(city == ''){
                    $(".city_error").css("display", "block");
                    $("#city").css("border-color", "red");
                    $("#city").focus();
                    return false;
                }
//                var state = $('#state').val();
//                if(state == ''){
//                    $(".state_error").css("display", "block");
//                    $("#state").css("border-color", "red");
//                    $("#state").focus();
//                    return false;
//                }
//                var zip_code = $('#zip_code').val();
//                if(zip_code == ''){
//                    $(".zip_code_error").css("display", "block");
//                    $("#zip_code").css("border-color", "red");
//                    $("#zip_code").focus();
//                    return false;
//                }

                for(var key in fields) {
                    $("#conf_" + fields[key]).text($("#" + fields[key]).val());
                    $("#conf_address2").text($("#address2").val());
                }
                var map2Div = document.getElementById('map2-div');
                $("#confirmModal").modal("show");

                var center2 = new google.maps.LatLng($("#formLat").val(), $("#formLng").val());
                if(!map2) {
                    var map2 = new google.maps.Map(map2Div, {
                        zoom: 16,
                        center: center2,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                            position: google.maps.ControlPosition.LEFT_BOTTOM
                        },
                    });
                    var marker = new google.maps.Marker({
                        position: center2,
                        map: map2,
                        animation: google.maps.Animation.DROP,
                    });
                } else {
                    map2.setCenter(center2);
                    marker.setPosition(center2);
                }

            } else {
                var no_of_bed = $('.no_of_bed').val();
                var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
                if(no_of_bed != bedtype ){
                    $(".bedtype_error").css("display", "block");
                    $(window).scrollTop(1000);
                    return false;
                }else{
                    $(".bedtype_error").css("display", "none");
                }

                var address1_err = $("#address1_err").val();
                if(address1_err == 0){
                    $(".address1_error").css("display", "block");
                    $("#address1").css("border-color", "red");
                    return false;
                }
                $('a[href="#tab2"]').tab('show');
                $("html, body").stop().animate({scrollTop: 0}, '500', 'swing');
                $('a[href="#tab1"]').addClass('process-success');
            }
        });
        $(".third-page").click(function (e) {
            e.preventDefault();
            $('a[href="#tab3"]').tab('show');
            $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
            $('a[href="#tab2"]').addClass('process-success');
        });
        $(".forth-page").click(function (e)
        {

          e.preventDefault();
            var name = $('.name').val();
            if(name == '')
            {
                $(".name_error").css("display", "block");
                $(".name").css("border-color", "red");
                $(window).scrollTop(300);
                return false;
            }
            var description = $('.description').val();
            if( description == '' ||  description.length < 150 )
            {
                $(".description_error").css("display", "block");
                $(".description").css("border-color", "red");
                $(window).scrollTop(700);
                return false;
            }
            var price = $('.price').val();
            if($.isNumeric(price)){
                $(".price_error").css("display", "none");
                $(".price").css("border-color", "");

            } else {
                $("#price_error").html('Price must be numeric');
                $(".price_error").css("display", "block");
                $(".price").css("border-color", "red");
                $(".price").focus();
                return false;
            }
            if(price < 1 || price > 1000 ) {
                $("#price_error").html('Price must be  between 1-1000 ');
                $(".price_error").css("display", "block");
                $(".price").css("border-color", "red");
                $(window).scrollTop(1200);
                return false;
            }
            var fileslength = window.featureImageCount;
            if(fileslength < 1){
                    $("#image_file_error").html("Plaese Choose atleast one image. ");
                    $("#image_file_error").css("display", "block");
                    $(window).scrollTop(2100);
                    return false;
            } else {
              if(parseInt(window.featuredPhotosize) >= parseInt(2048576)) {
                $("#image_file_error").html("Required Image size must be less than 2 MB.");
                $(".image_file_error").css("display", "block");
                $(window).scrollTop(2100);
                return false;
              }
            }
           
//            if (localStorage.getItem('photoCounter') != localStorage.getItem('photoCounter') || localStorage.getItem('photoCounter') < 2 || localStorage.getItem('removeCallbackCount')!=0) {
//            debugger;
//              $('.photos_error').show();
//              $(window).scrollTop(2500);
//              return false;
//            }
//            else {
//                $('.photos_error').hide();
//            }

              $('a[href="#tab4"]').tab('show');
              $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
              $('a[href="#tab3"]').addClass('process-success');
            //alert(window.countImage);
//            var photos = $('#photos-data').val();
//            if(photos != 2){
//                var photoslength = $('#photos')[0].files.length;
//                if(window.countImage < 2)
//                {
//                    $("#photos_error").html("Please choose atleast two images");
//                    $(".photos_error").css("display", "block");
//                    $(window).scrollTop(2900);
//                    return false;
//                }
//
//            }


        
        });

        $(".save-btn").click(function (e)
        {

            if( $('#profile_pic').val() == 0){
                $(".profile_pic_error").css("display", "block");
                $("#profile_pic_box").css("border-color", "red");
                return false;
            }

            $('#getstus').val(e.currentTarget.value);
            var numberOfRadio = $('input:radio').length;
            var count = 0;
            $('form input[type="radio"]').not(':checked').each(function() {
                ++count;
            });
            if(count != (numberOfRadio/2)){
                $(".Radio_error").css("display", "block");
                return false;
            }

            var minimum_night = parseInt($('#minimum_night').val());
            var maximum_night = parseInt($('#maximum_night').val());
            debugger;
            if(maximum_night < minimum_night){
                $(".max_error").css("display", "block");
                $(window).scrollTop(1000);
                return false;
            }

            // $(this).unbind('submit').submit();

        });
        if($('#country').val().length < 2) {
            $.getJSON('https://geoip-db.com/json/geoip.php?jsonp=?')
                    .done (function(location)
                    {
                        $('#country').val(location.country_name);
                        $('#state').val(location.state);
                        $('#city').val(location.city);
                        $('#zip').val(location.postal);
                    });
        }
        $(".add-rule").click(function(e){
            e.preventDefault();
            var val = $("#c-rule").val();
            $("#c-rule").val("");
            var a = $('<div class="rule-toggle"><label><span>' + val + '</span></label><input type="checkbox" name="custom_rules[]" value="' + val + '" checked /> <span class="del-btn">X</span></div>');
            var del = a.find('.del-btn');
            del.click(function(){
                $(this).parent().remove();
            })
            $('.rules-list').append(a);
        });

        $(".removeError").blur(function(e){
            var name = $(this).attr('id');
            if(name == 'description'){
                var size = $("#description").val().length;
                if(size >= 150){
                    $("."+name+"_error").css("display", "none");
                    $("#"+name).css("border-color", "");
                } else {
                    $("."+name+"_error").css("display", "block");
                    $("#"+name).css("border-color", "red");
                }
            } else {
                if($(this).attr('id') != ''){
                    $("."+name+"_error").css("display", "none");
                    $("#"+name).css("border-color", "");
                }
            }
        });

        $(".isNumeric").blur(function(e){
            if($.isNumeric($(this).val())){
                $("#name_error").html('Name must be alphanumeric');
                $(".name_error").css("display", "block");
                $(".name").css("border-color", "red");
            } else {
                if($(this).val()){
                    $(".name_error").css("display", "none");
                    $(".name").css("border-color", "");
                }
            }
        });

        $(".pricecheck").blur(function(e){
            var price = $(this).val();
            if($.isNumeric($(this).val())){
                if(price > 1000){
                    $("#price_error").html('Price must be 1 to 1000');
                    $(".price_error").css("display", "block");
                    $(".price").css("border-color", "red");

                } else {
                    $(".price_error").css("display", "none");
                    $(".price").css("border-color", "");
                }

            } else {
                $("#price_error").html('Price must be numeric');
                $(".price_error").css("display", "block");
                $(".price").css("border-color", "red");
            }
        });


        $(".removeBedError").click(function(e){
            var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
            var no_of_bed = $('.no_of_bed').val();
            if(no_of_bed == bedtype){
                $(".bedtype_error").css("display", "none");
            }
        });

        $(".plusbutton").click(function(e){
            var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
            var no_of_bed = $('.no_of_bed').val();
            if(no_of_bed == bedtype){
                $('.plusbutton').prop('disabled', true);
                $('.bed-size-changer').prop('disabled', true);
            }
        });

        $(".minusbutton").click(function(e){
            var field_value = $(this).parent().find('.input-number').val();
            var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
            var no_of_bed = $('.no_of_bed').val();
            if(no_of_bed != bedtype){
                $('.plusbutton').removeAttr('disabled');
                $('.bed-size-changer').removeAttr('disabled');
            }
            if(field_value == 0){
                $(this).parent().parent().parent().find('.bed-size-changer').prop('checked', false);
            }
        });

        $(".plusbed").click(function(e){
            var bedtype = parseInt($('.no_of_airbed').val())+ parseInt($('.no_of_couch_bed').val())+ parseInt($('.no_of_twin_bed').val())+ parseInt($('.no_of_full_bed').val())+ parseInt($('.no_of_queen_bed').val())+ parseInt($('.no_of_king_bed').val());
            var no_of_bed = $('.no_of_bed').val();
            if(no_of_bed > bedtype){
                $('.plusbutton').removeAttr('disabled');
                $('.bed-size-changer').removeAttr('disabled');
            }
        });

        $('.donottype').keydown(function(e) {
            alert('Please use Plus Minus Button');
            e.preventDefault();
            return false;
        });

        $('#image-file').change(function (e) {
            for (var i = 0; i < this.files.length; i++) {
                window.featureImageCount = 1;
                photosize = this.files[i].size;
                window.featuredPhotosize = photosize
                if(photosize>2048576) //do something if file size more than 2 mb (2048576)
                {
                    $("#image_file_error").html("Image size must less than 2 MB.");
                    $(".image_file_error").css("display", "block");
                    $('.forth-page').attr('disabled','disabled');
                    $(window).scrollTop(3000);
                    return false;
                } else {
                    $(".image_file_error").css("display", "none");
                    $('.fimage_file_error').removeAttr('disabled');
                }
            }
        });
        
        $('#proof_residency').change(function (e) {
            for (var i = 0; i < this.files.length; i++) {
                photosize = this.files[i].size;
                if(photosize>2048576) //do something if file size more than 2 mb (2048576)
                {
                    $(".proof_residency_error").css("display", "block");
                    $('#save-btn').attr('disabled','disabled');
                    $(window).scrollTop(3000);
                    return false;
                } else {
                    $(".proof_residency_error").css("display", "none");
                    $('.proof_residency_error').removeAttr('disabled');
                }
            }
        });

        $(".changeaddress").blur(function(){

            var address1 = $('#address1').val();
            var address1_backup = $('#address1_backup').val();
            if(address1 != address1_backup){
                window.confirmedAddress = false;
            }
        });

        $(".perivous-btn").click(function(e){
            var page = $(this).attr('id');
            if(page == 1){
                $('a[href="#tab1"]').tab('show');
                $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
                $('a[href="#tab1"]').removeClass('process-success');
            }
            if(page == 2){
                $('a[href="#tab2"]').tab('show');
                $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
                $('a[href="#tab2"]').removeClass('process-success');

            }
            if(page == 3){
                $('a[href="#tab3"]').tab('show');
                $("html, body").stop().animate({scrollTop:0}, '500', 'swing');
                $('a[href="#tab3"]').removeClass('process-success');

            }
        });




    </script>
    <script>
        function fillInAddress(place)
        {
            emptyFeilds();
            $("#address1_err").val(1);

            var address1 = '';
            console.log(place);
            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];

                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    if(addressType == 'street_number') {
                        address1 += val + ', ';
                        val = address1;
                    } else if(addressType == 'route') {
                        address1 += val;
                        val = address1;
                    }

                    $("#" + fields[addressType]).val(val);

                }
            }
            //if postal code is not present add 0 or make it optional  , lets discuss
            // getPostalCode( place.geometry.location);
        }

        function emptyFeilds(){

            jQuery.each(fields, function(i, val) {
                $("#" + val).val("")

            });
        }

        function initFind () {

             mapDiv = document.getElementById('map_div');

//            var input = document.getElementById('pac-input');
//            var searchBox = new google.maps.places.SearchBox(input);
            var input = document.getElementById('address1');
            var options = {
                types: ['address']
            };
            var searchBox = new google.maps.places.Autocomplete(input , options);

            if(parseFloat($("#formLat").val()) > 0) {
                var LatLng = {lat: parseFloat($("#formLat").val()), lng: parseFloat($("#formLng").val())};
                var zoom = 16;
            } else {
                var LatLng = {lat: 41.229880, lng: -96.225953};
                var zoom = 4;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var LatLng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: LatLng,
                            radius: position.coords.accuracy
                        });
                        searchBox.setBounds(circle.getBounds());
                    });
                }
            }

            map = new google.maps.Map(mapDiv, {
                zoom: zoom,
                center: LatLng,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                },
            });
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            marker = new google.maps.Marker({
                position: LatLng,
                map: map,
                animation: google.maps.Animation.DROP,
                draggable:true
            });
            var markers = [];
            markers.push(marker);
            google.maps.event.addListener(marker,'dragend',function(event){
                $("#formLat").val(event.latLng.lat());
                $("#formLng").val(event.latLng.lng());
                $("#latitude").val(event.latLng.lat());
                $("#longitude").val(event.latLng.lng());
                var geocoder = new google.maps.Geocoder;
                var postition = {lat: event.latLng.lat(), lng: event.latLng.lng()};
                geocoder.geocode({'location': postition}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            fillInAddress(results[0]);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            });
            searchBox.addListener('place_changed', function() {
                var place = searchBox.getPlace();
                fillInAddress(place);
                if (place.length == 0) {
                    return;
                }
                var bounds = new google.maps.LatLngBounds();
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                $("#formLat").val(place.geometry.location.lat());
                $("#formLng").val(place.geometry.location.lng());
                $("#latitude").val(place.geometry.location.lat());
                $("#longitude").val(place.geometry.location.lng());

                marker.addListener('dragend', function(e){
                    $("#formLat").val(e.latLng.lat());
                    $("#formLng").val(e.latLng.lng());
                });
                //markers.push(marker);
                input.value = place.name;
                map.setCenter(place.geometry.location);

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setZoom(16);
                }
               var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
               marker.setPosition(latlng);
            });
        }
        $(document).ready(function(){initFind()});

        function getLocation(){
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            $("#formLat").val(latitude);
            $("#formLng").val(longitude);
            if(latitude != '' && longitude != '')
            {
            var geocoder = new google.maps.Geocoder;
            var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        fillInAddress(results[0]);
                        var map = new google.maps.Map(document.getElementById('map_div'), {
                            zoom: 16,
                            center: latlng,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                                position: google.maps.ControlPosition.LEFT_BOTTOM
                            },
                        });
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            draggable:true
                        });

                        //var latlng = new google.maps.LatLng(latitude, longitude);
                       // marker.setPosition(latlng);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
            }
        }
    </script>
    @if(!$listing->id)
        <script>
            window.onbeforeunload = function() {
                if(!window.submitting) {
                    return "Are you sure?"
                }
            }
        </script>
    @else
        <script>
            window.confirmedAddress = true;
        </script>
    @endif
    <!-- Amir image Code Start -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{url('') . '/js/dropzone.js'}}" rel="stylesheet"></script>

    <script type="text/javascript">
        jQuery.noConflict();
        jQuery( document ).ready(function( $ ) {
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
                <?php } else {?>
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
                    //console.log(this.files[1]);
                    $('#profile_pic').val(1);
                    $(".profile_pic_error").css("display", "none");
                    $("#profile_pic_box").css("border-color", "");
                    if (this.files[1]!=null){
                        this.removeFile(this.files[0]);
                    }
                });
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            }
        });
        });
    </script>

@endsection