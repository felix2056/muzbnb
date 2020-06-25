@extends('layouts.master')

@section('title', 'Press')

@section('content')
    <div class="press_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="press_banner_info">
                        <h6>PRESS</h6>
                        <h1>Press & Media Kit</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="press_content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="press_about press_top_section">
                        <h2>About</h2>
                        <p>Muzbnb is an online peer-to-peer homestay network that connects travelers with rental spaces hosted by Muslims worldwide. Muzbnb allows both Muslims and non-Muslims the ability to host and book homes that are accommodating to their religious needs for leisure or business travel anywhere in the world.</p>
                    </div>
                    <div class="press_mission press_top_section">
                        <h2>Mission</h2>
                        <p>To encourage travel, adventure, and the building of a global community where people of faith feel comfortable and accepted while traveling, all while having fun.</p>
                    </div>
                    <div class="press_vision press_top_section">
                        <h2>Vision</h2>
                        <p>To become the global leader in faith-based travel & lodging accommodations.</p>
                    </div>

                    <div class="press_slider press_slider_common">
                        <h2>Press</h2>
                        <div class="press_slider_common_info">
                            @foreach($press as $p)
                                <div class="press_slider_common_box">
                                    <h6>{{ $p->sub_title }}</h6>
                                    <h5><a href="{{$p->url}}" target="_blank">{{$p->post_title}}</a></h5>
                                    <span>{{ date('m-d-Y',strtotime($p->post_date)) }}</span>
                                    <p>{!! strlen($p->post_content)>200?substr(strip_tags($p->post_content),0,200).'...':strip_tags($p->post_content) !!}</p>
                                </div>
                            @endforeach
                            {{--<div class="press_slider_common_box">--}}
                                {{--<h6>the memo</h6>--}}
                                {{--<h5>Muzbnb: the prejudice-free future of Muslim travel</h5>--}}
                                {{--<span>01-31-2017</span>--}}
                                {{--<p>Are you looking for an apartment with a prayer space? Near a mosque? Or halal restaurants? Muzbnb makes it easy.</p>--}}
                            {{--</div>--}}
                            {{--<div class="press_slider_common_box">--}}
                                {{--<h6>Washington Business Journal</h6>--}}
                                {{--<h5>D.C. startup launches Muslim-focused home-sharing …</h5>--}}
                                {{--<span>01-31-2017</span>--}}
                                {{--<p>Create lasting experiences with family, friends or even solo when you travel with Muzbnb. </p>--}}
                            {{--</div>--}}
                            {{--<div class="press_slider_common_box">--}}
                                {{--<h6>the memo</h6>--}}
                                {{--<h5>Muzbnb: the prejudice-free future of Muslim travel</h5>--}}
                                {{--<span>01-31-2017</span>--}}
                                {{--<p>Are you looking for an apartment with a prayer space? Near a mosque? Or halal restaurants? Muzbnb makes it easy.</p>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="news_slider press_slider_common">
                        <h2>News</h2>
                        <div class="press_slider_common_info">
                            @foreach($news as $n)
                                <div class="press_slider_common_box">
                                    <h6>{{ $n->sub_title }}</h6>
                                    <h5><a href="/blog/{{$n->post_name}}" target="_blank">{{$n->post_title}}</a></h5>
                                    <span>{{ date('m-d-Y',strtotime($n->post_date)) }}</span>
                                    <p>{!! strlen($n->post_content)>200?substr(strip_tags($n->post_content),0,200).'...':strip_tags($n->post_content) !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 press_right">
                    <div class="press_address press_right_box">
                        <h3 class="press_right_head">Address</h3>
                        <p class="press_right_text">14-J Laurel Hill Rd,
                            Greenbelt, Maryland 20770
                            Ph: 202-670-4523</p>
                    </div>
                    <div class="press_contact press_right_box">
                        <h3 class="press_right_head">MEDIA CONTACT</h3>
                        <p class="press_right_text"><span>Contact:</span>Attia Nasar</p>
                        <p class="press_right_text"><span>Email:</span><a href="#">salaam@muzbnb.com</a></p>
                        <ul>
                            <li><a href="https://facebook.com/muzbnb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="//twitter.com/muzbnb" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="//www.instagram.com/muzbnb" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCjqG9DHZD4AeFTJA2l-kJTA" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.linkedin.com/company-beta/10997844/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="press_download press_right_box">
                        <h3 class="press_right_head">downloads</h3>
                        <div class="press_download_info press_download_logo">
                            <h4>logo</h4>
                            <div class="press_logo_img press_download_img">
                                <a href="{{url('assets') }}/Muzbnb-Logo.zip"><img src="{{url('')}}/style/assets/img/Muzbnb Logo.png"></a>
                            </div>
                        </div>
                        <div class="press_download_info press_download_info_founder">
                            <h4>founders</h4>
                            <div class="press_download_img">
                                <a href="{{url('assets') }}/Founders.zip" target="_blank"><img src="{{url('')}}/style/assets/img/Founders.png" class="img-responsive" style="margin-bottom: 10px;"></a>
                            </div>
                        </div>
                        {{--<div class="press_download_info press_download_info_video">--}}
                            {{--<h4>promo video</h4>--}}
                            {{--<div class="press_download_img">--}}
                                {{--<iframe width="560" height="315" src="https://www.youtube.com/embed/vKjpgUAhaQ4" frameborder="0" allowfullscreen></iframe>--}}
                                {{--<iframe src="https://player.vimeo.com/video/183586043?color=1d7899&title=0&byline=0&portrait=0"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

    /* --- press_silder --- */
    $('.press_slider_common_info').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000000,
        dots: true,
        responsive: [
            {
                breakpoint: 580,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
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