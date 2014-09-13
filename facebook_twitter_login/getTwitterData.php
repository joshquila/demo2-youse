<html>
<head>
<title>Twitter Login</title>
<style>
	.twitterval_outer{
	width:100%;
	height:100%;
	display: inline-block;
	background:rgba(0, 0, 0, .6);
	position:fixed;
	top:0;
	left: 0px;
	z-index:3;
}
.twitter_button{width:100%; text-align:center; margin-top:20px;}
.twitterval_outer .twitterval{
	width: 560px;
	height:262px;
	display:block;
    overflow: auto;
	overflow-x: hidden;
	position:relative;
	z-index:4;
	padding:10px;
	border:2px solid #dddddd;
	margin:0 auto;
	background:#fff;
	top:30%;
	border-radius:6px;
	text-align:center;
}
.twitter_logo{width:100%; padding:10px 0; background:#2C3E50; text-align:center;}
.lightbox2_rightcross_btn{
	background:url(../images/popclose.png) no-repeat;
	border:0;
	cursor:pointer;
	width: 30px;
	height: 30px;
	margin:0;
	position:absolute;
	z-index:5;
	top:0;
	right:0;
}
.twitterval_outer .twitterval lable{font:18px Arial, Helvetica, sans-serif; color:#2C3E50; margin:34px 0 10px 0; display:inline-block;}
.twitterval_outer .twitterval input[type="text"]{width:300px; height:32px; font:13px Arial, Helvetica, sans-serif; color:#333; margin-bottom:10px;}
.twitterval_outer .twitterval input[type="submit"]{width:100px; height:34px; font:13px Arial, Helvetica, sans-serif; color:#fff; background:#2C3E50; text-align:center; padding:3px 0 4px 0; border:0; outline:none;}
</style>
</head>
<body>
<div class="twitterval_outer">
<?php

require("twitter/twitteroauth.php");
require 'config/twconfig.php';
require 'config/functions.php';
session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var

    $_SESSION['access_token'] = $access_token;
// Let's get the user's info

    $user_info = $twitteroauth->get('account/verify_credentials');
//echo '<pre>';print_r($user_info);echo '</pre>';die();
	//echo $user_info->id;
	if(isset($user_info->id) && !empty($user_info->id)){
	$_SESSION['twitt_id'] = $user_info->id;
	$_SESSION['twitt_name'] = $user_info->name;
	$_SESSION['twitt_username'] = $user_info->screen_name;
	}
	$user_info_arr['name'] = $_SESSION['twitt_name'];
	$twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	  $uid = $_SESSION['twitt_id'];
        $username = $_SESSION['twitt_name'];
		$user_info_arr['twitt_username'] = $_SESSION['twitt_username'];
	 $user = new User();
	  $userdata_chek = $user->checjtwitterval($uid);
	//echo '<pre>';print_r($userdata_chek);echo '</pre>';die();
        if(!empty($userdata_chek)){
		
	
	$user_info_arr['email'] = $userdata_chek['email'];
	
// Print user's info
    
  /*  if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {*/
	   
	   $email=$userdata_chek['email'];
        

       
        $userdata = $user->checkUser($uid, 'twitter', $username,$email,$twitter_otoken,$twitter_otoken_secret,$user_info_arr);
		//echo '<pre>';print_r($userdata);echo '</pre>';die();
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
 			$_SESSION['oauth_id'] = $uid;
            $_SESSION['username'] = $userdata['username'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            //header("Location: home.php");
			$_SESSION['__default']['user']->id=$userdata['id'];
			//echo 'dfgd';
			//echo "Location: http://www.fanter.co.uk/index.php?social_val=".base64_encode($userdata['id']);
			echo "<script>window.location='http://www.fanter.co.uk/index.php?social_val=".base64_encode($userdata['id'])."';</script>";
            header("Location: http://www.fanter.co.uk/index.php?social_val=".base64_encode($userdata['id']));
        }
    //}
	}else{
		
?>
	<?php if(isset($_POST['twitter_hidden']) && !empty($_POST['twitter_hidden']) && ($_POST['twitter_hidden']='twitter_hidden')){
	
	$user_info_arr['email'] = $_POST['twitter_email'];
// Print user's info
    
  /*  if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {*/
	   
	   $email=$_POST['twitter_email'];
        

       
        $userdata = $user->checkUser($uid, 'twitter', $username,$email,$twitter_otoken,$twitter_otoken_secret,$user_info_arr);
		//echo '<pre>';print_r($userdata);echo '</pre>';die();
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
 $_SESSION['oauth_id'] = $uid;
            $_SESSION['username'] = $userdata['username'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            //header("Location: home.php");
			$_SESSION['__default']['user']->id=$userdata['id'];
			//echo 'dfgd';
			//echo "Location: http://www.fanter.co.uk/index.php?social_val=".base64_encode($userdata['id']);
			echo "<script>window.location='http://www.fanter.co.uk/index.php?social_val=".base64_encode($userdata['id'])."';</script>";
            header("Location: http://www.fanter.co.uk/index.php?social_val=".base64_encode($userdata['id']));
        }
    //}
	}else{?>
    	
		<div class="twitterval">
		<div class="twitter_logo"><img src="http://www.fanter.co.uk/templates/fanter/images/logo.png" /></div>
			<lable>Enter Email</lable>
			<form name="twiter" id="twiter" action="" method="post">
				<span><input type="text" id="twitter_email" name="twitter_email" /></span>
				<input type="hidden" id="twitter_hidden" name="twitter_hidden" value="twitter_hidden" />
				<div class="twitter_button"><input type="submit" id="twitter_post" name="twitter_post" value="Add Email" /></div>
			</form>
		</div>

<?php }}
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
?>
</div>
</body>
</html>
