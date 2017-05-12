      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?=lang('Levels')?>
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
<form role="form" action="<?=site_url('Generalsetting/SaveLevel')?>" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['levelId'])) echo $page['levelId'] ?>" />                                
   
    
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('NameInAr')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="levelName_ar" id="levelName_ar" value="<?php if(isset($page['levelName_ar'])) echo $page['levelName_ar'] ?>" />
                    </div>
   
     <div class="form-group">
                     <label class="full_width"><?=lang('NameInEn')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="levelName_en" id="levelName_en" value="<?php if(isset($page['levelName_en'])) echo $page['levelName_en'] ?>" />
                    </div>
     <div class="form-group">
                     <label class="full_width"><?=lang('NameInUr')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="levelName_ur" id="levelName_ur" value="<?php if(isset($page['levelName_ur'])) echo $page['levelName_ur'] ?>" />
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
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['level_img']) && $page['level_img']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['level_img'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button> 
                                                   
                                                </div>  
                    					
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['level_img'])) echo $page['level_img'];?>"  id="attached_files_image" name="attached_files_image" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
    
    
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"><?=lang('Status')?></label>      
                     
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="levelStatus" id="optionsRadios2" value="1" <?php if(isset($page['levelStatus']) && $page['levelStatus'] == 1) echo "checked" ?>  />
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


