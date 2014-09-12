<?php
/*
Template Name: Early End
*/
ob_start();
session_start();
?>
<?php
//echo $_SERVER[REQUEST_URI];
//$array = explode("/", $_SERVER[REQUEST_URI]);
$fetch_id = base64_decode(base64_decode($_SESSION['proval']));
$product_edit = $wpdb->get_results("SELECT post_title FROM wp_posts WHERE post_type='product' AND ID=". $fetch_id);
if($_REQUEST['edt_campaign']=='End Early')
{

	add_post_meta($fetch_id,'_early_end','yes');
update_post_meta( $fetch_id, '_campain_valid_to', time());

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
			if(!j('#early_end').is(":checked")){
				//j('#stock_err').html('This field is required.');
				j('#early_end').focus();
				return false;
			}
		});
	})
</script>

 <!--Body start-->
	<div class="mainBdy row earlyendmyacc">
		<form id="productpost" method="POST">
			<div style="width:100%; position:relative; overflow:hidden; margin-top:20px; ">
				<div id="step3rd">        
					<div id="earlyend"> 
			<div class="mnHdng"><h1>End Early</h1></div>
        	<div class="endRly">
				<p class="hglht">You are about to end the campaign "<?php echo $product_edit[0]->post_title;?>".</p>
				<p>This campaign hasn't reached its sales goal. If you end it now, no one will be charged and the shirts will not be printed.</p>
				<p class="hglht"><input name="early_end" type="checkbox" value="end" id="early_end" /> I'm sure I want to end this campaign early, and understand this cannot be undone.</p>
				<div id="early_end_err" class="redTxt"></div>
				<p>Your request will be reviewed by our Customer Support team within the hour and, if approved, will be processed shortly thereafter.</p>
				<div class="sbmt">
				<input type="submit" name="edt_campaign" id="edt_campaign" value="End Early" class="clickme2 cmnBtn" />
					<a class="lrnMr" href="<?php echo get_permalink( 10 ); ?>">Cancel</a>
				</div>
				<p><em>Please note the ending process may, rarely, take up to an hour to complete.</em></p>
			</div>
      </div>
			</div>     <!-- <input type="hidden" name="uid" value="<?php echo get_current_user_id( );?>" />-->
		</form>
		<div class="clearFix"></div>
	</div>
<!--Body end--> 

<div class="clearboth"></div>

<?php get_footer('inner'); ?> 
