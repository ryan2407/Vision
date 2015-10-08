<?php switch_to_blog(1); ?>
<?php $getTestimonyNumber = get_field('how_many_testimonies', 'widget_'.$args['widget_id']); ?>

<div class="image">
	<?php $imgSrc = wp_get_attachment_image_src(get_field('widget_image', 'widget_'.$args['widget_id']), 'full'); ?>
	<img src="<?php echo $imgSrc[0]; ?>" width="100%">
		<div class="floated" style="background: -webkit-linear-gradient(rgba(255,255,255,0), <?php echo get_field('text_background_colour', 'widget_'.$args['widget_id']); ?>);">
			<div class="content">
				<?php the_field('widget_text', 'widget_'.$args['widget_id']); ?>
			</div>
		</div>
</div>
<?php restore_current_blog(); ?>

<?php switch_to_blog(5); ?>
	
	<?php 
	// the query
	$the_query = new WP_Query( array(
		'post_type' => 'prayer_testimonies',
		'posts_per_page' => $getTestimonyNumber
	) ); ?>
	
	<?php if ( $the_query->have_posts() ) : ?>
	
		<!-- pagination here -->
	
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php endwhile; ?>
		<!-- end of the loop -->
	
		<!-- pagination here -->
	
		<?php wp_reset_postdata(); ?>
	
	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	
<?php restore_current_blog(); ?>
