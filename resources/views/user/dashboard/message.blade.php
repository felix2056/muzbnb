@extends('user.dashboard.layout')
@section('title', 'Messages')

@section('style-top')
    <style>
        .user-content {
            padding: 80px 0px !important;
        }
    </style>
@endsection

@section('tabcontent')
<div class="container-fluid box-width messages" id="app">
<messages selected="{{ $profile->selectedConversation }}" />
</div>
@endsection

@section('scripts')
    <script>
        USER_HASH = '{{ $hash }}'
        USER_NAME = '{{ $username }}'
        USER_ID = '{{ auth()->id() }}'
        USER_IMG = '{{ auth()->user()->photo('a') }}'
    </script>
    <script type="text/javascript" src="{{mix('js/dashboard.js')}}" rel="stylesheet"></script>
    <script type="text/javascript" src="{{mix('js/app.js')}}" rel="stylesheet"></script>
    <script type="text/javascript" src="{{mix('js/chat.js')}}" rel="stylesheet"></script>
    <script type="text/javascript">
        $(".switch input").click(function(){
            $(".notification-btn ul li").toggleClass("active");
        });

        var classes = {
            2 : 'orange',
            4 : 'blue',
            5 : 'orange'
        };
        $('#multi').picker({search : true,coloring: classes});

        $(".add-vat").click(function(){
            $('#vat_number').removeClass('hidden');
            $('.add-vat').addClass('hidden');
        });
        $(".add-home").click(function(){
            $('#address').removeClass('hidden');
            $('.add-home').addClass('hidden');
        });
        $(".add-zip").click(function(){
            $('#zip_code').removeClass('hidden');
            $('.add-zip').addClass('hidden');
        });
        $(".add-language").click(function(){
            $('.picker').css({
                'display': 'inline-block',
            });
            $('.add-language').addClass('hidden');
        });
        $(".sub-menu-toggle").click(function(){
            $('.chat_sidebar').toggleClass('hidden-xs');
        });
        $(".member-list li").click(function(){
            $('.message_section').removeClass('hidden-xs');
            $('.chat_sidebar').addClass('hidden-xs');
        });

    </script>
    <script>
        (function($){
            $(window).on("load",function(){
                $(".message_section, .chat_sidebar").mCustomScrollbar({
                    mouseWheelPixels: 1000
                });
                $(".message_section").mCustomScrollbar("scrollTo", "bottom");
            });
        })(jQuery);
        scrollToBottom = function () {
            $(".message_section").mCustomScrollbar("update");
            setTimeout(function(){
                $(".message_section").mCustomScrollbar("scrollTo", "bottom");
            }, 0);
        }
    </script>
@endsection
