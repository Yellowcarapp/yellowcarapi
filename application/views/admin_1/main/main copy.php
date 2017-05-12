	<!--One_TWO-->
 	<div class="one_two_wrap fl_left">
    	<div class="widget">
        	<div class="widget_title"><span class="iconsweet">r</span><h5>Visitors</h5></div>
            <div class="widget_body">
            	<!--Projects Graph--> 
                <div id="chart_linear" class="no_overflow">
                
                  	        
                            
                </div>
            </div>
        </div>
    </div>
	<!--One_TWO-->
 	<div class="one_two_wrap fl_right">
    	<div class="widget">
        	<div class="widget_title"><span class="iconsweet">t</span><h5>Statistics</h5></div>
            <div class="widget_body">
            	<!--Stastics-->
            	<ul class="dw_summary">
                            
                             
                         <?php $projectsCatsArr=$this->template->ProjectStatistics(); ?>
                          
                          <?php foreach($projectsCatsArr as  $projectsCatsArrArr) { ?>
                            
                             <li>
                             <?php $pcount=$this->template->GetCount('projects',$projectsCatsArrArr['id']);?>
                                <span class="percentage_done"><?=$pcount;?></span> <?=$projectsCatsArrArr['title_ar'];?>  
                                <div class="progress_wrap"><div title="<?=$pcount;?>%" class="tip_north progress_bar" style="width:<?=$pcount;?>%"></div></div>
                            </li>
                            
                          <?php } ?>    
                             
                           <li>
                            <?php $pcount=$this->template->GetCount('pages');?>
                                <span class="percentage_done"><?=$pcount;?></span> Pages  
                                <div class="progress_wrap"><div title="<?=$pcount;?>%" class="tip_north progress_bar" style="width:<?=$pcount;?>%"></div></div>
                            </li>
                            
                             <li>
                            <?php $pcount=$this->template->GetCount('news');?>
                                <span class="percentage_done"><?=$pcount;?></span> News & Events  
                                <div class="progress_wrap"><div title="<?=$pcount;?>%" class="tip_north progress_bar" style="width:<?=$pcount;?>%"></div></div>
                            </li>
                             
                           <li>
                            <?php $pcount=$this->template->GetCount('media');?>
                                <span class="percentage_done"><?=$pcount;?></span> media files
                                <div class="progress_wrap"><div title="<?=$pcount;?>%" class="tip_north progress_bar" style="width:<?=$pcount;?>%"></div></div>
                            </li>
                             
                            
                           <!-- <li>
                                 <span class="percentage_done">980</span> Students  <div class="progress_wrap"><div title="0%" class="tip_north progress_bar" style="width:100%"></div></div>
                            </li>-->                                                       
                 </ul>
            </div>
        </div>
    </div>   
    
    <div class="one_wrap">
    	<div class="widget">
        	<div class="widget_title"><span class="iconsweet">f</span><h5>Latest Adds</h5></div>
            <div class="widget_body">
            	<!--Activity Table-->
            	<table class="activity_datatable" width="100%" border="0" cellspacing="0" cellpadding="8">
                    <tr>
                        <th width="8%">Section</th>
                      
                        <th width="47%">Name</th>
                        <th width="12%">Status</th>
                        <th width="13%">Actions</th>
                    </tr>
                     
                     
                     
                     <?php $this->template->latestAdd(); ?>   
                   
                                
                </table>

            </div>
        </div>
    </div> 
     
 	<script type="text/javascript">

	/*LINE CHART*/
	
	var chart;
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart_linear',
				defaultSeriesType: 'line',
				marginLeft: 35,
				marginRight: 15,
				marginTop: 40,
				marginBottom: 40,
				height:300
			},
		title: {
				text: 'KCMS Visitor Per/Month',
				x: 20 //center
			},
	/*			subtitle: {
				text: 'Subtitle Text here',
				x: -20
			},
	*/		xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
					'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
	
			tooltip: {
				formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
						this.x +': '+ this.y ;
				}
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom',
				x: -10,
				y: 100,
				borderWidth: 0,
			},
			series: [{
				name: 'Visit',
				data: [ 
				<?php for($i=1;$i<date('m')+1;$i++) { ?>
				<?=$this->template->visitor_month_year($i);?>
				<?php if($i<date('m')) echo ","; ?>
			   <?php } ?>			
					]
			}, ]
	});

</script>   