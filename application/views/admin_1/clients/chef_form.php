<hgroup id="main-title" class="thin">
			<h1>الاعضاء</h1>
</hgroup>
 <div class="with-padding">
<form action="<?=site_url('admin/Users/UpdateChef')?>" method="post" id="settingForm">
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['kit_id'])) echo $page['kit_id']; ?>" name="pageid"  > 
<input type="hidden" size="69" id="country_id" value="<?php if(isset($country_id)) echo $country_id; ?>" name="country_id"  > 


			  	
			  	
			  	<div class="block margin-bottom">

						<h3 class="block-title"></h3>

						<div class="with-padding">
<p>الاسم : <?php if(isset($page['frist_name'])) echo $page['frist_name']; ?>  <?php if(isset($page['last_name'])) echo $page['last_name']; ?> </p>
 							<p>البريد الالكترونى : <?php if(isset($page['email'])) echo $page['email']; ?></p>
 							
 							<p>تاريخ الميلاد : <?php if(isset($page['birth_date'])) echo date("Y-m-d",strtotime($page['birth_date'])); ?></p>

						<p>النوع : <?php if(isset($page['gender']) && $page['gender'] == 1 ) echo "ذكر";
							else echo " انثى ";
							?></p>

 							<p>رقم الهاتف الشخصى : <?php if(isset($page['mobile'])) echo $page['mobile']; ?></p>
							
							<p> الصوره الشخصية 
							<?php if(isset($page['image']) && $page['image'] != ""){ ?>
							<img src="<?=base_url()?>resources/uploads/files/<?=$page['image']?>" />	
							<?php } ?>	
							</p>
							
							
							<p> اسم المطبخ :
							<?php if(isset($page['kit_title']) && $page['kit_title'] != ""){ 
							echo $page['kit_title'];
							 } ?>	
							</p>
							
							<p> تفاصيل المطبخ :
							<?php if(isset($page['kit_detail']) && $page['kit_detail'] != ""){ 
							echo $page['kit_detail'];
							 } ?>	
							</p>
							
							<p> صورة المطبخ :
							<?php if(isset($page['kit_image']) && $page['kit_image'] != ""){ ?>
							<img src="<?=base_url()?>resources/uploads/files/<?=$page['kit_image']?>" />	
							<?php } ?>	
							</p>
							
							 		
<p class="button-height inline-label">
<label class="label" for="input-3">الحاله</label> 
<input id="active" name="active" type="radio" value="1" checked="checked" > فعال
<input id="active" name="active" type="radio" value="0"  <?php if(isset($page['kit_id'])&&$page['kit_active']==0) {  ?>  checked="checked" <?php } ?>> غير فعال
</p>
							 		
<p class="button-height inline-label">
<label class="label" for="input-3">شيف الشهر</label> 
<input id="chef_month" name="chef_month" type="radio" value="0" checked="checked" > لا
<input id="chef_month" name="chef_month" type="radio" value="1"  <?php if(isset($page['kit_chef_month'])&&$page['kit_chef_month']==1) {  ?>  checked="checked" <?php } ?>> نعم
</p>

							
							
 					<div class="button-height">
 					<a href="<?=base_url('admin/users/Members'); ?>" class="button blue-gradient">رجوع</a>
					<button type="submit" class="button blue-gradient">تأكيد</button>	
					<a href="<?=base_url('admin/users/DeleteClient/'.$page['user_id']); ?>" class="button blue-gradient">حذف</a>
					</div> 

						</div>

					</div>


</form>
 </div>
<script>
$(document).ready(function() {	
	 $("form").submit(function() {
       
         if($("#title_en").val()=="" || $("#title_ar").val()==""   ) { 												
				       $("#validatSubDiv").css('display','block');
					   return false;
				  }else{
				       $("#validatSubDiv").css('display','none');
					   $('#settingForm').submit();
				  }
			
    });
});
 
</script>
<div>
