<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; ?>

<?php $woocommerce->show_messages(); 
ob_start();
@session_start();
$_SESSION['reditect_page'] = 'my-account/';?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
<script type="text/javascript">
function valchange(id){
$('.col-1').hide();
$('#'+id).show();
}
</script>
<div class="col2-set" id="customer_login">

	<div id="log2" class="col-1">

<?php endif; ?>
		
			<h2 class="titl"><?php _e( 'Login', 'woocommerce' ); ?>
			<span class="hvAct"><a href="javascript:valchange('reg2');">Create New Account</a></span>
			</h2>
		
		
		<form method="post" class="login">
			<p class="form-row form-row-first">
				<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<p class="form-row">
				<?php $woocommerce->nonce_field('login', 'login') ?>
				<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
				<a class="lost_password" href="<?php

				$lost_password_page_id = woocommerce_get_page_id( 'lost_password' );

				if ( $lost_password_page_id )
					echo esc_url( get_permalink( $lost_password_page_id ) );
				else
					echo esc_url( wp_lostpassword_url( home_url() ) );

				?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
			</p>
		</form>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-1" id="reg2" style="display:none;">

		<h2 class="titl"><?php _e( 'Register', 'woocommerce' ); ?><span class="hvAct"><a href="javascript:valchange('log2');" class="hvAct">Already have account</a></span></h2>
		<form method="post" class="register">

			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">

			<?php endif; ?>

				<label for="reg_email"><?php _e( 'Email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>

			<p class="form-row form-row-first">
				<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
			</p>
			<p class="form-row form-row-last">
				<label for="reg_password2"><?php _e( 'Re-enter password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
			</p>
			<div class="clear"></div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php $woocommerce->nonce_field('register', 'register') ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
			</p>

		</form>
		<div class="clearFix"></div>
	</div>
	<div class="col-2">
		<h2 class="titl">Or login with any of the following</h2>
		<p class="txt">Do you already have an account on one of these sites? Click the logo below to login with it here:</p>
		<ul class="socl">
			<li>
				<a href="<?php echo bloginfo('url'); ?>/facebook_twitter_login/?login&oauth_provider=facebook">
					<p>login with</p>
					<?php //echo(get_template_directory_uri())?>
					<p><img alt="Facebook" src="<?php echo(get_template_directory_uri())?>/images/facebook.jpg"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo bloginfo('url'); ?>/facebook_twitter_login/google_login.php">
					<p>login with</p>
					<p><img alt="Google" src="<?php echo(get_template_directory_uri())?>/images/google.jpg"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo bloginfo('url'); ?>/facebook_twitter_login/yahoo">
					<p>login with</p>
					<p><img alt="Yahoo" src="<?php echo(get_template_directory_uri())?>/images/yahoo.jpg"></p>
				</a>
			</li>
		</ul>
		<div class="clearFix"></div>
	</div>
	<div class="clearFix"></div>
</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>