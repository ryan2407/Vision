<?php include_once('header.php'); ?>

	<div class="container mainContent">

		<div class="primary">
			
			<?php 
			// the query
			$year     = get_query_var('year');
			$monthnum = get_query_var('monthnum');
			$day      = get_query_var('day');
			$the_query = new WP_Query( array(
				'category_name' => 'todays-soulfood-bible-in-a-year-content,word4today-devotional-content', 
				'date_query' => array(
					array(
						'year'  => $year,
						'month' => $monthnum,
						'day'   => $day,
					)
				)
			)); ?>
			
			<?php if ( $the_query->have_posts() ) : ?>
			
				<!-- pagination here -->
			
				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<!-- end of the loop -->
			
				<!-- pagination here -->
			
				<?php wp_reset_postdata(); ?>
			
			<?php else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
			
		</div><!-- end primary -->

		<?php get_template_part('sidebar'); ?>

		<div style="clear:both"></div>
	</div>

<?php include_once('footer.php'); ?>