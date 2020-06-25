@extends('admin.layout.master')

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
            <span>Admin Profile</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                @if($admin->id == auth()->guard('admin')->id())
                    <a href="{{ route('admin.update.profile',$admin->id) }}" class="btn btn-primary">Update Profile</a>
                @else
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">Admins List</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Admins
        <small>Recent Admin Profile</small>
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Admin Profile </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-xs-9">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">First Name <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $admin->first_name }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Last Name <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $admin->last_name }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Date Of Birth <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{date('M j, Y',strtotime($admin->date_of_birth))}}</div>

                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Email <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $admin->email }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Role <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $admin->role }}</div>
                    </div>

                    @if($profile)
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Gender <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->gender!=''?$profile->gender:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Designation <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->designation!=''?$profile->designation:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Prefered Currency <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->	preferred_currency!=''?$profile->preferred_currency:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Language <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->preferred_lang!=''?$profile->preferred_lang:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Location <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->location!=''?$profile->location:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Self Description <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->self_description!=''?$profile->self_description:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Timezone <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->timezone!=''?$profile->timezone:'Not set' }}</div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-3">Emergency Contact <span style="float: right;">:</span></div>
                        <div class="col-xs-9">{{ $profile->emergency_contact!=''?$profile->emergency_contact:'Not set' }}</div>
                    </div>
                    @endif
                </div>
                <div class="col-xs-3">
                    @if($profile)
                    <img src="/adminAvatar/{{$profile->avatar!=''?$profile->avatar:'avatar.jpg'}}" alt="Avatar" class="img-thumbnail img-responsive">
                    @else
                    <img src="/adminAvatar/avatar.jpg" alt="Avatar" class="img-thumbnail img-responsive">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection