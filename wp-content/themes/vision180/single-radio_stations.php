<?php include_once('header.php'); ?>

	<div class="container mainContent">

		<div class="primary">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>
			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div><!-- end primary -->

		<?php get_template_part('sidebar'); ?>

		<div style="clear:both"></div>
	</div>

<?php include_once('footer.php'); ?>