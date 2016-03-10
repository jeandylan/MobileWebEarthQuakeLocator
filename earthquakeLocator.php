
<?php
   
   
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/7/2015
 * Time: 8:53 PM
 */
session_start();
   if(!isset($_SESSION['username'])){
      header("Location: signIn.php");  
    }

include_once("connect.php");
$earthquakeDescription=array();
$earthquakeLongitude=array();
$earthquakeLatitude=array();
$earthquakeMagnitude=array();
$magUncertainty=array();
$earthquakeTime=array();
$depthValue=array();
$depthUncertainty=array();


$result=mysql_query("SELECT `earthquakeId`, `earthquakeDescription`, `earthquakeTime`, `earthquakeLongitude`,
`earthquakeLatitude`, `eathquakeDepthValue`, `eathquakeDepthUncertainty`, `earthquakeMagnitudeValue`, `earthquakeMagnitudeuncertainty` FROM `tblearthquakedetail` WHERE 1");
$total_results = mysql_num_rows($result);
//echo $total_results;
for ($i = 0; $i < $total_results; $i++)
{
    // make sure that PHP doesn't try to show results that don't exist
    if ($i == $total_results) { break; }

    // echo out the contents of each row into a table
    $descriptionData= mysql_result($result, $i, 'earthquakeDescription');
    $latData=mysql_result($result, $i, 'earthquakeLatitude');
     $lngData=mysql_result($result, $i, 'earthquakeLongitude');
       $magnitudeData=mysql_result($result, $i, 'earthquakeMagnitudeValue');
       $magUnData=mysql_result($result, $i, 'earthquakeMagnitudeuncertainty');
       $time=mysql_result($result, $i, 'earthquakeTime');
       $dphValue=mysql_result($result, $i, 'eathquakeDepthValue');
        $dphValueUncertainty=mysql_result($result, $i, 'eathquakeDepthUncertainty');

array_push($earthquakeDescription,$descriptionData);
array_push($earthquakeLongitude,$lngData);
array_push($earthquakeLatitude,$latData);
array_push($earthquakeMagnitude,$magnitudeData);
array_push($magUncertainty,$magUnData);
array_push($earthquakeTime,$time);
array_push($depthValue,$dphValue);
array_push($depthUncertainty,$dphValueUncertainty);
}

//print_r($earthquakeDescription);






?>

<!DOCTYPE html> 
<html>
 <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>


<script src="markerclusterer.js" type="text/javascript"></script>
  <style type="text/css">

.ui-widget-header {
  border: none;
  background: transparent;
}
.ui-widget-content {
  background: transparent;
}


   html {
    height: 100% 
} body 
{
 height: 100%; margin: 0; padding: 0 
} 

#map-page, #map-canvas { width: 100%; height: 86%; padding: 0; }
</style> 

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8X3TezAytgjVami_97Vl0CTzpEzwakBg&libraries=places&sensor=false"></script>

 <script type="text/javascript">


/*window.onload = function testing(){
  //alert(msg);
  $.mobile.changePage( "#pagetwo", { role: "dialog" } );
}*/



var map = null;
  function initialize() { //show all markers



    var arr=[];
var arr1=[];
var gmarkers = [];
var loc=[];
var time=[];
var depth=[];
var uncertaintyOfDepth=[];
var magtd=[];
var uncertaintyOfMag=[];

$(document).ready(function(){


$('#lgout').click(function() { 
    $.ajax({
        url: 'killSession.php',
        success: function(){
            
            window.location.href = "signIn.php";
        }
    });

    return false;
});




 loc= <?php echo json_encode($earthquakeDescription);?>;
 arr=<?php echo json_encode($earthquakeLatitude);?>;
 arr1=<?php echo json_encode($earthquakeLongitude);?>;
  magtd=<?php echo json_encode($earthquakeMagnitude);?>;
    uncertaintyOfMag=<?php echo json_encode($magUncertainty);?>;
     time=<?php echo json_encode($earthquakeTime);?>;
     depth=<?php echo json_encode($depthValue);?>;
      uncertaintyOfDepth=<?php echo json_encode($depthUncertainty);?>;
   
});


var markers=[];
var map;
var geocoder;
   

 if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function (position) {
         initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
         map.setCenter(initialLocation);

         var myLocation=new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
mymarker = new google.maps.Marker({
     icon: 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png',
        position: myLocation,
        map: map,
        title: 'Your Location'
        //icon:'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    }); 

         
mysearchmarker = new google.maps.Marker({
     icon: 'http://labs.google.com/ridefinder/images/mm_20_brown.png',
        //position: myLocation,
        map: map,
        title: 'Your Searched Address'
        //icon:'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    }); 



     });
     
 }


  	var mapOptions = { center: new google.maps.LatLng(arr[0],arr1[0]), zoom: 6
  	}; 
  	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

     geocoder = new google.maps.Geocoder();



 for(var i=0;i<arr.length;i++){

if(magtd[i]<=2.5){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'; 
}else if(magtd[i]>2.5 && magtd[i]<5.4)
{
    var iconFile = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'; 
}
else if(magtd[i]>=5.4 && magtd[i]<6.9){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'; 
}
else if(magtd[i]>=6.9 && magtd[i]<=7.9){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png'; 
}
else if(magtd[i]>8.0){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'; 
}

    var markerPoint = new google.maps.LatLng(arr[i], arr1[i]);
     marker = new google.maps.Marker({
        position: markerPoint,
         //animation: google.maps.Animation.DROP,
        map: map,
        title: 'Earthquake alert'
    }); 

  markers.push(marker);
marker.setIcon(iconFile);

marker.customInfo = "<b>Location:</b>\t"+loc[i]+"<br><br>"+"<b>Latitude:</b>\t"+arr[i]+"<br><br>"+"<b>Longitude:</b>\t"+arr1[i]+"<br><br>"+"<b>Time:</b></b>\t"+time[i]+
"<br>"+"<br>"+"<b>Depth:</b>\t"+depth[i]+"\t("+"<b>Uncertainty:</b>\t"+uncertaintyOfDepth[i]+")"+"<br><br>"+"<b>Magnitude:</b>\t"+magtd[i]+"\t("+"<b>Uncertainty:</b>\t"+ uncertaintyOfMag[i]+")";

google.maps.event.addListener(marker, 'click', function() {

    $("#earthquakeDetail").html(this.customInfo);
    $( "#popupEarthquakeDetail" ).popup({ theme: "b" }); //initial popup with theme color
    $( "#popupEarthquakeDetail" ).popup( "open" );

});

}

var markerCluster = new MarkerClusterer(map,markers);

var searchBox=new google.maps.places.SearchBox(document.getElementById('searchbox'));

google.maps.event.addListener(searchBox,'places_changed',function(){
var places=searchBox.getPlaces();
var bounds=new google.maps.LatLngBounds();
var i,place;

for(i=0;place=places[i];i++){
  bounds.extend(place.geometry.location);
  mysearchmarker.setPosition(place.geometry.location);
}
map.fitBounds(bounds);
map.setZoom(6);
});
 google.maps.event.trigger(map,'resize');
}
function GetTodayDate() {
    var tdate = new Date();
    var dd = tdate.getDate(); //yields day
    var MM = tdate.getMonth(); //yields month
    var yyyy = tdate.getFullYear(); //yields year
    var xxx = yyyy + "-" +( MM+1) + "-" + dd;

    return xxx;
}
function today(){  //show today markers

    var arr=[];
var arr1=[];
var gmarkers = [];
var loc=[];
var time=[];
var depth=[];
var uncertaintyOfDepth=[];
var magtd=[];
var uncertaintyOfMag=[];

$(document).ready(function(){

 loc= <?php echo json_encode($earthquakeDescription);?>;
 arr=<?php echo json_encode($earthquakeLatitude);?>;
 arr1=<?php echo json_encode($earthquakeLongitude);?>;
  magtd=<?php echo json_encode($earthquakeMagnitude);?>;
    uncertaintyOfMag=<?php echo json_encode($magUncertainty);?>;
     time=<?php echo json_encode($earthquakeTime);?>;
     depth=<?php echo json_encode($depthValue);?>;
      uncertaintyOfDepth=<?php echo json_encode($depthUncertainty);?>;
   
});


var markers=[];
var map;
var geocoder;
   

 if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function (position) {
         initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
         map.setCenter(initialLocation);

         var myLocation=new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
mymarker = new google.maps.Marker({
     icon: 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png',
        position: myLocation,
        map: map,
        title: 'Your Location'
        //icon:'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    }); 

         
mysearchmarker = new google.maps.Marker({
     icon: 'http://labs.google.com/ridefinder/images/mm_20_brown.png',
        //position: myLocation,
        map: map,
        title: 'Your Searched Address'
        //icon:'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    }); 



     });
     
 }


    var mapOptions = { center: new google.maps.LatLng(arr[0],arr1[0]), zoom: 6
    }; 
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);


     geocoder = new google.maps.Geocoder();



 for(var i=0;i<arr.length;i++){

if(magtd[i]<=2.5){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'; 
}else if(magtd[i]>2.5 && magtd[i]<5.4)
{
    var iconFile = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'; 
}
else if(magtd[i]>=5.4 && magtd[i]<6.9){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'; 
}
else if(magtd[i]>=6.9 && magtd[i]<=7.9){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png'; 
}
else if(magtd[i]>8.0){
  var iconFile = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'; 
}


var earthquakeDate=time[i].substring(0,10);
var today=GetTodayDate();
if(earthquakeDate==today){
    var markerPoint = new google.maps.LatLng(arr[i], arr1[i]);
     marker = new google.maps.Marker({
        position: markerPoint,
         //animation: google.maps.Animation.DROP,
        map: map,
        title: 'Earthquake alert'
    }); 

  markers.push(marker);
marker.setIcon(iconFile);

marker.customInfo = "<b>Location:</b>\t"+loc[i]+"<br><br>"+"<b>Latitude:</b>\t"+arr[i]+"<br><br>"+"<b>Longitude:</b>\t"+arr1[i]+"<br><br>"+"<b>Time:</b></b>\t"+time[i]+
"<br>"+"<br>"+"<b>Depth:</b>\t"+depth[i]+"\t("+"<b>Uncertainty:</b>\t"+uncertaintyOfDepth[i]+")"+"<br><br>"+"<b>Magnitude:</b>\t"+magtd[i]+"\t("+"<b>Uncertainty:</b>\t"+ uncertaintyOfMag[i]+")";

google.maps.event.addListener(marker, 'click', function() {

    $("#earthquakeDetail").html(this.customInfo);
    $( "#popupEarthquakeDetail" ).popup({ theme: "b" }); //initial popup with theme color
    $( "#popupEarthquakeDetail" ).popup( "open" );

});

}
}
var markerCluster = new MarkerClusterer(map,markers);

var searchBox=new google.maps.places.SearchBox(document.getElementById('searchbox'));

google.maps.event.addListener(searchBox,'places_changed',function(){
var places=searchBox.getPlaces();
var bounds=new google.maps.LatLngBounds();
var i,place;

for(i=0;place=places[i];i++){
  bounds.extend(place.geometry.location);
  mysearchmarker.setPosition(place.geometry.location);
}
map.fitBounds(bounds);
map.setZoom(6);
});
//google.maps.event.addListenerOnce(map, 'idle',today);

}

//$("input[type='radio']:radio-choice-3").attr("checked",true).checkboxradio("refresh");

  	google.maps.event.addDomListener(window, 'load', initialize);



$(document).ready(function(){

    $("input[type='radio']").change(function () {

      var selection=$(this).val();
     // alert("Radio button selection changed. Selected: "+selection);
     if(selection=="choice-2"){

   today();
   

}else{
  initialize();

}
//google.maps.event.addListener(map, 'idle', today);
  
     //alert("hello");
 
    });
        });



  	 </script> 
  	</head> 
  	<body> 

     <!-- /page -->
        <div data-role="page" id="home-page" data-theme="b">
          <div data-role="panel" id="myPanel" data-theme="c">
<h5>Hello<?php echo " ".$_SESSION['username'];?></h5>
            <hr/>
<h3>Instructions</h3>
<hr/>
<p style="color:purple;">Purple marker: Your location</p>
<p style="color:brown;">Brown marker: Your searched place</p>
<p style="color:green;">Green marker: Magnitude less than 2.5</p>
<p style="color:blue;">Blue marker: Magnitude between 2.5-5.4</p>
<p style="color:yellow;">Yellow marker: Magnitude between 5.4-6.9</p>
<p style="color:orange;">Orange marker: Magnitude between 6.9-7.9</p>
<p style="color:red;">Red marker: Magnitude greater than 8.0</p>
<hr/>
 <a href="#settings" data-rel="dialog"  class="ui-btn ui-icon-gear ui-btn-icon-left">Settings</a>
     <a href="signIn.php" id="lgout"  class="ui-btn ui-icon-arrow-l ui-btn-icon-left">Logout</a>
</div>
            <!-- /header -->
            <div data-role="header" data-theme="b">

                 <h1>Earthquake Locator</h1> <input type="search" name="search-1" id="searchbox" value="">

                    <a href="#myPanel" data-role="button" data-icon="bars" data-iconshadow="false"
        data-direction="reverse"  data-transition="slide"
        data-iconpos="notext"  class="ui-btn-left">home</a>
            </div>

            <!-- /content -->
            <div data-role="content" class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
                                      <form>



</form>
                <div id="map-canvas" style="height:550px;"></div>
                <a href="#generic-dialog" id="dialog-anchor" style="display:none" data-rel="dialog">Open dialog</a>

            </div>



        </div>
        <!-- /page -->
        <div data-role="page" id="generic-dialog">
            <!-- /header -->
            <div data-role="header" data-theme="b">

                 <h1>Earthquake's details</h1>
            </div>
            <!-- /content -->
            <div data-role="popup" id="popupEarthquakeDetail" class="ui-content" data-position-to="origin" style="max-width:280px">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right" data-position-to="origin" >Close</a>
                <p id="earthquakeDetail">Details about earth quake goes here</p>
            </div>


        </div>

  <div data-role="page" id="settings" >
            <!-- /header -->
            <div data-role="header" data-theme="d">

                 <h1>Settings</h1>
            </div>
            <!-- /content -->
            <div data-role="content" data-theme="b">
              <p>Display earthquakes:</p>
  <input type="radio" name="radio-choice"  AutoPostBack="true" id="radio-choice-1" value="choice-1" checked="checked" />
      <label for="radio-choice-1">All</label>

      <input type="radio" name="radio-choice"   id="radio-choice-2" value="choice-2"  />
      <label for="radio-choice-2">Today</label>

   <hr/>

  <a href="editUserDetail.php"  class="ui-btn ui-icon-edit ui-btn-icon-left">Edit password</a>
      


            </div>


        </div>







  	</body> 
  	</html>