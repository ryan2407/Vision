jQuery(document).ready(function($) {

	$('#epgDate').datepicker({
	    "dateFormat" : "yy-mm-dd",
	    onSelect: function(date) {
		    $('div.epg').empty().html('Loading...');
		    wpdata.dc = date
			runAjax(wpdata);
	    }
    });
    
    $('a.tzToggle').on('click', function(){
	    $('select.tzSelect').fadeToggle();
    });
    
    $('body').on('change', 'select.tzSelect', function(){
	    $('div.epg').empty().html('Loading...');
	    
	    wpdata.tz = $(this).find(':selected').val();
	    
	    runAjax(wpdata);
	    
    });
    

	var wpdata = {
        'action': 'epg'
    };

    runAjax(wpdata);

	function runAjax(wpdata) {
	    $.ajax({
	        url: 'wp-admin/admin-ajax.php',
	        type: 'POST',
	        data: wpdata,
	        success: function (data) {
	            $('div.epg').html(data);
	        }
	    });
    }
});