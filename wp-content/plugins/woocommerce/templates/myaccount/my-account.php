<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
ob_start();
@session_start();
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; global $wpdb; 
$orproduct_pro  = $wpdb->get_results("SELECT b.post_date as date,h.post_date as billdate, a.meta_value as order_prod_id,a.order_item_id,g.meta_value as subtotal,c.order_id,d.meta_value as buyer_id,e.meta_value as buyer_email FROM wp_woocommerce_order_itemmeta as a,wp_posts as b,wp_woocommerce_order_items as c,wp_postmeta as d,wp_postmeta as e, wp_term_relationships as f, wp_woocommerce_order_itemmeta as g, wp_posts as h WHERE a.meta_key='_product_id' AND a.meta_value=b.ID AND b.post_author=".$current_user->ID." AND c.order_item_id=a.order_item_id AND d.post_id=c.order_id AND d.meta_key='_customer_user' AND e.post_id=c.order_id AND e.meta_key='_billing_email' AND c.order_id=f.object_id AND f.term_taxonomy_id!=12 AND g.meta_key='_line_subtotal' AND c.order_item_id=g.order_item_id AND c.order_id=h.ID ORDER BY h.ID DESC");
/*echo"<pre>";
print_r($orproduct_pro);
echo"</pre>";*/
$pronar =array();
foreach($orproduct_pro as $orproductpro){
	$pronar[$orproductpro->order_prod_id][$orproductpro->buyer_id.'==++=='.$orproductpro->order_id] = $orproductpro->buyer_email;
}
$_SESSION['pronar'] = $pronar;
/*echo '<pre>';
print_r($_SESSION['pronar']);echo '</pre>';*/
//var_dump(var_dump($orproduct_pro));
//var_dump(var_dump($current_user->data->ID));
$woocommerce->show_messages(); ?>
<?php $product_active = $wpdb->get_results("SELECT ID,post_title,post_content,post_status,post_name FROM wp_posts WHERE post_type='product' AND post_author=". $current_user->ID." ORDER BY ID DESC");
$activearr = array();
$inactivearr = array();
$draftarr = array();
$userarr = array();
$k=0;
foreach($product_active as $productactive){//echo $k;
	/*if(in_array($productactive->ID,$orproduct_pro)){
		$orproduct_proid  = $wpdb->get_results("SELECT order_item_id FROM wp_woocommerce_order_itemmeta WHERE meta_key='_product_id'");
		
	}*/
	$product_image = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_manage_pic' AND post_id=". $productactive->ID);
	$product_activem = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_campain_valid_to' AND post_id=". $productactive->ID);
	$product_stock = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_stock' AND post_id=". $productactive->ID);
	$product_endearly = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_early_end' AND post_id=". $productactive->ID);
	/*print_r($product_endearly);*/
	$product_enddat = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_edit_lock' AND post_id=". $productactive->ID);
	
	if($productactive->post_status=='publish'){
		if(isset($product_activem[0]) && !empty($product_activem[0])){
			if( ($product_activem[0]->meta_value >time()) && (count($product_endearly)==0)){
				//echo("Active");
				/*$activearr[] = $productactive;*/
				$activearr[$k]['ID'] = $productactive->ID;
				$activearr[$k]['post_title'] = $productactive->post_title;
				$activearr[$k]['post_content'] = $productactive->post_content;
				$activearr[$k]['post_name'] = $productactive->post_name;
				$activearr[$k]['end_time'] = $product_activem[0]->meta_value;
				$activearr[$k]['stock'] = $product_stock[0]->meta_value;
				$activearr[$k]['products_image'] = $product_image[0]->meta_value;
				
			}else{
				//echo("InActive");
				$inactivearr[$k]['ID'] = $productactive->ID;
				$inactivearr[$k]['post_title'] = $productactive->post_title;
				$inactivearr[$k]['post_content'] = $productactive->post_content;
				$inactivearr[$k]['post_name'] = $productactive->post_name;
				$inactivearr[$k]['end_time'] = $product_activem[0]->meta_value;
				$inactivearr[$k]['stock'] = $product_stock[0]->meta_value;
				$inactivearr[$k]['products_image'] = $product_image[0]->meta_value;
			}		}		
	}else{
		if($productactive->post_status=='draft'){
			/*$draftarr[] = $productactive;*/
			$draftarr[$k]['ID'] = $productactive->ID;
			$draftarr[$k]['post_title'] = $productactive->post_title;
			$draftarr[$k]['post_content'] = $productactive->post_content;
			$draftarr[$k]['post_name'] = $productactive->post_name;
			$draftarr[$k]['end_time'] = str_replace(':1','',$product_enddat[0]->meta_value);
			$draftarr[$k]['stock'] = $product_stock[0]->meta_value;
			$draftarr[$k]['products_image'] = $product_image[0]->meta_value;
		}
	}
$k++;	
}
/*echo '<pre>';
print_r($draftarr);*/



