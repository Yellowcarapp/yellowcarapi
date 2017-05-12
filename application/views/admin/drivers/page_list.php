
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?=lang('Drivers')?>
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
                  <li class=""><a href="<?=base_url('drivers/driverForm')?>"  aria-expanded="false"><?=lang('Add_driver')?></a></li>
                </ul>
                  
                    
                    
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('Name')?></th>
                           <th><?=lang('Network')?></th>
                        <th><?=lang('Mobile')?></th>  
                        <th><?=lang('E-mail')?></th>
                           <th><?=lang('Rate')?></th>
                        <th> <?=lang('Status')?></th>
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $n=0;foreach($pages as $pages){$n++; ?>    
                      <tr>
                        <td><?=$n?></td>
                        <td><?=$pages['driverFName'].' '.$pages['driverLName']?></td>
                           <td><?=$pages['network_name']?></td>
                        <td><?=$pages['driverMobile']?></td>
                        <td><?=$pages['driverEmail']?></td>  
                           <td><?=$pages['driverRate']?></td>  
                          <td>
                      <? if($pages['driverActivation']==0){ echo lang('new') .'!'; } else echo lang('Active');?>
                          </td>
                        <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('drivers/driverForm/'.$pages['driverId']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                           <?  if($pages['debitVal']==$pages['creditVal'] && $pages['debitVal']==0){?>
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('drivers/DeleteDriver/'.$pages['driverId']); ?>" >
                          <i class="fa fa-trash"></i> <?=lang('Delete')?></a>
                            <? }?>
                             <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('drivers/driverEmpty/'.$pages['driverId']); ?>"> 
                          <i class="fa fa-pencil"></i><?=lang('emptyUid')?></a>
                            <a class="btn btn-primary btn-xs" href="<?=base_url('drivers/driverComment/'.$pages['driverId']); ?>"> 
                          <i class="fa fa-comment"></i> <?=lang('D_comment')?></a>
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
        

