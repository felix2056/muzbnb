@extends('user.dashboard.layout')

@section('title', 'My Account')

@section('style-top')
    <link href="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <style>
        .user-content {
            padding: 80px 0px !important;
        }
    </style>
@endsection
@section('tabcontent')

    <div class="container-fluid box-width profile my-listing" >
        <div class="row">
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="left-menu">
                                <a href="" class="active">
                                    <h3>My Listings </h3>
                                </a>
                                <a href="{{ route('my-reservations') }}">
                                    <h3>My Reservations</h3>
                                </a>
                                <a href="{{route('add-listing')}}" class="red">
                                    <h3>
                                        Add New Listings
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            {{--<div class="section-heading">
                                <h3>Drafts</h3>
                            </div>--}}
                            @if (Session::get('error'))
                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
                            @if (Session::get('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif

                        @foreach($draftListings as $listing)
                                <div class="single-listing" id="listing-{{ $listing->id }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ $listing->showFeaturedImage('s') }}" alt="..." class="img-thumbnail">
                                        </div>
                                        <div class="col-md-8">
                                            <a href="{{route('room', $listing->id)}}">
                                                <h4>{{$listing->name}}</h4>
                                            </a>
                                            <p>Last update on {{ $listing->updated_at->format('M d, Y') }}</p>
                                            <div class="button use">
                                                <a href="{{route('room', $listing->id) }}" class="btn btn-success btn-lg">Preview</a>
                                                <a href="{{route('edit-listing', $listing->id)}}" class="btn btn-info btn-lg">Finish the Listing </a>
                                                <a href="{{route('publish-listing', $listing->id)}}" class="btn btn-default btn-lg">Publish</a>
                                                <a href="#" data-id="{{$listing->id}}" class="btn btn-danger btn-lg delete-btn">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <nav aria-label="Page navigation">
                                {!! $draftListings->links() !!}
                            </nav>
                            <div class="section-heading">
                                {{--<h3>Published</h3>--}}
                            </div>
                            @foreach($publishedListings as $listing)
                                <div class="single-listing" id="listing-{{ $listing->id }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ $listing->showFeaturedImage('s') }}" alt="..." class="img-thumbnail">
                                        </div>
                                        <div class="col-md-8">
                                            <a href="{{route('room', $listing->id)}}">
                                                <h4>{{$listing->name}}</h4>
                                            </a>
                                            <p>Last update on {{ $listing->updated_at->format('M d, Y') }}</p>
                                            <div class="button use">
                                                <a href="{{route('room', $listing->id) }}" class="btn btn-success btn-lg">Preview</a>
                                                <a href="{{route('edit-listing', $listing->id)}}" class="btn btn-default btn-lg">Edit</a>
                                                <a href="{{route('unpublish-listing', $listing->id)}}" class="btn btn-default btn-lg">Unpublish</a>
                                                <a href="#" data-id="{{$listing->id}}" class="btn btn-danger btn-lg delete-btn">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <nav aria-label="Page navigation">
                                {!! $publishedListings->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/ui-sweetalert.min.js" type="text/javascript"></script>
    {{--<script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>--}}
    <script type="text/javascript">

        $('.delete-btn').click(function () {
            console.log('come');
            var id = $(this).data('id');

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
                url   : "{{url('')}}/delete-listing/" + id,
                data  : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function(response){
                    // console.log(response)
                    if(response == 'success'){
                        swal("Deleted!", "Entry Deleted.", "success");
                        $("#listing-" + id).remove();
                    }else{
                        swal("Cancelled", "Please try again.", "error");
                    }
                }
            })
        }
    </script>
@endsection