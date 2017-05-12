
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?=lang('finnance')?>
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
                  <li class=""><a href="<?=base_url('finnance/finnanceForm')?>"  aria-expanded="false"><?=lang('Add_finnance')?></a></li>
                </ul>
                  
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                       
                        <th><?=lang('Date')?></th>
                        <th><?=lang('Name')?></th>
                          <th><?=lang('debit')?></th>
                          <th><?=lang('credit')?></th>
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $a=0; foreach($pages as $pages){$a++ ?>    
                      <tr>
                        <td><?=$a?></td>
                      
                        <td><?=$pages['acc_date'];?></td>
                       <td><?=$pages['driverFName'].' '.$pages['driverLName'];?></td>
                           <td><?=$pages['acc_debit'];?></td>
                            <td><?=$pages['acc_credit'];?></td>
                        <td><div class="timeline-footer">
                            
                          <a class="btn btn-primary btn-xs" href="<?=base_url('finnance/finnanceForm/'.$pages['acc_id']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                            
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('finnance/delete/'.$pages['acc_id']); ?>" >
                          <i class="fa fa-trash"></i> <?=lang('Delete')?></a>
                            
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
        

