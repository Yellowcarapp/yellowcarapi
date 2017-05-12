      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Packages')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
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
<form role="form" action="<?=site_url('admin/Generalsetting/Savepackage')?>" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['packageId'])) echo $page['packageId'] ?>" />                                          <div class="form-group">
                     <label class="full_width"> <?=lang('NameInAr')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="packageName_ar" id="packageName_ar" value="<?php if(isset($page['packageName_ar'])) echo $page['packageName_ar'] ?>"/>
                    </div>
           <div class="form-group">
                     <label class="full_width"> <?=lang('NameInEn')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="packageName_en" id="packageName_en" value="<?php if(isset($page['packageName_en'])) echo $page['packageName_en'] ?>"/>
                    </div>
           <div class="form-group">
                     <label class="full_width"> <?=lang('NameInUr')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="packageName_ur" id="packageName_ur" value="<?php if(isset($page['packageName_ur'])) echo $page['packageName_ur'] ?>"/>
                    </div>
    
                     
                   
    
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"><?=lang('Status')?></label>      
                 
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="packageStatus" id="optionsRadios2" value="1" <?php if(isset($page['packageId']) && $page['packageStatus'] == 1) echo "checked" ?>  />
                        <?=lang('Active')?>
                        </label>
                      </div>
                    
                    </div>
                    
                      
                      
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 
		