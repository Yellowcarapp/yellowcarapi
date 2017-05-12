<noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>

		<hgroup id="main-title" class="thin">
			<h1>Settings</h1>
		</hgroup>

		<div class="with-padding">

			<div>
			  <div class="right-column">


<div class="standard-tabs margin-bottom" id="add-tabs">
	<!--
						<ul class="tabs">
							<li class="active"><a href="#Arabic">Arabic</a></li>
							<li><a href="#English">English</a></li>
						
                            <li><a href="#Options">Options</a></li>
						</ul>
 -->
<div class="tabs-content">

	<form action="<?=site_url('admin/Admin/SaveSettings'); ?>" method="post" id="settingForm">
        <div id="alerts" class="with-padding">
                    <?php if($resultNotification==1) {  ?> 
                        
                        <p class="message icon-speech green-gradient small-margin-bottom">
                        <a class="close" title="Hide message" href="#">✕</a>
                            Thank You Web Site Setting Saved
                        </p>
                           
                    <?php } ?>
                     
                    
                    <?php if($resultNotification==2) {  ?>  
            
                    
                   <p class="message icon-speech red-gradient small-margin-bottom">
                        <a class="close" title="Hide message" href="#">✕</a>
                            please check your Officiel Email feild it going wrong , email@example.com
                        </p>
                          
                    <?php } ?>  
                    
                   <p class="message icon-speech red-gradient small-margin-bottom"  id="validatSubDiv" style="display:none;">
                      <a class="close" title="Hide message" href="#">✕</a>
                            Note :  there  are some feilds required.
                    </p>  
              </div>                         

            <div id="Arabic" class="with-padding">
                 <?php $this->load->view('admin/main/contact_us_ar'); ?>    
            </div>

            <div id="English" >
                <?php //$this->load->view('admin/main/body_setting_en'); ?>    
            </div>
            
            <div id="French">
                <?php //$this->load->view('admin/main/body_setting_fr'); ?>    
            </div>

            <div id="Options" class="with-padding">
                <?php //$this->load->view('admin/main/body_setting_options'); ?>    
            </div>

			<center>		
            	<div class="button-height"><button type="submit" class="button blue-gradient">Save</button></div> 
            </center>
    </form>
</div>


</div>

			  </div>

			</div>

		</div>
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