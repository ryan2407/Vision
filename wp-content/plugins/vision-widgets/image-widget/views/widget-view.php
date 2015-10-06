<div class="image">
	<?php $imgSrc = wp_get_attachment_image_src(get_field('image', 'widget_'.$args['widget_id']), 'full'); ?>
	<img src="<?php echo $imgSrc[0]; ?>" width="100%">
	<?php if($instance['float']): ?>
		<div class="floated" style="background: -webkit-linear-gradient(rgba(255,255,255,0), <?php echo get_field('colour', 'widget_'.$args['widget_id']); ?>);">
			<div class="content">
				<?php the_field('content', 'widget_'.$args['widget_id']); ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php if(! $instance['float']): ?>
	<div class="text" style="background: <?php the_field('colour', 'widget_'.$args['widget_id']); ?>">
		<?php the_field('content', 'widget_'.$args['widget_id']); ?>
	</div>
<?php endif; ?>