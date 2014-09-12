<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
if(isset($_SESSION['post_id'])&& !empty($_SESSION['post_id'])){$sqls=mysql_num_rows(mysql_query("select `post_name` from `".$wpdb->prefix."posts` where `post_name`='".$_POST['name']."' AND ID!=".$_SESSION['post_id']));}else{
	$sqls=mysql_num_rows(mysql_query("select `post_name` from `".$wpdb->prefix."posts` where `post_name`='".$_POST['name']."'"));
}
echo $sqls;


?> 