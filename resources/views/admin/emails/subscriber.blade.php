@extends('admin.layout.master')

@section('header_scripts')

    <link href="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('')}}/admin/license">Email</a>
        </li>
    </ul>
    {{--<div class="page-toolbar">--}}
        {{--<div class="form-actions">--}}
            {{--<div class="btn-set pull-left">--}}
                {{--<a href="{{url('admin/license/create')}}" class="btn btn-primary">Create License</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('title')
    <h1 class="page-title"> Email
        <small>Recent Subscriber</small>
    </h1>
@endsection

@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Subscriber </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Email</th>
                    <th> Status</th>
                    {{--<th>  </th>--}}
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($subscribers as $subscriber)
                    <tr id="trolic-{{$subscriber->id}}">
                        <td><input type="checkbox" class="sendToAllSubscriber" name="lid[]" id="lic{{$i}}" value="{{$subscriber->id}}" /> {{$i++}}</td>
                        <td>{{$subscriber->name}}</td>
                        <td>{{$subscriber->email}}</td>
                        <td>{{$subscriber->status=='0'?'Unsubscribed':'Subscribed'}}</td>
                        {{--<td>--}}
                            {{--<a href="{{route('admin.license.show',$subscriber->id)}}"><i class="fa fa-binoculars" aria-hidden="true"></i></a>--}}
                            {{--<a href="{{route('admin.license.edit',$subscriber->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                            {{--<a href="{{route('admin.license.show',$subscriber->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>--}}
                        {{--</td>--}}
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="4">
                        <div class="input-group input-large" style="display: inline-block">
                            <select class="form-control input-sm input-inline" id="campaign" name="email_campaign">
                                @foreach($campaigns as $campaign)
                                <option value="{{$campaign->id}}">{{$campaign->title}}</option>
                                @endforeach
                            </select>
                            <a href="{{route('admin.email.subscriber.send')}}" style="margin-left: 5px;" class="btn btn-primary" id="sendMail-button">Send To Selected Subscriber</a>
                            <a href="{{route('admin.email.subscriber.sendAll')}}" style="margin-left: 5px;" class="btn btn-primary" id="sendAll-button">Send To All Subscriber</a>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('footer_scripts')
    <script src="{{url('')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/global/plugins/bootstrap-sweetalert/sweet-alert.min.js" type="text/javascript"></script>
    <script src="{{url('')}}/assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('#sendMail-button').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');

            swal({
                    title: "Do you want to send email?",
                    text: "Are you sure?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true, },
                function(){
                    setTimeout(function(){
                        ajax_call(url, true);
                    }, 500);
                });
        });

        function ajax_call(url, deleterows){
            var checked = [];
            var campaign = $('#campaign option:selected').attr('value');
            var user_id = $('#user_id').attr('value');

            $('input:checked').each(function() {
                checked.push($(this).val());
            });
            if(checked.length>0)
            {
                $("#licenses-grid").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url   : url,
                    data  : {
                        checked:checked,
                        campaign: campaign,
                        user_id: user_id,
                        _token : "{{csrf_token()}}"
                    }
                });
            }
        }


        $('#sendAll-button').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');

            swal({
                    title: "Do you want to send email?",
                    text: "Are you sure?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true, },
                function(){
                    setTimeout(function(){
                        ajax_call2(url, true);
                    }, 500);
                });
        });

        function ajax_call2(url, deleterows){
            var checked = [];
            var campaign = $('#campaign option:selected').attr('value');
            var user_id = $('#user_id').attr('value');

            $('.sendToAllSubscriber').each(function() {
                checked.push($(this).val());
            });
            if(checked.length>0)
            {
                $("#licenses-grid").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url   : url,
                    data  : {
                        checked:checked,
                        campaign: campaign,
                        user_id: user_id,
                        _token : "{{csrf_token()}}"
                    }
                });
            }
        }
    </script>


@endsection
