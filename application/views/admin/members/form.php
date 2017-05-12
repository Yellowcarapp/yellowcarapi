      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('Users')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
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
<form role="form" action="<?=site_url('users/Save')?>" method="post" name="formID"  id="formID">
                     <input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['userId'])) echo $page['userId'] ?>" />  
    <?php if($this->session->flashdata('emailExist')==1) { ?>	 
 <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-ban"></i> Message!</h4>
                    Error Data Already exist.
                  </div>    
<?php  } ?> 
<div class="form-group">
                     <label class="full_width"><?=lang('Name')?></label>  
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="userName" id="userName" value="<?php if(isset($page['userName'])) echo $page['userName'] ?>"/>
                    </div>
    <?  ?>
    <? if($network==-1){?>
    <div class="form-group">
                     <label class="full_width"><?=lang('Network')?></label> 
        <? if(!isset($page) || (isset($page) && ($page['job']==2 || $page['job']==3)) ){?> 
<select name="networkID" id="networkId" class="form-control width_size" onchange="reloadPrivillage(this.value)">
        <option value="-1" <?php if(isset($page['network'])&& $page['network']==-1) echo "selected"; ?>><?=lang('publicUser')?></option>
        <? for($i=0;$i<count($networkList);$i++){?>
    <option value="<?=$networkList[$i]['network_id']?>" <?php if(isset($page['network'])&& $page['network']==$networkList[$i]['network_id']) echo "selected"; ?>><?=$networkList[$i]['network_name']?></option>
    <?}?>
        
        </select>
        <? }else { $networkName=''; for($i=0;$i<count($networkList);$i++){
    if($page['network']==$networkList[$i]['network_id'])$networkName=$networkList[$i]['network_name'];
}?>
        <label class="full_width"><? if($networkName!='')echo $networkName; else echo lang('Inactive').' '.lang('Network'); ?>    </label> 
        <input type="hidden"  name="networkID" id="networkId" value="<?=$page['network']?>">
       <? }?>
                    </div>
     <? }?>
                      <div class="form-group">
                     <label class="full_width"><?=lang('E-mail')?> </label>  
  <div class="form-group input-group">
      <?php if(isset($page['userId'])) $val='ajax[ajaxUserEmail]'; else $val='ajax[ajaxUserEmail2]'; ?>
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span>      
<!--<label class="control-label error_label hidden_error" for="inputError"><i class="fa fa-times-circle-o"></i> This field is required</label>-->
                      <input type="email" class="form-control width_size" data-validation-engine="validate[required,custom[email],<?=$val?>]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="this field is required!"  id="userEmail" value="<?php if(isset($page['userEmail'])) echo $page['userEmail']; ?>" name="userEmail" />
                    </div>
                    </div>
                      
                 <div class="form-group psw_users">
