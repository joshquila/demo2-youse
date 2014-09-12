<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.15
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post,$wpdb;
$orproduct_pro  = $wpdb->get_results("SELECT a.meta_value as order_prod_id,a.order_item_id,c.order_id,d.meta_value as buyer_id,e.meta_value as buyer_email FROM wp_woocommerce_order_itemmeta as a,wp_posts as b,wp_woocommerce_order_items as c,wp_postmeta as d,wp_postmeta as e WHERE a.meta_key='_product_id' AND a.meta_value=b.ID AND b.ID=".$post->ID." AND c.order_item_id=a.order_item_id AND d.post_id=c.order_id AND d.meta_key='_customer_user'AND e.post_id=c.order_id AND e.meta_key='_billing_email'");
/*echo '<pre>';
print_r($orproduct_pro);
echo '</pre>'*/;
?>

<?php do_action('woocommerce_before_add_to_cart_form');
function timediffcal($tmnb){
$difference = $tmnb-time();
//echo '<br />';
$second = 1;
$minute = 60*$second;
$hour   = 60*$minute;
$day    = 24*$hour;

$ans["day"]    = floor($difference/$day);
$ans["hour"]   = floor(($difference%$day)/$hour);
$ans["minute"] = floor((($difference%$day)%$hour)/$minute);
//echo $message->id;
$ans["second"] = floor(((($difference%$day)%$hour)%$minute)/$second);
//echo '<br />';
$time_diff = '';
/*if($ans["day"]>7){$time_diff =gmdate('d/m',$tmnb);}else*/
if($ans["day"]>0){$time_diff .=$ans["day"] . " days ";}
if($ans["hour"]>0){$time_diff .=$ans["hour"] . " hrs ";}
if($ans["minute"]>0){$time_diff .=$ans["minute"] . " mins ";}else{
if($ans["second"]>0){$time_diff .=$ans["second"] . " secs ";}else{$time_diff .="0 secs ";}}
return $time_diff;}
//echo print_r(get_the_terms( $post->ID, 'product_cat' )); 
//$meta = get_post_meta( get_the_ID() );
/*echo '<pre>';
print_r($meta);echo '</pre>';die();*/
$sized = get_the_terms( $post->ID, 'pa_size' ); 
$stylenamearr = get_the_terms( $post->ID, 'product_cat' );
foreach($stylenamearr as $stylenamearrn){
	$stylename = $stylenamearrn->name;
	}
	$styelnamv = mysql_query("select ID from `wp_posts` where `post_parent`='".$product->id."' and post_type='product_variation' and post_status='publish'");
	$proct = array();
	while($rowf = mysql_fetch_array($styelnamv)){
		/*echo '<pre>';
	print_r($rowf);echo '</pre>';*/
		$styelnamvst = mysql_fetch_array(mysql_query("select meta_value from `wp_postmeta` where `post_id`='".$rowf['ID']."' and meta_key='attribute_pa_style'" ));
		$styelnamvpr = mysql_fetch_array(mysql_query("select meta_value from `wp_postmeta` where `post_id`='".$rowf['ID']."' and meta_key='_regular_price'" ));
		$proct[$styelnamvst['meta_value']]['variation_id'] = $rowf['ID'];
		$proct[$styelnamvst['meta_value']]['price'] = $styelnamvpr['meta_value'];
	}
/*echo '<pre>';
	print_r($proct);echo '</pre>';*/
?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<table class="variations" cellspacing="0">
		<tbody>
			<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; 
			if(esc_attr( sanitize_title($name) )=='pa_style'){?>
				<tr>
					<td class="label"><!--<label for="<?php echo sanitize_title($name); ?>"><?php echo $woocommerce->attribute_label( $name ); ?></label>-->Additional Styles:</td>
					<td class="value"><select id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
						<!--<option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>-->
						<?php
							if ( is_array( $options ) ) {

								if ( empty( $_POST ) )
									$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
								else
									$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';
									//echo $term->name;die();

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( $name ) ) {

									$orderby = $woocommerce->attribute_orderby( $name );

									switch ( $orderby ) {
										case 'name' :
											$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
										break;
										case 'id' :
											$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false );
										break;
										case 'menu_order' :
											$args = array( 'menu_order' => 'ASC' );
										break;
									}

									$terms = get_terms( $name, $args );


									foreach ( $terms as $term ) {
																			if($stylename == $term->name){
	echo '<option value="' . esc_attr( $term->slug ) . '" ' . $selected_valuev/*selected( $selected_value, $term->slug, false )*/ . '>' . apply_filters( 'woocommerce_variation_option_name', $stylename ) . '</option>';
	$selected_valuev = 'selected="selected"';
	//die();
}else{
	$selected_valuev = '';
	//echo 'ss';echo $stylename;echo $term->name;
	//die();
}
}foreach ( $terms as $term ) {
	if($stylename != $term->name){
										if ( ! in_array( $term->slug, $options ) )
											continue;

										echo '<option value="' . esc_attr( $term->slug ) . '" ' . $selected_valuev/*selected( $selected_value, $term->slug, false )*/ . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
									}}
								} else {

									foreach ( $options as $option ) {
										echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
									}

								}
							}
						?>
					</select> <?php
						/*if ( sizeof($attributes) == $loop )
							echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';*/
					?></td>
				</tr>
	        <?php } endforeach;?>
		</tbody>
	</table>
	<div class="sixingin"><a href="javascript:void(0);" onclick="$('#cgehckbansize').css('display','block');" alt="Close" title="Close">Sizing info</a></div>
	<div class="sizingOuter"  style="display: none;" id="cgehckbansize">
