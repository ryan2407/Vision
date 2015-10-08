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
		'name'          => 'Station sidebar widget',
		'id'            => 'station-sidebar-widget',
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

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


add_action( 'init', 'create_show_posttype' );
function create_show_posttype() {
	register_post_type( 'radio_shows',
		array(
			'labels' => array(
				'name' => __( 'Shows' ),
				'singular_name' => __( 'Show' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'shows'),
			'menu_icon' => 'dashicons-controls-volumeon'
		)
	);
}

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