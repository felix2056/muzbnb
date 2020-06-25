<?php $rname = Route::currentRouteName();
?>
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  " action="#" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="nav-item start @if(Request::url() === url('admin/dashboard')) active  @endif">
            	<a href="{{url('admin')}}" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="badge badge-success"></span>
                </a>                                
            </li>

            <li class="nav-item <?= strpos($rname, 'email') !== false ? 'active open' : '' ?>">
                {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                    {{--<i class="fa fa-paper-plane-o" aria-hidden="true"></i>--}}
                    {{--<span class="title">Emails</span>--}}
                    {{--<span class="arrow"></span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{route('admin.email.campaigns.index')}}" class="nav-link ">--}}
                            {{--<i class="icon-layers"></i>--}}
                            {{--<span class="title">Campaign</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{route('admin.email.templates.index')}}" class="nav-link ">--}}
                            {{--<i class="fa fa-pie-chart" aria-hidden="true"></i>--}}
                            {{--<span class="title">Templates</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{route('admin.email.subscriber')}}" class="nav-link ">--}}
                            {{--<i class="icon-layers"></i>--}}
                            {{--<span class="title">Subscriber</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{route('admin.email.email-que.index')}}" class="nav-link ">--}}
                            {{--<i class="icon-layers"></i>--}}
                            {{--<span class="title">Queue</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            </li>


            <li class="nav-item <?= strpos($rname, 'spark_template') !== false ? 'active open' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    <span class="title">Emails</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('spark_template')}}" class="nav-link ">
                            <i class="icon-layers"></i>
                            <span class="title">Spark Template</span>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
            <li class="nav-item  <?= strpos($rname, 'users') !== false||strpos($rname, 'admin') !== false ? 'active open' : '' ?>">

                <a href="https://blogmuzbnb.dreamhosters.com/wp-admin" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Blog Admin Section</span>
                </a>
            </li>
            <li class="nav-item  <?= strpos($rname, 'listings') !== false ? 'active' : '' ?>">
                <a href="{{route('listing.index')}}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Listings</span>
                </a>
            </li>
            <li class="nav-item  <?= strpos($rname, 'listings') !== false ? 'active' : '' ?>">
                <a href="{{route('currency.index')}}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Currency</span>
                </a>
            </li>
            <li class="nav-item  <?= strpos($rname, 'users') !== false||strpos($rname, 'admin') !== false ? 'active open' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Users</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ route('admin.index') }}" class="nav-link ">
                            <span class="title">Admin List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ route('admin.user.list') }}" class="nav-link ">
                            <span class="title">Users List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  <?= strpos($rname, 'bookings') !== false||strpos($rname, 'transactions') !== false ? 'active open' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Finances</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  <?= strpos($rname, 'bookings') !== false ? 'active' : '' ?>">
                        <a href="{{ route('admin.bookings') }}" class="nav-link ">
                            <span class="title">Bookings</span>
                        </a>
                    </li>
                    <li class="nav-item  <?= strpos($rname, 'transactions') !== false ? 'active' : '' ?>">
                        <a href="{{ route('admin.transactions') }}" class="nav-link ">
                            <span class="title">Transactions</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
        
    </div>
    <!-- END SIDEBAR -->
</div>