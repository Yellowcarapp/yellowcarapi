<style>
    #map_canvas{min-height:550px;width:100;}
</style>
<div class="content-wrapper first_page">
  <div class="col-sm-12">
    <div class="col-sm-9">
      <div id="map_canvas"></div>
    </div>
    <div class="col-sm-3 driver_trip">
      <div>
        <div class="col-sm-6">
          <p>Drivers</p>
        </div>
        <div class="col-sm-6">
          <p>Trips</p>
        </div>
        <div id="orders"></div>
      </div>
    </div>
  </div>
</div>
<script>
  function CreateDriverElement(Obj)
  {
    var StatusName='available';
    switch(Obj.tripStatus)
    {
      case 3:
          StatusName = 'OnTheWay';
        break;
      case 4:
          StatusName = 'arrived';
        break;
      case 5:
          StatusName = 'picked up';
        break;
      case 6:
          StatusName = 'Finished';
        break;
    }
    var Class = '';
    if(!Obj.tripId)Class='status_arrive';
    var Return = '';
    Return += '<div class="list_item">'+
                '<div class="col-sm-3">'+
                  //'<span class="small_cir"></span>'+
                  '<img  src="<?php echo base_url() ?>resources/uploads/files/original/'+Obj.driverImage+'" onclick="OpenInfoWindow('+Obj.driverId+')"/>'+
                '</div>'+
                '<div class="col-sm-9">'+
                  '<h3>'+Obj.driverFName+' '+Obj.driverLName+'</h3>'+
                  '<p>'+Obj.levelName+'<i class="fa fa-check" aria-hidden="true"></i></p>'+
                '</div>'+
                '<div class="status_div">'+
                  '<div class="col-sm-6">'+
                    '<p><span class="status '+Class+'"></span>'+StatusName+'</p>'+
                  '</div>'+
                  '<div class="col-sm-3">'+
                    '<p class="call_btn" onclick="Call('+Obj.driverMobile+')">CALL</p>'+
                  '</div>'+
                  '<div class="col-sm-3">'+
                    '<p class="chat_txt" onclick="Chat('+Obj.driverId+')">Chat<i class="fa fa-circle" aria-hidden="true"></i></p>'+
                  '</div>'+
                '</div>'+
              '</div>'
      return Return;
  }
    var radiusInKm= 200;
    var API='http://taxinew.mybluemix.net/api/';
    var ADMINAPI='<?php echo base_url() .'api/admin.php'?>';
    var CENTER;
    var Drivers_Arr;
    var Drivers_Html;
    var Ajax_Working=false;
    var image="<?php echo base_url().'resources/admin/markers/marker_';?>";
    var ProfileImg = "<?php echo base_url() .'resources/uploads/files/original/'?>"
    var map;
    var vehiclesInQuery = [];
    var color;
    var BusyTaxis;
    var FreeTaxis;
    var pinIcon;
    var infowindow;
    function GetAllDrivers()
    {
        if(Ajax_Working)return ;
        Ajax_Working=true;
        Drivers_Arr = [];
        Drivers_Html='';
        $.ajax({
            url:API+'nearby?AllDrivers=true&latitude='+CENTER[0]+'&longitude='+CENTER[1]+'&limit=100&distance=200',
            success:function(data){
                ClearMarkers();
                BusyTaxis=0;
                FreeTaxis=0;
                data.forEach(function(entry,i) {
                    if(data[i].tripId)BusyTaxis+=1;
                    else FreeTaxis+=1;
                    color = 'green';
                    if(parseInt(data[i].tripStatus)>=3)color = 'red';
                    Drivers_Arr[data[i].driverId]=data[i];
                    pinIcon = new google.maps.MarkerImage(image+color+'_'+data[i].levelId+'.png',null,null,null,new google.maps.Size(50, 50));  
                    
                    var content = '<div style="float:left;margin-right:5px">'+
                    '<img align="left" width="50" height="50" src="'+ProfileImg+data[i].driverImage+'"/>'+
                    '</div>'+
                    '<div style="float:left">'+data[i].driverFName+' '+ data[i].driverLName+'<br/>'+
                    data[i].driverMobile+'<br/>'+
                    data[i].levelName+'<br/>';
                    if(data[i].tripId)content+='Have Trip With ID #'+data[i].tripId
                    content+='</div>'
                    if(vehiclesInQuery[data[i].driverId] && vehiclesInQuery[data[i].driverId].marker)
                    {
                        vehiclesInQuery[data[i].driverId].content = content
                        vehiclesInQuery[data[i].driverId].marker.setMap(map);
                        vehiclesInQuery[data[i].driverId].marker.setPosition(new google.maps.LatLng(data[i].geo.coordinates[1],data[i].geo.coordinates[0]));
                        vehiclesInQuery[data[i].driverId].marker.setIcon(pinIcon)
                    }else
                    {
                        var marker = new google.maps.Marker({icon:pinIcon,position: new google.maps.LatLng(data[i].geo.coordinates[1],data[i].geo.coordinates[0]),optimized: true,map: map});
                        vehiclesInQuery[data[i].driverId] = {lat:data[i].geo.coordinates[1],lon:data[i].geo.coordinates[0],Id:data[i].driverId,name:data[i].driverId,marker:marker,content:content};
                        google.maps.event.addListener(vehiclesInQuery[data[i].driverId].marker, 'click', function(innerKey) {
                            return function() {OpenInfoWindow(innerKey)}
                          }(data[i].driverId));
                  }
                  Drivers_Html +=CreateDriverElement(data[i])//'<li style="background-color:'+color+'">'+'(#'+data[i].driverId+') '+data[i].driverFName+' '+data[i].driverLName+' '+((data[i].tripId)?'#'+data[i].tripId:'')+'</li>';
                })
                $('#orders').html(Drivers_Html);
                Ajax_Working=false;
                //$('.three_tab .col-sm-3:nth(1) p:nth(0) span').html('('+FreeTaxis+')');
                //$('.three_tab .col-sm-3:nth(1) p:nth(1) span').html('('+BusyTaxis+')');
            },
            error:function(){Ajax_Working=false;}
        });
    }
    function OpenInfoWindow(innerKey)
    {
        infowindow.setContent(vehiclesInQuery[innerKey].content);  
        infowindow.open(map, vehiclesInQuery[innerKey].marker);
    }
    function GetCounts()
    {
        var currentDate = new Date();
        var day = currentDate.getDate()
        if(day<10)day = '0'+day
        var month = currentDate.getMonth() + 1
        if(month<10)month = '0'+month
        var year = currentDate.getFullYear()
        var Today = year+"-"+month+"-"+day;
        $.ajax({url:API+'counts',success:function(data){
                $('.three_tab .col-sm-3:nth(0) p:nth(0) span').html('('+data.free+')');
                $('.three_tab .col-sm-3:nth(0) p:nth(1) span').html('('+data.busy+')');
            }
        });
        $.ajax({url:API+'TripCounts',success:function(data){
              $('.three_tab .col-sm-3:nth(1) p:nth(0) span').html('('+data[1][0].total+')');
              $('.three_tab .col-sm-3:nth(1) p:nth(1) span').html('('+data[2][0].total+')');
              $('.three_tab .col-sm-3:nth(2) p:nth(0) span').html('(0)');
              $('.three_tab .col-sm-3:nth(2) p:nth(1) span').html('(0)');
              if(data[0].length) 
              {
                if(data[0][0] && data[0][0].total)
                {
                    var DateCount = data[0][0].TripDate.replace(/T/, ' ').replace(/\..+/, '').split(' ')[0]
                    if(Today == DateCount)
                    {
                        $('.three_tab .col-sm-3:nth(2) p:nth(0) span').html('('+data[0][0].total+')');
                    }
                    else
                    {
                        $('.three_tab .col-sm-3:nth(2) p:nth(1) span').html('('+data[0][0].total+')');
                    }
                }
                if(data[0][1] && data[0][1].total)
                {
                    var DateCount = data[0][1].TripDate.replace(/T/, ' ').replace(/\..+/, '').split(' ')[0]
                    if(Today == DateCount)
                    {
                        $('.three_tab .col-sm-3:nth(2) p:nth(0) span').html('('+data[0][1].total+')');
                    }
                    else
                    {
                      $('.three_tab .col-sm-3:nth(2) p:nth(1) span').html('('+data[0][1].total+')');
                    }
                }
              }
              
            }
        });
    }
    function ClearMarkers()
    {
        vehiclesInQuery.forEach(function(entry,i) {vehiclesInQuery[i].marker.setMap(null);});
    }
    function CreateMap(position)
    {
        console.log(position);
        CENTER = [position.coords.latitude,position.coords.longitude];
        var loc = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        var Map_Options={center: loc,zoom: 13,mapTypeId: google.maps.MapTypeId.ROADMAP};
        map = new google.maps.Map(document.getElementById("map_canvas"), Map_Options);
        var circle = new google.maps.Circle({
            strokeColor: "#6D3099",
            fillColor: "#B650FF",
            strokeOpacity: 0.7,
            strokeWeight: 1,
            fillOpacity: 0.35,
            map: map,
            center: loc,
            radius: ((radiusInKm) * 20),
            draggable: false
        });
        infowindow = new google.maps.InfoWindow(); 
        setInterval(GetAllDrivers,2000);
        setInterval(GetCounts,3000);
        //setInterval(TripsTotals,3000);
    }
    function initMap(){ navigator.geolocation.getCurrentPosition(CreateMap);}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyl86uXLuo0Bmr-Eonvc-Nw3YvWriG0tk&callback=initMap"></script>


  <!--
  <div class="list_item">
    <div class="col-sm-3">
      <span class="small_cir"></span>
      <img  src="<?=base_url() ?>resources/admin/admin_design/image/def.png"/>
    </div>
    <div class="col-sm-9">
      <h3>Mohamed Ali</h3>
      <p>Economy Car<i class="fa fa-check" aria-hidden="true"></i></p>
    </div>
    <div class="status_div">
      <div class="col-sm-6">
        <p><span class="status"></span>Pick up</p>
      </div>
      <div class="col-sm-3">
        <p class="call_btn">CALL</p>
      </div>
      <div class="col-sm-3">
        <p class="chat_txt">Chat<i class="fa fa-circle" aria-hidden="true"></i></p>
      </div>
    </div>
  </div>

  <div class="list_item">
    <div class="col-sm-3">
      <span class="small_cir"></span>
      <img  src="<?=base_url() ?>resources/admin/admin_design/image/def.png"/>
    </div>
    <div class="col-sm-9">
      <h3>Mohamed Ali</h3>
      <p>Economy Car<i class="fa fa-check" aria-hidden="true"></i></p>
    </div>
    <div class="status_div">
      <div class="col-sm-6">
        <p><span class="status"></span>Pick up</p>
      </div>
      <div class="col-sm-3">
        <p class="call_btn">CALL</p>
      </div>
      <div class="col-sm-3">
        <p class="chat_txt">Chat<i class="fa fa-circle" aria-hidden="true"></i></p>
      </div>
    </div>
  </div>

