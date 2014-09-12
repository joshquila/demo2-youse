<?php
session_start();
require_once("../../../wp-load.php");

//print_r($_POST);

	$creds = array();
	$creds['user_login'] = $_POST['username'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	if ( is_wp_error($user) ){
		echo $user->get_error_message();
	}else{
		echo "0";
	}
?> 