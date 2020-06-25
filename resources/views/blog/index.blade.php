@extends('layouts.master')
@section('title', 'Blog')
@section('content')
    <div class="main-wrapper">
        <div class="blog-wrap">

            <div class="container top-stories">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title">
                            <h1>Top Stories</h1>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-white pull-right">Submit a Story</a>
                    </div>
                </div>
                @if($posts['featured']->first())
                <div class="row storie-row">
                    <div class="celebration-box"><img src="{{url('')}}/style/assets/img/celebration-diamond.png"></div>
                    <?php
                        $p1=$p2=$p3=$p4=null;
                        foreach ($posts['featured'] as $i=>$post)
                            {
                                if($i==0) {
                                    $p1 = $post;
                                } elseif($i==1) {
                                    $p2 = $post;
                                } elseif($i==2) {
                                    $p3 = $post;
                                } elseif($i==3) {
                                    $p4 = $post;
                                }
                            }
                    ?>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="stories stories-big">
                            <img src="{{ blog_img($p1->image(), 'featured-big') }}" alt="">
                            <div class="storie-title" style="width: 100%;">
                                <a href="/blog/{{$p1->post_name}}"><h1>{{$p1->post_title}}</h1></a>
                            </div>
                        </div>
                    </div>

                    @if($p2 && $img = $p2->image())
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 full-stories">
                                <div class="stories">
                                    <img src="{{ blog_img($img, 'featured-medium') }}" alt="">
                                    <div class="storie-title">
                                        <a href="/blog/{{$p2->post_name}}"><h3>{{$p2->post_title}}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($p3 && $img = $p3->image())
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 half-stories">
                                <div class="stories">
                                    <img src="{{ blog_img($img, 'featured-small') }}" alt="">
                                    <div class="storie-title">
                                        <a href="/blog/{{$p3->post_name}}"><h3>{{$p3->post_title}}</h3></a>
                                    </div>
                                </div>
                            </div>

                            @if($p4 && $img = $p4->image())
                            <div class="col-md-6 col-sm-6 col-xs-6 half-stories">
                                <div class="stories">
                                    <img src="{{ blog_img($img, 'featured-small') }}" alt="">
                                    <div class="storie-title">
                                        <a href="/blog/{{$p4->post_name}}"><h3>{{$p4->post_title}}</h3></a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                        <div class="stories-review text-center">
                            <h1><i class="fa fa-quote-left" aria-hidden="true"></i>Traveling - it leaves you speechless,
                                then turns you into a storyteller.<i class="fa fa-quote-right" aria-hidden="true"></i>
                            </h1>
                            <h5>- ibn battuta</h5>
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($posts['adventures']->first()))
                <div class="container-fluid box-width heading-wrap">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="section-title adventures">
                                <h1><img src="{{url('')}}/style/assets/img/adventures-icon.png" alt="adventures"> <span>Adventures</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="full-section slider-section">
                    <div class="container-fluid box-width">
                        <div class="row">
                            <div class="adventures-revolution slider">
                                @foreach($posts['adventures'] as $post)
                                    <div class="blog-item">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="blog-img">
                                                @if($post->image)
                                                    <img src="{{ blog_img($post->image) }}" style="max-height:205px;"
                                                         alt="">
                                                @else
                                                    <img src="/images/404-img.png" style="max-height:205px;" alt="">
                                                @endif
                                                <span class="tag adventures-tag">Adventures</span>
                                            </div>
                                            <div class="blog-detail">
                                                <a href="/blog/{{$post->post_name}}">
                                                    <h3>{{$post->post_title}}</h3>
                                                </a>
                                                <p>{{str_limit(strip_tags($post->post_content), 120)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /section-adventures -->
            @endif
            @if(!empty($posts['tips']->first()))
                <div class="container-fluid box-width heading-wrap">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="section-title stories">
                                <h1><img src="{{url('')}}/style/assets/img/stories-icon.png" alt="stories">
                                    <span>Tips</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="full-section slider-section">
                    <div class="container-fluid box-width">
                        <div class="row">
                            <div class="stories-revolution slider">
                                @foreach($posts['tips'] as $post)
                                    <div class="blog-item">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="blog-img">
                                                @if($post->image)
                                                    <img src="{{ blog_img($post->image) }}" style="max-height:205px;"
                                                         alt="">
                                                @else
                                                    <img src="/images/404-img.png" style="max-height:205px;" alt="">
                                                @endif
                                                <span class="tag adventures-tag-tips">Tips</span>
                                            </div>
                                            <div class="blog-detail">
                                                <a href="/blog/{{$post->post_name}}">
                                                    <h3>{{$post->post_title}}</h3>
                                                </a>
                                                <p>{{str_limit(strip_tags($post->post_content), 120)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /section-stories -->
            @endif
            @if(!empty($posts['community']->first()))
                <div class="container-fluid box-width heading-wrap">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="section-title community">
                                <h1><img src="{{url('')}}/style/assets/img/community-icon.png" alt="community"> <span>Community</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="full-section slider-section">
                    <div class="container-fluid box-width">
                        <div class="row">
                            <div class="community-revolution slider">
                                @foreach($posts['community'] as $post)
                                    <div class="blog-item">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="blog-img">
                                                @if($post->image)
                                                    <img src="{{ blog_img($post->image) }}" style="max-height:205px;"
                                                         alt="">
                                                @else
                                                    <img src="/images/404-img.png" style="max-height:205px;" alt="">
                                                @endif
                                                <span class="tag adventures-tag-community">Community</span>
                                            </div>
                                            <div class="blog-detail">
                                                <a href="/blog/{{$post->post_name}}">
                                                    <h3>{{$post->post_title}}</h3>
                                                </a>
                                                <p>{{str_limit(strip_tags($post->post_content), 120)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /section-community -->
            @endif
            @if(!empty($posts['news']->first()))
                <div class="container-fluid box-width heading-wrap">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="section-title news">
                                <h1><img src="{{url('')}}/style/assets/img/news-icon.png" alt="news"> <span>News</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="full-section slider-section mrg">
                    <div class="container-fluid box-width">
                        <div class="row">
                            <div class="news-revolution slider">
                                @foreach($posts['news'] as $post)
                                    <div class="blog-item">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="blog-img">
                                                @if($post->image)
                                                    <img src="{{ blog_img($post->image) }}" style="max-height:205px;"
                                                         alt="">
                                                @else
                                                    <img src="/images/404-img.png" style="max-height:205px;" alt="">
                                                @endif
                                                <span class="tag adventures-tag-news">News</span>
                                            </div>
                                            <div class="blog-detail">
                                                <a href="/blog/{{$post->post_name}}">
                                                    <h3>{{$post->post_title}}</h3>
                                                </a>
                                                <p>{{str_limit(strip_tags($post->post_content), 120)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /section-news -->
            @endif
            <div class="container-fluid box-width submit-story">
                <div class="row">
                    <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-4 text-center">
                        <select class="form-control">
                            <option>Category</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-4 text-center archive-box">
                        <select class="form-control">
                            <option>Archive</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                        <input type="submit" class="btn btn-red" name="" value="Submit a story">
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">

        /* --- Adventures --- */
        $('.adventures-revolution').slick({
            dots: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                    }
                }
            ]
        });

        /* --- Adventures --- */
        $('.stories-revolution').slick({
            dots: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                    }
                }
            ]
        });

        /* --- Adventures --- */
        $('.community-revolution').slick({
            dots: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                    }
                }
            ]
        });

        /* --- Adventures --- */
        $('.news-revolution').slick({
            dots: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                    }
                }
            ]
        });
        $(document).on('click', '.open-signup-social', function(){
            $("#signup-social").modal('hide');
            setTimeout(function(){
                $("#signup-social").modal('show');
            }, 500);
        });
    </script>
@endsection
