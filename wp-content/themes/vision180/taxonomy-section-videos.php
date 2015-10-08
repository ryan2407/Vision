<?php include_once('header.php'); ?>

	<div class="container mainContent">
		
		<div class="featuredVideo">
			<h1><?php the_title(); ?></h1>
			<div class="video-container">
				<?php the_field('video_url'); ?>
			</div>
			<p><?php the_field('video_description'); ?></p>
		</div>

		<div class="primary">
			
			<h2>More videos like this</h2>
			
			<p>Load related videos here</p>
			
<!--
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>
			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
-->
		</div><!-- end primary -->

		<div class="secondary">
		</div>

		<div style="clear:both"></div>
	</div>

<?php include_once('footer.php'); ?>