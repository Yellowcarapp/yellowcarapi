<p class="button-height inline-label">
<label class="label" for="input-3"> العنوان </label> 
	<input type="text" name="title_ar" id="title_ar" value="<?=$page['title_ar'] ?>"  />
</p>

<p class="button-height inline-label">
<label class="label" for="input-3"> التفاصيل </label> 
	 <textarea name="details_ar" id="details_ar"   rows="5" ><?=$page['details_ar'] ?></textarea>
</p>

<p class="button-height inline-label">
	<label class="label" for="input-3"> صورة </label>
       
                  <span id="Files4Span" ></span>
                      
                    <input type="hidden"   id="FilesEmpty4" name="FilesEmpty4" value="<?php if($page['image']) { ?>1<?php } else { ?>0<?php } ?>" />
                      
                    <input type="hidden"   id="Files4" name="Files4" value="<?=$page['image'] ?>" />
                    <input type="hidden"   id="Files4_name" name="Files4_name" value="<?=$page['image'] ?>" />
                      <div id="thumbnails_4">
                    <?php if(isset($page['image']) && $page['image'] !='' ) { ?>
                             <p> 
                             <input type="checkbox" value="<?= $page['image']; ?>"  id="Files4Chbox"  checked="checked" onclick="checkFiles('Files4Chbox','4','<?= $page['image']; ?>');" >
                             <!-- <img width="20" height="20" src="Files/thum/<?//=$dataArr[0]['Files4']?>">   -->                                            
                              <a href="<?=base_url(); ?>resources/uploads/<?= $page['image']; ?>" target="_blank" ><?= $page['image']; ?></a>
                            </p>            	
                    <?php } ?>
                    </div>
                    <div id="uploaddiv4" <?php if(isset($page['image']) && $page['image'] !='') { ?>style="display:none"<?php } ?>>
                   		 <input type="file" name="uploadify_4" id="uploadify_4" />     
                    </div>

                    <span style="font-size:12px;color:red;">files name must be in english letters without spaces </span>        
    
    
<!--    
	<input type="text" onclick="openKCFinder(this)" id="image"   name="image"  value="<?// if(isset($page['image'])) echo $page['image']; ?>" style="cursor:pointer;width:50%;" class="input" />
	<span  id="imageSpan"    style="display: <?php //if(isset($page['image']) &&  $page['image']!='') { ?>block; <?php //} else { ?>none; <?php //} ?> width:80px;" >
	 <a href="<?php //=base_url(); ?>resources/uploads/<?php //if(isset($page['image'])) echo $page['image']; ?>"  id="imageLink" target="_blank" >عرض</a> 
	 &nbsp; &nbsp; 
	 <a href="#" onclick="$('#image').val('');$('#imageSpan').css('display','none');return false;" target="_blank"  >الغاء</a> 
	</span>
	
	<div id="kcfinder_div"></div>-->
</p>                          
               
               
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
			'folder'         : '/ebtikarat/resources/uploads/',
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
 });
 </script>                 
                 



