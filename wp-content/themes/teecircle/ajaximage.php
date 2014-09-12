<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
if(isset($_REQUEST['checkval']) && !empty($_REQUEST['checkval']) && ($_REQUEST['checkval']=='productimage'))
{
	$prodid = str_replace('tee_product','',$_REQUEST['prodifg']);
	$imhfn = array();
 // $args = array(
 //   'post_type' => 'attachment',
 //   'numberposts' => 2,
 //   'post_status' => null,
 //   'post_parent' => $prodid
 //  );
  $qypro = mysql_fetch_array(mysql_query("SELECT wppm.meta_value FROM `wp_postmeta` as wppm WHERE wppm.`meta_key`='_product_image_gallery' AND wppm.post_id=".$prodid));
$attachments = explode(',',$qypro['meta_value']);
$attachments = array_reverse($attachments);
  if ( $attachments ) {
	 	//$attachments = array_reverse($attachments);
        foreach ( $attachments as $attachment ) {
			$qy = mysql_fetch_array(mysql_query("SELECT wppm.meta_value FROM `wp_postmeta` as wppm WHERE wppm.`meta_key`='_wp_attached_file' AND wppm.post_id=".$attachment));
			$imhfn[] = $qy['meta_value'];
          }
          echo $cbnk = implode('++++===++++',$imhfn);
     }

	die();
	

}
?>