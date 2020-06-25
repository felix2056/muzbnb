@extends('layouts.master')

@section('style-top')
    <style type="text/css">
        .markerDiv {
            width: 50px;
            transform: translateZ(0px);
            position: absolute;
            visibility: visible;
            cursor: default;
        }
        .marker:after{
            content: "";
            left: 50%;
            width: 0px;
            height: 0px;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 7px solid #f00;
            margin-left: -7px;
            position: absolute;
            bottom: -7px;
        }
        .marker p {
            font-size: 12px;
            text-align: center;
            margin: 0;
            cursor: pointer;
        }
        .noUi-tooltip {
            display: none !important;
        }
        .noUi-active .noUi-tooltip {
            display: block !important;
        }
        .noUi-horizontal {
            height: 3px;
        }
        .noUi-active {
            box-shadow: none ;
        }
        .noUi-target {
            box-shadow: none ;
            border: none ;
        }
        .noUi-connect {
            background: #2D6C93;
        }
        /*.noUi-handle {*/
            /*box*/
        /*}*/
        .noUi-horizontal .noUi-handle{
            cursor: pointer;
            position: absolute;
            z-index: 2;
            background: url('{{ asset('style/assets/img/range-btn.png') }}');
            background-repeat: no-repeat;
            border-color: #fff;
            border-radius: 20px;
            height: 20px;
            top: -8px;
            width: 45px;
            box-shadow:none;
        }
        .noUi-handle:after, .noUi-handle:before {
            content: "";
            display: none;
            position: absolute;
            height: 14px;
            width: 1px;
            background: #E8E7E6;
            left: 14px;
            top: 6px;
        }
        .noUi-horizontal .noUi-handle .noUi-tooltip {
            top: 15px;
            bottom: initial;
            font-size: 14px;
            background: none;
            border: none;
        }
        .noUi-base, .noUi-connects {
            background: #ddd;
        }
    </style>
