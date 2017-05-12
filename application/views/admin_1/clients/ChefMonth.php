<hgroup id="main-title" class="thin">
			<h1>المدن</h1>
</hgroup>

<div class="with-padding">

<div class="right-column">

<div class="standard-tabs margin-bottom" >
  
<form action="<?=site_url('admin/Users/ListChefMonth')?>" method="get" id="settingForm" >
<!--<input type="hidden" size="69" id="pageid" value="<?php //if(isset($page['city_id'])) echo $page['city_id']; ?>" name="pageid"  > -->


	            <fieldset class="fieldset">
	            	
						<legend class="legend">المدن</legend>

					
					      
						<p class="button-height inline-label">
							<label for="validation-required" class="label">الدولة</label>
                            <select name="country_id" id="country_id"  class="select validate[required]" data-tooltip-options='{"position":"right"}' style="width: 150px;" >
                            <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['co_id'] ?>" <?php if(isset($page['city_country_id'])&&$page['city_country_id']== $countries[$z]['co_id'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['co_title_ar'] ?></option>
                            <?php } ?>    
                            </select>
						</p>
						
					
					
					
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

