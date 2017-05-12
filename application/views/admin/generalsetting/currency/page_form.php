
<form role="form" action="" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageId" value="<?php if(isset($page['curr_id'])) echo $page['curr_id'] ?>" />                                          <div class="form-group">
                     <label class="full_width"> <?=lang('NameInAr')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="curr_name_ar" id="curr_name_ar" value="<?php if(isset($page['curr_name_ar'])) echo $page['curr_name_ar'] ?>"/>
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('abbrInAr')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="curr_abbr_ar" id="curr_abbr_ar" value="<?php if(isset($page['curr_abbr_ar'])) echo $page['curr_abbr_ar'] ?>" />
                    </div>
                               <div class="form-group">
                     <label class="full_width"> <?=lang('NameInEn')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="curr_name_en" id="curr_name_en" value="<?php if(isset($page['curr_name_en'])) echo $page['curr_name_en'] ?>"/>
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('abbrInEn')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="curr_abbr_en" id="curr_abbr_en" value="<?php if(isset($page['curr_abbr_en'])) echo $page['curr_abbr_en'] ?>" />
                    </div>
    
             <div class="form-group">
                     <label class="full_width"> <?=lang('NameInUr')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="curr_name_ur" id="curr_name_ur" value="<?php if(isset($page['curr_name_ur'])) echo $page['curr_name_ur'] ?>"/>
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('abbrInUr')?> </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="curr_abbr_ur" id="curr_abbr_ur" value="<?php if(isset($page['curr_abbr_ur'])) echo $page['curr_abbr_ur'] ?>" />
                    </div>
                    
    <!---->
                   
                   
                
                      
                  <div class="box-footer center"><span id="return"></span>
                    <button type="button" onclick="$('#return').load('<?=site_url('Generalsetting/SaveCurrency')?>',{pageid:$('#pageId').val(),curr_name_ar:$('#curr_name_ar').val(),curr_abbr_ar:$('#curr_abbr_ar').val(),curr_name_en:$('#curr_name_en').val(),curr_abbr_en:$('#curr_abbr_en').val(),curr_name_ur:$('#curr_name_ur').val(),curr_abbr_ur:$('#curr_abbr_ur').val()})" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
                  </form>
               
		