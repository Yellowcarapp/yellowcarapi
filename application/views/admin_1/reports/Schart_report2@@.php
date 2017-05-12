<? if($repType==1){
    $title='Top 10 Request Chart'; $subTitle='Sum of request(s)';
}else if($repType==2){
    $title=' Request per hour'; $subTitle='Sum of request(s)/hour';
}else if($repType==3 && $mode==0 ){
    $title='Avearge Distance Chart'; $subTitle='Avg of distance(s)';
}else if($repType==3 && $mode==1 ){
    $title='Avearge Cost Chart'; $subTitle='Avg of Cost(s)';
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
                    <canvas id="areaChart2" height="250"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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
    var areaChartCanvas = $("#areaChart2").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);
        var labels = Array();
        var data = Array();        
      <?    for($m=0;$m<count($orders);$m++){ if($repType==1){
  
       if($tenRequest==1){?>
            labels[<?= $m ?>]="<?= $orders[$m]['passengerName']?>"
         <? }else if ($tenRequest==2){?>
             labels[<?= $m ?>]="<?= $orders[$m]['network_name']?>"
             
            <? }else if ($tenRequest==3){?>
             labels[<?= $m ?>]="<?= $orders[$m]['driverFName'].' '.$orders[$m]['driverLName']?>"
             <? }?>
             <? }else if($repType==2){  ?>
            labels[<?= $m ?>]="<?= $orders[$m]['Timing']?>"
             <? }else if($repType==3){  ?>
      labels[<?= $m ?>]="<?= $orders[$m]['Range']?>"
      <? }  ?>
        data[<?= $m ?>]="<?= $orders[$m]['Ids'] ?>"; 
      
       
      

<? }?>


    var areaChartData = {
      labels: labels,
      datasets: [
        {
          label: "<?=$subTitle?>",
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
      scaleShowGridLines: true,
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
    areaChart.Bar(areaChartData, areaChartOptions);
         
});
</script>              
              
              
        
