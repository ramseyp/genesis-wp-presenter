<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'WP Presenter' );
define( 'CHILD_THEME_URL', 'http://www.slide25.com/' );

// Setup the child theme
add_action('after_setup_theme','child_theme_setup');
function child_theme_setup() {
	
	// Admin (Backend) Setup first
	
	// Change the labeling for the "Posts" menu to "Slides"
	add_action( 'init', 'crm_change_post_object_label' );
	add_action( 'init', 's25_change_categories_label' );
	add_action( 'admin_menu', 'crm_change_post_menu_label' );
	// Change post title text
	add_action( 'gettext', 'crm_change_title_text' );

	// Unregister layout settings
	genesis_unregister_layout( 'content-sidebar' );
	genesis_unregister_layout( 'sidebar-content' );
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );

	// Unregister unnecessary sidebars
	unregister_sidebar('sidebar-alt');
	unregister_sidebar('sidebar');
	unregister_sidebar('header-right');

	// Force defaults for certain Genesis settings
	add_filter('genesis_options', 'define_genesis_setting_custom', 10, 2);
	function define_genesis_setting_custom($options, $setting) {
		if($setting == GENESIS_SETTINGS_FIELD) {
			$options['nav'] = 0;
			$options['nav_superfish'] = 0;
			$options['breadcrumb_home'] = 0;
			$options['breadcrumb_single'] = 0;
			$options['breadcrumb_page'] = 0;
			$options['breadcrumb_archive'] = 0;
			$options['breadcrumb_404'] = 0;
		}
	return $options;
	}
		
	// Setup new sidebars for the footer
	genesis_register_sidebar( array(
		'id'			=> 'homepage',
		'name'			=> __( 'Homepage', 'genesis' ),
		'description'	=> __( '' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'footer-bottom-left',
		'name'			=> __( 'Footer Bottom Left', 'genesis' ),
		'description'	=> __( '' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'footer-bottom-mid',
		'name'			=> __( 'Footer Bottom Mid', 'genesis' ),
		'description'	=> __( '' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'footer-bottom-right',
		'name'			=> __( 'Footer Bottom Right', 'genesis' ),
		'description'	=> __( '' ),
	) );

	
	// Frontend setup
	
	// Add necessary wrapper div
/*	add_action( 'genesis_before_content_sidebar_wrap','s25_1140_container');
	function s25_1140_container() {
		echo '<div class="twelvecol">';
	}
*/
	// Close necessary wrapper div
/*	add_action( 'genesis_after_content_sidebar_wrap','s25_close_1140_container');
	function s25_close_1140_container() {
		echo '</div>';
	}
*/
	// Load javascripts & CSS
	add_action('init','my_scripts');
	function my_scripts() {
		if ( !is_admin() ) { 
			$theme  = get_theme( get_current_theme() );
			$css_loc = CHILD_URL.'/lib/css/';
			// CSS
			wp_register_style('flexslide',$css_loc.'flexslider.css', array(), $theme['Version'], 'screen');
			wp_register_style('i140',$css_loc.'1140.css', array(), $theme['Version'], 'screen');
			//wp_register_style('ie',$css_loc.'ie.css', array(), $theme['Version'], 'screen');
			wp_enqueue_style('i140');
			//wp_enqueue_style('ie');
			wp_enqueue_style('flexslide');
			// Javascripts
			$js_loc = CHILD_URL.'/lib/js/';
			wp_register_script('flexslider', $js_loc.'jquery.flexslider-min.js', array('jquery'), '1.8',false);
			wp_register_script('modernizr', $js_loc.'modernizr.custom.97724.js', array('jquery'), '97724',false);
			wp_register_script('slide25', $js_loc.'slide25.js', array('jquery'), '1.0',false);
			wp_enqueue_script('modernizr');
			wp_enqueue_script('flexslider');
			wp_enqueue_script('slide25');
		}
	}

	// Setup Shortcodes
	include_once( CHILD_DIR . '/lib/functions/shortcodes.php');

	//Remove the right-hand items from Main Navigation
	remove_filter('genesis_nav_items', 'genesis_nav_right', 10, 2);
	remove_filter('wp_nav_menu_items', 'genesis_nav_right', 10, 2);	
	
	// remove post info & meta
	remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
	remove_action( 'genesis_before_post_content', 'genesis_post_info' );
	
	// remove site description
	remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
	
	// Customize the entire footer 
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	add_action( 'genesis_footer', 'child_do_footer' );
	function child_do_footer() {
		echo '<p>&copy; Copyright ' . date('Y') . '</p>';
	}

	// Change the Comments' "Speak your mind" text
	add_filter( 'genesis_comment_form_args', 'custom_comment_form_args' );
	function custom_comment_form_args($args) {
		$args['title_reply'] = 'Comment on this slide';
	return $args;
	}



}

/**
 * Change post title text
 *
 * @author Andrew Norcross
 * @link http://www.billerickson.net/twentyten-crm/
 */
function crm_change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Slides';
	$submenu['edit.php'][5][0] = 'Slides';
	$submenu['edit.php'][10][0] = 'Add Slides';
	$submenu['edit.php'][15][0] = 'Presentations';
	echo '';
}
function crm_change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Slides';
	$labels->singular_name = 'Slide';
	$labels->add_new = 'Add Slide';
	$labels->add_new_item = 'Add Slide';
	$labels->edit_item = 'Edit Slide';
	$labels->new_item = 'Slide';
	$labels->view_item = 'View Slide';
	$labels->search_items = 'Search Slides';
	$labels->not_found = 'No Slides found';
	$labels->not_found_in_trash = 'No Slides found in Trash';
}

function s25_change_categories_label() {
	global $wp_taxonomies;
	$labels = &$wp_taxonomies['category']->labels;
	$labels->name = 'Presentations';
	$labels->singular_name = 'Presentation';
	$labels->add_new = 'Add New Presentation';
	$labels->add_new_item = 'Add Presentation';
	$labels->edit_item = 'Edit Presentation';
	$labels->new_item = 'Presentation';
	$labels->view_item = 'View Presentation';
	$labels->search_items = 'Search Presentations';
	$labels->not_found = 'No Presentations found';
	$labels->not_found_in_trash = 'No Presentations found in Trash';
}

function crm_change_title_text( $translation ) {
	global $post;
	if( isset( $post ) ) {
		switch( $post->post_type ){
			case 'post' :
				if( $translation == 'Enter title here' ) return 'Enter Slide Title Here';
			break;
		}
	}
	return $translation;
}

// Set number of posts per page to be one
/*add_filter('pre_get_posts', 'filter_page_posts');
function filter_page_posts($query) {
	$limit_number_of_posts = -1;
	if ( $query->is_home || $query->is_archive ) {
		$query->set( 'posts_per_page', $limit_number_of_posts );
		//$query->set( 'order','DESC' );
		$query->set( 'orderby','date' );
		$query->set( 'ignore_sticky_posts', 1 );
		}
	//ignore_sticky_posts
	return $query;
}*/
/**
 * Customize Event Query using Post Meta
 * 
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */

add_action( 'pre_get_posts', 'be_event_query' );
function be_event_query( $query ) {
	if( $query->is_main_query() && !is_admin() && is_archive() ) {
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', '-1' );
	}
}


// Force pages to be full width layout
add_filter('genesis_pre_get_option_site_layout', 's25_full_width_layout');
function s25_full_width_layout($layout) {
	$layout = 'full-width-content';
	return $layout;
}

// Custom page navigation
remove_action('genesis_after_endwhile', 'genesis_posts_nav');
