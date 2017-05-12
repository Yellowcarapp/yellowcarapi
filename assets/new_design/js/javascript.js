$('.bxslider').bxSlider({
    captions: true,
    auto: true,
    pause: 1000,
    speed: 2000
    });

$(document).ready(function(){
    $(".log_btn").click(function(){
        $(".log_form").fadeIn('slow');
		$(".full_page").css({"opacity": "0.65"});
    }); 
    $(".for_psw").click(function(){
        $(".log_form").fadeOut('fast');
        $(".forget_pass").fadeIn('slow');
		$(".full_page").css({"opacity": "0.65"});
    }); 
    
    $(".review_btn").click(function(){
        var parentData = {};
		parentData.nameid       = $(this).attr('data-nameid');
        parentData.originalname = $(this).attr('data-originalname');
		$("#theme_id").val(parentData.nameid);
		$("#theme_title").text(parentData.originalname);
        $(".show_comment_form").fadeIn('slow');
		$(".full_page").css({"opacity": "0.65"});
    });
    $(".ask_help").click(function(){
        var parentData = {};
		parentData.nameid       = $(this).attr('data-nameid');
        parentData.originalname = $(this).attr('data-originalname');
		$("#support_theme_id").val(parentData.nameid);
		$("#support_theme_title").text(parentData.originalname);
        $(".show_support_form").fadeIn('slow');
		$(".full_page").css({"opacity": "0.65"});
    });
	 $(".close_btn").click(function(){
        $(".log_form").fadeOut('slow');
        $(".forget_pass").fadeOut('slow'); 
        $(".show_comment_form").fadeOut('slow'); 
        $(".show_support_form").fadeOut('slow'); 
		$(".full_page").css({"opacity": "1"});
    });
	
	 $(".reg_btn").click(function(){
        $(".register_form").fadeIn('slow');
		$(".full_page").css({"opacity": "0.65"});
    });
	 $(".close_btn").click(function(){
        $(".register_form").fadeOut('slow');
		$(".full_page").css({"opacity": "1"});
    });
	
	 $(".blog_post").click(function(){
		$(".test").slideToggle();
    });
	   $(window).scroll(function() {
    if ($(this).scrollTop() >250) {
        $( ".nav_hypapps" ).css("background",'rgba(62,61,61,0.9)');
		$( ".log_reg a,.log_reg span" ).css("color",'#fff');
    } else {
        $( ".nav_hypapps" ).css("background",'#fff');
		$( ".log_reg a,.log_reg span" ).css("color",'#3e3d3d');
    }
    });
	
});

