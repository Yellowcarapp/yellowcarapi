
  

   
<p class="button-height inline-label">
<label class="label" for="input-3">Activity</label> 
<input id="active" name="active" type="radio" value="1" checked="checked" > Active
<input id="active" name="active" type="radio" value="0"  <?php if(isset($page['id'])&&$page['active']==0) {  ?>  checked="checked" <?php } ?>>InActive
</p>

<p class="button-height inline-label">
<label class="label" for="input-3">Parrent</label> 
     <select  id="parrent_id" name="parrent_id"   class="select"  >
            <option value="0"> No Parrent </option>  
			   <?php foreach($pages as $pagesa) { ?>
                <option value="<?=$pagesa['id'] ?>" <?php if(isset($page['parrent_id'])&&$page['parrent_id']==$pagesa['id']) {  ?> selected="selected" <?php } ?>> <?=$pagesa['title_'.lang('lang')]; ?> </option>
               <?php } ?>
                       
                                   
     </select> 
</p>      
