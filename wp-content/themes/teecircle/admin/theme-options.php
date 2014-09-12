<?php

add_action('admin_menu', 'add_appearance_menu');

function add_appearance_menu() {

  $page_title = "TeeCircle Theme Settings";

  $menu_title = "Theme Settings";

  $capability = "update_themes";

  $menu_slug  = "tcthemeoptions";

  $function = 'tc_theme_options_init';

  add_theme_page(  $page_title, $menu_title, $capability, $menu_slug, $function); 

}

function tc_theme_options_init() {
	?>
	<div class="wrap">

		<h2>TeeCircle Theme Settings</h2>

		<?php settings_errors(); ?>

		<h2 class="nav-tab-wrapper">

		<?php 
			
			$active_tab = trim($_GET['tc_tab']); 

			$active_tab = ($active_tab == "") ? 1 : $active_tab;

			$tc_option_tabs = array(1 => "General Settings", 2 => "Social Login", 3 => "Email Templates");

			foreach ($tc_option_tabs as $key => $value) {

				if($key == $active_tab ) $active_calss = 'nav-tab-active'; else $active_calss = '';

				echo '<a href="?page=tcthemeoptions&tc_tab='.$key.'" class="nav-tab '.$active_calss.'">'.$value.'</a>';

			}

		?>

		</h2>	

		<div id="tc-theme-settings" class="postbox">

		<form method="post" enctype="multipart/form-data" action="options.php">

		  	<?php 

		  	if($active_tab == 1) {

		  		?><div class="tc-settings-tab"><?php

		  		settings_fields('tc_theme_general_settings_group'); 

		  		do_settings_sections('tcthemeoptions1');

		  		?></div><?php

		    } elseif ($active_tab == 2) {

		  		?><div class="tc-settings-tab"><?php

		  		settings_fields('tc_theme_social_login_group'); 

		  		do_settings_sections('tcthemeoptions2');

		  		?></div><?php

		    } elseif ($active_tab == 3) {

		    	?><div class="tc-settings-tab"><?php

			  	settings_fields('tc_theme_email_template_group'); 

			  	do_settings_sections('tcthemeoptions3');

			  	?></div><?php		

			}

		  	?>

			<?php submit_button(); ?>	

		</form>

		</div>

	</div>

	<?php
}

add_action( 'admin_init', 'tc_theme_options_fields_init' );

function tc_theme_options_fields_init() {

	add_settings_section( 'tc_general_settings_section', 'General Settings', 'tc_default_section_callback', 'tcthemeoptions1' );

	add_settings_field( 'tc_website_logo_url', 'Website Logo', 'tc_website_logo_field_callback', 'tcthemeoptions1', 'tc_general_settings_section' );

	register_setting( 'tc_theme_general_settings_group', 'tc_website_logo_url' );


	add_settings_field( 'tc_website_footer_text', 'Footer text', 'tc_website_footer_field_callback', 'tcthemeoptions1', 'tc_general_settings_section' );

	register_setting( 'tc_theme_general_settings_group', 'tc_website_footer_text' );



	add_settings_section( 'tc_social_login_api_section', 'Social Login', 'tc_default_section_callback', 'tcthemeoptions2' );

	$args = array( 'fieldname' => 'fb_app_id', 'optionname' => 'tc_social_login_info', 'size' => 40 );

	add_settings_field( 'tc_social_fb_app_id', 'Facebook App Id', 'tc_default_text_field_callback', 'tcthemeoptions2', 'tc_social_login_api_section', $args );	

	register_setting( 'tc_theme_social_login_group', 'tc_social_login_info' );

	$args = array( 'fieldname' => 'fb_secret_key', 'optionname' => 'tc_social_login_info', 'size' => 40 );

	add_settings_field( 'tc_social_fb_secret_key', 'Facebook Secret Key', 'tc_default_text_field_callback', 'tcthemeoptions2', 'tc_social_login_api_section', $args );	

	register_setting( 'tc_theme_social_login_group', 'tc_social_login_info' );

	$args = array( 'fieldname' => 'gplus_client_id', 'optionname' => 'tc_social_login_info', 'size' => 40 );

	add_settings_field( 'tc_social_gplus_client_id', 'Google Plus Client Id', 'tc_default_text_field_callback', 'tcthemeoptions2', 'tc_social_login_api_section', $args );	

	register_setting( 'tc_theme_social_login_group', 'tc_social_login_info' );	

	$args = array( 'fieldname' => 'gplus_client_secret', 'optionname' => 'tc_social_login_info', 'size' => 40 );

	add_settings_field( 'tc_social_gplus_client_secret', 'Google Plus Client Secret', 'tc_default_text_field_callback', 'tcthemeoptions2', 'tc_social_login_api_section', $args );	

	register_setting( 'tc_theme_social_login_group', 'tc_social_login_info' );	

	$args = array( 'fieldname' => 'twiter_consumer_key', 'optionname' => 'tc_social_login_info', 'size' => 40 );

	add_settings_field( 'tc_social_twiter_consumer_key', 'Twitter Consumer Key', 'tc_default_text_field_callback', 'tcthemeoptions2', 'tc_social_login_api_section', $args );	

	register_setting( 'tc_theme_social_login_group', 'tc_social_login_info' );	

	$args = array( 'fieldname' => 'twiter_consumer_secret', 'optionname' => 'tc_social_login_info', 'size' => 40 );

	add_settings_field( 'tc_social_twiter_consumer_secret', 'Twitter Consumer Secret', 'tc_default_text_field_callback', 'tcthemeoptions2', 'tc_social_login_api_section', $args );	

	register_setting( 'tc_theme_social_login_group', 'tc_social_login_info' );				



	add_settings_section( 'tc_email_template_section', 'Email Templates', 'tc_default_section_callback', 'tcthemeoptions3' );


	$e_args = array( 'optionname' => 'tc_email_signup_welcome', 'style' => 'width:550px;height:160px' );

	add_settings_field( 'tc_email_signup_welcome', 'Sign Up Welcome Mail', 'tc_default_textarea_field_callback', 'tcthemeoptions3', 'tc_email_template_section', $e_args );

	register_setting( 'tc_theme_email_template_group', 'tc_email_signup_welcome' );

	$e_args = array( 'optionname' => 'tc_email_campaign_create', 'style' => 'width:550px;height:160px' );

	add_settings_field( 'tc_email_campaign_create', 'When user creates a Campaign', 'tc_default_textarea_field_callback', 'tcthemeoptions3', 'tc_email_template_section', $e_args );

	register_setting( 'tc_theme_email_template_group', 'tc_email_campaign_create' );	

	$e_args = array( 'optionname' => 'tc_email_campaign_unsuccessful', 'style' => 'width:550px;height:160px' );

	add_settings_field( 'tc_email_campaign_unsuccessful', 'When Campaign is Unsuccessful', 'tc_default_textarea_field_callback', 'tcthemeoptions3', 'tc_email_template_section', $e_args );

	register_setting( 'tc_theme_email_template_group', 'tc_email_campaign_unsuccessful' );

	$e_args = array( 'optionname' => 'tc_email_campaign_successful', 'style' => 'width:550px;height:160px' );

	add_settings_field( 'tc_email_campaign_successful', 'When Campaign is Successful', 'tc_default_textarea_field_callback', 'tcthemeoptions3', 'tc_email_template_section', $e_args );

	register_setting( 'tc_theme_email_template_group', 'tc_email_campaign_successful' );

	$e_args = array( 'optionname' => 'tc_email_paypal_id_change', 'style' => 'width:550px;height:160px' );

	add_settings_field( 'tc_email_paypal_id_change', 'Paypal Email Id Change Reminder', 'tc_default_textarea_field_callback', 'tcthemeoptions3', 'tc_email_template_section', $e_args );

	register_setting( 'tc_theme_email_template_group', 'tc_email_paypal_id_change' );					

}

