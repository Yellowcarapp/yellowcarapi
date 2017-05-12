      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Members
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
<form role="form" action="" method="post" name="formID" class="formID" id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['user_id'])) echo $page['user_id'] ?>" />                                
    <div class="form-group">
                     <label class="full_width">Full Name</label>  
<input type="text" class="form-control width_size " readonly name="title_ar" id="title_ar" value="<?php if(isset($page['first_name'])) echo $page['first_name'] ?> <?php if(isset($page['last_name'])) echo $page['last_name'] ?> "/>
                    </div>
    
    
                               
    <div class="form-group">
                     <label class="full_width">E-mail</label>  
<input type="text" class="form-control width_size" readonly  name="title_ar" id="title_ar" value="<?php if(isset($page['email'])) echo $page['email'] ?>"/>
                    </div>
    
    
                               
    <div class="form-group">
                     <label class="full_width"><?=lang('Mobile')?></label>  
<input type="text" class="form-control width_size" readonly  name="title_ar" id="title_ar" value="<?php if(isset($page['mobile'])) echo $page['mobile'] ?>"/>
                    </div>
    
    
             
                      
                      
                  <div class="box-footer">
<!--                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>-->
<a href="<?=base_url('admin/users/DeleteClient/'.$page['user_id']); ?>" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</a>
<a class="btn btn-default" href="<?=base_url('admin/users/Members'); ?>"> <i class="fa fa-hand-o-left"></i> Back</a>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
