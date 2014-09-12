<?php
/*
Template Name: Edit Product
*/
ob_start();
session_start();
?>
<?php
//echo $_SERVER[REQUEST_URI];
//$array = explode("/", $_SERVER[REQUEST_URI]);
$fetch_id = base64_decode(base64_decode($_SESSION['proval']));

$product_edit = $wpdb->get_results("SELECT post_title,post_content,post_name FROM wp_posts WHERE post_type='product' AND ID=". $fetch_id);

$product_edit_image = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_manage_pic' AND post_id=". $fetch_id);

$product_edit_check = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_shipping_option' AND post_id=". $fetch_id);
//echo $product_edit_check[0]->meta_value;

if($_REQUEST['edt_campaign']=='Save Changes >>')
{
	//echo "Insert";die();
	$my_post = array();
	$my_post['ID'] = $fetch_id;
	$my_post['post_title'] = $_REQUEST['campain_title'];
	$my_post['post_content'] = $_REQUEST['description'];
	wp_update_post( $my_post );
	
	update_post_meta($fetch_id,'_shipping_option',$_REQUEST['shipping_options']);
	 if($_REQUEST['shipping_options']=='yes'){
	 	$shippingval_old = 66;
			$shippingval = 64;
		}else{
			$shippingval_old = 64;
			$shippingval = 66;
		}
		/*echo $shippingval;
		die();*/
		mysql_query("update `".$wpdb->prefix."term_relationships` set `term_taxonomy_id`=".$shippingval." where `object_id`='".$fetch_id."' and `term_taxonomy_id`=".$shippingval_old);

	$utl = $product_edit[0]->post_name;
	unset($_SESSION['proval']);?>
	<script>
	var shecjty = '<?php echo $utl;?>';
	window.location = '<?php echo bloginfo ('url')."/product/"; ?>'+shecjty;
	</script>
<?php
}
/*print_r($product_edit_image);
echo $product_edit[0]->post_title;*/
?>

<?php get_header('inner');?>

<script>
	j(function(){
		j('#edt_campaign').click(function(){
			j('.redTxt').html('');
			if(j('#campain_title').val()==''){
				j('#campain_title_err').html('This field is required.');
				j('#campain_title').focus();
				return false;
			}else
			if(j('#description').val()==''){
				j('#description_err').html('This field is required.');
				j('#description').focus();
				return false;
			}
		});
	})
</script>

 <!--Body start-->
	<div class="mainBdy row productedtval">
		<div style="font: 35px 'Conv_UFONTS.COM_BRYANT-BOLD';color: #384047;margin-bottom: 20px;margin-top: 40px;padding-bottom: 15px;">
			Edit '<?php echo $product_edit[0]->post_title; ?>'
		</div> 
		<form id="productpost" method="POST">
			<div style="width:100%; position:relative; overflow:hidden; margin-top:20px; ">
				<div id="step3rd" style="float:left; background:#fff;" >        
					<div style="float:left; width:500px; height:auto;">
						<div class="smlBx">
							<h3>Campaign title</h3>
							<input type="text" name="campain_title" id="campain_title" class="txtartxt" maxlength="40" value="<?php echo $product_edit[0]->post_title; ?>" />
							<div id="campain_title_err" class="redTxt"></div>
							<p>Summarize your campaign in 40 characters or less</p>
						</div>

						<div class="smlBx">
							<h3>Description</h3>
							<div id="description_err" class="redTxt"></div>
							<textarea name="description" class="txtar ckeditor" id="description"><?php echo $product_edit[0]->post_content; ?></textarea>
						</div>

						<div class="smlBx">
							<h3> Shipping options</h3>
							<p>
								<input type="checkbox" name="shipping_options" value="yes"<?php if($product_edit_check[0]->meta_value=='yes'){echo "checked";} ?> />Allow buyers to pick-up their orders from you (pickup shipping is free)
							</p>
						</div>

						<div class="smlBx">
							<input type="submit" name="edt_campaign" id="edt_campaign" value="Save Changes >>" class="clickme2 cmnBtn" />
							<!-- or <a href="javascript:get_preview('<?php echo get_permalink(311); ?>')">Preview</a>-->
						</div>
					</div>
					<div style="float:right; width:450px;">
						<div class="dsgnCen notindesign" style="position:relative;">
							<?php echo stripcslashes(stripcslashes($product_edit_image[0]->meta_value)); ?>
						</div>
					</div>
				</div>  
			</div>     <!-- <input type="hidden" name="uid" value="<?php echo get_current_user_id( );?>" />-->
		</form>
		<div class="clearFix"></div>
	</div>
<!--Body end--> 

<div class="clearboth"></div>

<?php get_footer('inner'); ?> 
<script src="<?php echo get_template_directory_uri(); ?>/js/ckeditor/ckeditor.js"></script>