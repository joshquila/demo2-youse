<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//get_header('shop');
get_header('inner'); ?>
<div class="mainBdy row productdetailsde">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_conteznt_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		//do_action('woocommerce_before_main_content');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>
	<div class="clearFix"></div>
</div>
<?php //get_footer('shop');
get_footer('inner'); ?>
<script>
$(document).ready(function()	
{
	$('#id-seeBack').click(function(){
			$('#dv_front').hide();
			$('#dv_back').show();
			$('#txt_add').val('').removeClass('cls_edit');
			$('.cls_selected').removeClass('cls_selected');
		});
		$('#id-seeFront').click(function(){
			$('#dv_back').hide();
			$('#dv_front').show();
			$('#txt_add').val('').removeClass('cls_edit');
			$('.cls_selected').removeClass('cls_selected');
		});
});
</script>