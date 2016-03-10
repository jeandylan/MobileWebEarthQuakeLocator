<?php
session_start(); 
session_destroy();
?>
<?php



if(isset($_POST['submit'])){ //if is a post
    include ("connect.php");
 if ($_POST['emailAddress']!="" and $_POST['password']!=""){ //check that they are not empty
     $email=$_POST['emailAddress'];
     $password=$_POST['password'];
     
  $result = mysql_query("SELECT count(userId) FROM tbluser as numberOfUserWithId WHERE userId='$email' and userStatus=1 and userPassword='$password'"); //check if user is block
  $result1 = mysql_query("SELECT  `userFullName` FROM `tbluser` WHERE `userId`='$email'");
    $result3 = mysql_query("SELECT  `userId` FROM `tbluser` WHERE `userId`='$email'");
     $userType= mysql_query("SELECT  `userType` FROM `tbluser` WHERE `userId`='$email'");
$data= mysql_fetch_array($result1);
$data1= mysql_fetch_array($result3);
$userType=mysql_fetch_array($userType);

     
     
  if($result === FALSE) {  
      echo "database failure ";//check if database failed
    die(mysql_error()); 
    //niotify database failed
}



   
     
     $countActiveUser = mysql_fetch_array($result); //change resource to data


  if ($countActiveUser[0] == 1)//user already in db and active
    {
      session_start();
      //$user=mysql_fetch_array($name)
      //$user=mysql_result($name,0,'userFullName')
         $_SESSION['id'] = $data1["userId"];
      $_SESSION['username'] = $data["userFullName"];
      if($userType["userType"]=="normal"){
          
          header("Location: ../earthquakeLocator.php"); 
      }
        if($userType["userType"]=="admin"){
          header("Location: ../admin/index.html"); 
      }
      

    }
    else
    { //user not in db/or block
        $result = mysql_query("SELECT count(userId) FROM tbluser as numberOfUserWithId WHERE userId='$email';");
        $userNotRegister = mysql_fetch_array($result);

        if ($userNotRegister[0] == 0) //user not in db
        { // ask user to register
           
         //echo "not in db";
           header("Location: ../signIn.php?signInResponse=notRegister"); //redirect to bad page
            die();
        }

        else
        { //user had been block/bad password
            header("Location: ../signIn.php?signInResponse=wrong"); //redirect to bad page
            die();
        }
    }


 }

else{  //password or email empty redirect to main page
  header("Location: ../signIn.php "); //redirect to main page
        die();
     
}

}

?>
