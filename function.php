<?php

/*
*@package aidecustompost
*/
/*
  Plugin Name: Aide:: Custom Post Movie
  Plugin URI: https://aidecorp.com/
  Description: Custom Post
  Author: Aide Corporation
  Version: 1.0.0
  Last Updated : "January 27, 2024",
  Author URI: https://aidecorp.com/
  Text Domain: aidecustompost-movie
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
function aidecustompost_movie_init() {
	$labels = array(
		'name'                  => _x( 'Movies', 'Post type general name', 'aidecustompost-movie' ),
		'singular_name'         => _x( 'Movie', 'Post type singular name', 'aidecustompost-movie' ),
		'menu_name'             => _x( 'Movies', 'Admin Menu text', 'aidecustompost-movie' ),
		'name_admin_bar'        => _x( 'Movies', 'Add New on Toolbar', 'aidecustompost-movie' ),
		'add_new'               => __( 'Add New', 'aidecustompost-movie' ),
		'add_new_item'          => __( 'Add New Movies', 'aidecustompost-movie' ),
		'new_item'              => __( 'New Movies', 'aidecustompost-movie' ),
		'edit_item'             => __( 'Edit Movies', 'aidecustompost-movie' ),
		'view_item'             => __( 'View Movies', 'aidecustompost-movie' ),
		'all_items'             => __( 'All Movie', 'aidecustompost-movie' ),
		'search_items'          => __( 'Search Movie', 'aidecustompost-movie' ),
		'parent_item_colon'     => __( 'Parent Movie:', 'aidecustompost-movie' ),
		'not_found'             => __( 'No Movie found.', 'aidecustompost-movie' ),
		'not_found_in_trash'    => __( 'No Movie found in Trash.', 'aidecustompost-movie' ),
		'featured_image'        => _x( 'Movies Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'aidecustompost-movie' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'aidecustompost-movie' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'aidecustompost-movie' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'aidecustompost-movie' ),
		'archives'              => _x( 'Movies archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'aidecustompost-movie' ),
		'insert_into_item'      => _x( 'Insert into tolate', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'aidecustompost-movie' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this tolate', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'aidecustompost-movie' ),
		'filter_items_list'     => _x( 'Filter Movie list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'aidecustompost-movie' ),
		'items_list_navigation' => _x( 'Movie list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'aidecustompost-movie' ),
		'items_list'            => _x( 'Movie list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'aidecustompost-movie' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'aidecustompost-movie' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'category' ),  // Enable categories
	);

	register_post_type( 'aidecustompost-movie', $args );
}

add_action( 'init', 'aidecustompost_movie_init' );




















