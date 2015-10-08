<?php if(get_field('accordian')): ?>
				
	<div class="accordianContainer">
		<?php while(the_repeater_field('accordian')): ?>
			<div class="accordianItem">
				<div class="accordianHeading">
					<h3><?php the_sub_field('accordian_heading'); ?></h3>
				</div>
				
				<div class="accordianContent">
					<?php the_sub_field('accordian_wysiwyg'); ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>

<?php endif; ?>