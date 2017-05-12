<hgroup id="main-title" class="thin">
			<h1>الاعضاء</h1>
</hgroup>
 <div class="with-padding">
<form action="<?=site_url('admin/Users/EditClient'); ?>" method="post" id="settingForm">
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['userId'])) echo $page['userId']; ?>" name="pageid"  > 
<input type="hidden" size="69" id="addressid" value="<?php if(isset($pages['add_id'])) echo $pages['add_id']; ?>" name="addressid"  > 
<input type="hidden" size="69" id="product_id" value="<?php if(isset($product_id)) echo $product_id; ?>" name="product_id"  > 


			  	
			  	
			  	<div class="block margin-bottom">

						<h3 class="block-title"></h3>

						<div class="with-padding">
<p>الاسم : <?php if(isset($page['fristName'])) echo $page['fristName']; ?>  <?php if(isset($page['lastName'])) echo $page['lastName']; ?> </p>
 							<p>البريد الالكترونى : <?php if(isset($page['email'])) echo $page['email']; ?></p>
 							
 							<p>تاريخ الميلاد : <?php if(isset($page['birthDate'])) echo date("Y-m-d",strtotime($page['birthDate'])); ?></p>

						<p>النوع : <?php if(isset($page['gander']) && $page['gander'] == 1 ) echo "ذكر";
							else echo " انثى ";
							?></p>

<?php if(isset($pages['add_name']) && !empty($pages['add_name'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">العنوان</label>
<input type="text" name="add_name" id="add_name" class="input full-width" value="<?php  echo $pages['add_name']; ?>" data-tooltip-options='{"position":"right"}'>
</p>
<?php } ?>

<?php if(isset($pages['add_city']) && !empty($pages['add_city'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">المدينة</label>
<input type="text" name="city_title" id="city_title" class="input full-width" value="<?php  echo $pages['city_title']; ?>" data-tooltip-options='{"position":"right"}'>
</p>
<?php } ?>

<?php if(isset($pages['add_street_no']) && !empty($pages['add_street_no'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">الشارع</label>
<input type="text" name="add_street_no" id="add_street_no" class="input full-width" value="<?php  echo $pages['add_street_no']; ?>" data-tooltip-options='{"position":"right"}'>
</p>
<?php } ?>
							
<?php if(isset($pages['add_judda']) && !empty($pages['add_judda'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">الجادة</label>
<input type="text" name="add_judda" id="add_judda" class="input full-width" value="<?php  echo $pages['add_judda']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							

<?php } ?>
							
<?php if(isset($pages['add_block']) && !empty($pages['add_block'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">قطعة</label>
<input type="text" name="add_block" id="add_block" class="input full-width" value="<?php  echo $pages['add_block']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
<?php } ?>
							
<?php if(isset($pages['add_mobile']) && !empty($pages['add_mobile'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">رقم الموبيل</label>
<input type="text" name="add_mobile" id="add_mobile" class="input full-width" value="<?php  echo $pages['add_mobile']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							

<?php } ?>
							
<?php if(isset($pages['add_extra_direction']) && !empty($pages['add_extra_direction'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">ارشادات اضافية</label>
<textarea name="add_extra_direction" id="add_extra_direction" class="input full-width"  data-tooltip-options='{"position":"right"}'>
<?php  echo $pages['add_extra_direction']; ?>
</textarea>	
</p>							
							
<?php } ?>
							
<?php if(isset($pages['add_street']) && !empty($pages['add_street'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">الشارع</label>
<input type="text" name="add_street" id="add_street" class="input full-width" value="<?php  echo $pages['add_street']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
<?php } ?>
<?php if(isset($pages['add_house_name']) && !empty($pages['add_house_name'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">المنزل</label>
<input type="text" name="add_house_name" id="add_house_name" class="input full-width" value="<?php  echo $pages['add_house_name']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
<?php } ?>
							
<?php if(isset($pages['add_home_phone']) && !empty($pages['add_home_phone'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">رقم هاتف المنزل</label>
<input type="text" name="add_home_phone" id="add_home_phone" class="input full-width" value="<?php  echo $pages['add_home_phone']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
<?php } ?>
							
<?php if(isset($pages['add_apartment']) && !empty($pages['add_apartment'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">الشقة</label>
<input type="text" name="add_apartment" id="add_apartment" class="input full-width" value="<?php  echo $pages['add_apartment']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
							
<?php } ?>
<?php if(isset($pages['add_floor']) && !empty($pages['add_floor'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">الطابق</label>
<input type="text" name="add_floor" id="add_floor" class="input full-width" value="<?php  echo $pages['add_floor']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
<?php } ?>

<?php if(isset($pages['add_buliding_name']) && !empty($pages['add_buliding_name'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">البناية</label>
<input type="text" name="add_buliding_name" id="add_buliding_name" class="input full-width" value="<?php  echo $pages['add_buliding_name']; ?>" data-tooltip-options='{"position":"right"}'>
</p>							
<?php } ?>

<?php if(isset($pages['add_office_name']) && !empty($pages['add_office_name'])){ ?>
<p class="button-height inline-label">
<label for="validation-required" class="label">المكتب</label>
<input type="text" name="add_office_name" id="add_office_name" class="input full-width" value="<?php  echo $pages['add_office_name']; ?>" data-tooltip-options='{"position":"right"}'>
</p>
<?php } ?>
							
<center><div class="button-height"><button type="submit" class="button blue-gradient">حفظ</button></div> </center>

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
	
	var editor = CKEDITOR.replace( 'add_extra_direction',
				{
					// Defines a simpler toolbar to be used in this sample.
					// Note that we have added out "MyButton" button here.
					toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['newplugin'] , ['FontSize' ] , [ 'TextColor', 'BGColor' ] ]

				});
CKEDITOR.config.contentsLangDirection = 'rtl';


}

</script>		
	