//echo(strtotime("13 March 2014"));
?>
<!--Campaign Section Starts Here-->
<div class="content campaignmyaccount <?php if(isset($_GET['p'])){echo 'coldivsc';}?>" id="campaigns">
	<!--Active Campaign Starts Here-->
	<div class="hdng">Active campaigns</div>
	<?php 
	if(count($activearr)>0){
		foreach($activearr as $activearrr){
		
			/*function timediffcal($tmnb)
			{*/
				$difference = $activearrr['end_time']-time();
				//echo '<br />';
				$second = 1;
				$minute = 60*$second;
				$hour = 60*$minute;
				$day = 24*$hour;

				$ans["day"] = floor($difference/$day);
				$ans["hour"] = floor(($difference%$day)/$hour);
				$ans["minute"] = floor((($difference%$day)%$hour)/$minute);
				//echo $message->id;
				$ans["second"] = floor(((($difference%$day)%$hour)%$minute)/$second);
				//echo '<br />';
				$time_diff = '';
				/*if($ans["day"]>7){$time_diff =gmdate('d/m',$activearrr['end_time']);}else
				*/if($ans["day"]>0){$time_diff .=$ans["day"] . " days ";}else
				if($ans["hour"]>0){$time_diff .=$ans["hour"] . " hrs ";}else
				if($ans["minute"]>0)
				{
					$time_diff .=$ans["minute"] . " mins ";
				}else{
					if($ans["second"]>0)
					{
						$time_diff .=$ans["second"] . " secs ";
					}else{
						$time_diff .="0 secs ";
					}
				}
				/*return $time_diff;*/
				//echo "Time Difference = ".$time_diff;
			/*}*/$prodvact = mysql_fetch_array(mysql_query("SELECT sum(b.meta_value) as tot_prod_qty FROM wp_woocommerce_order_itemmeta as a, wp_woocommerce_order_itemmeta as b, wp_woocommerce_order_items as c, wp_term_relationships as d WHERE a.meta_value=".$activearrr['ID']." AND a.meta_key='_product_id' AND a.order_item_id=b.order_item_id AND b.meta_key='_qty' AND c.order_item_id=a.order_item_id AND c.order_id=d.object_id AND d.term_taxonomy_id!=12"));
				if(isset($prodvact['tot_prod_qty']) && !empty($prodvact['tot_prod_qty'])){$proqtytotact = $prodvact['tot_prod_qty'];}else{$proqtytotact =0;}			
$perc = (($proqtytotact/$activearrr['stock'])*100);
//echo $activearrr['stock'];
//echo $proqtytotact;
	?>
		<div class="listings">
			<div class="left">
				<div class="box">
					<span class="activeBtn"><?php if($proqtytotact>$activearrr['stock']){echo 'Profit Made';}else{echo 'Active';}?></span>
					<span style="">
						
							<!--<img src="images/tshrt01.jpg" alt="" />-->
							<div class="dsgnCen notindesign" style="position:relative;">
								<?php echo stripcslashes(stripcslashes($activearrr['products_image'])); ?>
							</div>
						
					</span>
				</div>
			</div>
			<div class="right">
				<div class="hdngTxt"><a href="<?php echo bloginfo ('url')."/product/".$activearrr['post_name']; ?>"><?php echo $activearrr['post_title']; ?></a></div>
				<div class="subTxt"><?php if(strlen(strip_tags($activearrr['post_content']))>150){echo substr(strip_tags($activearrr['post_content']),0,147).'...';}else{echo strip_tags($activearrr['post_content']);} ?></div>
				<div class="barBack">
				<?php 
				if(empty($perc)){$perc = '0.5';}else if($perc>100){$perc='100';}else{$perc = $perc;}?>
					<div class="barInside" style="width: <?php echo $perc;?>%"></div>
				</div>
				<ul class="sellingDtls">
					<li>
						<div class="hding"><?php echo $time_diff; ?></div>
						<div class="bottomText">Remaining</div>
					</li>
					<li>
						<div class="hding"><?php echo $proqtytotact;?>/<?php echo $activearrr['stock']; ?></div>
						<div class="bottomText">Sold</div>
					</li>
				</ul>
				<ul class="editDtls">
					<li><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 359 ); ?>','<?php echo base64_encode(base64_encode($activearrr['ID'])); ?>');">Edit Details</a></li>
					<li><a href="javascript:void(0);" onclick="$('#cgehckban<?php echo $activearrr['ID']; ?>').css('display','block');">Message buyers</a>
					<div class="popsOuter" style="display: none;" id="cgehckban<?php echo $activearrr['ID']; ?>">
      <div class="popmanCnt">
	  
        <div class="hdSect">
          <h1>Send a message to all buyers of <?php echo $activearrr['post_title']; ?></h1>
          <img src="<?php echo get_template_directory_uri(); ?>/images/gtk_close.png" class="crs" alt=""  onclick="$('#cgehckban<?php echo $activearrr['ID']; ?>').css('display','none');" />
        </div>
        <div class="popBdy">
		<div id="sizeerr" style="color: red;"></div>
		<input type="hidden" id="typeval" name="typeval"/><input type="hidden" id="typevalst" name="typevalst"/><input type="hidden" id="typevalstid" name="typevalstid"/>
		<input type="hidden" id="typevalqt" name="typevalqt"/>
		<form name="senb<?php echo $activearrr['ID']; ?>" id="senb<?php echo $activearrr['ID']; ?>" method="POST" action="">
		<input type="hidden" id="prodid<?php echo $activearrr['ID']; ?>" name="prodid<?php echo $activearrr['ID']; ?>" value="<?php echo $activearrr['ID']; ?>"/>
		<input type="hidden" id="supplierid<?php echo $activearrr['ID']; ?>" name="supplierid<?php echo $activearrr['ID']; ?>" value="<?php echo $current_user->user_id; ?>"/>
         <ul class="selSec" id="addvamullichek">
            <li>
              <p>From (your email address) </p>
			  <div class="chk"><input type="text" id="email<?php echo $activearrr['ID']; ?>" name="email<?php echo $activearrr['ID']; ?>" value="<?php echo $current_user->user_email; ?>"/><div id='email_err<?php echo $activearrr['ID']; ?>' class="redTxt"></div></div>
            </li> 
			<li>
              <p>Name (optional)  </p>
			  <div class="chk"><input type="text" id="name<?php echo $activearrr['ID']; ?>" name="name<?php echo $activearrr['ID']; ?>"/><div id='name_err<?php echo $activearrr['ID']; ?>' class="redTxt"></div></div>
            </li> 
			<li>
              <p>Subject </p>
			  <div class="chk"><input type="text" id="subject<?php echo $activearrr['ID']; ?>" name="subject<?php echo $activearrr['ID']; ?>"/><div id='subject_err<?php echo $activearrr['ID']; ?>' class="redTxt"></div></div>
            </li>   
			<li>
              <p>Email Content  </p>
			  <div class="chk"><textarea id="content<?php echo $activearrr['ID']; ?>" name="content<?php echo $activearrr['ID']; ?>"></textarea><div id='content_errsenb<?php echo $activearrr['ID']; ?>' class="redTxt"></div></div>
            </li> 
			<li><p>You may send your campaign's buyers one email every 24 hours.</p></li>         
          </ul>
          	
          </form>
          <div class="btmBtnSec">
            <div class="lftportssdf">
              <a href="javascript:void(0)" onclick="addtocartpup(<?php echo $activearrr['ID']; ?>);"><img src="<?php echo get_template_directory_uri(); ?>/images/se_email_b_yers.gif" alt="" /></a>
			   <a href="javascript:void(0)"  onclick="$('#cgehckban<?php echo $activearrr['ID']; ?>').css('display','none');"><img src="<?php echo get_template_directory_uri(); ?>/images/canlBtn.gif" alt="" />
</a>
            </div>
            <div class="clearFix"></div>
          </div>
          
        </div>
      </div></div></li>
					<li><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 370 ); ?>','<?php echo base64_encode(base64_encode($activearrr['ID'])); ?>');">Request Goal Drop</a></li>
					<li><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 369 ); ?>','<?php echo base64_encode(base64_encode($activearrr['ID'])); ?>');">End Early</a></li>
				</ul>
			</div>
			<div class="clearFix"></div>
		</div>
	<?php 
		}
	}else{
		echo '<span class="noval">No active campaigns are found!</span>';
	}
	?>
	<!--Active Campaign Ends Here-->
	<br /><br /><br /><br />
	<!--End Campaign Starts Here-->
	<div class="hdng">Ended campaigns</div>
	<?php 
	
	if(count($inactivearr)>0){
		foreach($inactivearr as $inactivearrr){
			if(isset($prodvinact['tot_prod_qty']) && !empty($prodvinact['tot_prod_qty'])){$proqtytotinact = $prodvinact['tot_prod_qty'];}else{$proqtytotinact =0;}
			$perc = (($proqtytotinact/$inactivearrr['stock'])*100);
	?>
		<div class="listings">
			<div class="left">
				<div class="box">
				<?php if($proqtytotinact>$inactivearrr['stock']){?><span class="activeBtn"><?php echo 'Profit Made';?></span><?php }?>
					<!--<input type="button" class="activeBtn" value="Active" />-->
					<span style="">
						<a href="javascript:void(0)">
						<!--<img src="images/tshrt01.jpg" alt="" />-->
						<div class="dsgnCen notindesign" style="position:relative;">
							<?php echo stripcslashes(stripcslashes($inactivearrr['products_image'])); ?>
						</div>
						</a>
					</span>						
				</div>
			</div>
			<div class="right">
				<div class="hdngTxt"><a href="<?php echo bloginfo ('url')."/product/".$inactivearrr['post_name']; ?>"><?php echo $inactivearrr['post_title']; ?></a></div>
				<div class="subTxt"><?php if(strlen(strip_tags($inactivearrr['post_content']))>150){echo substr(strip_tags($inactivearrr['post_content']),0,147).'...';}else{echo strip_tags($inactivearrr['post_content']);} ?></div>
				<div class="barBack">
				<?php 
				$prodvinact = mysql_fetch_array(mysql_query("SELECT sum(b.meta_value) as tot_prod_qty FROM wp_woocommerce_order_itemmeta as a, wp_woocommerce_order_itemmeta as b, wp_woocommerce_order_items as c, wp_term_relationships as d WHERE a.meta_value=".$inactivearrr['ID']." AND a.meta_key='_product_id' AND a.order_item_id=b.order_item_id AND b.meta_key='_qty' AND c.order_item_id=a.order_item_id AND c.order_id=d.object_id AND d.term_taxonomy_id!=12"));
				
				
				if(empty($perc)){$perc = '0.5';}else if($perc>100){$perc='100';}else{$perc = 0.5+$perc;}?>
					<div class="barInsideInctv" style="width: <?php echo $perc;?>%"></div>
				</div>
				<ul class="sellingDtls">
					<li>
						<div class="hding"><?php echo date('d/m/y',$inactivearrr['end_time']); ?></div>
						<div class="bottomText">Ended</div>
					</li>
					<li>
						<div class="hding"><?php echo $proqtytotinact;?>/<?php echo $inactivearrr['stock']; ?></div>
						<div class="bottomText">Sold</div>
					</li>
				</ul>
				<ul class="editDtls">
					<li><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 234 ); ?>','<?php echo base64_encode(base64_encode($inactivearrr['ID'])); ?>');">Relaunch Campaign</a></li>
					<li><a href="javascript:void(0);" onclick="$('#cgehckban<?php echo $inactivearrr['ID']; ?>').css('display','block');">Message buyers</a>
					<div class="popsOuter" style="display: none;" id="cgehckban<?php echo $inactivearrr['ID']; ?>">
      <div class="popmanCnt">
	  
        <div class="hdSect">
          <h1>Send a message to all buyers of <?php echo $inactivearrr['post_title']; ?></h1>
          <img src="<?php echo get_template_directory_uri(); ?>/images/gtk_close.png" class="crs" alt=""  onclick="$('#cgehckban<?php echo $inactivearrr['ID']; ?>').css('display','none');" />
        </div>
        <div class="popBdy">
		<div id="sizeerr" style="color: red;"></div>
		<input type="hidden" id="typeval" name="typeval"/><input type="hidden" id="typevalst" name="typevalst"/><input type="hidden" id="typevalstid" name="typevalstid"/>
		<input type="hidden" id="typevalqt" name="typevalqt"/>
		<form name="senb<?php echo $inactivearrr['ID']; ?>" id="senb<?php echo $inactivearrr['ID']; ?>" method="POST" action="">
		<input type="hidden" id="prodid<?php echo $inactivearrr['ID']; ?>" name="prodid<?php echo $inactivearrr['ID']; ?>" value="<?php echo $inactivearrr['ID']; ?>"/>
		<input type="hidden" id="supplierid<?php echo $inactivearrr['ID']; ?>" name="supplierid<?php echo $inactivearrr['ID']; ?>" value="<?php echo $current_user->user_id; ?>"/>
         <ul class="selSec" id="addvamullichek">
            <li>
              <p>From (your email address) </p>
			  <div class="chk"><input type="text" id="email<?php echo $inactivearrr['ID']; ?>" name="email<?php echo $inactivearrr['ID']; ?>" value="<?php echo $current_user->user_email; ?>"/><div id='email_err<?php echo $inactivearrr['ID']; ?>' class="redTxt"></div></div>
            </li> 
			<li>
              <p>Name (optional)  </p>
			  <div class="chk"><input type="text" id="name<?php echo $inactivearrr['ID']; ?>" name="name<?php echo $inactivearrr['ID']; ?>"/><div id='name_err<?php echo $inactivearrr['ID']; ?>' class="redTxt"></div></div>
            </li> 
			<li>
              <p>Subject </p>
			  <div class="chk"><input type="text" id="subject<?php echo $inactivearrr['ID']; ?>" name="subject<?php echo $inactivearrr['ID']; ?>"/><div id='subject_err<?php echo $inactivearrr['ID']; ?>' class="redTxt"></div></div>
            </li>   
			<li>
              <p>Email Content  </p>
			  <div class="chk"><textarea id="content<?php echo $inactivearrr['ID']; ?>" name="content<?php echo $inactivearrr['ID']; ?>"></textarea><div id='content_errsenb<?php echo $inactivearrr['ID']; ?>' class="redTxt"></div></div>
            </li> 
			<li><p>You may send your campaign's buyers one email every 24 hours.</p></li>         
          </ul>
          	
          </form>
          <div class="btmBtnSec">
            <div class="lftportssdf">
              <a href="javascript:void(0)" onclick="addtocartpup('senb<?php echo $inactivearrr['ID']; ?>');"><img src="<?php echo get_template_directory_uri(); ?>/images/se_email_b_yers.gif" alt="" /></a>
			   <a href="javascript:void(0)"  onclick="$('#cgehckban<?php echo $inactivearrr['ID']; ?>').css('display','none');"><img src="<?php echo get_template_directory_uri(); ?>/images/canlBtn.gif" alt="" /></a>
            </div>
            <div class="clearFix"></div>
          </div>
          
        </div>
      </div></div></li>
					<li><a href="javascript:void(0);" onclick="gotopage('delete','<?php echo base64_encode(base64_encode($inactivearrr['ID'])); ?>');">Delete</a></li>
				</ul>
			</div>
			<div class="clearFix"></div>
		</div>
	<?php 
		}
	}else{
		echo '<span class="noval">No ended campaigns are found!</span>';
	}
	?>
	<!--End Campaign Ends Here-->
