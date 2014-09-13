<?php

define('DB_SERVER', 'mysql03.uniweb.no');
define('DB_USERNAME', 'd15272');
define('DB_PASSWORD', 'fgagbb62');
define('DB_DATABASE', 'd15272');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
