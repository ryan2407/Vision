<?php namespace VisionAlgolia\AlgoliaIndex;

use AlgoliaSearch\Client;

class AlgoliaIndex {

	public function __construct()
	{
		add_action('save_post', array($this, 'runIndex'));
		add_action('wp_trash_post', array($this, 'deletePost'));
	}

	public function runIndex($post_id)
	{
		$post = get_post($post_id);
		
		if ( wp_is_post_revision( $post_id ) )
			return;
		
		if($post->post_type != 'nav_menu_item') {
			$client = new Client( 'NROWAPEEW3', '6e4bffbe64f9f15550f1aa0f73aea3c0' );
	
			$index = $client->initIndex( 'VisionDevIndex' );
	
			$batch = array(
				array(
					'objectID' => $post->ID . get_current_blog_id(),
					'post_title' => $post->post_title,
					'post_content' => $post->post_content,
					'permalink' => $post->guid
				)
			);
	
			$index->saveObjects( $batch );
		}
	}
	
	public function deletePost($post_id)
	{
		$post = get_post($post_id);
		
		if($post->post_type != 'nav_menu_item') {
			$client = new Client( 'NROWAPEEW3', '6e4bffbe64f9f15550f1aa0f73aea3c0' );
	
			$index = $client->initIndex( 'VisionDevIndex' );
			$index->deleteObject($post->ID . get_current_blog_id());	
		}
	}

}