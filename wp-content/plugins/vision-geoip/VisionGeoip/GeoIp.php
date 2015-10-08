<?php namespace VisionGeoip\VisionGeoip;

use GeoIp2\Database\Reader;

class GeoIp {

	public function __construct()
	{
		if(!is_admin()) {
			add_action('init', array($this, 'index'));
		}
	}

	public function index($tz = null)
	{
		if(! $tz) {
			$ip = $_SERVER['REMOTE_ADDR'];
			$path   = plugin_dir_path( __FILE__ ) . '../GeoLite2-City.mmdb';
			$reader = new Reader( $path );

			$record = $reader->city( $ip );
			$timezone = $record->location->timeZone;
			
			if(! $timezone) {
				$timezone = 'Australia/Brisbane';
			}
			
			return $timezone;
		}
		
		if($tz) {
			return $tz;
		}
	}

}