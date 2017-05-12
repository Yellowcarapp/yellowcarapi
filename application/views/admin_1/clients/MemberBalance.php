

<hgroup id="main-title" class="thin">
			<h1><?=$pageTitle?></h1>
</hgroup>

<div class="with-padding">

<div class="right-column">

<div class="standard-tabs margin-bottom" >
  
<form action="<?=site_url('admin/Users/SaveBalance'); ?>" method="post" id="settingForm" >
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['userId'])) echo $page['userId']; ?>" name="pageid"  > 
<input type="hidden" size="69" id="user_point" value="<?php if(isset($page['point'])) echo $page['point']; ?>" name="user_point"  > 
<input type="hidden" size="69" id="purchase_money" value="<?php if(isset($page['purchase_money'])) echo $page['purchase_money']; ?>" name="purchase_money"  > 
<input type="hidden" size="69" id="remind_balance" value="<?php if(isset($pages['remind_balance'])) echo $pages['remind_balance']; ?>" name="remind_balance"  > 


	            <fieldset class="fieldset">
	            	
						<legend class="legend">رصيد ملاك</legend>

					
<p class="button-height inline-label">
<p>الاسم : <?php if(isset($page['fristName'])) echo $page['fristName']; ?>  <?php if(isset($page['lastName'])) echo $page['lastName']; ?></p>
</p>
				
					
			
					
<p class="button-height inline-label">
    <label for="validation-required" class="label">نقاط العضو</label>
    
<select name="point" id="point"  class="select " data-tooltip-options='{"position":"right"}' style="width: 150px;"  >
<option value="<?= $page['point'] ?>" ><?= $page['point'] ?></option>
         
             
        </select>
    </span>     
   

</p>
				
		
				
		
				<p class="button-height inline-label">
<label for="validation-required" class="label">الرصيد المضاف</label>	   
<input type="number" id="balance" class="input validate[required]" name="balance" 
value="<?php if(isset($page['price'])) echo $page['price']; ?>">
</p>
					
		

						<center>		<div class="button-height"><button type="submit" class="button blue-gradient">حفظ</button></div> </center>
					
					 
 					
					</fieldset>


 
 
</form>
 
 
 </div>
 
<div>

</div>



	<script>
	 
	$('form').validationEngine();

		

</script>	