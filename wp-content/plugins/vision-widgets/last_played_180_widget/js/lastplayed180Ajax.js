jQuery(document).ready(function($) {

    var wpdata = {
        'action': 'lastplayed180',
        'lh' : '2'
    };

    $('#dc').datepicker({
        dateFormat: "dd-mm-yy",
        maxDate: 0
    });

    $('body').on('click', 'a.tzToggle', function(){
        $('select.tzSelect').fadeToggle();
    });

    $('body').on('change', 'select.tzSelect', function(){
        $('div.lastPlayed').empty().html('Loading...');

        wpdata.tz = $(this).find(':selected').val();

        runAjax(wpdata);

    });


    $('a.resync').on('click', function(){
        $('div.lastPlayed180').empty().html('Loading...');
        wpdata.dc = $('input#dc').val();
        wpdata.rs = $('select#rs').val();
        wpdata.re = $('select#re').val();
        runAjax(wpdata);
    });

    runAjax(wpdata);

    function runAjax(wpdata) {
        $.ajax({
            url: 'wp-admin/admin-ajax.php',
            type: 'POST',
            data: wpdata,
            success: function (data) {
                $('div.lastPlayed180').html(data);
            }
        });
    }
});