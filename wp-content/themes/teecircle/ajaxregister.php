<?php
session_start();
require_once("../../../wp-load.php");

//print_r($_POST);

$userdata = array(
    'user_pass'    =>   $_POST['password'],
	'user_login'    =>   $_POST['username'],
	'user_nicename'    => $_POST['username'],
	'user_email'    =>  $_POST['username'],
	'display_name'    =>  $_POST['username'],
	'user_registered'    =>  date('Y-m-d H:i:s'),
	'nickname'    =>  $_POST['username'],
	'first_name'    =>  $_POST['username']
);


$user_id = wp_insert_user( $userdata ) ;

//On success
if( !is_wp_error($user_id) ) {
 //echo "0";
	$creds = array();
	$creds['user_login'] = $_POST['username'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	if ( is_wp_error($user) ){
		echo $user->get_error_message();
	}else{
		echo "1";
	}
 
}else{
echo $user_id->get_error_message();
}


?> 