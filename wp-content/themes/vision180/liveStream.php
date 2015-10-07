<?php 
/*
	Template Name: Media Player Popup
*/	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vision 180 Stream</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/styles.css">
	<link rel="stylesheet" href="http://dev.vision.org.au/wp-content/themes/globalelements/globalStyles.css">
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_enqueue_script('jquery-ui-slider'); ?>
	<?php wp_head(); ?>
	<script src="http://dev.vision.org.au/wp-content/themes/globalelements/globalscripts.js"></script>
	<script>
		jQuery(document).ready(function($){
			$( "#slider-range-min" ).slider({
                range: "min",
                value: 80,
                min: 0,
                max: 100,
                slide: function( event, ui ) {
                    $('audio.audio').prop('volume', (ui.value / 100));
                }
            });
     
			$('.stationChange').on('click', function(){
				$('.stationSelect').slideToggle();
			});
		});
	</script>
</head>
<body>
	
	<div class="mediaPlayer">
		
		<div class="mediaTopBar">
			<h3 class="stationChange">CHANGE STATION</h3>
			<img src="<?php echo bloginfo('template_directory'); ?>/images/donate-green.png">
			<div style="clear: both;"></div>
		</div>
		
		<div class="stationSelect" style="display: none;width: 100%;">
				<a href="http://dev.vision.org.au/vision180/vision-180-live-stream/">Vision 180</a>
				<a href="http://dev.vision.org.au/christian-radio/vision-christian-radio-stream/">Vision Radio</a>
				<div style="clear:both;"></div>
			</div>
		
		<div class="mediaLogo">
			<img src="<?php echo bloginfo('template_directory'); ?>/images/vision-logo.png" width="40%">
		</div>
		
		<div class="controls">
			<a href="#" class="play">
				<img src="<?php echo bloginfo('template_directory'); ?>/images/play.png">
			</a>
			<a href="#" class="stop">
				<img src="<?php echo bloginfo('template_directory'); ?>/images/stop.png">
			</a>
			<a href="#" class="pause" style="display: none;">
				<img src="<?php echo bloginfo('template_directory'); ?>/images/pause.png">
			</a>

		</div>
		
		<div class="nowPlayingPlayer">
			<?php echo do_shortcode('[nowplaying180]'); ?>
		</div>
	
		<div class="qualityVol">
			<div class="quality">	
				<h4>QUALITY</h4>
				<p><a class="active" href="http://tx.sharp-stream.com/http_live.php?i=vision180.aac">HIGH</a> | 
				<a href="http://tx.sharp-stream.com/http_live.php?i=vision180.mp3">LOW</a></p>
			</div>
			<div class="volume">
				<img class="low" src="<?php echo bloginfo('template_directory'); ?>/images/low-volume.png" width="5%">
				<div id="slider-range-min" style="width: 75%;float: left;margin-left: 16px;margin-top: 13px;"></div>
				<img class="high" src="<?php echo bloginfo('template_directory'); ?>/images/high-volume.png" width="10%">
			</div>
			
			<div style="clear: both;"></div>
		</div>
		
		<div class="notice">
			<p>128k AAC (uses approx 54mb per hour)</p>
		</div>
		
		<div class="player">
			<audio class="audio" src=""></audio>
		</div>
	
	</div>
	
</body>
<?php wp_footer(); ?>
</html>