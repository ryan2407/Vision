<?php
/*
Plugin Name:  Vision Multisite Navigation
Description:  Adds a MetaBox to the Appearance > Menu page to add multsite links
Version:      1.0
Author:       Ryan Murray
*/

add_action( 'plugins_loaded', array( new Multisite_Nav_Links, 'init' ) );

class Multisite_Nav_links {

	/**
	 * Nonce Value
	 * @const \Post_Type_Archive_Links::NONCE
	 */
	const NONCE = 'multisite_nav';

	/**
	 * CPT objects that plugin should handle: having true
	 * 'has_archive', 'publicly_queryable' and 'show_in_nav_menu'
	 * @var array
	 * @access protected
	 */
	protected $sites;
	protected $blogId;

	public function init()
	{
		add_action( 'admin_init', array( $this, 'get_sites' ) );
		add_action( 'admin_init', array( $this, 'add_meta_box' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'metabox_script' ) );
		add_action( "wp_ajax_" . self::NONCE, array( $this, 'ajax_add_multisite_page' ) );
	}

	public function add_meta_box() {

		add_meta_box(
			'multisite-nav-metabox',
			__( 'Multisite Nav', 'multsite-nav' ),
			array( $this, 'metabox' ),
			'nav-menus',
			'side',
			'low'
		);
	}

	public function get_sites() {
		$sites = wp_get_sites();
		$pages = array();

		foreach($sites as $site) {
			switch_to_blog($site['blog_id']);
			$pages[] = array(
				'blog_id' => $site['blog_id'],
				'pages' => get_pages()
			);
			restore_current_blog();
		}
		$this->sites = $pages;
	}

	public function metabox() {

		// Inform user no CPTs available to be shown.
		if ( empty( $this->sites ) ) {
			echo '<p>' . __( 'No items.' ) . '</p>';
			return;
		}

		global $nav_menu_selected_id;

		$html = '<ul id="multisite-nav-list">';
		foreach($this->sites as $site) {
			$blog = get_blog_details($site['blog_id']);
			$html .= '<h4>'.$blog->blogname . ' Pages</h4>';
			foreach ( $site['pages'] as $pt ) {
				$html .= sprintf(
					'<li>
					<label>
					<input type="hidden" name="blogId" value="'.$blog->blog_id.'">
					<input type="checkbox" value="%s" />&nbsp;%s</label></li>',
					$pt->ID,
					$pt->post_title
				);
			}
		}
		$html .= '</ul>';

		// 'Add to Menu' button
		$html .= '<p class="button-controls"><span class="add-to-menu">';
		$html .= '<input type="submit"'. disabled( $nav_menu_selected_id, 0, false ) .' class="button-secondary
			  submit-add-to-menu right" value="'. esc_attr__( 'Add to Menu', 'hptal-textdomain' ) .'"
			  name="add-post-type-menu-item" id="submit-post-type-archives" />';
		$html .= '<span class="spinner"></span>';
		$html .= '</span></p>';

		print $html;
	}

	public function metabox_script( $hook ) {

		wp_register_script(
			'multisite-nav-ajax-script',
			plugins_url( "metabox.js", __FILE__ ),
			array( 'jquery' ),
			filemtime( plugin_dir_path( __FILE__ ) . "metabox.js" ),
			true
		);
		wp_enqueue_script( 'multisite-nav-ajax-script' );

		// Add nonce variable
		wp_localize_script(
			'multisite-nav-ajax-script',
			'multisite_nav_obj',
			array(
				'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				'nonce'      => wp_create_nonce( self::NONCE ),
				'metabox_id' => 'multsite-nav-metabox',
				'metabox_list_id' => 'multisite-nav-list',
				'action'     => self::NONCE
			)
		);
	}

	public function ajax_add_multisite_page()
	{
		switch_to_blog($_POST['blogId']);
			$post = get_post($_POST['ids'][0]);
			$url = get_permalink($post->ID);
		restore_current_blog();
		$item_ids = wp_update_nav_menu_item(0, 0, array(
			'menu-item-title' => esc_attr($post->post_title),
			'menu-item-type' => 'custom',
			'menu-item-url' => $url
		));

		foreach ( (array) $item_ids as $menu_item_id ) {
			$menu_obj = get_post( $menu_item_id );
			if ( ! empty( $menu_obj->ID ) ) {
				$menu_obj = wp_setup_nav_menu_item( $menu_obj );
				// don't show "(pending)" in ajax-added items
				$menu_obj->label = $menu_obj->title;

				$menu_items[] = $menu_obj;
			}
		}

		// Needed to get the Walker up and running
		require_once ABSPATH.'wp-admin/includes/nav-menu.php';

		// This gets the HTML to returns it to the menu
		if ( ! empty( $menu_items ) ) {
			$args = array(
				'after'       => '',
				'before'      => '',
				'link_after'  => '',
				'link_before' => '',
				'walker'      => new Walker_Nav_Menu_Edit
			);

			echo walk_nav_menu_tree(
				$menu_items,
				0,
				(object) $args
			);
		}


		exit;
	}
}