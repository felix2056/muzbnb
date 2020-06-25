<script type="text/javascript" src="{{mix('js/all.js')}}" rel="stylesheet"></script>

<div class="muz-loading"><img src="{{ url('') }}/images/ajax_loader.gif" /> </div>
<script>
    function loading() {
        $(".muz-loading").show();
    }
    function loaded() {
        $(".muz-loading").hide();
    }
//    $(function() {
//        // Animate loader off screen
//        loading();
//    });
</script>

<script>
    window.queryvaluechange2 = '';

    //For secondary search
    var fields = {
        street_number: 'search_address1',
        route: 'search_address2',
        locality: 'search_city',
        administrative_area_level_1: 'search_state',
        country: 'search_country',
        postal_code: 'search_zip_code'
    };

    //For secondary search
    var fields2 = {
        street_number: 'search_address12',
        route: 'search_address22',
        locality: 'search_city2',
        administrative_area_level_1: 'search_state2',
        country: 'search_country2',
        postal_code: 'search_zip_code2'
    };
    var loc =null;

    // Main Search Bar
    function initAutocomplete(flag = false) {
        window.urlFlag = undefined;
        check = "{{ Route::currentRouteName() == 'search' || Route::currentRouteName() == 'searchListingsFilter' || Route::currentRouteName() == 'searchListings' }}";
        if(check && check!=0) {
            var t = document.createElement("script");
            t.type = "text/javascript";
            var str = Math.random().toString(36).substring(7);
            t.src = "{{ asset('js/CustomGoogleMapMarker.js?') }}r="+str;
            $("head").append(t);
            window.listingFilter = 0;
        }

        var input = document.getElementById("userInput");
        if(flag && input.value == ''){
            window.urlFlag = 'none';
            location.href = '/search';
            return false;
        }
        var autocomplete = new google.maps.places.Autocomplete(input);
        try {
            autocomplete.addListener('place_changed', function(e) {
                try {
                    var place = autocomplete.getPlace();
                    if (!place.geometry) {
                        //input.value = '';
                        window.urlFlag == 'error';
                        return false;
                        $("#lat").val(0);
                        $("#lng").val(0);
                        for(var key in fields) {
                            document.getElementById(fields[key]).value = '';
                        }
                        return true;
                    }
                    $("#lat").val(place.geometry.location.lat());
                    $("#lng").val(place.geometry.location.lng());
                    var lati = place.geometry.location.lat();
                    var longi = place.geometry.location.lng();

                    var url = '/search/';
                    var area = findLocation(place.address_components);
                    if(area.country != '') {
                        var country = area.country.long_name;
                        url = url + '' + country + '/';
                    } else {
                        url = url + '/';
                    }
                    if(area.region != '') {
                        var state = area.region.short_name;
                        url = url + '' + state + '/';
                    } else {
                        url = url + '/';
                    }
                    if(area.city != '') {
                        var city = area.city.long_name;
                        url = url + '' + city + '';
                    } else {
                        url = url + '';
                    }
                    if(area.latlng && area.city != ''){
                        url = url + '/' + lati + '/' + longi;
                    }
                    window.urlFlag = url;
                    location.href = url;
                    throw new Error("Please Select Location from Autocomplete!");
                } catch (error) {
                    window.urlFlag = 'error';
                }
            });
        } catch (acErr) {
            window.urlFlag = 'error';
        }
        window.autocomplete = autocomplete;
        if(check && check !=0) {
            redrawMap.siteUrl = '{{ asset("images/listings/") }}';
            setTimeout(function (){
                customFunctions.redrawMap(mapListings);
            }, 500);
        }
    }

    // Secondary Search Bar
    function initAutocomplete2() {
        var input2 = document.getElementById("userInput2");
        var autocomplete2 = new google.maps.places.Autocomplete(input2);
        try {
            autocomplete2.addListener('place_changed', function() {
                try {
                    var place2 = autocomplete2.getPlace();
                    if (!place2.geometry) {
                        input2.value = '';
                        return false;
                        $("#lat2").val(0);
                        $("#lng2").val(0);
                        for(var key in fields2) {
                            document.getElementById(fields2[key]).value = '';
                        }
                        return true;
                    }
                    $("#lat2").val(place2.geometry.location.lat());
                    $("#lng2").val(place2.geometry.location.lng());
                    var lati = place2.geometry.location.lat();
                    var longi = place2.geometry.location.lng();

                    var url = '/search/';
                    var area = findLocation(place2.address_components);
                    if(area.country != '') {
                        var country = area.country.long_name;
                        url = url + '' + country + '/';
                    } else {
                        url = url + '/';
                    }
                    if(area.region != '') {
                        var state = area.region.short_name;
                        url = url + '' + state + '/';
                    } else {
                        url = url + '/';
                    }
                    if(area.city != '') {
                        var city = area.city.long_name;
                        url = url + '' + city + '';
                    } else {
                        url = url + '';
                    }
                    if(area.latlng && area.city != ''){
                        url = url + '/' + lati + '/' + longi;
                    }
                    window.url = url;
                } catch (er) {
                    window.url = '';
                }
            });
        } catch (e) {
            window.url = '';
        }

        window.autocomplete = autocomplete2;
        window.autocomplete2 = autocomplete2;
    }

    // Location finder function
    function findLocation (results) {
        for(var j=0; j<results.length; j++) {
            var city, country, region;
            if (results[j].types[0] == "locality") {
                city = results[j];
            }
            if (results[j].types[0] == "sublocality_level_1") {
                city = results[j];
            }

            if (results[j].types[0] == "administrative_area_level_1") {
                region = results[j];
            }
            if (results[j].types[0] == "country") {
                country = results[j];
            }
            if (results[j].types[0] == "colloquial_area") {
                country = results[j];
            }
        }
        if (results.length > 4) {
            return {
                'country': country != undefined ? country : '',
                'city': city != undefined ? city : '',
                'region': region != undefined ? region : '',
                'latlng': true
            };
        } else {
            return {
                'country': country != undefined ? country : '',
                'city': city != undefined ? city : '',
                'region': region != undefined ? region : '',
                'latlng': false
            };
        }
    }

    // Refresh Search for Secondary Search Bar
    function refreshSearch2() {
        google.maps.event.trigger(autocomplete2, 'place_changed');
    };

    $(document).ready(function () {
        initAutocomplete2();
    });

    // Submit Function for Secondary Search Bar
    $('#select_go').click(function (e) {
        e.preventDefault();
        var userInput2 = queryvaluechange2;
        var ng = $('#guests').val();
        var ci = $('#check_in_date').val();
        var co = $('#check_out_date').val();
        var checkStart = new Date(ci);
        var checkEnd = new Date(co);
        if(checkEnd < checkStart){
            $('#errText').html('Checkin date must be smaller than Checkout date!');
            $('#dateErrorRow').show();
        } else {
            $('#dateErrorRow').hide();
            google.maps.event.trigger(autocomplete2, 'place_changed');
            if(window.url && window.url != ''){
                var url = window.url;
                url = url + '?no_of_guest=' + ng + '&check_in_date=' + ci + '&check_out_date=' + co;
                location.href = url;
            } else {
                $('#errText').html('');
                $('#errText').html('Please select location from autocomplete!');
                $('#dateErrorRow').show();
                return false;
            }
        }
    });

    // Submit Function for Main Search Bar
    $('#search-form').submit(function (e) {
        var textVal = $('#userInput').val();
        e.preventDefault();
        window.urlFlag = undefined;
        google.maps.event.trigger(autocomplete, 'place_changed');
        if(typeof window.urlFlag  !== undefined){
            if(window.urlFlag == 'error' || window.urlFlag == 'none') {
                setTimeout(function () {
                    toastr.error('Please Select Location from Autocomplete!', 'Sorry!');
                }, 1500);
                $('#userInput').val('');
            }
        }
        if(textVal == '') {
            location.href = '/search';
        } else {
            setTimeout(function () {
                toastr.error('Please Select Location from Autocomplete!', 'Sorry!');
            }, 500);
        }
    });

