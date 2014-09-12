<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php $woocommerce->show_messages(); ?>

<form action="<?php echo esc_url( get_permalink(woocommerce_get_page_id('change_password')) ); ?>" method="post" name="formregister" id="formregister">

	<div class="form-row form-row-first">
		<label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password_1" id="password_1" />
<div class="redTxt" id="passworderrreg"></div>

	</div>
	<div class="form-row form-row-last">
		<label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password_2" id="password_2" />
<div class="redTxt" id="repassworderrreg"></div>
	</div>
	<div class="clear"></div>

	<div class="grnLnk"><a href="javascript:void(0);" onclick="get_register();"><?php _e( 'Save', 'woocommerce' ); ?></a><!-- <input type="button" name="change_password" value="<?php _e( 'Save', 'woocommerce' ); ?>"  onclick="get_register();" />--></div>

	<?php $woocommerce->nonce_field('change_password')?>
	<input type="hidden" name="action" value="change_password" />

</form>
<script>
	function get_register(){
		var err =0;
$('.redTxt').html('');
if($('#password_1').val()==''){
	$('#passworderrreg').html('Please enter Password');
	err = 1;
return false;
}else if($('#password_1').val()!=''){
	var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
	var spass=$('#password_1').val();
	if (!StrongPass.test(spass)) {
		$('#passworderrreg').html('Password must contain at least one upper case letter, one lower case letter and one digit.');
		err = 1;
       return false;
    }
}
if($('#password_2').val()==''){
	$('#repassworderrreg').html('Please enter Password again');
	err = 1;
return false;
}
if($('#password_2').val()!=$('#password_1').val()){
	$('#repassworderrreg').html('Password does not match');	
	err = 1;
return false;
}
if(err==0){
	//return true;
	document.formregister.submit();
}
}
</script>