</div>
<!--Campaign Section Ends Here-->

<!--Draft Section Starts Here-->
<div class="content campaignmyaccount <?php if(isset($_GET['p']) && !empty($_GET['p']) && ($_GET['p']=='campaignsdraft')){}else{echo 'coldivsc';}?>" id="campaignsdraft">
	<?php 
	if(count($draftarr)>0){
		foreach($draftarr as $draftarrr){
	?>
		<div class="listings">
			<div class="left">
				<div class="box">
					<!--<input type="button" class="activeBtn" value="Active" />-->
					<span style="">
						<a href="javascript:void(0)">
							<!--<img src="images/tshrt01.jpg" alt="" />-->
							<div class="dsgnCen notindesign" style="position:relative;">
								<?php echo stripcslashes(stripcslashes($draftarrr['products_image'])); ?>
							</div>
						</a>
					</span>
				</div>
			</div>
			<div class="right">
				<div class="hdngTxt"><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 34 ); ?>','<?php echo base64_encode(base64_encode($draftarrr['ID'])); ?>');"><?php echo $draftarrr['post_title']; ?></a></div>
				<div class="subTxt"><?php if(strlen(strip_tags($draftarrr['post_content']))>150){echo substr(strip_tags($draftarrr['post_content']),0,147).'...';}else{echo strip_tags($draftarrr['post_content']);} ?></div>
				<div class="barBack">
					<div class="barInside" style="width: 0.5%;"></div>
				</div>
				<ul class="sellingDtls">
					<li>
						<div class="hding"><?php echo date('d/m/y  g:ia  e',$draftarrr['end_time']); ?></div>
						<div class="bottomText">last saved</div>
					</li>
				</ul>
				<ul class="editDtls">
					<li><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 34 ); ?>','<?php echo base64_encode(base64_encode($draftarrr['ID'])); ?>');">Resume Draft</a></li>
					<li><a href="javascript:void(0);" onclick="gotopage('delete','<?php echo base64_encode(base64_encode($draftarrr['ID'])); ?>');">Delete</a></li>
				</ul>
			</div>
			<div class="clearFix"></div>
		</div>
	<?php 
		}
	}else{
		echo '<span class="noval">No draft campaigns are found!</span>';
	}
	?>
