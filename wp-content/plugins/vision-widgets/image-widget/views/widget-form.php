<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
	<label for="<?php echo $this->get_field_name( 'url' ); ?>"><?php _e( 'Link image to URL:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
</p>

<p>
	<label for="<?php echo $this->get_field_name( 'float' ); ?>">Float text over image?</label>
	<br>
	<input name="<?php echo $this->get_field_name( 'float' ); ?>" id="<?php echo $this->get_field_id( 'float' ); ?>" type="checkbox" value="float" <?php if($float): ?>checked<?php endif; ?>>Float
</p>