<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/15/2015
 * Time: 11:16 PM
 */
getMapDetails("grg");
function getMapDetails($x)
{
    include_once("connect.php");
    $earthquakeDescription = array();
    $earthquakeLongitude = array();
    $earthquakeLatitude = array();
    $earthquakeMagnitude = array();
    $magUncertainty = array();
    $earthquakeTime = array();
    $depthValue = array();
    $depthUncertainty = array();


    $result = mysql_query("SELECT `earthquakeId`, `earthquakeDescription`, `earthquakeTime`, `earthquakeLongitude`,
`earthquakeLatitude`, `eathquakeDepthValue`, `eathquakeDepthUncertainty`, `earthquakeMagnitudeValue`, `earthquakeMagnitudeuncertainty` FROM `tblearthquakedetail` WHERE 1");
    $total_results = mysql_num_rows($result);
//echo $total_results;
    for ($i = 0; $i < $total_results; $i++) {
        // make sure that PHP doesn't try to show results that don't exist
        if ($i == $total_results) {
            break;
        }

        // echo out the contents of each row into a table
        $descriptionData = mysql_result($result, $i, 'earthquakeDescription');
        $latData = mysql_result($result, $i, 'earthquakeLatitude');
        $lngData = mysql_result($result, $i, 'earthquakeLongitude');
        $magnitudeData = mysql_result($result, $i, 'earthquakeMagnitudeValue');
        $magUnData = mysql_result($result, $i, 'earthquakeMagnitudeuncertainty');
        $time = mysql_result($result, $i, 'earthquakeTime');
        $dphValue = mysql_result($result, $i, 'eathquakeDepthValue');
        $dphValueUncertainty = mysql_result($result, $i, 'eathquakeDepthUncertainty');

        array_push($earthquakeDescription, $descriptionData);
        array_push($earthquakeLongitude, $lngData);
        array_push($earthquakeLatitude, $latData);
        array_push($earthquakeMagnitude, $magnitudeData);
        array_push($magUncertainty, $magUnData);
        array_push($earthquakeTime, $time);
        array_push($depthValue, $dphValue);
        array_push($depthUncertainty, $dphValueUncertainty);
    }


   // echo json_encode($earthquakeDescription);
  //  echo json_encode($earthquakeLongitude);
   echo json_encode(array('earthquakeDescription'=>$earthquakeDescription,'earthquakeLongitude'=>$earthquakeLongitude,'earthquakeLatitude'=>$earthquakeLatitude,
    'earthquakeMagnitude'=>$earthquakeMagnitude,'magUncertainty'=>$magUncertainty,'earthquakeTime'=>$earthquakeTime,'depthValue'=>$depthValue,'depthUncertainty'=>$depthUncertainty));
}
?>