</div>
<!--Draft Section Ends Here-->

<!--Get Paid Section Starts Here-->
<div class="content getpadisdf <?php if(isset($_GET['p']) && !empty($_GET['p']) && ($_GET['p']=='get_paid')){}else{echo 'coldivsc';}?>" id="get_paid">
<?php /*echo '<pre>';print_r($orproduct_pro);*/
$pronvalsoneval = $wpdb->get_results("SELECT a.meta_value as product_id,b.meta_value as tot_prod_qty,e.meta_value as subtotal from wp_woocommerce_order_itemmeta as a,wp_posts as wp, wp_woocommerce_order_itemmeta as b, wp_woocommerce_order_items as c, wp_term_relationships as d, wp_woocommerce_order_itemmeta as e  WHERE a.meta_key='_product_id' AND wp.ID=a.meta_value AND a.order_item_id=b.order_item_id AND b.meta_key='_qty' AND a.order_item_id=e.order_item_id AND e.meta_key='_line_subtotal' AND c.order_item_id=a.order_item_id AND c.order_id=d.object_id AND d.term_taxonomy_id=10 AND wp.post_author=".$current_user->ID);
//echo '<pre>';
$pronvalsone =array();
$f=0;
foreach($pronvalsoneval as $key => $orproductproq){
$pronvalsone[$orproductproq->product_id]['product_id'] = $orproductproq->product_id;
$pronvalsone[$orproductproq->product_id]['tot_prod_qty'] = $pronvalsone[$orproductproq->product_id]['tot_prod_qty'] + $orproductproq->tot_prod_qty;
$pronvalsone[$orproductproq->product_id]['subtotal'] = $pronvalsone[$orproductproq->product_id]['subtotal'] + $orproductproq->subtotal;
$f++;
}
//print_r($pronvalsone);
$pronval = $wpdb->get_results("SELECT DISTINCT wpm.post_id,wp.post_title,wpm1.meta_value as stock,wpm.meta_value as enddate from wp_postmeta as wpm,wp_postmeta as wpm1,wp_postmeta as wpm2,wp_posts as wp WHERE ((wpm.meta_key='_campain_valid_to' AND wpm.meta_value<".time().")) AND wp.ID = wpm.post_id AND wp.ID = wpm2.post_id AND wpm1.meta_key='_stock' AND  wpm1.post_id=wp.ID AND wp.post_author=".$current_user->ID);//OR (wpm2.meta_key='_early_end' AND wpm2.meta_value='yes'))
//echo '<pre>';
//print_r($pronval );
$getpagarr = array();
foreach($pronval as $orproductpro){
	$getpagarr[$orproductpro->post_id]['stock'] = $orproductpro->stock;
	$getpagarr[$orproductpro->post_id]['endate'] = $orproductpro->enddate;
	$getpagarr[$orproductpro->post_id]['post_title'] = $orproductpro->post_title;
}
$pagearray = array();
$b=0;
$totamt = 0;
$payoff = array();
foreach($pronvalsone as $key => $orproductproq){echo $orproductproq->tot_prod_qty;
	if(isset($getpagarr[$orproductproq['product_id']]['stock']) && !empty($getpagarr[$orproductproq['product_id']]['stock']) && ($orproductproq['tot_prod_qty']>=$getpagarr[$orproductproq['product_id']]['stock']) ){//echo $orproductproq['product_id'];
		$pagearray[$getpagarr[$orproductproq['product_id']]['endate']]['date'] = date( 'm/d/y', $getpagarr[$orproductproq['product_id']]['endate']  );
		$pagearray[$getpagarr[$orproductproq['product_id']]['endate']]['post_title'] = $getpagarr[$orproductproq['product_id']]['post_title'];
		$pagearray[$getpagarr[$orproductproq['product_id']]['endate']]['amount'] = '+$'.$orproductproq['subtotal'];
		$pagearray[$getpagarr[$orproductproq['product_id']]['endate']]['stock'] = $orproductproq['tot_prod_qty'];
		$pagearray[$getpagarr[$orproductproq['product_id']]['endate']]['type'] = 'order';
		$pronvalkey = mysql_fetch_array(mysql_query("SELECT post_id from wp_payoff where post_id=".$orproductproq['product_id']));
		//print_r($pronvalkey);
		if(!isset($pronvalkey['post_id'])){
			$totamt = $totamt+$orproductproq['subtotal'];
			$payoff[] = $orproductproq['product_id'];
		}
	}
	
	
$b++;}
//print_r($pagearray);
//echo $b;
$pronvalhjh = $wpdb->get_results("SELECT wp.ID,wp.post_title,wp.post_status,wp.post_date,wp.post_content from wp_posts as wp WHERE post_author=".$current_user->ID." AND post_type='payoff' AND (post_status='draft' OR post_status='publish')");
//print_r($pronvalhjh);
foreach($pronvalhjh as $key => $orproductproq){
	//echo $orproductproq->post_date;
		$pagearray[strtotime($orproductproq->post_date)]['date'] = date( 'm/d/y', strtotime($orproductproq->post_date)  );
		$pagearray[strtotime($orproductproq->post_date)]['post_title'] = 'You requested a Payout via Paypal for '.$orproductproq->post_content;
		$pagearray[strtotime($orproductproq->post_date)]['amount'] = '('.$orproductproq->post_content.')';
		$pagearray[strtotime($orproductproq->post_date)]['stock'] = $orproductproq->post_status;
		$pagearray[strtotime($orproductproq->post_date)]['type'] = 'payoff';	
$b++;}

