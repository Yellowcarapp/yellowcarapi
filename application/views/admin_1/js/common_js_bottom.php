	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	<script src="<?=base_url() ?>resources/admin/des/js/setup.js"></script>

	<!-- Template functions -->
	<script src="<?=base_url() ?>resources/admin/des/js/developr.input.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.message.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.modal.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.navigable.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.notify.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.scroll.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.progress-slider.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.tooltip.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.confirm.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.agenda.js"></script>
	<script src="<?=base_url() ?>resources/admin/des/js/developr.tabs.js"></script>		
	<!-- Must be loaded last -->
	
 
 
	<!-- Tinycon -->
	<script src="<?=base_url() ?>resources/admin/des/js/libs/tinycon.min.js"></script>
	

<!--CKFINDER-->
<style type="text/css">

#kcfinder_div {
    display: none;
    position: absolute;
    width: 700px;
    height: 400px;
    background: #e0dfde;
    border: 2px solid #3687e2;
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    padding: 1px;
	z-index:100;
}
.kcfinder_div {
    display: none;
    position: absolute;
    width: 700px;
    height: 400px;
    background: #e0dfde;
    border: 2px solid #3687e2;
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    padding: 1px;
	z-index:100;
}

</style>
 
<script type="text/javascript">
function openKCFinderNew(fieldID) {
	 
     var div = document.getElementById(fieldID+'_kcfinder_div');
     var feild=$('#'+fieldID);     

         
    if (div.style.display == "block") {
        div.style.display = 'none';
        div.innerHTML = '';
        return;
    }
    window.KCFinder = {
    	
        callBack: function(url) {
           window.KCFinder = null;
			
			var imgNameArr=url.split('/');
			var imgNameArrNum=imgNameArr.length;
			
			var imgNameArr=url.split('uploads/');
			var imgNameArrNum=imgNameArr.length;
 
            div.style.display = 'none';
            div.innerHTML = '';
            
            
            if($('#'+fieldID).attr('alt')=='single')
		      {
                           
		      	  $('#'+fieldID).val(imgNameArr[1]);					
		      } else { // multiple uploadder
		      	
		      	 if($('#'+fieldID).val()!='')
				  { 
 					$('#'+fieldID).val() = $('#'+fieldID).val()+','+imgNameArr[1];
 				  }else{
 					$('#'+fieldID).val(imgNameArr[1]);
 				  }
		      }
		 
		}
	 
	 
	 	
    };
 
    div.innerHTML = '<iframe name="kcfinder_iframe" src="<?=base_url()?>resources/admin/kcfinder/browse.php?type=files" ' +
        'frameborder="0" width="100%" height="100%" marginwidth="0" marginheight="0" scrolling="no" />';
    div.style.display = 'block';
}

//--------
function openKCFinder(field) {
	
     var div = document.getElementById('kcfinder_div');
              
    if (div.style.display == "block") {
        div.style.display = 'none';
        div.innerHTML = '';
        return;
    }
    window.KCFinder = {
    	
        callBack: function(url) {
           window.KCFinder = null;
			
			var imgNameArr=url.split('/');
			var imgNameArrNum=imgNameArr.length;
			
			var imgNameArr=url.split('uploads/');
			var imgNameArrNum=imgNameArr.length;
 
            div.style.display = 'none';
            div.innerHTML = '';
            

		
		 if(field.id=='image')
			 { 
				 	
				    field.value = imgNameArr[1];
					$('#'+field.id+'Link').attr('href',url);
					$('#'+field.id+'Span').css('display','block');
					 
			  } else{
 			   
 			     if($('#'+field.id).val()!='')
				  { 
 					field.value = $('#'+field.id).val()+','+imgNameArr[1];
 				  }else{
 					field.value = imgNameArr[1];
 				  }
 				  
				 $('#'+field.id+'Link').attr('href',url);
				 $('#'+field.id+'Span').css('display','block');
				 
            }
         
		}
	 
	 
	 	
    };
 
    div.innerHTML = '<iframe name="kcfinder_iframe" src="<?=base_url()?>resources/admin/kcfinder/browse.php?type=files" ' +
        'frameborder="0" width="100%" height="100%" marginwidth="0" marginheight="0" scrolling="no" />';
    div.style.display = 'block';
}

</script>

