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
	<title>Vision Radio Stream</title>
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/styles.css">
	<link rel="stylesheet" href="http://dev.vision.org.au/wp-content/themes/globalelements/globalStyles.css">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js"></script>
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_head(); ?>
	<script src="http://dev.vision.org.au/wp-content/themes/globalelements/globalscripts.js"></script>
</head>
<body>
	
	<div class="mediaPlayer">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<h2>Select quality</h2>
			<select class="quality">
				<option value="http://icy-e-12-gos.sharp-stream.com/ucbau.aac">High quality</option>
				<option value="http://icy-e-12-gos.sharp-stream.com/ucbau2.mp3">Medium quality</option>
				<option value="http://icy-e-12-gos.sharp-stream.com/ucbau.mp3">Low quality</option>
			</select>
			
			<div class="player">
				<a href="#" class="play">Play</a>
				<a href="#" class="pause">Pause</a>
				<a href="#" class="stop">Stop</a>
				
				<audio class="audio" src=""></audio>
			</div>

			<?php the_content(); ?>
		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	
	</div>
	
</body>
<?php wp_footer(); ?>
</html>