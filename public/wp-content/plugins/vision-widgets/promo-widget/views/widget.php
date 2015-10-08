<h1>Promo Stuff</h1>

<?php

global $wpdb;
$results = $wpdb->get_results('SELECT * FROM sup2_network_posts WHERE post_type = "vision_promos" AND post_status = "publish"', 'OBJECT');

foreach($results as $result) {

	$meta = $wpdb->get_results('SELECT * FROM sup2_network_postmeta WHERE post_id = '.$result->ID.' and meta_key = "vision_sites"', 'OBJECT');

	foreach($meta as $meta) {
		$blog_id = unserialize($meta->meta_value);
		foreach($blog_id as $blog_id) {
			if ( $blog_id == get_current_blog_id() ) {
				echo '<p>' . $result->post_title . '</p>';
				echo '<p>' . $result->post_content . '</p>';
			}
		}
	}
}

