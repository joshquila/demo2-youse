<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php wp_title(); ?></title>
<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/css/alternetFont.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" rel="stylesheet" type="text/css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script>
var j = jQuery.noConflict();
 j(function(){
  j('.mobileMenu .mmnu').hide();
  j('.mobile_nav').click(function(){
	  j('.mobileMenu .mmnu').fadeToggle();
  })
 })
</script>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

</head>
<body>
<div class="wrapper">
  
  <div class="headerInner"> 
        <!--Main Header start-->
        <div class="row">
          <div class="logo"><a href="<?php echo site_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" /></a></div>
		  <div class="othSec">
		  <?php if ( is_user_logged_in() ) {
		  	 get_sidebar('headerlogdrop');
			 }else{?>			
			<input name="" type="button" value="Log In" class="sgnBtn" onClick="window.location.href='<?php echo site_url().'/my-account/';?>'" />      
			<?php }?>
          </div>
          <ul class="menu">
            <li class="actv"><a href="<?php echo get_permalink( 34 ); ?>">Launch a new campaign</a></li>
            <li><a href="<?php echo get_permalink( 70 ); ?>">Are you a non profit?</a></li>
            <li><a href="<?php echo get_permalink( 70 ); ?>">How it works</a></li>
          </ul>
          <div class="mobileMenu"> <span class="mobile_nav"><img src="<?php echo get_template_directory_uri(); ?>/images/mbMnu.png" alt="" border="0"></span>
            <ul class="mmnu">
              <li class="actv"><a href="<?php echo get_permalink( 34 ); ?>">Launch a new campaign</a></li>
              <li><a href="<?php echo get_permalink( 70 ); ?>">Are you a non profit?</a></li>
              <li><a href="<?php echo get_permalink( 70 ); ?>">How it works</a></li>
            </ul>
          </div>
         
          <div class="clearFix"></div>
        </div>
        <!--Main Header end--> 
        
      </div>