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
		'name'          => 'Above posts widget area',
		'id'            => 'above-posts',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Below posts widget area',
		'id'            => 'below-posts',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Station sidebar widget area',
		'id'            => 'sation-sidebar-widget',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Standard Page Widget Area',
		'id'            => 'page-widget',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Full Width Top Widget Area',
		'id'            => 'full-width-top',
		'before_widget' => '<div class="widget container" style="padding:0px;">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="title">',
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


add_action( 'init', 'create_station_posttype' );
function create_station_posttype() {
	register_post_type( 'radio_stations',
		array(
			'labels' => array(
				'name' => __( 'Stations' ),
				'singular_name' => __( 'Station' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'stations'),
			'menu_icon' => 'dashicons-microphone'
		)
	);
}

function my_theme_add_editor_styles() {
    add_editor_style( '../globalelements/editor.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );


function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

$labels = array(
		'name'              => _x( 'Sections', 'sections' ),
		'singular_name'     => _x( 'Section', 'section' ),
		'search_items'      => __( 'Search Sections' ),
		'all_items'         => __( 'All Sections' ),
		'parent_item'       => __( 'Parent Section' ),
		'parent_item_colon' => __( 'Parent Section:' ),
		'edit_item'         => __( 'Edit Section' ),
		'update_item'       => __( 'Update Section' ),
		'add_new_item'      => __( 'Add New Section' ),
		'new_item_name'     => __( 'New Section Name' ),
		'menu_name'         => __( 'Section' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'section' ),
	);

	register_taxonomy( 'section', array( 'post' ), $args );
	

/*
$labels = array(
		'name'              => _x( 'Topics', 'topics' ),
		'singular_name'     => _x( 'Topic', 'topic' ),
		'menu_name'         => __( 'Topic' ),
	);

$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'topic' ),
	);
	
register_taxonomy( 'topic', array( 'post' ), $args );
*/
	
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> <strong>KEEP READING >></strong></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/*===================================================================================
 * Add Author Links
 * =================================================================================*/
function add_to_author_profile( $contactmethods ) {
	
	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);