      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?=lang('Profile')?>
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
<form role="form" action="<?=site_url('Passengers/Save'); ?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" size="69" id="id" value="<?php if(isset($page['userId'])) echo $page['userId']; ?>" name="id"  > 
<input type="hidden" size="69" id="fun" value="<?=$this->uri->segment(3)?>" name="fun"  >     
    
    
  <?php if($this->session->flashdata('success') ==1){ ?>
    <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Message!</h4>
                    Success Editing Your Profile.
                  </div>    
  <?php } ?>    
    
  
<?php if($this->session->flashdata('emailExist')==1) { ?>	 
 <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Message!</h4>
                   Error. This email address aleardy exist , please choose another email.
                  </div>
<?php } ?> 
 
<div>

    
   <!-- <div class="form-group">
                     <label class="full_width">Name</label>  
<input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"id="userName" value="<?php if(isset($page['userName'])) echo $page['userName']; ?>" name="userName"/>
                    </div>
    -->
    
                      <div class="form-group">
                     <label class="full_width"><?=lang('UserName')?> (<?=lang('LoginName')?>) </label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  id="userName" value="<?php if(isset($page['userName'])) echo $page['userName']; ?>" name="userName" />
                    </div>
                      
               <label class="full_width"><?=lang('E-mail')?> </label> 
                      <div class="form-group input-group">
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span>      
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="email" class="form-control width_size" data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="this field is required!"  id="userEmail" value="<?php if(isset($page['userEmail'])) echo $page['userEmail']; ?>" name="userEmail" />
                    </div>
                      
                <div class="form-group">
                     <label class="full_width"><?=lang('TimeZone')?></label>  
                           <select class="width_size form-control validate[required]" name="timeZone" id="timeZone"  > 
                         <?php for($z=0;$z<count($TimeZoneArr);$z++){ ?>
                            	<option value="<?= $TimeZoneArr[$z]['id'] ?>" <?php if(isset($page['timeZone'])&&$page['timeZone']== $TimeZoneArr[$z]['id'] ) {  ?> selected="selected" <?php }else {} ?> ><?= $TimeZoneArr[$z]['val'] ?></option>
                            <?php } ?>    
                           </select>
                        <? //echo timezone_menu('UM8');?>
                    </div>  
    
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width radio_checkbox">Change Password</label>      
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="ChangePassword" id="optionsRadios1" value="1" >
                          
                        </label>
                      </div>
                    </div>
                  
    
        <div class="form-group">
                     <label class="full_width"><?=lang('Password')?> </label>  

                      <input type="password" class="form-control width_size"  id="password" value="" name="password"  />
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
