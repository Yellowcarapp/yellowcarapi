<p class="button-height inline-label">
<label for="validation-required" class="label"> الرابط </label>
	<input type="text" name="advs_link" id="advs_link" class="input full-width validate[required]" value="<?php if(isset($page['advs_link'])) echo $page['advs_link']; ?>" data-tooltip-options='{"position":"left"}' style="text-align:right;"  >
</p>

<p class="button-height inline-label">
	<label class="label" for="input-3"> صورة الاعلان</label>
       
                  <span id="Files4Span" ></span>
                      
                    <input type="hidden"   id="FilesEmpty4" name="FilesEmpty4" value="<?php if($page['home_sett_image']) { ?>1<?php } else { ?>0<?php } ?>" />
                      
                    <input type="hidden"   id="Files4" name="Files4" value="<?=$page['home_sett_image'] ?>" />
                    <input type="hidden"   id="Files4_name" name="Files4_name" value="<?=$page['home_sett_image_name'] ?>" />
                      <div id="thumbnails_4">
                    <?php if(isset($page['home_sett_image']) && $page['home_sett_image'] !='' ) { ?>
                             <p> 
                             <input type="checkbox" value="<?= $page['home_sett_image']; ?>"  id="Files4Chbox"  checked="checked" onclick="checkFiles('Files4Chbox','4','<?= $page['home_sett_image']; ?>');" >
                             <!-- <img width="20" height="20" src="Files/thum/<?//=$dataArr[0]['Files4']?>">   -->                                            
                              <a href="<?=base_url(); ?>resources/uploads/<?= $page['home_sett_image']; ?>" target="_blank" ><?= $page['home_sett_image']; ?></a>
                            </p>            	
                    <?php } ?>
                    </div>
                    <div id="uploaddiv4" <?php if(isset($page['home_sett_image']) && $page['home_sett_image'] !='') { ?>style="display:none"<?php } ?>>
                   		 <input type="file" name="uploadify_4" id="uploadify_4" />     
                    </div>

                    <span style="font-size:12px;color:red;">files name must be in english letters without spaces </span>        
    
    
</p>                          

               
<p class="button-height inline-label"  >
	<label class="label" for="input-3">تاريخ بداية العرض</label> 
	<input id="advs_start_date" name="advs_start_date" type="text" value="<?php if(isset($page['advs_start_date'])&&$page['advs_start_date']!='') { echo @date("d-m-Y",$page['advs_start_date']); } else { echo date('d-m-Y'); } ?>" readonly="readonly">
 </p>
                    
<p class="button-height inline-label"  >
	<label class="label" for="input-3">تاريخ نهاية العرض</label> 
	<input id="advs_end_date" name="advs_end_date" type="text" value="<?php if(isset($page['advs_end_date'])&&$page['advs_end_date']!='') { echo @date("d-m-Y",$page['advs_end_date']); } else { echo date('d-m-Y'); } ?>" readonly="readonly">
 </p>  

<div style="display:none;" id="HiddenDivLoad"></div>             
<script>
 function checkFiles(CheckBoxID,ID)
     {
	 // var CheckBoxID=CheckBoxID;
	  //alert(CheckBoxID);
	  var File=$('#'+CheckBoxID).val();
	  var ID=ID;
	 var FilesEmpty=$('#FilesEmpty'+ID).val();
	 if(FilesEmpty==1)
	    {
		$.ajax({url: '<?= base_url('realestate/del_file') ?>',type:'POST',cache: false,data: '&file_name='+ $('#Files'+ID).val()}).done(function(html){$('#HiddenDivLoad').html( html );});	
		$('#FilesEmpty'+ID).val('0');
 	    $('#Files'+ID).val('');//

		// $('#Files'+ID+'_name').val('');//
		$('#'+CheckBoxID).parent('p').remove();
		$('#uploaddiv'+ID).css('display','block');
		}else {
		 $('#FilesEmpty'+ID).val('1');
		 $('#Files'+ID).val(File);//
		 //$('#Files'+ID+'_name').val(ext);//
		 $('#uploaddiv'+ID).css('display','none');
		}
	   
	 }

   $(function(){
 		$("#uploadify_4").uploadify({
			'uploader'       : '<?=base_url() ?>resources/admin/uploadify/js/uploadify.swf',
			'script'         : '<?=base_url() ?>resources/admin/uploadify/js/uploadify.php',
			'cancelImg'      : '<?=base_url() ?>resources/admin/uploadify/images/cancel.png',
			'folder'         : '<?= $this->config->item('folder_name') ?>/resources/uploads/',
			'auto'           : true,
			'multi'          : false,
			'method'         : 'POST',
			'fileExt'		 : '*.jpeg;*.jpg;|*.bmp;*.gif;*.png;*.pdf',	
			'fileDesc'		 : '*.jpeg;*.jpg;|*.bmp;*.gif;*.png;*.pdf',
			'buttonImg'     : '<?=base_url() ?>resources/admin/uploadify/images/add-filed-old.png',
			'hideButton'	: false,
			'wmode'			: 'transparent',
			'height'		: 30,
			'width'			: 120,
			
			//'height'		: 22,
			//'width'			: 105,
			//'scriptData'	:{'filetime': $('#filetime_2').val()},
			onComplete : function(event,queueID,fileObj,response,data) {
		       // alert(response);
 
					var ext=fileObj.name;
				    var rname=response;		
 					 //alert(fileObj.name);alert(rname);
					  $('#Files4Span').html('');
					    $('#Files4').val(rname);//
						$('#Files4Span').html('<input type=checkbox value='+rname+'  id=Files4Chbox  checked=checked onclick=checkFiles("Files4Chbox","4") >'+'  <a href=<?=base_url(); ?>resources/uploads/'+rname+' target=_blank >'+ext+'</a>');//
						
						$('#FilesEmpty4').val('1');//
						$('#Files4_name').val(ext);//
						$('#uploaddiv4').css('display','none');
 			}		
		});

		<?php 
	if(isset($page)&& isset($page['home_sett_image']) && $page['home_sett_image']!='' ) 
	{
	?>
		$('#uploaddiv4').css('display','none');
	<?	
	}
	 ?>
 });
 </script>                 
                 
<script>
 $(function() {
	//$( "#realestate_start_date" ).datepicker();

 $( "#advs_start_date" ).datepicker({
showWeek: true,
firstDay: 1,
"dateFormat": 'dd-mm-yy',
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 3,
onClose: function( selectedDate ) {
	$( "#advs_end_date" ).datepicker( "option", "minDate", selectedDate );
}

});	

	
 $( "#advs_end_date" ).datepicker({
showWeek: true,
firstDay: 1,
"dateFormat": 'dd-mm-yy',
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 3,
onClose: function( selectedDate ) {
	$( "#advs_start_date" ).datepicker( "option", "maxDate", selectedDate );
}

});	

	// $('#realestate_start_date').datepicker();	
	// $( "#realestate_start_date" ).datepicker( "option", "dateFormat", 'dd-mm-yy' );

});
</script>


