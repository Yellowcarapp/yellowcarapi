   
                      <select class="width_size form-control validate[required]" name="area_id" id="area_id" > 
                              <?php for($z=0;$z<count($area);$z++){ ?>
                                    <option value="<?= $area[$z]['area_id'] ?>" <?php if(isset($page['area_city_id'])&&$page['area_city_id']== $area[$z]['city_id'] ) {  ?> selected="selected" <?php } ?> ><?= $area[$z]['area_title_en'] ?></option>
                                <?php } ?> 
                      </select>
                    