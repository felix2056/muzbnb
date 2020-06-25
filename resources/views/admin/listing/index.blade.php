@extends('admin.layout.master')

@section('header_scripts')

    <link href="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{route('listing.index')}}">Listing</a>
        </li>
    </ul>
@endsection

@section('title')
    <h1 class="page-title"> Listing
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Listing </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Listing url </th>
                    <th> User profile </th>
                    <th> &nbsp; </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($listings as $listing)
                    <tr>
                        <td> {{$i++}} </td>
                        <td> {{$listing->name}}</td>
                        <td> <a href="{{route('room', $listing->id)}}" target="_blank">View</a></td>
                        <td> <a href="{{route('admin.users.edit', $listing->user_id)}}" target="_blank">Profile</a></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-left" role="menu">
                                    <li><a href="{{route('listing.show', $listing->id)}}"><i class="glyphicon glyphicon-edit"></i> View </a></li>
                                    <li><a href="javascript:;" class="deleteBtn" data-id="{!! $listing->id !!}" data-status="{!! ($listing->status == 1) ? 2:1 !!}"
                                           data-deleteUrl="{{route('listing.destroy', $listing->id)}}">
                                            <i class="glyphicon glyphicon-ban-circle"></i> {!! ($listing->status == 1) ? 'Publish':'Un-Publish' !!} </a>
                                    </li>
                                    <li><a href="javascript:;" class="deleteBtn" data-id="{!! $listing->id !!}" data-status="" data-deleteUrl="{{route('listing.destroy', $listing->id)}}"><i class="glyphicon glyphicon-remove"></i> Delete </a></li>
                                    {{--<li><a href="{{route('listing.edit', $listing->id)}}"><i class="glyphicon glyphicon-edit"></i> Edit </a></li>--}}
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
                        <h4 class="modal-title"><span class="dialogue_text">Delete</span> List</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure, You want to <span class="dialogue_text">Delete</span> this List?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger confirm-delete" data-url="{{route('listing.index')}}">Yes</button>
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
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var deleteUrl = $(this).attr('data-deleteUrl');
            if(status != ''){
                $(".dialogue_text").html((status == 0) ? 'Un-Publish':'Publish');
            } else {
                $(".dialogue_text").html('Delete');
            }
            $("#confirmDelete").modal('show');
            $("#confirmDelete").find('.confirm-delete').attr('data-id', id);
            $("#confirmDelete").find('.confirm-delete').attr('data-status', status);
            $("#confirmDelete").find('.confirm-delete').attr('data-deleteUrl', deleteUrl);
        });
        $(document).on('click', '.confirm-delete', function(){
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = $(this).attr('data-url');
            var deleteUrl = $(this).attr('data-deleteUrl');
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
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
    {{--<script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        $('.row-delete').click(function () {
            var id = $(this).attr('id')

            swal({
                    title: "Do you want to delete this entry?",
                    text: "Are you sure?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true, },
                function(){
                    setTimeout(function(){
                        ajax_delete(id);
                    }, 2000);
                });
        });

        function ajax_delete(id){
            $.ajax({
                method: 'DELETE',
                url   : "{{url('admin/currency')}}/"+id,
                data  : {
                    _token : "{{csrf_token()}}"
                },
                success: function(response){
                    // console.log(response)
                    if(response == 'success'){
                        swal("Deleted!", "Entry Deleted.", "success");
                    }else{
                        swal("Cancelled", "Please try again.", "error");
                    }
                }
            })
            location.reload();
        }


    </script>--}}

@endsection
