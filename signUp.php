<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/8/2015
 * Time: 1:34 PM
 */
if(isset($_POST['submit'])){//TODO check password the same
    include ("connect.php");
    $email=$_POST['emailAddress'];
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];
    $address=$_POST['address'];
    $fullName=$_POST['fullName'];
    // prevent injections
    $email=mysql_real_escape_string($email);
    $password=mysql_real_escape_string($password);
    $address=mysql_real_escape_string($address);
    $fullName=mysql_real_escape_string($fullName);

    $userIdCountResult = mysql_query("SELECT count(userId) FROM tbluser as numberOfUserWithId WHERE  userId='$email'"); //check if user is block
    if($userIdCountResult === FALSE) { //db error
        echo "database failure ";//check if database failed
        die(mysql_error());
        //niotify database failed
    }


    $countNumberOfSameUsereID = mysql_fetch_array($userIdCountResult); //change resource to data


    if ($countNumberOfSameUsereID[0] > 0)//id already in db no need to do more
    {
echo "already register";
    }
  else {
      // insert them in db
      //echo "inserting";
      mysql_query("INSERT INTO `tbluser`(`userId`, `userPassword`, `userAddress`, `userFullName`) VALUES ('$email','$password','$address','$fullName');");
  }
}


?>
<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
  <div data-role="page" id="pageone" data-theme="b">
<div data-role="header">
  <h1>Earthquake locator</h1>
</div>

<div data-role="main" class="ui-content">
  <h1 style="text-align:center;">Your account has been successfully created</h1>
  <a href="signIn.php" data-transition="slide" class="ui-btn">Sign in</a>
</div>

</div>





</body>
</html>