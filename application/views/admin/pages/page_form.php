      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?php if(isset($pageTitle)) echo $pageTitle; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?php if(isset($pageTitle)) echo $pageTitle; ?></li>
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
                  <h3 class="box-title"><?php if(isset($pageTitle)) echo $pageTitle; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('Page/SavePage'); ?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['pageId'])) echo $page['pageId']; ?>" name="pageid"  > 
<input type="hidden" size="69" id="special" value="<?php if(isset($specialPageTitle)) echo $specialPageTitle; ?>" name="special"  > 
<div id="tabs">
    <? $langArray=array('العربية','english','urdo');
    ?>
     <ul>
       <?  for($i=0;$i<count($langArray);$i++){$n=$i+1;?>
    <li><a href="#tabs-<?=$n?>"><?=$langArray[$i]?></a></li>
    <!--<li><a href="#tabs-2">Proin dolor</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>-->
    <? }?>
  </ul>
     
    <div id="tabs-1">
    <div class="form-group">
                     <label class="full_width">العنوان</label>  
<input type="text" class="form-control width_size arabic" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" id="title_ar" value="<?php if(isset($page['title_ar'])) echo $page['title_ar']; ?>" name="title_ar"/>
                    </div>
      <div class="form-group">
                     <label class="full_width">التفاصيل</label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="details_ar" id="details_ar" >
<?php if(isset($page['details_ar'])) echo $page['details_ar']; ?>                          
                          </textarea> 
                    </div>
    
                   
    
    
    </div>
    <div id="tabs-2">
                      
                        <div class="form-group">
                     <label class="full_width"> Title</label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  id="title_en" value="<?php if(isset($page['title_en'])) echo $page['title_en']; ?>" name="title_en" />
                    </div>
                      
    
                      <div class="form-group">
                     <label class="full_width">Details</label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="details_en" id="details_en" >
                        <?php if(isset($page['details_en'])) echo $page['details_en']; ?>
                          </textarea> 
                    </div>
    
   
    </div>
    <div id="tabs-3">
           <div class="form-group">
                     <label class="full_width"> Title</label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  id="title_urdo" value="<?php if(isset($page['title_urdo'])) echo $page['title_urdo']; ?>" name="title_urdo" />
                    </div>
                      
    
                      <div class="form-group">
                     <label class="full_width">Details</label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="details_urdo" id="details_urdo" >
                        <?php if(isset($page['details_urdo'])) echo $page['details_urdo']; ?>
                          </textarea> 
                    </div>
        
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
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
 
 
<script type="text/javascript">
  //details_urdo  
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

   

	
 var editor = CKEDITOR.replace( 'details_ar' );
 CKEDITOR.config.contentsLangDirection = 'rtl';	
CKEDITOR.replace( 'details_en',
    {
        customConfig : '<?=base_url()?>resources/admin/Editor/ckeditor/configEn.js'
    });

 CKEDITOR.replace( 'details_urdo',
    {
        customConfig : '<?=base_url()?>resources/admin/Editor/ckeditor/configEn.js'
    });

 
	CKEDITOR.config.filebrowserBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserImageBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserUploadUrl = '<?=base_url()?>resources/admin/Editor/Editor/upload.php?type=files';
    CKEDITOR.config.filebrowserImageUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=files';
    CKEDITOR.config.filebrowserFlashUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=files';

	
	

}

</script>