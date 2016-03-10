<?php

/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/8/2015
 * Time: 8:58 PM
 */

if(isset($_POST['password']) && !empty($_POST['password'])) {
include_once("connect.php");
  

   $password = mysql_real_escape_string(htmlspecialchars($_POST['password']));

 $id = mysql_real_escape_string(htmlspecialchars($_POST['id']));

    mysql_query("UPDATE `tbluser` SET `userPassword`='$password' WHERE userId='$id'");
    $output="saved";
    echo json_encode(array("conversion" => $output));
}
?>