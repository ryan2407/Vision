<?php namespace VisionMedia\LastPlayed180Widget;

class LastPlayed180Widget extends \WP_Widget {

	function __construct()
	{
		parent::__construct(
			'lastplayed_180_widget', // Base ID
			__( 'Vision Apps: Last Played', 'lastplayed_180_widget' ), // Name
			array( 'description' => __( 'This widget displays what was last played', 'lastplayed_180_widget' ), ) // Args
		);
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
		add_action( 'wp_ajax_nopriv_lastplayed180', array($this, 'LastPlayed'));
		add_action( 'wp_ajax_lastplayed180', array($this, 'LastPlayed'));
		add_shortcode( 'lastplayed180', array($this, 'ShortCode180') );
	}

	public function loadScripts()
	{
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('lastplayed_180_widget', plugin_dir_url(__FILE__) . '/js/lastplayed180Ajax.js', array('jquery'));
		wp_localize_script( 'lastplayed_180_widget', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function LastPlayed()
	{
		//GET THE USERS TIMEZONE
		if(class_exists('VisionGeoip\VisionGeoip\GeoIp')) {
			$geoIp = new \VisionGeoip\VisionGeoip\GeoIp();
			(isset($_POST['tz'])) ? $timezone = $geoIp->index($_POST['tz']) : $timezone = $geoIp->index();
			$target_time_zone = new \DateTimeZone($timezone);
			$date_time = new \DateTime('now', $target_time_zone);
			$tz = $date_time->format('P');
		}
						
		$dc = '';
		$rs = '';
		$re = '';
		$lh = '2';
		if(isset($_POST['lh'])) {
			$lh = $_POST['lh'];
		}
		if(isset($_POST['dc'])) {
			$dc = '&dc='.$_POST['dc'];
		}
		if(isset($_POST['rs'])) {
			$rs = '&rs='.$_POST['rs'];
		}
		if(isset($_POST['re'])) {
			$re = '&re='.$_POST['re'];
		}
		
		$url = 'http://dev.vision.org.au/radio-api/json/180_last_played.php?tz='.$tz.'&lh='.$lh.$dc.$rs.$re;
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
		$lastPlayed = json_decode($result, true);
		include(plugin_dir_path( __FILE__ ).'/views/widget-ajax.php');
		wp_die();
	}

	public function widget( $args, $instance )
	{
		wp_enqueue_style('jquery-ui', plugins_url('datepicker.css', __FILE__));
		wp_enqueue_style('widget-ui', plugins_url('widget_styles.css', __FILE__));
		echo $args['before_widget'];
//		if ( ! empty( $instance['title'] ) ) {
//			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
//		}

		include(plugin_dir_path( __FILE__ ).'/views/widget.php');

		echo $args['after_widget'];
	}
	
	public function ShortCode180()
	{
		wp_enqueue_style('jquery-ui', plugins_url('datepicker.css', __FILE__));
		wp_enqueue_style('shortcode-ui', plugins_url('shortcode_styles.css', __FILE__));
		include(plugin_dir_path( __FILE__ ).'/views/widget.php');
	}

}