<div class="sizingCont">
<div class="sizingText">Sizing information<button class="close01" aria-hidden="true" data-dismiss="modal" type="button" onclick="$('#cgehckbansize').css('display','none');">×</button><div style="clear:both"></div></div>
<!--<h4>Hanes Tagless Tee - $9.50</h4>-->
<div class="hanesPart">
<ul>
<li></li>
<?php foreach($sized as $sizeds){?>
			<li><?php echo $sizeds->name;?></li><?php }?>
</ul>
</div>
<div class="nexPart">
<ul>
<li>Chest</li>
<?php foreach($sized as $sizeds){?>
            <li><?php echo $sizeds->description;?></li>
            <?php }?>  
</ul>


</div>
<input class="informationBtn" name="close" type="button" value="Close size information" onclick="$('#cgehckbansize').css('display','none');" />
</div>
</div>
	

	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap">
		<div class="single_variation"></div>
		<div class="variations_button">
			<input type="hidden" name="variation_id" value="" id="variation_idv" />
			<div style="display: none;">
			<?php woocommerce_quantity_input(); ?></div>
			<?php $ecdtime = get_post_meta( $post->ID, '_campain_valid_to');
			$eend = get_post_meta( $post->ID, '_early_end');
			
			if(($ecdtime[0]<time()) || (isset($eend) && !empty($eend) && ($eend=='yes'))){ ?>
			<button type="button" class="single_add_to_cart_button button alt ends"><div class="left-arrow
"></div><?php echo apply_filters('single_add_to_cart_text', __( 'Buy it now', 'woocommerce' ), $product->product_type); ?></button>
			<?php }else{?>
			<button type="button" class="single_add_to_cart_button button alt" onclick="$('#cgehckban').css('display','block'); $('#pa_style_1').val($('#pa_style').val()); $('#pa_style_1_price').html($('.single_variation_wrap .single_variation .price .amount').html());"><div class="left-arrow
"></div><?php echo apply_filters('single_add_to_cart_text', __( 'Buy it now', 'woocommerce' ), $product->product_type); ?></button>
<?php }?>
		</div>
	</div>
	<div>
		<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
		<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>"  id="product_idv"/>
	</div>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>


<?php $stockv = get_post_meta( $post->ID, '_stock');
$saledateto = get_post_meta( $post->ID, '_sale_price_dates_to');//print_r($saledateto);?>
<div class="soldHding"><?php echo count($orproduct_pro);?> sold towards goal of <?php echo $stockv[0]; ?></div>
				<div class="soldSubTxt">
					Don't worry, you won't be charged unless the goal is reached! <a href="<?php echo site_url();?>/about-us/">Learn why</a>.
				</div>
				<?php $perc = ((count($orproduct_pro)/$stockv[0])*100);
				if(empty($perc)){$perc = '0.5';}else{$perc = 0.5+$perc;}
				if(($ecdtime[0]<time()) || (isset($eend) && !empty($eend) && ($eend=='yes'))){ $clsdf='pgbarouterInct';}else{$clsdf='ppgbarouter';}?>
				<div class="pgbarouter"><div class="<?php echo $clsdf;?>" style="width: <?php echo $perc;?>%;"></div></div>
				<div class="soldSubTxt topbar">
				
					<img alt="Thumbnails" src="<?php echo get_template_directory_uri(); ?>/images/alarm-clock.png"><?php echo ' '.timediffcal($ecdtime[0]);?> left to buy
				</div>
