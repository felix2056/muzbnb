@extends('admin.layout.master')

@section('header_scripts')

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
        <a href="{{ route('admin.index') }}">Admins</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Add Admin</span>
    </li>
</ul>
<div class="page-toolbar">
    <div class="form-actions">
	    <div class="btn-set pull-left">
	        <a href="{{ route('admin.index') }}" class="btn btn-primary">Admins List</a>
	    </div>
	</div>
</div>
@endsection

@section('title')
<h1 class="page-title"> Admins
    <small>Recent Added Admins</small>
</h1>
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Add Admins </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form method="POST" id="users_add" action="{{route('admin.store')}}" class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-4">
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{old('first_name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{old('last_name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date of Birth</label>
                            <div class="col-md-4">
                                <div class="input-group input-large date-picker input-daterange" data-date="2012-01-01" data-date-format="yyyy-mm-dd">
                                    <input type="date" name="date_of_birth" class="form-control" value="{{old('date_of_birth')}}" placeholder="Select Date">
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
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group last password-strength">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-4">
                                
                                    <input type="text" class="form-control" name="password" id="password_strength">
                                    <span class="help-block">
                                        Please type to see password strength
                                    </span>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Role</label>
                            <div class="col-md-4">
                                <div class="input-group input-large">
                                    <select name="role" class="form-control input-sm input-inline">
                                        @if($admin->role=='Admin')
                                        <option value="Admin">Admin</option>
                                        @endif
                                        <option value="Sub Admin">Sub Admin</option>
                                    </select>
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
@endsection

@section('footer_scripts')
<script src="{{url('')}}/assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{url('')}}/js/validation/users-validation.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="{{url('')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

@endsection