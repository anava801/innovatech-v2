<?php

/* ========================================
	Custom Post Types: https://generatewp.com/post-type/ is a good tool for getting started
======================================== */

// Register Custom Post Type
function brand_post_type() {

	$labels = array(
		'name'                  => _x( 'Brands', 'Brand General Name', 'upg' ),
		'singular_name'         => _x( 'Brand', 'Brand Singular Name', 'upg' ),
		'menu_name'             => __( 'Brands', 'upg' ),
		'name_admin_bar'        => __( 'Brand', 'upg' ),
		'archives'              => __( 'Brand Archives', 'upg' ),
		'attributes'            => __( 'Brand Attributes', 'upg' ),
		'parent_item_colon'     => __( 'Parent Item:', 'upg' ),
		'all_items'             => __( 'All Brands', 'upg' ),
		'add_new_item'          => __( 'Add New Brand', 'upg' ),
		'add_new'               => __( 'Add New', 'upg' ),
		'new_item'              => __( 'New brand', 'upg' ),
		'edit_item'             => __( 'Edit brand', 'upg' ),
		'update_item'           => __( 'Update brand', 'upg' ),
		'view_item'             => __( 'View brand', 'upg' ),
		'view_items'            => __( 'View Brands', 'upg' ),
		'search_items'          => __( 'Search brand', 'upg' ),
		'not_found'             => __( 'Not found', 'upg' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'upg' ),
		'featured_image'        => __( 'Featured Image', 'upg' ),
		'set_featured_image'    => __( 'Set featured image', 'upg' ),
		'remove_featured_image' => __( 'Remove featured image', 'upg' ),
		'use_featured_image'    => __( 'Use as featured image', 'upg' ),
		'insert_into_item'      => __( 'Insert into brand', 'upg' ),
		'uploaded_to_this_item' => __( 'Uploaded to this brand', 'upg' ),
		'items_list'            => __( 'Brands list', 'upg' ),
		'items_list_navigation' => __( 'Brands list navigation', 'upg' ),
		'filter_items_list'     => __( 'Filter brands list', 'upg' ),
	);
	$args = array(
		'label'                 => __( 'Brand', 'upg' ),
		'description'           => __( 'Brand Description', 'upg' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'brand', $args );

}
add_action( 'init', 'brand_post_type', 0 );