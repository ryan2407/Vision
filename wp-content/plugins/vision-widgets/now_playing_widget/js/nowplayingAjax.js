jQuery(document).ready(function($) {

    var wpdata = {
        'action': 'nowplaying'
    };

    $.ajax({
        url: 'wp-admin/admin-ajax.php',
        type: 'POST',
        data: wpdata,
        success: function (data) {
            $('div.nowPlaying').html(data);
        }
    });

    var interval = 10000;
    doAjax();

    function doAjax() {
        $.ajax({
            url: 'wp-admin/admin-ajax.php',
            type: 'POST',
            data: wpdata,
            success: function (data) {
                $('div.nowPlaying').html(data);
                $('img.loading').remove();
            },
            complete: function (data) {
                // Schedule the next
                setTimeout(doAjax, interval);
            }
        });
    }
});