<?php namespace VisionMedia\EpgWidget;

class EpgWidget extends \WP_Widget {

	function __construct()
	{
		parent::__construct(
			'epg_widget', // Base ID
			__( 'Vision Apps: EPG Widget', 'epg_widget' ), // Name
			array( 'description' => __( 'This widget displays a searchable Electronic Program Guide', 'epg_widget' ), ) // Args
		);
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
		add_action( 'wp_ajax_nopriv_epg', array($this, 'Epg'));
		add_action( 'wp_ajax_epg', array($this, 'Epg'));
		add_shortcode( 'epg', array($this, 'ShortCode') );
	}
	
	public function loadScripts()
	{
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('epg_widget', plugin_dir_url(__FILE__) . '/js/epgAjax.js', array('jquery'));
		wp_localize_script( 'epg_widget', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}


	public function widget( $args, $instance )
	{
		wp_enqueue_style('epg-widget-styles', plugins_url('styles.css', __FILE__));
		echo $args['before_widget'];
		include(plugin_dir_path( __FILE__ ).'/views/widget-view.php');
		echo $args['after_widget'];
	}
	
	function Epg()
	{
		if(class_exists('VisionGeoip\VisionGeoip\GeoIp')) {
			$geoIp = new \VisionGeoip\VisionGeoip\GeoIp();
			(isset($_POST['tz'])) ? $timezone = $geoIp->index($_POST['tz']) : $timezone = $geoIp->index();
			$target_time_zone = new \DateTimeZone($timezone);
			$date_time = new \DateTime('now', $target_time_zone);
			$tz = $date_time->format('P');
		}
		
		$epg = '';
		$dc = '';
		if(isset($_POST['dc'])) {
			$dc = '&dc='.$_POST['dc'];
		}
		
		$url = 'http://dev.vision.org.au/radio-api/json/epg.php?tz='.$tz.$dc;
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
		$epg = json_decode($result, true);
		include(plugin_dir_path( __FILE__ ).'/views/widget-ajax.php');
		wp_die();
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
	
	public function ShortCode()
	{
		wp_enqueue_style('jquery-ui', plugins_url('datepicker.css', __FILE__));
		wp_enqueue_style('shortcode-ui', plugins_url('shortcode_styles.css', __FILE__));
		include(plugin_dir_path( __FILE__ ).'/views/widget-view.php');
	}

}