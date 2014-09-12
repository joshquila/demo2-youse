<?php
/**
 * Plugin Name: FAQ Arnab
 * Description: for FAQ.
 * Version: The Plugin's Version Number: 1.0
 * Author: Arnab
 */
add_action( 'init', 'create_faq' );

function create_faq() {
	register_taxonomy(
		'faq_category',
		'faq',
		array(
			'label' => __( 'Faq Category' ),
			'rewrite' => array( 'slug' => 'faq_category' ),
			'hierarchical' => true,
		)
	);
}

function faq_custom_init() {
  $labels = array(
    'name'               => 'FAQ',
    'singular_name'      => 'FAQ',
    'add_new'            => 'Add FAQ',
    'add_new_item'       => 'Add New FAQ Question And Answer Bellow',
    'edit_item'          => 'Edit FAQ',
    'new_item'           => 'New FAQ',
    'all_items'          => 'All FAQ',
    'view_item'          => 'View FAQ',
    'search_items'       => 'Search FAQ',
    'not_found'          => 'No faq found',
    'not_found_in_trash' => 'No faq found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'FAQ'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'faq' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'thumbnail' ),
	'taxonomies' => array('faq_category')
  );

  register_post_type( 'faq', $args );
}
add_action( 'init', 'faq_custom_init' );

?>