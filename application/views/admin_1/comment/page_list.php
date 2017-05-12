
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Comments
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>
  <? $priv=explode(',',$this->session->userdata("priv"));?>

                                
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Restaurant Name</th>
                        <th>Client Name</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pages as $pages){ ?>    
                      <tr>
                        <td><?=$pages['com_id']?></td>
                        <td><?=$pages['kit_title_en']?></td>
                        <td><?=$pages['frist_name']?> <?=$pages['last_name']?></td>
                        <td><?=$pages['com_message']?></td>
                        <td><?=date("Y-m-d",strtotime($pages['com_time']));?></td>
                        <td>
                        <?php if($pages['com_active'] == 1){ ?>
                        <p class="text-green"><?=lang('Active')?></p>
                        <?php }else{ ?>
                        <p class="text-red"><?=lang('Inactive')?></p>    
                        <?php } ?>    
                        
                          </td>
                        <td><div class="timeline-footer">
                              <? if(in_array(-1,$priv) || in_array(91,$priv)){?> 
                          <a class="btn btn-primary btn-xs" href="<?=base_url('admin/restaurant/CommentDetails/'.$pages['com_id']); ?>"> 
                          <i class="fa fa-pencil"></i> View</a>
                            <? }?>
                              <? if(in_array(-1,$priv) || in_array(92,$priv)){?> 
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('admin/restaurant/DeleteComment/'.$pages['com_id']); ?>" >
                          <i class="fa fa-trash"></i> Delete</a>
                            <? }?>
                        </div>
                       </td>
                      </tr>
                    <?php } ?>    
                        
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        

