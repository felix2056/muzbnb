@extends('layouts.master')
@section('title', $post->post_title . ' | Blog')
@section('meta-box')
<meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $post->post_title }} | Blog" />
    <meta property="og:image" content="{{ blog_img($img, 'large') }}" />
    <meta property="og:site_name" content="Muzbnb" />
    <meta property="og:description" content="{{str_limit(strip_tags($post->post_content), 130)}}" />
@endsection

@section('content')
    <section class="page-cotnent">
        <div class="blog-head" style="background-image: url({{ blog_img($img, 'large') }})" >
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="blog-caption">
                            <h1>{{ $post->post_title }}</h1>
                            <span>by {{ $post->author->display_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="post-content">
                            <div class="social-meta">
                                <span>Share:</span>
                                <ul>
                                    <li>
                                        {{--<iframe src="https://www.facebook.com/plugins/like.php?href={{ Request::url() }}&width=95&layout=button_count&action=like&size=large&show_faces=false&share=false&height=21&appId" width="95" height="40" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>--}}
                                        <iframe src="https://www.facebook.com/plugins/share_button.php?href={{ Request::url() }}%2F&layout=button_count&size=large&mobile_iframe=false&width=105&height=28&appId" width="95" height="40" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </li>
                                    <li><a href="https://twitcount.com/btn" class="twitcount-button" data-count="horizontal" data-size="large" data-text="" data-url="" data-via="" data-related="" data-hashtags="">TwitCount</a> <script type="text/javascript" src="https://static1.twitcount.com/js/button.js"></script></li>
                                    <li>
                                        <g:plus action="share" style="height: 30px;"></g:plus>

                                        <script>
                                            window.___gcfg = {
                                                lang: 'en-US',
                                                parsetags: 'onload'
                                            };
                                        </script>
                                        <script src="https://apis.google.com/js/platform.js" async defer></script>

                                    </li>
                                    <li>
                                        <a data-pin-do="buttonPin" data-pin-count="beside" data-pin-tall="true" data-pin-save="true" href="https://www.pinterest.com/pin/create/button/?url={{ Request::url() }}"></a>
                                        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
                                    </li>
                                </ul>
                            </div>
                            <div class="post-meta">
                                @if($post->author->picPost)
                                <div class="post-meta-img">
                                    <img class="img-circle" src="{{ blog_img($post->author->picPost->image()) }}" alt="user" />
                                </div>
                                @endif
                                <div class="post-meta-content">
                                    <h4>{{ $post->author->display_name }}</h4>
                                    <span>{{ date('m-d-Y', strtotime($post->post_date_gmt)) }}</span>
                                    <a href="javascript:;" class="tag">Muslim Travel</a>
                                    <div class="clearfix"></div>
                                    <a href="javascript:;" class="comments">share your thoughts</a>
                                </div>
                            </div>
                            <ul class="post-bredcrumn">
                                @foreach($post->categories() as $category)
                                <li><a href="javascript:;">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            <div class="post-description">
                                <h1>{{ $post->post_title }}</h1>
                                {!! $post->post_content !!}
                            </div>
                            <ul class="social-list">
                                <li><a class="s-fb share-now" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-tw share-now" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-gp share-now" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-pt share-now" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a class="s-ln share-now" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-tm share-now" href="#"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div>
                        <div class="post-author">
                            <h2 class="bordered-title"><b>about</b> the author</h2>
                            @if($post->author->picPost)
                            <div class="author-img">
                                <img class="img-circle" src="{{ blog_img($post->author->picPost->image()) }}" alt="user" />
                            </div>
                            @endif
                            <div class="author-detail">
                                <h4>{{ $post->author->display_name }}</h4>
                                <span>{{ $post->author->meta('title') }}</span>
                                <p>{{ $post->author->meta('description') }}</p>
                                <ul>
                                    @if($post->author->meta('twitter') != '')
                                        <li><a href="//{{ $post->author->meta('twitter') }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if($post->author->meta('facebook') != '')
                                        <li><a href="//{{  $post->author->meta('facebook') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if($post->author->meta('instagram') != '')
                                        <li><a href="//{{ $post->author->meta('instagram') }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                    @endif
                                    @if($post->author->meta('youtube') != '')
                                        <li><a href="//{{ $post->author->meta('youtube') }}" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                                    @endif
                                    @if($post->author->meta('linkedin') != '')
                                        <li><a href="//{{ $post->author->meta('linkedin') }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="article-list">
                            <h2 class="bordered-title"><b>recommended</b> articles</h2>
                            <ul>
                                @foreach($post->relatedArticles() as $article)
                                <li>
                                    <img src="{{ blog_img($article->image) }}" style="height: 150px;" alt="" />
                                    <a href="/blog/{{$article->post_name}}"><h3>{{ $article->post_title }}</h3></a>
                                    <p>{{str_limit(strip_tags($post->post_content), 82)}}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        {{--<div class="comment-box">
                            <h2 class="bordered-title"><b>leave a</b> comment</h2>
                            <p>Your email address will not be published. Required Fields are marked with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="require"><input class="form-control" type="text" name="Name" placeholder="Name" /></span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="require"><input class="form-control" type="email" name="email" placeholder="Email" /></span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="require"><textarea class="form-control" name="comments" placeholder="your comment"></textarea></span>
                                </div>
                            </div>
                            <button type="submit" class="red-button">Submit</button>
                        </div>--}}
                    </div>
                    <aside class="col-md-4 content-sidebar">
                        <div class="widget widget-post-list">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#Popular" aria-controls="Popular" role="tab" data-toggle="tab">Popular</a></li>
                                <li><a href="#Recent" aria-controls="Recent" role="tab" data-toggle="tab">Recent</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="Popular">
                                    <ul class="post-list-wrap">
                                        {{--@foreach($popularArticles as $article)--}}
                                        {{--<li>--}}
                                            {{--<div class="post-list-img">--}}
                                                {{--<a href="javascript:;"><img class="img-circle" src="{{ blog_img($article->image, 'small') }}" alt="" /></a>--}}
                                            {{--</div>--}}
                                            {{--<div class="post-list-content">--}}
                                                {{--<h2><a href="/blog/{{$article->post_name}}">{{ $article->post_title }}</a></h2>--}}
                                                {{--<span>{{ date('m-d-Y', strtotime($article->post_date_gmt)) }}</span>--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{--@endforeach--}}
                                        <?php $i=0; ?>
                                        @for($i=0;$i<count($popularArticles);$i++)
                                        <li>
                                            <div class="post-list-img">
                                                <a href="javascript:;"><img class="img-circle" src="{{ blog_img($popularArticles[$i]->image(), 'small') }}" alt="" /></a>
                                            </div>
                                            <div class="post-list-content">
                                                <h2><a href="/blog/{{$popularArticles[$i]->post_name}}">{{ $popularArticles[$i]->post_title }}</a></h2>
                                                <span>{{ date('m-d-Y', strtotime($popularArticles[$i]->post_date_gmt)) }}</span>
                                            </div>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="Recent">
                                    <ul class="post-list-wrap">
                                        @foreach($recentArticles as $article)
                                        <li>
                                            <div class="post-list-img">
                                                <a href="javascript:;"><img class="img-circle" src="{{ blog_img($article->image, 'small') }}" alt="" /></a>
                                            </div>
                                            <div class="post-list-content">
                                                <h2><a href="/blog/{{$article->post_name}}">{{ $article->post_title }}</a></h2>
                                                <span>{{ date('m-d-Y', strtotime($article->post_date_gmt)) }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-author-list">
                            <h2 class="bordered-title"><b>BLOG</b> AUTHOR LIST</h2>
                            <ul>
                                @foreach($authors as $author)
                                <li>
                                    @if($author->picPost)
                                    <div class="author-img">
                                        <a href="javascript:;"><img class="img-circle" src="{{ blog_img($author->picPost->image()) }}" alt="" /></a>
                                    </div>
                                    @endif
                                    <div class="author-content">
                                        <h4><a href="javascript:;">{{ $author->display_name }}</a></h4>
                                        <span>{{ $author->meta('title') }}</span>
                                        <ul>
                                            @if($author->meta('twitter') != '')
                                                <li><a href="//{{ $author->meta('twitter') }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            @endif
                                            @if($author->meta('facebook') != '')
                                                <li><a href="//{{ $author->meta('facebook') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            @endif
                                            @if($author->meta('instagram') != '')
                                                <li><a href="//{{ $author->meta('instagram') }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        $(".share-now").click(function (e) {
            e.preventDefault();
            if($(this).hasClass('s-fb')) {
                window.open(
                    'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),
                    'share-dialog',
                    'width=626,height=436');
            } else if($(this).hasClass('s-tw')) {
                window.open(
                    'https://twitter.com/home?status='+encodeURIComponent(location.href),
                    'share-dialog',
                    'width=626,height=436');
            } else if($(this).hasClass('s-gp')) {
                window.open(
                    'https://plus.google.com/share?url='+encodeURIComponent(location.href),
                    'share-dialog',
                    'width=626,height=436');
            } else if($(this).hasClass('s-pt')) {
                window.open(
                    'https://pinterest.com/pin/create/button/?url='+encodeURIComponent(location.href)+ '&media=' +
                    encodeURIComponent($(".blog-head").attr('style').replace("background-image: url(", '').replace(')', ''))
                    +'&description=',
                    'share-dialog',
                    'width=626,height=436');
            } else if($(this).hasClass('s-ln')) {
                window.open(
                    'https://www.linkedin.com/shareArticle?mini=true&url=='+encodeURIComponent(location.href)+ '&title=' + encodeURIComponent('{{ $post->post_title }}')
                    + '&source=' + encodeURIComponent(location.href)
                    +'&summary=',
                    'share-dialog',
                    'width=626,height=436');
            } else if($(this).hasClass('s-tm')) {
                window.open(
                    'https://www.tumblr.com/share/link?url=='+encodeURIComponent(location.href),
                    'share-dialog',
                    'width=626,height=436');
            }
        })
        $(document).on('click', '.open-signup-social', function(){
            $("#signup-social").modal('hide');
            setTimeout(function(){
                $("#signup-social").modal('show');
            }, 500);
        });
    </script>
@endsection