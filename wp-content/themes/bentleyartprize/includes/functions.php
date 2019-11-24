<?php

add_image_size( 'winner-home-thumb', 646, 782, true );
add_image_size( 'winner-square-thumb', 450, 450, true );
add_image_size( 'gallery-square-thumb', 350, 350, true );

///// disable no need css, js
function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
} 

add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function my_deregister_scripts(){
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


// Remove comment-reply.min.js from footer
function crunchify_clean_header_hook(){
	wp_deregister_script( 'comment-reply' );
}
add_action('init','crunchify_clean_header_hook');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true;
}

add_action( 'init', function() {
	// remove_post_type_support( 'post', 'editor' );
	remove_post_type_support( 'page', 'editor' );
}, 99);

// create sponsor custom post type
// function sponsor_post_type() {

// 	$labels = array(
// 		'name'                  => _x( 'Sponsors', 'Sponsor General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'Sponsor', 'Sponsor Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'Sponsors', 'text_domain' ),
// 		'name_admin_bar'        => __( 'Sponsor', 'text_domain' ),
// 		'all_items'             => __( 'All Sponsors', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New Sponsor', 'text_domain' ),
// 		'add_new'               => __( 'Add New', 'text_domain' ),
// 		'new_item'              => __( 'New Sponsor', 'text_domain' ),
// 		'edit_item'             => __( 'Edit Sponsor', 'text_domain' ),
// 		'update_item'           => __( 'Update Sponsor', 'text_domain' ),
// 		'view_item'             => __( 'View Sponsor', 'text_domain' ),
// 		'view_items'            => __( 'View Sponsors', 'text_domain' ),
// 		'search_items'          => __( 'Search Sponsor', 'text_domain' ),
// 	);

// 	$args = array(
// 		'label'                 => __( 'Sponsor', 'text_domain' ),
// 		'description'           => __( 'Sponsor Description', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array('title', 'thumbnail'),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => true,
// 		'can_export'            => true,
// 		'has_archive'           => true,
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => true,
// 		'capability_type'       => 'page',
// 		'menu_icon'				=> 'dashicons-money',
// 	);

// 	register_post_type( 'sponsor', $args );

// 	$labels = array(
// 		'name'              => _x( 'Sponsor Categories', 'taxonomy general name', 'textdomain' ),
// 		'singular_name'     => _x( 'Sponsor Category', 'taxonomy singular name', 'textdomain' ),
// 		'search_items'      => __( 'Search Sponsor Categories', 'textdomain' ),
// 		'all_items'         => __( 'All Sponsor Categories', 'textdomain' ),
// 		'parent_item'       => __( 'Parent Sponsor Category', 'textdomain' ),
// 		'parent_item_colon' => __( 'Parent Sponsor Category:', 'textdomain' ),
// 		'edit_item'         => __( 'Edit Sponsor Category', 'textdomain' ),
// 		'update_item'       => __( 'Update Sponsor Category', 'textdomain' ),
// 		'add_new_item'      => __( 'Add New Sponsor Category', 'textdomain' ),
// 		'new_item_name'     => __( 'New Sponsor Category Name', 'textdomain' ),
// 		'menu_name'         => __( 'Sponsor Category', 'textdomain' ),
// 	);

// 	$args = array(
// 		'hierarchical'      => true,
// 		'labels'            => $labels,
// 		'show_ui'           => true,
// 		'show_admin_column' => true,
// 		'query_var'         => true,
// 		'rewrite'           => array( 'slug' => 'sponsor-category' ),
// 	);

// 	register_taxonomy( 'sponsor_category', array( 'sponsor' ), $args );

// }
// add_action( 'init', 'sponsor_post_type', 0 );

// create winner custom post type
// function winner_post_type() {

