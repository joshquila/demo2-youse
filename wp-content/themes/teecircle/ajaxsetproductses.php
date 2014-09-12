<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
$_SESSION['_shipping_option'] = $_POST['shipping_options'];
$_SESSION['_campain_valid_from'] = time();
$_SESSION['_campain_valid_to'] = $_POST['campain_length'];
$_SESSION['_regular_price'] = $_POST['amountset'];
$_SESSION['post_title']=$_POST['campain_title'];
$_SESSION['post_content']=$_POST['description'];
$_SESSION['post_name']=$_POST['choose_url'];
$_SESSION['base_q'] = $_POST['amount'];
for($g=0;$g<count($_POST['prostye']);$g++){
	$_SESSION['prostye'][$v] = $_POST['prostye'][$g];
} 
?>
