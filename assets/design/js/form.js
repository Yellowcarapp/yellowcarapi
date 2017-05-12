$(document).ready(function(){
    $(".mobile_tab").click(function(){
        $(".menu_list").slideToggle("slow");
    });  
$('.raty').raty({
    score: function() {
    return $(this).attr('data-score');
    },
     half     : true,
    readOnly    : true         
	});	
    
    $('.rating').raty({
	score: function() {
    return $(this).attr('data-score');
    },	
    half     : true,    
	click: function(score, evt) {
	$(".regist_block").css("opacity", "0.5");		
    $.post(site_url+'user/SaveRate','rating='+score+'&theme_id='+$(this).attr('data-nameid'),function(data){
	$(".regist_block").css("opacity", "");	
	}); 	
	}	
	});
});



/*######################################Register############################################*/
    $('#register').click( function(e) {
     e.preventDefault();
		//alert("here");
			$.ajax({
			url: site_url+'register/User_register',
            type: "POST",
            data: $('form#RegisterForm').serialize(),
            dataType: 'json',
            success: function(data)
            {
                $(".error").empty();	    
				$('.form-control').css({ "border": ''});  
                console.log(data);
				if(data.is_valid == false)
                {
				if(data.errors['full_name']){	
				$('#full_name').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['email']){
				$("#email_error").html(data.errors['email']);	     
				$('#email').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['password']){
				$('#password').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['re_password']){
                $("#retpassword_error").html(data.errors['re_password']);	     
				//document.getElementById("error_confirm").innerHTML = data.errors['user_confirm_password'];    
				$('#re_password').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['mobile']){
				$('#mobile').css({ "border": '#FF0000 1px solid'});   
				//document.getElementById("mobile_error").innerHTML = data.errors['mobile_num'];		
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.reload();
				}
            }        
      });
    });

/*######################################Login############################################*/
    $('#login').click( function(e) {
     e.preventDefault();
		//alert("here");
			$.ajax({
			url: site_url+'register/user_login',
            type: "POST",
            data: $('form#LoginForm').serialize(),
            dataType: 'json',
            success: function(data)
            {
                $(".error").empty();	        
				$('.form-control').css({ "border": ''});  
				console.log(data);
				if(data.is_valid == false)
                {
				if(data.errors['login_email']){	
                $("#email_login_error").html(data.errors['login_email']);	    
				$('#login_email').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['login_password']){
                $("#password_login_error").html(data.errors['login_password']);	        
				$('#login_password').css({ "border": '#FF0000 1px solid'});  
				}
				
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.reload();
				}
            }        
      });
    });

/*######################################Register############################################*/
    $('#Contact').click( function(e) {
     e.preventDefault();
		//alert("here");
			$.ajax({
			url: site_url+'contact/Send',
            type: "POST",
            data: $('form#ContactForm').serialize(),
            dataType: 'json',
            success: function(data)
            {
				$('.form-control').css({ "border": ''});  
				console.log(data);
				if(data.is_valid == false)
                {
				if(data.errors['full_name']){	
				$('#full_name').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['email']){
				//document.getElementById("email_error").innerHTML = data.errors['user_email'];	
				$('#email').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['mobile']){
				$('#mobile').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['subject']){
				//document.getElementById("error_confirm").innerHTML = data.errors['user_confirm_password'];    
				$('#subject').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['message']){
				$('#message').css({ "border": '#FF0000 1px solid'});   
				//document.getElementById("mobile_error").innerHTML = data.errors['mobile_num'];		
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.href = data['redirect'];
				}
            }        
      });
    });


/*############################# Show Category Themes ############################################## */
  $('.btn-link').click(function () {
	  var link_url = site_url + $(this).attr('data-url');
	  $(".why").css("opacity", "0.5");
	  $('.btn-link').not(this).removeClass('theme_active');	
	  $(this).addClass('theme_active');		
	  $.ajax({
            url: link_url,
            type: 'POST',
            success: function (data) {
			$(".why").css("opacity", "");
			$( "div.theme_block" ).html(data);	
			
			}
        });
        
    });
/*############################# Show Category Themes ############################################## */
  $('.cart_delete').click(function () {
	   var data_url = $(this).attr('data-url');
	   $(".why").css("opacity", "0.5");
	   $.post(site_url+'user/DeleteCartItem',{id:data_url},function(data){
		$(".why").css("opacity", "");
		window.location.href = data;	   
		 //console.log(data);  
		});
    });
/*############################# Load More ############################################## */
  $('.load_more').click(function () {
  	  var link_url = site_url;
	  $(".load_more").text('Loading...');
	  $(".why").css("opacity", "0.5");
	  $.ajax({
            url: link_url+'theme/LoadMore',
		  	//data : 'last_id='+last_id+'&cat_name='+cat_name,		  
		  	data : 'last_id='+last_id+'&tag_title='+tag_name,		  
            type: 'POST',
            success: function (data) {
			$(".load_more").text('View more themes');	
			$(".why").css("opacity", "");
			$( "div.theme_block" ).append(data);	
			}
        });
        
    });


/*############################# Load More ############################################## */
  $('#Buy').click(function () {
  	  var type = $("#type").val();
	  $.ajax({
            url: site_url+'theme/BuyTheme',
		  	data : 'type='+type+'&theme_id='+theme_id,		  
            type: 'POST',
            success: function (data) {
			window.location.href = site_url+"user/Cart";	
			}
        });
        
    });

/*######################################Forget Password############################################*/
    $('#ForgetButton').click( function(e) {
     e.preventDefault();
	 $.ajax({
			url: site_url+'register/ForgetPassword',
            type: "POST",
            data: $('form#SendForgetPassword').serialize(),
            dataType: 'json',
            success: function(data)
            {
				
				$(".errormsg").empty();	
				$('#email_forget').css({ "border": ''});  
				if(data.is_valid == false)
                {
				if(data.errors['email_forget']){	
				$(".errormsg").html(data.errors['email_forget']);		
				$('#email_forget').css({ "border": '#FF0000 1px solid'});  
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.href = data['redirect'];
				}
            }        
      });
    });

/*######################################Get Parameter  #########################################################*/
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
/*######################################Forget Password############################################*/
    $('#password_recover').click( function(e) {
	 var data = $('#PasswordRecoveryForm').serializeArray();	
	 data.push({name: 'unique', value: getParameterByName('unique')});	
	 data.push({name: 'id_customer', value: getParameterByName('id_customer')});	
	 e.preventDefault();
	 $.ajax({
			url: site_url+'user/SaveRecovery',
            type: "POST",
            data: data,
            dataType: 'json',
            success: function(data)
            {
				
				$(".error_repassword").empty();	
				$(".error_email").empty();	
				$('.form-control').css({ "border": ''});  
				if(data.is_valid == false)
                {
				if(data.errors['email']){	
				$(".error_email").html(data.errors['email']);		
				$('#email').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['password']){	
				$('#password').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['re_password']){	
				$(".error_repassword").html(data.errors['re_password']);		
				$('#re_password').css({ "border": '#FF0000 1px solid'});  
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.href = data['redirect'];
				}
            }        
      });
    });

/*######################################Update Profile############################################*/
    $('#Update').click( function(e) {
     e.preventDefault();
		//alert("here");
			$.ajax({
			url: site_url+'user/SaveEdit',
            type: "POST",
            data: $('form#user_edit').serialize(),
            dataType: 'json',
            success: function(data)
            {
				$("#email_error").empty();	
				$("#confirm_pass_error").empty();    
				$("#oldPass_error").empty();    
				$('.form-control').css({ "border": ''});  
				console.log(data);
				if(data.is_valid == false)
                {
				if(data.errors['full_name']){	
				$('#full_name').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['email']){
				$("#email_error").html(data.errors['email']);	
				$('#email').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['New_pass']){
				$('#New_pass').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['confirm_pass']){
				$("#confirm_pass_error").html(data.errors['confirm_pass']);    
				$('#confirm_pass').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['old_pass']){
				$("#oldPass_error").html(data.errors['old_pass']);    
				$('#old_pass').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['mobile']){
				$('#mobile').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['company_name']){
				$('#company_name').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['company_website']){
				$('#company_website').css({ "border": '#FF0000 1px solid'});   
				}
				if(data.errors['company_size']){
				$('#company_size').css({ "border": '#FF0000 1px solid'});   
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				//window.location.href = data['redirect'];
				}
            }        
      });
    });


/*#################################### cart change theme type ############################################################*/
function ChangeType(type,cart_id,theme_id){
$(".regist_block").css("opacity", "0.5");	
$.post(site_url+'theme/ChangeCartItem',{type:type,cart_id:cart_id,theme_id:theme_id},function(data){
console.log(data);	
$(".regist_block").css("opacity", "");
if(type == 1){
$(".theme_code_num"+cart_id).hide();
$(".theme_only_num"+cart_id).show();
}else if(type == 2){
$(".theme_only_num"+cart_id).hide();
$(".theme_code_num"+cart_id).show();
}
$(".total2").empty();		
$(".total2").text("$ "+data);	
});
}


/*############################# Load More ############################################## */
  $('.delete_all').click(function () {
   $(".why").css("opacity", "0.5");
	   $.post(site_url+'theme/DeleteAll',function(data){
		$(".why").css("opacity", "");
		$("#MYTotalCart").hide();   
		window.location.href = data;	   
		 //console.log(data);  
		});
        
    });

/*######################################Comment Form############################################*/
    $('#CommentButton').click( function(e) {
     e.preventDefault();
	 $.ajax({
			url: site_url+'user/SaveComment',
            type: "POST",
            data: $('form#SendComment').serialize(),
            dataType: 'json',
            success: function(data)
            {
				
				$(".errormsg").empty();	
				$('#comment').css({ "border": ''});  
				if(data.is_valid == false)
                {
				if(data.errors['comment']){	
				$(".errormsg").html(data.errors['comment']);		
				$('#comment').css({ "border": '#FF0000 1px solid'});  
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.href = data['redirect'];
				}
            }        
      });
    });

/*######################################Comment Form############################################*/
    $('#SupportButton').click( function(e) {
     e.preventDefault();
     
	 $.ajax({
			url: site_url+'user/SendSupport',
            type: "POST",
            data: $('form#SendSupport').serialize(),
            dataType: 'json',
            success: function(data)
            {
				
				$(".errorsupportmsg").empty();	
				$('#form-control').css({ "border": ''});  
				if(data.is_valid == false)
                {
                $(".errorsupportmsg").html(data.errors['title']);		    
				if(data.errors['title']){	
				$('#support_title').css({ "border": '#FF0000 1px solid'});  
				}
				if(data.errors['message']){	
				$('#support_message').css({ "border": '#FF0000 1px solid'});  
				}
					
				}
                else
                {
				$(".login_go").addClass("disableLink");		
				window.location.href = data['redirect'];
				}
            }        
      });
    });
/*############################# Download ############################################## */
  $('.download_zip').click(function () {
       $(".why").css("opacity", "0.5");
      $.ajax({
        type:"POST",  
        url: site_url+'theme/Download',
data : {id:$(this).data("themeid"),type:$(this).data("themetype"),cat:$(this).data("themecat"),code:$(this).data("themecode"),zip:$(this).data("themezip")}, 
        dataType: 'JSON',
        success: function(response){
        if(response.zip) {
        location.href = response.zip;
        }
        }
      });
	});
/*############################# tags ############################################## */
$('.more_tag').click(function (){
$(".load_more_tags").show();
$(".more_tag").hide();
$(".hide_tag").show();
});

$('.hide_tag').click(function (){
$(".load_more_tags").hide();
$(".hide_tag").hide();    
$(".more_tag").show();
});
/*######################################################################################*/
function FilterTheme(){

$(".list_page").css("opacity", 0.5);
var type = "";    
var term = $("#search").val();
var min_price = $("#min_price").val();	
var order = $("#order").val();	
var max_price = $("#max_price").val();
if($('.radio').is(':checked')) { var type = $('input[name=optionsRadios]:checked').val(); }    
var values = $('input:checkbox:checked.tags').map(function () {
return this.value;
}).get();
var platforms = $('input:checkbox:checked.platforms').map(function () {
return this.value;
}).get();
$.get(site_url+'theme/FilterThemes',{term:term,min_price:min_price,max_price:max_price,type:type,tags:values,platforms:platforms,order:order},function(data){		
$(".list_page").css("opacity", "");
history.pushState('data', '', site_url+'themes?term='+term+'&min_price='+min_price+'&max_price='+max_price+'&type='+type+'&tags='+values+'&platform='+platforms+'&order='+order+'');			
$('.them_app_list').html(data);	
//$('.themes_grid').html(data);	
});
}
