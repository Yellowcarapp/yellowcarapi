

 <select class="width_size form-control validate[required]" name="cardCurrency" id="cardCurrency"  > 
                         <?php for($z=0;$z<count($currency);$z++){ ?>
                            	<option value="<?= $currency[$z]['curr_id'] ?>" <?php if(isset($page['cardCurrency'])&&$page['cardCurrency']== $currency[$z]['curr_id'] ) {  ?> selected="selected" <?php } ?> ><?= $currency[$z]['curr_name_'.lang('db')].'-'.$currency[$z]['curr_abbr_'.lang('db')] ?></option>
                            <?php } ?>    
                           </select>
<?
	if(isset($currency[0]['cardCurrency']) && $currency[0]['cardCurrency']!='')
	{
		$city_id = $cities[0]['cityId'];
	}
	else
		$city_id = "";
?>
