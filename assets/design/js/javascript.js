$(".visitor").click(function(){
	
$("#candidate_loginForm").slideUp();
$("#user_ForgetPassword").slideUp();    
$("#user_loginForm").slideDown(700);

 });

$("#showSignupModal").click(function(){
	
$("#candidate_loginForm").slideUp();
$("#user_loginForm").slideUp();
$("#user_ForgetPassword").slideDown(700);

 });

 
$(".candidate_login").click(function(){

  $("#user_loginForm").slideUp("slow");	
    $("#user_ForgetPassword").slideUp();   
  $("#candidate_loginForm").slideDown(700);

});



  $(".close").click(function(){

 $("#candidate_loginForm").slideUp();

 });


  $(".close").click(function(){
$("#user_ForgetPassword").slideUp();   
 $("#user_loginForm").slideUp();

 });

         
 $(document).ready(function(){
$('.bxslider.offer_slide').bxSlider({
	  minSlides: 1,
	  auto: false,	
	  autoControls: true,
	  maxSlides: 3,
	  slideWidth: 230,
	  slideMargin:10
  });
});
         
 $(document).ready(function(){
$('.bxslider.men').bxSlider({
	  minSlides: 1,
	  auto: false,	
	  autoControls: true,
	  maxSlides: 3,
	  slideWidth: 230,
	  slideMargin:10
  });
});
         
 $(document).ready(function(){
$('.bxslider.women').bxSlider({
	  minSlides: 1,
	  auto: false,	
	  autoControls: true,
	  maxSlides: 3,
	  slideWidth: 230,
	  slideMargin:10
  });
});


 $(document).ready(function(){
$('.bxslider.vid_bxslide').bxSlider({
	autoControls: true,
	auto: false,
	adaptiveHeight: true,
	captions: true
  });
});

$(document).ready(function(){
$('.bxslider.partner').bxSlider({
	  autoControls: true,
	  minSlides: 1,
      auto: false,		
	  maxSlides: 6,
	  slideWidth: 130,
slideMargin:10
  });
});