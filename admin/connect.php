<?php
/*
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

// Database Variables (edit with your own server information)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "earthquake2";

// Connect to Database
$connection = mysql_connect($servername, $username, $password)
or die ("Could not connect to server ... \n" . mysql_error ());
mysql_select_db($dbname)
or die ("Could not connect to database ... \n" . mysql_error ());


?>