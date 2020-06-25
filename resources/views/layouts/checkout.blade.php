@extends('layouts.raw')

@section('rawContent')
    @yield('content')
@endsection
@section('scripts')
<script>
    $(document).on('click', '.open-signup-social', function(){
        $("#signup-social").modal('hide');
        setTimeout(function(){
            $("#signup-social").modal('show');
        }, 500);
    });

    function stopVideo(){
        var $frame = $('iframe');

        // saves the current iframe source
        var vidsrc = $frame.attr('src');

        // sets the source to nothing, stopping the video
        $frame.attr('src','');

        // sets it back to the correct link so that it reloads immediately on the next window open
        $frame.attr('src', vidsrc);
    }


</script>

@endsection
