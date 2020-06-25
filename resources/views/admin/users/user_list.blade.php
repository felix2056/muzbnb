@extends('admin.layout.master')

@section('header_scripts')

    <link href="{{url('public')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
    <ul class="page-breadcrumb col-xs-4">
        <li>
            <a href="javascript:;">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{route('admin.user.list')}}">User</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="form-actions">
            <div class="btn-set pull-left">
                <a href="{{route('admin.users.create')}}" class="btn btn-primary">Add User</a>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <h1 class="page-title"> Users
        <small>Recent User</small>
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Users </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body" style="overflow-x: scroll;">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Gender </th>
                    <th> Date of Birth </th>
                    {{--<th> Self Description </th>--}}
                    <th> Country </th>
                    <th> Phone </th>
                    <th> Preferred Language  </th>
                    <th> Preferred Currency </th>
                    <th> Location </th>
                    <th> SMS Notification </th>
                    <th> School </th>
                    <th> Work </th>
                    <th> Timezone </th>
                    <th> Verification </th>
                    <th> Status </th>
                    <th> Actions </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($users as $user)
                    <tr>
                        <td> {{$i++}} </td>
                        <td> {{$user->first_name}} {{ $user->last_name }}</td>
                        <td> {{$user->email}} </td>
                        <td> {{ ucfirst($user->gender) }} </td>
                        <td> {{date('j M, Y',strtotime($user->date_of_birth))}} </td>
{{--                        <td> {{$user->userProfile($user->id)->self_description}} </td>--}}
                        <td> {{$user->country}} </td>
                        <td> {{$user->emergency_contact_code.'-'.$user->emergency_contact_number}} </td>
                        <td> {{$user->preferred_lang}} </td>
                        <td> {{$user->preferred_currency}} </td>
                        <td> {{$user->location}} </td>
                        <td> {!! $user->sms_notification?'<span class="label label-sm label-info"> ON </span>' :'<span class="label label-sm label-danger"> OFF </span>'!!} </td>
                        <td> {{$user->school}} </td>
                        <td> {{$user->work}} </td>
                        <td> {{$user->timezone}} </td>
                        <td>
                            {!!$user->verified ? '<span class="label label-sm label-info"> Verified </span>' : '<span class="label label-sm label-danger"> Unverified </span>'!!}
                        </td>
                        <td>
                            {!!$user->status ? '<span class="label label-sm label-info"> Active </span>' : '<span class="label label-sm label-danger"> Banned </span>'!!}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-left" role="menu" style="left: -110px;">
                                    <li>

                                        <a href="{{route('admin.users.edit', $user->id)}}">
                                            <i class="glyphicon glyphicon-edit"></i> Edit </a>
                                    </li>

                                    <li>
                                        <a href="javascript:;" class="row-ban deleteBtn" data-id="{{$user->id}}" data-status="{!! ($user->status == 1) ? 0:1 !!}">
                                            <i class="glyphicon glyphicon-ban-circle"></i> {!!$user->status ? 'Ban':'Active'!!} </a>
                                    </li>

                                    <li>
                                        <a href="javascript:;" class="row-delete deleteBtn" data-id="{{$user->id}}" data-status="">
                                            <i class="glyphicon glyphicon-remove"></i> Delete </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Delete Modal -->
        <div id="confirmDelete" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="dialogue_text">Delete</span> User</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure, You want to <span class="dialogue_text">Delete</span> this User?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger confirm-delete" data-url="{{route('admin.user.list')}}">Yes</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeOut(function(){
                $("#custom-alerts").remove();
            }, 3000);
        });
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            if(status != ''){
                $(".dialogue_text").html((status == 0) ? 'Banned':'Activate');
            } else {
                $(".dialogue_text").html('Delete');
            }
            $("#confirmDelete").modal('show');
            $("#confirmDelete").find('.confirm-delete').attr('data-id', id);
            $("#confirmDelete").find('.confirm-delete').attr('data-status', status);
        });
        $(document).on('click', '.confirm-delete', function(){
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = $(this).attr('data-url');
            $.ajax({
                url: '/admin/users/delete/'+id,
                type: 'GET',
                data: {status:status},
                success:function(response){
                    if(response.status){
                        $("#confirmDelete").modal('hide');
                        window.location = ''+url+'';
                    }
                }
            });
        });
    </script>
    {{--<script src="{{url('public')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('public')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{url('public')}}/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="{{url('public')}}/assets/global/plugins/bootstrap-sweetalert/sweet-alert.min.js" type="text/javascript"></script>
    <script src="{{url('public')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        $('.row-delete').click(function () {
            var id = $(this).attr('id')

            swal({
                    title: "Do you want to delete this entry?",
                    text: "Are you sure?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true, },
                function(){
                    setTimeout(function(){
                        ajax_delete(id);
                    }, 500);
                });
        });

        function ajax_delete(id){
            $.ajax({
                method: 'DELETE',
                url   : "{{url('admin/coupons')}}/"+id,
                data  : {
                    _token : "{{csrf_token()}}"
                },
                success: function(response){
                    // console.log(response)
                    if(response == 'success'){
                        swal("Deleted!", "Entry Deleted.", "success");
                        location.reload();
                    }else{
                        swal("Cancelled", "Please try again.", "error");
                    }
                }
            })
        }
    </script>--}}


@endsection
