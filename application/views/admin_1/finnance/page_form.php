<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper form_driver">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('finnance')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=site_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>


        <!-- Main content -->
        <section class="content">
             <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <form action="<?=site_url('admin/Finnance/SaveFinnance')?>" method="post" id="settingForm">
<input type="hidden" size="69" id="pageid" value="<?php if(isset($page['acc_id']) && $page['acc_id']!='' ) echo $page['acc_id']; ?>" name="pageid"  > 

       
 <div class="form-group col-md-4" >
                     <label class="full_width"> <?=lang('Name')?></label>  

<input type="text"  name="refercode" id="refercode" value="" onchange="getDriverbalance()" />
                    </div> 
     <div class="form-group col-md-4">
         <label id="retBalance"><? 
    if(isset($finnanceMsg)) {
        echo $finnanceMsg; 
        if($finnanceMsg!='0') {
            $url=site_url('admin/finnance/balanceDetails');
            $display='block';
        }else {$url='javascript:void(0)';
               $display='none';
              }}else {$url='javascript:void(0)'; $display='none';}?></label><a id="modal" href="<?=$url?>" style="display:<?=$display?>"><?=lang('Detail')?></a>
     </div>
                 <div class="form-group col-md-4" >
                     <label class="full_width"><?=lang('finnanceMode')?></label>  
<div class="radio">
 
                        <label>
<input type="radio" name="acc_mode" id="acc_mode0" value="0" checked onchange="reloadComment(this.value)"  /> <?=lang('debit')?>
                             
                        </label>
                       <label>
<input type="radio" name="acc_mode" id="acc_mode1" value="1" <? if(isset($page['acc_mode']) && $page['acc_mode']==1) echo "checked";?>  onchange="reloadComment(this.value)" /> <?=lang('credit')?>
                        </label>       
                      
                      </div>
                    </div>   
         <div class="form-group col-md-4" >
                     <label class="full_width"><?=lang('Accvalue')?></label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required,custom[integer]]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="acc_credit" id="acc_credit" value="<?php if(isset($page['acc_value'])) echo $page['acc_value']; else echo '0';?>" />
                    </div> 
       <div class="form-group col-md-4" >
                     <label class="full_width"><?=lang('comment')?></label>
           <span id="commSpan">
<select name="comm" id="comm" class="form-control width_size">
           <? for($i=0;$i<count($comment);$i++){?>
    <option value="<?=$comment[$i]['acc_com_id']?>" <? if(isset($page['acc_com_id']) && $page['acc_com_id']==$comment[$i]['acc_com_id'] ) echo "selected";?>><?=$comment[$i]['acc_com_txt_'.lang('db')]?></option>
    <? }?>
           
           </select></span>
                    </div> 
       <div class="form-group col-md-4" >
                     <label class="full_width"><?=lang('Thecomment')?></label>
           <input type="text" class="form-control width_size" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-driverName="this field is required!"  name="acc_comment" id="acc_comment" value="<?php if(isset($page['acc_comment'])) echo $page['acc_comment']; else echo '0';?>" />
                    </div> 
              <div class="box-footer center">
                 
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div> 
    </form> 
                      </div><!-- /.box-body -->
              </div><!-- /.box -->
                
                 <div class="box ">
                   <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                       
                        <th><?=lang('Date')?></th>
                        <th><?=lang('Name')?></th>
                          <th><?=lang('finnanceMode')?></th>
                          <th><?=lang('Accvalue')?></th>
                          <th><?=lang('comment')?></th>
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $a=0; foreach($pages as $pages){$a++ ?>    
                      <tr>
                        <td><?=$a?></td>
                      
                        <td><?=$pages['accDate'];?></td>
                       <td><?=$pages['driverFName'].' '.$pages['driverLName'];?></td>
                           <td><? if($pages['acc_mode']==0) echo lang('debit'); else echo lang('credit');?></td>
                            <td><?=$pages['acc_value'];?></td>
                          <td><?=$pages['acc_com_txt_'.lang('db')];?></td>
                        <td><div class="timeline-footer">
                            
                          <a class="btn btn-primary btn-xs" href="<?=site_url('admin/finnance/finnanceForm/'.$pages['acc_id']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                            
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=site_url('admin/finnance/delete/'.$pages['acc_id']); ?>" >
                          <i class="fa fa-trash"></i> <?=lang('Delete')?></a>
                            
                        </div>
                       </td>
                      </tr>
                    <?php } ?>    
                        
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!--/.col (right) -->
                 </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
 <span id="retFinn"></span>
<script>
	 
		$().ready(function(){
            // $('#modal').css('display','block')
              $('a#modal').colorbox(); 
          /*    $('#acc_date').datepicker({
      autoclose: true,
                  format: "yyyy-mm-dd"
    });
          *///*************************************************//
            
            $('#refercode').tokenInput("<?=site_url('admin/drivers/getReffer')?>", {
               hintText:'First Name,last Name,mobile Number ,car number'
              ,  tokenLimit: 1
            <? if(isset($page['acc_driver'])){?>
                ,prePopulate:[{id: <?=$page['acc_driver']?>, name: "<?=$page['driverFName'].' '.$page['driverLName']?>"}]
                <?} ?>
           /* , onResult: function (results) {
                    $.each(results, function (index, value) {
                        value.name = "OMG: " + value.name;
                    });

                    return results;
                }*/
            });
        });
        getDriverbalance=function()
        {
           // console.log( $('#refercode').val())
            $('#modal').attr('href','<?=site_url('admin/finnance/balanceDetails')?>'+'/'+$('#refercode').val())
            $('#retFinn').load('<?=site_url('admin/finnance/get_balance')?>',{id:$('#refercode').val()});
        }
        reloadComment=function(val)
        {
            console.log(val);
            
             $('#commSpan').load('<?=site_url('admin/finnance/get_comment')?>',{id:val});
        }
</script>