$( document ).ready(function() {
 if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(success, error);
        }

        //Get the latitude and the longitude;
        function success(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
        
            var latlng = lat+","+ long;
var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&sensor=false";
$.getJSON(url, function (data) {
 
        var address = data.results[1].formatted_address;
       $("#address").val(address);
          
   
});

        }

        function error(){
            console.log("Geocoder failed");
        }
 

   
});