$payoffstr = implode(',',$payoff);
//echo $totamt;
//print_r($pagearray);$cur_user_id = $user_email = '';$cur_user_id = get_current_user_id();$user_data = get_userdata( $cur_user_id );$user_email = $user_data->data->user_email;if(!empty($cur_user_id) && is_numeric($cur_user_id)){	if(isset($_POST['email_set']) && !empty($_POST['email_set'])){				if(isset($_POST['paypal_email']) && !empty($_POST['paypal_email'])){			$prv = get_user_meta($cur_user_id, 'user_paypal_email', TRUE);			if($prv){				update_user_meta( $cur_user_id, 'user_paypal_email', $_POST['paypal_email'] );			}			else{				add_user_meta( $cur_user_id, 'user_paypal_email', $_POST['paypal_email'] );			}		}				if(isset($_POST['account_login_email']) && !empty($_POST['account_login_email'])){			$usr_id = wp_update_user( array( 'ID' => $cur_user_id, 'user_email' => $_POST['account_login_email'] ) );			if ( is_wp_error( $usr_id ) ) {								echo 'There is an error at user login email update';			} else {				$user_email = $_POST['account_login_email'];				echo 'info success';			}		}			}	}
if(count($pagearray)>0){
	/*echo '<pre>';
	print_r($getpagarr);*/?>
	<table class="shop_table my_account_orders">
	<tr>
		<th class="order-number"><span class="nobr">Date</span></th>
		<th class="order-number"><span class="nobr">Event</span></th>
		<th class="order-number"><span class="nobr">Amount</span></th>
		<th class="order-actions">&nbsp;</th>
	</tr>
	<?php 
	krsort($pagearray);
	foreach($pagearray as $key => $orproductproqc){?>
	<tr  class="order">
			<td class="order-date"><?php echo $orproductproqc['date']; ?></td>
			<td class="order-status" style="text-align:left; white-space:nowrap;"><span style="color:blue;font-size: 16px;"><?php echo $orproductproqc['post_title']; ?></span> <?php if($orproductproqc['type']=='payoff'){echo ':: ';if($orproductproqc['stock']=='draft'){echo 'Pending';}else{echo 'Completed';}}else{?>endded successfully (<?php echo $orproductproqc['stock']; ?> shirt<?php if($orproductproqc['stock']>1){echo 's';}else{}?> sold)<?php }?></td>
			<td class="order-total"><?php echo $orproductproqc['amount']; ?> </td>
		</tr>
		<?php 
	}?>
	</table>
	<?php if($totamt>0){?>
	<div class="chencbutton">
	<div class="grnLnk"><a href="javascript:void(0);" onclick="request_payoff('<?php echo $payoffstr;?>','<?php echo $current_user->ID;?>','<?php echo $totamt;?>');">Request Payout for amount $<?php echo $totamt;?></a></div>
	</div>
	<?php 	
	}?>
	<?php 
}else{?>
	<span class="noval"> You don't have any profit yet...</span> 
	<div class="grnLnk"><a href="<?php echo bloginfo('url'); ?>/design/"> Launch a campaign </a></div>		<form action="" method="post" class="email-accounts-cont">		<div class="field-group">			<label>Paypal Account Email</label>			<input type="email" name="paypal_email" value="<?php echo get_user_meta($cur_user_id, 'user_paypal_email', TRUE); ?>"/>		</div>				<div class="field-group">			<label>Account Login Email</label>			<input type="email" name="account_login_email" value="<?php if(!empty($user_email)) echo $user_email; ?>"/>		</div>						<div class="field-group">			<label>&nbsp;</label>			<input type="submit" name="email_set" value="Save Emails"/>		</div>				<div class="clearfix"></div>			</form>
<?php }
?>
	
