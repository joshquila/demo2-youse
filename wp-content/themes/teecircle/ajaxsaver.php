<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
//set_new_cookie($_POST['front_view'],$_POST['back_view']);
//$a = '<div class="dsgnCen notindesign" style="position:relative;">'.$_POST['design'].'</div>';
//echo $_POST['design'];
    // yes, this is a PHP 5.3 closure, deal with it
	if(isset($_POST['design']) && !empty($_POST['design'])){
		//setcookie('design', $_POST['design'], strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN);
		$_SESSION['design'] = $_POST['design'];
		//setcookie('design', $_POST['design'], strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN);
		$styorg = explode('==++==',$_POST['style_na']);
		$_SESSION['style_na'] = $styorg[0];
		//setcookie('style_na', $styorg[0], strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN);
		$_SESSION['base_q'] = $_POST['base_q'];
		//setcookie('base_q', $_POST['base_q'], strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN);
		$_SESSION['proid'] = $_POST['proid'];
		//setcookie('proid', $_POST['proid'], strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN);
		$_SESSION['proprice'] = $_POST['proprice'];
		$_SESSION['front_print_area'] = $_POST['front_print_area'];
		$_SESSION['back_print_area'] = $_POST['back_print_area'];
		//setcookie('proprice', $_POST['proprice'], strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN);echo 'kjk';
	}else{
	//setcookie('design', null, strtotime('-1 day'), COOKIEPATH, COOKIE_DOMAIN);
	}
	die();
//echo $_SESSION['design'];
?>
