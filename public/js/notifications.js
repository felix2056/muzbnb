(function(window) {
    var Notification = (function() {
        var notif = {
            lastId: 0,
            array: [],
            unseenCount: 0,
            seen: []
        };
        var currentToken = $('meta[name="csrf-token"]').attr('content'), cls;

        /*function bringItIn() {
            $.post('/notifications', {_token:currentToken, t: notif.lastId, v: notif.seen} , function (data) {
                data.forEach(function(e){
                    if(e.seen) {
                        cls = 'viewed';
                    } else {
                        notif.unseenCount++;
                        cls = 'nw';
                    }
                    $('.all-notification ul').prepend('<li data-id="' + e.id + '" class="' + cls + '"><a href="' + e.url + '">' + e.message + '</a></li>');
                    notif.lastId = e.id;
                });
                $(".not-btn").text(notif.unseenCount);
            });
            notif.seen = [];
        }*/

        //setInterval(bringItIn, 300000);

        $('.all-notification ul').on('mouseover', 'li.nw', function () {
            notif.makeSeen($(this).data('id'));
            $(this).addClass('viewed').removeClass('nw');
        });
        $(".markAll").click(function (e) {
            e.preventDefault();
            $('.all-notification ul li.nw').each(function(e, v) {
                $(v).addClass('viewed').removeClass('nw');
                notif.makeSeen($(v).data('id'));
            });
        });
        notif.makeSeen = function (id) {
            this.seen.push(id);
            this.unseenCount--;
            $(".not-btn").text(notif.unseenCount);
        };
        return notif;
    }());
    window.Notification = Notification;
}(window));