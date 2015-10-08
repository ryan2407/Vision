<?php include_once('header.php'); ?>

<?php include_once(get_theme_root().'/globalelements/slideshow.php'); ?>

<div class="container mainContent">

	<div class="primary">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>

			<?php the_content(); ?>
		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div><!-- end primary -->

	<div class="secondary">
		<?php dynamic_sidebar('twft-widget'); ?>
	</div>

	<div style="clear:both"></div>
</div>


<?php include_once('footer.php'); ?>