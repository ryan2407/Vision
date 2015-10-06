<?php namespace VisionMedia\TestimonyWidget;

class TestimonyWidget extends \WP_Widget {

	function __construct()
	{
		parent::__construct(
			'testimony_widget', // Base ID
			__( 'Vision Apps: Testimony Widget', 'testimony_widget' ), // Name
			array( 'description' => __( 'This widget creates a feed of recent testimonies', 'testimony_widget' ), ) // Args
		);
	}


	public function widget( $args, $instance )
	{
		wp_enqueue_style('testimony-widget-styles', plugins_url('styles.css', __FILE__));
		echo $args['before_widget'];
		include(plugin_dir_path( __FILE__ ).'/views/widget-view.php');
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		
		include(plugin_dir_path( __FILE__ ).'/views/widget-form.php');
	}

	public function update( $new_instance, $old_instance )
	{
		$instance = array();

		return $instance;
	}

}