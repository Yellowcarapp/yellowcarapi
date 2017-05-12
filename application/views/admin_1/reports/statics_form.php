      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('SReports')?>
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
<form role="form" action="<?= site_url('admin/Reports/printSPdfReport') ?>" method="post" name="formID" class="formID" id="formID">
                     
                          <!-- Date range -->
      <div class="form-group col-md-12">
                            <label><?=lang('Date_Range')?></label>
                            <div class="input-group ">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input  type="text" class="form-control pull-right" id="offerRange" name="offerRange" value="" />
                            </div><!-- /.input group -->
                          </div><!-- /.form group -->
               
       <center class="form-group two_radio">
                        
                        <label>
                         <?=lang('TenRequest')?>
                          <input type="radio" name="rep_type" id="rep_type" value="1" class="minimal" checked onclick="totDetailFn(this.value)" />
                        </label>
                        <label>
                           <?=lang('DemandAvg')?>
                          <input type="radio" name="rep_type" id="rep_type" value="2" class="minimal"  onclick="totDetailFn(this.value)" />
                        </label>
            <label>
                         <?=lang('distanceAvg')?>
                          <input type="radio" name="rep_type" id="rep_type" value="3" class="minimal" onclick="totDetailFn(this.value)" />
                        </label>
            <!--<label>
                         <?=lang('DriverRequest')?>
                          <input type="radio" name="rep_type" id="rep_type" value="4" class="minimal" onclick="totDetailFn(this.value)" />
                        </label>-->
                      </center>                            
                      
                          <div class="form-group  col-md-4" id="passenger_Div">
                            <label><?=lang('Passengers')?></label>
                               <input type="radio" name="tenRequest" id="tenRequest" value="1" class="minimal" checked  />
                        <!-- <input class="form-control" type="text"  name="passenger" id="passenger"  />-->
                         
                      </div>    
             <div class="form-group col-md-4" id="network_Div">
                          <label><?=lang('Network')?></label>
                             <!-- <input class="form-control" type="text"  name="network" id="network"  />-->
                 <input type="radio" name="tenRequest" id="tenRequest" value="2" class="minimal"  />
                       
                        </div>
                         <div class="form-group col-md-4" id="Driver_Div">
                          <label><?=lang('Drivers')?></label>
                             <span  id="driversDiv">
                            <!-- <input class="form-control" type="text"  name="driver" id="driver"  />-->
                                  <input type="radio" name="tenRequest" id="tenRequest" value="3" class="minimal"  />
                             </span>
                     
                        </div>
                        
                      
                      
                   
                    
                   
                          
                        
                       
   
                        
        
                    
                      
                      
                  <div class="box-footer center">
                    <button type="button" class="btn btn-flat btn-primary" onclick="extractReport()" id="SubmitProductBTN"><?=lang('export')?></button>
                  </div>
                  </form>
                    <div id="reportDiv"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
   
  
   
<script>
  $().ready(function(){
          //*************************************************//
          
   
      //************************************************************//
         $('#network').tokenInput("<?=site_url('admin/reports/getnetwork')?>", {
               hintText:'<?=lang('Network')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
               , onAdd: function (item) {
                   reloadDriver($('#network').val())
            
                },
                onDelete: function (item) {
                     reloadDriver($('#network').val())
           
                }
              });
      //**************************************************************//
       $('#driver').tokenInput("<?=site_url('admin/reports/getDriver')?>", {
               hintText:'<?=lang('Drivers')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });
     
      //***************************************************************************//
        $('#passenger').tokenInput("<?=site_url('admin/reports/getpassenger')?>", {
               hintText:'<?=lang('Passengers')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });
      //#####################################################################//
  });
    //******************###############################***************************//
	
    //**********************************************************//
    function reloadDriver(val)
    {
        $('#driversDiv').load('<?=site_url('admin/reports/driver_reload')?>',{network:val})
    }
    //****************************************************//
  
    //******************************************************//
    totDetailFn=function(val)
    {
        console.log(val);
        if(val==1)//Total
            { $('#filterHeader').css('display','block');
                $('#filterDiv').css('display','block');
             $('#passenger_Div').css('display','block'); 
                 $('#network_Div').css('display','block');
                $('#Driver_Div').css('display','block');
                
            }else  if(val==4){//detai
                $('#filterHeader').css('display','block');
                $('#filterDiv').css('display','block');
              $('#passenger_Div').css('display','none'); 
                 $('#network_Div').css('display','none');
                $('#Driver_Div').css('display','block');
               
            }else {
                $('#filterHeader').css('display','none');
                $('#filterDiv').css('display','none');
                  $('#passenger_Div').css('display','none'); 
                 $('#network_Div').css('display','none');
                $('#Driver_Div').css('display','none');
            }
    }
    
    //**************************************//
    extractReport=function()
    {
        
                    var url='<?= site_url('admin/reports/printSChartReport') ?>';
                   
                    var div='reportDiv';
               
        var data={
                    'rep_type':$("input[name=rep_type]:checked").val()                                                         ,'offerRange':$('#offerRange').val()
            ,'tenRequest':$("input[name=tenRequest]:checked").val()  
          }
       
        $('#'+div).load(url,data);
           
    }
		</script>
   
   
   
   
   
   
   
    <!-- Main content -->
    <!--<script src="<?=base_url()?>files/js/uploader/SimpleAjaxUploader.js"></script>-->

<script type="text/javascript" >
 
	$().ready(function(){
       
        //Date range picker
        $('#offerRange').daterangepicker({locale:{fromLabel:"From",toLabel:"To",applyLabel:"Ok",cancelLabel:"Cancel"},format:"YYYY-MM-DD",separator:" to "});
    });
</script>




                