<?php
ob_start();
session_start();
require 'dbconfig.php';

class User {

    function checkUser($uid, $oauth_provider, $username,$email,$twitter_otoken,$twitter_otoken_secret,$user_profile) 
	{
		$query_email_check = mysql_query("SELECT * FROM wp_users WHERE user_email = '$email'") or die(mysql_error());
        $result_email_check = mysql_fetch_array($query_email_check);
		/*echo "<br/>Abc";print_r($result_email_check);*/
		//die();
        if (!empty($result_email_check)) {
		$social_quey_val = "UPDATE wp_users SET
						oauth_provider='".$oauth_provider."',
						oauth_uid='".$uid."'";
						/*if(isset($twitter_otoken) && !empty($twitter_otoken)){
			$social_quey_val .=",twitter_oauth_token='".$twitter_otoken."'";
		}
		if(isset($twitter_otoken_secret) && !empty($twitter_otoken_secret)){
			$social_quey_val .=",twitter_oauth_token_secret='".$twitter_otoken_secret."'";
		}*/
		if(isset($oauth_provider) && !empty($oauth_provider) && ($oauth_provider=='facebook')){
			$social_quey_val .=",user_facebook='".$uid."',facebook_username='".$user_profile['username']."'";
			}
		if(isset($oauth_provider) && !empty($oauth_provider) && ($oauth_provider=='googleplus')){
			$social_quey_val .=",user_google='".$uid."',google_username='".$email."'";
			}
			$social_quey_val .=" WHERE user_email='".$email."'";
			$query = mysql_query($social_quey_val) or die(mysql_error());
					
			 return $result_email_check;
		}else{
        $query = mysql_query("SELECT * FROM `wp_users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
            //echo"<br/><strong>User is already present</strong>";
        } else {	
            #user not present. Insert a new Record
			$vakpass = '$P$Byc7GVidc.ZEAf7uZHHq1VaEVTgbPn0';
			$social_quey_val = "INSERT INTO wp_users SET
						usertype = '',
						user_status = '0',
						sendEmail = '0',
						user_registered = NOW(),
						lastvisitDate = '0000-00-00 00:00:00',
						oauth_provider='".$oauth_provider."',
						oauth_uid='".$uid."',
						user_pass='".$vakpass."'";//die();
		if(isset($user_profile['name']) && !empty($user_profile['name']) && ($oauth_provider!='googleplus')){
			$social_quey_val .=",display_name='".$user_profile['name']."'";
		}
		if(isset($email) && !empty($email)){
			$social_quey_val .=",user_login='".$email."',user_email='".$email."'";
		}
		if(isset($oauth_provider) && !empty($oauth_provider) && ($oauth_provider=='facebook')){
			$social_quey_val .=",user_facebook='".$uid."',facebook_username='".$user_profile['username']."'";
			}
		if(isset($oauth_provider) && !empty($oauth_provider) && ($oauth_provider=='googleplus')){
			$social_quey_val .=",user_google='".$uid."',google_username='".$email."'";
			}
			/*echo $social_quey_val;die();*/
			mysql_query($social_quey_val);//die();
            $query = mysql_query("SELECT * FROM `wp_users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
		}
    }
}

?>
