
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         <?=lang('Pages')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
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
                  <li class=""><a href="<?=base_url('page/PageForm')?>" aria-expanded="false"><?=lang('Add_page')?></a></li>
                </ul>
                  
                    
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('Title')?></th>
                        
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $m=0; foreach($pages as $pages){$m++;
                        if($pages['pageId'] > 0){
                        ?>    
                      <tr>
                          <td><?=$m?></td>
                        <td><?=$pages['title_'.lang('db')]?></td>
                        
                      
                        <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('page/PageForm/'.$pages['pageId']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
<a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('page/DeletePage/'.$pages['pageId']); ?>" >
                          <i class="fa fa-trash"></i> <?=lang('Delete')?></a>
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
        

