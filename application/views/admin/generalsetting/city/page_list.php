
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         <?=lang('All_City')?>
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
                    <? if($country_id!='') $url=base_url('generalsetting/CityForm/cn_'.$country_id);
                    else $url=base_url('generalsetting/CityForm');?>
              <li class=""><a href="<?=$url?>" aria-expanded="false"><?=lang('Add_City')?></a></li>
                </ul>
                  
                    
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('Country')?>  </th>
                        <th><?=lang('City')?></th>
                        <th><?=lang('Status')?></th>
                        <th><?=lang('Action')?></th>
                        <th><?=lang('places')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $m=0;foreach($pages as $pages){ $m++;
                        if($pages['cityId'] > 0){
                        ?>    
                      <tr>
                        <td><?=$m?></td>
                        <td><?=$pages['countryName_'.lang('db')]?></td>
                        <td><?=$pages['cityName_'.lang('db')]?></td>
                        <td>
                        <?php if($pages['cityStatus'] == 1){ $title=lang('Disable');?>
                        <p class="text-green"><?=lang('Active')?></p>
                        <?php }else{ $title=lang('enable');?>
                        <p class="text-red"><?=lang('Inactive')?></p>    
                        <?php } ?>    
                        
                          </td>
                        <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('generalsetting/CityForm/'.$pages['cityId']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('generalsetting/DeleteCity/'.$pages['cityId'].'/'.$pages['cityStatus']); ?>" >
                          <i class="fa fa-trash"></i> <?=$title?></a>
                        </div>
                       </td>
                          
                        <td><div class="timeline-footer">
                         <a class="btn btn-large btn-primary" href="<?=base_url('generalsetting/Allplaces/'.$pages['cityId'])?>">
                      <?=lang('places')?>
                        </a>
                        </div>
                       </td>  
                          
                      </tr>
                    <?php } } ?>    
                        
                     </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        