</div>
<!--Get Paid Section Ends Here-->



<div class="edditcommyaccount <?php if(isset($_GET['p']) && !empty($_GET['p']) && ($_GET['p']=='account')){}else{echo 'coldivsc';}?>" id="edditcom">
	<?php
	printf(
		__( 'Hello, <strong>%s</strong>. From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">change your password</a>.', 'woocommerce' ),
		$current_user->display_name,
		get_permalink( woocommerce_get_page_id( 'change_password' ) )
	);
	?>


<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php woocommerce_get_template( 'myaccount/my-downloads.php' ); ?>

<?php woocommerce_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php woocommerce_get_template( 'myaccount/my-address.php' ); ?>
</div>
<?php do_action( 'woocommerce_after_my_account' ); ?>
<script>
	/*function opend(txt){
		$('.coldivsc').css('display','none');
		$('#'+txt).css('display','block');
	}*/
	<?php //if(!isset($_GET['p'])){?>
	/*opend('campaigns');*/
	<?php //}?>
	function gotopage(txt,txt1){//alert(txt);
		//alert('<?php echo get_permalink( 359 ); ?>');
		if(txt=='delete'){
			var r = confirm("Are you sure you want to delete this product?");
		}else{
			var r = true;
		}
		if (r == true)
		  {
		  j.post('<?php echo get_template_directory_uri(); ?>/addvalses.php', {paval:txt,proval:txt1}).done(function(data){//alert(data);
			if(data=='done'){location.reload();}else{window.location.href=txt;}
				});
		  }
		
		
	}
