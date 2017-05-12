  

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper form_driver">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Drivers')?>
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
           
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('Drivers/SaveDriver')?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['driverId'])) echo $page['driverId'] ?>" />                                
<input type="hidden" name="OlddriverActivation" id="OlddriverActivation" value="<?php if(isset($page['driverActivation'])) echo $page['driverActivation'] ?>" />                                
<input type="hidden" name="endPoint" id="endPoint" value="<?php if(isset($page['endPoint'])) echo $page['endPoint'] ?>" />                                
             
<input type="hidden" name="nationalID" id="nationalID" value="<?php if(isset($page['nationalID'])) echo $page['nationalID'] ?>" />                                
<input type="hidden" name="birthdate" id="driverbirth" value="<?php if(isset($page['driverbirth'])) echo $page['driverbirth'] ?>" />   
<!--<input type="hidden" name="sequenceNumber" id="sequenceNumber" value="<?php if(isset($page['sequenceNumber'])) echo $page['sequenceNumber'] ?>" />  -->
<!--<input type="hidden" name="driverIdnumber" id="driverIdnumber" value="<?php if(isset($page['driverIdnumber'])) echo $page['driverIdnumber'] ?>" />  -->                              
    <?=$this->session->flashdata('AuthintactionFail')?>
     
    <?php if($this->session->flashdata('AuthintactionFail')==1) { ?>	 
 <div class="alert alert-danger alert-dismissable" id="errorDiv" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Message!</h4>
                  <?=lang('LiceAuth')?>
                  </div>
<?php  } ?> 

 <div class="col-md-12">
   
        <div class="form-group col-md-6">
            <label class="full_width"><?=lang('FName')?> </label>  
            
            <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-driverName="this field is required!"  name="driverFName" id="driverFName" value="<?php if(isset($page['driverFName'])) echo $page['driverFName']; ?>" />
        </div>
        <div class="form-group col-md-6">
            <label class="full_width"><?=lang('LName')?></label>  
            
            <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-driverName="this field is required!"  name="driverLName" id="driverLName" value="<?php if(isset($page['driverLName'])) echo $page['driverLName']; ?>" />
        </div> 
        <!--<div class="form-group col-md-4">
            <label class="full_width"><?=lang('Code')?> </label>  
            <?php if(isset($page['driverId'])) $val='ajax[ajaxCodeCall]'; else $val='ajax[ajaxCodeCall2]'; ?>
            <input type="text" class="form-control width_size" data-validation-engine="validate[required,<?=$val?>]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-driverName="this field is required!"  name="drivercode" id="drivercode"  value="<?php if(isset($page['drivercode'])) echo $page['drivercode']; ?>" />
        </div>-->  
      
    </div>
        <div class="col-sm-12" style="padding:0"> 
            <div class="form-group col-md-4">
                     <label class="full_width"><?=lang('LicNumber')?></label>  
