<html>
    <head>
        <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.js" type="text/javascript"></script>    
    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
        <link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css"/>
        <link href="<?=base_url() ?>resources/admin/admin_design/style_<?=lang('db')?>.css" rel="stylesheet" type="text/css" />  
        <style>
            #map_canvas2{height:70%;width:100%;}
            /*#map_canvas2{min-height:250px;width:100%;}*/
            .chosen-container{width:90% !important}
            .pac-container{z-index:9999999 }
        </style>
    </head>
    <body>
        <form method="POST"  onsubmit="return false;">
            <div style="width:20%;display: inline-block;">
                Type
                <select class="chosen-select" name="tripType">
                    <option>Select Trip Type</option>
                    <?php if(isset($tripTypes) && is_array($tripTypes) && count($tripTypes)):?>
                    <?php foreach($tripTypes as $i=>$Obj):?>
                    <option value="<?php echo $Obj['typeId']?>" <?php echo ($i==0)?'selected="selected"':''?>><?php echo $Obj['typeName_'.lang('db')]?></option>
                    <?php endforeach?>
                    <?php endif?>
                </select>
            </div>    
            <div style="width:20%;display: inline-block;">
                Level
                <select class="chosen-select" name="tripLevelId">
                    <option>Select Car Level</option>
                    <?php if(isset($Levels) && is_array($Levels) && count($Levels)):?>
                    <?php foreach($Levels as  $i=>$Obj):?>
                    <option value="<?php echo $Obj['levelId']?>" <?php echo ($i==0)?'selected="selected"':''?>><?php echo $Obj['levelName_'.lang('db')]?></option>
                    <?php endforeach?>
                    <?php endif?>
                </select>
            </div> 
            <div style="width:20%;display: inline-block;">
                Payment Method
                <select class="chosen-select" name="payBy">
                    <option value="cash" selected="selected">Cash</option>
                    <option value="visa">Visa</option>
                </select>
            </div> 
             <div style="width:20%;display: inline-block;">
                Driver
                <select class="chosen-select" name="tripDriverId">
                    <option>Select Driver</option>
                    <?php if(isset($Drivers) && is_array($Drivers) && count($Drivers)):?>
                    <?php foreach($Drivers as $Obj):?>
                    <option value="<?php echo $Obj['driverId']?>"><?php echo $Obj['driverFName'].' '.$Obj['driverLName'].' '.$Obj['driverMobile']?></option>
                    <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
          <div class="map_input">
            <div id="map_canvas2">
            </div>
             <div class="col-sm-12 from_to">
                <div class="col-xs-6">
                    <span class="cir"></span>
                    <input type="text" id="pac-input1"  class="controls drop_pick" placeholder="PickUp"/>
                </div>
                <div class="col-xs-6">
                    <span class="cir to_place"></span>
                    <input type="text" id="pac-input2"  class="controls drop_pick" placeholder="DropOff"/>
                </div>
            </div>
            </div>
            <!--tripNote-->           
            <input type='hidden' name="tripPassengerId" value='<?php echo $Passenger['passengerId']?>'/>
            <input type='hidden' name="tripCountryId" value='<?php echo $Passenger['passengerCountryId']?>'/>
            <input type='hidden' name="tripCityId" value='<?php echo $Passenger['passengerCityId']?>'/>
            <input type='hidden' name="tripPackageId" value='<?php echo $Passenger['packageId']?>'/>
            <input type='hidden' name="tripSource" value='2'/>
           
           
            <div style="width:20%;display: inline-block;">
                When
                <select class="chosen-select TripTime" name="tripNow">
                    <option value="1" selected="selected">Now</option>
                    <option value="0">Later</option>
                </select>
            </div> 
            <div class="date_trip" style="width:20%;display: inline-block;">
                Due Date
                <input type="datetime-local" name="tripDueDate" placeholder="ex : 2016-01-02 12:14:00"/>
            </div>
             <div style="width:20%;display: inline-block;">
                Comment
                <input type="text" name="tripNote" placeholder="Comment"/>
            </div>
           <div class="add_new" style="display: inline-block;">
             <button type="button" class="btn btn-block AddNewTrip">Add Trip</button>
            </div> 
        </form>
        <script>
            var CENTER2;
            var loc2;
            var Map_Options2;
            var map2;
            var marker1;
            var marker2;
            var input1;
            var input2;
            var geocoder2;
            function CreateMap2(position)
            {
                if(!position)
                {
                    position={coords:{latitude:26.9806481,longitude:40.5237013}}
                }
                geocoder2 = new google.maps.Geocoder();
                CENTER2 = [position.coords.latitude,position.coords.longitude];
                loc2 = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                Map_Options2={center: loc2,zoom: 9,mapTypeId: google.maps.MapTypeId.ROADMAP,mapTypeControl: false,zoomControl:true};
                map2 = new google.maps.Map(document.getElementById("map_canvas2"), Map_Options2);
                marker1 = new google.maps.Marker({title:'PickUp',icon:'http://maps.google.com/mapfiles/ms/icons/green-dot.png',position: new google.maps.LatLng(CENTER2[0]-0.001,CENTER2[1]-0.001),optimized: true,map: map2,draggable:true});
                marker2 = new google.maps.Marker({title:'Drop Off',icon:'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',position: new google.maps.LatLng(CENTER2[0],CENTER2[1]),optimized: true,map: map2,draggable:true});
                marker1.addListener('dragend',function(event) {
                    geocoder2.geocode({latLng: event.latLng}, function(responses) {
                        if (responses && responses.length > 0) {
                            input1.value = responses[0].formatted_address;
                        }
                    });
                });
                marker2.addListener('dragend',function(event) {
                    geocoder2.geocode({latLng: event.latLng}, function(responses) {
                        if (responses && responses.length > 0) {
                            input2.value = responses[0].formatted_address;
                        }
                    });
                });
                SearchInput();
            }
            function SearchInput()
            {
                input1 = document.getElementById('pac-input1');
                var searchBox1 = new google.maps.places.SearchBox(input1);
                map2.controls[google.maps.ControlPosition.TOP_LEFT].push(input1);
                searchBox1.addListener('places_changed', function() {
                    var places = searchBox1.getPlaces();
                    if (places.length == 0) return;
                    marker1.setPosition(places[0].geometry.location)
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(marker1.getPosition());
                    bounds.extend(marker2.getPosition());
                    map2.fitBounds(bounds);
                    
                });
                input2 = document.getElementById('pac-input2');
                var searchBox2 = new google.maps.places.SearchBox(input2);
                map2.controls[google.maps.ControlPosition.TOP_RIGHT].push(input2);
                searchBox2.addListener('places_changed', function() {
                    var places = searchBox2.getPlaces();
                    if (places.length == 0) return;
                    marker2.setPosition(places[0].geometry.location)
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(marker1.getPosition());
                    bounds.extend(marker2.getPosition());
                    map2.fitBounds(bounds);
                });
                

            }
            function initMap2(){
                CreateMap2();
                /*navigator.geolocation.getCurrentPosition(CreateMap2);*/
            }
            $(function(){
                $('.date_trip').hide();
                $('.chosen-select').chosen().change(function(e,p){
                    if(e.target.className=='chosen-select TripTime')
                    {
                        if(parseInt(p.selected))
                            $('.date_trip').hide();
                        else
                            $('.date_trip').show();
                    }
                    console.log(p.selected);
                });
                $('.AddNewTrip').click(function(e){
                    e.preventDefault()
                    var data = $('form').serializeArray();
                    data.push({name:'tripFromAddress',value:input1.value});
                    data.push({name:'tripFrom',value:JSON.stringify({lat:marker1.getPosition().lat(),lng:marker1.getPosition().lng()})});
                    data.push({name:'tripToAddress',value:input2.value});
                    data.push({name:'tripTo',value:JSON.stringify({lat:marker2.getPosition().lat(),lng:marker2.getPosition().lng()})});
                    data.push({name:'coords',value:JSON.stringify([CENTER2[1],CENTER2[0]])});
                    
                    console.log(data);
                    $.ajax({
                        method:'POST',
                        type:'json',
                        url:'<?php echo current_url()?>',
                        data : data,
                        success:function(res){
                            console.log(res);
                            if(res.status==false){
                                alert('عفوا : لا يوجد سائقين اون لاين الان');
                                return;
                            }
                            if(!res.tripFailedToAssign)res=JSON.parse(res);
                            if(res.tripFailedToAssign)
                            {
                                alert('تعثر الحصول علي سائق قريب');
                            }
                            else
                            {
                                alert('تم اضافة الرحلة');
                                parent.jQuery.colorbox.close()
                            }
                        }
                    });
                });
            })
        </script>       
         <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDyl86uXLuo0Bmr-Eonvc-Nw3YvWriG0tk&callback=initMap2"></script>
    </body>
</html>