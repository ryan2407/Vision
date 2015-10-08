<?php namespace VisionGeoip;
/**
 * @package Vision_Geoip
 * @version 1.0
 */
/*
Plugin Name: Vision GeoIP
Description: This plugin is used to create a global geolocation object on all content so we can do stuff with it based
on location and timezone stuff...
Author: Ryan Murray
Version: 1.0
*/


use VisionGeoip\VisionGeoip\GeoIp;

require 'vendor/autoload.php';

new GeoIp();