<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(($lat!='' && $lon!='') || $edit==true){?>
<style type="text/css">
div#bd {
    position: relative;
}
div#gmap {
		height: 400px;
		width:550px;
}
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
 
<script type="text/javascript">
var map;
var marker=false;
function initialize() {
  var myLatlng = new google.maps.LatLng(<?=$lat?>,<?=$lon?>);
  var myOptions = {
    zoom: <?=$zoom?>,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.Map
  }
  map = new google.maps.Map(document.getElementById("gmap"), myOptions);
  marker = new google.maps.Marker({
      	position: myLatlng, 
      	map: map,
	    //icon : '<?//= $this->config->item('assets_path')."images/marker.png" ?>',				  
  	});
  google.maps.event.addListener(map, 'center_changed', function() {
  	var location = map.getCenter();
	
	<?php if($edit==true){?>
		document.getElementById("lat").value = location.lat();
		document.getElementById("lon").value = location.lng();
		
	    placeMarker(location);
	<?php }?>
	
  });
  google.maps.event.addListener(map, 'zoom_changed', function() {
  	zoomLevel = map.getZoom();
	document.getElementById("zoom_level").value = zoomLevel;
  });
  google.maps.event.addListener(marker, 'dblclick', function() {
    zoomLevel = map.getZoom()+1;
    if (zoomLevel == 20) {
     zoomLevel = 10;
   	}    
	<?php if($edit==true){?>
		document.getElementById("zoom_level").value = zoomLevel; 
	<?php }?>
	map.setZoom(zoomLevel);
	 
  });
  
	<?php if($edit==true){?>
	  document.getElementById("zoom_level").innerHTML = <?=$zoom?>; 
	  document.getElementById("lat").value = <?=$lat?>;
	  document.getElementById("lon").value = <?=$lon?>;  
  <?php }?>
}
	<?php if($edit==true){?>
	function placeMarker(location) {
	  var clickedLocation = new google.maps.LatLng(location);
	  marker.setPosition(location);
	}
<?php }?>

window.onload = function(){initialize();};

</script>

<center>
    <div id="bd">
        <div id="gmap"></div>
        <div style="width:100%;float:right;margin-top:10px;">
        
            <!--<script type="text/javascript" src="<?//=$this->config->item('assets_path')?>javascript/jquery-1.4.2.min.js"></script>
            <script type="text/javascript" src="<?//=$this->config->item('assets_path')?>javascript/LoadModule.js"></script>-->
            
              <!--  <form id="detailed_map_frm" name="detailed_map_frm">-->
            
                    <?php //=lang('latitude')?>
                        <input type="hidden" id="lat" name="contact_latitude" value="<?=$lat?>" />
                     <?php //=lang('longitude')?>
                        <input type="hidden" id="lon" name="contact_longitude" value="<?=$lon?>" />
                    <input type="hidden" id="zoom_level" name="zoom_level" value="<?=$zoom?>"  style="display:none;"/>
                    
                   <!-- <input type="button" value="<?=lang('save_this_view');?>" class="comp_address_btn"  onclick="save_detailed_map();" style="width:110px;height:35px;margin:20px;"/>-->
                    <span id="detailed_map_ret"></span>      
                    
               <!--  </form>   -->
		  </div>  
    </div>
</center>

<script>

function coderHakan()
{
	
var sayfa = window.open('','','width=500,height=500');
sayfa.document.open("text/html");
sayfa.document.write(document.getElementById('gmap').innerHTML);
sayfa.document.close();
sayfa.print();

}

</script>




<?php }else{?>


<div style="width:100%;text-align:center;" align="center">
    <div class="container" id="welcomeHero">
        	<div class="noThing container">
        		<center>
        			<!--<img src="<?//=base_url()?>files/images/nothing.jpg" style="width:300px;">-->
        			<br><br><br>
                    <b>لا توجد خريطه متاحه</b>
                    <br><br>
                  <!--  <input type="button" onclick="window.close();" value="<?//=lang('close')?>" style="width:110px;height:35px;margin:10px;"/>-->
                </center>	            
			</div>                
        </div>
</div>
<?php }?>
