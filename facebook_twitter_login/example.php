<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '686431844723709',
  'secret' => 'a4e05688dc9cd7232a3b289cc7f5a184',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl();
}
$access_token = $facebook->getAccessToken();
$nabanita = $facebook->api('/100005071621670');
$args = array(
"access_token" => '686431844723709|5BotPR1BvBGJhwstAwtF1qbOA9Y',
    'message'   => 'Hello from my App!',
    'link'      => 'http://www.masteringapi.com/',
    'caption'   => 'Visit MasteringAPI.com For Facebook API Tutorials!'
);
$post_id = $facebook->api("/100005071621670/feed", "post", $args);
die();
// This call will always work since we are fetching public data.
$params = array(
  "access_token" => $access_token, // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
  "message" => "Here is a blog post about auto posting on Facebook using PHP #php #facebook",
  "link" => "http://www.pontikis.net/blog/auto_post_on_facebook_with_php",
  "picture" => "http://i.imgur.com/lHkOsiH.png",
  "name" => "How to Auto Post on Facebook with PHP",
  "caption" => "www.pontikis.net",
  "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
);
$nabanita = $facebook->api('/632278313');
$ret = $facebook->api('/632278313/feed', 'POST', $params);
echo '<pre>';print_r($ret);echo '</pre>';
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>php-sdk</h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Check the login status using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $statusUrl; ?>">Check the login status</a>
      </div>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user): ?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>

    <h3>Public profile of nabanita</h3>
    <img src="https://graph.facebook.com/100005071621670/picture">
    <?php echo $nabanita['name']; ?>
  </body>
</html>
