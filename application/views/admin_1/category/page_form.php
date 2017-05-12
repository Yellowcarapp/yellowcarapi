<hgroup id="main-title" class="thin">
			<h1><?=$pageTitle; ?></h1>
</hgroup>

<div class="with-padding">

<div class="right-column">

<div class="standard-tabs margin-bottom" >
  
<form action="<?=site_url('admin/Category/SaveCat'); ?>" method="post" id="settingForm" >
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['id'])) echo $page['id']; ?>" name="pageid"  > 


	            <fieldset class="fieldset">
	            	
						<legend class="legend">Inputs</legend>

<?php if(isset($page['id'])){ ?>						

			
						<p class="button-height inline-label">
							<label for="validation-required" class="label">Category name</label>
							<input type="text" name="title_en" id="title_en" class="input validate[required]" value="<?php if(isset($page['title_en'])) echo $page['title_en']; ?>" data-tooltip-options='{"position":"right"}' style="text-align:left;direction:ltr" >
						</p>  					
					
<?php }else{ ?>					
						<p class="button-height inline-label">
							<label for="validation-required" class="label">Category Name</label>
							<input type="text" name="title_en[]" id="title_en" class="input validate[required]" value="<?php if(isset($page['title_en'])) echo $page['title_en']; ?>" data-tooltip-options='{"position":"right"}' style="text-align:left;direction:ltr" >
							
<img src="<?=$this->config->item('assets_path')?>/images/plus.png" style="cursor:pointer" id="add_candidates" onclick="add_category();">							
						</p>  

<div id="category" >

</div>                   
<?php } ?>					                  
					
					<p class="button-height inline-label">
						<label class="label" for="input-3">Status</label> 
						<input id="active" name="active" type="radio" value="1" checked="checked" > Active 
						<input id="active" name="active" type="radio" value="0"  <?php if(isset($page['id'])&&$page['active']==0) {  ?>  checked="checked" <?php } ?>> InActive
					</p>
					
					
				<!--	 <p class="button-height inline-label">
               <label  class="label">Image </label>
        
                    <div id="thumbnails_image" style="float:right;width:100%;">
                    <?php
        
                     if(isset($page)&&isset($page['cat_image'])&&$page['cat_image']!='')
                     { 
                    ?>
                          <span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' >
                          <input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='<?php if(isset($page['cat_image'])) echo $page['cat_image'] ?>'  name='ch_image' onclick="showValueImage();" ><img width='20' height='20' src='<?=base_url(); ?>uploads/<?php if(isset($page['cat_image'])) echo $page['cat_image'] ?>'>&nbsp<?php if(isset($page['cat_image'])) echo $page['cat_image'] ?></span>            
                    <?php 
                      }
                    ?>
                </div>
                    <div class="uploadifyQueue" id="fileInput3Queue_image">
                    
                    </div>
                    <div id="imageContainer">
                        <input type="file" name="image" id="uploadify_image"/>     
                    </div>
                    <div id="action_place_image" style="display:block;"></div> 
                    
                    <input type="hidden" name="attached_files_image" id="attached_files_image" value="<?php if(isset($page)&&isset($page['cat_image'])) echo $page['cat_image']; ?>"/>
                    <input type="hidden" name="attached_files_name_image" id="attached_files_name_image" value="<?php //if(isset($page)&&isset($page['city_image'])) echo $page['city_image']; ?>" />
	
	<div id="image_error">  </div>		
              </p>   -->
					
					
					
						<center>		<div class="button-height"><button type="submit" class="button blue-gradient">حفظ</button></div> </center>
					
					 
 					
					</fieldset>


 
 
</form>
 
 
 </div>
 
<div>

</div>



	<script>
	 
		// Form validation
		$('form').validationEngine();

	</script>

<script>
	 
		$().ready(function(){
			$("#uploadify_image").uploadify({
			'uploader'       : '<?=base_url() ?>resources/admin/uploadify/js/uploadify.swf',
			'script'         : '<?=base_url() ?>uploadify.php',
			'cancelImg'      : '<?=base_url() ?>resources/admin/uploadify/images/cancel.png',
			'folder'         : '<?= $this->config->item('folder_name') ?>resources/uploads/files/',
			'auto'           : true,
			'multi'          : false,
			'method'         : 'POST',
			'fileExt'		 : '*.jpeg;*.jpg;|*.bmp;*.gif;*.png',	
			'fileDesc'		 : '*.jpeg;*.jpg;|*.bmp;*.gif;*.png',
			'buttonImg'     : '<?=base_url() ?>resources/admin/uploadify/images/add-filed-old.png',
			'hideButton'	: false,
			'wmode'			: 'transparent',
			'height'		: 22,
			'width'			: 105,
			'scriptData'	:{'filetime': $('#filetime_image').val()},
			onComplete : function(event,queueID,fileObj,response,data) {
				// hide uploade button
					$('#imageContainer').css('display','none');
					
					var fileName=fileObj.name.replace('(','').replace(')','');
					
				    var rname=response;	

					//	var x= fileName.substring(fileName.lastIndexOf("."));	

					//document.getElementById('attached_files_name_image').value=fileName;
					
					document.getElementById('attached_files_image').value=rname;
		

				   var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_image' checked='checked' value='"+rname+"'  name='ch_image' onclick=\"showValueImage();\" ><img width='100' height='100' src='<?=base_url(); ?>uploads/"+rname+"'>"+"&nbsp;"+fileName+"</span>";

				  $('#thumbnails_image').append(p);

			}		
		});	
		
			<?php 
			if(isset($page)&& isset($page['cat_image']) && $page['cat_image']!='' ) 
			{
			?>
				$('#imageContainer').css('display','none');
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
      $("#attached_files_name_image").val('');
	  $('#imageContainer').css('display','block');
    }	
	</script>

	
	<script>
var howMany = 1;	
function add_category(){
howMany += 1;	
$("#category").show();
$("#category").append('	<p class="button-height inline-label" id="cat'+howMany+'"><label for="validation-required" class="label">Category name</label><input type="text" name="title_en[]" id="title_en" class="input validate[required]" data-tooltip-options="{"position":"right"}" style="text-align:left;direction:ltr"><img src="<?=$this->config->item('assets_path')?>design/images/remove.png" style="cursor:pointer" id="add_candidates" onclick="remove_category('+howMany+');">	</p>  ');

}		
		
function remove_category(cat_num){
$("#cat"+cat_num).remove();
}		
</script>
