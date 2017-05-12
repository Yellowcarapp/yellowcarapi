<hgroup id="main-title" class="thin">
			<h1><?=$pageTitle; ?></h1>
</hgroup>

<div class="with-padding">

<div class="right-column">

<div class="standard-tabs margin-bottom" >
  
<form action="<?=site_url('admin/Members/SaveCat'); ?>" method="post" id="settingForm" >
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['id'])) echo $page['id']; ?>" name="pageid"  > 


	            <fieldset class="fieldset">
	            	
						<legend class="legend">Inputs</legend>

						<p class="button-height inline-label">
							<label for="validation-required" class="label">Title ar</label>
							<input type="text" name="title_ar" id="title_ar" class="input validate[required]" value="<?php if(isset($page['group_name_ar'])) echo $page['group_name_ar']; ?>" data-tooltip-options='{"position":"right"}'>
						</p>
						
						<p class="button-height inline-label">
							<label for="validation-required" class="label">Title En</label>
							<input type="text" name="title_en" id="title_en" class="input validate[required]" value="<?php if(isset($page['group_name_en'])) echo $page['group_name_en']; ?>" data-tooltip-options='{"position":"right"}'>
						</p>



					                         
 				                 

	<p class="button-height inline-label">
						<label class="label" for="input-3">Activity</label> 
						<input id="active" name="active" type="radio" value="1" checked="checked" > Active
						<input id="active" name="active" type="radio" value="0"  <?php if(isset($page['id'])&&$page['status']==0) {  ?>  checked="checked" <?php } ?>>InActive
					</p>
					
		<!-- 1 automatic 2 via email  3 manual  -->			
					
		<p class="button-height inline-label">
						<label class="label" for="input-3">activate_members</label> 
						<input id="activate_members" name="activate_members" type="radio" value="1" checked="checked" > Automatic
						<input id="activate_members" name="activate_members" type="radio" value="2"  <?php if(isset($page['id'])&&$page['activate_members']==2) {  ?>  checked="checked" <?php } ?>> Via Email
						<input id="activate_members" name="activate_members" type="radio" value="3"  <?php if(isset($page['id'])&&$page['activate_members']==3) {  ?>  checked="checked" <?php } ?>> Manual By Admin
	 
	  </p>				
					
					<p class="button-height inline-label">
						<label class="label" for="input-3">Default Group</label> 
 						<input id="defaultgroup" name="defaultgroup" type="checkbox" value="1"  <?php if(isset($page['id'])&&$page['status']==1) {  ?>  checked="checked" <?php } ?>>
					</p>
					
 <span style="display: none;"> 
 	
 	<p class="button-height inline-label">
						<label class="label" for="input-3"> Image </label>
						<input type="text" onclick="openKCFinder(this)" id="image"   name="image"  value="<?php if(isset($page['image'])) echo $page['image']; ?>" style="cursor:pointer;width:50%;" class="input" />
						<span  id="imageSpan"    style="display: <?php if(isset($page['image']) &&  $page['image']!='') { ?>block; <?php } else { ?>none; <?php } ?> width:80px;" >
						 <a href="<?=base_url(); ?>resources/uploads/<?php if(isset($page['image'])) echo $page['image']; ?>"  id="imageLink" target="_blank" >View</a> 
						 &nbsp; &nbsp; 
						 <a href="#" onclick="$('#image').val('');$('#imageSpan').css('display','none');return false;" target="_blank"  >Clear</a> 
						</span>
						
						<div id="kcfinder_div"></div>
					</p> 
					
<p class="button-height inline-label">
<label class="label" for="input-3"> التكلفه </label>
     <select  id="cost" name="cost"  class="select"  style="width: 200px;"  >
     <?php for($i=0;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['cost'])&&$page['cost']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
      DK
</p>       

<p class="button-height inline-label">
<label class="label" for="input-3"> عدد الاعلانات </label>
     <select  id="max_add_product" name="max_add_product"  class="select"  style="width: 200px;"  >
     <?php for($i=1;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['max_add_product'])&&$page['max_add_product']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
 
</p>   	

<p class="button-height inline-label">
<label class="label" for="input-3"> مده الاعلان </label>
     <select  id="max_add_product_period" name="max_add_product_period"  class="select"  style="width: 200px;"  >
     	<option value="3650"  >0</option>
     <?php for($i=1;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['max_add_product_period'])&&$page['max_add_product_period']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
 <span style="direction: rtl;">  ( يوم ( 0 تعني دائم    </span>  
</p>   
	

<p class="button-height inline-label">
<label class="label" for="input-3">  عدد الاعلانات المميزه   </label>
     <select  id="max_add_product_special" name="max_add_product_special"  class="select"  style="width: 200px;"  >
     <?php for($i=0;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['max_add_product_special'])&&$page['max_add_product_special']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
       
</p>  



<p class="button-height inline-label">
<label class="label" for="input-3"> المميز مده الاعلان </label>
     <select  id="max_add_product_special_period" name="max_add_product_special_period"  class="select"  style="width: 200px;"  >
     	<option value="3650"  >0</option>
     <?php for($i=1;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['max_add_product_special_period'])&&$page['max_add_product_special_period']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
 <span style="direction: rtl;">  ( يوم ( 0 تعني دائم    </span>  
</p>   
	

<p class="button-height inline-label">
<label class="label" for="input-3"> عدد الصور </label>
     <select  id="max_img_upload_for_product" name="max_img_upload_for_product"  class="select"  style="width: 200px;"  >
     <?php for($i=1;$i<500;$i++) { ?>
             <option value="<?=$i ?>"  <?php if(isset($page['max_img_upload_for_product'])&&$page['max_img_upload_for_product']==$i) {  ?> selected="selected" <?php } ?>> <?=$i ?>  </option>  
    <?php } ?>
      </select> 
       
</p>           
                 
		</span>			                  
				
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

