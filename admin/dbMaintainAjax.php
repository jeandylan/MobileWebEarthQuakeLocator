<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/9/2015
 * Time: 12:48 AM
 */
if(isset($_POST['period']) && !empty($_POST['period'])) {
    include_once("connect.php");
    $period=$_POST['period'];
    //$fullname = mysql_real_escape_string(htmlspecialchars($_POST['fullname']));
   // $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));

   // $password = mysql_real_escape_string(htmlspecialchars($_POST['password']));

   // mysql_query("UPDATE `tbluser` SET `userPassword`='$password',`userAddress`='$address',`userFullName`='$fullname' WHERE userId='dylan';");
if ($period="1"){
    $x=strtotime("-1 days");
    $dt = new DateTime("@$x");
     $dt->format('Y-m-d');
    mysql_query("DELETE FROM `tblearthquakedetail` WHERE `earthquakeTime` <='$dt'");
    echo json_encode(array("output" => "deleted >today"));
}
    if ($period="7"){
        $x=strtotime("-7 days");
        $dt = new DateTime("@$x");
        $dt->format('Y-m-d');
        mysql_query("DELETE FROM `tblearthquakedetail` WHERE `earthquakeTime` <='$dt'");
        echo json_encode(array("output" => "deleted > last 7 days"));
    }
    if ($period="30"){
        $x=strtotime("-30 days");
        $dt = new DateTime("@$x");
        $dt->format('Y-m-d');
        mysql_query("DELETE FROM `tblearthquakedetail` WHERE `earthquakeTime` <='$dt'");
        echo json_encode(array("output" => "deleted > last 30 days"));
    }
    if($peiod="0"){
        mysql_query("DELETE FROM `tblearthquakedetail` WHERE 1");
        echo json_encode(array("output" => "all deleted"));
    }


}
?>