// 	$labels = array(
// 		'name'                  => _x( 'Winners', 'Winner General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'Winner', 'Winner Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'Winners', 'text_domain' ),
// 		'name_admin_bar'        => __( 'Winner', 'text_domain' ),
// 		'all_items'             => __( 'All Winners', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New Winner', 'text_domain' ),
// 		'add_new'               => __( 'Add New', 'text_domain' ),
// 		'new_item'              => __( 'New Winner', 'text_domain' ),
// 		'edit_item'             => __( 'Edit Winner', 'text_domain' ),
// 		'update_item'           => __( 'Update Winner', 'text_domain' ),
// 		'view_item'             => __( 'View Winner', 'text_domain' ),
// 		'view_items'            => __( 'View Winners', 'text_domain' ),
// 		'search_items'          => __( 'Search Winner', 'text_domain' ),
// 	);

// 	$args = array(
// 		'label'                 => __( 'Winner', 'text_domain' ),
// 		'description'           => __( 'Winner Description', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array('title', 'thumbnail', 'editor'),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => true,
// 		'can_export'            => true,
// 		'has_archive'           => true,
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => true,
// 		'capability_type'       => 'page',
// 		'menu_icon'				=> 'dashicons-awards',
// 	);

// 	register_post_type( 'winner', $args );
// }

// add_action( 'init', 'winner_post_type', 0 );

