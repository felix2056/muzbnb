@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="row messages">
                        <div class="col-md-3">

                            <form role="form" method="POST" action="{{ url('chat/new-thread') }}">
                                {{ csrf_field() }}
                                <input name="email" type="email" class="form-control" placeholder="Enter Friends Email" />
                            </form>
                            <chat-threads :threads="threads" v-on:clicked="threadClick"></chat-threads>
                        </div>
                        <div class="col-md-9 message-box">
                            <chat-log :messages="messages"></chat-log>
                            <chat-composer v-on:sendmessage="messageAdd"></chat-composer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        USER_HASH = '{{ $hash }}'
        USER_NAME = '{{ $username }}'
    </script>
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection
