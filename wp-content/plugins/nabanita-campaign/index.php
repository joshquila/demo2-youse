<?php
/**
 * Plugin Name: Campaign Nabanita
 * Description: for Campaign.
 * Version: The Plugin's Version Number: 1.0
 * Author: Nabanita
 */
function campaign_custom_init() {
  $labels = array(
    'name'               => 'Campaign',
    'singular_name'      => 'Campaign',
    'add_new'            => false,
    'edit_item'          => 'Edit Campaign',
    'new_item'           => 'New Campaign',
    'all_items'          => 'All Ended Campaigns',
    'view_item'          => 'View Campaign',
    'search_items'       => 'Search Campaign',
    'not_found'          => 'No Campaign found',
    'not_found_in_trash' => 'No Campaign found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Ended Campaigns'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'Campaign' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'thumbnail' )
  );

  register_post_type( 'Campaign', $args );
}
add_action( 'init', 'campaign_custom_init' );

?>