      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"> Settings</li>
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
                  <h3 class="box-title"> Settings</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('admin/Admin/SaveSettings'); ?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['co_id'])) echo $page['co_id'] ?>" />                                   
    
     <?php if($resultNotification==1) {  ?> 
                        
                        <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Message!</h4>
                    Success , Save Setting Successfully.
                  </div>   
                    <?php } ?>
                    
    
    <div class="form-group">
                     <label class="full_width">العنوان</label>  
<input type="text" class="form-control width_size arabic" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" id="title_ar" value="<?=$setting['title_ar'] ?>" name="title_ar"/>
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width">Title En</label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  id="title_en" value="<?=$setting['title_en'] ?>" name="title_en" />
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width">Facebook</label>  
                      <input type="text" class="form-control width_size" id="facebook" value="<?=$setting['facebook'] ?>" name="facebook" />
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width">Twitter</label>  
                      <input type="text" class="form-control width_size" id="twiter" value="<?=$setting['twiter'] ?>" name="twiter"  />
                    </div>
    
    
    
                      <div class="form-group">
                     <label class="full_width">Email</label>  
<input type="text" class="form-control width_size"id="email" value="<?=$setting['email'] ?>" name="email" 
    data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="this field is required!" />
                    </div>
    
    
                    <div class="form-group">
                     <label class="full_width">العنوان الجغرافى</label>  
                    <input type="text" class="form-control width_size arabic" id="address_ar" value="<?=$setting['address_ar'] ?>" name="address_ar"   />
                    </div>
    
                    <div class="form-group">
                     <label class="full_width">Location</label>  
                    <input type="text" class="form-control width_size" id="address_en" value="<?=$setting['address_en'] ?>" name="address_en"/>
                    </div>
    
    

    
                    <div class="form-group">
                     <label class="full_width">Telephone Number</label>  
                    <input type="text" class="form-control width_size" id="phone" value="<?=$setting['phone'] ?>" name="phone"    />
                    </div>
    
                      
                       <div class="form-group">
                     <label class="full_width">تفاصيل اخرى</label>  

                      <textarea  name="contacts_ar" id="contacts_ar">
                          <?=$setting['contacts_ar'] ?>
                          </textarea> 
                    </div>
                      
    
                      <div class="form-group">
                     <label class="full_width">Contact Us</label>  

                      <textarea name="contacts_en" id="contacts_en"   ><?=$setting['contacts_en'] ?>
                          </textarea> 
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
$(document).ready(function() {	
	 $("form").submit(function() {
       
         if($("#title_en").val()=="" || $("#title_ar").val()=="" || $("#description_ar").val()=="" || $("#keyword_ar").val()=="" ) { 												
				       $("#validatSubDiv").css('display','block');
					   return false;
				  }else{
				       $("#validatSubDiv").css('display','none');
					   $('#settingForm').submit();
				  }
			
    });
});
 
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

   
/*
	
 var editor = CKEDITOR.replace( 'details_ar' );
 CKEDITOR.config.contentsLangDirection = 'rtl';	

 CKEDITOR.replace( 'details_en',
    {
        customConfig : '<?=base_url()?>resources/admin/Editor/ckeditor/configEn.js'
    });
    //resources/admin/kcfinder/browse.php?type=files
 
	CKEDITOR.config.filebrowserBrowseUrl = '<?=base_url()?>resources/admin/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserImageBrowseUrl = '<?=base_url()?>resources/admin/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=base_url()?>resources/admin/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserUploadUrl = '<?=base_url()?>resources/admin/kcfinder/upload.php?type=files';
    CKEDITOR.config.filebrowserImageUploadUrl = '<?=base_url()?>resources/admin/kcfinder/upload.php?type=files';
    CKEDITOR.config.filebrowserFlashUploadUrl = '<?=base_url()?>resources/admin/kcfinder/upload.php?type=files';

*/
 
    
	var editor = CKEDITOR.replace( 'contacts_ar',
				{
					// Defines a simpler toolbar to be used in this sample.
					// Note that we have added out "MyButton" button here.
					toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']]

				});
    
    	var editor = CKEDITOR.replace( 'contacts_en',
				{
					// Defines a simpler toolbar to be used in this sample.
					// Note that we have added out "MyButton" button here.
					toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']]

				});

}

</script>