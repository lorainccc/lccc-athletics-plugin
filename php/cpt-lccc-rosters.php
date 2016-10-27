<?php
// Register Custom Post Type
function cpt_lccc_rosters() {

	$labels = array(
		'name'                  => _x( 'LCCC Rosters', 'Post Type General Name', 'athletics-lccc-rosters' ),
		'singular_name'         => _x( 'LCCC Roster', 'Post Type Singular Name', 'athletics-lccc-rosters' ),
		'menu_name'             => __( 'LCCC Rosters', 'athletics-lccc-rosters' ),
		'name_admin_bar'        => __( 'LCCC Roster', 'athletics-lccc-rosters' ),
		'archives'              => __( 'LCCC Roster Archives', 'athletics-lccc-rosters' ),
		'parent_item_colon'     => __( 'Parent LCCC Roster:', 'athletics-lccc-rosters' ),
		'all_items'             => __( 'All LCCC Rosters', 'athletics-lccc-rosters' ),
		'add_new_item'          => __( 'Add New LCCC Roster', 'athletics-lccc-rosters' ),
		'add_new'               => __( 'Add New', 'athletics-lccc-rosters' ),
		'new_item'              => __( 'New LCCC Roster', 'athletics-lccc-rosters' ),
		'edit_item'             => __( 'Edit LCCC Roster', 'athletics-lccc-rosters' ),
		'update_item'           => __( 'Update LCCC Roster', 'athletics-lccc-rosters' ),
		'view_item'             => __( 'View LCCC Roster', 'athletics-lccc-rosters' ),
		'search_items'          => __( 'Search LCCC Rosters', 'athletics-lccc-rosters' ),
		'not_found'             => __( 'Not found', 'athletics-lccc-rosters' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'athletics-lccc-rosters' ),
		'featured_image'        => __( 'Featured Image', 'athletics-lccc-rosters' ),
		'set_featured_image'    => __( 'Set featured image', 'athletics-lccc-rosters' ),
		'remove_featured_image' => __( 'Remove featured image', 'athletics-lccc-rosters' ),
		'use_featured_image'    => __( 'Use as featured image', 'athletics-lccc-rosters' ),
		'insert_into_item'      => __( 'Insert into LCCC Roster', 'athletics-lccc-rosters' ),
		'uploaded_to_this_item' => __( 'Uploaded to this LCCC Roster', 'athletics-lccc-rosters' ),
		'items_list'            => __( 'LCCC Rosters list', 'athletics-lccc-rosters' ),
		'items_list_navigation' => __( 'LCCC Rosters list navigation', 'athletics-lccc-rosters' ),
		'filter_items_list'     => __( 'Filter LCCC Rosters list', 'athletics-lccc-rosters' ),
	);
	$args = array(
		'label'                 => __( 'LCCC Roster', 'athletics-lccc-rosters' ),
		'description'           => __( 'This is the post type specifically designed to enter and maintain Lorain County Community College\'s Athletic Rosters', 'athletics-lccc-rosters' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'lccc_rosters', $args );

}
add_action( 'init', 'cpt_lccc_rosters', 0 );

?>