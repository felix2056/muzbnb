@extends('user.dashboard.layout')

@section('title', 'My Reviews')
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
                <div class="section-title">
                    <h1 class="text-center">My Reviews</h1>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="left-menu move-up">
                            <a href="#"
                               @if(strpos(Request::url(), '/reviews'))
                            class="active"
                                    @endif>
                                <h3>Reviews about you </h3>
                            </a>
                            <a href="{{-- url('dashboard/reviews-by-you') --}}"
                               @if(strpos(Request::url(), '/reviews-by-you'))
                            class="active"
                                    @endif>
                                <h3>Review by you</h3>
                            </a>
                        </div>
                    </div>
                    {{--<div class="col-md-4" >--}}
                    {{--<ul class="side-menu-review">--}}
                    {{--<li class="review-option review-active">--}}
                    {{--<a href="#" >--}}
                    {{--Reviews about you--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="review-option">--}}
                    {{--<a href="#">--}}
                    {{--Review by you--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2 col-sm-3 col-xs-4 col-xs-offset-4 col-md-offset-0">--}}
                        {{--<img src="{{url('')}}/style/assets/img/1 - Hadi Shakuur - CEO & Co-founder 4.png" alt="" class="img-circle review-image">--}}
                        {{--<p class="reviewer-name">Michel</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-12">--}}
                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-12">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-6">--}}
                                        {{--<p>text of the printing and typesetting</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-6">--}}
                                        {{--<p style="text-align: right;"> <i class="fa fa-home" aria-hidden="true"></i> <i class="fa fa-heart" aria-hidden="true" style="color: #E25F6D;"></i>--}}
                                            {{--<span style="color: #E25F6D;">Budapest studio in City Center</span></p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Phone Modal -->

@endsection

@section('scripts')

@endsection