function tc_default_section_callback() {


}
 
function tc_website_logo_field_callback() {

  $tc_logo_url = esc_attr( get_option( 'tc_website_logo_url' ) );

  ?>
        <input type="text" id="tc_website_logo_url" name="tc_website_logo_url" value="<?php echo esc_url( $tc_logo_url ); ?>" />

        <input id="upload_logo_button" type="button" class="button" value="Upload Logo" />

        <span class="description">Upload an image for the website logo.</span>

  <?php
  		if( $tc_logo_url != "" ) {
  			echo '<br><img src="'.$tc_logo_url.'" style="width:200px; height:auto; margin-top:20px; ">';
  		}

}

function tc_website_footer_field_callback() {

	$setting_value = esc_attr( get_option( 'tc_website_footer_text' ) ); ?>

	<input type="text" id="tc_website_footer_text" name="tc_website_footer_text" value="<?php echo $setting_value ; ?>" size="70"/>

	<?php
}

function tc_default_text_field_callback( $args ) {


	$setting_value_aray = (array) get_option( $args['optionname'] ); 

	$setting_value = $setting_value_aray[$args['fieldname']]; ?>

	<input type="text" id="<?php echo $args['fieldname'];?>" name="<?php echo $args['optionname']."[".$args['fieldname']."]";?>" value="<?php echo $setting_value ; ?>" size="<?php echo $args['size'];?>"/>

	<?php	
}

function tc_default_textarea_field_callback( $args ) {

  $setting_value = esc_attr( get_option( $args['optionname'] ) );

  echo "<textarea class='regular-text' type='text' name='".$args['optionname']."' style='".$args['style']."'/>$setting_value</textarea>";

}


















function tc_settings_enqueue_scripts() {

    wp_register_script( 'tc-logo-upload', get_template_directory_uri() .'/admin/js/logo-upload.js', array('jquery','media-upload','thickbox') );

    if ( 'appearance_page_tcthemeoptions' == get_current_screen() -> id ) {
    
        wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
    
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
    
        wp_enqueue_script('tc-logo-upload');
 
    }

    wp_register_style( 'tc-theme-settings-style', get_template_directory_uri() .'/admin/css/tc-admin.css', array(), false, 'all' );

    wp_enqueue_style('tc-theme-settings-style');
 
}
add_action('admin_enqueue_scripts', 'tc_settings_enqueue_scripts');

function tclogo_upload_insert_button() {

    global $pagenow;
 
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {

        // Now we'll replace the 'Insert into Post Button' inside Thickbox
        add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );

    }

}

add_action( 'admin_init', 'tclogo_upload_insert_button' );
 
function replace_thickbox_text($translated_text, $text, $domain) {

    if ('Insert into Post' == $text) {

        $referer = strpos( wp_get_referer(), 'tcthemeoptions' );

        if ( $referer != '' ) {

            return __('I want this to be my logo!', 'wptuts' );

        }

    }

    return $translated_text;
}

?>