@extends('layouts.raw')

@section('rawContent')
    @yield('content')

    @if(\Route::currentRouteName() != 'congrats')

    <div class="muzbnb-content-block ff footer-apps-wrap">
        <div class="container">
            <div class="row">
                <div class=" col-md-12 col-sm-12 col-xs-12">
                    <div class="section-title text-center ">
                        <h1>Coming soon to IOS, Android &amp; Windows</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-apps">
                        <ul>
                            <li><a href=""><img src="<?= url('/') ?>/style/assets/img/apple-icon.svg" alt=""> <span
                                            class="appimgtext">App Store</span></a></li>
                            <li><a href=""><img src="<?=url('/')?>/style/assets/img/googleplay-icon.svg" alt="" class="google-play"> <span
                                            class="appimgtext google">Google play</span></a></li>
                            <li><a href=""><img src="<?=url('/')?>/style/assets/img/windows-icon.png" alt=""> <span
                                            class="appimgtext">Windows</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="muzbnb-content-block socio footer-social-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-social">
                        <ul>
                            <li><a href="https://facebook.com/muzbnb" target="_blank"><img
                                            src="<?=url('/')?>/style/assets/img/facebook.svg" alt="Facebook">Facebook</a>
                            </li>
                            <li><a href="https://twitter.com/muzbnb" target="_blank"><img
                                            src="<?=url('/')?>/style/assets/img/twitter.svg" alt="Twitter">Twitter</a></li>
                            <li><a href="https://www.instagram.com/muzbnb" target="_blank"><img
                                            src="<?=url('/')?>/style/assets/img/instagram.svg" alt="Instagram">Instagram</a>
                            </li>
                            <li><a href="https://www.youtube.com/channel/UCjqG9DHZD4AeFTJA2l-kJTA" target="_blank"><img
                                            src="<?=url('/')?>/style/assets/img/youtube.svg" alt="Youtube">Youtube</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3 col-xs-12">
                        <div class="footer-wid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="footer-wid-select">
                                        <select name="" id="">
                                            <option>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="footer-wid-select">
                                        <select name="" id="">
                                            <option>USD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <div class="footer-wid">
                            <h3 class="footer-wid-title">MUZBNB</h3>
                            <ul>
                                <li><a href="<?=route('about')?>">About</a></li>
                                <li><a href="<?=route('blog')?>">Blog</a></li>
                                <li><a href="<?=route('press')?>">Press</a></li>
                                <li><a href="<?=route('ambassadors')?>">Ambassadors</a></li>
                                {{--<li><a href="">Events</a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <div class="footer-wid">
                            <h3 class="footer-wid-title">DISCOVER</h3>
                            <ul>
                                <li><a href="<?=route('become-a-host')?>">Become a Host</a></li>
                                <li><a href="javascript:;" class="signup-btn">Sign Up</a></li>
                                <?php /* <li><a href="">City Guides</a></li> */ ?> 

                               <li><a href="{{ route('invite') }}">Invite</a></li>

                                <?php /* <li><a href="">How It Works</a></li> */ ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <div class="footer-wid">
                            <h3 class="footer-wid-title">HELP CENTER</h3>
                            <ul>
                               
                                <li><a href="mailto:salaam@muzbnb.com">Contact</a></li>

                                <li><a href="/terms-of-services">Terms of Service</a></li>
                                <li><a href="<?=route('standards')?>">Our Standards</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area  text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 footertext">
                        <a>Copyright © 2017 Muzbnb. All rights reserved.</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @endif
    <!-- /footer -->
@endsection
@section('scripts')
<script>
    $(document).on('click', '.open-signup-social', function(){
        $("#signup-social").modal('hide');
        setTimeout(function(){
            $("#signup-social").modal('show');
        }, 500);
    });

    function stopVideo(){
        var $frame = $('iframe');

        // saves the current iframe source
        var vidsrc = $frame.attr('src');

        // sets the source to nothing, stopping the video
        $frame.attr('src','');

        // sets it back to the correct link so that it reloads immediately on the next window open
        $frame.attr('src', vidsrc);
    }


</script>

@endsection
