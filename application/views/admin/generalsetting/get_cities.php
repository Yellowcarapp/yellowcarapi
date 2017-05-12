

 <select class="width_size form-control validate[required]" name="cityId" id="cityId" > 
    
                              <?php for($z=0;$z<count($cities);$z++){ ?>
                                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['cityId'])&&$page['cityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>

<?
	if(isset($cities[0]['cityId']) && $cities[0]['cityId']!='')
	{
		$city_id = $cities[0]['cityId'];
	}
	else
		$city_id = "";
?>
