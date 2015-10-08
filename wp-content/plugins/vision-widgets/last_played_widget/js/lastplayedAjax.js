jQuery(document).ready(function($) {

    var wpdata = {
        'action': 'lastplayed',
        'lh' : '2' 
    };
    
    $('#dc').datepicker({
	    "dateFormat" : "yy-mm-dd"
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
		$('div.lastPlayed').empty().html('Loading...');
		wpdata.dc = $('input#dc').val();
		wpdata.rs = $('input#rs').val();
		wpdata.re = $('input#re').val();
		runAjax(wpdata);
	});
    
    runAjax(wpdata);

	function runAjax(wpdata) {
	    $.ajax({
	        url: 'wp-admin/admin-ajax.php',
	        type: 'POST',
	        data: wpdata,
	        success: function (data) {
	            $('div.lastPlayed').html(data);
	        }
	    });
    }
});