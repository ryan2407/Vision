<?php

function vision_widgets_init() {
	register_sidebar( array(
		'name'          => 'Home left column',
		'id'            => 'left-column',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Home middle column',
		'id'            => 'middle-column',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Home right column',
		'id'            => 'right-column',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Page widget',
		'id'            => 'page-widget',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'vision_widgets_init' );


function my_scripts_method() {
	wp_enqueue_script(
		'cycle',
		get_stylesheet_directory_uri() . '/js/cycle.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

add_action( 'init', 'create_promo_posttype' );
function create_promo_posttype() {
	register_post_type( 'vision_promos',
		array(
			'labels' => array(
				'name' => __( 'Promotions' ),
				'singular_name' => __( 'Promotion' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'promotion'),
			'menu_icon' => 'dashicons-star-filled'
		)
	);
}

$labels = array(
	'name'              => __( 'Topics' ),
	'singular_name'     => __( 'Topic' ),
	'search_items'      => __( 'Search Topics' ),
	'all_items'         => __( 'All Topics' ),
	'parent_item'       => __( 'Topic' ),
	'parent_item_colon' => __( 'Topic:' ),
	'edit_item'         => __( 'Edit Topic' ),
	'update_item'       => __( 'Update Topic' ),
	'add_new_item'      => __( 'Add New Topic' ),
	'new_item_name'     => __( 'New Topic Name' ),
	'menu_name'         => __( 'Topics' ),
);

$args = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'rewrite'           => array( 'slug' => 'topics' ),
);
register_taxonomy( 'topics', array( 'post' ), $args );

$labels = array(
	'name'              => __( 'Podcasts' ),
	'singular_name'     => __( 'Podcast' ),
	'search_items'      => __( 'Search Podcasts' ),
	'all_items'         => __( 'All Podcasts' ),
	'parent_item'       => __( 'Podcast' ),
	'parent_item_colon' => __( 'Podcast:' ),
	'edit_item'         => __( 'Edit Podcast' ),
	'update_item'       => __( 'Update Podcast' ),
	'add_new_item'      => __( 'Add New Podcast' ),
	'new_item_name'     => __( 'New Podcast Name' ),
	'menu_name'         => __( 'Podcasts' ),
);

$args = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'rewrite'           => array( 'slug' => 'podcasts' ),
);

register_taxonomy( 'podcasts', array( 'post' ), $args );

/*
add_action( 'create_site', 'do_something_or_stop_update', 10, 2 );
function do_something_or_stop_update($term_id, $taxonomy_id){

	$term = get_term($term_id, 'site');

	$db = new PDO('mysql:host=localhost;dbname=vision;charset=utf8', 'root', 'root');
	$statement = $db->prepare('INSERT INTO wp_global_taxonomies (name, slug) VALUES (:name, :slug)');
	$statement->execute(array(
		'name' => $term->name,
		'slug' => $term->slug
	));
}
*/

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

function accordian_post_action($post) {
	
	function vision_accordian_function($atts) {
		include_once(get_template_directory().'/accordian.php');
	}
	
	add_shortcode( get_field('shortcode', get_the_id()), 'vision_accordian_function' );
	return true;
}
add_action( 'wp', 'accordian_post_action' );

function new_excerpt_more( $more ) {
	return ' ...<a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'your-text-domain' ) . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


add_action( 'init', 'create_media_slideshow_posttype' );
function create_media_slideshow_posttype() {
	register_post_type( 'slideshow',
		array(
			'labels' => array(
				'name' => __( 'Slideshow' ),
				'singular_name' => __( 'Slideshow' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slideshow'),
			'menu_icon' => 'dashicons-format-gallery'
		)
	);
}

function my_theme_add_editor_styles() {
    add_editor_style( '../globalelements/editor.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );
