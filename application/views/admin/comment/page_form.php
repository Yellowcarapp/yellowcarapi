
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Comment
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active">Comment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Comment</h3>
<!--
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
-->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                   
<h5>From: <?php if(isset($page['email'])) echo $page['email']; ?> <span class="mailbox-read-time pull-right">
    <?php if(isset($page['com_time'])) echo date("j F. Y g:i A", strtotime($page['com_time']));      ?></span></h5>
                  </div><!-- /.mailbox-read-info -->
<!--
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>
                    </div>
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div>
-->
                  <div class="mailbox-read-message">
                   <h4<?=lang('Name')?>: <?php if(isset($page['frist_name'])) echo $page['frist_name']." "; if(isset($page['last_name'])) echo $page['last_name'];  ?></h4>      
                   <?php if(isset($page['com_message'])) echo $page['com_message']; ?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <a href="<?=site_url('Restaurant/Comments'); ?>" class="btn btn-default"><i class="fa fa-hand-o-left"></i> Back</a>
<!--                    <button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>-->
                  </div>
<a href="<?=site_url('restaurant/DeleteComment/'.$page['com_id']); ?>" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</a>
<?php if(isset($page['com_active']) && $page['com_active'] == 1){
$title= "Hide Comment";
$value= 0;    
}elseif(isset($page['com_active']) && $page['com_active'] == 0){
$title= "Show Comment";
$value= 1;
} ?>                    
<a href="<?=site_url('restaurant/SaveComment/'.$page['com_id'].'/'.$value); ?>" class="btn btn-default"> <?=$title?></a>
                    
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
