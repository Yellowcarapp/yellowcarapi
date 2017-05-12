  

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Network')?>
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
<form role="form" action="<?=site_url('admin/Drivers/SaveNetwork')?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['network_id'])) echo $page['network_id'] ?>" />                                
  <input type="hidden" name="userId" id="userId" value="<?php if(isset($page['userId'])) echo $page['userId'] ?>" />                                
  
     



   
                      <div class="form-group">
                     <label class="full_width"><?=lang('Name')?> </label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="network_name" id="network_name" value="<?php if(isset($page['network_name'])) echo $page['network_name']; ?>" />
                    </div>
                      
               
                    <div class="form-group">
                      <label><?=lang('Country')?></label>
                      <select class="width_size form-control validate[required]" name="network_country" id="network_country" onchange="var arr=this.value; var id=arr.split('_');$('#city_Load').load( '<?= base_url('admin/generalsetting/get_cities/') ?>/'+id[0]);"  > 
                         <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'].'_'. $countries[$z]['timeZone']?>" <?php if(isset($page['network_country'])&&$page['network_country']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?>  ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
               
            <div class="form-group">
                      <label><?=lang('City')?></label>
                     <span id="city_Load">    
                      <select class="width_size form-control validate[required]" name="cityId" id="cityId" > 
                              <?php for($z=0;$z<count($cities);$z++){ ?>
                                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['cityId'])&&$page['cityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        </span> 
                    </div>
               <label class="full_width"><?=lang('Admin_username')?></label> 
                      <div class="form-group input-group">
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  id="userName" value="<?php if(isset($page['userName'])) echo $page['userName']; ?>" name="userName" />
                    </div>
                      
    
      <label class="full_width"><?=lang('Admin_email')?> </label> 
                      <div class="form-group input-group">
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span>      
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="email" class="form-control width_size" data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="this field is required!"  id="userEmail" value="<?php if(isset($page['userEmail'])) echo $page['userEmail']; ?>" name="userEmail" />
                    </div>

                                      <div class="form-group">
<?php if(isset($page['userId'])){ ?>        
<label class="full_width"><?=lang('Admin_Password')?> <?=lang('passHint')?></label>  
<input type="password" class="form-control width_size"  id="userPass" value="" name="userPass"  />
<?php }else{ ?>    
<label class="full_width"><?=lang('Admin_Password')?> </label>      
<input type="password" class="form-control width_size" <?php if(empty($page['userId'])){ ?>   data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" <?php } ?>   id="userPass" value="" name="userPass"  />    
<?php } ?>    
</div>  
           
    
    <div class="form-group">
                     <label class="full_width"> <?=lang('Image')?></label>  

                                 <p class="button-height inline-label">
                                        <center>
                							<div class="close_img">
                								      
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDiv">
                                                     <span id="thumbnails_image">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['networkLogo']) && $page['networkLogo']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['networkLogo'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button> 
                                                   
                                                </div>  
                    					
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['networkLogo'])) echo $page['networkLogo'];?>"  id="attached_files_image" name="attached_files_image" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
    
         <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"><?=lang('Status')?></label>      
                 
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="network_active" id="optionsRadios2" value="1" <?php if(isset($page['network_id']) && $page['network_active'] == 1) echo "checked" ?>  />
                         <?=lang('Active')?>    
                        </label>
                      </div>
                    
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
               
              
               //     $('#ImagesDiv').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_image').value=response.newFileName;

                //  var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImage();\" ><img src='<?=base_url()?>resources/uploads/files/small/"+response.newFileName+"' width='70'></span>";
  var p="<img src='<?=base_url()?>resources/uploads/files/small/"+response.newFileName+"' width='70'>";
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
			if(isset($page)&& isset($page['country_flag']) && $page['country_flag']!='' )
			{
			?>
			//$('#ImagesDiv').css('display','none');
			<?php	
			} 
			 ?>      
        });
		//-------------
	function showValueImage() {
	   // alert('in');
	  if($("#attached_files_image").val()!='')
	  {
			$.ajax({url: '<?= base_url('admin/package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_image").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
	  }		 
	  $('#thumbnails_image').html('');		
	  $("#attached_files_image").val('');
     
	  $('#imageContainer').css('display','block');
    }	
	</script>

