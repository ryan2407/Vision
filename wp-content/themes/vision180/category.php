<?php include_once('header.php'); ?>

<?php dynamic_sidebar('full-width-top'); ?>

	<div class="container mainContent">

		<div class="primary">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="entry">
					<h1><?php the_title(); ?></h1>
					
					<?php if(get_field('featured_image')): ?>
						<?php $imgsrc = wp_get_attachment_image_src(get_field('featured_image'), 'full'); ?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $imgsrc[0]; ?>" style="width:100%;margin-bottom: 20px;"></a>
					<?php endif; ?>
					
					<?php if(get_field('video_url')): ?>
						<div class="featuredVideo">
							<div class="video-container">
								<?php the_field('video_url'); ?>
							</div>
						</div>
					<?php endif; ?>
	
					<?php the_excerpt(); ?>
					
					<div style="clear:both"></div>
				
				</div>

			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div><!-- end primary -->

		<div class="secondary">
			<?php dynamic_sidebar('page-widget'); ?>
		</div>

		<div style="clear:both"></div>
	</div>

<?php include_once('footer.php'); ?>