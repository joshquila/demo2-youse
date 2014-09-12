<?php
/**
 * Plugin Name: Testimonial Arnab
 * Description: Testimonial Plugin.
 * Version: The Plugin's Version Number: 1.0
 * Author: Arnab
 */


/**
 * Calls the class on the post edit screen.
 */
function call_someClass() {
    new someClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_someClass' );
    add_action( 'load-post-new.php', 'call_someClass' );
}

/** 
 * The Class.
 */
class someClass {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
            $post_types = array('post', 'page');     //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
		add_meta_box(
			'some_meta_box_name'
			,__( 'Some Meta Box Headline', 'myplugin_textdomain' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'advanced'
			,'high'
		);
            }
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['myplugin_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
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

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = sanitize_text_field( $_POST['_my_meta_value_key'] );

		// Update the meta field.
		update_post_meta( $post_id, '_my_meta_value_key', $mydata );
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

		// Display the form, using the current value.
		echo '<label for="myplugin_new_field">';
		_e( 'Client Name', 'myplugin_textdomain' );
		echo '</label> ';
		echo '<input type="text" id="_my_meta_value_key" name="_my_meta_value_key"';
                echo ' value="' . esc_attr( $value ) . '" size="25" />';
	}
}

function myplugin_add_custom_box() {

    $screens = array( 'Testimonial' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'Custom Fields', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

function myplugin_inner_custom_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_my_meta_value_key', true );

  echo '<label for="myplugin_new_field">';
       _e( "Client Name", 'myplugin_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="client_name" name="client_name" value="' . esc_attr( $value ) . '" size="25" style="margin-left:50px;" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['myplugin_inner_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
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

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['myplugin_name'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_my_meta_value_key', $mydata );
}
add_action( 'save_post', 'myplugin_save_postdata' );

function codex_custom_init() {
  $labels = array(
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

  $args = array(
    'labels'             => $labels,
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

  register_post_type( 'Testimonial', $args );
}
add_action( 'init', 'codex_custom_init' );

?>