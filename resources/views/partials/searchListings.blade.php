{{--{!! dump($listings)  !!}--}}
<div class="search_result_bottom_content_info_full" id="listing-holder">
    @foreach($listings->chunk(2) as $key => $val)
        <div class="search_result_bottom_content_info">
            @foreach($val as $listing)
                <div class="search_result_bottom_content_box">
                    <div class="search_result_bottom_content_box_img">
                        @if(isset($listing['featuredImage']) && $listing['featuredImage']['name'] != '')
                            <a href="/rooms/{{ $listing['id'] }}">
                                @php
                                    $img = 'images/listings/m_' . $listing['featuredImage']['name'];
                                @endphp
                                @if(file_exists($img))
                                    <img src="{{ asset('images/listings/m_' . $listing['featuredImage']['name']) }}">
                                @else
                                    <img src="{{ asset('images/listings/s_' . $listing['featuredImage']['name']) }}">
                                @endif
                            </a>
                        @else
                            <a href="/rooms/{{ $listing['id'] }}">
                                <img src="{{ asset('images/signup-bg.png') }}">
                            </a>
                        @endif
                        @if(isset($listing['currency']) && $listing['currency']['symbol'] != '')
                            <h4>{{ $listing['currency']['symbol'] . $listing['price'] }}</h4>
                        @else
                            <h4>$ {{ $listing['price'] }}</h4>
                        @endif
                        <a class="icon_f" href="#">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="content_box_head">
                        <a href="/rooms/{{ $listing['id'] }}">
                            <h5>{{ $listing['name'] }} in {{ $listing['city'] }}</h5>
                        </a>
                        <p>{{ isset($listing['room_type_display']) ? $listing['room_type_display'] : '' }} . {{ isset($listing['no_of_bed']) ? $listing['no_of_bed'] : '' }} bed</p>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="content_box_info">
                        <a href="public-profile/{{ $listing['user_id'] }}">
                            @if(isset($listing['user']['profile']) && $listing['user']['profile']['avatar'] != '')
                                <img id="pic" class="user-img-sm img-circle" src="{{ asset('images/user/' . $listing['user']['profile']['avatar']) }}">
                            @else
                                <img id="pic" class="user-img-sm img-circle" src="{{ asset('images/dummy.jpg') }}">
                            @endif
                        </a>
                        <div class="content_box_user_info">
                            <div class="content_box_user_info_top">
                                <h6>
                                    <a href="public-profile/{{ $listing['user_id'] }}">
                                        <label id="name">
                                            {{ strtoupper($listing['user']['first_name'] . ' ' . $listing['user']['last_name']) }}
                                        </label>
                                    </a>
                                    <span>0 reviews as a host</span>
                                </h6>
                            </div>
                            <div class="content_box_user_info_bottom">
                                <p>
                                    <span id="namespan">{{ $listing['user']['first_name'] . ' ' . $listing['user']['last_name'] }}</span> hasn't hosted anyone yet.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<script>
    mapListings = <?= $mapListings; ?>;
</script>