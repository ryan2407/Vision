<?php namespace VisionMedia\ImageWidget;

class ImageWidget extends \WP_Widget {

	function __construct()
	{
		parent::__construct(
			'image_widget', // Base ID
			__( 'Vision Apps: Image Widget', 'image_widget' ), // Name
			array( 'description' => __( 'This widget creates a responsive image with an optional logo and description', 'image_widget' ), ) // Args
		);
		add_action('admin_enqueue_scripts', array($this, 'loadScripts'));
	}

	public function loadScripts()
	{
		wp_enqueue_script('media-upload'); //Provides all the functions needed to upload, validate and give format to files.
		wp_enqueue_script('thickbox'); //Responsible for managing the modal window.
		wp_enqueue_style('thickbox'); //Provides the styles needed for this window.
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script('upload_media_widget', plugin_dir_url(__FILE__) . '/js/upload-media.js', array('jquery'));
	}

	public function widget( $args, $instance )
	{
		wp_enqueue_style('image-widget-styles', plugins_url('styles.css', __FILE__));
		echo $args['before_widget'];
//		if ( ! empty( $instance['title'] ) ) {
//			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
//		}
		include(plugin_dir_path( __FILE__ ).'/views/widget-view.php');
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'widget_title' );
		$image = ! empty( $instance['image'] ) ? $instance['image'] : __( 'Image', 'image' );
		$url = ! empty( $instance['url'] ) ? $instance['url'] : __( '', 'url' );
		$text = ! empty( $instance['text'] ) ? $instance['text'] : __( '', 'text' );
		$colour = ! empty( $instance['colour'] ) ? $instance['colour'] : __( '', 'colour' );
		$float = ! empty( $instance['float'] ) ? $instance['float'] : __( '', 'float' );
		include(plugin_dir_path( __FILE__ ).'/views/widget-form.php');
	}

	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
		$instance['colour'] = ( ! empty( $new_instance['colour'] ) ) ? strip_tags( $new_instance['colour'] ) : '';
		$instance['float'] = ( ! empty( $new_instance['float'] ) ) ? strip_tags( $new_instance['float'] ) : '';

		return $instance;
	}

}