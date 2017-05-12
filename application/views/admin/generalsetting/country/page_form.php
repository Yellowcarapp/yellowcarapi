      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Country')?>
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
<form role="form" action="<?=site_url('Generalsetting/SaveCountry')?>" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['countryId'])) echo $page['countryId'] ?>" />                                          <div class="form-group">
                     <label class="full_width"><?=lang('NameInAr')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="countryName_ar" id="countryName_ar" value="<?php if(isset($page['countryName_ar'])) echo $page['countryName_ar'] ?>"/>
                    </div>
      <div class="form-group">
                     <label class="full_width"><?=lang('NameInEn')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="countryName_en" id="countryName_en" value="<?php if(isset($page['countryName_en'])) echo $page['countryName_en'] ?>"/>
                    </div>
    
      <div class="form-group">
                     <label class="full_width"><?=lang('NameInUr')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="countryName_ur" id="countryName_ur" value="<?php if(isset($page['countryName_ur'])) echo $page['countryName_ur'] ?>"/>
                    </div>
                      <div class="form-group">
                     <label class="full_width"><?=lang('Country_Code')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="countryCode" id="countryCode" value="<?php if(isset($page['countryCode'])) echo $page['countryCode'] ?>" />
                    </div>
                    <div class="form-group">
                     <label class="full_width"><?=lang('TimeZone')?></label>  
                           <select class="width_size form-control validate[required]" name="timeZone" id="timeZone"  > 
                         <?php for($z=0;$z<count($TimeZoneArr);$z++){ ?>
                            	<option value="<?= $TimeZoneArr[$z]['id'] ?>" <?php if(isset($page['timeZone'])&&$page['timeZone']== $TimeZoneArr[$z]['id'] ) {  ?> selected="selected" <?php }else {} ?> ><?= $TimeZoneArr[$z]['val'] ?></option>
                            <?php } ?>    
                           </select>
                        <? //echo timezone_menu('UM8');?>
                    </div>   
                       <div class="form-group">
                     <label class="full_width"><?=lang('Currency')?></label>  
                           <select class="width_size form-control validate[required]" name="countryCurrency" id="countryCurrency" onchange="$('#modal2').attr('href','<?=site_url('generalsetting/addCurrency').'/'?>'+this.value)" > 
                         <?php for($z=0;$z<count($currency);$z++){ ?>
                            	<option value="<?= $currency[$z]['curr_id'] ?>" <?php if(isset($page['countryCurrency'])&& $page['countryCurrency']== $currency[$z]['curr_id'] ) {  ?> selected="selected" <?php } ?> ><?= $currency[$z]['curr_name_'.lang('db')].'-'.$currency[$z]['curr_abbr_'.lang('db')] ?></option>
                            <?php } ?>    
                           </select><a href="<?=site_url('generalsetting/addCurrency')?>"  id="modal"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i></a>
                           
                  <a href="<? if(!isset($page['countryCurrency'])) echo site_url('generalsetting/addCurrency/'.$currency[0]['curr_id']); else echo site_url('generalsetting/addCurrency/'.$page['countryCurrency']); ?>"  id="modal2"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></a>
                    </div>
    
                   
                   
    
      <div class="form-group">
                     <label class="full_width"> <?=lang('Image')?></label>  

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
                                                     <span id="thumbnails_image">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['country_flag']) && $page['country_flag']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['country_flag'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button> 
                                                    
                                                    
                                                   <!-- <input type="image" style="float: right;"  src="<?=$default_image?>"   width="104" height="22"  value="" id="uploadBtnImage" name="uploadBtnImage" style="border: 0px;display: none;" >-->
                                                </div>  
                                           <!--     <div id="thumbnails_image">
                                           <?    /*if(isset($page)&& isset($page['country_flag']) && $page['country_flag']!='' ) 
                     { */
                    ?>
                          <span style='padding:5px;border:1px dotted #000000;margin: 3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php //echo $page['country_flag'] ?>'  name='ch_image' onclick="showValueImage();" ><img width='20' height='20' src='<?php //echo $this->config->item('uploads_path') ?>files/small/<?php //echo $page['country_flag'] ?>'>&nbsp<?php //echo $page['country_flag'] ?></span>            
                    <?php 
                      //}
                    ?>
                                                </div>
                                                  
                                               
                                                <div id="msgBox" style="color: red;"><b>الامتدادات المسموح بها *.jpeg;*.jpg;|*.bmp;*.gif;*.png<br /> اسم الملف يجب أن يكون باللغة الانجليزية</b></div>	-->							
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['country_flag'])) echo $page['country_flag'];?>"  id="attached_files_image" name="attached_files_image" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"><?=lang('Status')?></label>      
                 
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="countryStatus" id="optionsRadios2" value="1" <?php if(isset($page['countryId']) && $page['countryStatus'] == 1) echo "checked" ?>  />
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
           $('a#modal').colorbox({width:250}); 
             $('a#modal2').colorbox({width:250}); 
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
               
              
                 //   $('#ImagesDiv').css('display','none');
                    
                  

                    
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
		//	$('#ImagesDiv').css('display','none');
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
     
	  $('#imageContainer').css('display','block');
    }	
	</script>

	