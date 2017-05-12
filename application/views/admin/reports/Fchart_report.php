<? if($grCol==6|| $grCol==1 || $grCol==2){ ?>
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Trip Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                  <div id="areaChart" height="450" ></div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<script>
     var chart;
 $(function () { 
      // var labels = Array();
     
            
      
      
 var labels = Array();
            var dataArr=Array(); 
      <?    for($m=0;$m<count($orders);$m++){ ?> 
        <? if($grCol==6){ ?> 
            labels[<?= $m ?>]="<?= $orders[$m]['acc_date'] ?>";
        <? }else{ $country=$orders[$m]['countryName_'.lang('db')];
    if($country=='')$country='Saudia Arabia';
     $city=$orders[$m]['cityName_'.lang('db')];
    if($city=='')$city='Jeddah'; ?>
            labels[<?= $m ?>]="<?= $country.",". $city;?>"
        <? } ?>    
      //  data[<?= $m ?>]="<?= $orders[$m]['tripCost'] ?>";        
      <? // } ?>  
            <? $cost= $orders[$m]['totalCost'] ;if($cost=='')$cost=0;?>
            var arr={name:labels[<?=$m?>],y:<?= $cost ?>};
         dataArr.push(arr)
      <? } ?>  

        
      
       
      
console.log( dataArr)

       
    


chart = new Highcharts.Chart({
  
        chart: {
            type: 'column',
            'renderTo':'areaChart'
        },
    title: {
            text: 'Finnance Chart'
        },
        subtitle: {
            text: 'Sum of cost'
        },
        xAxis: {
            type: 'Finnance',
            categories:labels
        },
        yAxis: {
            title: {
                text: 'Num'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        series: [{
            name: 'Finnance',
            colorByPoint: true,
            data:dataArr
         }]
    });
});
</script> 
              
              
              
<? } else { ?>      
      
      
              <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Trip Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                 <div id="areaChart" height="450" ></div>
                    <div id="chartLegend"></div>                
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<script>
     var chart;
 $(function () { 
      // var labels = Array();
     
            
      
      
 var labels = Array();
            var dataArr=Array(); 
      <?    for($m=0;$m<count($orders);$m++){ 
         if($grCol==3) 
               {
                   
                        $title=  $orders[$m]['driverFName'].' '.$orders[$m]['driverLName'].'( '.$orders[$m]['driverMobile'].')';
               }
               else if($grCol==5)
               {
                   
                         $title= $orders[$m]['passengerName'];
               }
                else if($grCol==4)
               {
                   
                         $title= $orders[$m]['network_name'];
               }
                   else if($grCol==7)
               {
                   
                         $title= $orders[$m]['typeName_'.lang('db')];
               }
               else if($grCol==8)
               {
                    if($orders[$m]['tripStatus']=="" || $orders[$m]['tripStatus']==1)
                         $title= lang('sts1');
                  
                    else if($orders[$m]['tripStatus']==2)   
                          $title= lang('sts2');
                    else if($orders[$m]['tripStatus']==3)   
                         $title= lang('sts3');
                    else if($orders[$m]['tripStatus']==4)   
                          $title= lang('sts4');
                    else if($orders[$m]['tripStatus']==5)   
                         $title= lang('sts5');
                    else if($orders[$m]['tripStatus']==6)   
                         $title= lang('sts6');
                    else if($orders[$m]['tripStatus']==7)   
                        $title= lang('sts7');
               } 
               
            if(isset( $orders[$m]['totalCost']) ||  $orders[$m]['totalCost'] !='') $cost=  $orders[$m]['totalCost']; else $cost= '0'; ?>
            var arr={name:"<?=$title?>",y:<?= $cost ?>};
         dataArr.push(arr)
      <? } ?>  

        
      
       
      
console.log( dataArr)

       
    


chart = new Highcharts.Chart({
  
        chart: {
           plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            'renderTo':'areaChart'
        },
    title: {
            text: 'Trip Chart'
        },
      plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Trip',
            colorByPoint: true,
            data:dataArr
         }]
    });
});
</script> 

<? } ?>