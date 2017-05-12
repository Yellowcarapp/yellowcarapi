      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('TReports')?>
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
<form role="form" action="<?= site_url('admin/Reports/printPdfReport') ?>" method="post" name="formID" class="formID" id="formID">
                     
                          <!-- Date range -->
       <center class="form-group two_radio">
                        
                        <label>
                         <?=lang('total')?>
                          <input type="radio" name="rep_type" id="rep_type" value="1" class="minimal" onclick="totDetailFn(this.value)" />
                        </label>
                        <label>
                           <?=lang('Detail')?>
                          <input type="radio" name="rep_type" id="rep_type" value="2" class="minimal" checked onclick="totDetailFn(this.value)" />
                        </label>
                      </center>                            
                      <div id="accordion">
                           <h1><?=lang('Filters')?></h1>
                           <div>
                          <div class="form-group col-md-4">
                            <label><?=lang('Date_Range')?></label>
                            <div class="input-group ">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input  type="text" class="form-control pull-right" id="offerRange" name="offerRange" value="" />
                            </div><!-- /.input group -->
                          </div><!-- /.form group -->
               
            <div class="form-group col-md-4">
                          <label><?=lang('Country')?>:</label>
                

                     
                <input type="text" class="form-control"  name="country" id="country"  />
                        </div>
                    <div class="form-group col-md-4">
                          <label><?=lang('City')?>:</label>
                      <span id="city_Load">
                                        <input class="form-control" type="text"  name="cityId" id="cityId"  /></span>

                        </div>
                         <div class="form-group col-md-4">
                          <label><?=lang('Levels')?>:</label>
                             <input class="form-control" type="text"  name="level" id="level"  />
                     
                        </div>
                        <div class="form-group col-md-4">
                          <label><?=lang('Network')?>:</label>
                              <input class="form-control" type="text"  name="network" id="network"  />
                        <!--  <select class="form-control" name="network" id="network" onchange="$('#driversDiv').load('<?=site_url('admin/reports/reloadDrivers')?>',{id:this.value})" >
                            <option value="-1" selected="selected"><?=lang('All')?></option>
                              <? for($i=0;$i<count($network);$i++){?> 
                            <option value="<?=$network[$i]['network_id']?>"><?=$network[$i]['network_name']?></option>
                              <? }?>
                           
                          </select>-->
                        </div>
                         <div class="form-group col-md-4">
                          <label><?=lang('Drivers')?>:</label>
                             <span  id="driversDiv">
                             <input class="form-control" type="text"  name="driver" id="driver"  />
                             </span>
                       <!--   <select class="form-control" name="driver" id="driver" >
                            <option value="-1" selected="selected"><?=lang('All')?></option>
                              <? for($i=0;$i<count($drivers);$i++){?> 
                            <option value="<?=$drivers[$i]['driverId']?>"><?=$drivers[$i]['driverFName'].' '.$drivers[$i]['driverLName']?></option>
                              <? }?>
                           
                          </select>-->
                        </div>
                     
                      
                      
                      <div class="form-group  col-md-4">
                            <label><?=lang('Trip_Type')?>:</label>
                           <input class="form-control" type="text"  name="trip_type" id="trip_type"  />
                          <!--  <select  class="form-control" name="trip_type" id="trip_type" >
                                 <option value="-1" selected="selected"><?=lang('All')?></option>
                              <? for($i=0;$i<count($tripType);$i++){?> 
                            <option value="<?=$tripType[$i]['typeId']?>"><?=$tripType[$i]['typeName_'.lang('db')]?></option>
                              <? }?>                                                                             
                            </select>-->
                      </div>                            
                                            
                    <div class="form-group  col-md-4">
                            <label><?=lang('Passengers')?>:</label>
                         <input class="form-control" type="text"  name="passenger" id="passenger"  />
                           <!-- <select  class="form-control" name="passenger" id="passenger" >
                                 <option value="-1" selected="selected"><?=lang('All')?></option>
                              <? for($i=0;$i<count($passenger);$i++){?> 
                            <option value="<?=$passenger[$i]['passengerId']?>"><?=$passenger[$i]['passengerName']?></option>
                              <? }?>                                                                             
                            </select>-->
                      </div>                            

    
    <div class="form-group col-md-4">
                     <label ><?=lang('Trip_Timing')?></label>  

       
                        <div class="checkbox two_check">
                        <div class="col-sm-6">
                            <label>
                               <input type="checkbox" name="tripNowa[]" id="tripNowa1" value="1" checked  /> <?=lang('Now')?>
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <label>
                                <input type="checkbox" name="tripNowa[]" id="tripNowa0" value="0"  checked  /> <?=lang('later')?>
                                <input type="hidden" name="tripNow" id="tripNow" value="0,1">    
                            </label> 
                        </div>
                      
                            
                      </div>
                      
                      
                   
                    </div> 
     <div class="form-group col-md-4" style="height:50px;"> 
                     <label style="width:100%; "><?=lang('promo')?></label>  
   <select  class="form-control pay_method" name="paymethod" id="paymethod" style="width:65%; float:left;" >
                                 <option value="-1" selected="selected"><?=lang('All')?></option>
                              
                            <option value="visa"><?=lang('visa')?></option>
                                <option value="cash"><?=lang('cash')?></option>                                                                      
                            </select>
       
                        <div class="checkbox choose" style="float:left; width:30%;
                        padding-left:10px;">
                            <label>
                            <input type="checkbox" name="trippromo" id="trippromo" value="1"   /> <?=lang('yes')?>
                            </label>
                      </div>
                       </div> 
                   <div class="form-group  col-md-4">
                            <label><?=lang('Status')?>:</label>
                            <select  class="form-control" name="sts" id="sts" onchange="if(this.value==7)$('#reason').removeAttr('disabled'); else $('#reason').attr('disabled','disabled');" >
                                 <option value="-1" selected="selected"><?=lang('All')?></option>
                                 <option value="1"><?=lang('sts1')?></option>
                                <option value="2"><?=lang('sts2')?></option>
                                <option value="3"><?=lang('sts3')?></option>
                                <option value="4"><?=lang('sts4')?></option>
                                <option value="5"><?=lang('sts5')?></option>
                                <option value="6"><?=lang('sts6')?></option>
                                <option value="7"><?=lang('sts7')?></option>
                               
                            </select>
                      </div>          
                     <div class="form-group  col-md-4">
                            <label><?=lang('Reason')?>:</label>
                            <select  class="form-control" name="reason" id="reason" disabled >
                                 <option value="-1" selected="selected"><?=lang('All')?></option>
                                  <? for($i=0;$i<count($reason);$i++){?> 
                            <option value="<?=$reason[$i]['reasonId']?>"><?=$reason[$i]['reasonName'].' -- ('.$reason[$i]['reasonTag'].')'?></option>
                              <? }?>                             
                               
                            </select>
                      </div>          
                    <div class="form-group  col-md-6">
                            <label><?=lang('Cost')?>:</label>
                            <label><?=lang('From')?>:</label>
                        <input type="number" name="cost_from" class="form-control" id="cost_from" value="0" />
    </div>   
                               <div class="form-group  col-md-6">
                         <label><?=lang('To')?>:</label>
                        <input type="number" name="cost_to" class="form-control" id="cost_to" value="0" />
                      </div>          
                   <div class="form-group  col-md-6">
                            <label><?=lang('Distance')?>:</label>
                            <label><?=lang('From')?>:</label>
                        <input type="number" name="dist_from" class="form-control" id="dist_from" value="0">
                        </div> 
                               <div class="form-group  col-md-6">
                         <label><?=lang('To')?>:</label>
                        <input type="number" name="dist_to" class="form-control" id="dist_to" value="0">
                      </div>  
                   
                   
                          </div>
                          <!--------- Grouping ---------->
                           <h1 id="GroupingColsH" ><?=lang('Grouping')?></h1>
                           <div id="GroupingCols" >
                               
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
                           
