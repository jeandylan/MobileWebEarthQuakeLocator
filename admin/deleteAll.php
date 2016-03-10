<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/9/2015
 * Time: 9:17 AM
 */
require_once("connect.php");
mysql_query('TRUNCATE TABLE tblearthquakedetail;');
header("Location: tableEarthquake.php");
?>