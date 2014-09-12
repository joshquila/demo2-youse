<?php
ob_start();
session_start();
require_once("../../../wp-load.php");

$prin = str_replace('$','',$_POST['checkp']);
if($prin<$_SESSION['proprice']){
	echo '$'.$_SESSION['proprice'].'++++With a price of $'.$_SESSION['proprice'].' your profit is $0.00 per tee++++0.00';
}else{
	$prn = $prin-$_SESSION['proprice'];
	echo '$'.$prin.'++++With a price of $'.$prin.' your profit is $'.$prn.' per tee++++'.$prn;
}
die();
?> 