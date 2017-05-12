
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?=lang('Cards')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
             <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form action="<?=site_url('Cards/SaveCard')?>" method="post" id="settingForm">

<div class="form-group col-md-3">
                     <label class="full_width"><?=lang('card_num')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="cardNumber" id="cardNumber" value="<?php if(isset($page['cardNumber'])) echo $page['cardNumber'] ?>"/>
                    </div>
    <div class="form-group col-md-3">
                     <label class="full_width"><?=lang('Card_credit')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="cardCredit" id="cardCredit" value="<?php if(isset($page['cardCredit'])) echo $page['cardCredit'] ?>"/>
                    </div>
         <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
 <div class="form-group col-md-4" >
                     <label class="full_width"> <?=lang('File')?></label>  

 <p class="button-height inline-label">
                							
                                              					
                                              
                                                  
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button>    
                                                 
                                            
     <span id="retSpan" ></span>          
    
                							                 
                                      </p>
     </div> 
     <div class="form-group col-md-4" >
                         <label class="full_width"> <?=lang('DownSample')?></label>                              
<a href="<?=base_url()?>down.php?file=Book1.csv"><i class="fa fa-download" ></i></a> 
     </div>
    
               
        
     
     
            <!--  <div class="box-footer center">
                 
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div> -->
    </form> 
                      </div><!-- /.box-body -->
              </div><!-- /.box -->
                

              <div class="box">
                
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?=lang('card_num')?></th>
                        <th><?=lang('Card_credit')?></th>
                    
                      
                        <th><?=lang('Status')?></th>
                        <th><?=lang('Action')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $m=0;
                   foreach($pages as $pages){
                        $m++; ?>    
                      <tr>
                        <td><?=$m?></td>
                        <td><?=$pages['cardNumber']?></td>
                        <td><?=$pages['cardCredit']?></td>
                        
                       
                        <td>
                        <?php if($pages['cardUsed'] >= 1){ ?>
                        <p class="text-green"><?=lang('Used')?></p>
                        <?php }else{ ?>
                        <p class="text-red"><?=lang('not_used')?></p>    
                        <?php } ?>    
                        
                          </td>
                        <td><div class="timeline-footer">
                           
                        <!--  <a class="btn btn-primary btn-xs" href="<?=base_url('cards/cardsForm/'.$pages['cardId']); ?>"> 
                          <i class="fa fa-pencil"></i> <?=lang('Edit')?></a>-->
                           
                            <? if($pages['cardUsed']==0) {?>
                         <a class="btn btn-danger btn-xs jConfirmTwo" href="<?=base_url('cards/Deletecard/'.$pages['cardId']); ?>" >
                          <i class="fa fa-trash"></i> <?=lang('Delete')?></a>
                            <? }?>
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
        
<script>
	 
		$().ready(function(){
               //**********************************************//
            var btnVedio = document.getElementById('uploadBtnImage');
     // attached_files_image = document.getElementById('attached_files_image');
    

  var uploaderVedio = new ss.SimpleUpload({
        button: btnVedio,
        url: '<?= base_url() ?>filesupload.php?upload_dir=./resources/uploads/files/',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        allowedExtensions: ['csv'],
        responseType: 'json',
        updatePosition: function(){
           // alert('sdfsdf');
        },

        startXHR: function() {

          
        },
       /* onSubmit: function() {
            //msgBox.innerHTML = ''; // empty the message box
            btnVedio.innerHTML = 'جاري التحميل'; // change button text to "Uploading..."
          },*/
        onComplete: function( filename, response ) {
          
            if ( !response ) {
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');

                return;
            }
console.log(response)
            if ( response.success == true ) {
                console.log(response.success)
               
              
              //      $('#ImagesDiv').css('display','none');
                    
                  

                    
                   fileName=response.newFileName;

            $('#retSpan').load('<?=site_url('Cards/saveFile')?>',{file:fileName})
              
	              reset_alertify();
				  alertify.success('<?=lang('upload_sucess')?>');

            } else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    reset_alertify();
    				alertify.error( response.msg );


                } else {
                    //msgBox.innerHTML = 'هناك مشكله في عملية الرفع';
                    reset_alertify();
    				alertify.error('<?=lang('uploaderr')?>');
                    
                }
            }
          },
        onError: function(p1,p2,p3,p4,p5) {
            console.log(p1+'-'+p2+'-'+p3+'-'+p4+'-'+p5);
            
                reset_alertify();
				alertify.error('<?=lang('uploaderr')?>');
          },
        onExtError: function( filename, extension )
        {
                reset_alertify();
				alertify.error('<?=lang('upload_exterr')?>');

        }          
          
	}); 
                  
          
        });
</script>
