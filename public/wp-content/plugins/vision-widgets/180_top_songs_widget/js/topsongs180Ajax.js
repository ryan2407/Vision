jQuery(document).ready(function($) {

    var wpdata = {
        'action': 'topsongs180'
    };

    runAjax(wpdata);

    $('body').on('change', 'select.topSongs', function(){
        $('div.topsongs180').empty().html('Loading...');

        wpdata.top = $(this).find(':selected').val();

        runAjax(wpdata);

    });

    function runAjax(wpdata) {
        $.ajax({
            url: 'wp-admin/admin-ajax.php',
            type: 'POST',
            data: wpdata,
            success: function (data) {
                $('div.topsongs180').html(data);
            }
        });
    }
});