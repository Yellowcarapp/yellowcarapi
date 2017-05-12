<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Taxi | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url()?>resources/admin/admin_design/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/iCheck/square/green.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>resources/admin/admin_design/style_<?=lang('db')?>.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <? if(lang('db')=='ar'){ ?>  <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />     <?php } ?>
    

 
<style>
.green-gradient {
color:green;
}      
#username_error , #pass_error{
display:none;
}    
</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">

      <div class="login-box-body first_part col-sm-4">
      <? $url = explode('/',$_SERVER['REQUEST_URI']);
			   $reminURL = "";
			  for($j=4;$j<count($url);$j++) 
			   	  $reminURL .= '/'.$url[$j];
         
	 		?>
      <button class="btn btn-default lang_btn" onclick="$('#returnSpan').load('<?=base_url()?>Admin/changeLanguage')">
      <?=lang('xlangauge')?>
      </button>
   
        <div class="admin_img">
           <img src="<?=base_url() ?>resources/admin/admin_design/image/admin.png"/>
        </div>
        <p class="mem_log"><?=lang('member_login')?></p>
        <p class="message green-gradient" ></p>    
   
        <form method="post" action="" id="form-login" class="input-wrapper blue-gradient glossy" title="">
        <div class="form-group has-error">
<label class="control-label" for="inputError" id="username_error"><i class="fa fa-times-circle-o"></i> <span id="username_error_message"></span> </label>        
        </div>        
          <div class="form-group has-feedback">
            <input type="text" name="login" id="login" class="form-control" placeholder="username"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            <input type="password" name="pass" id="pass" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="lodin_btn">
              <button type="submit" class="btn btn-block log_btn"><?=lang('Sign_In')?></button>
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> <?=lang('Remember_Me')?>
                </label>
              </div>                        
          </div>
        </form>

        
       <a href="#" class="for_psw"><?=lang('forgot_password')?></a>
<!--        <a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
      <div class="sec_part col-sm-8">
        <div class="head_admin">
            <h3><?=lang('TAXI')?></h3>
            <p><?=lang('slogan1')?> <br /><?=lang('slogan2')?></p>
        </div>
      </div>
      
    </div><!-- /.login-box -->
<spn id="returnSpan"></spn>
    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
      
      
      
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });
      });
    </script>
      
      
      
    
	<script>

		/*
		 * How do I hook my login script to these?
		 * --------------------------------------
		 *
		 * These scripts are meant to be non-obtrusive: if the user has disabled javascript or if an error occurs, the forms
		 * works fine without ajax.
		 *
		 * The only part you need to edit are the scripts between the EDIT THIS SECTION tags, which do inputs validation and
		 * send data to server. For instance, you may keep the validation and add an AJAX call to the server with the user
		 * input, then redirect to the dashboard or display an error depending on server return.
		 *
		 * Or if you don't trust AJAX calls, just remove the event.preventDefault() part and let the form be submitted.
		 */

		$(document).ready(function()
		{
			/*
			 * JS login effect
			 * This script will enable effects for the login page
			 */
				// Elements
			var doc = $('html').addClass('js-login'),
				container = $('#login-box'),
			     forms = container.children('form');

			/******* EDIT THIS SECTION *******/

			/*
			 * Login
			 * These functions will handle the login process through AJAX
			 */
			$('#form-login').submit(function(event)
			{
                 event.preventDefault();
				// Values
				var login = $.trim($('#login').val()),
					pass = $.trim($('#pass').val());
                $("#username_error").hide();
				// Check inputs
				if (login.length === 0)
				{
                    
					// Display message
                    $("#username_error").show();
					$("#username_error_message").text('Please enter your username');
                    return false;
				}
				else if (pass.length === 0)
				{
                    $("#username_error").show();
					$("#username_error_message").text('Please enter your Password');
					return false;
				}
				else
				{
					// Remove previous messages
					//formWrapper.clearMessages();

					// Show progress
					//displayLoading('جارى التحقق...');

					// Stop normal behavior
					event.preventDefault();

					/*
					 * This is where you may do your AJAX call, for instance:
					 */
					  var url='<?=base_url() ?>index.php/admin/login/ajax/'+login+'/'+pass;
					  $.ajax(url, {/*
					  		data: {
					  			login:	login,
					  			pass:	pass
					  		},*/
					  		dataType:'json'
					  		,success: function(data)
					  		{
					  			//alert(data + '-' +data['logged'] + '-' + data.logged); //if(data=='sucess')

					  			if (data.logged)
					  			{
					  				//alert('aa');
					  				$("#username_error").hide();
					  				$("#pass_error").hide();
 								    $(".green-gradient").text('Login success');
 								    $('#form-wrapper').css('display','none');
					  				document.location.href = '<?=site_url('admin'); ?>';
					  			}
					  			else
					  			{
                                    $("#username_error").show();
					  				//formWrapper.clearMessages();
					  				$("#username_error_message").text('sorry please check your username or password');
					  			}
					  		},
					  		error: function()
					  		{
                                $("#username_error").show();
					  			//formWrapper.clearMessages();
					  			$("#username_error_message").text('sorry please check your username or password');
					  		}
					  });
					 

					// Simulate server-side check
				/*	setTimeout(function() {
						document.location.href = './'
					}, 2000);
			   */
				}
			});

			/*
			 * Password recovery
			 */
			$('#form-password').submit(function(event)
			{
				// Values
				var mail = $.trim($('#mail').val());

				// Check inputs
				if (mail.length === 0)
				{
					// Display message
					displayError('Please fill in your email');
										return false;

				}
				else if (!/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(mail))
				{    
 
					// Remove empty email message if displayed
					formWrapper.clearMessages('Please fill in your email');

					// Display message
					displayError('Email is not valid');
					return false;
				}
				else
				{
					// Remove previous messages
					formWrapper.clearMessages();

					// Show progress
					displayLoading('Sending credentials...');

					// Stop normal behavior
					event.preventDefault();

					/*
					 * This is where you may do your AJAX call
					 */
					 var url='<?=base_url() ?>index.php/admin/Members/sendAdminPassword/ajax/'+mail;
 					  $.ajax(url, {/*
					  		data: {
					  			login:	login,
					  			pass:	pass
					  		},*/
					  		dataType:'json'
					  		,success: function(data)
					  		{
					  			//alert(data + '-' +data['logged'] + '-' + data.logged); //if(data=='sucess')

					  			if (data.send==1)
					  			{  
					  				formWrapper.clearMessages();

					  				displaySuccess('thank you message send to your email');
					  				//alert('aa');
					  				//document.location.href = '<?=site_url('admin/Admin'); ?>';
					  			}
					  			else
					  			{
					  				formWrapper.clearMessages();
					  				displayError(' please try again');
					  			}
					  		},
					  		error: function()
					  		{
					  			formWrapper.clearMessages();
					  			displayError('Error while contacting server, please try again');
					  		}
					  });
					return false;


					// Simulate server-side check
					/*setTimeout(function() {
						document.location.href = './'
					}, 2000);
					*/
				}
			});


			/******* END OF EDIT SECTION *******/

		});

	
	</script>
  
      
  </body>
</html>