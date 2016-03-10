
<?php
// connect to the database
 include('connect.php');


 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_GET['userId']))
 {
     $htmlFile = file_get_contents("modifyUserFormTemplate.html");
$userId=$_GET['userId'];
     include('connect.php');
     $result = mysql_query("SELECT * FROM tbluser where userId='$userId';");
     $total_results = mysql_num_rows($result);
     for ($i = 0; $i < $total_results; $i++)
     {
         // make sure that PHP doesn't try to show results that don't exist
         if ($i == $total_results) { break; }

         // echo out the contents of each row into a table

        $userId=mysql_result($result, $i, 'userId');
          $userPassword=mysql_result($result, $i, 'userPassword');
        $userStatus= mysql_result($result, $i, 'userStatus');
       $userType= mysql_result($result, $i, 'userType');
        $userFullName= mysql_result($result, $i, 'userFullName');
        $userAddress=mysql_result($result, $i, 'userAddress') ;

     }
 // check to make sure both fields are entered

     $htmlFile = str_replace("{{fullName}}",$userFullName , $htmlFile);
     $htmlFile = str_replace("{{address}}",$userAddress , $htmlFile);
     $htmlFile = str_replace("{{password}}",$userPassword , $htmlFile);
     $htmlFile = str_replace("{{confirmPassword}}",$userPassword , $htmlFile);
     $htmlFile = str_replace("{{email}}",$userId , $htmlFile);
     switch ($userType) {
         case "normal":
             $htmlFile = str_replace("{{script2}}", "document.getElementById('actype').selectedIndex=0;", $htmlFile);
             break;
         case "facebook":
             $htmlFile = str_replace("{{script2}}", "document.getElementById('actype').selectedIndex=1;", $htmlFile);
             break;
         case "admin":
             $htmlFile = str_replace("{{script2}}", "document.getElementById('actype').selectedIndex=2;", $htmlFile);
             break;
         default :
             break;
     }
     switch ($userStatus) {
         case 0:
             $htmlFile = str_replace("{{script1}}", "document.getElementById('statusType').selectedIndex=1;", $htmlFile);
             break;
         case 1:
             $htmlFile = str_replace("{{script1}}", "document.getElementById('statusType').selectedIndex=0;", $htmlFile);
             break;

         default :

             break;
     }
 //or die(mysql_error());
 
 // once saved, redirect back to the view page
 //header("Location: view.php");
     echo $htmlFile;

 }

?>