<?php namespace VisionMedia\NowPlayingWidget;

class NowPlayingWidget extends \WP_Widget {

	function __construct()
	{
		parent::__construct(
			'nowplaying_widget', // Base ID
			__( 'Vision Apps: Now Playing Widget', 'nowplaying_widget' ), // Name
			array( 'description' => __( 'This widget displays what is currently playing on vision radio', 'nowplaying_widget' ), ) // Args
		);
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
		add_action( 'wp_ajax_nopriv_nowplaying', array($this, 'NowPlaying'));
		add_action( 'wp_ajax_nowplaying', array($this, 'NowPlaying'));
		add_shortcode( 'nowplaying', array($this, 'ShortCode') );
	}

	public function loadScripts()
	{
		wp_enqueue_script('nowplaying_widget', plugin_dir_url(__FILE__) . '/js/nowplayingAjax.js', array('jquery'));
		wp_localize_script( 'nowplaying_widget', 'VisionMedia', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function NowPlaying()
	{
		$url = 'http://dev.vision.org.au/radio-api/json/now.php';
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL, $url);
		// Execute
		$result = curl_exec($ch);
		// Closing
		curl_close($ch);

		// Will dump a beauty json :3
		$nowPlaying = json_decode($result, true);
		include(plugin_dir_path( __FILE__ ).'/views/widget-ajax.php');
		wp_die();
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
	
	public function ShortCode()
	{
		include(plugin_dir_path( __FILE__ ).'/views/widget.php');
	}

}