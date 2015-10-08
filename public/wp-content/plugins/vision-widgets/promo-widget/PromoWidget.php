<?php namespace VisionMedia\PromoWidget;

class PromoWidget extends \WP_Widget {

	function __construct() {
		parent::__construct(
			'promo_widget', // Base ID
			__( 'Vision Apps: Promo Widget', 'promo_widget' ), // Name
			array( 'description' => __( 'This widget shows promo content from other sites', 'promo_widget' ), ) // Args
		);
//		add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
//		add_action( 'wp_ajax_nopriv_nowplaying', [$this, 'NowPlaying'] );
//		add_action( 'wp_ajax_nowplaying', [$this, 'NowPlaying'] );
	}

	public function widget( $args, $instance )
	{
		echo $args['before_widget'];
//		if ( ! empty( $instance['title'] ) ) {
//			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
//		}

		include(plugin_dir_path( __FILE__ ).'/views/widget.php');

		echo $args['after_widget'];
	}

}