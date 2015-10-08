<?php

function vision_widgets_init() {
/*
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
*/
	
	register_sidebar( array(
		'name'          => 'TWFT Widget',
		'id'            => 'twft-widget',
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

function my_theme_add_editor_styles() {
    add_editor_style( '../globalelements/editor.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );

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