function addtocartpup(txt){
	j('.redTxt').html('');
	if(j('#email'+txt).val()==''){
		j('#email_err'+txt).html('This field is required.');
		j('#email'+txt).focus();
	}else
	if(j('#name'+txt).val()==''){
		j('#name_err'+txt).html('This field is required.');
		j('#name'+txt).focus();
	}else
	if(j('#subject'+txt).val()==''){
		j('#subject_err'+txt).html('This field is required.');
		j('#subject'+txt).focus();
	}else
	if(j('#content'+txt).val()==''){
		j('#content_err'+txt).html('This field is required.');
		j('#content'+txt).focus();
	}else{
		j.post( "<?php echo get_template_directory_uri(); ?>/ajaxbuyermail.php?pro_id="+txt,j('#senb'+txt).serialize(),function( data ) {//alert(data);
		$('#cgehckban'+txt).css('display','none');
		});
					}
}
function request_payoff(txt,txt1,txt2){
$('#payoffmsg').html('<font color="green">Processing...Please Wait!</font>');
	j.post( "<?php echo get_template_directory_uri(); ?>/payoff.php",{pro_ids:txt,user_id:txt1,totamt:txt2},function( data ) {//alert(data);
	if(data='ok'){
		$('#payoffmsg').html('<font color="green">Your Payout Request is sent successfully. Admin will review it soon</font>');
	}
		});
}
function setvalch(txt,txt1,txt2){
	if(txt1=='Cancel'){
		j.post( "<?php echo bloginfo ('url'); ?>/paypal/templates/CancelPreapproval.php",{order_id:txt2},function( data ) {//alert(data);
	if(data='ok'){
		window.location.href=txt;
	}
		});
	}else{
		window.location.href=txt;
	}
}
</script>