<?php do_action('woocommerce_after_add_to_cart_form'); ?>
<!--Pop up section start-->
    <div class="popsOuter" style="display: none;" id="cgehckban">
      <div class="popmanCnt">
	  
        <div class="hdSect">
          <h1>Select your size</h1>
          <img src="<?php echo get_template_directory_uri(); ?>/images/gtk_close.png" class="crs" alt=""  onclick="$('#cgehckban').css('display','none');" />
        </div>
        <div class="popBdy">
		<div id="sizeerr" style="color: red;"></div>
		<input type="hidden" id="typeval" name="typeval"/><input type="hidden" id="typevalst" name="typevalst"/><input type="hidden" id="typevalstid" name="typevalstid"/>
		<input type="hidden" id="typevalqt" name="typevalqt"/>
          <ul class="tophd">
            <li>Qty</li>
            <li>Size</li>
            <li class="sty">Style</li>
            <li>Price</li>
          </ul>
          
          <ul class="selSec" id="addvamulli">
            <li>
              <ul class="bdyCnt">
                <li><input name="qty" type="text" id="qty_1" value="1" class="qtcl" /></li>
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				<li <?php if(esc_attr( sanitize_title($name) )!='pa_size'){echo 'class="sty"'; }else{echo 'class="selCol"';}?>>
					<!--<td class="label"><label for="<?php echo sanitize_title($name); ?>"><?php echo $woocommerce->attribute_label( $name ); ?></label></td>-->
					<?php if(esc_attr( sanitize_title($name) )=='pa_size'){$stych = 'pa_sizecl';}else{$stych = 'pa_stylecl';} ?>
					<select id="<?php echo esc_attr( sanitize_title($name) ); ?>_1" name="attribute_<?php echo sanitize_title($name); ?>" class="<?php echo $stych;?>" onchange="selvalm('<?php echo esc_attr( sanitize_title($name));?>','<?php echo esc_attr( sanitize_title($name) ); ?>_1');">
						<?php if(esc_attr( sanitize_title($name) )=='pa_size'){?><option value=""><?php if(esc_attr( sanitize_title($name) )=='pa_size'){echo '- -';}else{echo __( 'Choose an option', 'woocommerce' );} ?></option>
						<?php }
							if ( is_array( $options ) ) {

								if ( empty( $_POST ) )
									$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
								else
									$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( $name ) ) {

									$orderby = $woocommerce->attribute_orderby( $name );

									switch ( $orderby ) {
										case 'name' :
											$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
										break;
										case 'id' :
											$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false );
										break;
										case 'menu_order' :
											$args = array( 'menu_order' => 'ASC' );
										break;
									}

									$terms = get_terms( $name, $args );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) )
											continue;
if(esc_attr( sanitize_title($name) )=='pa_style'){$datavi = $proct[esc_attr( $term->slug )]['variation_id'].'===='.esc_attr( $term->slug ).'===='.$proct[esc_attr( $term->slug )]['price'];}else{$datavi=esc_attr( $term->slug );}
										echo '<option value="' . $datavi . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
									}
								} else {

									foreach ( $options as $option ) {
										echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
									}

								}
							}
						?>
					</select> <?php
						/*if ( sizeof($attributes) == $loop )
							echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';*/
					?>
				</li>
	        <?php endforeach;?>
                <li id="pa_style_1_price"></li>
              </ul>
            </li>          
          </ul>
          
          <div class="btmBtn">
            <a href="javascript:void(0)" onclick="appendsli();">Another Style</a><a href="javascript:void(0)" onclick="acloseli();" id="renvalm" style="display:none;">Remove Latest Style</a>
          </div>
          
          <div class="btmBtnSec">
            <div class="lftports">
              <a href="javascript:void(0)" onclick="addtocartpup();"><img src="<?php echo get_template_directory_uri(); ?>/images/chckOut.gif" alt="" /></a>
              <!--<a href="javascript:void(0)"><img src="<?php echo get_template_directory_uri(); ?>/images/payCard.gif" alt="" /></a>-->
            </div>
           <!-- <div class="rhtports">
              <a href="javascript:void(0)"><img src="<?php echo get_template_directory_uri(); ?>/images/pay.gif" alt="" /></a>
            </div>-->
            <div class="clearFix"></div>
          </div>
          
        </div>
      </div></div>
	  <input  type="hidden" name="idb" id="idb" value="2"/>
    </form>
    <!--Pop up section end-->
