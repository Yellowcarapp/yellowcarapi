
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Member List
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
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th><?=lang('E-mail')?>l</th>
                        <th><?=lang('Mobile')?></th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pages as $pages){ ?>    
                      <tr>
                        <td><?=$pages['user_id']?></td>
                        <td><?=$pages['frist_name']?> <?=$pages['last_name']?> </td>
                        <td><?=$pages['email']?> </td>
                        <td><?=$pages['mobile']?> </td>
                       
                       
                        <td><div class="timeline-footer">
                          <a class="btn btn-primary btn-xs" href="<?=base_url('admin/users/MemberDetails/'.$pages['user_id']); ?>"> 
                          <i class="fa fa-pencil"></i> View</a>
                    <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('admin/users/DeleteClient/'.$pages['user_id']); ?>" >
                          <i class="fa fa-trash"></i> Delete</a>
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
        

