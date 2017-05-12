      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            MainPage Setting
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active">MainPage Setting</li>
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
                  <h3 class="box-title">MainPage Setting</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('Page/SaveHomePage'); ?>" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['co_id'])) echo $page['co_id'] ?>" />                                          <div class="form-group">
                     <label class="full_width"> مقدمة كلمة الترحيب</label>  
<input type="text" class="form-control arabic" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="home_welcome_title_ar" id="home_welcome_title_ar" value="<?php if(isset($page['home_welcome_title_ar'])) echo $page['home_welcome_title_ar']; ?>"/>
                    </div>
    
    
                      <div class="form-group">
                     <label class="full_width">Welcome Title</label>  

                      <input type="text" class="form-control" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="home_welcome_title_en" id="home_welcome_title_en" value="<?php if(isset($page['home_welcome_title_en'])) echo $page['home_welcome_title_en']; ?>" />
                    </div>
    
    
    
                      
                       <div class="form-group">
                     <label class="full_width">كلمات دلالية  </label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" class="form-control arabic" rows="3"  id="keywords_ar" name="keywords_ar" >
<?php if(isset($seo['keywords_ar'])) echo $seo['keywords_ar']; ?>                          
                          </textarea> 
                    </div>
                      
    
                      <div class="form-group">
                     <label class="full_width">keywords</label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  class="form-control" rows="3"   id="keywords_en" name="keywords_en" >
                          <?php if(isset($seo['keywords_en'])) echo $seo['keywords_en']; ?>
                          </textarea> 
                    </div>
    
    
    
                      
                       <div class="form-group">
                     <label class="full_width">وصف    </label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  class="form-control arabic" rows="3"   id="desc_ar" name="desc_ar" >
<?php if(isset($seo['desc_ar'])) echo $seo['desc_ar']; ?>
                          </textarea> 
                    </div>
                      
    
    
    
                       <div class="form-group">
                     <label class="full_width">Description</label>  

<textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  class="form-control" rows="3"  id="desc_en" name="desc_en" >
    <?php if(isset($seo['desc_en'])) echo $seo['desc_en']; ?>
    </textarea>
                    </div>
               
      <div class="form-group">
                     <label class="full_width">Resturant Ordering </label>  
      <div class="checkbox">
                        <label>
<input type="radio" name="order" id="optionsRadios1" value="1" <?php if(isset($page['resturant_order']) && $page['resturant_order'] == 1) echo "checked" ?>  />
                         Descending
                        </label>
           <label>
<input type="radio" name="order" id="optionsRadios1" value="0" <?php if(isset($page['resturant_order']) && $page['resturant_order'] == 0) echo "checked" ?>  />
                         Alphabatic
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



 