</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDnidFdoimGzPA4JEJuYLVJKtFRVaHJ-A&libraries=drawing,places&language=En"  rel="stylesheet"></script>
<script>
    var t = document.createElement("script");
    t.type = "text/javascript";
    var str = Math.random().toString(36).substring(7);
    t.src = "{{ asset('js/customFunctions.js?r=') }}"+str;
    $("head").append(t);

    initAutocomplete();
</script>

@yield('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet"/>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>--}}
<script src="/js/bootstrap-datepicker.min.js"></script>
<script>
    setTimeout(function () {
        $(".myDate").datepicker({
            startDate: new Date()
        });
    }, 100);
</script>
@if(Auth::user())
    <script type="text/javascript" src="/js/notifications.js" rel="stylesheet"></script>
@else
    @include('partials._login')
@endif

<script>
    window.notifications = [];
    !function () {
        var t;
        if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void (window.console && console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0,
            t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on"],
            t.factory = function (e) {
                return function () {
                    var n;
                    return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
                };
            }, t.methods.forEach(function (e) {
            t[e] = t.factory(e);
        }), t.load = function (t) {
            var e, n, o, i;
            e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"),
                o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + i + "/" + t + ".js",
                n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
        });
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('4k9ezdxd9sxf');
    drift.on('ready', function (api, payload) {
        $(".support-btn").click(function (e) {
            e.preventDefault();
            api.sidebar.open();
            return false;
        });
    });
</script>

@if(session('successNotice'))
    <script>
        toastr.success('{{session('successNotice')}}', 'Congratulations!');
    </script>
    <?php session()->forget('successNotice'); ?>
@endif
@if(session('errorNotice'))
    <script>
        toastr.error('{{session('errorNotice')}}', 'Sorry!');
    </script>
    <?php session()->forget('errorNotice'); ?>
@endif
<script>
    function scrollNav() {
        $('.smooth-scroll a').click(function(){
            //Toggle Class
            $(".active").removeClass("active");
            $(this).closest('li').addClass("active");
            var theClass = $(this).attr("class");
            $('.'+theClass).parent('li').addClass('active');
            //Animate
            $('html, body').stop().animate({
                scrollTop: $( $(this).attr('href') ).offset().top - 160
            }, 400);
            return false;
        });
        $('.scrollTop a').scrollTop();
    }
    scrollNav();

    $('#mobile-menu-show').click(function(){
        $('#mobile-menu-display').toggle();
    });


</script>
<script>
    $('document').ready(function() {
        $('.dropdown-arrow').click(function(){
            $('.dropdown-menu').toggle();
        });

        $('#userInput2').keypress(function(e) {
            if (e.which == 13) {
                if($(this).val() == ''){
                }
                return false;
            }
        });
    });
</script>

@yield('page_script')

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89131258-1', 'auto');
    ga('send', 'pageview');

</script>

<script>
    //checkout page read more fucntion
    $(document).ready(function() {
        // Configure/customize these variables.
        var showChar = 200;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = "+ See all House Rules";
        var lesstext = "- Hide House Rules";

        $('.more').each(function() {
            var content = $(this).html();

            if(content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });
</script>

<script>
    $(function () {

        var body = document.body;
        var html = document.documentElement;

        var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
        height = parseInt(height)/2 - parseInt(height)/4;

        $(window).scroll(function () {
            if ($(this).scrollTop() > height) {
                $('.myScrollToTopBtn').fadeIn();
            } else {
                $('.myScrollToTopBtn').fadeOut();
            }
        });

        $('.myScrollToTopBtn').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
</script>

<button id="myScrollToTopBtn" title="Go to top" class="myScrollToTopBtn">
    <img src="{{ asset('images/arrow_up.png') }}" alt="">
</button>

<script type="text/javascript">
    window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '1385eae1eec24d5786709747c8ab1688cd365f2f');
</script>
<script type="text/javascript" src="https://my.hellobar.com/ce7269aa5da66bd17b0763ec83c3d58d0559fb93.js"></script>

@if(Route::currentRouteName() == 'search' || Route::currentRouteName() == 'searchListingsFilter' || Route::currentRouteName() == 'searchListings' )
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="{{ asset('js/range_slider_custom.js') }}"></script>
    <script src="{{ asset('js/wNumb.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.6.1/lodash.min.js"></script>

    <script>
        jQuery(function() {
            jQuery( "#slider_range" ).flatslider({
                min: 1, max: 1000,
                step: 1,
                values: [1, 1000],
                range: true,
                einheit: '$',
                change: function (e) {
                    customFunctions.filterSearch(e);
                }
            });
        });

        setTimeout(function (){
            $('.datepicker').datepicker()
                .on('changeDate', function(e) {
                    customFunctions.filterSearch(e);
                });
        },100);
    </script>
@endif

<script type="text/javascript" src="{{mix('js/app.js')}}" rel="stylesheet"></script>

</body>
</html>