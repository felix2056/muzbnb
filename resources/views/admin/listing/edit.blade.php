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
    <h1 class="page-title">Edit Listing
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Edit Listing </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <tbody>
                    <tr>
                        <th style="min-width: 150px">Name</th>
                        <td> {{$listing->name}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td> {{$listing->description}}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td> {{$listing->country}}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td> {{$listing->city}}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td> {{$listing->state}}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td> {{$listing->user->fullname()}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td> {{$listing->user->email}}</td>
                    </tr>
                    <tr>
                        <th>Date Published</th>
                        <td> {{$listing->published_at}}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td> {{ucfirst($listing->user->gender)}}</td>
                    </tr>
                    <tr>
                        <th>Verification Status</th>
                        <td> {{$listing->address_verified ? 'Verified' : 'Unverified'}}</td>
                    </tr>
                    <tr>
                        <th>No of Bedrooms</th>
                        <td> {{$listing->no_of_bedroom}}</td>
                    </tr>
                    <tr>
                        <th>No of Beds</th>
                        <td> {{$listing->no_of_bed}}</td>
                    </tr>
                    <tr>
                        <th>No of Bathroom</th>
                        <td> {{$listing->no_of_bath}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    <script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
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


    </script>

@endsection
