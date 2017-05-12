<select name="comm" id="comm" class="form-control width_size">
           <? for($i=0;$i<count($comment);$i++){?>
    <option value="<?=$comment[$i]['acc_com_id']?>"><?=$comment[$i]['acc_com_txt_'.lang('db')]?></option>
    <? }?>
           
           </select>