<!--data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"-->
<input type="text" class="form-control width_size"   name="licenseNumber" id="licenseNumber" value="<?php if(isset($page['licenseNumber'])) echo $page['licenseNumber']; ?>" />
                    </div>   
             <div class="form-group col-md-4">
            <label class="full_width"><?=lang('DriverID')?> </label>  <!-- onblur="checkIDNumerUnique(this.value)" -->
             <?php if(isset($page['driverId'])) $val3='ajax[ajaxIDCall]'; else $val3='ajax[ajaxIDCall]'; ?>
            <input type="text" class="form-control width_size" data-validation-engine="validate[required,custom[onlyNumberSp],minSize[10],maxSize[10],<?=$val3?>]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-driverName="this field is required!"  name="driverIdnumber" id="driverIdnumber" value="<?php if(isset($page['driverIdnumber'])) echo $page['driverIdnumber']; ?>" />
        </div>  
              <div class="form-group col-md-4">
            <label class="full_width"><?=lang('DriverBirth')?> </label>  
            
            <input type="text" class="form-control width_size" data-validation-engine="validate[required,custom[hijridate]]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-driverName="this field is required!"   name="driverbirth" id="driverbirth"  value="<?php if(isset($page['driverbirth'])) echo $page['driverbirth']; ?>" />
        </div>  
      
    </div>
      <div class="col-sm-12" style="padding:0"> 
            <div class="form-group col-md-4">
            <label class="full_width"><?=lang('Mobile')?>  </label>  
            <?php if(isset($page['driverId'])) $val44='ajax[ajaxMobCall]'; else $val44='ajax[ajaxMobCall2]'; ?>
            <input type="text" class="form-control width_size" data-validation-engine="validate[required,<?=$val44?>]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-errormessage="this field is required!"  name="driverMobile" id="driverMobile" value="<?php if(isset($page['driverMobile'])) echo $page['driverMobile']; ?>" onblur="checkItemUnique(this.value,2)" />
        </div>
        <div class="form-group col-md-4">
            <label class="full_width" ><?=lang('E-mail')?>  </label> 
            <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>      
            <!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
            <input type="email" class="form-control width_size" data-validation-engine="validate[required,custom[email]]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
            data-errormessage="this field is required!"  id="driverEmail" value="<?php if(isset($page['driverEmail'])) echo $page['driverEmail']; ?>" name="driverEmail" />
        </div>
    </div>
      <div class="form-group col-md-4">
			<?php if(isset($page['driverId'])){ ?>        
            <label class="full_width"><?=lang('Password')?> <p class="hint_psw"><?=lang('passHint')?></p></label>  
            <input type="password" class="form-control width_size"  id="driverPass" value="" name="driverPass"  />
            <?php }else{ ?>    
            <label class="full_width"><?=lang('Password')?>  </label>      
            <input type="password" class="form-control width_size" <?php if(empty($page['driverId'])){ ?>   data-validation-engine="validate[required]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-errormessage="this field is required!" <?php } ?>   id="driverPass" value="" name="driverPass"  />    
            <?php } ?>    
        </div>
    </div>
    <div class="col-sm-12">
               <div class="form-group col-md-4">
                      <label><?=lang('Country')?></label>
                      <select class="width_size form-control validate[required]" name="driverCountryId" id="driverCountryId" onchange="reloadCity(this.value)"  > 
                         <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'] ?>" <?php if(isset($page['driverCountryId'])&&$page['driverCountryId']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
                   
                <div class="form-group col-md-4">
                    <label><?=lang('City')?></label>
                    <span id="city_Load">    
                    <select class="width_size form-control validate[required]" name="cityId" id="cityId" > 
                    <?php for($z=0;$z<count($cities);$z++){ ?>
                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['driverCityId'])&&$page['driverCityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                    <?php } ?> 
                    </select>
                    </span> 
                </div> 
                    
                     
         
                    <div class="radio form-group col-md-4 smoker_driver">
                        <label>
                        <input type="checkbox" name="driverSmoker" id="optionsRadios2" value="1" <?php if(isset($page['driverSmoker']) && $page['driverSmoker'] == 1) echo "checked" ?>  />
                        <?=lang('Smoker')?>    
                        </label>
                    </div>
                    </div>
      <div class="col-sm-12" style="padding:0">              
            
      <div class="form-group col-md-4">
                      <label><?=lang('Packages')?></label>
                         
                      <select class="width_size form-control validate[required]" name="packageId" id="packageId" > 
                              <?php for($z=0;$z<count($package);$z++){ ?>
                                    <option value="<?= $package[$z]['packageId'] ?>" <?php if(isset($page['packageId'])&&$page['packageId']== $package[$z]['packageId'] ) {  ?> selected="selected" <?php } ?> ><?= $package[$z]['packageName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                         
                    </div>        
             <div class="form-group col-md-4">
                      <label><?=lang('Network')?> </label>
                          <span id="network_Load">
                      <select class="width_size form-control validate[required]" name="networkId" id="networkId" onchange="$('#adminId').val()" > 
                              <?php for($z=0;$z<count($network);$z++){ ?>
                                    <option value="<?= $network[$z]['network_id'].'_'.$network[$z]['network_admin'] ?>" <?php if(isset($page['networkId'])&& $page['networkId']== $network[$z]['network_id'] ) {  ?> selected="selected" <?php } ?> ><?= $network[$z]['network_name'] ?></option>
                                <?php } ?> 
                      </select>
                 </span>
                    </div> 
    <div class="form-group col-md-4">
                      <label><?=lang('Brands')?> </label>
                     
                      <select class="width_size form-control validate[required]" name="brandId" id="brandId" onchange="$('#model_Load').load( '<?= base_url('drivers/get_Model/') ?>/'+$(this).val());"   > 
                              <?php for($z=0;$z<count($brand);$z++){ ?>
                                    <option value="<?= $brand[$z]['brandId']?>" <?php if(isset($page['brandId'])&&$page['brandId']== $brand[$z]['brandId'] ) {  ?> selected="selected" <?php } ?> ><?= $brand[$z]['brandName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    </div>
    <div class="col-sm-12" style="padding:0">
    <div class="form-group col-md-4">
                      <label><?=lang('Models')?> </label>
                     <span id="model_Load"> 
                      <select class="width_size form-control validate[required]" name="modelId" id="modelId"  > 
                              <?php for($z=0;$z<count($models);$z++){ ?>
                                    <option value="<?= $models[$z]['modelId']?>" <?php if(isset($page['modelId'])&& $page['modelId']== $models[$z]['modelId'] ) {  ?> selected="selected" <?php } ?> ><?= $models[$z]['modelTitle_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
         </span>
                    </div>
      
             <div class="form-group col-md-4">
                     <label class="full_width"><?=lang('Gender')?></label>      
                        <div class="radio">
                        <label>
<input type="radio" name="driverGender" id="optionsRadios2" value="0" <?php if((isset($page['driverGender']) && $page['driverGender'] == 0) || (!isset($page['driverGender']))) echo "checked" ?>  />
                         <?=lang('female')?>    
                        </label>
                      
                        <label>
<input type="radio" name="driverGender" id="optionsRadios2" value="1" <?php if(isset($page['driverGender']) && $page['driverGender'] == 1) echo "checked" ?>  />
                         <?=lang('male')?>    
                        </label>
                      </div>
                    
                    </div>
    
    <div class="form-group col-md-4" >
						<label  class="full_width "><?=lang('Status')?></label> 
        <div class="radio">
            <label><input id="active" name="driverActivation" type="radio" value="1" <?php if(!isset($page['driverId'])|| $page['driverActivation']==1) {  ?>checked="checked" <?php } ?>> <?=lang('Active')?> </label>
            <label><input id="active" name="driverActivation" type="radio" value="0"  <?php if(isset($page['driverId'])&& $page['driverActivation']==0) {  ?>  checked="checked" <?php } ?>> <?=lang('Inactive')?></label>
        </div>
					</div>
    </div>
    <div class="col-sm-12" style="padding:0">
     <div class="form-group col-md-4">
                      <label><?=lang('Models')?> </label>
                     
                      <select class="width_size form-control validate[required]" name="levelId" id="levelId"  > 
                              <?php for($z=0;$z<count($levels);$z++){ ?>
                                    <option value="<?= $levels[$z]['levelId']?>" <?php if(isset($page['levelId'])&&$page['levelId']== $levels[$z]['levelId'] ) {  ?> selected="selected" <?php } ?> ><?= $levels[$z]['levelName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    
    
     <div class="form-group col-md-4">
                      <label><?=lang('Year')?> </label>
                     
                      <select class="width_size form-control validate[required]" name="year" id="year"  > 
                              <?php $year=date('Y')-5;for($z=1;$z<=5;$z++){ ?>
                                    <option value="<?= $year+$z?>" <?php if(isset($page['carYear'])&&$page['carYear']== $year+$z ) {  ?> selected="selected" <?php } ?> ><?= $year+$z ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    
    <div class="form-group col-md-4">
        <label class="full_width"><?=lang('Seat_Number')?></label>  
        
        <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
        data-errormessage-value-missing="this field is required!" 
        data-errormessage-custom-error="this field is required!" 
        data-driverName="this field is required!"  name="seatNo" id="seatNo" value="<?php if(isset($page['seatNo'])) echo $page['seatNo']; ?>" />
    </div>   
    </div>
    <div class="col-sm-12" style="padding:0">
            <div class="four_image">     
               <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>
            <div class="form-group col-md-3">
             <label class="full_width"> <?=lang('DriverImage')?></label>  

                                 <p class="button-height inline-label">
                							<div class="close_img">
                							
                                                <div id="ImagesDiv">							
                                              
                                                    <span id="thumbnails_image">
                                                        <img width="100" height="100" src="<?php if(isset($page)&& isset($page['driverImage']) && $page['driverImage']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['driverImage'];} else echo $default_image;?> ">
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button>    
                                                </div>  
                                          				
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['driverImage'])) echo $page['driverImage'];?>"  id="attached_files_image" name="attached_files_image" class="add_img" />
                                               
    
                							 </div>                   
                                      </p>
                       	
                    </div>
                    
        <div class="form-group col-md-3">
                     <label class="full_width"><?=lang('CarFPhoto')?></label>  

                                 <p class="button-height inline-label">
                							<div class="close_img">
                								      
                                                <?php
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                
                                                
                                                
                                                <div id="ImagesDivF">
                                                    
                                                     <span id="thumbnails_imageF">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['carFrontPhoto']) && $page['carFrontPhoto']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['carFrontPhoto'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImageF" name="uploadBtnImageF" ><i class="fa fa-plus"></i></button>  
                                                    
                                                 
                                                </div>  
                                           								
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page) && isset($page['carFrontPhoto'])) echo $page['carFrontPhoto'];?>"  id="attached_files_imageF" name="attached_files_imageF" />
                                               
    
                							 </div>                   
                                      </p>
                       	
                    </div>
    
    
    
    <div class="form-group col-md-3">
                     <label class="full_width"> <?=lang('CarBPhoto')?></label>  

                                 <p class="button-height inline-label">
                							<div class="close_img">
                								      
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDivB">
                                                    <span id="thumbnails_imageB">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['carBackPhoto']) && $page['carBackPhoto']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['carBackPhoto'];} else echo $default_image;?> ' />
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImageB" name="uploadBtnImageB" ><i class="fa fa-plus"></i></button>  
                                                  
                                                </div>  
                                          					
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['carBackPhoto'])) echo $page['carBackPhoto'];?>"  id="attached_files_imageB" name="attached_files_imageB" />
                                               
    
                							 </div>                   
                                      </p>
                       	
                    </div>
    
    
    
    
    <div class="form-group col-md-3">
                     <label class="full_width"> <?=lang('licePhoto')?></label>  

                                 <p class="button-height inline-label">
                							<div class="close_img">
                								     
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDivL">	
                                                     <span id="thumbnails_imageL">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['licensePhoto']) && $page['licensePhoto']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['licensePhoto'];} else echo $default_image;?> '>
                                                    </span>
                                                  <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImageL" name="uploadBtnImageL" ><i class="fa fa-plus"></i></button> 
                                                </div>  
                                         
                                                </div>
                                                  
                                               
                                                							
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['licensePhoto'])) echo $page['licensePhoto'];?>"  id="attached_files_imageL" name="attached_files_imageL" />
                                               
    
                							                   
                                      </p>
                       	
                    </div>
                   </div> 
            </div>
      <div class="col-sm-12">          
     <div class="form-group col-md-3">
                     <label class="full_width"><?=lang('carLicNumber')//onblur="validateLicenses(this.value)"?></label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required,custom[integer],minSize[4],maxSize[4]]"
    data-errormessage-value-missing="this field is required!"  
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="carNumber" id="carNumber" value="<?php if(isset($page['carNumber'])) echo $page['carNumber']; ?>" />
                    </div>  
          <div class="form-group col-md-3">
                     <label class="full_width"><?=lang('carLicNumber')//onblur="validateLicenses2(this.value)"?></label>  

