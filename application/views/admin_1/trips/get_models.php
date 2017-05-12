

   <select class="width_size form-control validate[required]" name="modelId" id="modelId"  > 
                              <?php for($z=0;$z<count($models);$z++){ ?>
                                    <option value="<?= $models[$z]['modelId']?>" <?php if(isset($page['modelId'])&&$page['modelId']== $models[$z]['modelId'] ) {  ?> selected="selected" <?php } ?> ><?= $models[$z]['modelTitle_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
<?
	if(isset($models[0]['modelId']) && $models[0]['modelId']!='')
	{
		$city_id = $models[0]['modelId'];
	}
	else
		$city_id = "";
?>
