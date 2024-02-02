<?php

/*
*@package aide_cpt
*/
/*
  Plugin Name: Aide:: Custom Post Movie
  Plugin URI: https://aidecorp.com/
  Description: Custom Post
  Author: Aide Corporation
  Version: 1.0.0
  Last Updated : "January 27, 2024",
  Author URI: https://aidecorp.com/
  Text Domain: aide_cpt-movie
  Domain Path: /languages
*/

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);



/**
 * Register a custom post type called "tolate".
 *
 * @see get_post_type_labels() for label keys.
 */
function aide_cpt_movie_init() {
	$labels = array(
		'name'                  => _x( 'Movies', 'Post type general name', 'aide_cpt-movie' ),
		'singular_name'         => _x( 'Movie', 'Post type singular name', 'aide_cpt-movie' ),
		'menu_name'             => _x( 'Movies', 'Admin Menu text', 'aide_cpt-movie' ),
		'name_admin_bar'        => _x( 'Movies', 'Add New on Toolbar', 'aide_cpt-movie' ),
		'add_new'               => __( 'Add New', 'aide_cpt-movie' ),
		'add_new_item'          => __( 'Add New Movies', 'aide_cpt-movie' ),
		'new_item'              => __( 'New Movies', 'aide_cpt-movie' ),
		'edit_item'             => __( 'Edit Movies', 'aide_cpt-movie' ),
		'view_item'             => __( 'View Movies', 'aide_cpt-movie' ),
		'all_items'             => __( 'All Movie', 'aide_cpt-movie' ),
		'search_items'          => __( 'Search Movie', 'aide_cpt-movie' ),
		'parent_item_colon'     => __( 'Parent Movie:', 'aide_cpt-movie' ),
		'not_found'             => __( 'No Movie found.', 'aide_cpt-movie' ),
		'not_found_in_trash'    => __( 'No Movie found in Trash.', 'aide_cpt-movie' ),
		'featured_image'        => _x( 'Movies Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'aide_cpt-movie' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'aide_cpt-movie' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'aide_cpt-movie' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'aide_cpt-movie' ),
		'archives'              => _x( 'Movies archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'aide_cpt-movie' ),
		'insert_into_item'      => _x( 'Insert into tolate', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'aide_cpt-movie' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this tolate', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'aide_cpt-movie' ),
		'filter_items_list'     => _x( 'Filter Movie list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'aide_cpt-movie' ),
		'items_list_navigation' => _x( 'Movie list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'aide_cpt-movie' ),
		'items_list'            => _x( 'Movie list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'aide_cpt-movie' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'aide_cpt-movie' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'category' ),  // Enable categories
	);

	register_post_type( 'aide_cpt-movie', $args );
}

add_action( 'init', 'aide_cpt_movie_init' );



// Hook to add the meta box
add_action('add_meta_boxes', 'aide_cpt_custom_meta_box');

// Callback function to add the meta box
function aide_cpt_custom_meta_box() {
    // Parameters: unique ID, title, callback function, screen (post type)
    add_meta_box('aide_cpt_meta_box', 'My Custom Meta Box', 'aide_cpt_meta_box_callback', 'aide_cpt-movie', );
}

// Callback function to display the content of the meta box
function aide_cpt_meta_box_callback($post) {
    // Get the current value of the custom field
    $meta_value = get_post_meta($post->ID, '_aide_cpt_custom_field_1', true);

    // Output the HTML for the meta box
    ?>
    <label for="aide_cpt_custom_field_1">Custom Field 1:</label>
    <input type="text" id="aide_cpt_custom_field_1" name="aide_cpt_custom_field_1" value="<?php echo esc_attr($meta_value); ?>" />
    <?php
}

// Hook to save the meta box data
add_action('save_post', 'save_aide_cpt_custom_meta_box');

// Callback function to save the meta box data
function save_aide_cpt_custom_meta_box($post_id) {
    // Check if nonce is set
    if (!isset($_POST['my_meta_box_nonce'])) {
        return;
    }

    // Verify nonce
    if (!wp_verify_nonce($_POST['my_meta_box_nonce'], 'my_meta_box_nonce')) {
        return;
    }

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the custom field value
    if (isset($_POST['aide_cpt_custom_field_1'])) {
        update_post_meta($post_id, '_aide_cpt_custom_field_1', sanitize_text_field($_POST['aide_cpt_custom_field_1']));
    }
}

// Hook to add a nonce field to the meta box
add_action('post_submitbox_misc_actions', 'add_my_custom_meta_box_nonce');

// Callback function to add a nonce field
function add_my_custom_meta_box_nonce() {
    global $post;
    if (!empty($post->ID)) {
        wp_nonce_field('my_meta_box_nonce', 'my_meta_box_nonce');
    }
}















