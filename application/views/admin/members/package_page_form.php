<hgroup id="main-title" class="thin">
			<h1><?=$pageTitle; ?></h1>
</hgroup>

<div class="with-padding">

<div class="right-column">

<div class="standard-tabs margin-bottom" >
  
<form action="<?=site_url('Members/SavePackage'); ?>" method="post" id="settingForm" >
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['id'])) echo $page['id']; ?>" name="pageid"  > 


	            <fieldset class="fieldset">
	            	
						<legend class="legend">Inputs</legend>
						
						
								<p class="button-height inline-label">
						<label class="label" for="input-3">مجموعه</label> 
						  <select  id="kind" name="kind"  class="select"  style="width: 200px;"  >
						    <option value="0"> السيارات </option>
						    <option value="1"  <?php if(isset($page['kind'])&&$page['kind']==1) {  ?> selected="selected" <?php } ?>> سوق نسائي </option>
						    <option value="2" <?php if(isset($page['kind'])&&$page['kind']==2) {  ?> selected="selected" <?php } ?>> معدات وادوات </option>
 						  </select>
						 
					</p>	

						<p class="button-height inline-label">
							<label for="validation-required" class="label">Title ar</label>
							<input type="text" name="title_ar" id="title_ar" class="input validate[required]" value="<?php if(isset($page['title_ar'])) echo $page['title_en']; ?>" data-tooltip-options='{"position":"right"}'>
						</p>
						
						<p class="button-height inline-label">
							<label for="validation-required" class="label">Title En</label>
							<input type="text" name="title_en" id="title_en" class="input validate[required]" value="<?php if(isset($page['title_ar'])) echo $page['title_ar']; ?>" data-tooltip-options='{"position":"right"}'>
						</p>

 
				                         
  	         
 	
<p class="button-height inline-label">
<label for="validation-required" class="label">المقدمه</label>
<textarea  id="intro_ar" name="intro_ar" class="input full-width validate[required]" data-tooltip-options='{"position":"left"}'  style="text-align:right;"   ><?php if(isset($page['intro_ar'])) echo $page['intro_ar']; ?></textarea>
</p>
 <!--
<p class="button-height inline-label">
<label for="validation-required" class="label">EN المقدمه</label>
<textarea  id="intro_en" name="intro_en" class="input full-width validate[required]" data-tooltip-options='{"position":"left"}'  style="text-align:right;"   ><?php if(isset($page['intro_en'])) echo $page['intro_en']; ?></textarea>
</p>-->
  
  
<p class="button-height inline-label">
<label for="validation-required" class="label">  وصف داخلي </label>
<textarea  id="details_ar" name="details_ar"      ><?php if(isset($page['details_ar'])) echo $page['details_ar']; ?></textarea>
</p>        
       
	<p class="button-height inline-label">
						<label class="label" for="input-3"> الحاله </label> 
						<input id="active" name="active" type="radio" value="1" checked="checked" > Active
						<input id="active" name="active" type="radio" value="0"  <?php if(isset($page['id'])&&$page['active']==0) {  ?>  checked="checked" <?php } ?>>InActive
					</p>
					
  

<p class="button-height inline-label">
<label class="label" for="input-3"> عدد الصور </label>
     <select  id="max_img_upload_for_product" name="max_img_upload_for_product"  class="select"  style="width: 200px;"  >
     <?php for($i=1;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['max_img_upload_for_product'])&&$page['max_img_upload_for_product']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
       
</p>    



<p class="button-height inline-label">
<label class="label" for="input-3">يعرض بصفحة منفردة</label> 
<input id="only_on_page" name="only_on_page" type="checkbox" value="1" <?php if(isset($page['id'])&&$page['only_on_page']==1) {  ?>  checked="checked" <?php } ?> >  
</p>


    
<p class="button-height inline-label">
<label class="label" for="input-3">يعرض الإعلان بالمميزة</label> 
<input id="special" name="special" type="checkbox" value="1" <?php if(isset($page['id'])&&$page['special']==1) {  ?>  checked="checked" <?php } ?> >  
</p>  



 	    
<p class="button-height inline-label">
<label class="label" for="input-3"> يعرض بالصفحة الرئيسية </label> 
  <select  id="on_home_page" name="on_home_page"  class="select"  style="width: 200px;"  > 
  <?php for($i=0;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['on_home_page'])&&$page['on_home_page']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
     </select> 
</p> 

 
<p class="button-height inline-label">
<label class="label" for="input-3"> مده الاعلان </label>
     <select  id="dayes" name="dayes"  class="select"  style="width: 200px;"  >
     	<option value="3650"  >0</option>
     <?php for($i=1;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['dayes'])&&$page['dayes']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
     
     
     
     
      </select> 
 <span style="direction: rtl; display: none; ">  ( يوم ( 0 تعني دائم    </span>  
</p>   

				
<p class="button-height inline-label">
<label class="label" for="input-3"> التكلفه </label>
     <select  id="price" name="price"  class="select"  style="width: 200px;"  >
     <?php for($i=0;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['price'])&&$page['price']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
    ر س
</p>       

	





    
            	                  
				
						<center>		<div class="button-height"><button type="submit" class="button blue-gradient">Save</button></div> </center>
					
					 
 					
					</fieldset>


 
 
</form>
 
 
 </div>
 
<div>

</div>



	<script>
	 
		// Form validation
		$('form').validationEngine();

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

   

	
 var editor = CKEDITOR.replace( 'details_ar' );
 CKEDITOR.config.contentsLangDirection = 'rtl';	

// CKEDITOR.replace( 'details_en',
  //  {
    //    customConfig : '<?=base_url()?>resources/admin/Editor/ckeditor/configEn.js'
  //  });
    //resources/admin/kcfinder/browse.php?type=files
 
	CKEDITOR.config.filebrowserBrowseUrl = '<?=base_url()?>resources/admin/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserImageBrowseUrl = '<?=base_url()?>resources/admin/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=base_url()?>resources/admin/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserUploadUrl = '<?=base_url()?>resources/admin/kcfinder/upload.php?type=files';
    CKEDITOR.config.filebrowserImageUploadUrl = '<?=base_url()?>resources/admin/kcfinder/upload.php?type=files';
    CKEDITOR.config.filebrowserFlashUploadUrl = '<?=base_url()?>resources/admin/kcfinder/upload.php?type=files';

	
	/*var editor = CKEDITOR.replace( 'intro_ar',
				{
					// Defines a simpler toolbar to be used in this sample.
					// Note that we have added out "MyButton" button here.
					toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['newplugin']]

				});*/

}

</script>


