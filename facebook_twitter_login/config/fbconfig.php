<?php
define('DB_SERVER', 'mysql03.uniweb.no');
define('DB_USERNAME', 'd15272');
define('DB_PASSWORD', 'fgagbb62');
define('DB_DATABASE', 'd15272');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());


$post_id=679;
//echo "SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Api_id'";

$social = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Api_id'"));
//print_r($social);
$app_id= $social['meta_value'];

$sociallinks = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Api_secret'"));
//print_r($sociallinks);
$app_secret= $sociallinks['meta_value']; 

//$app_id="261422477379088";
//$app_secret="626beff6de5456668f247dccceacfd08";
define('APP_ID', $app_id);
define('APP_SECRET', $app_secret);


?>
