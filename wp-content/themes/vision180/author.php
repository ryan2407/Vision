<div class="author">
	<h2>About the author</h2>
	<div class="authorMeta">
		<div style="width: 20%;float:left;">
			<?php echo get_avatar(get_the_author_meta( 'ID' )); ?> 
		</div>
		<div style="width: 77%;float: right;">
			<div style="width: 60%;float:left;">
				<h3><?php the_author_meta( 'display_name' ); ?></h3>
			</div>
			<div style="width: 35%;float:right;">
				<div class="author-icons">
					<?php if(get_the_author_meta( 'facebook_profile' )): ?>
						<div><a href="<?php the_author_meta( 'facebook_profile' ); ?>"><img src="<?php echo bloginfo('template_directory'); ?>/images/facebook.jpg" width="25"></a></div>
					<?php endif; ?>
					<?php if(get_the_author_meta( 'twitter_profile' )): ?>
						<div><a href="<?php the_author_meta( 'twitter_profile' ); ?>"><img src="<?php echo bloginfo('template_directory'); ?>/images/twitter.jpg" width="25"></a></div>
					<?php endif; ?>
					<?php if(get_the_author_meta( 'google_profile' )): ?>
						<div><a href="<?php the_author_meta( 'google_profile' ); ?>"><img src="<?php echo bloginfo('template_directory'); ?>/images/google.jpg" width="25"></a></div>
					<?php endif; ?>
					<?php if(get_the_author_meta( 'linkedin_profile' )): ?>
						<div><a href="<?php the_author_meta( 'linkedin_profile' ); ?>"><img src="<?php echo bloginfo('template_directory'); ?>/images/linkedin.jpg" width="25"></a></div>
					<?php endif; ?>
				</div>
			</div>
			<div style="clear:both;"></div>
			<?php the_author_meta( 'user_description' ); ?>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="relatedAuthorPosts">
	<h2>MORE GREAT READS FROM <span style="text-transform: uppercase;"><?php the_author_meta( 'display_name' ); ?></span></h2>
	
	<?php 
	// the query
	$the_query = new WP_Query( array('author' => get_the_author_meta( 'ID' )) ); ?>
	
	<?php if ( $the_query->have_posts() ) : ?>
	
		<!-- pagination here -->
	
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="authorEntry">
				<div style="width: 25%;float:left;">
					<?php if(get_field('featured_image')): ?>
						<?php $imgsrc = wp_get_attachment_image_src(get_field('featured_image'), 'full'); ?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $imgsrc[0]; ?>" style="width:100%;margin-bottom: 20px;"></a>
					<?php endif; ?>
					<?php if(get_field('video_url')): ?>
						<a href="<?php the_permalink(); ?>"><img src="http://img.youtube.com/vi/JGhoLcsr8GA/hqdefault.jpg" style="width:100%;margin-bottom: 20px;"></a>
					<?php endif; ?>
				</div>
				<div style="width: 72%;float:right;">
					<p><strong><?php the_title(); ?></strong></p>
					<p><?php the_excerpt(); ?></p>
				</div>
				<div style="clear: both;"></div>
			</div><!-- end authorEntry -->
		<?php endwhile; ?>
		<!-- end of the loop -->
	
		<!-- pagination here -->
	
		<?php wp_reset_postdata(); ?>
	
	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
</div>