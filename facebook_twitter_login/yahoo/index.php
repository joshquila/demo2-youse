<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/

// Include the YOS library.
require dirname(__FILE__).'/lib/Yahoo.inc';
require dirname(__FILE__).'/../config/functions.php';



$post_id=680;

$social = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Consumer_key'"));

 $Consumer_key= $social['meta_value'];
$sociallinks = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Consumer_secret'"));
//print_r($sociallinks);
 $Consumer_secret= $sociallinks['meta_value'];

// debug settings
//error_reporting(E_ALL | E_NOTICE); # do not show notices as library is php4 compatable
//ini_set('display_errors', true);
YahooLogger::setDebug(true);
YahooLogger::setDebugDestination('LOG');
// use memcache to store oauth credentials via php native sessions
session_start();
// Make sure you obtain application keys before continuing by visiting:
// https://developer.yahoo.com/dashboard/createKey.html
/*$Consumer_key="dj0yJmk9Y3VkaDhVNlpEaW5tJmQ9WVdrOU5qZFhOWFpsTXpJbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD04Ng--";
$Consumer_secret="d82a68d6db75dbdc8d87dc37d5cceec398658d1c";*/
//http://demo.teecircle.com/kUfj.Bo7XhfOr1bagGV_dous7o8ffd4Li26khrqPow--.html
$qauth_domain="http://demo.teecircle.com";
define('OAUTH_CONSUMER_KEY', $Consumer_key);
define('OAUTH_CONSUMER_SECRET', $Consumer_secret);
define('OAUTH_DOMAIN',$qauth_domain);
define('OAUTH_APP_ID', '67W5ve32');
if(array_key_exists("logout", $_GET)) {
  // if a session exists and the logout flag is detected
  // clear the session tokens and reload the page.
  YahooSession::clearSession();
  header("Location: index.php");
}
// check for the existance of a session.
// this will determine if we need to show a pop-up and fetch the auth url,
// or fetch the user's social data.
$hasSession = YahooSession::hasSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);

if($hasSession == FALSE) {
  // create the callback url,
  $callback = YahooUtil::current_url()."?in_popup";
$sessionStore = new NativeSessionStore();
  // pass the credentials to get an auth url.
  // this URL will be used for the pop-up.
  $auth_url = YahooSession::createAuthorizationUrl(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $callback, $sessionStore);

 
  
}
else {
	
  // pass the credentials to initiate a session
  $session = YahooSession::requireSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);
  // if the in_popup flag is detected,
  // the pop-up has loaded the callback_url and we can close this window.
 /* if(array_key_exists("in_popup", $_GET)) {
    close_popup();
    exit;
  }*/
  // if a session is initialized, fetch the user's profile information
  if($session) { //echo 'dfdf';
    // Get the currently sessioned user.
	//echo '<pre>';
    $user = $session->getSessionedUser();
	/*print_r($user); */
    // Load the profile for the current user.
    $profile = $user->getProfile();
	//print_r($profile); 

	
  
  }
}
/**
 * Helper method to close the pop-up window via javascript.
 */
function close_popup() {
?>
<script type="text/javascript">
  window.close();
</script>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>Login with Yahoo</title>
    <!-- Combo-handled YUI JS files: -->
    <script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="popupmanager.js"></script>
 <!-- Combo-handled YUI CSS files: -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.7.0/build/reset-fonts-grids/reset-fonts-grids.css&2.7.0/build/base/base-min.css">
   
  </head>
  <body>
    <?php
      if($hasSession == FALSE) { 
        // if a session does not exist, output the
        // login / share button linked to the auth_url.
header("Location:".$auth_url);
//die();
        ?>
      <!-- <a href="<?php echo $auth_url; ?>" id="yloginLink"><img src="yahoo-oauth-connect.png" style="width:150px;float:left;margin-left:550px;" /></a> -->
    <?php  }
      else if($hasSession) {
	  	//echo 'sdfsd';
	  	/*echo "<pre>";
	  	print_r($user);
		echo "</pre>";
		echo 'pu'.$profile->guid;
		echo 'ug'.$user->guid;*/
		//die();
		if(isset($user->guid) && !empty($user->guid)){
			//echo $user->guid;
			//echo "SELECT * FROM wp_users WHERE oauth_uid = '$user->guid'";
			$query_email_check = mysql_fetch_array(mysql_query("SELECT * FROM wp_users WHERE oauth_uid = '$user->guid'"));}
			if(isset($query_email_check['user_email']) && !empty($query_email_check['user_email'])){
			$uid = $user->guid;
			$username = $query_email_check['user_email'];
$email = $query_email_check['user_email'];
$profile_user['name'] = $query_email_check['display_name'];
		}else{
			//echo 'sdfsd';
			$uid = $user->guid;
			if(isset($profile->emails[1]->handle) && !empty($profile->emails[1]->handle)){
				$username = $profile->emails[1]->handle;
$email = $profile->emails[1]->handle;
			}else if(isset($profile->emails[0]->handle) && !empty($profile->emails[0]->handle)){
				$username = $profile->emails[0]->handle;
$email = $profile->emails[0]->handle;
			}else{
				$username = $uid.'@yahoo.com';
$email = $uid.'@yahoo.com';
			}
			
$profile_user['name'] = $profile->givenName.' '.$profile->familyName;
		}
/*echo $email;
die();*/

 $user = new User();
        $userdata = $user->checkUser($uid, 'yahoo', $username,$email,$twitter_otoken,$twitter_otoken_secret,$profile_user);
/*echo '<pre>';
print_r($userdata);
die();*/
        if(!empty($userdata)){
             header("Location: ../../index.php?social_val=sitelogin&widd=".$userdata['ID']);
        }
		
        // if a session does exist and the profile data was
        // fetched without error, print out a simple usercard.
        /*echo sprintf("<img src=\"%s\"/><p><h2>Hi <a href=\"%s\" target=\"_blank\">%s!</a></h2></p>\n", $profile->image->imageUrl, $profile->profileUrl, $profile->nickname);
        if(isset($profile->status->message ) && $profile->status->message != "") {
          $statusDate = date('F j, y, g:i a', strtotime($profile->status->lastStatusModified));
          echo sprintf("<p><strong>&#8220;</strong>%s<strong>&#8221;</strong> on %s</p>", $profile->status->message, $statusDate);
        }
        echo "<p><a href=\"?logout\">Logout</a></p>";*/
      }
    ?>

    <script type="text/javascript">
      var Event = YAHOO.util.Event;
      var _gel = function(el) {return document.getElementById(el)};
      function handleDOMReady() {
        if(_gel("yloginLink")) {
          Event.addListener("yloginLink", "click", handleLoginClick);
        }
      }
      function handleLoginClick(event) {
        // block the url from opening like normal
        Event.preventDefault(event);
        // open pop-up using the auth_url
        var auth_url = _gel("yloginLink").href;
        PopupManager.open(auth_url,600,435);
      }
      Event.onDOMReady(handleDOMReady);
    </script>
  </body>
</html>