<script>
	function appendsli(){
		var listr = '';
		listr += '<li class="mainli"><ul class="bdyCnt"><li><input name="qty" type="text" id="qty_'+$('#idb').val()+'" value="1" class="qtcl" /></li>';
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				 <?php if(esc_attr( sanitize_title($name) )!='pa_size'){$sfdc= 'class="sty"'; }else{$sfdc= 'class="selCol"';}?>
				 <?php if(esc_attr( sanitize_title($name) )=='pa_size'){$stych = 'pa_sizecl';}else{$stych = 'pa_stylecl';} ?>
		listr += '<li <?php echo $sfdc;?>><select id="<?php echo esc_attr( sanitize_title($name) ); ?>_'+$('#idb').val()+'" name="attribute_<?php echo sanitize_title($name); ?>"  class="<?php echo $stych;?>" onchange="selvalm(\'<?php echo esc_attr( sanitize_title($name));?>\',\'<?php echo esc_attr( sanitize_title($name) ); ?>_'+$('#idb').val()+'\');">';
						<?php if(esc_attr( sanitize_title($name) )=='pa_size'){?>
						listr += '<option value=""><?php if(esc_attr( sanitize_title($name) )=='pa_size'){echo '- -';}else{echo __( 'Choose an option', 'woocommerce' );} ?></option>';
						<?php }
							if ( is_array( $options ) ) {

								if ( empty( $_POST ) )
									$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
								else
									$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( $name ) ) {

									$orderby = $woocommerce->attribute_orderby( $name );

									switch ( $orderby ) {
										case 'name' :
											$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
										break;
										case 'id' :
											$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false );
										break;
										case 'menu_order' :
											$args = array( 'menu_order' => 'ASC' );
										break;
									}

									$terms = get_terms( $name, $args );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) )
											continue;
											if(esc_attr( sanitize_title($name) )=='pa_style'){$datavi = $proct[esc_attr( $term->slug )]['variation_id'].'===='.esc_attr( $term->slug ).'===='.$proct[esc_attr( $term->slug )]['price'];}else{$datavi=esc_attr( $term->slug );}?>
										listr += "<option value='<?php echo $datavi;?>' <?php echo selected( $selected_value, $term->slug, false );?> ><?php echo apply_filters( 'woocommerce_variation_option_name', $term->name );?></option>";
										<?php
									}
								} else {

									foreach ( $options as $option ) {?>
										listr += "<option value='<?php echo esc_attr( sanitize_title( $option ) );?>' <?php echo selected( sanitize_title( $selected_value ), sanitize_title( $option ), false );?>> <?php echo esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) );?></option>";
									<?php }

								}
							}
						?>
					listr += '</select>'; <?php
						/*if ( sizeof($attributes) == $loop )
							echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';*/
					?>
				listr += '</li>';
	        <?php endforeach;?>
                listr += '<li class="pa_pricefirst_1" id="<?php echo esc_attr( sanitize_title($name) ); ?>_'+$('#idb').val()+'_price">'+$('.single_variation_wrap .single_variation .price .amount').html()+'</li></ul></li>';
	$('#addvamulli').append(listr);
	$('#renvalm').css('display','inline-block');
	$('#idb').val(parseInt($('#idb').val())+1);
	}
	function acloseli(){
		$("ul#addvamulli li.mainli:last-child").remove();
		if($("ul#addvamulli li.mainli").length==0){
			$('#renvalm').css('display','none');
		}
		$('#idb').val(parseInt($('#idb').val())-1);
	}
	function addtocartpup(){
		var typeval = '';var typevalst = '';typevalstid = '';var typevalqt = '';
		var err =0;
		$('.pa_sizecl').each(function(){//alert($(this).val());
			if($(this).val()==''){
				err = 1;
			}else{
				typeval += $(this).val()+',=,';
			}
		});
		$('.pa_stylecl').each(function(){
			var splitk = $(this).val().split('====');
			
				typevalst += splitk[1]+',=,';
				typevalstid += splitk[0]+',=,';
		});
		$('.qtcl').each(function(){
			
				typevalqt += $(this).val()+',=,';
		});
		//alert(err);
		if(err==1){
			$('#sizeerr').html('Please choose Size');
			
		}else{
			
			$('#sizeerr').html('');
			$('#typeval').val(typeval);
			$('#typevalst').val(typevalst);
			$('#typevalstid').val(typevalstid);
			$('#typevalqt').val(typevalqt);
			//alert($('#typeval').val());alert($('#typevalst').val());alert($('#typevalqt').val());
			$.post('<?php echo bloginfo ('url')."/ajax"; ?>', {checkval:'addtocartpop',pid:$('#product_idv').val(),vid:$('#variation_idv').val(),typeval:$('#typeval').val(),typevalst:$('#typevalst').val(),typevalstid:$('#typevalstid').val(),typevalqt:$('#typevalqt').val()}).done(function(data) {//alert(data);
				if(data=='added'){
					window.location='<?php echo bloginfo ('url')."/cart"; ?>';
				}
			});
			
		}
			
	}
	function selvalm(txt,txt1){
		if(txt=='pa_style'){
			var spil = $('#'+txt1).val().split('====');
			$('#'+txt1+'_price').html('$'+spil[2]);
		}
		
	}
</script>