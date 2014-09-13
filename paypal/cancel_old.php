<?php 
session_start();
require_once('includes/config.php');
mysql_query("UPDATE crowed_payment SET order_status='cancelled',order_execution_date='".date('Y-m-d H:i:s')."' WHERE id=".$_SESSION['orid']);
/*mysql_query("INSERT INTO wp_comments SET comment_post_ID=".$_SESSION['order_id'].",
										 comment_author='WooCommerce',
										 comment_date='".date('Y-m-d H:i:s')."',
										 comment_date_gmt='".date('Y-m-d H:i:s')."',
										 comment_content='Order status changed from pending to cancelled.',
										 comment_approved=1,
										 comment_agent='WooCommerce',
										 comment_type='order_note',
										 user_id=".$_SESSION['user_id']);*/
header('location:'.$_SESSION['CancelURL']);
?>