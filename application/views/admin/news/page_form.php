      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('News')?>
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
<form role="form" action="<?=site_url('News/SaveNews')?>" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['newsId'])) echo $page['newsId'] ?>" />                                
   
    
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('Title')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="newsTitle" id="newsTitle" value="<?php if(isset($page['newsTitle'])) echo $page['newsTitle'] ?>" />
                    </div>
                      
               
           
                     
    
    
    
                       <div class="form-group">
                     <label class="full_width"><?=lang('News_det')?></label>  

<textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" id="newsDetails" name="newsDetails" >
    <?php if(isset($page['newsDetails'])) echo $page['newsDetails']; ?>
    </textarea>
                    </div>
               
    
         <div class="form-group">
                     <label class="full_width"><?=lang('Language')?></label>  

<select class="width_size form-control validate[required]" name="newsLanguage" id="newsLanguage" > 
                         <?php $langArr=array('arabic','english','urdo');for($z=0;$z<count($langArr);$z++){ ?>
                            	<option value="<?= $langArr[$z] ?>" <?php if(isset($page['newsLanguage'])&&$page['newsLanguage']== $langArr[$z] ) {  ?> selected="selected" <?php } ?> ><?= $langArr[$z] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
               
    
    
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"><?=lang('Status')?></label>      
                     
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="newsStatus" id="optionsRadios2" value="1" <?php if(isset($page['newsId']) && $page['newsStatus'] == 1) echo "checked" ?>  />
                         <?=lang('Active')?>
                        </label>
                      </div>
                    
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
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['newsImage']) && $page['newsImage']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['newsImage'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button> 
                                                    
                                                    <!--<input type="image" style="float: right;"  src="<?=$default_image?>"   width="104" height="22"  value="" id="uploadBtnImage" name="uploadBtnImage" style="border: 0px;display: none;" >-->
                                                </div>  
                                           <!--     <div id="thumbnails_image">
                                           <?    //if(isset($page)&& isset($page['newsImage']) && $page['newsImage']!='' ) 
                  //   { 
                    ?>
                          <span style='padding:5px;border:1px dotted #000000;margin: 3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php //echo $page['dish_image'] ?>'  name='ch_image' onclick="showValueImage();" ><img width='20' height='20' src='<?php //echo $this->config->item('uploads_path') ?>files/small/<?php //echo $page['newsImage'] ?>'>&nbsp<?php //echo $page['newsImage'] ?></span>            
                    <?php 
                     // }
                    ?>
                                                </div>
                                                  
                                               
                                                <div id="msgBox" style="color: red;"><b>الامتدادات المسموح بها *.jpeg;*.jpg;|*.bmp;*.gif;*.png<br /> اسم الملف يجب أن يكون باللغة الانجليزية</b></div>	-->							
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['newsImage'])) echo $page['newsImage'];?>"  id="attached_files_image" name="attached_files_image" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
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
               
              
                //    $('#ImagesDiv').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_image').value=response.newFileName;

               //   var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImage();\" ><img src='<?=base_url()?>resources/uploads/files/small/"+response.newFileName+"' width='70'></span>";
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

<script type="text/javascript">
 // This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{

   
	
 
    


var editor = CKEDITOR.replace( 'newsDetails',
				{
					// Defines a simpler toolbar to be used in this sample.
					// Note that we have added out "MyButton" button here.
						toolbar : [ [ 'Source', 'Cut','Copy','Paste','PasteText','PasteFromWord','-', 'Bold', 'Italic', 'Underline', 'Strike','-', '-', 'MyButton' ] ,   ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['newplugin'] , [ 'TextColor', 'BGColor' ] , ['ajaxsave'],
                [ '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','BidiLtr','BidiRtl' ],
                ['Styles','Format','Font','FontSize'],
                ['Undo','Redo','-','RemoveFormat'],
               
                ['Maximize','Link','Unlink','Anchor']
		   
							  ]

				});
 CKEDITOR.config.contentsLangDirection = 'ltr';	   


}

</script>