<?php $current_id = get_current_blog_id(); ?>
<?php switch_to_blog(1); ?>
	
	
<div class="slideshow">	
<?php 
// the query
$the_query = new WP_Query( array('post_type' => 'slideshow') ); ?>

<?php if ( $the_query->have_posts() ) : ?>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

	<?php if( have_rows('slides') ): ?>
		<?php while ( have_rows('slides') ) : the_row(); ?>
		
			<?php $site_selctor = get_sub_field('site_selector'); ?>
		
			<?php if(in_array($current_id, $site_selctor)): ?>
			
				<?php $imgurl = get_sub_field('image'); ?>
				
				<?php $serverTimestamp = strtotime(date('Y-m-d')); ?>
				<?php $slideTimestampStart = strtotime(get_sub_field('start_date')); ?>
				<?php $slideTimestampEnd = new DateTime(get_sub_field('end_date')); ?>
				<?php $slideTimestampEnd->sub(new DateInterval('P2D')); ?>
				<?php $endTime = strtotime($slideTimestampEnd->format('Y-m-d')); ?>
													
				<?php if($serverTimestamp >= $slideTimestampStart && $serverTimestamp <= $endTime || ! $endTime): ?>
					<div class="slide" style="background: url('<?php echo $imgurl['url']; ?>') no-repeat;background-size:cover;">
						<div class="container">
							<div class="slideText">
								<div class="topText">
									<h1><strong><?php the_sub_field('heading'); ?></strong></h1>
									<h2><?php the_sub_field('sub_heading'); ?></h2>
								</div><!-- end topText -->
								<div class="bottomText">
									<?php the_sub_field('text'); ?>
								</div><!-- end bottomText -->
							</div><!-- end slideText -->
						</div><!-- end container -->
					</div><!-- end slide -->
				<?php endif; ?>
				
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
	
<?php endwhile;// END LOOP ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

	<div class="pager">
	</div>

	<div class="prevNext">
		<div class="prev"></div>
		<div class="next"></div>
	</div>
</div><!-- end slideshow -->

<?php restore_current_blog(); ?>