<div class="list_item">
<div class="col-sm-3">
<span class="small_cir"></span>
<img  src="<?=base_url() ?>resources/admin/admin_design/image/def.png"/>
</div>
<div class="col-sm-9">
<h3>Mohamed Ali</h3>
<p>Economy Car<i class="fa fa-check" aria-hidden="true"></i></p>
</div>
<div class="status_div">
<div class="col-sm-6">
<p><span class="status status_arrive"></span>Arrived</p>
</div>
<div class="col-sm-3">
<p class="call_btn">CALL</p>
</div>
<div class="col-sm-3">
<p class="chat_txt">Chat<i class="fa fa-circle" aria-hidden="true"></i></p>
</div>
</div>
</div>

<div class="list_item">
<div class="col-sm-3">
<span class="small_cir"></span>
<img  src="<?=base_url() ?>resources/admin/admin_design/image/def.png"/>
</div>
<div class="col-sm-9">
<h3>Mohamed Ali</h3>
<p>Economy Car<i class="fa fa-check" aria-hidden="true"></i></p>
</div>
<div class="status_div">
<div class="col-sm-6">
<p><span class="status status_cancel"></span>Pick up</p>
</div>
<div class="col-sm-3">
<p class="call_btn">CALL</p>
</div>
<div class="col-sm-3">
<p class="chat_txt">Chat<i class="fa fa-circle" aria-hidden="true"></i></p>
</div>
</div>
</div>
-->