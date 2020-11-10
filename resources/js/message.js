var receiver_id = '';
var my_id = "{{ Auth::id() }}";
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('65cc2e5ff5fbd2addc7a', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        // alert(JSON.stringify(data));
        if (my_id == data.from) {
            $('#' + data.to).click();
        } else if (my_id == data.to) {
            if (receiver_id == data.to) {
                $('#' + data.from).click();

            } else {
                var pending = parseInt($('#' + data.from).find('.pending').html());

                if (pending) {
                    $('#' + data.from).find('.pending').html(pending + 1);
                } else {
                    $('#' + data.from).append('<span class="pending">1</span>')
                }
            }
        }
        
    });

    $('.user').click(function () {
        $('.user').removeClass('active');
        $(this).addClass('active');
        $(this).find('.pending').remove();

        receiver_id = $(this).attr('id');
        // alert(receiver_id);
        $.ajax({
            type: "get",
            url: "message/" + receiver_id,
            data: "",
            cache: false,
            success: function (data) {
                $('#messages').html(data);
                // alert(data);
                scrollToBottomFunc();
            }
        });


    });

    $(document).on('keyup', '.input-text input', function (e) {
        var message = $(this).val();

        if (e.keyCode == 13 && message != '' && receiver_id != '') {
            $(this).val('');

            var datastr = "receiver_id=" + receiver_id + "&message=" + message;
            $.ajax({
                type: "post",
                url: "message",
                data: datastr,
                cache: false,
                success: function (data) {

                },
                error: function (jqXHR, status, err) {

                },
                complete: function () {

                }
            })
        }


    });
});


function scrollToBottomFunc() {
    $('.message-wrapper').animate({
        scrollTop: $('.message-wrapper').get(0).scrollHeight
    }, 50);
}
