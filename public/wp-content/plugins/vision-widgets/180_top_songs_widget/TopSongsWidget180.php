<?php namespace VisionMedia\TopSongsWidget180;


class TopSongsWidget180  extends \WP_Widget {

	function __construct()
	{
		parent::__construct(
			'topsongs_180_widget', // Base ID
			__( 'Vision Apps: Top Songs Vision 180', 'topsongs_180_widget' ), // Name
			array( 'description' => __( 'This widget displays the top songs for vision 180', 'topsongs_180_widget' ), ) // Args
		);
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
		add_action( 'wp_ajax_nopriv_topsongs180', array($this, 'TopSongs180'));
		add_action( 'wp_ajax_topsongs180', array($this, 'TopSongs180'));
		add_shortcode( 'topsongs180', array($this, 'ShortCode180') );
	}

	public function loadScripts()
	{
		wp_enqueue_script('topsongs_180_widget', plugin_dir_url(__FILE__) . '/js/topsongs180Ajax.js', array('jquery'));
		wp_localize_script( 'topsongs_180_widget', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function TopSongs180()
	{

		$top = '10';
		if(isset($_POST['top'])) {
			$top = $_POST['top'];
		}

		$url = 'http://dev.vision.org.au/radio-api/json/180_top_songs.php?top='.$top;
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
		$topSongs = json_decode($result, true);
		include(plugin_dir_path( __FILE__ ).'/views/widget-ajax.php');
		wp_die();
	}


	public function ShortCode180()
	{
		wp_enqueue_style('shortcode-ui', plugins_url('shortcode_styles.css', __FILE__));
		include(plugin_dir_path( __FILE__ ).'/views/widget.php');
	}
}