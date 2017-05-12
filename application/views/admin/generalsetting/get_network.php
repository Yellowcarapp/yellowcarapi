

 <select class="width_size form-control validate[required]" name="networkId" id="networkId" onchange="$('#adminId').val()" > 
    
                          
      <?php for($z=0;$z<count($network);$z++){ ?>
                                    <option value="<?= $network[$z]['network_id'].'_'.$network[$z]['network_admin'] ?>" <?php if(isset($page['networkId'])&& $page['networkId']== $network[$z]['network_id'] ) {  ?> selected="selected" <?php } ?> ><?= $network[$z]['network_name'] ?></option>
                                <?php } ?> 
                      </select>

<?
	if(isset($network[0]['network_id']) && $network[0]['network_id']!='')
	{
		$network = $network[0]['network_id'];
	}
	else
		$network = "";
?>