@endsection
@section('rawContent')
    <div id="search_result_full" class="search_result">
        <div class="container-fulid search_result_width">
            <div class="row">
                <div id="search_result_content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12 search_result_content">
                    <div id="select_box">
                        <div class="row">
                            {!! Form::model(['id'=>'banner_select_area']) !!}
                            {!! Form::hidden('lat', isset($request->lat) ? $request->lat : '', ['id'=>'formLat']) !!}
                            {!! Form::hidden('lng', isset($request->lng) ? $request->lng : '', ['id'=>'formLng']) !!}
                            <div class="search_result_select_area">
                                <div class="search_result_date_area">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="select_area_icon">
                                            <img src="/style/assets/img/date-icon.png">
                                            <span class="text-upper text-grayB3">Dates</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 single_select_box active-input padding-left-none">
                                        <div class="select_area_full_box">
                                            <div class="box_title">
                                                <label class="text-upper text-14-18-2 text-grayB3" for="check_in_date">CHECK IN</label>
                                            </div>
                                            {{--<input name="check_in_date" type="text" id="check_in_date" class="form-control datepicker myDate" value="{{ date("Y-m-d") }}">--}}
                                            {!! Form::text('check_in_date', isset($request->check_in_date) ? $request->check_in_date : date("Y-m-d") ,
                                            ['class'=>'form-control datepicker myDate2', 'id'=>'check_in_date']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 single_select_box">
                                        <div class="select_area_full_box">
                                            <div class="box_title">
                                                <label class="text-upper text-14-18-2 text-grayB3" for="check_out_date">CHECK OUT</label>
                                            </div>
                                            {!! Form::text('check_out_date', isset($request->check_out_date) ? $request->check_out_date : date("Y-m-d") ,
                                            ['class'=>'form-control datepicker myDate2', 'id'=>'check_out_date']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 single_select_box">
                                        <div class="select_area_full_box">
                                            <div class="box_title">
                                                <label class="text-upper text-14-18-2 text-grayB3" for="guests">HOW MANY</label>
                                            </div>
                                            {!! Form::select('no_of_guest', list_for('Guests', 1, 10), isset($request->no_of_guest) ? $request->no_of_guest : 1, ['id'=>'guests', 'class'=>'text-14-18-2', 'onchange' => 'customFunctions.filterSearch(event)']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="search_result_room_area">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="select_area_icon">
                                            <img src="/style/assets/img/home-icon.png">
                                            <span class="text-upper text-grayB3">Room type</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-left-none">
                                        <div class="search_result_room_box">

                                            {!! Form::radio('room_type', 1, isset($request->room_type) ? $request->room_type == 1 : '' , ['id'=>'apt', 'onchange' => 'customFunctions.filterSearch(event)' ]) !!}
                                            <label for="apt">entire home / apt</label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                        <div class="search_result_room_box">
                                            {!! Form::radio('room_type', 2, isset($request->room_type) ? $request->room_type == 2 : '' , ['id'=>'private', 'onchange' => 'customFunctions.filterSearch(event)' ]) !!}
                                            <label for="private">private room</label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                        <div class="search_result_room_box">
                                            {!! Form::radio('room_type', 3, isset($request->room_type) ? $request->room_type == 3 : '' , ['id'=>'room', 'onchange' => 'customFunctions.filterSearch(event)' ]) !!}
                                            <label for="room">shared room</label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="search_result_range">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="select_area_icon">
                                            <img src="/style/assets/img/money-icon.png">
                                            <span class="text-upper text-grayB3">price range</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding-left-none">
                                        <div class="search_result_range_box">
                                            <div id="rangeSlider" class="noUi-active">
                                            </div>
                                            {{--@if(isset($request->price_min) && $request->price_min > 0 && isset($request->price_max) && $request->price_max > 0)--}}
                                                {{--<input type="hidden" id="slider_range" class="flat-slider" value="{{ $request->price_min . ';' . $request->price_max }}"/>--}}
                                            {{--@else--}}
                                                {{--<input type="hidden" id="slider_range" class="flat-slider" value="1;1000"/>--}}
                                            {{--@endif--}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="search_result_bottom_content" >
                        <div class="filter_bar">
                            <div class="filter_box">
                                <img src="/style/assets/img/filter_icon.png">
                                <h3 class="search_result_filter_title">more filters<a class="collapsed" data-toggle="collapse" href="#full_table_collapse"><img src="/style/assets/img/arrows-blck.png"></a></h3>
                            </div>
                            <p>All hosts accept and celebrate people from all backgrounds. <span id="listingsCount">{{ count($listings) }}</span> listings</p>
                        </div>
                        <div class="filters_table_open panel-collapse collapse" id="full_table_collapse">
                            <div class="search_result_filters_bottom_info">
                                <div class="search_result_filters_table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="black-text space_140">size</th>
                                            <th>
                                                <div class="table_drop">
                                                    {!! Form::select('no_of_bedroom', list_for('Bedrooms', 1, 10), isset($request->no_of_bedroom) ? $request->no_of_bedroom : 1, ['id'=>'no_of_bedroom', 'class'=>'text-14-18-2']) !!}
                                                </div>
                                            </th>
                                            <th>
                                                <div class="table_drop">
                                                    {!! Form::select('no_of_bath', list_for('Bathroom', 1, 10), isset($request->no_of_bath) ? $request->no_of_bath : 1, ['id'=>'no_of_bath', 'class'=>'text-14-18-2']) !!}
                                                    </select>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="table_drop">
                                                    {!! Form::select('no_of_bed', list_for('Bed', 1, 10), isset($request->no_of_bed) ? $request->no_of_bed : 1, ['id'=>'no_of_bed', 'class'=>'text-14-18-2']) !!}
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th class="black-text space_140" scope="row">amenties</th>
                                            @foreach($amenities as $id => $amenity)
                                                @if($id > 3) @break @endif
                                                <td>
                                                    <div class="checkbox table_checkbox cb1">
                                                        <label>
                                                            {!! Form::checkbox('amenities[]', $id, in_array($id, $current['amenities']), ['class'=>'amenities amn_'.$id]) !!}
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            {{ $amenity }}
                                                        </label>
                                                        @if($id == 3)
                                                            <a class="table_open_btn collapsed" id="amnCb1" data-toggle="collapse" href="#table_collapse1">
                                                                <img src="/style/assets/img/arrows-blck.png"></a>
                                                        @endif
                                                    </div>
                                                </td>

                                            @endforeach
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div id="table_collapse1" class="panel-collapse collapse">
                                        <table class="table table_open">
                                            <tbody>
                                            <tr>
                                                @foreach($amenities as $id => $amenity)
                                                    @if($id < 4) @continue @endif
                                                    @if(($id-1) % 3 === 0)
                                                        <th class="space_140" scope="row"></th>
                                                    @endif
                                                    <td>
                                                        <div class="checkbox table_checkbox">
                                                            <label>
                                                                {!! Form::checkbox('amenities[]', $id, in_array($id, $current['amenities']), ['class'=>'amenities amn_'.$id]) !!}
                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                {{ $amenity }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    @if(($id - 3) % 3 === 0)
                                            </tr>
                                            <tr>
                                                @endif
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th class="black-text space_140" scope="row">property type</th>
                                            @foreach(\App\Model\Listing::propertyOptions() as $id => $propertyOption)
                                                @if($id > 3) @break @endif
                                                <td>
                                                    <div class="checkbox table_checkbox cb2">
                                                        <label>
                                                            {!! Form::checkbox('property_type[]', $id, in_array($id, $current['properties']), ['class'=>'property_types prp_'.$id ]) !!}
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            {{ $propertyOption }}
                                                        </label>
                                                        @if($id == 3)
                                                            <a class="table_open_btn collapsed" id="amnCb2"  data-toggle="collapse" href="#table_collapse2">
                                                                <img src="/style/assets/img/arrows-blck.png"></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div id="table_collapse2" class="panel-collapse collapse">
                                        <table class="table table_open">
                                            <tbody>
                                            <tr>
                                                @php $i=0; @endphp
                                                @foreach(\App\Model\Listing::propertyOptions() as $id => $propertyOption)
                                                    @php $i++; @endphp
                                                    @if($i < 4) @continue @endif
                                                    @if(($i-1) % 3 === 0)
                                                        <th class="space_140" scope="row"></th>
                                                    @endif
                                                    <td>
                                                        <div class="checkbox table_checkbox">
                                                            <label>
                                                                {!! Form::checkbox('property_type[]', $id, in_array($id, $current['properties']), ['class'=>'property_types prp_'.$id ]) !!}
                                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                {{ $propertyOption }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    @if(($i - 3) % 3 === 0)
                                            </tr>
                                            <tr>
                                                @endif
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="search_result_filters_table_btn">
                                <a href="#" id="applyFilter" onClick="customFunctions.filterSearch(event)">apply filters</a>
                                <a class="cancel_btn" id="cancleFilter" href="#">cancel</a>
                            </div>
                        </div>
                        <div id="searchListingBoxes">
                            @include('partials.searchListings', ['listings' => $listings, 'mapListings' => $mapListings])
                        </div>
                    </div>
                </div>
                <div id="search_result_right" class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="map search_result_right">
                        <div id="map_div" style="width: 100%;height: 100%;"></div>
                        <input type="hidden" id="json" name="json" value="{{ $listingsJson }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        $(".myDate2").datepicker({
            startDate: new Date()
        });
        var url = window.location.href;
        var urlArr = url.split('/');
        if(urlArr[urlArr.length - 1] == 'search'){
            window.allListings = 1;
        } else {
            window.allListings = 0;
        }
    </script>
    <script type="text/javascript">
        listingsJson = <?= $listingsJson; ?>;

        $('.search_result_filter_title a').click(function (e){
            e.preventDefault();
            if(!$(this).hasClass('collapsed')){
                setTimeout(function (e) {
                    $("#full_table_collapse").is(":visible") ? $("#full_table_collapse").collapse('hide') :'';
                }, 500);
            }
        });

        $("#cancleFilter").click(function(){
            $(".search_result_filter_title a").click();
        });
        $("#amnCb1").click(function(){
            if(!$(this).hasClass('collapsed')) {
                setTimeout(function () {
                    $('#table_collapse1').collapse('hide');
                }, 500);
            }
        });
        $("#amnCb2").click(function(){
            if(!$(this).hasClass('collapsed')) {
                setTimeout(function () {
                    $('#table_collapse2').collapse('hide');
                }, 500);
            }
        });

        function setAmn (arr){
            $('.amenities').prop("checked", false);
            for(j=0;j<arr.length;j++){
                var key = parseInt(arr[j]);
                $('.amn_'+key).prop("checked", true);
            }
        }
        function setPrp (arr){
            $('.property_types').prop("checked", false);
            for(j=0;j<arr.length;j++){
                var key = parseInt(arr[j]);
                $('.prp_'+key).prop("checked", true);
            }
        }
        function selSliderVal(min, max){
            setTimeout(function (){
                var slider = document.getElementById('rangeSlider');
                slider.noUiSlider.set([parseInt(min), parseInt(max)]);
            }, 500);

        }

        $(function (){
            var query = window.location.search.substring(1);
            var vars = query.split('&');
            var amn = [];
            var prp = [];
            for(i=0;i<vars.length;i++){
                if(vars[i].split('=')[0] == 'amenities'){
                    amn = vars[i].split('=')[1].split(',');
                }
                if(vars[i].split('=')[0] == 'properties'){
                    prp = vars[i].split('=')[1].split(',');
                }
                if(vars[i].split('=')[0] == 'price_min'){
                    min = vars[i].split('=')[1];
                    max = '{{ $request->price_max }}';
                    selSliderVal(min, max);
                }
            }
            if(amn.length > 0){
                setAmn(amn);
            }
            if(prp.length > 0){
                setPrp(prp);
            }

            var slider = document.getElementById('rangeSlider');

            noUiSlider.create(slider, {
                start: [ 1, 1000 ],
                step: 20,
                connect: true,
                range: {
                    'min': 1,
                    'max': 1000
                },
                tooltips: [ wNumb({decimals: 0, prefix: '$'}), wNumb({decimals: 0, prefix: '$'}) ],
                change: function(){
                    $('#displayscreen').text($(this).noUiSlider("value")[1]);
                }
            });
            slider.noUiSlider.on('end', function(e){
                customFunctions.filterSearch();
            });
        });
    </script>


@endsection

