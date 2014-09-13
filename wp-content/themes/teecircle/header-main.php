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
	<body <?php body_class(); ?>>
		<div class="wrapper">
			<!--Header start-->
			<div class="header">			
				<!--Main Header start-->
				<div class="row">					<?php 					$tc_logo_url = '';					$tc_logo_url = esc_attr( get_option( 'tc_website_logo_url' ) );					if($tc_logo_url){						?><a class="site-logo" href="<?php echo site_url(); ?>"><img src="<?php echo $tc_logo_url; ?>" alt="Logo" /></a><?php 					}					?>
					  					<div class="othSec">
						<?php 						if ( is_user_logged_in() ) {	
							get_sidebar('headerlogdrop');						}else{ ?>
							<a class="sgnBtn" href="<?php echo site_url().'/my-account/'; ?>">Log In</a> <?php 									}						?>
					</div>					  					<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">						<?php wp_nav_menu( array( 'theme_location' => 'header-main', 'menu_class' => 'nav-menu' ) ); ?>					</nav>
					<div class="clearFix"></div>
				</div>								<?php if(is_home()){ ?>				<div class="row bnrPrt-cont">					<!--Banner start-->					<div class="bnrPrt">					<?php					$banner_query = new WP_Query( array('category_name'=>'heading','posts_per_page' => 1,'orderby' => 'id', 'order' => 'DESC') );					if($banner_query->have_posts()){									$banner_query->the_post();								//print_r($the_query);						 ?>						<h1><?php echo get_the_title(); ?></h1>						<p><?php echo get_the_content(); ?></p>						<div class="grnLnk bigtetxhoem1">						<a href="<?php  echo get_post_meta( get_the_ID(), 'get_started', true );?>">Get Started</a>						</div>						<div class="gryLnk bigtetxhoem1">						<a href="<?php  echo get_post_meta( get_the_ID(), 'learn_more', true );?>"><span>Learn More</span></a>						</div>						<?php 					}					wp_reset_postdata();					?>					</div>					<!--Banner end-->				</div>				<?php } ?>
			</div>				<!--Main Header end-->			
			<!--Header end-->
			<?php get_header('clearsession'); ?>			