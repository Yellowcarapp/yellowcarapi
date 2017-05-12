  

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Driver
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
<form role="form" action="<?=site_url('Drivers/SaveDriver')?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['driverId'])) echo $page['driverId'] ?>" />                                
    
     
    <?php //if($this->session->flashdata('emailExist')==1) { ?>	 
 <div class="alert alert-danger alert-dismissable" id="errorDiv" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Message!</h4>
                   Error. Code  aleardy exist .
                  </div>
<?php // } ?> 


   
                      <div class="form-group">
                     <label class="full_width">First Name </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="driverFName" id="driverFName" value="<?php if(isset($page['driverFName'])) echo $page['driverFName']; ?>" />
                    </div>
                <div class="form-group">
                     <label class="full_width">Last Name </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="driverLName" id="driverLName" value="<?php if(isset($page['driverLName'])) echo $page['driverLName']; ?>" />
                    </div> 
     <div class="form-group">
                     <label class="full_width">Code </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="drivercode" id="drivercode" onblur="checkCodeUnique(this.value)" value="<?php if(isset($page['drivercode'])) echo $page['drivercode']; ?>" />
                    </div>   
               
                      <div class="form-group">
                     <label class="full_width">Mobile </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="driverMobile" id="driverMobile" value="<?php if(isset($page['driverMobile'])) echo $page['driverMobile']; ?>" />
                    </div>
                      
               
          
               <label class="full_width">E-mail  </label> 
                      <div class="form-group input-group">
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span>      
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="email" class="form-control width_size" data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="this field is required!"  id="driverEmail" value="<?php if(isset($page['driverEmail'])) echo $page['driverEmail']; ?>" name="driverEmail" />
                    </div>
                      
    
    
