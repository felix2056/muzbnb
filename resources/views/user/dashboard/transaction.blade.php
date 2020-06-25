
@extends('user.dashboard.layout')

@section('title', 'My Transactions')

@section('style-top')
    <link href="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    {{--<style>--}}
        {{--.transNav {--}}
            {{--background: #edf0ed !important;--}}
            {{--height: 50px !important;--}}
            {{--text-align: left !important;--}}
        {{--}--}}
        {{--.nav-tabs>li.active>a, .nav-tabs>li>a:focus, .nav-tabs>li>a:hover {--}}
            {{--height: 40px !important;--}}
            {{--background: none !important;--}}
            {{--color: #999 !important;--}}
            {{--border: none !important;--}}
            {{--border-radius: 0 !important;--}}
            {{--box-shadow: none !important;--}}
            {{--border-bottom: 5px solid #ccc !important;--}}
            {{--padding: 10px 30px 10px !important;--}}
        {{--}--}}
    {{--</style>--}}
    <style>

        .transNav.nav-tabs>li>a {
            height: auto !important;
            background: transparent;
            color: #444 !important;
            top: 0 !important;
            padding: 15px 0px !important;
            text-transform: capitalize !important;
            font-family: arial !important;
            font-size: 16px !important;
            margin-left: 30px !important;
            margin-right: 30px !important;
        }
        .transNav.nav.nav-tabs li a:hover {
            background-color: transparent;
            border: none;
            border-radius: none;
            box-shadow: none;
            height: auto;
        }
        ul.transNav.nav.nav-tabs {
            background: #edf0ed;
            margin-bottom: 30px;
        }
        .transNav.nav-tabs>li.active>a {
            height: auto !important;
            background: transparent !important;
            box-shadow: none !important;
            border-bottom: 5px solid #ccc !important;
            border-radius: 0px !important;
            color: #000 !important;
        }
        .transNav.nav-tabs > li {
            float: left !important;
        }
        .user-content {
            padding: 80px 0px !important;
        }
    </style>
@endsection
@section('tabcontent')
    @php
        $totalAmountComp = 0;
        $totalAmountFtr = 0;
    @endphp

    <div class="container-fluid box-width profile">
        <div class="row">
            <div class="info-box col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="section-title">
                        </div>
                        <div class="left-menu move-up">
                            <a href="/dashboard/account">
                                <h3>Settings</h3>
                            </a>
                            <a href="/dashboard/transaction" class="active">
                                <h3>Transactions</h3>
                            </a>
                            <a href="#">
                                <h3>Travel Credits</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <ul class="transNav nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#completeTrans">Complete Transactions</a></li>
                            <li><a data-toggle="tab" href="#futureTrans">Future Transactions</a></li>
                            <li><a data-toggle="tab" href="#grossEarn">Gross Earnings</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="completeTrans" class="tab-pane fade in active">
                                <div class="transaction">
                                    <h4>Paid out: $<span id="totalAmountComp"></span></h4>
                                    <div class="trips-table table-responsive transaction-table">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Detail</th>
                                                <th>Amount</th>
                                                <th>Paid Out</th>
                                            </tr>
                                            @if(count($records) > 0)
                                                @foreach($records as $record)
                                                    @if($record->status == 'succeeded')
                                                        
                                                        <tr>
                                                            <td>
                                                                <p>{{ Carbon\Carbon::parse($record->created_at)->format('m/d/Y')   }}</p>
                                                            </td>

                                                            <td>
                                                                <p>{{ ucwords(str_replace("_", " ", $record->status)) }}</p>
                                                            </td>
                                                            <td class="text-left">

                                                                <p>
                                                                    {{ Carbon\Carbon::parse($record->booking->date_from)->format('M d') }}
                                                                    -
                                                                    {{ Carbon\Carbon::parse($record->booking->date_to)->format('M d Y') }}
                                                                    <span>

                                                                        {{ $record->listing->name }}
                                                                    </span>
                                                                    <strong>
                                                                        Listing Link:<br>
                                                                    </strong>

                                                                    <a href="{{ URL::to('/') . '/rooms/' . $record->listing->id }}">{{ URL::to('/') . '/rooms/' . $record->listing->id }}</a>
                                                                     
                                                                </p>
                                                            </td>
                                                            <td>

                                                                <p class="success">${{ $record->amount }}</p>
                                                                @php  $totalAmountComp += $record->amount;  @endphp
                                                            </td>
                                                            <td>
                                                                <p></p>
                                                            </td>
                                                        </tr>

                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="4">No Record Found.</th>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="futureTrans" class="tab-pane fade">
                                <div class="transaction">
                                    <h4>Future Transactions: $<span id="totalAmountFtr"></span></h4>
                                    <div class="trips-table table-responsive transaction-table">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Detail</th>
                                                <th>Amount</th>
                                                <th>Paid Out</th>
                                            </tr>
                                            @if(count($records) > 0)
                                                @foreach($records as $record)
                                                    @if($record->status != 'succeeded')

                                                        <tr>
                                                            <td>
                                                                <p>{{ Carbon\Carbon::parse($record->created_at)->format('m/d/Y')   }}</p>
                                                            </td>
                                                            <td>
                                                                <p>{{ ucwords(str_replace("_", " ", $record->status)) }}</p>
                                                            </td>
                                                            <td class="text-left">
                                                                <p>
                                                                    {{ Carbon\Carbon::parse($record->booking->date_from)->format('M d') }}
                                                                    -
                                                                    {{ Carbon\Carbon::parse($record->booking->date_to)->format('M d Y') }}
                                                                    <span>
                                                                        {{ $record->listing->name }}
                                                                    </span>
                                                                    <strong>
                                                                        Listing Link:<br>
                                                                    </strong>
                                                                    <a href="{{ URL::to('/') . '/rooms/' . $record->listing->id }}">{{ URL::to('/') . '/rooms/' . $record->listing->id }}</a>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="success">${{ $record->amount }}</p>
                                                                @php  $totalAmountFtr += $record->amount;  @endphp
                                                            </td>
                                                            <td>
                                                                <p></p>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="4">No Record Found.</th>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="grossEarn" class="tab-pane fade">
                                <div class="transaction">
                                    <h4>Gross Earnings: </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{url('')}}/assets/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/js/ui-sweetalert.min.js" type="text/javascript"></script>
    {{--<script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>--}}

    <script>
        $(function(){
            $('#totalAmountFtr').html('{{ $totalAmountFtr }}');
            $('#totalAmountComp').html('{{ $totalAmountComp }}');
        });
    </script>

    {{--<script type="text/javascript">--}}

        {{--$('.delete-btn').click(function () {--}}
            {{--console.log('come');--}}
            {{--var id = $(this).data('id');--}}

            {{--swal({--}}
                    {{--title: "Do you want to delete this entry?",--}}
                    {{--text: "Are you sure?",--}}
                    {{--type: "info",--}}
                    {{--showCancelButton: true,--}}
                    {{--closeOnConfirm: true,--}}
                    {{--showLoaderOnConfirm: true, },--}}
                {{--function(){--}}
                    {{--setTimeout(function(){--}}
                        {{--ajax_delete(id);--}}
                    {{--}, 2000);--}}
                {{--});--}}
        {{--});--}}

        {{--function ajax_delete(id){--}}
            {{--$.ajax({--}}
                {{--method: 'DELETE',--}}
                {{--url   : "{{url('')}}/delete-listing/" + id,--}}
                {{--data  : {--}}
                    {{--id : id,--}}
                    {{--_token : "{{csrf_token()}}"--}}
                {{--},--}}
                {{--success: function(response){--}}
                    {{--// console.log(response)--}}
                    {{--if(response == 'success'){--}}
                        {{--swal("Deleted!", "Entry Deleted.", "success");--}}
                        {{--$("#listing-" + id).remove();--}}
                    {{--}else{--}}
                        {{--swal("Cancelled", "Please try again.", "error");--}}
                    {{--}--}}
                {{--}--}}
            {{--})--}}
        {{--}--}}
    {{--</script>--}}
@endsection