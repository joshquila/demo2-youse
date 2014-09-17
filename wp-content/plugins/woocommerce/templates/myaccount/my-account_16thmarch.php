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

global $woocommerce;global $wpdb; 

$orproduct_pro  = $wpdb->get_results("SELECT a.meta_value as order_prod_id,a.order_item_id,c.order_id,d.meta_value as buyer_id,e.meta_value as buyer_email FROM wp_woocommerce_order_itemmeta as a,wp_posts as b,wp_woocommerce_order_items as c,wp_postmeta as d,wp_postmeta as e WHERE a.meta_key='_product_id' AND a.meta_value=b.ID AND b.post_author=".$current_user->ID." AND c.order_item_id=a.order_item_id AND d.post_id=c.order_id AND d.meta_key='_customer_user'AND e.post_id=c.order_id AND e.meta_key='_billing_email'");
/*print_r($orproduct_pro);*/
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
<?php $product_active = $wpdb->get_results("SELECT ID,post_title,post_content,post_status,post_name FROM wp_posts WHERE post_type='product' AND post_author=". $current_user->ID);
$activearr = array();
$inactivearr = array();
$draftarr = array();
$userarr = array();
$k=0;
foreach($product_active as $productactive){//echo $k;
	if(in_array($productactive->ID,$orproduct_pro)){
		$orproduct_proid  = $wpdb->get_results("SELECT order_item_id FROM wp_woocommerce_order_itemmeta WHERE meta_key='_product_id'");
		
	}
	$product_image = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_manage_pic' AND post_id=". $productactive->ID);
	$product_activem = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_campain_valid_to' AND post_id=". $productactive->ID);
	$product_stock = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_stock' AND post_id=". $productactive->ID);
	$product_endearly = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_end_early' AND post_id=". $productactive->ID);
	//print_r($product_endearly);
	$product_enddat = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_edit_lock' AND post_id=". $productactive->ID);
	
	if($productactive->post_status=='publish'){
		
		if(($product_activem[0]->meta_value >time()) && (count($product_endearly)==0)){
			//echo("Active");
			/*$activearr[] = $productactive;*/
			$activearr[$k]['ID'] = $productactive->ID;
			$activearr[$k]['post_title'] = $productactive->post_title;
			$activearr[$k]['post_content'] = $productactive->post_content;
			$activearr[$k]['post_name'] = $productactive->post_content;
			$activearr[$k]['end_time'] = $product_activem[0]->meta_value;
			$activearr[$k]['stock'] = $product_stock[0]->meta_value;
			$activearr[$k]['products_image'] = $product_image[0]->meta_value;
			
		}else{
			//echo("InActive");
			$inactivearr[$k]['ID'] = $productactive->ID;
			$inactivearr[$k]['post_title'] = $productactive->post_title;
			$inactivearr[$k]['post_content'] = $productactive->post_content;
			$inactivearr[$k]['post_name'] = $productactive->post_content;
			$inactivearr[$k]['end_time'] = $product_activem[0]->meta_value;
			$inactivearr[$k]['stock'] = $product_stock[0]->meta_value;
			$inactivearr[$k]['products_image'] = $product_image[0]->meta_value;
		}	
	}else{
		if($productactive->post_status=='draft'){
			/*$draftarr[] = $productactive;*/
			$draftarr[$k]['ID'] = $productactive->ID;
			$draftarr[$k]['post_title'] = $productactive->post_title;
			$draftarr[$k]['post_content'] = $productactive->post_content;
			$draftarr[$k]['post_name'] = $productactive->post_content;
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
			/*}*/

	?>
		<div class="listings">
			<div class="left">
				<div class="box">
					<input type="button" class="activeBtn" value="Active" />
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
				<div class="subTxt"><?php if(strlen($activearrr['post_content'])>150){echo substr($activearrr['post_content'],0,147).'...';}else{echo $activearrr['post_content'];} ?></div>
				<div class="barBack">
				<?php $perc = ((count($_SESSION['pronar'][$activearrr['ID']])/$activearrr['stock'])*100);
				if(empty($perc)){$perc = '0.5';}else{$perc = 0.5+$perc;}?>
					<div class="barInside" style="width: <?php echo $perc;?>%"></div>
				</div>
				<ul class="sellingDtls">
					<li>
						<div class="hding"><?php echo $time_diff; ?></div>
						<div class="bottomText">Remaining</div>
					</li>
					<li>
						<div class="hding"><?php echo count($_SESSION['pronar'][$activearrr['ID']]);?>/<?php echo $activearrr['stock']; ?></div>
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
		echo '<span class="noval">No active Campaign is found!</span>';
	}
	?>
	<!--Active Campaign Ends Here-->
	
	<!--End Campaign Starts Here-->
	<div class="hdng">Ended campaigns</div>
	<?php 
	if(count($inactivearr)>0){
		foreach($inactivearr as $inactivearrr){
	?>
		<div class="listings">
			<div class="left">
				<div class="box">
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
				<div class="subTxt"><?php if(strlen($inactivearrr['post_content'])>150){echo substr($inactivearrr['post_content'],0,147).'...';}else{echo $inactivearrr['post_content'];} ?></div>
				<div class="barBack">
				<?php $perc = ((count($_SESSION['pronar'][$inactivearrr['ID']])/$inactivearrr['stock'])*100);
				if(empty($perc)){$perc = '0.5';}else{$perc = 0.5+$perc;}?>
					<div class="barInsideInctv" style="width: <?php echo $perc;?>%"></div>
				</div>
				<ul class="sellingDtls">
					<li>
						<div class="hding"><?php echo date('d/m/y',$inactivearrr['end_time']); ?></div>
						<div class="bottomText">Ended</div>
					</li>
					<li>
						<div class="hding"><?php echo count($_SESSION['pronar'][$inactivearrr['ID']]);?>/<?php echo $inactivearrr['stock']; ?></div>
						<div class="bottomText">Sold</div>
					</li>
				</ul>
				<ul class="editDtls">
					<li><a href="javascript:void(0);" onclick="gotopage('<?php echo get_permalink( 34 ); ?>','<?php echo base64_encode(base64_encode($inactivearrr['ID'])); ?>');">Relaunch Campaign</a></li>
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
		echo '<span class="noval">No inactive Campaign is found!</span>';
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
				<div class="hdngTxt"><a href="<?php echo bloginfo ('url')."/product/".$draftarrr['post_name']; ?>"><?php echo $draftarrr['post_title']; ?></a></div>
				<div class="subTxt"><?php if(strlen($draftarrr['post_content'])>150){echo substr($draftarrr['post_content'],0,147).'...';}else{echo $draftarrr['post_content'];} ?></div>
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
		echo '<span class="noval">No draft Campaign is found!</span>';
	}
	?>
</div>
<!--Draft Section Ends Here-->

<!--Get Paid Section Starts Here-->
<div class="content getpadisdf <?php if(isset($_GET['p']) && !empty($_GET['p']) && ($_GET['p']=='get_paid')){}else{echo 'coldivsc';}?>" id="get_paid">
	<span style="color: #c09853;"> You don't have any profit yet...</span> <a href="<?php echo bloginfo('url'); ?>/design/"> Launch a campaign </a>
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
		  j.post('<?php echo get_template_directory_uri(); ?>/addvalses.php', {paval:txt,proval:txt1}).done(function(data){alert(data);
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
		});
					}
}
</script>


