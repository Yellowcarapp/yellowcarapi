<style>
	.chart{width:100% !important;margin:0px auto;}
	.chart div.highcharts-container{width:100% !important;}
	.chart div.highcharts-container svg{width:100% !important;}
	/*.chart div.highcharts-container svg rect{width:100% !important;}*/
	.chart div.highcharts-container svg text{display:none !important;}
	.chart div.highcharts-container svg g text{display:block !important;}
	  .none {display:none;}

 @media print{
  body{ background-color:#FFFFFF; background-image:none; color:#000000 }
  #ad{ display:none;}
  #leftbar{ display:none;}
  #contentarea{ width:100%;}
}
</style>
<? if($repType==1){
    $title='Top 10 Request Chart'; $subTitle='Sum of request(s)'; $xTitle='Request';$yTitle='Num';
}else if($repType==2){
    $title=' Request per hour'; $subTitle='Sum of request(s)/hour';$xTitle='Request';$yTitle='Num';
}else if($repType==3 && $mode==0 ){
    $title='Avearge Distance Chart'; $subTitle='Avg of distance(s)';$xTitle='Distance';$yTitle='Num';
}else if($repType==3 && $mode==1 ){
    $title='Avearge Cost Chart'; $subTitle='Avg of Cost(s)';$xTitle='Request';$yTitle='Avg';
}else if($repType==4 ){
    $title='Request per driver'; $subTitle='Sum of request(s)/driver';$xTitle='Request';$yTitle='Num';
}?>
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$title?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <!--<canvas id="areaChart2" height="250"></canvas>-->
                      <div id="areaChart2" height="450" ></div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
 <script>
     var chart;
 $(function () { 
      // var labels = Array();
     
            
      
      
 var labels = Array();
             
      <?    for($m=0;$m<count($orders);$m++){ if($repType==1){
  
       if($tenRequest==1){?>
            labels[<?= $m ?>]="<?= $orders[$m]['passengerName']?>"
         <? }else if ($tenRequest==2){?>
             labels[<?= $m ?>]="<?= $orders[$m]['network_name']?>"
             
            <? }else if ($tenRequest==3){?>
             labels[<?= $m ?>]="<?= $orders[$m]['driverFName'].' '.$orders[$m]['driverLName'].'( '.$orders[$m]['driverMobile'].')'?>"
             <? }?>
             <? }else if($repType==2){  ?>
            labels[<?= $m ?>]="<?= $orders[$m]['Timing']?>"
             <? }else if($repType==3){  ?>
      labels[<?= $m ?>]="<?= $orders[$m]['Range']?>"
      <? }  ?>
        
      
       
      

<? }?>
       
    


chart = new Highcharts.Chart({
  
        chart: {
            type: 'column',
            'renderTo':'areaChart2'
        },
    title: {
            text: '<?=$title?>'
        },
        subtitle: {
            text: '<?=$subTitle?>'
        },
        xAxis: {
            type: '<?=$xTitle?>',
            categories:labels
        },
        yAxis: {
            title: {
                text: '<?=$yTitle?>'
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
            name: '<?=$xTitle?>',
            colorByPoint: true,
            data: [<?    for($m=0;$m<count($orders);$m++){ if($repType==1){
  
       if($tenRequest==1){?>
       {name:"<?= $orders[$m]['passengerName']?>",y:<?= $orders[$m]['Ids'] ?>} 
         <? }else if ($tenRequest==2){?>
             {name:"<?= $orders[$m]['network_name']?>",y:<?= $orders[$m]['Ids'] ?>} 
             
            <? }else if ($tenRequest==3){?>
             {name:"<?= $orders[$m]['driverFName'].' '.$orders[$m]['driverLName']?>",y:<?= $orders[$m]['Ids'] ?>}
             <? }?>
             <? }else if($repType==2){  ?>
             {name:"<?= $orders[$m]['Timing']?>",y:<?= $orders[$m]['Ids'] ?>} 
             <? }else if($repType==3){  ?>
    {name:"<?= $orders[$m]['Range']?>",y:<?= $orders[$m]['Ids'] ?>} 
                 <? }  ?>
               <? if($m<count($orders)){?>,<? }?>
      <? }  ?>
                
                ]
         }]
    });
});
</script>              
              
        