// create Testimonial custom post type
function testimonial_post_type() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Testimonial General Name', 'text_domain' ),
		'singular_name'         => _x( 'Testimonial', 'Testimonial Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Testimonials', 'text_domain' ),
		'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
		'all_items'             => __( 'All Testimonials', 'text_domain' ),
		'add_new_item'          => __( 'Add New Testimonial', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Testimonial', 'text_domain' ),
		'edit_item'             => __( 'Edit Testimonial', 'text_domain' ),
		'update_item'           => __( 'Update Testimonial', 'text_domain' ),
		'view_item'             => __( 'View Testimonial', 'text_domain' ),
		'view_items'            => __( 'View Testimonials', 'text_domain' ),
		'search_items'          => __( 'Search Testimonial', 'text_domain' ),
	);

	$args = array(
		'label'                 => __( 'Testimonial', 'text_domain' ),
		'description'           => __( 'Testimonial Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array('title', 'thumbnail', 'editor'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-testimonial',
	);

	register_post_type( 'testimonial', $args );

	$labels = array(
		'name'              => _x( 'Testimonial Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Testimonial Categories', 'textdomain' ),
		'all_items'         => __( 'All Testimonial Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Testimonial Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Testimonial Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Testimonial Category', 'textdomain' ),
		'update_item'       => __( 'Update Testimonial Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Testimonial Category', 'textdomain' ),
		'new_item_name'     => __( 'New Testimonial Category Name', 'textdomain' ),
		'menu_name'         => __( 'Testimonial Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'testimonial-category' ),
	);

	register_taxonomy( 'testimonial_category', array( 'testimonial' ), $args );
}

add_action( 'init', 'testimonial_post_type', 0 );


// create Exhibition custom post type
function exhibition_post_type() {

	$labels = array(
		'name'                  => _x( 'Exhibitions', 'Exhibition General Name', 'text_domain' ),
		'singular_name'         => _x( 'Exhibition', 'Exhibition Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Exhibitions', 'text_domain' ),
		'name_admin_bar'        => __( 'Exhibition', 'text_domain' ),
		'all_items'             => __( 'All Exhibitions', 'text_domain' ),
		'add_new_item'          => __( 'Add New Exhibition', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Exhibition', 'text_domain' ),
		'edit_item'             => __( 'Edit Exhibition', 'text_domain' ),
		'update_item'           => __( 'Update Exhibition', 'text_domain' ),
		'view_item'             => __( 'View Exhibition', 'text_domain' ),
		'view_items'            => __( 'View Exhibitions', 'text_domain' ),
		'search_items'          => __( 'Search Exhibition', 'text_domain' ),
	);

	$args = array(
		'label'                 => __( 'Exhibition', 'text_domain' ),
		'description'           => __( 'Exhibition Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array('title', 'thumbnail', 'editor'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-format-gallery',
	);

	register_post_type( 'exhibition', $args );

	// $labels = array(
	// 	'name'              => _x( 'Exhibition Categories', 'taxonomy general name', 'textdomain' ),
	// 	'singular_name'     => _x( 'Exhibition Category', 'taxonomy singular name', 'textdomain' ),
	// 	'search_items'      => __( 'Search Exhibition Categories', 'textdomain' ),
	// 	'all_items'         => __( 'All Exhibition Categories', 'textdomain' ),
	// 	'parent_item'       => __( 'Parent Exhibition Category', 'textdomain' ),
	// 	'parent_item_colon' => __( 'Parent Exhibition Category:', 'textdomain' ),
	// 	'edit_item'         => __( 'Edit Exhibition Category', 'textdomain' ),
	// 	'update_item'       => __( 'Update Exhibition Category', 'textdomain' ),
	// 	'add_new_item'      => __( 'Add New Exhibition Category', 'textdomain' ),
	// 	'new_item_name'     => __( 'New Exhibition Category Name', 'textdomain' ),
	// 	'menu_name'         => __( 'Exhibition Category', 'textdomain' ),
	// );

	// $args = array(
	// 	'hierarchical'      => true,
	// 	'labels'            => $labels,
	// 	'show_ui'           => true,
	// 	'show_admin_column' => true,
	// 	'query_var'         => true,
	// 	'rewrite'           => array( 'slug' => 'exhibition-category' ),
	// );

	// register_taxonomy( 'exhibition_category', array( 'exhibition' ), $args );
}

add_action( 'init', 'exhibition_post_type', 0 );

function register_acf_options_pages() {

    // Check function exists.
    if( !function_exists('acf_add_options_page') )
        return;

    // register options page.
    $option_page = acf_add_options_page(array(
        'page_title'    => __('Theme Options'),
        'menu_title'    => __('Theme Options'),
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Hook into acf initialization.
add_action('acf/init', 'register_acf_options_pages');

// function sponsor_columns( $columns ) {
//     $columns = array(
//     	'cb' => $columns['cb'],
//     	'logo' => 'Logo',
//     	'title' => $columns['title'],
//     	'taxonomy-sponsor_category' => $columns['taxonomy-sponsor_category'],
//     	'date' => $columns['date'],
//     );

//     return $columns;
// }

// add_filter('manage_edit-sponsor_columns', 'sponsor_columns');
// add_filter('manage_edit-sponsor_sortable_columns', 'sponsor_columns');

// function sponsor_column( $colname, $cptid ) {
// 	if ( $colname == 'logo'){
// 		$image_url = get_the_post_thumbnail_url($cptid, 'full');
// 		echo '<img src="' . $image_url . '" />';
// 	}
// }
// add_action('manage_sponsor_posts_custom_column', 'sponsor_column', 10, 2);

// function winner_columns( $columns ) {
//     $columns = array(
//     	'cb' => $columns['cb'],
//     	'profile_image' => 'Profile Image',
//     	'title' => $columns['title'],
//     	'date' => $columns['date'],
//     );

//     return $columns;
// }

// add_filter('manage_edit-winner_columns', 'winner_columns');

// function winner_column( $colname, $cptid ) {
// 	if ( $colname == 'profile_image'){
// 		$image_url = get_the_post_thumbnail_url($cptid, 'thumbnail');
// 		echo '<img src="' . $image_url . '" />';
// 	}
// }
// add_action('manage_winner_posts_custom_column', 'winner_column', 10, 2);

// function exhibition_columns( $columns ) {
//     $columns = array(
//     	'cb' => $columns['cb'],
//     	'picture' => 'Picture',
//     	'title' => $columns['title'],
//     	'date' => $columns['date'],
//     );

//     return $columns;
// }

// add_filter('manage_edit-exhibition_columns', 'exhibition_columns');

// function exhibition_column( $colname, $cptid ) {
// 	if ( $colname == 'picture'){
// 		$image_url = get_the_post_thumbnail_url($cptid, 'thumbnail');
// 		echo '<img src="' . $image_url . '" />';
// 	}
// }
// add_action('manage_exhibition_posts_custom_column', 'exhibition_column', 10, 2);
