
redrawMap = {
    'redraw': function (lists) {
        try {
            $('#map_div').html('');
            var markers = [];
            var lat = $("#formLat").val(), lng = $("#formLng").val();
            var zoom = 4;
            var mapDiv = document.getElementById('map_div');
            var marker, i;
            markers = [];
            var path = "{{ asset('images/listings/') }}";

            if(lat == '' && lng == '' || lat == undefined && lng == undefined) {
                lat = 0, lng = 0, zoom = 0;
            }
            if(window.allListings == 1) {
                map = new google.maps.Map(mapDiv, {
                    zoom: zoom,
                    center: {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    }
                });
            } else {
                map = new google.maps.Map(mapDiv, {
                    zoom: zoom,
                });
            }

            var infowindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            markers.forEach(function(marker) {
                marker.setMap(null);
            });

            for(i = 0; i < lists.length; i++) {
                if(lists[i].lat != '' && lists[i].lng != '' || lists[i].lat != undefined && lists[i].lng != undefined) {
                    var ltln = new google.maps.LatLng(lists[i].lat,lists[i].lng);
                    overlay = new CustomMarker(ltln,map,{marker_id: i},lists[i],path);
                    var center = new google.maps.LatLng(parseFloat(lists[i].lat), parseFloat(lists[i].lng));
                    if(window.allListings == 0) {
                        marker = new google.maps.Marker({
                            animation: google.maps.Animation.DROP,
                            position: center
                        });
                        markers.push(marker);
                        latlngbounds.extend(center);
                    }
                }
                if(window.allListings == 1 && window.listingFilter == 1) {
                    latlngbounds.extend(center);
                }
            }
            if(window.allListings == 0) {
                map.fitBounds(latlngbounds);
                var zoomLvl = map.getZoom();
            }
            if(window.allListings == 1 && window.listingFilter == 1) {
                map.fitBounds(latlngbounds);
            }

        } catch (err) {
            console.log(err);
        }
    },
    'siteUrl': '',
    'formatDate': function (date){
        var local = new Date(date);
        local.setMinutes(date.getMinutes() - date.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    }
};

customFunctions = {
    'filterSearch': function (e) {
        if(e && e != null){
            e.preventDefault();
        }
        window.listingFilter = 1;
        var date1 = $('#check_in_date').val().replace(new RegExp('/', 'g'), '-');
        var date2 = $('#check_out_date').val().replace(new RegExp('/', 'g'), '-');
        if(date1 == '') {
            var date1 = redrawMap.formatDate(new Date());
        }
        if(date2 == '') {
            date2 = redrawMap.formatDate(new Date());
        }
        var d1 = new Date(date1);
        var d2 = new Date(date2);
        var d1F = redrawMap.formatDate(d1);
        var d2F = redrawMap.formatDate(d2);
        // var d1 = date1 != '' || date1 != null ? new Date(date1) : new Date();
        // var d2 = date2 != '' || date2 != null ? new Date(date2) : new Date();
        // //var d1 = new Date(date1);
        // // var d2 = new Date(date2);
        // var d1Formated = $.datepicker.formatDate("yy-mm-dd", d1);
        // var d2Formated = $.datepicker.formatDate("yy-mm-dd", d2);

        var check_in_date = d1F;
        var check_out_date = d2F;
        // var date1 = $('#check_in_date').val().replace(new RegExp('/', 'g'), '-');
        // var date2 = $('#check_out_date').val().replace(new RegExp('/', 'g'), '-');
        // var d1 = new Date(date1);
        // var d2 = new Date(date2);
        // var d1Formated = $.datepicker.formatDate("yy-mm-dd", d1);
        // var d2Formated = $.datepicker.formatDate("yy-mm-dd", d2);
        //
        // console.log(d1Formated);
        // console.log(d2Formated);
        //
        // var check_in_date = d1Formated;
        // var check_out_date = d2Formated;
        var no_of_guest = $('#guests').val();
        var room_type = $('#apt').is(':checked') ? $('#apt').val() : $('#private').is(':checked') ? $('#private').val() : $('#room').is(':checked') ? $('#room').val() : 0;
        var range = document.getElementById('rangeSlider');;
        // var rangeArr = range.split(';');
        var rangeArr = range.noUiSlider.get();
        var price_min = parseInt(rangeArr[0]);
        var price_max = parseInt(rangeArr[1]);
        var no_of_bedroom = $('#no_of_bedroom').val();
        var no_of_bath = $('#no_of_bath').val();
        var no_of_bed = $('#no_of_bed').val();
        var amenities = new Array();
        $('.amenities').map(function (val, key){
            if($(this).is(':checked')){
                // console.log($(this).val());
                amenities.push($(this).val());
            }
        });
        var properties = new Array();
        $('.property_types').map(function (val, key){
            if($(this).is(':checked')){
                properties.push($(this).val());
            }
        });

       var param = 'check_in_date='+check_in_date+'&check_out_date='+check_out_date+'&no_of_guest='+no_of_guest+'&room_type='+room_type+'&price_min='+price_min+'&price_max='+price_max+'&no_of_bedroom='+no_of_bedroom+'&no_of_bath='+no_of_bath+'&no_of_bed='+no_of_bed+'&amenities='+amenities+'&properties='+properties+'';
//            console.log(param);
        var data = {
            'check_in_date': check_in_date,
            'check_out_date': check_out_date,
            'no_of_guest': no_of_guest,
            'room_type': room_type,
            'price_min': price_min,
            'price_max': price_max,
            'no_of_bedroom': no_of_bedroom,
            'no_of_bath': no_of_bath,
            'no_of_bed': no_of_bed,
            'amenities': amenities,
            'properties': properties,
            '_token': '{{ csrf_token() }}'
        };
        loading();

        var currentUrl1 = window.location.href.split('?')[0];
        currentUrl2 = currentUrl1 + '?' + param;
        window.location.href = currentUrl2;
    },
    'redrawMap': function (lists) {
        try {
            $('#map_div').html('');
            var markers = [];
            var lat = $("#formLat").val(), lng = $("#formLng").val();
            var zoom = 4;
            var mapDiv = document.getElementById('map_div');
            var marker, i;
            markers = [];
            var path = redrawMap.siteUrl;

            if(lat == '' && lng == '' || lat == undefined && lng == undefined) {
                lat = 0, lng = 0, zoom = 0;
            }
            if(window.allListings == 1) {
                map = new google.maps.Map(mapDiv, {
                    zoom: zoom,
                    center: {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    }
                });
            } else {
                map = new google.maps.Map(mapDiv, {
                    zoom: zoom,
                });
            }

            var infowindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            markers.forEach(function(marker) {
                marker.setMap(null);
            });

            for(i = 0; i < lists.length; i++) {
                if(lists[i].lat != '' && lists[i].lng != '' || lists[i].lat != undefined && lists[i].lng != undefined) {
                    var ltln = new google.maps.LatLng(lists[i].lat,lists[i].lng);
                    overlay = new CustomMarker(ltln,map,{marker_id: i},lists[i],path);
                    var center = new google.maps.LatLng(parseFloat(lists[i].lat), parseFloat(lists[i].lng));
                    if(window.allListings == 0) {
                        marker = new google.maps.Marker({
                            animation: google.maps.Animation.DROP,
                            position: center
                        });
                        markers.push(marker);
                        latlngbounds.extend(center);
                    }
                }
                if(window.allListings == 1 && window.listingFilter == 1) {
                    latlngbounds.extend(center);
                }
            }
            if(window.allListings == 0) {
                map.fitBounds(latlngbounds);
                var zoomLvl = map.getZoom();
            }
            if(window.allListings == 1 && window.listingFilter == 1) {
                map.fitBounds(latlngbounds);
            }

        } catch (err) {
            console.log(err);
        }
    },
    'findLocation': function (results) {
        for(var j=0; j<results.length; j++) {
            var city, country, region;
            if (results[j].types[0] == "locality" || results[j].types[0] == "sublocality_level_1") {
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
};