<?php if(isset($page['userId'])){ ?>        
<label class="full_width"><?=lang('Password')?>  <?=lang('passHint')?></label>  
<input type="password" class="form-control width_size"  id="userPass" value="" name="userPass"  />
<?php }else{ ?>    
<label class="full_width"><?=lang('Password')?>  </label>      
<input type="password" class="form-control width_size" <?php if(empty($page['userId'])){ ?>   data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" <?php } ?>   id="userPass" value="" name="userPass"  />    
<?php } ?>    
</div>   
     <div class="form-group">
                     <label class="full_width"><?=lang('TimeZone')?></label>  
                           <select class="width_size form-control validate[required]" name="timeZone" id="timeZone"  > 
                         <?php for($z=0;$z<count($TimeZoneArr);$z++){ ?>
                            	<option value="<?= $TimeZoneArr[$z]['id'] ?>" <?php if(isset($page['timeZone'])&&$page['timeZone']== $TimeZoneArr[$z]['id'] ) {  ?> selected="selected" <?php }else {} ?> ><?= $TimeZoneArr[$z]['val'] ?></option>
                            <?php } ?>    
                           </select>
                        <? //echo timezone_menu('UM8');?>
                    </div>  
    
                         <div class="form-group group_radio">
                     <label class="full_width"><?=lang('privillage').$this->session->userdata('network')?></label>  
                             <?php if(isset($page['priv'])) $arr=explode(',',$page['priv']) ; else $arr=array();
                             //19,2,14,17,18
                          $count=21;
                         if(isset($page['network']) && $page['network']!=-1 || $this->session->userdata('network')!=-1) $count=6; 
                         
                            ?>
                             <input type="hidden" name="count" id="count" value="<?=$count?>">
                              <div class="checkbox">
                        <label>
<input type="checkbox" name="All" id="All" value="-1"  onclick="selectAllPriv()"   />
                         <?=lang('All')?>    
                        </label>
                      </div>
                              <div class="checkbox" id="privDiv1">
                        <label>
<input type="checkbox" name="priv[]" id="priv1" value="1"   <? if(in_array('1',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Users')?>    
                        </label>
                      </div>
                             
                                 <div class="checkbox" id="privDiv2">
                        <label>
<input type="checkbox" name="priv[]" id="priv2" value="2"   <? if(in_array('2',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Drivers')?>    
                        </label>
                      </div>
                                   <div class="checkbox" id="privDiv3">
                        <label>
<input type="checkbox" name="priv[]" id="priv3" value="3"   <? if(in_array('3',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Cards')?>    
                        </label>
                      </div>
                               <div class="checkbox" id="privDiv4">
                        <label>
<input type="checkbox" name="priv[]" id="priv4" value="4"   <? if(in_array('4',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('finnance')?>    
                        </label>
                      </div>
                              <div class="checkbox" id="privDiv5">
                        <label>
<input type="checkbox" name="priv[]" id="priv5" value="5"   <? if(in_array('5',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Reports')?>    
                        </label>
                      </div>
                              <div class="checkbox" id="privDiv6">
                        <label>
<input type="checkbox" name="priv[]" id="priv6" value="6"   <? if(in_array('6',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                        <?=lang('ADD_NEW_ORDER')?>
                        </label>
                      </div> 
                             
                             <?  if($this->session->userdata('network') ==-1 && (!isset($page['network'])  || (isset($page['network']) && $page['network']==-1 ))){?>
                               <div class="checkbox" id="privDiv7">
                        <label>
<input type="checkbox" name="priv[]" id="priv7" value="7" <? if(in_array('7',$arr)) echo 'checked';?> onclick="checkSelected( )"   />
                         <?=lang('Pages')?>    
                        </label>
                      </div>
                           
                              
                                  <div class="checkbox" id="privDiv8">
                        <label>
<input type="checkbox" name="priv[]" id="priv8" value="8"   <? if(in_array('8',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Country')?>    
                        </label>
                      </div>
                             
                                  <div class="checkbox" id="privDiv9">
                        <label>
<input type="checkbox" name="priv[]" id="priv9" value="9"   <? if(in_array('9',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('City')?>    
                        </label>
                      </div>
                             
                                  <div class="checkbox" id="privDiv10">
                        <label>
<input type="checkbox" name="priv[]" id="priv10" value="10"   <? if(in_array('10',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('places')?>    
                        </label>
                      </div>
                            
                                  <div class="checkbox" id="privDiv11">
                        <label>
<input type="checkbox" name="priv[]" id="priv11" value="11"   <? if(in_array('11',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Levels')?>    
                        </label>
                      </div>
                            
                                  <div class="checkbox" id="privDiv12">
                        <label>
<input type="checkbox" name="priv[]" id="priv12" value="12"   <? if(in_array('12',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Trip_Type')?>    
                        </label>
                      </div>
                             
                                  <div class="checkbox"id="privDiv13">
                        <label>
<input type="checkbox" name="priv[]" id="priv13" value="13"   <? if(in_array('13',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Models')?>    
                        </label>
                      </div>
                             
                                  <div class="checkbox" id="privDiv14">
                        <label>
<input type="checkbox" name="priv[]" id="priv14" value="14"   <? if(in_array('14',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Brands')?>    
                        </label>
                      </div>
                             
                                  <div class="checkbox" id="privDiv15">
                        <label>
<input type="checkbox" name="priv[]" id="priv15" value="15"   <? if(in_array('15',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Packages')?>    
                        </label>
                      </div>
                             
                                  <div class="checkbox" id="privDiv16">
                        <label>
<input type="checkbox" name="priv[]" id="priv16" value="16"   <? if(in_array('16',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('News')?>    
                        </label>
                      </div>
                            
                               <div class="checkbox" id="privDiv17">
                        <label>
<input type="checkbox" name="priv[]" id="priv17" value="17"  <? if(in_array('17',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Passengers')?>    
                        </label>
                      </div>
                            
                               <div class="checkbox" id="privDiv18">
                        <label>
<input type="checkbox" name="priv[]" id="priv18" value="18"   <? if(in_array('18',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Network')?>    
                        </label>
                      </div>
                            
                               <div class="checkbox" id="privDiv19">
                        <label>
<input type="checkbox" name="priv[]" id="priv19" value="19"   <? if(in_array('19',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('pricing')?>    
                        </label>
                      </div>
                            
                               <div class="checkbox" id="privDiv20">
                        <label>
<input type="checkbox" name="priv[]" id="priv20" value="20"   <? if(in_array('20',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('offers')?>    
                        </label>
                      </div>
                              <div class="checkbox" id="privDiv20">
                        <label>
<input type="checkbox" name="priv[]" id="priv21" value="21"   <? if(in_array('21',$arr)) echo 'checked';?> onclick="checkSelected( )"/>
                         <?=lang('Setting')?>    
                        </label>
                      </div>
                             <? }?>
                           
        </div>        
                   
    
      <div class="form-group">
                     <label class="full_width"><?=lang('Image')?></label>  

                                 <p class="button-height inline-label">
                                        <center>
                							<div class="close_img">
                								     
                                                <?
                                                $default_image = base_url()."resources/image/no_image.png";
                                                ?>	
                                                <div id="ImagesDiv">
                                                     <span id="thumbnails_image">
                                                        <img width='100' height='100' src='<?php if(isset($page)&& isset($page['userLogo']) && $page['userLogo']!='' )   {echo $this->config->item('uploads_path').'files/original/'. $page['userLogo'];} else echo $default_image;?> '>
                                                    </span>
                                                    <button type="button" class="btn btn-default addButton add_field_button" id="uploadBtnImage" name="uploadBtnImage" ><i class="fa fa-plus"></i></button> 
                                                    
                                                    
                                                   
                                                </div>  
                                          				
                                                <div id="action_place_222" style="float:right;display:block;"></div> 
                                                
                                             <input type="hidden" value="<? if(isset($page)&&isset($page['userLogo'])) echo $page['userLogo'];?>"  id="attached_files_image" name="attached_files_image" />
                                               
    
                							 </div>                   
                                        </center>
                                      </p>
                       	
                    </div>
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width checkbox_label"><?=lang('Status')?></label>      
                 
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="userStatus" id="optionsRadios2" value="1" <?php if(isset($page['userId']) && $page['userStatus'] == 1) echo "checked" ?>  />
                         <?=lang('Active')?>    
                        </label>
                      </div>
                    
                    </div>
                    
                      
                      
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 
		<script>
	  
            //*********************************//
		$().ready(function(){
           
            var btnVedio = document.getElementById('uploadBtnImage'),
      attached_files_image = document.getElementById('attached_files_image');
    

  var uploaderVedio = new ss.SimpleUpload({
        button: btnVedio,
        url: '<?= base_url() ?>file_upload.php?upload_dir=./resources/uploads/files/',
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        allowedExtensions: ['jpeg', 'jpg', 'bmp', 'gif','png'],
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
               
              
                 //   $('#ImagesDiv').css('display','none');
                    
                  

                    
                    document.getElementById('attached_files_image').value=response.newFileName;

                //  var p="<span style='float:right;padding:5px;border:1px dotted #000000;margin:3px;' ><input style='width:20px;'  type='checkbox'   id='ch_vedio' checked='checked' value='"+response.newFileName+"'  name='ch_vedio' onclick=\"showValueImage();\" ><img src='<?=base_url()?>resources/uploads/files/small/"+response.newFileName+"' width='70'></span>";
  var p="<img src='<?=base_url()?>resources/uploads/files/small/"+response.newFileName+"' width='70'>";
                  $('#thumbnails_image').html(p);
              
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
                  
          $('#uploadBtnImage').show();	
}); 
       
		//-------------
	function showValueImage() {
	   // alert('in');
	  if($("#attached_files_image").val()!='')
	  {
			$.ajax({url: '<?= base_url('package/del_file') ?>',type:'POST',cache: false,data: '&file_name='+$("#attached_files_image").val()}).done(function(html){$('#HiddenDivLoad').html( html );});			
	  }		 
	  $('#thumbnails_image').html('');		
	  $("#attached_files_image").val('');
     
	  $('#imageContainer').css('display','block');
    }	
            //******************************************//
             function selectAllPriv()
            {
               // if($('#All').is(':checked')) 
                var count=$('#count').val();
                for(var i=1;i<=count;i++)
                    {
                       //priv19 
                        if($('#All').is(':checked')) {
                            $('#priv'+i).prop('checked', true);
                        }
                        else{ $('#priv'+i).prop('checked', false);}
                       
                    }
            }
            //**********************************************//
            function checkSelected()
            {
                var num=0;
                var count=$('#count').val();
                for(var i=1;i<=count;i++)
                    {
                       //priv19 
                        if($('#priv'+i).is(':checked')) {
                           num++;
                        }
                       
                    }
                if(num==count)$('#All').prop('checked', true);
                else $('#All').prop('checked', false);
            }
            //**********************************//
             reloadPrivillage=function(val)
            {
                if(val==-1)
                    {
                         for(var i=1;i<=20;i++)
                        {
                            $('#privDiv'+i).css('display', 'block');
                        }
                        $('#count').val('20');
                    }else 
                        {
                                      for(var i=7;i<=20;i++)
                                {
                                    $('#privDiv'+i).css('display', 'none');
                                }
                            $('#count').val('6');
                        }
            }
          
	</script>

	