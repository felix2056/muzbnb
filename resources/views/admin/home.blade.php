@extends('admin.layout.master')

@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('')}}/admin/dashboard">Dashboard</a>
        </li>
    </ul>
@endsection

@section('title')
    <h1 class="page-title"> Notifications
        {{--<small>statistics</small>--}}
    </h1>
@endsection

@section('content')

    <ul>
    @foreach($notifications as $notification)
        <li><a href="{{ url($notification->url) }}">{{ $notification->message }}</a> </li>
    @endforeach
    </ul>
    <!-- BEGIN DASHBOARD STATS 1-->
   {{-- <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="100">0</span>
                    </div>
                    <div class="desc"> Property Seeker </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#" style="background-color: #1a3548">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="500">0</span> </div>
                    <div class="desc"> Property Owner </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('admin.index')}}" style="background-color: #38956A">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="5">0</span>
                    </div>
                    <div class="desc"> Admins </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="50">0</span> </div>
                    <div class="desc"> New Members past month </div>
                </div>
            </a>
        </div>
    </div>--}}
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->

@endsection

@section('footer_scripts')
    <script src="/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>

    <script src="/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="/js/scripts/charts-amcharts.js" type="text/javascript"></script>


    {{--<script src="/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>--}}
    {{--<script src="/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>--}}
    {{--<script src="/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>--}}
    {{--<script src="/assets/global/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>--}}
    {{--<script src="/assets/global/plugins/flot/jquery.flot.stack.min.js" type="text/javascript"></script>--}}
    {{--<script src="/assets/global/plugins/flot/jquery.flot.crosshair.min.js" type="text/javascript"></script>--}}
    {{--<script src="/assets/global/plugins/flot/jquery.flot.axislabels.js" type="text/javascript"></script>--}}
    <!-- END PAGE LEVEL PLUGINS -->


    <script src="/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>

    <script src="/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>

    <script src="/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/js/scripts/dashboard.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>



    <script type="text/javascript">

        $(".nav a").on("click", function(){
            $(".nav").find(".active").removeClass("active");
            $(this).parent().addClass("active");
        });
    </script>



@endsection