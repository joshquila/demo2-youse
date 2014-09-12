<?php
/*
Template Name: Request Goal Drop
*/
ob_start();
session_start();
?>
<?php
//echo $_SERVER[REQUEST_URI];
//$array = explode("/", $_SERVER[REQUEST_URI]);
$profit_val = mysql_fetch_array(mysql_query("Select meta_value from wp_postmeta where post_id=460 AND meta_key='profit_margin'"));
if(isset($profit_val['meta_value']) && !empty($profit_val['meta_value'])){
	$profitv = $profit_val['meta_value'];
}else{
	$profitv = 0;
}
$fetch_id = base64_decode(base64_decode($_SESSION['proval']));
$profit_valparentval = mysql_fetch_array(mysql_query("SELECT post_parent FROM wp_posts WHERE ID = ".$fetch_id." AND post_type='product' AND post_status='publish'"));
/*print_r($profit_valparentval);*/
$_SESSION['profitv'] = $profitv;

$_SESSION['proid'] = $profit_valparentval['post_parent'];
$product_edit_stock = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_stock' AND post_id=". $fetch_id);
//echo "SELECT meta_value FROM wp_postmeta WHERE meta_key='_regular_price' AND post_id=". $fetch_id;
$product_edit_rp = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key='_regular_price' AND post_id=". $fetch_id);
//echo $product_edit_check[0]->meta_value;

if($_REQUEST['edt_campaign']=='Submit Request >>')
{
	update_post_meta($fetch_id,'_stock',$_REQUEST['stock']);
	unset($_SESSION['proval']);?>
	<script>
	window.location = '<?php echo get_permalink( 10 ); ?>';
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
			if(j('#stock').val()==''){
				j('#stock_err').html('This field is required.');
				j('#stock').focus();
				return false;
			}else if(j('#stock').val()<10){
				j('#stock_err').html('Value should be greater than 10');
				j('#stock').focus();
				return false;
			}else if(j('#stock').val()>1001){
				j('#stock_err').html('Value should be less than or equal to 1000');
				j('#stock').focus();
				return false;
			}
		});
		
	})
	function getbaseprice(txt){//alert(txt);
		j.post('<?php echo get_template_directory_uri(); ?>/getprodbaseprice.php', {prodifg:txt}).done(function(data) {//alert(data);
	var prob = '<?php echo $profitv;?>';


	j('#newbaseprice').html('$'+(parseFloat(data)+parseFloat(prob)));
	j('#newbasepricehidden').val(parseFloat(data)+parseFloat(prob));
	
 });
	}
</script>

 <!--Body start-->
	<div class="mainBdy row goaldropmyacc">
		<form id="productpost" method="POST">
			<div style="width:100%; position:relative; overflow:hidden; margin-top:20px; ">
				<div id="step3rd" >        
					
					<div id="goaldropm"> 
			<div class="mnHdng"><h1>Request Goal Drop</h1></div>
        	<div class="glDrp">
				<p>Your Current Goal is: <?php echo $product_edit_stock[0]->meta_value;?></p>
				<p>Enter your new goal below</p>
				<p><strong>It must be:</strong></p>
				<ul class="pts">
    				<li>At least equal to current amount sold</li>
    				<li>Lower than your current goal</li>
    				<li>At least 10</li>
				</ul>
				<!--<p class="hglht">Please note: You can only request a goal drop once per campaign</p>-->
				<div class="bsPrc">
					<div class="txtFld"><input name="stock" type="text" id="stock" value="<?php echo $product_edit_stock[0]->meta_value;?>" onkeyup="getbaseprice(this.value);"  />
					<div id="stock_err" class="redTxt"></div></div>
					
					<div class="bsAmt">
						<p>Your current base price is: $<?php echo $product_edit_rp[0]->meta_value;?> </p>
						<p>Your new base price would be: <strong><span id="newbaseprice"></span><input type="hidden" id="newbasepricehidden" name="newbasepricehidden"/></strong></p>
						<!--<p>Your new base price would be: <strong>$17.00</strong></p>-->
					</div>
				</div>
				<div class="sbmt">
				<input type="submit" name="edt_campaign" id="edt_campaign" value="Submit Request >>" class="clickme2 cmnBtn" />
				<!--<p>Your request will be reviewed by our Customer Support team within the hour and, if approved, will be processed shortly thereafter.</p>-->
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
