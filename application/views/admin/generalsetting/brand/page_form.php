      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Models')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('Generalsetting/SaveModel')?>" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['modelId'])) echo $page['modelId'] ?>" />                                
   
      <div class="form-group">
                      <label> <?=lang('Brands')?></label>
                      <select class="width_size form-control validate[required]" name="brandId" id="brandId" > 
                         <?php for($z=0;$z<count($cats);$z++){ ?>
                            	<option value="<?= $cats[$z]['brandId'] ?>" <?php if(isset($page['brandId'])&&$page['brandId']== $cats[$z]['brandId'] ) {  ?> selected="selected" <?php } ?> ><?= $cats[$z]['brandName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
                      <div class="form-group">
                     <label class="full_width"> <?=lang('NameInAr')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="modelTitle_ar" id="modelTitle_ar" value="<?php if(isset($page['modelTitle_ar'])) echo $page['modelTitle_ar'] ?>" />
                    </div>
   
    <div class="form-group">
                     <label class="full_width"> <?=lang('NameInEn')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="modelTitle_en" id="modelTitle_en" value="<?php if(isset($page['modelTitle_en'])) echo $page['modelTitle_en'] ?>" />
                    </div>
    
    <div class="form-group">
                     <label class="full_width"> <?=lang('NameInUr')?>  </label>  

                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="modelTitle_ur" id="modelTitle_ur" value="<?php if(isset($page['modelTitle_ur'])) echo $page['modelTitle_ur'] ?>" />
                    </div>
        
    
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"> <?=lang('Status')?></label>      
                     
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="modelStatus" id="optionsRadios2" value="1" <?php if(isset($page['modelId']) && $page['modelStatus'] == 1) echo "checked" ?>  />
                         <?=lang('Active')?>
                        </label>
                      </div>
                    
                    </div>
                    
    
               
    
                      
                      
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"> <?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->




