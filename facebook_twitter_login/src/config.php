<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

define('DB_SERVER', 'mysql03.uniweb.no');
define('DB_USERNAME', 'd15272');
define('DB_PASSWORD', 'fgagbb62');
define('DB_DATABASE', 'd15272');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

$post_id=681;
//echo "SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Client_id'";

$sociallinks = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Client_id'"));
//print_r($sociallinks);

$Client_id= $sociallinks['meta_value'];


$sociallinksasdas = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='Client_secret'"));


$Client_secret= $sociallinksasdas['meta_value'];

$sociallink2 = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta where post_id=".$post_id." AND meta_key='oauth2_redirect_uri'"));

$oauth2_redirect_uri= $sociallink2['meta_value'];

// $Client_id="538687083211-hfno8o54orftu6cckmfsbbh7vle1c3ue.apps.googleusercontent.com";
// $Client_secret="Dgm1ZwUynC_FPhu1vSztZDgt";
// $oauth2_redirect_uri="http://demo.teecircle.com/facebook_twitter_login/google_login.php";



global $apiConfig;
$apiConfig = array(
    // True if objects should be returned by the service classes.
    // False if associative arrays should be returned (default behavior).
    'use_objects' => false,
  
    // The application_name is included in the User-Agent HTTP header.
    'application_name' => '',

    // OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
    'oauth2_client_id' => $Client_id,
    'oauth2_client_secret' => $Client_secret,
    'oauth2_redirect_uri' => $oauth2_redirect_uri,

    // The developer key, you get this at https://code.google.com/apis/console
    'developer_key' => '',
  
    // Site name to show in the Google's OAuth 1 authentication screen.
    'site_name' => 'www.teecircle.com',

    // Which Authentication, Storage and HTTP IO classes to use.
    'authClass'    => 'Google_OAuth2',
    'ioClass'      => 'Google_CurlIO',
    'cacheClass'   => 'Google_FileCache',

    // Don't change these unless you're working against a special development or testing environment.
    'basePath' => 'https://www.googleapis.com',

    // IO Class dependent configuration, you only have to configure the values
    // for the class that was configured as the ioClass above
    'ioFileCache_directory'  =>
        (function_exists('sys_get_temp_dir') ?
            sys_get_temp_dir() . '/Google_Client' :
        '/tmp/Google_Client'),

    // Definition of service specific values like scopes, oauth token URLs, etc
    'services' => array(
      'analytics' => array('scope' => 'https://www.googleapis.com/auth/analytics.readonly'),
      'calendar' => array(
          'scope' => array(
              "https://www.googleapis.com/auth/calendar",
              "https://www.googleapis.com/auth/calendar.readonly",
          )
      ),
      'books' => array('scope' => 'https://www.googleapis.com/auth/books'),
      'latitude' => array(
          'scope' => array(
              'https://www.googleapis.com/auth/latitude.all.best',
              'https://www.googleapis.com/auth/latitude.all.city',
          )
      ),
      'moderator' => array('scope' => 'https://www.googleapis.com/auth/moderator'),
      'oauth2' => array(
          'scope' => array(
              'https://www.googleapis.com/auth/userinfo.profile',
              'https://www.googleapis.com/auth/userinfo.email',
          )
      ),
      'plus' => array('scope' => array(
	  									'https://www.googleapis.com/auth/plus.login',
										'https://www.googleapis.com/auth/userinfo.profile',
              							'https://www.googleapis.com/auth/userinfo.email'
										)),
      'siteVerification' => array('scope' => 'https://www.googleapis.com/auth/siteverification'),
      'tasks' => array('scope' => 'https://www.googleapis.com/auth/tasks'),
      'urlshortener' => array('scope' => 'https://www.googleapis.com/auth/urlshortener')
    )
);