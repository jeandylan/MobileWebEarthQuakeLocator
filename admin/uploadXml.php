<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = 'C:/xampp/htdocs/EarthLocation/admin/xmlFile/';
date_default_timezone_set('UTC');
if(isset($_FILES['userfile'])){
    $errors= array();
    $file_name = $_FILES['userfile']['name'];
    $file_size =$_FILES['userfile']['size'];
    $file_tmp =$_FILES['userfile']['tmp_name'];
    $file_type=$_FILES['userfile']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['userfile']['name'])));

    $expensions= array("xml");

    if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a xml file.";
    }



    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"xmlFile/".$file_name);
        addEarthquakeDetailToSql("xmlFile/".$file_name); //location of saved data
        echo "Success";
    }
    else{
        print_r($errors);
    }
}


function addEarthquakeDetailToSql($xmlFileLocation){
    include("connect.php");
    $newDataInSql=0;
    $xmldoc = new DOMDocument();
    $xmldoc->load($xmlFileLocation);
    $xpathvar = new Domxpath($xmldoc);

    $nodeSearch = $xmldoc->getElementsByTagName("event");

    foreach ($nodeSearch as $x) {
        //$queryResult = $x->query('/*[3]/*[1]/*');
        // print_r($queryResult[0]);
        $currentNodePath= $x->getNodePath();
//
        $idNode= $xpathvar->query($currentNodePath); //description
        $earthquakeId=$idNode->item(0)->getAttribute('catalog:eventid');

        $descriptionNode= $xpathvar->query($currentNodePath.'/*[1]/*[2]'); //description
        $timeNode= $xpathvar->query($currentNodePath.'/*[2]/*[1]'); //time
        $longitudeNode= $xpathvar->query($currentNodePath.'/*[2]/*[2]/*');
        $latitudeNode=$xpathvar->query($currentNodePath.'/*[2]/*[3]');
        $depthValueNode=$xpathvar->query($currentNodePath.'/*[2]/*[4]/*[1]');//
        $depthUncertaintyNode=$xpathvar->query($currentNodePath.'/*[2]/*[4]/*[2]');//

//test if magnitude is present in xml
        $IsMagnitudeValueNodePresent=$xpathvar->evaluate('boolean('. $currentNodePath.'/*[3]/*[1]/*[1])');// sometime the magnitude uncertain is not present check if it exist
        if($IsMagnitudeValueNodePresent==1){ // if exist do save it
            $magnitudeValueNode=$xpathvar->query( $currentNodePath.'/*[3]/*[1]/*[1]');
            $magnitude=$magnitudeValueNode->item(0)->nodeValue;
        }
        else{
            $magnitude="";
        }

 //test that magnitude uncertainty is in xml
        $IsMagnitudeUncertaintyNodePresent=$xpathvar->evaluate('boolean('. $currentNodePath.'/*[3]/*[1]/*[2])');// sometime the magnitude uncertain is not present check if it exist
        if($IsMagnitudeUncertaintyNodePresent==1){ // if exist do save it
            $magnitudeUncertaintyNode=$xpathvar->query( $currentNodePath.'/*[3]/*[1]/*[2]');
            $magnitudeUncertainty=$magnitudeUncertaintyNode->item(0)->nodeValue;
        }
        else{
            $magnitudeUncertainty=" ";
        }


        $description=$descriptionNode->item(0)->nodeValue;
        $time=$timeNode->item(0)->nodeValue;
        $longitude=$longitudeNode->item(0)->nodeValue;
        $latitude=$latitudeNode->item(0)->nodeValue;
        $depth=$depthValueNode->item(0)->nodeValue;
        $depthUncertainty=$depthUncertaintyNode->item(0)->nodeValue;



        //echo $earthquakeId."   ".$time.$description.$longitude.$latitude.$depth.$depthUncertainty.$magnitude.$magnitudeUncertainty;

        $earthquakeId=mysql_real_escape_string($earthquakeId);// make sure injection is prevented
        $earthquakeIdCountResult = mysql_query("SELECT count(earthquakeId) FROM tblEarthquakeDetail as numberOfUserWithId WHERE earthquakeId='$earthquakeId'"); //check if user is block
        if($earthquakeIdCountResult === FALSE) {
            echo "database failure ";//check if database failed
            die(mysql_error());
            //niotify database failed
        }


        $countNumberOfSameEarthquakeID = mysql_fetch_array($earthquakeIdCountResult); //change resource to data


        if ($countNumberOfSameEarthquakeID[0] == 1)//id already in db no need to do more
        {

        }
        else{
            $newDataInSql+=1;
            //make sure no injection occur
            $description=mysql_real_escape_string($description);
            //Time Formatting

            $time = substr($time, 0, -5);
            $time = str_replace("T"," ",$time);


            $time=mysql_real_escape_string($time);

            $longitude=mysql_real_escape_string($longitude);
            $latitude=mysql_real_escape_string($latitude);
            $depth=mysql_real_escape_string($depth);
            $depthUncertainty= mysql_real_escape_string($depthUncertainty);
            $magnitude= mysql_real_escape_string($magnitude);
            $magnitudeUncertainty=mysql_real_escape_string($magnitudeUncertainty);
            mysql_query("INSERT INTO `earthquake2`.`tblearthquakedetail` (`earthquakeId`, `earthquakeDescription`, `earthquakeTime`, `earthquakeLongitude`, `earthquakeLatitude`, `eathquakeDepthValue`, `eathquakeDepthUncertainty`, `earthquakeMagnitudeValue`, `earthquakeMagnitudeuncertainty`) VALUES ('$earthquakeId', '$description', '$time', '$longitude', '$latitude', '$depth', '$depthUncertainty', '$magnitude', '$magnitudeUncertainty');");

        }

    }
    echo "number of data added to sql : ".$newDataInSql."<br>";
}
?>