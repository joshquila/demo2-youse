<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
$prodid = str_replace('tee_product','',$_REQUEST['prodifg']);
/*echo "SELECT 
	wppm1.meta_value as print_area_front_height,
	wppm2.meta_value as print_area_front_width,
	wppm3.meta_value as print_area_front_top,
	wppm4.meta_value as print_area_front_left,
	wppm5.meta_value as print_area_back_height,
	wppm6.meta_value as print_area_back_width,
	wppm7.meta_value as print_area_back_top,
	wppm8.meta_value as print_area_back_left 
	FROM 
	`wp_postmeta` as wppm1,
	`wp_postmeta` as wppm2,
	`wp_postmeta` as wppm3,
	`wp_postmeta` as wppm4,
	`wp_postmeta` as wppm5,
	`wp_postmeta` as wppm6,
	`wp_postmeta` as wppm7,
	`wp_postmeta` as wppm8 
	WHERE 
	wppm1.`meta_key`='print_area_front_height' AND wppm1.post_id=".$prodid." AND 
	wppm2.`meta_key`='print_area_front_width' AND wppm2.post_id=".$prodid." AND 
	wppm3.`meta_key`='print_area_front_top' AND wppm3.post_id=".$prodid." AND 
	wppm4.`meta_key`='print_area_front_left' AND wppm4.post_id=".$prodid." AND 
	wppm5.`meta_key`='print_area_back_height' AND wppm5.post_id=".$prodid." AND 
	wppm6.`meta_key`='print_area_back_width' AND wppm6.post_id=".$prodid." AND 
	wppm7.`meta_key`='print_area_back_top' AND wppm7.post_id=".$prodid." AND 
	wppm8.`meta_key`='print_area_back_left' AND wppm8.post_id=".$prodid;*/
	$qy = mysql_fetch_array(mysql_query("SELECT 
	wppm1.meta_value as print_area_front_height,
	wppm2.meta_value as print_area_front_width,
	wppm3.meta_value as print_area_front_top,
	wppm4.meta_value as print_area_front_left,
	wppm5.meta_value as print_area_back_height,
	wppm6.meta_value as print_area_back_width,
	wppm7.meta_value as print_area_back_top,
	wppm8.meta_value as print_area_back_left 
	FROM 
	`wp_postmeta` as wppm1,
	`wp_postmeta` as wppm2,
	`wp_postmeta` as wppm3,
	`wp_postmeta` as wppm4,
	`wp_postmeta` as wppm5,
	`wp_postmeta` as wppm6,
	`wp_postmeta` as wppm7,
	`wp_postmeta` as wppm8 
	WHERE 
	wppm1.`meta_key`='print_area_front_height' AND wppm1.post_id=".$prodid." AND 
	wppm2.`meta_key`='print_area_front_width' AND wppm2.post_id=".$prodid." AND 
	wppm3.`meta_key`='print_area_front_top' AND wppm3.post_id=".$prodid." AND 
	wppm4.`meta_key`='print_area_front_left' AND wppm4.post_id=".$prodid." AND 
	wppm5.`meta_key`='print_area_back_height' AND wppm5.post_id=".$prodid." AND 
	wppm6.`meta_key`='print_area_back_width' AND wppm6.post_id=".$prodid." AND 
	wppm7.`meta_key`='print_area_back_top' AND wppm7.post_id=".$prodid." AND 
	wppm8.`meta_key`='print_area_back_left' AND wppm8.post_id=".$prodid));
	$style = $qy['print_area_front_height'].'++++===++++'.$qy['print_area_front_width'].'++++===++++'.$qy['print_area_front_top'].'++++===++++'.$qy['print_area_front_left'].'++++===++++'.$qy['print_area_back_height'].'++++===++++'.$qy['print_area_back_width'].'++++===++++'.$qy['print_area_back_top'].'++++===++++'.$qy['print_area_back_left'];
	echo $style;
?>