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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">	<?php wp_head(); ?>	<script>		$(function(){			$('.mobileMenu .mmnu').hide();			$('.mobile_nav').click(function(){			  $('.mobileMenu .mmnu').fadeToggle();			});		});	</script>
	</head>
	<body <?php body_class(); ?>">
		<div class="wrapper">
  
  <!--Header start-->
  <div class="header">
      <!--Main Header start-->
      <div class="row">		<?php 		$tc_logo_url = '';		$tc_logo_url = esc_attr( get_option( 'tc_website_logo_url' ) );		if($tc_logo_url){			?><a class="site-logo" href="<?php echo site_url(); ?>"><img src="<?php echo $tc_logo_url; ?>" alt="Logo" /></a><?php 		}		?>
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
          <div class="mobileMenu">
            <span class="mobile_nav"><img src="<?php echo get_template_directory_uri(); ?>/images/mbMnu.png" alt="" border="0"></span>
            <ul class="mmnu">
              <li class="actv"><a href="<?php echo get_permalink( 34 ); ?>">Launch a new campaign</a></li>
              <li><a href="<?php echo get_permalink( 70 ); ?>">Are you a non profit?</a></li>
              <li><a href="<?php echo get_permalink( 70 ); ?>">How it works</a></li>
            </ul>
          </div>
          <!--<div class="othSec">
		  <?php if ( is_user_logged_in() ) {?>
            <input name="" type="button" value="Log Out" class="sgnBtn" onClick="window.location.href='<?php echo site_url().'/my-account/logout/'; ?>'" />      
			<?php }else{?>			
			<input name="" type="button" value="Log In" class="sgnBtn" onClick="window.location.href='<?php echo site_url().'/my-account/';?>'" />      
			<?php }?>
          </div>-->
          <div class="clearFix"></div>
		  
      </div>
      <!--Main Header end-->
	  
   </div>
  <!--Header end-->
  <?php get_header('clearsession'); ?>