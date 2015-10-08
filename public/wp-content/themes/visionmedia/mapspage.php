<?php /* Template Name: Google Maps Page */ ?>

<?php include_once('header.php'); ?>

	<div class="container mainContent">

		<div class="primary">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>

				<?php the_field('google_code'); ?>

				<h3><?php the_field('some_text_field'); ?></h3>
				<?php echo wp_get_attachment_image( get_field('some_image_field'), 'thumbnail' ); ?>
			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div><!-- end primary -->

		<div class="secondary">
			<h3>WIDGET AREA</h3>
		</div>

		<div style="clear:both"></div>
	</div>

<?php include_once('footer.php'); ?>