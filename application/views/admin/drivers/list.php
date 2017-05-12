
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?=lang('Network')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                    
                                    
                <ul class="nav nav-tabs pull-right">
                  <li class=""><a href="<?=base_url('drivers/networkForm')?>"  aria-expanded="false"><?=lang('Add_Network')?></a></li>
                </ul>
                  
                    
                    
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('Name')?></th>
                        <th><?=lang('Country')?></th>  
                        <th><?=lang('Admin')?></th>
                        <th><?=lang('Status')?></th>
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $n=0;foreach($pages as $pages){$n++; ?>    
                      <tr>
                        <td><?=$n?></td>
                        <td><?=$pages['network_name']?></td>
                        <td><?=$pages['countryName_'.lang('db')]?></td>
                        <td><?=$pages['userName']?></td>  
                      <td>
                        <?php if($pages['network_active'] == 1){$sts=lang('Disable'); ?>
                        <p class="text-green"><?=lang('Active')?></p>
                        <?php }else{$sts=lang('enable'); ?>
                        <p class="text-red"><?=lang('Inactive')?></p>    
                        <?php } ?>    
                        
                          </td>
                        <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('drivers/networkForm/'.$pages['network_id']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('drivers/delete/'.$pages['network_id'].'/'.$pages['network_active']); ?>" >
                          <i class="fa fa-trash"></i> <?=$sts?></a>
                        </div>
                       </td>
                      </tr>
                    <?php } ?>    
                        
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        