<input type="radio" name="grCol" id="CountryrGrp" value="1"    checked /> <?=lang('Country')?>
                             
                        </label>
                      </div>
                       </div> 
                               
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="CityGrp" value="2"     /> <?=lang('City')?>
                             
                        </label>
                      </div>
                       </div> 
                               
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="DriversGrp" value="3"     /> <?=lang('Drivers')?>
                             
                        </label>
                      </div>
                       </div> 
                               
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="NetworkGrp" value="4"    /> <?=lang('Network')?>
                             
                        </label>
                      </div>
                       </div> 
                                 <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="PassengersGrp" value="5"    /> <?=lang('Passengers')?>
                             
                        </label>
                      </div>
                       </div> 
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="DateGrp" value="6"    /> <?=lang('Date')?>
                             
                        </label>
                      </div>
                       </div> 
                               <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="tripTypeGrp" value="7"    /> <?=lang('Trip_Type')?>
                             
                        </label>
                      </div>
                       </div> 
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="grCol" id="stsGrp" value="8"    /> <?=lang('Status')?>
                             
                        </label>
                      </div>
                       </div> 
                          
                          </div>
                          <!--------- Columns ---------->
                             <h1 id="RepColsH" ><?=lang('Columns')?></h1>
                           <div id="RepCols" >
                                <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="checkbox" name="passengerCol" id="passengerCol" value="1"  onclick="return false;"  checked /> <?=lang('Passengers')?>
                             
                        </label>
                      </div>
                       </div> 
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="checkbox" name="driverCol" id="driverCol" value="1"  checked /> <?=lang('Drivers')?>
                             
                        </label>
                      </div>
                       </div> 
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="checkbox" name="Total_PriceCol" id="Total_PriceCol" value="1" checked   /> <?=lang('Total_Price')?>
                             
                        </label>
                      </div>
                       </div> 
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="checkbox" name="DateCol" id="DateCol" value="1"  checked /> <?=lang('Date')?>
                             
                        </label>
                      </div>
                       </div> 
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="checkbox" name="StatusCol" id="StatusCol" value="1"  checked /> <?=lang('Status')?>
                             
                        </label>
                      </div>
                       </div> 
                               
                               
                                  <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="checkbox" name="DistancesCol" id="DistancesCol" value="1"  checked /> <?=lang('Distance')?>
                             
                        </label>
                      </div>
                       </div> 
                                  
                                  
                          </div>
                          <!--------- Exporting ---------->
                           <h1 ><?=lang('export')?></h1>
                          <div>
                             <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="exportType" id="exportHTML" value="0"    checked /> HTML
                             
                        </label>
                      </div>
                       </div> 
                                 <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="exportType" id="exportPDF" value="1"     /> PDF
                             
                        </label>
                      </div>
                       </div> 
                                 <div class="form-group col-md-2">
                    

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="exportType" id="exportChart" value="2" disabled     /> <?=lang('chart')?>
                             
                        </label>
                      </div>
                       </div> 
                          
                          </div>
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
            
            $('#country').tokenInput("<?=site_url('admin/reports/getCountry')?>", {
               hintText:'<?=lang('Country')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
               , onAdd: function (item) {
                   reloadCity($('#country').val())
               /* $('#cityId').tokenInput("<?=site_url('admin/reports/getCity')?>/"+$('#country').val(), {
               hintText:'<?=lang('City')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });*/
                },
                onDelete: function (item) {
                     reloadCity($('#country').val())
            /*     $('#cityId').tokenInput("<?=site_url('admin/reports/getCity')?>/"+$('#country').val(), {
               hintText:'<?=lang('City')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });*/
                }
              });
      //***************************************************//
        $('#cityId').tokenInput("<?=site_url('admin/reports/getCity')?>", {
               hintText:'<?=lang('City')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });
  
    //***************************************************************//
     $('#level').tokenInput("<?=site_url('admin/reports/getLevel')?>", {
               hintText:'<?=lang('level')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });
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
      //*********************************************************//
       $('#trip_type').tokenInput("<?=site_url('admin/reports/getTripType')?>", {
               hintText:'<?=lang('Trip_Type')?>'
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
	$(function() {
    
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  });
    //**********************************************************//
    function reloadDriver(val)
    {
        $('#driversDiv').load('<?=site_url('admin/reports/driver_reload')?>',{network:val})
    }
    //****************************************************//
     function reloadCity(val)
    {
        $('#city_Load').load('<?=site_url('admin/reports/citry_reload')?>',{country:val})
    }
    //******************************************************//
    totDetailFn=function(val)
    {
        console.log(val);
        if(val==1)//Total
            {
             $('#RepColsH').css('display','none'); 
                 $('#RepCols').css('display','none');
                $('#GroupingColsH').removeAttr('disabled');
                $('#exportChart').removeAttr('disabled');
                
            }else{//detai
                $('#GroupingColsH').attr('disabled',true);  
                 $('#RepColsH').css('display','block'); 
                 $('#RepCols').css('display','block');
                $('#exportChart').attr('disabled',true);
                $('input[name="exportType"][value="0"]').prop('checked', true);
            }
    }
    
    //**************************************//
    extractReport=function()
    {//$('#rep_type').val()$('#tripNow').val()$('#trippromo').val()
         var tripNowStr ='';
          /*  $.each($("input[name='tripNow']:checked"), function(){            
             //   tripNow.push($(this).val());
                if(tripNowStr!='')tripNowStr+=',';
                tripNowStr+=$(this).val();
            });*/
        if ($('input#tripNowa1').is(':checked')) {
            tripNowStr+=1;
        }
         if ($('input#tripNowa0').is(':checked')) {
             if(tripNowStr!='')tripNowStr+=',';
            tripNowStr+=0;
        }
        if(tripNowStr=='')tripNowStr='0,1';
        console.log(tripNowStr);
        $('#tripNow').val(tripNowStr)
        var exportType= $("input[name=exportType]:checked").val();
        if(exportType==0)
            {
                var url='<?= site_url('admin/reports/printReport') ?>';
                var div='reportDiv';
            }else if(exportType==1)
                {
                    var url='<?= site_url('admin/reports/printPdfReport') ?>';
                    var div=''; 
                }
        else if(exportType==2)
                {
                    var url='<?= site_url('admin/reports/printChartReport') ?>';
                   
                    var div='reportDiv';
                }
        var data={'rep_type':$("input[name=rep_type]:checked").val()
                                                                             ,'exportType':$("input[name=exportType]:checked").val()
                                                                             ,'offerRange':$('#offerRange').val()
                                                                             ,'country':$('#country').val()
                                                                             ,'cityId':$('#cityId').val()
                                                                             ,'level':$('#level').val()
                                                                             ,'network':$('#network').val()
                                                                             ,'driver':$('#driver').val()
                                                                             ,'trip_type':$('#trip_type').val()
                                                                             ,'passenger':$('#passenger').val()
                                                                             ,'tripNow':tripNowStr
                                                                             ,'paymethod':$('#paymethod').val()
                                                                             ,'trippromo':$("input[name=trippromo]:checked").val()
                                                                             ,'sts':$('#sts').val()
                                                                             ,'reason':$('#reason').val()
                                                                             ,'cost_from':$('#cost_from').val()
                                                                             ,'cost_to':$('#cost_to').val()
                                                                             ,'dist_from':$('#dist_from').val()
                                                                             ,'dist_to':$('#dist_to').val()
                                                                       
                                                                            ,'grCol':$("input[name=grCol]:checked").val()
                                                                             ,'passengerCol':$("input[name=passengerCol]:checked").val()
                                                                             ,'driverCol':$("input[name=driverCol]:checked").val()
                                                                             ,'Total_PriceCol':$("input[name=Total_PriceCol]:checked").val()
                                                                             ,'DateCol':$("input[name=DateCol]:checked").val()
                                                                             ,'StatusCol':$("input[name=StatusCol]:checked").val()
                                                                             ,'DistancesCol':$("input[name=DistancesCol]:checked").val()
                                                            }
        if(div!=''){
        $('#'+div).load(url,data);
            }else{
                $( "#formID" ).submit();
           
            }
    }
		</script>
   
   
   
   
   
   
   
    <!-- Main content -->
    <!--<script src="<?=base_url()?>files/js/uploader/SimpleAjaxUploader.js"></script>-->

<script type="text/javascript" >
  /*  $().ready(function(){
        
        $( "#formIDx" ).submit(function( event ) {
            event.preventDefault();
          //  if($('#socialEditForm')[0].checkValidity())
            //{
                //CKupdate();
            alert($('#rep_type').val());
            console.log($('#rep_type').val());
                $.post('<?= site_url('admin/reports/printReport') ?>', $( "#formID" ).serialize() ).done(function(data) {
           //         alert( "تم الحفظ بنجاح" );
                    $('#HiddenDiv').html(data);
                });
             //} 
        });
    });*/

	$().ready(function(){
       
        //Date range picker
        $('#offerRange').daterangepicker({locale:{fromLabel:"From",toLabel:"To",applyLabel:"Ok",cancelLabel:"Cancel"},format:"YYYY-MM-DD",separator:" to "});
    });
</script>




                