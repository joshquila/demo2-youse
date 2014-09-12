<?php
ob_start();
session_start();
require_once("../../../wp-load.php");

$proids = explode(',',$_POST['pro_ids']);
for($h=0;$h<count($proids);$h++){
	mysql_query("INSERT INTO `wp_payoff` SET post_id=".$proids[$h].", user_id=".$_POST['user_id'].", adddate=".time());
}
$post = array(
  'post_content'   => '$'.$_POST['totamt'],
  'post_name'      => '$'.$_POST['totamt'],
  'post_title'     => 'Payout Request From '.$current_user->user_email,
  'post_status'    => 'draft',
  'post_type'      => 'payoff',
  'post_author'    => $_POST['user_id'],
  'ping_status'    => 'open',
  'post_parent'    => 0,
  'menu_order'     => 0,
  'to_ping'        => '',
  'pinged'         => '',
  'post_password'  => '',
  'guid'           => '',
  'post_content_filtered' => '',
  'post_excerpt'   => '',
  'post_date'      => date('Y-m-d H:i:s'),
  'post_date_gmt'  => date('Y-m-d H:i:s'),
  'comment_status' => 'closed',
  'tags_input'     => '',
  'tax_input'      => '',
  'page_template'  => ''
);  

wp_insert_post( $post );
echo 'ok';
	die();
?>