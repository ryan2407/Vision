<?php include_once('header.php'); ?>
	
	<?php if(get_field('video_url')): ?>
		<div class="featuredVideo container" style="padding: 0;">
			<div class="video-container">
				<?php the_field('video_url'); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="container mainContent">

		<div class="primary">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<?php dynamic_sidebar('above-posts'); ?>
			
				<h1><?php the_title(); ?></h1>
				
				<?php if(get_field('featured_image')): ?>
						<?php $imgsrc = wp_get_attachment_image_src(get_field('featured_image'), 'full'); ?>
						<img src="<?php echo $imgsrc[0]; ?>" style="width:100%;margin-bottom: 20px;">
				<?php endif; ?>

				<?php the_content(); ?>
				
				<?php get_template_part('author'); ?>
				
			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
			
			<?php dynamic_sidebar('below-posts'); ?>
		</div><!-- end primary -->

		<?php get_template_part('sidebar'); ?>

		<div style="clear:both"></div>
	</div>

<?php include_once('footer.php'); ?>