<div class="form-group">
<?php if(isset($page['driverId'])){ ?>        
<label class="full_width">Password (Hint : leave it empty if you want not to change password)</label>  
<input type="password" class="form-control width_size"  id="driverPass" value="" name="driverPass"  />
<?php }else{ ?>    
<label class="full_width">Password </label>      
<input type="password" class="form-control width_size" <?php if(empty($page['driverId'])){ ?>   data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" <?php } ?>   id="driverPass" value="" name="driverPass"  />    
<?php } ?>    
</div>
               <div class="form-group">
                      <label>Country</label>
                      <select class="width_size form-control validate[required]" name="driverCountryId" id="driverCountryId" onchange="$('#city_Load').load( '<?= base_url('generalsetting/get_cities/') ?>/'+$(this).val());"  > 
                         <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'] ?>" <?php if(isset($page['driverCountryId'])&&$page['driverCountryId']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
               
            <div class="form-group">
                      <label>City</label>
                     <span id="city_Load">    
                      <select class="width_size form-control validate[required]" name="cityId" id="cityId" > 
                              <?php for($z=0;$z<count($cities);$z++){ ?>
                                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['driverCityId'])&&$page['driverCityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        </span> 
                    </div>        
             <div class="form-group">
                     <label class="full_width"> DriverImage</label>  

                                 <p class="button-height inline-label">
                                        <center>
                							<div class="close_img">
                								<!--<a href="#">
                									<i class="fa fa-times"></i>
                								</a>-->       
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDiv">							
                                                 <!--   <input type="image" style="float: right;"  src="<?=$default_image?>"   width="104" height="22"  value="" id="uploadBtnImage" name="uploadBtnImage" style="border: 0px;display: none;" >-->
                                                    <span id="thumbnails_image">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['driverImage']) && $page['driverImage']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['driverImage'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button>    
                                                </div>  
                                             <!--   <div id="thumbnails_image">
                                           <?    //if(isset($page)&& isset($page['driverImage']) && $page['driverImage']!='' ) 
                     { 
                    ?>
                          <span style='padding:5px;border:1px dotted #000000;margin: 3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php //echo $page['driverImage'] ?>'  name='ch_image' onclick="showValueImage();" ><img width='20' height='20' src='<?php //echo $this->config->item('uploads_path') ?>files/original/<?php //echo $page['driverImage'] ?>'>&nbsp<?php //echo $page['driverImage'] ?></span>            
                    <?php 
                     // }
                    ?>
                                                </div>
                                                  
                                               
                                                                                            
<div id="msgBox" style="color: red;"><b style="font-size: 12px;"> File name must be in english <br /> extension only *.jpeg;*.jpg;|*.bmp;*.gif;*.png </b></div>		-->					
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['driverImage'])) echo $page['driverImage'];?>"  id="attached_files_image" name="attached_files_image" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
      <div class="form-group">
                      <label>Package</label>
                     <span id="city_Load">    
                      <select class="width_size form-control validate[required]" name="packageId" id="packageId" > 
                              <?php for($z=0;$z<count($package);$z++){ ?>
                                    <option value="<?= $package[$z]['packageId'] ?>" <?php if(isset($page['packageId'])&&$page['packageId']== $package[$z]['packageId'] ) {  ?> selected="selected" <?php } ?> ><?= $package[$z]['packageName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                        </span> 
                    </div>        
             <div class="form-group">
                      <label>Network </label>
                         
                      <select class="width_size form-control validate[required]" name="networkId" id="networkId" onchange="$('#adminId').val()" > 
                              <?php for($z=0;$z<count($network);$z++){ ?>
                                    <option value="<?= $network[$z]['network_id'].'_'.$network[$z]['network_admin'] ?>" <?php if(isset($page['networkId'])&&$page['networkId']== $network[$z]['network_id'] ) {  ?> selected="selected" <?php } ?> ><?= $network[$z]['network_name'] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div> 
    
      <div class="form-group ">
                     
                      
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="driverSmoker" id="optionsRadios2" value="1" <?php if(isset($page['driverSmoker']) && $page['driverSmoker'] == 1) echo "checked" ?>  />
                         Smoker    
                        </label>
                      </div>
                    
                    </div>
             <div class="form-group ">
                     <label class="full_width checkbox_label">Gender</label>      
                        <div class="checkbox">
                        <label>
<input type="radio" name="driverGender" id="optionsRadios2" value="0" <?php if((isset($page['driverGender']) && $page['driverGender'] == 0) || (!isset($page['driverGender']))) echo "checked" ?>  />
                         Female    
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
<input type="radio" name="driverGender" id="optionsRadios2" value="1" <?php if(isset($page['driverGender']) && $page['driverGender'] == 1) echo "checked" ?>  />
                         Male    
                        </label>
                      </div>
                    
                    </div>
    
    
      <div class="form-group">
                      <label>Brand </label>
                     
                      <select class="width_size form-control validate[required]" name="brandId" id="brandId" onchange="$('#model_Load').load( '<?= base_url('drivers/get_Model/') ?>/'+$(this).val());"   > 
                              <?php for($z=0;$z<count($brand);$z++){ ?>
                                    <option value="<?= $brand[$z]['brandId']?>" <?php if(isset($page['brandId'])&&$page['brandId']== $brand[$z]['brandId'] ) {  ?> selected="selected" <?php } ?> ><?= $brand[$z]['brandName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    <div class="form-group">
                      <label>Model </label>
                     <span id="model_Load"> 
                      <select class="width_size form-control validate[required]" name="modelId" id="modelId"  > 
                              <?php for($z=0;$z<count($models);$z++){ ?>
                                    <option value="<?= $models[$z]['modelId']?>" <?php if(isset($page['modelId'])&&$page['modelId']== $models[$z]['modelId'] ) {  ?> selected="selected" <?php } ?> ><?= $models[$z]['modelTitle_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
         </span>
                    </div>
     <div class="form-group">
                      <label>Level </label>
                     
                      <select class="width_size form-control validate[required]" name="levelId" id="levelId"  > 
                              <?php for($z=0;$z<count($levels);$z++){ ?>
                                    <option value="<?= $levels[$z]['levelId']?>" <?php if(isset($page['levelId'])&&$page['levelId']== $levels[$z]['levelId'] ) {  ?> selected="selected" <?php } ?> ><?= $levels[$z]['levelName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    
    
     <div class="form-group">
                      <label>Year </label>
                     
                      <select class="width_size form-control validate[required]" name="year" id="year"  > 
                              <?php $year=date('Y')-5;for($z=1;$z<=5;$z++){ ?>
                                    <option value="<?= $year+$z?>" <?php if(isset($page['year'])&&$page['year']== $year+$z ) {  ?> selected="selected" <?php } ?> ><?= $year+$z ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    
     <div class="form-group">
                     <label class="full_width">Seat Number</label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="seatNo" id="seatNo" value="<?php if(isset($page['seatNo'])) echo $page['seatNo']; ?>" />
                    </div>   
    
    <div class="form-group">
                     <label class="full_width"> Car Front Photo</label>  

                                 <p class="button-height inline-label">
                                        <center>
                							<div class="close_img">
                								<!--<a href="#">
                									<i class="fa fa-times"></i>
                								</a>-->       
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                
                                                
                                                
                                                <div id="ImagesDivF">
                                                    
                                                     <span id="thumbnails_imageF">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['carFrontPhoto']) && $page['carFrontPhoto']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['carFrontPhoto'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button>  
                                                    
                                                    
                                                    
                                                  <!--  <input type="image" style="float: right;"  src="<?=$default_image?>"   width="104" height="22"  value="" id="uploadBtnImageF" name="uploadBtnImageF" style="border: 0px;display: none;" >-->
                                                </div>  
                                              <!--  <div id="thumbnails_imageF">
                                           <?    if(isset($page)&& isset($page['carFrontPhoto']) && $page['carFrontPhoto']!='' ) 
                     { 
                    ?>
                          <span style='padding:5px;border:1px dotted #000000;margin: 3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php echo $page['carFrontPhoto'] ?>'  name='ch_image' onclick="showValueImageF();" ><img width='20' height='20' src='<?php echo $this->config->item('uploads_path') ?>files/original/<?php echo $page['carFrontPhoto'] ?>'>&nbsp<?php echo $page['carFrontPhoto'] ?></span>            
                    <?php 
                      }
                    ?>
                                                </div>
                                                  
                                               
                                                <div id="msgBox" style="color: red;"><b>الامتدادات المسموح بها *.jpeg;*.jpg;|*.bmp;*.gif;*.png<br /> اسم الملف يجب أن يكون باللغة الانجليزية</b></div>-->								
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['carFrontPhoto'])) echo $page['carFrontPhoto'];?>"  id="attached_files_imageF" name="attached_files_imageF" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
    
    
    
    <div class="form-group">
                     <label class="full_width"> Car Back Photo</label>  

                                 <p class="button-height inline-label">
                                        <center>
                							<div class="close_img">
                								<!--<a href="#">
                									<i class="fa fa-times"></i>
                								</a>-->       
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDivB">
                                                    <span id="thumbnails_imageB">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['carBackPhoto']) && $page['carBackPhoto']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['carBackPhoto'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button>  
                                                    <!--
                                                    <input type="image" style="float: right;"  src="<?=$default_image?>"   width="104" height="22"  value="" id="uploadBtnImageB" name="uploadBtnImageB" style="border: 0px;display: none;" >-->
                                                </div>  
                                            <!--    <div id="thumbnails_imageB">
                                           <?    if(isset($page)&& isset($page['carBackPhoto']) && $page['carBackPhoto']!='' ) 
                     { 
                    ?>
                          <span style='padding:5px;border:1px dotted #000000;margin: 3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php echo $page['carBackPhoto'] ?>'  name='ch_image' onclick="showValueImageB();" ><img width='20' height='20' src='<?php echo $this->config->item('uploads_path') ?>files/original/<?php echo $page['carBackPhoto'] ?>'>&nbsp<?php echo $page['carBackPhoto'] ?></span>            
                    <?php 
                      }
                    ?>
                                                </div>
                                                  
                                               
                                                <div id="msgBox" style="color: red;"><b>الامتدادات المسموح بها *.jpeg;*.jpg;|*.bmp;*.gif;*.png<br /> اسم الملف يجب أن يكون باللغة الانجليزية</b></div>	-->							
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['carBackPhoto'])) echo $page['carBackPhoto'];?>"  id="attached_files_imageB" name="attached_files_imageB" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
    
    
    
    
    <div class="form-group">
                     <label class="full_width"> license Photo</label>  

                                 <p class="button-height inline-label">
                                        <center>
                							<div class="close_img">
                								<!--<a href="#">
                									<i class="fa fa-times"></i>
                								</a>-->       
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDivL">	
                                                     <span id="thumbnails_imageL">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['licensePhoto']) && $page['licensePhoto']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['licensePhoto'];} else echo $default_image;?> '>
                                                    </span>
                                                   <!-- <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button>
                                                    <input type="image" style="float: right;"  src="<?=$default_image?>"   width="104" height="22"  value="" id="uploadBtnImageL" name="uploadBtnImageL" style="border: 0px;display: none;" >-->
                                                </div>  
                                           <!--     <div id="thumbnails_imageL">
                                           <?    if(isset($page)&& isset($page['licensePhoto']) && $page['licensePhoto']!='' ) 
                     { 
                    ?>
                          <span style='padding:5px;border:1px dotted #000000;margin: 3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php //echo $page['licensePhoto'] ?>'  name='ch_image' onclick="showValueImageL();" ><img width='20' height='20' src='<?php //echo $this->config->item('uploads_path') ?>files/original/<?php// echo $page['licensePhoto'] ?>'>&nbsp<?php //echo $page['licensePhoto'] ?></span>            
                    <?php 
                      }
                    ?>
                                                </div>
                                                  
                                               
                                                <div id="msgBox" style="color: red;"><b>الامتدادات المسموح بها *.jpeg;*.jpg;|*.bmp;*.gif;*.png<br /> اسم الملف يجب أن يكون باللغة الانجليزية</b></div>	-->							
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['licensePhoto'])) echo $page['licensePhoto'];?>"  id="attached_files_imageL" name="attached_files_imageL" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
     <div class="form-group">
                     <label class="full_width">License Number</label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="licenseNumber" id="licenseNumber" value="<?php if(isset($page['licenseNumber'])) echo $page['licenseNumber']; ?>" />
                    </div>   
     <div class="form-group">
                     <label class="full_width">Preffered Pay method</label>  

       
                        <div class="checkbox">
                        <label>
<input type="radio" name="driver_paymethod" id="optionsRadios2" value="1" <?php if((isset($page['driver_paymethod']) && $page['driver_paymethod'] == 1) || (!isset($page['driver_paymethod']))) echo "checked" ?>  />
                         Cash    
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
<input type="radio" name="driver_paymethod" id="optionsRadios2" value="2" <?php if(isset($page['driver_paymethod']) && $page['driver_paymethod'] == 2) echo "checked" ?>  />
                         visa    
                        </label>
                      </div>
                       <div class="checkbox">
                        <label>
<input type="radio" name="driver_paymethod" id="optionsRadios2" value="3" <?php if(isset($page['driver_paymethod']) && $page['driver_paymethod'] == 3) echo "checked" ?>  />
                         Cash & visa    
                        </label>
                      </div>
                   
                    </div> 
    	 <div class="form-group">
						<label  class="full_width">Status</label> 
						<input id="active" name="driverActivation" type="radio" value="1" checked="checked" > Active 
						<input id="active" name="driverActivation" type="radio" value="0"  <?php if(isset($page['driverId'])&&$page['driverActivation']==0) {  ?>  checked="checked" <?php } ?>> InActive
					</div>
    <div class="form-group">
                     <label class="full_width">Driver Limit</label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="driver_payLevel" id="driver_payLevel" value="<?php if(isset($page['driver_payLevel'])) echo $page['driver_payLevel']; ?>" />
                    </div>  
      <div class="form-group">
                     <label class="full_width">Reffer driver</label>  

<input type="text"  name="refercode" id="refercode" value="<?php if(isset($page['licenseNumber'])) echo $page['licenseNumber']; ?>" />
                    </div>   
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	<script>
	 
		$().ready(function(){
          //*************************************************//
            
            $('#refercode').tokenInput("<?=site_url('drivers/getReffer')?>", {
               
                tokenLimit: 1});
            
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
   <?php 
			if(isset($page)&& isset($page['driverImage']) && $page['driverImage']!='' )
			{
			?>
		//	$('#ImagesDiv').css('display','none');
			<?php	
			} 
			 ?>    
            
            
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
   <?php 
			if(isset($page)&& isset($page['carFrontPhoto']) && $page['carFrontPhoto']!='' )
			{
			?>
			//$('#ImagesDivF').css('display','none');
			<?php	
			} 
			 ?>
            
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
   <?php 
			if(isset($page)&& isset($page['carBackPhoto']) && $page['carBackPhoto']!='' )
			{
			?>
		//	$('#ImagesDivB').css('display','none');
			<?php	
			} 
			 ?>
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
                  $('#thumbnails_imageL').append(p);
              
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
   <?php 
			if(isset($page)&& isset($page['licensePhoto']) && $page['licensePhoto']!='' )
			{
			?>
		//	$('#ImagesDivL').css('display','none');
			<?php	
			} 
			 ?>
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
			$.ajax({url: '<?= base_url('/package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_imageB").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
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
	</script>