<input type="text" class="form-control width_size"  name="carNumber2" data-validation-engine="validate[required,custom[carLicenses]]"
    data-errormessage-value-missing="this field is required! (3 letters and spaces in between missing)"  
    data-errormessage-custom-error="this field is required! (3 letters and spaces in between error)" 
    data-driverName="this field is required! (3 letters and spaces in between eee)"  id="carNumber2" value="<?php if(isset($page['carNumber2'])) echo $page['carNumber2']; ?>" placeholder="J H K"/>
                    </div>  
           <div class="form-group col-md-3">
            <label class="full_width"><?=lang('Sequ_Number')?> </label>  
            <?php if(isset($page['driverId'])) $val2='ajax[ajaxSeqCall]'; else $val2='ajax[ajaxSeqCall2]'; ?>
            <input type="text" class="form-control width_size" data-validation-engine="validate[required,custom[onlyNumberSp],<?=$val2?>]"
            data-errormessage-value-missing="this field is required!" 
            data-errormessage-custom-error="this field is required!" 
            data-driverName="this field is required!"  name="sequenceNumber" id="sequenceNumber"  value="<?php if(isset($page['sequenceNumber'])) echo $page['sequenceNumber']; ?>" />
        </div> 
           
    <!--
    <div class="form-group col-md-3">
                     <label class="full_width"><?=lang('DrivLimit')?></label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="driver_payLevel" id="driver_payLevel" value="<?php if(isset($page['driver_payLevel'])) echo $page['driver_payLevel']; ?>" />
                    </div> 
