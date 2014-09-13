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
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	</head>
	<body <?php body_class(); ?>>
		<div class="wrapper">
			<!--Header start-->
			<div class="header">
				<!--Main Header start-->
				<div class="row">
					  
						<?php 
							get_sidebar('headerlogdrop');
							<a class="sgnBtn" href="<?php echo site_url().'/my-account/'; ?>">Log In</a> <?php 			
					</div>
					<div class="clearFix"></div>
				</div>
			</div>	
			<!--Header end-->
			<?php get_header('clearsession'); ?>