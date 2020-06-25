@extends('admin.layout.master')

@section('header_scripts')
    <link href="{{url('')}}/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="{{url('')}}/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link href="{{url('')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <style>
        .capital {
            text-transform: uppercase;
        }
    </style>
@endsection

@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('admin.user.list') }}">Users</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Edit User</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{ route('admin.user.list') }}" class="btn btn-primary">User List</a>
                <a class="btn btn-danger" data-target="#stack1" data-toggle="modal">Change Password</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Users
        <small>Recent Edit User</small>
    </h1>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Edit User </div>
                </div>
                <div class="portlet-body form">
                    @if ($errors->any())
                        <div class="col-xs-12">
                            {!!  implode('', $errors->all('<div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                             :message</div>'))  !!}
                        </div>
                @endif
                    <!-- BEGIN FORM-->
                    <form method="post" id="users_edit" action="{{route('admin.users.update', $user->id)}}" class="form-horizontal">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Username</label>
                                <div class="col-md-4">
                                    <input type="text" name="username" class="form-control" placeholder="Enter Username" value="{{!empty(old('username')) ? old('username') : $user->username }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{!empty(old('first_name')) ? old('first_name') : $user->first_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{!empty(old('last_name')) ? old('last_name') : $user->last_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Gender</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large">
                                        <select name="gender" class="form-control input-sm input-xsmall input-inline">
                                            <option value="None Given" >None Given</option>
                                            <option value="Male" {{$user->gender=="Male" ? "selected":""}}>Male</option>
                                            <option value="Female" {{$user->gender=="Female" ? "selected":""}}>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date of Birth</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large date-picker input-daterange" data-date="2012-01-01" data-date-format="yyyy-mm-dd">
                                        <input type="date" readonly name="date_of_birth" class="form-control" value="{{!empty(old('date_of_birth')) ? old('date_of_birth') : $user->date_of_birth }}" placeholder="Select Date of Birth">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                        <input type="email" name="email" class="form-control" value="{{!empty(old('email')) ? old('email') : $user->email }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Self Description</label>
                                <div class="col-md-4">
                                    <textarea name="self_description" id="" class="form-control" cols="30" rows="11">{{!empty(old('self_description')) ? old('self_description') : $user->self_description }}</textarea>
                                    {{--<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{!empty(old('last_name')) ? old('last_name') : $user->last_name }}">--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Country</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large">
                                        <select class="form-control country" name="country" id="country" onChange="stateChange(this.value)">
                                            <option value="{{Auth::user()->country}}">{{$user->country}}</option>
                                            @include('layouts.userCountry')
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">City</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large">
                                        <select class="form-control country" name="city" id="state">
                                            <option value="{{$user->city}}">{{$user->city}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Preferred Language</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large">
                                        <select class="form-control country" name="preferred_lang">
                                            <option value="{{$user->preferred_lang}}">{{$user->preferred_lang}}</option>
                                            @include('layouts._languages')
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Preferred Currency</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large">
                                        {!! Form::select('preferred_currency', for_select($currencies), $user->preferred_currency, ['class'=>'form-control country']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Location</label>
                                <div class="col-md-4">
                                    <input type="text" name="location" class="form-control" placeholder="Enter Location" value="{{!empty(old('location')) ? old('location') : $user->location }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">SMS Notification</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <input type="checkbox" name="sms_notification" class="make-switch" data-on-color="info" value="1" data-off-color="success"
                                                   @if(old('status') == '1')
                                                   checked
                                                   @elseif($user->verified == '1')
                                                   checked
                                                    @endif
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">School</label>
                                <div class="col-md-4">
                                    <input type="text" name="school" class="form-control" placeholder="Enter School" value="{{!empty(old('school')) ? old('school') : $user->school }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Work</label>
                                <div class="col-md-4">
                                    <input type="text" name="work" class="form-control" placeholder="Enter Work" value="{{!empty(old('work')) ? old('work') : $user->work }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Timezone</label>
                                <div class="col-md-4">
                                    <input type="text" name="timezone" class="form-control" placeholder="Enter Timezone" value="{{!empty(old('timezone')) ? old('timezone') : $user->timezone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Emergency Contact</label>
                                <div class="col-md-4">
                                    <input type="text" name="emergency_contact" class="form-control" placeholder="Enter Emergency Contact" value="{{!empty(old('emergency_contact')) ? old('emergency_contact') : $user->emergency_contact }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">VAT ID Number</label>
                                <div class="col-md-4">
                                    <input type="text" name="vat_id" class="form-control" placeholder="Enter VAT ID Number" value="{{!empty(old('vat_id')) ? old('vat_id') : $user->vat_id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Home Address</label>
                                <div class="col-md-4">
                                    <input type="text" name="home_address" class="form-control" placeholder="Enter Home Address" value="{{!empty(old('home_address')) ? old('home_address') : $user->home_address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Zip Code</label>
                                <div class="col-md-4">
                                    <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code" value="{{!empty(old('zip_code')) ? old('zip_code') : $user->zip_code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Verified?</label>
                                <div class="col-md-4">
                                    <input type="checkbox" name="verified" class="form-control" value="1"
                                           @if(old('verified') == '1')
                                           checked
                                           @elseif($user->verified)
                                           checked
                                            @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Verification Files</label>
                                <div class="col-md-4">
                                    @foreach($files as $file)
                                        <a href="/files/users/{{$user->id . '/' . $file}}" target="_blank"><img class="img-thumbnail" width="250" src="/files/users/{{$user->id . '/' . $file}}" /></a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <input type="checkbox" name="status" class="make-switch" data-on-color="info" value="1" data-off-color="success"
                                                   @if(old('status') == '1')
                                                   checked
                                                   @elseif($user->status == '1')
                                                   checked
                                                    @endif
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>

    <div id="stack1" class="modal fade" tabindex="-1" data-focus-on="input:first">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Change Password</h4>
        </div>
        <form method="POST" id="change_password" action="{{route('admin.users.changePassword')}}">
            <div class="modal-body">
                <div class="form-group last password-strength">
                    <label class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        {{csrf_field()}}
                        <input type="text" class="form-control" name="password" id="password_strength">
                        <span class="help-block">
                        Please type to see password strength
                    </span>

                        <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">

                    </div>
                </div>
            </div>

            <div class="clearfix">

            </div>

            <div class="modal-footer">
                <button class="btn blue" type="submit">Submit</button>
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
            </div>
        </form>

    </div>
@endsection

@section('footer_scripts')
    <script src="{{url('')}}/assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/components-form-tools.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/ui-extended-modals.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/countries.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/numeric.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".numeric-only").numeric();
        });
    </script>
@endsection