-->
      <div class="form-group col-md-3">
                     <label class="full_width"><?=lang('Refdriver')?></label>  

<input type="text"  name="refercode" id="refercode" value="<?php if(isset($page['licenseNumber'])) echo $page['licenseNumber']; ?>" />
                    </div>
                    </div>
                                    <div class="col-sm-12"> 
    
     <div class="form-group col-md-4">
                     <label class="full_width"><?=lang('PrefPamethod')?></label>  

       
                        <div class="radio">
                        <label>
<input type="radio" name="driver_paymethod" id="optionsRadios2" value="1" <?php if((isset($page['driver_paymethod']) && $page['driver_paymethod'] == 1) || (!isset($page['driver_paymethod']))) echo "checked" ?>  />
                         <?=lang('cash')?>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
<input type="radio" name="driver_paymethod" id="optionsRadios2" value="2" <?php if(isset($page['driver_paymethod']) && $page['driver_paymethod'] == 2) echo "checked" ?>  />
                         <?=lang('visa')?>    
                        </label>
                      </div>
                       <div class="radio">
                        <label>
<input type="radio" name="driver_paymethod" id="optionsRadios2" value="3" <?php if(isset($page['driver_paymethod']) && $page['driver_paymethod'] == 3) echo "checked" ?>  />
                         <?=lang('Cash&visa')?>  
                        </label>
                      </div>
                   
                    </div> 
    	   <div class="form-group col-md-4">
                      <label  class="full_width"><?=lang('Trip_Type')?> </label>
                     
                              <?php if(isset($page['driver_trip_type']) )
    $arr=explode(',',$page['driver_trip_type']); 
                         for($z=0;$z<count($tripType);$z++){
                             
                             if(isset($arr) && in_array($tripType[$z]['typeId'],$arr))
               $status='checked'; 
                             else if(isset($arr) && !in_array($tripType[$z]['typeId'],$arr))
                                 $status=''; 
                             else if(!isset($page['driver_trip_type'])) 
               $status='checked'; ?>
                                    <div class="checkbox">
                        <label>
<input type="checkbox" name="driver_trip_type[]" id="optionsRadios2<?=$z?>" value="<?=$tripType[$z]['typeId']?>" <?= $status?>  />
                        <?=$tripType[$z]['typeName_'.lang('db')]?> 
                        </label>
                      </div>
                                <?php } ?> 
                     
                        
    </div>
    </div>
                  <div class="box-footer center"><span id="checkUnique"></span>
                    <button type="button" class="btn btn-flat btn-primary save_btn" onclick="saveform();"><?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	<script>
	 function saveform()
        {var dataString = $('#formID').serializeArray();
          //  $('#checkUnique').
            $.ajax({
            type: "POST",
            url: "<?=site_url('Drivers/SaveDriver')?>",
            data: dataString,
            success: function(data) {
              //display message back to user here
               $('#checkUnique').html(data);
            }
            });
        }
		$().ready(function(){
          //*************************************************//
            
            $('#refercode').tokenInput("<?=site_url('drivers/getReffer')?>", {
               hintText:'First Name,last Name,mobile Number ,car number'
               , tokenLimit: 1});
            
            //**********************************************//
            var btnVedio = document.getElementById('uploadBtnImage'),
      attached_files_image = document.getElementById('attached_files_image');
    

  var uploaderVedio = new ss.SimpleUpload({
        button: btnVedio,
        url: '<?= base_url() ?>file_upload.php?upload_dir=./resources/uploads/files/',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        allowedExtensions: ['jpeg', 'jpg', 'bmp', 'gif','png'],
        responseType: 'json',
        updatePosition: function(){
           // alert('sdfsdf');
        },

        startXHR: function() {

          
        },
       /* onSubmit: function() {
            //msgBox.innerHTML = ''; // empty the message box
            btnVedio.innerHTML = 'جاري التحميل'; // change button text to "Uploading..."
          },*/
        onComplete: function( filename, response ) {
          
            if ( !response ) {
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');

                return;
            }
console.log(response)
            if ( response.success == true ) {
                console.log(response.success)
               
              
              //      $('#ImagesDiv').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_image').value=response.newFileName;

                /*  var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImage();\" ><img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='70'></span>";*/
var p="<img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='100'>";
                  $('#thumbnails_image').html(p);
              
	              reset_alertify();
				  alertify.success('<?=lang('upload_sucess')?>');

            } else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    reset_alertify();
    				alertify.error( response.msg );


                } else {
                    //msgBox.innerHTML = 'هناك مشكله في عملية الرفع';
                    reset_alertify();
    				alertify.error('<?=lang('uploaderr')?>');
                    
                }
            }
          },
        onError: function(p1,p2,p3,p4,p5) {
            console.log(p1+'-'+p2+'-'+p3+'-'+p4+'-'+p5);
            
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');
          },
        onExtError: function( filename, extension )
        {
                reset_alertify();
				alertify.error('<?=lang('upload_exterr')?>');

        }          
          
	}); 
                  
          $('#uploadBtnImage').show();	
   
            
            
            //**************************** Front car Image
                var btnVedioF = document.getElementById('uploadBtnImageF'),
       attached_files_imageF = document.getElementById('attached_files_imageF');
    

  var uploaderVedio = new ss.SimpleUpload({
        button: btnVedioF,
        url: '<?= base_url() ?>file_upload.php?upload_dir=./resources/uploads/files/',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        allowedExtensions: ['jpeg', 'jpg', 'bmp', 'gif','png'],
        responseType: 'json',
        updatePosition: function(){
           // alert('sdfsdf');
        },

        startXHR: function() {

          
        },
       /* onSubmit: function() {
            //msgBox.innerHTML = ''; // empty the message box
            btnVedio.innerHTML = 'جاري التحميل'; // change button text to "Uploading..."
          },*/
        onComplete: function( filename, response ) {
          
            if ( !response ) {
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');

                return;
            }
console.log(response)
            if ( response.success == true ) {
                console.log(response.success)
               
              
                 //   $('#ImagesDivF').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_imageF').value=response.newFileName;

               //   var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImageF();\" ><img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='70'></span>";
 var p="<img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='100'>";

                  $('#thumbnails_imageF').html(p);
              
	              reset_alertify();
				  alertify.success('<?=lang('upload_sucess')?>');

            } else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    reset_alertify();
    				alertify.error( response.msg );


                } else {
                    //msgBox.innerHTML = 'هناك مشكله في عملية الرفع';
                    reset_alertify();
    				alertify.error('<?=lang('uploaderr')?>');
                    
                }
            }
          },
        onError: function(p1,p2,p3,p4,p5) {
            console.log(p1+'-'+p2+'-'+p3+'-'+p4+'-'+p5);
            
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');
          },
        onExtError: function( filename, extension )
        {
                reset_alertify();
				alertify.error('<?=lang('upload_exterr')?>');

        }          
          
	}); 
                  
          $('#uploadBtnImageF').show();	
  
            //************************** Back Car Image
                var btnVedioB = document.getElementById('uploadBtnImageB'),
       attached_files_imageB = document.getElementById('attached_files_imageB');
    

  var uploaderVedio = new ss.SimpleUpload({
        button: btnVedioB,
        url: '<?= base_url() ?>file_upload.php?upload_dir=./resources/uploads/files/',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        allowedExtensions: ['jpeg', 'jpg', 'bmp', 'gif','png'],
        responseType: 'json',
        updatePosition: function(){
           // alert('sdfsdf');
        },

        startXHR: function() {

          
        },
       /* onSubmit: function() {
            //msgBox.innerHTML = ''; // empty the message box
            btnVedio.innerHTML = 'جاري التحميل'; // change button text to "Uploading..."
          },*/
        onComplete: function( filename, response ) {
          
            if ( !response ) {
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');

                return;
            }
console.log(response)
            if ( response.success == true ) {
                console.log(response.success)
               
              
                  //  $('#ImagesDivB').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_imageB').value=response.newFileName;

                //  var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImageB();\" ><img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='70'></span>";
  var p="<img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='100'>";
                  $('#thumbnails_imageB').html(p);
              
	              reset_alertify();
				  alertify.success('<?=lang('upload_sucess')?>');

            } else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    reset_alertify();
    				alertify.error( response.msg );


                } else {
                    //msgBox.innerHTML = 'هناك مشكله في عملية الرفع';
                    reset_alertify();
    				alertify.error('<?=lang('uploaderr')?>');
                    
                }
            }
          },
        onError: function(p1,p2,p3,p4,p5) {
            console.log(p1+'-'+p2+'-'+p3+'-'+p4+'-'+p5);
            
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');
          },
        onExtError: function( filename, extension )
        {
                reset_alertify();
				alertify.error('<?=lang('upload_exterr')?>');

        }          
          
	}); 
                  
          $('#uploadBtnImageB').show();	

            //********************************************Licences photo
            
                var btnVedioL = document.getElementById('uploadBtnImageL'),
       attached_files_imageL = document.getElementById('attached_files_imageL');
    

  var uploaderVedio = new ss.SimpleUpload({
        button: btnVedioL,
        url: '<?= base_url() ?>file_upload.php?upload_dir=./resources/uploads/files/',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        allowedExtensions: ['jpeg', 'jpg', 'bmp', 'gif','png'],
        responseType: 'json',
        updatePosition: function(){
           // alert('sdfsdf');
        },

        startXHR: function() {

          
        },
       /* onSubmit: function() {
            //msgBox.innerHTML = ''; // empty the message box
            btnVedio.innerHTML = 'جاري التحميل'; // change button text to "Uploading..."
          },*/
        onComplete: function( filename, response ) {
          
            if ( !response ) {
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');

                return;
            }
console.log(response)
            if ( response.success == true ) {
                console.log(response.success)
               
              
              //      $('#ImagesDivL').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_imageL').value=response.newFileName;

           //       var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImageL();\" ><img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='70'></span>";
  var p="<img src='<?=base_url()?>resources/uploads/files/original/"+response.newFileName+"' width='100'>";
                  $('#thumbnails_imageL').html(p);
              
	              reset_alertify();
				  alertify.success('<?=lang('upload_sucess')?>');

            } else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    reset_alertify();
    				alertify.error( response.msg );


                } else {
                    //msgBox.innerHTML = 'هناك مشكله في عملية الرفع';
                    reset_alertify();
    				alertify.error('<?=lang('uploaderr')?>');
                    
                }
            }
          },
        onError: function(p1,p2,p3,p4,p5) {
            console.log(p1+'-'+p2+'-'+p3+'-'+p4+'-'+p5);
            
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');
          },
        onExtError: function( filename, extension )
        {
                reset_alertify();
				alertify.error('<?=lang('upload_exterr')?>');

        }          
          
	}); 
                  
          $('#uploadBtnImageL').show();	
   
        });
		//-------------
	function showValueImage() {
	   // alert('in');
	  if($("#attached_files_image").val()!='')
	  {
			$.ajax({url: '<?= base_url('package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_image").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
	  }		 
	  $('#thumbnails_image').html('');		
	  $("#attached_files_image").val('');
     
	  $('#ImagesDiv').css('display','block');
    }	
        
        
        //*****************Front 
        function showValueImageF() {
	   // alert('in');
	  if($("#attached_files_imageF").val()!='')
	  {
			$.ajax({url: '<?= base_url('package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_imageF").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
	  }		 
	  $('#thumbnails_imageF').html('');		
	  $("#attached_files_imageF").val('');
     
	  $('#ImagesDivF').css('display','block');
    }	
        //**************************Back 
        function showValueImageB() {
	   // alert('in');
	  if($("#attached_files_imageB").val()!='')
	  {
			$.ajax({url: '<?= base_url('package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_imageB").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
	  }		 
	  $('#thumbnails_imageB').html('');		
	  $("#attached_files_imageB").val('');
     
	  $('#ImagesDivB').css('display','block');
            
            //************************Licenses
            function showValueImageL() {
	   // alert('in');
	  if($("#attached_files_image").val()!='')
	  {
			$.ajax({url: '<?= base_url('package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_imageL").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
	  }		 
	  $('#thumbnails_imageL').html('');		
	  $("#attached_files_imageL").val('');
     
	  $('#ImagesDivL').css('display','block');
    }	
    }	
        /*****************************************/
        function checkCodeUnique(val)
        {
            $.ajax({url: '<?= base_url('drivers/checkCode') ?>',type:'POST',cache: false,data: '&code='+val}).done(function(html){console.log(html);if(html==1)$('#errorDiv').css( 'display','block' ); else $('#errorDiv').css( 'display','none' );});	
        }
        
        /*******************************************************/
        function checkItemUnique(value,mode){
         //   $.ajax({url: '<?= base_url('passengers/checkItemUnique') ?>',type:'POST',cache: false,data: '&val='+value+'&mode='+mode}).done(function(html){$('#HiddenDivLoad').html( html );});
            $('#checkUnique').load('<?= base_url('drivers/checkItemUnique') ?>',{val:value,mode:mode})
        }
        //***********************************************//
        function checkIDNumerUnique(val)
        {
            console.log(val.length)
            if(val.length<10){alert('<?=lang('IDNumerr')?>');}else if(val.length>10){alert('<?=lang('IDNumerr')?>');}else{
                $.ajax({url: '<?= base_url('drivers/checkID') ?>',type:'POST',cache: false,data: '&code='+val}).done(function(html){console.log(html);if(html==1)$('#errorDiv').css( 'display','block' ); else $('#errorDiv').css( 'display','none' );});	
                }
        }
        //***************************************//
        function validateLicenses(val)
        {
             if(val.length<4){alert('<?=lang('LicenNumErr')?>');  $('#carNumber').focuse();}else if(val.length>4){alert('<?=lang('LicenNumErr')?>');  $('#carNumber').focuse();}
        }
        function validateLicenses2(val)
        {
             if(val.length<5){alert('<?=lang('LicenNumErr2')?>'); $('#carNumber2').focuse();}else if(val.length>5){alert('<?=lang('LicenNumErr2')?>'); $('#carNumber2').focuse();}
        }
        //******************************************//
        function reloadCity(val)
        {
            $('#city_Load').load( '<?= base_url('generalsetting/get_cities/') ?>/'+val);
            $('#network_Load').load( '<?= base_url('generalsetting/get_network/') ?>/'+val);
        }
	</script>




