<select name="shop_id" id="shop_id"  class="select " data-tooltip-options='{"position":"right"}' style="width: 150px;" >
	<?php for($z=0;$z<count($shop);$z++){ ?>
        <option value="<?= $shop[$z]['id'] ?>"  ><?= $shop[$z]['titleAr'] ?></option>
    <?php } ?>    
   
</select>    

<script>
	$().ready(function(){
        if($('#district_id').val()==-1){$('#realestate_district_other').show();}else{$('#realestate_district_other').hide();}
	});
</script>
