<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
//echo "SELECT meta_key,meta_value FROM `wp_postmeta` WHERE post_id=".$_SESSION['proid']." AND meta_key LIKE 'base_cost_shirts_%'";
$post_prod=mysql_query("SELECT meta_key,meta_value FROM `wp_postmeta` WHERE post_id=".$_SESSION['proid']." AND meta_key LIKE 'base_cost_shirts_%'");
while($row_base = mysql_fetch_array($post_prod)){
$exexpl = explode('_',str_replace('base_cost_shirts_','',$row_base['meta_key']));
  if($_REQUEST['prodifg']<$exexpl[1]){
  	//echo $row_base['meta_key'];
	$_SESSION['proprice'] =$row_base['meta_value'];
	echo $row_base['meta_value'];
	die();
	}
}
	/*if($_REQUEST['prodifg']<50){
		$firldname  = 'base_cost_shirts_0_50';
	}else if($_REQUEST['prodifg']<100){
		$firldname  = 'base_cost_shirts_50_100';
	}else if($_REQUEST['prodifg']<150){
		$firldname  = 'base_cost_shirts_100_150';
	}else if($_REQUEST['prodifg']<200){
		$firldname  = 'base_cost_shirts_150_200';
	}else if($_REQUEST['prodifg']<250){
		$firldname  = 'base_cost_shirts_200_250';
	}else if($_REQUEST['prodifg']<300){
		$firldname  = 'base_cost_shirts_250_300';
	}else if($_REQUEST['prodifg']<350){
		$firldname  = 'base_cost_shirts_300_350';
	}else if($_REQUEST['prodifg']<400){
		$firldname  = 'base_cost_shirts_350_400';
	}else if($_REQUEST['prodifg']<450){
		$firldname  = 'base_cost_shirts_400_450';
	}else if($_REQUEST['prodifg']<500){
		$firldname  = 'base_cost_shirts_450_500';
	}else if($_REQUEST['prodifg']<550){
		$firldname  = 'base_cost_shirts_500_550';
	}else if($_REQUEST['prodifg']<600){
		$firldname  = 'base_cost_shirts_550_600';
	}else if($_REQUEST['prodifg']<650){
		$firldname  = 'base_cost_shirts_600_650';
	}else if($_REQUEST['prodifg']<700){
		$firldname  = 'base_cost_shirts_650_700';
	}else if($_REQUEST['prodifg']<750){
		$firldname  = 'base_cost_shirts_700_750';
	}else if($_REQUEST['prodifg']<800){
		$firldname  = 'base_cost_shirts_750_800';
	}else if($_REQUEST['prodifg']<850){
		$firldname  = 'base_cost_shirts_800_850';
	}else if($_REQUEST['prodifg']<900){
		$firldname  = 'base_cost_shirts_850_900';
	}else if($_REQUEST['prodifg']<950){
		$firldname  = 'base_cost_shirts_900_950';
	}else if($_REQUEST['prodifg']>=950){
		$firldname  = 'base_cost_shirts_950_1000';
	}*/
	//echo $firldname;
	//echo $_SESSION['proid'];
	//$priceval = get_post_meta( $_SESSION['proid'], $firldname, true);
	//$_SESSION['proprice'] = $priceval;
	//echo $priceval;
	//die();
?>