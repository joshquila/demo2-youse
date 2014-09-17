<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_content ) return;
?>
<h1 class="sbTitl">About this</h1>
<div itemprop="description" class="prod_divs">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_content ) ?>
</div>