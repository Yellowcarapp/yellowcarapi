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
                   <!-- <canvas id="areaChart" height="250"></canvas>-->
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
            labels[<?= $m ?>]="<?= $orders[$m]['tripCreateDate'] ?>";
        <? }else{  
     
     $country=$orders[$m]['countryName_'.lang('db')];
    if($country=='')$country='Saudia Arabia';
     $city=$orders[$m]['cityName_'.lang('db')];
    if($city=='')$city='Jeddah';
     ?>
            labels[<?= $m ?>]="<?= $country.",". $city?>"
        <? } ?>    
            <? $cost= $orders[$m]['tripCost'] ;if($cost=='')$cost=0;?>
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
            text: 'Trip Chart'
        },
        subtitle: {
            text: 'Num of trips'
        },
        xAxis: {
            type: 'Trip',
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
            name: 'Trip',
            colorByPoint: true,
            data:dataArr
         }]
    });
});
</script> 
   <!--        
 <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);
        var labels = Array();
        var data = Array();        
      <? for($m=0;$m<count($orders);$m++){ ?>
        <? if($grCol==6){ ?> 
            labels[<?= $m ?>]="<?= $orders[$m]['tripCreateDate'] ?>";
        <? }else{ ?>
            labels[<?= $m ?>]="<?= $orders[$m]['countryName_'.lang('db')].",". $orders[$m]['cityName_'.lang('db')];?>"
        <? } ?>    
        data[<?= $m ?>]="<?= $orders[$m]['tripCost'] ?>";        
      <? } ?>  


    var areaChartData = {
      labels: labels,
      datasets: [
        {
          label: "Payments($)",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);
         
});
</script>              
 -->        
              
              
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
                   <!-- <canvas id="pieChart" height="250"></canvas>  
                    <div id="chartLegend"></div>                -->
                     <div id="areaChart" height="450" ></div>
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