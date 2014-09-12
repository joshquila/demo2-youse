<?php
function teecircle_custom_post_types() {
	/*Faq custom post type start here */
	$labels_faq = array(
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

	$args_faq = array(
		'labels'             => $labels_faq,
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

  	register_post_type( 'faq', $args_faq );
	register_taxonomy(
		'faq_category',
		'faq',
		array(
			'label' => __( 'Faq Category' ),
			'rewrite' => array( 'slug' => 'faq_category' ),
			'hierarchical' => true,
		)
	);  
	/*Faq custom post type end here */



	/*Faq custom post type start here */
	$labels_campaign = array(
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

	$args_campaign = array(
		'labels'             => $labels_campaign,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'campaign' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

 	register_post_type( 'campaign', $args_campaign );

	/*Faq custom post type end here */


	/*Testimonial custom post type start here */
	$labels_testimonial = array(
		'name'               => 'Testimonial',
		'singular_name'      => 'Testimonial',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Testimonial',
		'edit_item'          => 'Edit Testimonial',
		'new_item'           => 'New Testimonial',
		'all_items'          => 'All Testimonial',
		'view_item'          => 'View Testimonial',
		'search_items'       => 'Search Testimonial',
		'not_found'          => 'No testimonials found',
		'not_found_in_trash' => 'No testimonials found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);

	$args_testimonial = array(
		'labels'             => $labels_testimonial,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'testimonial', $args_testimonial );
	/*Testimonial custom post type end here */

	/*Payoff custom post type start here */
	$labels_payoff = array(
		'name'               => 'Payoff',
		'singular_name'      => 'Payoff',
		'edit_item'          => 'Edit Payoff',
		'all_items'          => 'All PayOut',
		'view_item'          => 'View Payoff',
		'search_items'       => 'Search Payoff',
		'not_found'          => 'No Payoffs found',
		'not_found_in_trash' => 'No Payoffs found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'PayOut'
	);

	$args_payoff = array(
		'labels'             => $labels_payoff,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'payoffs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'payoff', $args_payoff );
	/*Payoff custom post type end here */	
}
add_action( 'init', 'teecircle_custom_post_types' );


/*meta box code for testimonial start here*/
function tc_testimonial_add_custom_boxes() {

	add_meta_box(
		'teecircle_testimonial_box',
		'Custom Field',
		'tc_testimonial_box_content',
		'testimonial'
	);

}
add_action( 'add_meta_boxes', 'tc_testimonial_add_custom_boxes' );

function tc_testimonial_box_content( $post ) {

  // Add an nonce field so we can check for it later. 
  //wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
  wp_nonce_field( 'tc_testimonial_meta_box', 'tc_testimonial_meta_box_nonce' );
  $value = get_post_meta( $post->ID, '_my_meta_value_key', true );

  echo '<label for="tetimonial_client_name">';
  echo "Client Name";
  echo '</label> ';
  echo '<input type="text" id="tetimonial_client_name" name="tetimonial_client_name" value="' . esc_attr( $value ) . '" size="25" style="margin-left:50px;" />';

}

function tc_testimonial_box_save( $post_id ) {

  // Check if our nonce is set.
  if ( ! isset( $_POST['tc_testimonial_meta_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['tc_testimonial_meta_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'tc_testimonial_meta_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  $tetimonial_clientname = sanitize_text_field( $_POST['tetimonial_client_name'] );
  update_post_meta( $post_id, '_my_meta_value_key', $tetimonial_clientname );

}
add_action( 'save_post', 'tc_testimonial_box_save' );
/*meta box code for testimonial end here*/


/*meta box code for payoff start here*/
function tc_payoff_add_custom_boxes() {

	add_meta_box(
		'teecircle_payoff_box',
		'Custom Field',
		'tc_payoff_box_content',
		'payoff'
	);

}
add_action( 'add_meta_boxes', 'tc_payoff_add_custom_boxes' );

function tc_payoff_box_content( $post ) {

  // Add an nonce field so we can check for it later. 
  //wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
  wp_nonce_field( 'tc_payoff_meta_box', 'tc_payoff_meta_box_nonce' );
  $value = get_post_meta( $post->ID, '_my_meta_value_key', true );

  echo '<label for="payoff_client_name">';
  echo "Client Name";
  echo '</label> ';
  echo '<input type="text" id="payoff_client_name" name="payoff_client_name" value="' . esc_attr( $value ) . '" size="25" style="margin-left:50px;" />';

}

function tc_payoff_box_save( $post_id ) {

  // Check if our nonce is set.
  if ( ! isset( $_POST['tc_payoff_meta_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['tc_payoff_meta_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'tc_payoff_meta_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  $payoff_clientname = sanitize_text_field( $_POST['payoff_client_name'] );
  update_post_meta( $post_id, '_my_meta_value_key', $payoff_clientname );

}
add_action( 'save_post', 'tc_payoff_box_save' );
/*meta box code for payoff end here*/
?>