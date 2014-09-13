<?php

require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

$user = $facebook->getUser();
//$user ='';

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }



/*echo '<pre>';print_r($user_profile);echo '</pre>';
die();
*/

    if (!empty($user_profile )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
  
        $username = $user_profile['name'];
			 $uid = $user_profile['id'];
		 $email = $user_profile['email'];
        $user = new User();
        $userdata = $user->checkUser($uid, 'facebook', $username,$email,$twitter_otoken,$twitter_otoken_secret,$user_profile);
        if(!empty($userdata)){
             header("Location: ../index.php?social_val=sitelogin&widd=".$userdata['ID']);
        }
    } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
    header("Location: " . $login_url);
}
?>
