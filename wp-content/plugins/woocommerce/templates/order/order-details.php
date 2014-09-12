<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
$order_id= str_replace('564|||','',$_GET['order']);
$order_id= base64_decode(base64_decode($order_id));
//echo $order_id;
$order = new WC_Order( $order_id );
/*echo"<pre>";
var_dump($order);
echo"</pre>";*/
?>

<script type="text/javascript">
	function login_now(p){
		j("#prod_img_in_lb"+p).show();
	}
	function login_close(){
		j('.fade').hide();
	}

</script>
<h2><?php _e( 'Order Details', 'woocommerce' ); ?></h2>
<table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tfoot>
	<?php
		if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
			?>
			<tr>
				<th scope="row"><?php echo $total['label']; ?></th>
				<td><?php echo $total['value']; ?></td>
			</tr>
			<?php
		endforeach;
	?>
	</tfoot>
	<tbody>
		<?php
		if (sizeof($order->get_items())>0) {
			$jprod=1;
			foreach($order->get_items() as $item) {
				
				$_product = get_product( $item['variation_id'] ? $item['variation_id'] : $item['product_id'] );
				/*echo"<pre>";var_dump($_product->id);echo"</pre>";die();*/
				$prod_id=$_product->id;
				$query="select meta_value from wp_postmeta where meta_key='_manage_pic' and post_id=".$prod_id;
				//echo"$query";
				$img_data=mysql_query($query)or die(mysql_error());
				/*if($img_data){
					while($row=mysql_fetch_array($img_data)){
						echo($row[0]);
					}
				}*/
				//die();
				echo '
					<tr class = "' . esc_attr( apply_filters( 'woocommerce_order_table_item_class', 'order_table_item', $item, $order ) ) . '">';
					if($img_data){
					while($row=mysql_fetch_array($img_data)){
						?>
						<div class="fade pro_fade" style="display: none;" id="prod_img_in_lb<?php echo $jprod;?>">
							<div class="login" style="display: block;">
								<div class="crsIcn" style="display: block;"><a href="javascript:login_close();">x</a></div>
								<div style="display: block;" id="loaderdiv" class="rgstrFrm">
									<div style='position:relative;' class='dsgnCen notindesign'>
									<?php 
										echo stripcslashes(stripcslashes($row[0]));
									?>
									</div>
								</div>
							</div>
						</div>

						<?php
						/*echo("<td><a href='javascript: void(0)' onclick='showImg(".$jprod.")'>View Image</a><div style='display:none' id='prod_img_in_lb".$jprod."'><div style='position:relative;' class='dsgnCen notindesign'>
".stripcslashes(stripcslashes($row[0]))."</div></div></td>");*/
						echo("<td><a href='javascript: void(0)' onclick='login_now(".$jprod.")'>View Image</a></td>");
						
					}
					$jprod++;
				}
				
						echo'<td class="product-name">' .
							apply_filters( 'woocommerce_order_table_product_title', '<a href="' . get_permalink( $item['product_id'] ) . '">' . $item['name'] . '</a>', $item ) . ' ' .
							apply_filters( 'woocommerce_order_table_item_quantity', '<strong class="product-quantity">&times; ' . $item['qty'] . '</strong>', $item );

				$item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
				$item_meta->display();

				if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

					$download_file_urls = $order->get_downloadable_file_urls( $item['product_id'], $item['variation_id'], $item );

					$i     = 0;
					$links = array();

					foreach ( $download_file_urls as $file_url => $download_file_url ) {

						$filename = woocommerce_get_filename_from_url( $file_url );

						$links[] = '<small><a href="' . $download_file_url . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_file_urls ) > 1 ? ' ' . ( $i + 1 ) . ': ' : ': ' ) ) . $filename . '</a></small>';

						$i++;
					}

					echo implode( '<br/>', $links );
				}

				echo '</td><td class="product-total">' . $order->get_formatted_line_subtotal( $item ) . '</td></tr>';

				// Show any purchase notes
				if ($order->status=='completed' || $order->status=='processing') {
					if ($purchase_note = get_post_meta( $_product->id, '_purchase_note', true))
						echo '<tr class="product-purchase-note"><td colspan="3">' . apply_filters('the_content', $purchase_note) . '</td></tr>';
				}
				
			}
		}

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
</table>

<?php if ( get_option('woocommerce_allow_customers_to_reorder') == 'yes' && $order->status=='completed' ) : ?>
	<p class="order-again">
		<a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button"><?php _e( 'Order Again', 'woocommerce' ); ?></a>
	</p>
<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<header>
	<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
</header>
<dl class="customer_details">
<?php
	if ($order->billing_email) echo '<dt>'.__( 'Email:', 'woocommerce' ).'</dt><dd>'.$order->billing_email.'</dd>';
	if ($order->billing_phone) echo '<dt>'.__( 'Telephone:', 'woocommerce' ).'</dt><dd>'.$order->billing_phone.'</dd>';
?>
</dl>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

<div class="col2-set addresses">

	<div class="col-1">

<?php endif; ?>

		<header class="title">
			<h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_billing_address()) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
			?>
		</p></address>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

	</div><!-- /.col-1 -->

	<div class="col-2">

		<header class="title">
			<h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_shipping_address()) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
			?>
		</p></address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>

<div class="clear"></div>


