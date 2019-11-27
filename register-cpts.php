<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Cities & Rates.
	 */

	$labels = array(
		"name" => __( "Cities & Rates", "custom-post-type-ui" ),
		"singular_name" => __( "City Rate", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Cities & Rates", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "service_cities", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "service_cities", $args );


	/**
	 * Post Type: Saved Rates.
	 */

	$labels = array(
		"name" => __( "Saved Rates", "custom-post-type-ui" ),
		"singular_name" => __( "Saved Rate", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Saved Rates", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "saved_rates", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "saved_rates", $args );

}

add_action( 'init', 'cptui_register_my_cpts' );
