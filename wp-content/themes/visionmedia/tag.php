<?php include_once('header.php'); ?>

	<div class="container mainContent">

		<div class="primary">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php the_excerpt(); ?>
				
				<div style="clear:both"></div>
				
				<hr>

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