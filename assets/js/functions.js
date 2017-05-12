function topscroll(divID) {
	var targetOffset = $('#'+divID).offset().top;
	if($.browser.opera){
		$('html').animate({scrollTop: targetOffset}, 500);
	}else{
		$('html,body').animate({scrollTop: targetOffset},500);
	}
 }

function LoadModule(base_url,module,submodule,location,params,form)
	{
		if(!location)
			 location='working-area';
	//animatePage(location);

		var url=base_url+module+"/"+submodule;
		//alert('URl'+url);
		var now = new Date();
		var exitTime = now.getTime();
		var data="module="+module+"&submodule="+submodule+"&someParameter="+exitTime;
		
		if(params)
			data+="&"+params;
			//alert(form);
		if(form){
			data+="&"+$('#'+form).serialize();
			var allInputs = $(":button");
   		 	var formChildren = $("form > *");
		}
		//alert('data===='+data);
		if(location=='allCatProdDiv'){
			$("#"+location).html("<table border='0' width='100%' height='380' align='center' ><tr valign='middle'><td height='380' align='center' valign='middle'><img valign='middle' src='"+base_url+"files/images/ajax-loader.gif'></td></tr></table>");
		}
		if(submodule=='check_users')
			var async=false;
		else
			var async=true;	
			//alert('location is'+location);
		 $.ajax({
		   type: "POST",
		   url: url,
		   dataType: "html",
		   data: data,
		   async:false,
		 
		   success: function(html){
			  $(":button").attr('disabled','') ;
				$("#"+location).html("");
				$("#"+location).append(html);
		   }
		 });
	}
