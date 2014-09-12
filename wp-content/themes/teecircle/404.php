<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header('inner');?>

	<div class="mainBdy row earlyendmyacc">
		<div id="content" class="site-content" role="main">

			<!--<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'twentythirteen' ); ?></h1>
			</header>-->

			<div class="page-wrapper">
				<div class="page-content">
				<h1 class="page-title"><?php _e( 'Not Found', 'twentythirteen' ); ?></h1>
					<!--<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentythirteen' ); ?></h2>-->
					<p><?php _e( 'It looks like nothing was found at this location.', 'twentythirteen' ); ?></p>
<div class="grnLnk"><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( '&larr; Return To Home', 'woocommerce' ) ?></a></div>
					<?php //get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	<div class="clearFix"></div>
	</div><!-- #primary -->

<?php get_footer('inner'); ?>