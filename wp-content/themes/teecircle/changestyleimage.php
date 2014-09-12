<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
$qy = mysql_fetch_array(mysql_query("SELECT wppm.meta_value FROM `wp_postmeta` as wppm WHERE wppm.`meta_key`='_manage_pic' AND wppm.post_id=".$_POST['vid']));
			echo $qy['meta_value'];
	die();
?>