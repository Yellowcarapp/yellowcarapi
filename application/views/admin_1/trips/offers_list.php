
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         <?=lang('offers')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i><?=lang('DashBoard')?></a></li>
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
                  <li class=""><a href="<?=base_url('admin/trips/offerForm')?>"  aria-expanded="false"><?=lang('Add_offer')?></a></li>
                </ul>
                  
                    
                    
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('offerText')?></th>
                        <th><?=lang('Country')?></th>  
                        <th><?=lang('City')?></th>
                       
                        <th><?=lang('Levels')?></th>
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $n=0;foreach($pages as $pages){$n++; ?>    
                      <tr>
                        <td><?=$n?></td>
                        <td><?=$pages['offerText']?></td>
                        <td><? if($pages['countryName_'.lang('db')]!='') echo $pages['countryName_'.lang('db')]; else echo lang('All');?></td>
                        <td><?  if($pages['cityName_'.lang('db')]!='') echo $pages['cityName_'.lang('db')]; else echo lang('All');?></td>  
                     
                        <td><? if($pages['levelName_'.lang('db')]!='') echo $pages['levelName_'.lang('db')]; else echo lang('All');?></td>
                        <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('admin/trips/offerForm/'.$pages['offerId']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('admin/trips/Deleteoffer/'.$pages['offerId']); ?>" >
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
        

