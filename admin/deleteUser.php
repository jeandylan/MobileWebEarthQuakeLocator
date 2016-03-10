<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
 include('connect.php');
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['userId']))
 {
 // get id value
     $idObtain=$_GET['userId'];
 $userId =mysql_real_escape_string($idObtain); // email have @ sql may reject if fear of injection
 
 // delete the entry
 $result = mysql_query("DELETE FROM tbluser WHERE userId='$userId'")
 or die(mysql_error()); 
 
 // redirect back to the view page
 header("Location: tableUser.php ");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {

 header("Location: tableUser.php");
 }
 
?>