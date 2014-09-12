<?php
/*
Template Name: Ajax
*/
if(isset($_REQUEST['checkval']) && !empty($_REQUEST['checkval']))
{
	if($_REQUEST['checkval']=='changeproductonsel')
	{
		$valo = explode('==++==',$_REQUEST['chval']);
		//echo $valo[1];
		$args = array( 'post_type' => 'product', 'product_cat' => stripcslashes($valo[1]), 'post_status' => 'publish','author'=>'1');    
		$loop = new WP_Query( $args );
		$h=0;
        while ( $loop->have_posts() ) : $loop->the_post();global $product;
		if($h==0){$prodid = $product->id;}
		$authorvalues = get_the_terms( $product->id, 'pa_color');
		if(mysql_num_rows(mysql_query("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id`='".$prodid."' and `meta_key`='_is_custom'"))==0){
      
?>
				<li class="tee_product <?php if($h==0){?>active<?php }?>" id="tee_product<?php echo $product->id;?>">    <div class="drsRev">
				<div onclick="product_li_active('tee_product<?php echo $product->id;?>');" >
					<div class="htxt"><?php the_title(); ?></div>			
					<div class="nrtxt"><?php the_content(); ?></div></div>
					<span class="teeitem_excerpt" style="display: none;"><?php the_excerpt(); ?></span>
					<span class="teeitem_excerptbase" style="display: none;"><?php echo get_post_meta( $product->id, 'base_cost_shirts', true); ?></span>
					<span class="teeitem_excerptproid" style="display: none;"><?php echo $product->id; ?></span>
					<span class="teeitem_excerptprice" style="display: none;"><?php echo get_post_meta( $product->id, 'base_cost_shirts_0010_0019', true); ?><?php //echo $product->get_price(); ?></span>

                     <span class="teeitem_price" style="display: none;"><?php echo $product->get_price_html(); ?></span>
					 </div>
					 <?php //echo '<pre>';print_r($authorvalues);echo '</pre>';
					 if(isset($authorvalues) && !empty($authorvalues) && count($authorvalues)>0){?>
					 <div id="product-colors" class="product-colors"><i></i>
					 <ul class="tee_nav">    
					 <?php 
					 $colr = 0;
					 shuffle($authorvalues);
					 foreach ( $authorvalues as $authorvalue ) {
					 	//echo $colr;
					 	if($colr<12){?>
					 <li style="background:<?php echo $authorvalue->description;?>;" title="<?php echo $authorvalue->name;?>" class="shirt-color-sample " data-texture="" data-value="<?php echo $authorvalue->description;?>" data-id="<?php echo $authorvalue->term_id;?>"></li><?php }
					$colr++; }?>
					 	<li class="palletf"><img src="<?php echo get_template_directory_uri(); ?>/images/pltpc.png" /></li>
					 </ul>
					 <div class="colorpalet upside" style="display:none;">
					<div class="inside">
					<?php foreach ( $authorvalues as $authorvalue ) {?>
						<span style="background:<?php echo $authorvalue->description;?>;" title="<?php echo $authorvalue->name;?>" class="shirt-color-sample " data-texture="" data-value="<?php echo $authorvalue->description;?>" data-id="<?php echo $authorvalue->term_id;?>"></span>
						<?php }?>
					</div>
				</div>
					 </div>
					<?php }?>
				</li>

    <?php $h++; }
	endwhile; 
	echo '++++++++++++++'.$prodid;
	}

	if($_REQUEST['checkval']=='addtocartpop'){
		/*$_REQUEST['qty']=6;
		$_REQUEST['pid']=317;
		$_REQUEST['vid']=349;*/
		$sizepa = explode(',=,',$_REQUEST['typeval']);$stylepa = explode(',=,',$_REQUEST['typevalst']);$stylepaid = explode(',=,',$_REQUEST['typevalstid']);
		$qtpa = explode(',=,',$_REQUEST['typevalqt']);
		$arr = array();
		/*$arr['pa_size']='3xl';
		$arr['pa_style']='long-sleeved';
		$arr1 = array();
		$arr1['pa_size']='2xl';
		$arr1['pa_style']='long-sleeved'*/;
		//require_once("../../../wp-blog-header.php");
		header("HTTP/1.1 200 OK");
		global $woocommerce;
		//$quantity       = (isset($_REQUEST['qty'])) ? (int) $_REQUEST['qty'] : 1;
		$product_id     = (int) apply_filters('woocommerce_add_to_cart_product_id', $_REQUEST['pid']);   
		
		for($h=0;$h<(count($sizepa)-1);$h++){
			$arr['pa_size']=$sizepa[$h];
			$arr['pa_style']=$stylepa[$h];
			$vid = (int) apply_filters('woocommerce_add_to_cart_product_id', $stylepaid[$h]); 
			if ($vid > 0) $woocommerce->cart->add_to_cart( $product_id, $qtpa[$h], $vid, $arr );         
			else $woocommerce->cart->add_to_cart( $product_id, $qtpa[$h] );
		}  
		echo 'added';
		die();
		/*if ($vid > 0) $woocommerce->cart->add_to_cart( $product_id, $quantity, $vid, $arr1 );         
		else $woocommerce->cart->add_to_cart( $product_id, $quantity );*/
		
	}
}

///////////////////////test/////////////////////////////
//$lastid = 317;
//mysql_query("insert into `".$wpdb->prefix."term_relationships` set `object_id`='".$lastid."', `term_taxonomy_id`='4'");
/*wp_set_object_terms ($lastid, 'variable', 'product_type');
wp_set_object_terms( $lastid, array('S','M','L','XL','2XL','3XL'), 'pa_size' );
update_post_meta( $lastid, '_visibility', 'search' );
update_post_meta( $lastid, '_stock_status', 'instock');*/
/*add_post_meta( $lastid, '_stock', '100' ); 
add_post_meta( $lastid, '_manage_stock', 'yes' ); */
/*$postvs = array(
  'post_name'      => 'product-'.$lastid.'-variation-s',
  'post_title'     => 'product-'.$lastid.'-variation-s',
  'post_status'    => 'publish',
  'post_type'      => 'product_variation',
  'post_author'    => 1,//$_POST['uid'],
  'ping_status'    => 'open',
  'post_parent'    => $lastid,
  'menu_order'     => 0,
  'to_ping'        => '',
  'pinged'         => '',
  'post_password'  => '',
  'guid'           => '',
  'post_content_filtered' => '',
  'post_excerpt'   => '',
  'post_date'      => date('Y-m-d H:i:s'),
  'post_date_gmt'  => date('Y-m-d H:i:s'),
  'comment_status' => 'closed',
  'tags_input'     => '',
  'tax_input'      => '',
  'page_template'  => ''
);  

wp_insert_post( $postvs ); 

$lastidvs = $wpdb->insert_id;
add_post_meta( $lastidvs, '_price', '12' );
add_post_meta( $lastidvs, 'attribute_pa_size', '' );
add_post_meta( $lastidvs, 'attribute_pa_style', '' );*/
?>