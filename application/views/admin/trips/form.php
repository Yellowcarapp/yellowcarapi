  

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('pricing')?>
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
<form role="form" action="<?=site_url('Trips/SavePricing')?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['priceId'])) echo $page['priceId'] ?>" />                                  <?php if($this->session->flashdata('pricingExist')==1) { ?>	 
 <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-ban"></i> Message!</h4>
                    Error Data Already exist.
                  </div>    
<?php  } ?> 
  
     <div class="form-group">
                      <label><?=lang('Packages')?> : </label>
         <? if(isset($page['packageId'])){?> 
                       <input type="hidden" name="packageId" id="packageId" value="<?php if(isset($page['packageId'])) echo $page['packageId'];?>">
         <span> <?php for($z=0;$z<count($package);$z++){ 
    if(isset($page['packageId'])&&$page['packageId']== $package[$z]['packageId'] )
            echo  $package[$z]['packageName_'.lang('db')];
                                                        }?></span>
         <? }else {?>
                      <select  class="width_size form-control validate[required]" name="packageId" id="packageId" <? if(isset($page['priceId']) && $page['priceId']!=''){?> readOnly<?}?> > 
                              <?php for($z=0;$z<count($package);$z++){ ?>
                                    <option value="<?= $package[$z]['packageId'] ?>" <?php if(isset($page['packageId'])&&$page['packageId']== $package[$z]['packageId'] ) {  ?> selected="selected" <?php } ?> ><?= $package[$z]['packageName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                    <? }?>    
                       
                    </div> 



   
                   
                      
               
                    <div class="form-group">
                      <label><?=lang('Country')?> : </label>
                           <? if(isset($page['packageId'])){?> 
                             <input type="hidden" name="countryId" id="countryId" value="<?php if(isset($page['countryId'])) echo $page['countryId'];?>">
         <span> <?php for($z=0;$z<count($countries);$z++){ 
    if(isset($page['countryId'])&&$page['countryId']== $countries[$z]['countryId'] )
            echo  $countries[$z]['countryName_'.lang('db')];
                                                        }?></span>
         <? }else {?>
                      <select class="width_size form-control validate[required]" name="countryId"   id="countryId" onchange="$('#city_Load').load( '<?= base_url('generalsetting/get_cities/') ?>/'+$(this).val());"  <? if(isset($page['priceId']) && $page['priceId']!=''){?> readOnly<?}?> > 
                         <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'] ?>" <?php if(isset($page['countryId'])&&$page['countryId']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                        <? }?>
                    </div>
               
            <div class="form-group">
                      <label><?=lang('City')?> : </label>
                <? if(isset($page['packageId'])){?> 
                             <input type="hidden" name="cityId" id="cityId" value="<?php if(isset($page['cityId'])) echo $page['cityId'];?>">
         <span> <?php for($z=0;$z<count($cities);$z++){ 
    if(isset($page['cityId'])&&$page['cityId']== $cities[$z]['cityId'] )
            echo  $cities[$z]['cityName_'.lang('db')];
                                                        }?></span>
         <? }else {?>
                     <span id="city_Load">    
                      <select class="width_size form-control validate[required]" name="cityId" id="cityId" <? if(isset($page['priceId']) && $page['priceId']!=''){?> readOnly<?}?> > 
                              <?php for($z=0;$z<count($cities);$z++){ ?>
                                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['cityId'])&&$page['cityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        </span> 
                <? }?>
                    </div>
    <? //print_r($info);?>
    <? /*if(!isset($page['priceId'])){*/?>
    <div id="accordion">
            <!-- <div class="form-group">
                      <label>Trip Type</label>
                       
                      <select class="width_size form-control validate[required]" name="typeId" id="typeId" > 
                              <?php for($z=0;$z<count($tripTypes);$z++){ ?>
                                    <option value="<?= $tripTypes[$z]['typeId'] ?>" <?php if(isset($page['typeId'])&&$page['typeId']== $tripTypes[$z]['typeId'] ) {  ?> selected="selected" <?php } ?> ><?= $tripTypes[$z]['typeName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                       
                    </div>--> 
                      
     <?php for($i=0;$i<count($tripTypes);$i++){ ?>
        <h1><?= $tripTypes[$i]['typeName_'.lang('db')] ?><input type="hidden" name="typeId[]" id="typeId" value="<?= $tripTypes[$i]['typeId'] ?>"> </h1>
        <div>
            <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body no-padding">
                
              <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th width="10%"><?=lang('level')?></th>
                  <th><?=lang('Now_Start')?></th>
                  <th><?=lang('Min_charge_for_now')?></th>
                    <th><?=lang('Later_Start')?></th>
                  <th><?=lang('Min_charge_for_late')?></th>
                  <th><?=lang('cost_km')?></th>
                     <th><?=lang('cost_minute')?></th>
                    <th><?=lang('Waiting_cost_hour')?></th>
                    <th><?=lang('driver_cost')?></th>
                </tr>
               <?php $n=0;for($z=0;$z<count($levels);$z++){$n+=1;
                    
                    if(!isset($page['priceId'])){
                        $now_start='';
                        $min_start='';
                        $late_start='';
                        $min_late_start='';
                        $perKm='';
                        $perMinute='';
                        $WaitingperHour='';
                         $driverCost='';
                    }else{
                        $s=0;
                        
                        for($a=0;$a<count($info);$a++){
                          
                            if($info[$a]['typeId']==$tripTypes[$i]['typeId'] && $info[$a]['levelId']==$levels[$z]['levelId'] && $s==0){
                                $now_start=$info[$a]['nowStart'];
                                $min_start=$info[$a]['minNow'];
                                $late_start=$info[$a]['laterStart'];
                                $min_late_start=$info[$a]['minLater'];
                                $perKm=$info[$a]['perKm'];
                                $perMinute=$info[$a]['perMinute'];
                                $WaitingperHour=$info[$a]['WaitingperHour']; 
                                $driverCost=$info[$a]['driverCost']; 
                                $s=1;
                            }else if($s==0){
                                 $now_start='';
                        $min_start='';
                        $late_start='';
                        $min_late_start='';
                        $perKm='';
                        $perMinute='';
                        $WaitingperHour='';
                                 $driverCost='';
                            }
                        }
                    }
                    
                    
                    
                    ?>
                <tr>
                    
                  <td><?=$n?></td>
                  <td><?= $levels[$z]['levelName_'.lang('db')] ?><input type="hidden" name="levelId_<?=$i?>[]" id="levelId" value="<?= $levels[$z]['levelId']?>"></td>
                  <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="nowStart_<?=$i?>[]" id="nowStart" value="<?=$now_start?>" /></td>
                  <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="minNow_<?=$i?>[]" id="minNow" value="<?=$min_start?>" /></td>
                    <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="laterStart_<?=$i?>[]" id="laterStart" value="<?=$late_start?>" /></td>
                  <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="minLater_<?=$i?>[]" id="minLater" value="<?=$min_late_start?>" /></td>
                    <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="perKm_<?=$i?>[]" id="perKm" value="<?=$perKm?>" /></td>
                  <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="perMinute_<?=$i?>[]" id="perMinute" value="<?=$perMinute?>" /></td>
                    <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="WaitingperHour_<?=$i?>[]" id="WaitingperHour" value="<?=$WaitingperHour?>" /></td>
                       <td><input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="driverCost_<?=$i?>[]" id="driverCost" value="<?=$driverCost?>" /></td>
                </tr>
                    <? }?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
     <!--  <div class="form-group">
                      <label>Level </label>
                     
                      <select class="width_size form-control validate[required]" name="levelId" id="levelId"  > 
                              <?php for($z=0;$z<count($levels);$z++){ ?>
                                    <option value="<?= $levels[$z]['levelId']?>" <?php if(isset($page['levelId'])&&$page['levelId']== $levels[$z]['levelId'] ) {  ?> selected="selected" <?php } ?> ><?= $levels[$z]['levelName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>

                                  <div class="form-group">
                     <label class="full_width">Now Start </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="nowStart" id="nowStart" value="<?php if(isset($page['nowStart'])) echo $page['nowStart']; ?>" />
                    </div>
    <div class="form-group">
                     <label class="full_width">Minimum Charge  for now </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="minNow" id="minNow" value="<?php if(isset($page['minNow'])) echo $page['minNow']; ?>" />
                    </div>
    
     <div class="form-group">
                     <label class="full_width">Later Start </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="laterStart" id="laterStart" value="<?php if(isset($page['laterStart'])) echo $page['laterStart']; ?>" />
                    </div>
         
                   
    
     <div class="form-group">
                     <label class="full_width">minimum charge later</label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="minLater" id="minLater" value="<?php if(isset($page['minLater'])) echo $page['minLater']; ?>" />
                    </div>
    
     <div class="form-group">
                     <label class="full_width">cost per km </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="perKm" id="perKm" value="<?php if(isset($page['perKm'])) echo $page['perKm']; ?>" />
                    </div>
    
     <div class="form-group">
                     <label class="full_width">cost per Minute </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="perMinute" id="perMinute" value="<?php if(isset($page['perMinute'])) echo $page['perMinute']; ?>" />
                    </div>
     <div class="form-group">
                     <label class="full_width">Waiting cost per hour </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="WaitingperHour" id="WaitingperHour" value="<?php if(isset($page['WaitingperHour'])) echo $page['WaitingperHour']; ?>" />
                    </div>-->
            </div>
    <? }?>
    </div>
    <? /*} else {*/?>
  <!--  <div class="form-group">
                      <label>Trip Type</label>
                       
                      <select class="width_size form-control validate[required]" name="typeId" id="typeId" disabled > 
                              <?php for($z=0;$z<count($tripTypes);$z++){ ?>
                                    <option value="<?= $tripTypes[$z]['typeId'] ?>" <?php if(isset($page['typeId'])&&$page['typeId']== $tripTypes[$z]['typeId'] ) {  ?> selected="selected" <?php } ?> ><?= $tripTypes[$z]['typeName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                       
                    </div>
    <div class="form-group">
                      <label>Level </label>
                     
                      <select class="width_size form-control validate[required]" name="levelId" id="levelId"  disabled> 
                              <?php for($z=0;$z<count($levels);$z++){ ?>
                                    <option value="<?= $levels[$z]['levelId']?>" <?php if(isset($page['levelId'])&&$page['levelId']== $levels[$z]['levelId'] ) {  ?> selected="selected" <?php } ?> ><?= $levels[$z]['levelName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
                <div class="form-group">
                     <label class="full_width">Now Start </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="nowStart" id="nowStart" value="<?php if(isset($page['nowStart'])) echo $page['nowStart']; ?>" />
                    </div>
    <div class="form-group">
                     <label class="full_width">Minimum Charge  for now </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="minNow" id="minNow" value="<?php if(isset($page['minNow'])) echo $page['minNow']; ?>" />
                    </div>
    
     <div class="form-group">
                     <label class="full_width">Later Start </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="laterStart" id="laterStart" value="<?php if(isset($page['laterStart'])) echo $page['laterStart']; ?>" />
                    </div>
         
                   
    
     <div class="form-group">
                     <label class="full_width">minimum charge later</label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="minLater" id="minLater" value="<?php if(isset($page['minLater'])) echo $page['minLater']; ?>" />
                    </div>
    
     <div class="form-group">
                     <label class="full_width">cost per km </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="perKm" id="perKm" value="<?php if(isset($page['perKm'])) echo $page['perKm']; ?>" />
                    </div>
    
     <div class="form-group">
                     <label class="full_width">cost per Minute </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="perMinute" id="perMinute" value="<?php if(isset($page['perMinute'])) echo $page['perMinute']; ?>" />
                    </div>
     <div class="form-group">
                     <label class="full_width">Waiting cost per hour </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="WaitingperHour" id="WaitingperHour" value="<?php if(isset($page['WaitingperHour'])) echo $page['WaitingperHour']; ?>" />
                    </div>-->

    <? //}?>
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button><span id="return"></span>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<script>
		$(function() {
    $( "#accordion" ).accordion({
      collapsible: true/*,
    activate: function( event, ui ) {
        $('#return').load('<?=site_url('trips/getData')?>',{packageId:$('#packageId').val(),countryId:$('#countryId').val(),cityId:$('#cityId').val()})
        
    }*/
        
    });
  });
		</script>


  
