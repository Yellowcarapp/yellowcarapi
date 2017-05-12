<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title>Google Maps JavaScript API v3 Example: Directions Complex</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    </head>
    <body>
        
        <!-- 
         <div id="map" style="width: 500px; height:500px;"></div>
         <div id="directionsPanel" style="float:right;"></div>
         -->
        
       <div id="map" style="float:left;width:320px; height:500px"></div> 
       
        <div id="directionsPanel" style="float:right;width:30%;height 100%;display:none;"></div>
        <div id="duration" style="float:right;width:320px;height 100%;display:none;"  >Duration: </div>
        <div id="distance" style="float:right;width:320px;height 100%;display:none;" >Distance: </div>
        
         
        
        <script type="text/javascript">
            //------
            var parameters =window.location.search.substring(1); //window.location.search;
            var typeArr = parameters.split("&type=");
           
           
            //alert(decodeURIComponent(typeArr[1])+' '+decodeURIComponent(typeArr[0]));
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
            var map;
            var myOptions = {
                zoom:7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            
            var map = new google.maps.Map(document.getElementById("map"), myOptions);
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById("directionsPanel"));
            
           
            var request = {
                origin:'<?=$_GET['origin_Latitude']?>,<?=$_GET['origin_Longitude']?>',
                destination:'<?=$_GET['des_Latitude']?>,<?=$_GET['des_Longitude']?>',
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            
            
            directionsService.route(request, function(response, status) {
                                    if (status == google.maps.DirectionsStatus.OK) {
                                    
                                    // Display the distance:
                                    document.getElementById('distance').innerHTML += 
                                    response.routes[0].legs[0].distance.value + " meters";
                                    
                                    // Display the duration:
                                    document.getElementById('duration').innerHTML += 
                                    response.routes[0].legs[0].duration.value + " seconds";
                                    
                                    directionsDisplay.setDirections(response);
                                    }
                                    });
            
            </script> 
    </body> 
</html>