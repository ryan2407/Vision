<div class="navWrapper">
	<div class="nav">
		<ul>
			<?php $blogId = get_current_blog_id(); ?>
			<?php if($blogId != 1): ?>
				<li><a class="radio" href="/"><img src="<?php echo get_theme_root_uri(); ?>/visionmedia/images/vision-home.png" width="90" alt="Vision Radio"></a></li>
			<?php endif; ?>
			
			<?php if($blogId != 6): ?>
				<li><a class="radio" href="/christian-radio"><img src="<?php echo bloginfo('template_directory'); ?>/images/radio.png" width="90" alt="Vision Radio"></a></li>
			<?php endif; ?>
			
			<?php if($blogId != 5): ?>
				<li><a class="prayer" href="/prayer"><img src="<?php echo bloginfo('template_directory'); ?>/images/prayer.png" width="90" alt="Prayer"></a></li>
			<?php endif; ?>
			
			<?php if($blogId != 4): ?>
				<li><a class="tours" href="/tours"><img src="<?php echo bloginfo('template_directory'); ?>/images/tours.png" width="90" alt="Tours"></a></li>
			<?php endif; ?>
			
			<li><a class="store" href="http://store.vision.org.au"><img src="<?php echo bloginfo('template_directory'); ?>/images/store.png" width="90" alt="Vision Store"></a></li>
			
			<?php if($blogId != 2): ?>
				<li><a class="wordForToday" href="/the-word-for-today"><img src="<?php echo bloginfo('template_directory'); ?>/images/word-for-today.png" width="90" alt="Word for today"></a></li>
			<?php endif; ?>
			
			<li><a class="visionOneEighty" href="/vision180"><img src="<?php echo bloginfo('template_directory'); ?>/images/180.png" width="90" alt="Vision 180"></a></li>
			<li><a class="heartOfVision" href="#"><img src="<?php echo bloginfo('template_directory'); ?>/images/heart-of-vision.png" width="90" alt="Heart of vision"></a></li>
		</ul>
	</div><!-- end nav -->

	<div style="clear:both;"></div>

	<div class="subnav">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
	</div><!-- end subnav -->
</div><!-- end navWrapper -->