<?php

if (isset($_POST['email'])) {
   require_once("connect.php");

    $fullname = mysql_real_escape_string(htmlspecialchars($_POST['fullName']));
    $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $password = mysql_real_escape_string(htmlspecialchars($_POST['password']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $userType = mysql_real_escape_string(htmlspecialchars($_POST['userType']));
    $userStatus = intval($_POST['userStatus']);
    mysql_query("UPDATE `tbluser` SET `userPassword`='$password',`userType`='$userType',`userAddress`='$address',`userFullName`='$fullname',`userStatus`=$userStatus WHERE userID='$email';");
echo "change sucesful redirect in 5 sec";
    header('Refresh: 5; URL=index.html');
}


?>