<style type="text/css">
 #map {
        height: 300px;
        width:100%;
      }
.controls {
/*
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
*/

}
.map-group{
width:50%;
float:left;    
}
.address_group{
float:left;
width:40%; 
padding-left:5%;    
}    
    
#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
/*  margin-left: 12px;*/
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-++++++++++or {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
 

    </style>
   

<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places"></script>



<?php  
$lat = 59.325;
$lng = 18.070;
if(isset($page['placeId']) && isset($page['placeLat']) && $page['placeLat'] !="") $lat = $page['placeLat'];
if(isset($page['placeId']) && isset($page['placeLon']) && $page['placeLon'] !="") $lng = $page['placeLon'];
?>


<script>
	
function initialize() {
var map = new google.maps.Map(document.getElementById('map'),{
		 center: {lat: <?=$lat?>, lng: <?=$lng?>},
		zoom:15
	});
/*Search Box*/   
// Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
    
var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
	google.maps.event.addListener(searchBox,'places_changed',function(){
        var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
        var i, place;
        console.log(places)
		for(i=0; place=places[i];i++){
  			bounds.extend(place.geometry.location);
  			marker.setPosition(place.geometry.location); //set marker position new...
            document.getElementById("lat").value = place.geometry.location.lat();
            document.getElementById("lng").value = place.geometry.location.lng();
        }
        
  		map.fitBounds(bounds);
  		map.setZoom(15);
        var placeName_ar =  $("#placeName_ar").val();
         var placeName_en =  $("#placeName_en").val();
         var placeName_ur =  $("#placeName_ur").val();
       // var address_en =  $("#address_title_en").val();
        if( placeName_ar == ""){
        $("#placeName_ar").val($("#pac-input").val());
            if( placeName_en == ""){
        $("#placeName_en").val($("#pac-input").val());
                if( placeName_ur == ""){
        $("#placeName_ur").val($("#pac-input").val());
      //  $("#address_title_en").val($("#pac-input").val());
        }    
	});
/*Search Box*/       
marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: {lat: <?=$lat?>, lng: <?=$lng?>}
  });
  marker.addListener('click', toggleBounce);

    

    
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
google.maps.event.addListener(marker, 'dragend', function(event) {
    document.getElementById("lat").value = event.latLng.lat();
    document.getElementById("lng").value = event.latLng.lng();
    console.log(event);
    // bingo!
    // a.latLng contains the co-ordinates where the marker was dropped
});
	
}
window.onload = function(){initialize();};
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Places
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('admin/Generalsetting/Saveplace')?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['placeId'])) echo $page['placeId']; ?>" name="pageid"  > 
<input type="hidden" size="69" id="lat" value="<?php if(isset($page['placeLat'])) echo $page['placeLat']; ?>" name="lat"  > 
<input type="hidden" size="69" id="lng" value="<?php if(isset($page['placeLon'])) echo $page['placeLon']; ?>" name="lng"  > 

    
    
                    <!-- select -->
                    <div class="form-group">
                      <label><?=lang('Country')?></label>
                      <select class="width_size form-control validate[required]" name="countryId" id="countryId" onchange="$('#city_Load').load( '<?= site_url('admin/generalsetting/get_cities/') ?>/'+$(this).val());" > 
                            <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'] ?>" <?php if(isset($page['countryId'])&&$page['countryId']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?> 
                      </select>
                    </div>
    
                    <!-- select -->
                    <div class="form-group">
                      <label><?=lang('City')?></label>
                     <span id="city_Load">    
                      <select class="width_size form-control validate[required]" name="cityId" id="cityId" > 
                              <?php for($z=0;$z<count($cities);$z++){ ?>
                                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['cityId'])&&$page['cityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        </span> 
                    </div>
    
     <div class="form-group">
                     <label class="full_width checkbox_label "><?=lang('Type')?></label>      
                    
                      <div class="checkbox">
                        <label>
<input type="radio" name="placeType" id="optionsRadios2" value="airport" <?php if(isset($page['placeId']) && $page['placeType'] == 'airport') echo "checked" ?>/>
                         <?=lang('airport')?>    
                        </label>
                           <label>
<input type="radio" name="placeType" id="optionsRadios3" value="hotel" <?php if(isset($page['placeId']) && $page['placeType'] == 'hotel') echo "checked" ?>/>
                         <?=lang('hotel')?>    
                        </label>
                      </div>
                    
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('NameInAr')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="placeName_ar" id="placeName_ar" value="<?php if(isset($page['placeName_ar'])) echo $page['placeName_ar']; ?>" />
                    </div>
     <div class="form-group">
                     <label class="full_width"><?=lang('NameInEn')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="placeName_en" id="placeName_en" value="<?php if(isset($page['placeName_en'])) echo $page['placeName_en']; ?>" />
                    </div>
     <div class="form-group">
                     <label class="full_width"><?=lang('NameInUr')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="placeName_ur" id="placeName_ur" value="<?php if(isset($page['placeName_ur'])) echo $page['placeName_ur']; ?>" />
                    </div>
                   <div class="form-group ">
        <label class="full_width"><?=lang('Map_Search')?></label>  
        
<input type="text" class="form-control controls" name="search_box" id="pac-input" placeholder="Search Box " />
    </div>   
                  
                    <!-- radio -->
                   
                    
                    <div class="form-group">
                    
                    <div id="map"></div>
                      </div>
    
    
    
    
   
    
    
    
    
    
                 
      
                      
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
