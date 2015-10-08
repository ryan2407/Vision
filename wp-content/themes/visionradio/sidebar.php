<div class="secondary">
	<?php if(is_singular('radio_stations')): ?>
	
	<?php if( have_rows('frequencies') ): ?>
		<div class="frequencies">
			<h2>Frequencies</h2>
			
				<?php while ( have_rows('frequencies') ) : the_row(); ?>
					<p><?php the_sub_field('frequency'); ?></br>
					<?php the_sub_field('power'); ?></p>
					<hr>
				<?php endwhile; ?>
			
			
			
		</div>
		<?php endif; ?>
		
		<?php dynamic_sidebar('station-sidebar-widget'); ?>
	
	<?php endif; ?>
</div>