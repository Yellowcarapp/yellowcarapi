<style type="text/css">
 #map {
        height: 300px;
        width:100%;
      }
</style>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBMo6dxhL4fxLIBzCrRrxd4WGQ1CxMs-7I"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMo6dxhL4fxLIBzCrRrxd4WGQ1CxMs-7I&libraries=places"></script>
<?php  
$lat = 39.172954;
$lng = 21.543633;
if(isset($page[count($page)-1]['value']) && $page[count($page)-1]['value']!='')
{
$data=explode(',',$page[count($page)-1]['value']);
$lat = $data[0];
$lng = $data[1];
    }
?>
<script>
	
function initialize() {
   // alert('<?=$data[0]?>')
var map = new google.maps.Map(document.getElementById('map'),{
		 center: {lat: <?=$lat?>, lng: <?=$lng?>},
		zoom:15
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
       var string= event.latLng.lat()+','+event.latLng.lng();
        document.getElementById("value_8").value=string;
 
});
  
  google.maps.event.addListener(map, "center_changed", function() {
  	var location = map.getCenter();
      var lat=location.lat();
      var long=location.lng();
	  var string=lat +','+long;
        document.getElementById("value_8").value=string;

	/*document.getElementById("lat").value = location.lat();
	document.getElementById("lon").value = location.lng();*/
	
	placeMarker(lat,long);
//console.log(location.lat());
	
  });	
}
      function placeMarker(lat,lang) {
         // console.log(lat);
	  var clickedLocation = new google.maps.LatLng({lat: lat, lng: lang});
	  marker.setPosition({lat: lat, lng: lang});
	}
window.onload = function(){initialize();};

    
    
</script>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Setting')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
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
<form role="form" action="<?=site_url('Generalsetting/SaveSetting')?>" method="post" name="formID" class="formID" id="formID">
                    <!-- <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['modelId'])) echo $page['modelId'] ?>" />-->                                
   
      <? for($i=0;$i<count($page);$i++){ ?>
                      <div class="form-group">
                     <label class="full_width"> <?=$page[$i]['name']?>  </label>  
 <? if($page[$i]['id']==count($page)) $type='hidden';else $type='text';?>
                      <input type="<?=$type?>" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="values[]" id="value_<?=$i?>" value="<?php if(isset($page[$i]['value'])) echo $page[$i]['value'] ?>" />
                      <? if($type=='hidden'){?>
                            <div id="map"></div>
                          <?}?>   
                    </div>
   
 <? }?>
                    
    
               
    
                      
                      
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"> <?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->




