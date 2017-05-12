
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?=lang('Drivers')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
               <li><a href="<?=site_url('admin/Drivers/driverList')?>"><i class="fa fa-dashboard"></i> <?=lang('Drivers')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                    
                                    
          <!--      <ul class="nav nav-tabs pull-right">
                  <li class=""><a href="<?=base_url('admin/drivers/driverForm')?>"  aria-expanded="false"><?=lang('Add_driver')?></a></li>
                </ul>
                  -->
                    
                    
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('Passenger')?></th>
                        <th><?=lang('Date')?></th>  
                        <th><?=lang('Country')?></th>
                           <th><?=lang('City')?></th>
                        <th> <?=lang('D_comment')?></th>
                      <!--  <th><?=lang('Action')?></th>-->
                      </tr>
                    </thead>
                    <tbody>
                    <?php $n=0;foreach($pages as $pages){$n++; ?>    
                      <tr>
                        <td><?=$n?></td>
                        <td><?=$pages['passengerName']?></td>
                        <td><?=$pages['tripCreateDate']?></td>
                        <td><?=$pages['countryName_'.lang('db')]?></td>  
                           <td><?=$pages['cityName_'.lang('db')]?></td>  
                          
                              <td><?=$pages['tripLeaveComment']?></td>  
                          
                      <!--  <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('admin/drivers/driverForm/'.$pages['tripId']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                        
                        </div>
                       </td>-->
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
        

