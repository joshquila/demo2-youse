<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
/*echo '<pre>';print_r($_SESSION['pronar'][$_GET['pro_id']]);print_r($_POST); echo $_POST['content'.$_GET['pro_id']]; echo '</pre>';*/

$prodid=$_POST['prodid'.$_GET['pro_id']];
$from_email=$_POST['email'.$_GET['pro_id']];
$supplier_id=$current_user->ID;
$name=$_POST['name'.$_GET['pro_id']];
$subject=$_POST['subject'.$_GET['pro_id']];
$content=$_POST['content'.$_GET['pro_id']];
//echo("<br/>Product ID: $prodid <br/>");

//echo($query);
//remove duplicate emails from array
//var_dump($_SESSION);
$pronar=array_unique($_SESSION['pronar'][$_GET['pro_id']]);
foreach($pronar as $key=>$value){
	$custo_id = explode('==++==',$key);
	$buyer_id = $custo_id[0];
	$order_id =  $custo_id[1];
	$to=$value;
	$query="insert into wp_cust_messages(`from`,`to`,`buyer_id`,`supplier_id`,`subject`,`message`,`order_id`,`product_id`) values('$from_email','$to',$buyer_id,$supplier_id,'$subject','$content',$order_id,$prodid)";
	//echo"Query".$query;
	mysql_query($query)or die(mysql_error());
	//mail($to,$subject,$content);
	if(mail($to,$subject,$content)){
		echo"Mail Sent to : $to";
	}else{
		echo"Mail Sending to : $to (Failed)";
	}
}

?> 