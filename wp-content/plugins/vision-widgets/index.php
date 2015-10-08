<?php namespace VisionMedia;

	/**
 * @package Vision_widgets
 * @version 1.0
 */
/*
Plugin Name: Vision Widgets
Description: The various widgets for the Vision Media website
Author: Ryan Murray
Version: 1.0
*/


new VisionMediaWidgets();
require plugin_dir_path(__FILE__).'image-widget/ImageWidget.php';
require plugin_dir_path(__FILE__).'testimony-widget/TestimonyWidget.php';
require plugin_dir_path(__FILE__).'now_playing_widget/NowPlayingWidget.php';
require plugin_dir_path(__FILE__).'now_playing_180_widget/NowPlaying180Widget.php';
require plugin_dir_path(__FILE__).'last_played_widget/LastPlayedWidget.php';
require plugin_dir_path(__FILE__).'last_played_180_widget/LastPlayed180Widget.php';
require plugin_dir_path(__FILE__).'promo-widget/PromoWidget.php';
require plugin_dir_path(__FILE__).'epg-widget/EpgWidget.php';

class VisionMediaWidgets {

	public function __construct()
	{
		add_action( 'widgets_init', function(){
			register_widget( 'VisionMedia\ImageWidget\ImageWidget' );
			register_widget( 'VisionMedia\TestimonyWidget\TestimonyWidget' );
			register_widget( 'VisionMedia\NowPlayingWidget\NowPlayingWidget' );
			register_widget( 'VisionMedia\NowPlaying180Widget\NowPlaying180Widget' );
			register_widget( 'VisionMedia\LastPlayedWidget\LastPlayedWidget' );
			register_widget( 'VisionMedia\LastPlayed180Widget\LastPlayed180Widget' );
			register_widget( 'VisionMedia\PromoWidget\PromoWidget' );
			register_widget( 'VisionMedia\EpgWidget\EpgWidget' );
		});

	}



}
