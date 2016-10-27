<?php
// Register Custom Post Type
function cpt_lccc_players() {

	$labels = array(
		'name'                  => _x( 'LCCC Players', 'Post Type General Name', 'athletics-cpt-lccc-rosters' ),
		'singular_name'         => _x( 'LCCC Player', 'Post Type Singular Name', 'athletics-cpt-lccc-rosters' ),
		'menu_name'             => __( 'LCCC Players', 'athletics-cpt-lccc-rosters' ),
		'name_admin_bar'        => __( 'LCCC Players', 'athletics-cpt-lccc-rosters' ),
		'archives'              => __( 'LCCC Player Archives', 'athletics-cpt-lccc-rosters' ),
		'parent_item_colon'     => __( 'Parent LCCC Player:', 'athletics-cpt-lccc-rosters' ),
		'all_items'             => __( 'All LCCC Players', 'athletics-cpt-lccc-rosters' ),
		'add_new_item'          => __( 'Add New LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'add_new'               => __( 'Add New', 'athletics-cpt-lccc-rosters' ),
		'new_item'              => __( 'New LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'edit_item'             => __( 'Edit LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'update_item'           => __( 'Update LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'view_item'             => __( 'View LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'search_items'          => __( 'Search LCCC Players', 'athletics-cpt-lccc-rosters' ),
		'not_found'             => __( 'Not found', 'athletics-cpt-lccc-rosters' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'athletics-cpt-lccc-rosters' ),
		'featured_image'        => __( 'Featured Image', 'athletics-cpt-lccc-rosters' ),
		'set_featured_image'    => __( 'Set featured image', 'athletics-cpt-lccc-rosters' ),
		'remove_featured_image' => __( 'Remove featured image', 'athletics-cpt-lccc-rosters' ),
		'use_featured_image'    => __( 'Use as featured image', 'athletics-cpt-lccc-rosters' ),
		'insert_into_item'      => __( 'Insert into LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'uploaded_to_this_item' => __( 'Uploaded to this LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'items_list'            => __( 'LCCC Players list', 'athletics-cpt-lccc-rosters' ),
		'items_list_navigation' => __( 'LCCC Players list navigation', 'athletics-cpt-lccc-rosters' ),
		'filter_items_list'     => __( 'Filter LCCC Players list', 'athletics-cpt-lccc-rosters' ),
	);
	$args = array(
		'label'                 => __( 'LCCC Player', 'athletics-cpt-lccc-rosters' ),
		'description'           => __( 'This is the post type specifically designed to enter and maintain Lorain County Community College\'s Athletic Players', 'athletics-cpt-lccc-rosters' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'lccc_player', $args );

}
add_action( 'init', 'cpt_lccc_players', 0 );

function lccc_cl_register_taxonomies() {
	$taxonomies = array(
		array(
			'slug'         => 'roster',
			'single_name'  => 'Roster',
			'plural_name'  => 'Rosters',
			'post_type'    => 'lccc_player',
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'roster' ),
		),
	);
		foreach( $taxonomies as $taxonomy ) {
		$labels = array(
			'name' => $taxonomy['plural_name'],
			'singular_name' => $taxonomy['single_name'],
			'search_items' =>  'Search ' . $taxonomy['plural_name'],
			'all_items' => 'All ' . $taxonomy['plural_name'],
			'parent_item' => 'Parent ' . $taxonomy['single_name'],
			'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
			'edit_item' => 'Edit ' . $taxonomy['single_name'],
			'update_item' => 'Update ' . $taxonomy['single_name'],
			'add_new_item' => 'Add New ' . $taxonomy['single_name'],
			'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
			'menu_name' => $taxonomy['plural_name']
		);
		
		$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
		$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
	
		register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
			'hierarchical' => $hierarchical,
			 'show_tagcloud' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'rewrite' => $rewrite,
		));
	}
}
add_action( 'init', 'lccc_cl_register_taxonomies' );

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );

function lccc_atheltic_player_cpt_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('roster');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'lccc_player' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'lccc_atheltic_player_cpt_add_taxonomy_filters' );


?>