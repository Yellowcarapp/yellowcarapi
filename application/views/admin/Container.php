<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Taxi</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      
    <link rel="shortcut icon" href="<?=base_url()?>resources/admin/des/img/favicons/favicon.ico">
    <!-- Bootstrap 3.3.4 -->
      
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <!--<link href="<?=base_url()?>resources/admin/admin_design/ionicons.min.css" rel="stylesheet" type="text/css" />-->    
    <link href="<?=base_url()?>resources/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="<?=base_url()?>resources/admin/admin_design/ionicons.min.css" rel="stylesheet" type="text/css" />-->    
    <link href="<?=base_url()?>resources/admin/admin_design/dist/css/select2.min.css" rel="stylesheet" type="text/css" />    
    <link href="<?=base_url()?>resources/admin/admin_design/dist/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />    
    <!-- DATA TABLES -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url()?>resources/admin/admin_design/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url()?>resources/admin/admin_design/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
<link href="<?=base_url()?>resources/admin/admin_design/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?=base_url()?>resources/admin/validation/css/validationEngine.jquery.css" type="text/css"/>
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>resources/admin/confirm_message/jConfirm-v2.css">

     
    <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <? if(lang('db')=='ar'){ ?>  <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />     <?php } ?>
    
    
    
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
    <script type="text/javascript" src="<?=base_url()?>resources/admin/Editor/ckeditor/ckeditor.js"> </script>    
  
       <script type="text/javascript" src="<?=base_url() ?>resources/admin/uploadify/uploader/SimpleAjaxUploader.js"></script>
      
      
    
      <!-- autocomplete -->
        <link rel="stylesheet" href="<?=base_url() ?>resources/admin/tokeninput/css/token-input.css">
       <script src="<?=base_url() ?>resources/admin/tokeninput/js/jquery.tokeninput.js"></script>
          <link rel="stylesheet" href="<?=base_url() ?>resources/admin/tokeninput/css/token-input-facebook.css" type="text/css" />

       
           <link href="<?=base_url() ?>resources/admin/admin_design/style_<?=lang('db')?>.css" rel="stylesheet" type="text/css" />  

<style>
.nav-tabs>li>a{
font-size:18px;
}
.nav-tabs{
border-bottom:none;
}    
.checkbox_label{
float:left;
padding-right:30px;    
}   
.full_width{width: 100%}

</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
     <?php $this->load->view("admin/slider_tabs_right");?>
      <?=$contents ?>
     <? $this->load->view("admin/footer");?>
     
    
      

        <!-- jQuery 2.1.4 -->
    
<script src="<?=base_url()?>resources/admin/validation/js/languages/jquery.validationEngine-<?=lang('db')?>.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?=base_url()?>resources/admin/validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>        
        
        
        <!-- Uploader -->
      
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <script src="<?=base_url()?>resources/admin/admin_design/dist/js/select2.full.min.js"></script>    
    <script src="<?=base_url()?>resources/admin/admin_design/dist/js/bootstrap-timepicker.min.js"></script>    
    <!-- Morris.js charts -->
    <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <script src="<?=base_url()?>resources/admin/raphael-min.js"></script>
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        
        
         
    <!-- ChartJS 1.0.1 -->
    <!--<script src="<?=base_url()?>resources/admin/admin_design/plugins/chartjs/Chart.min.js" type="text/javascript"></script>-->
    <!-- DATA TABES SCRIPT -->
<!--code.jquery.com/jquery-1.12.0.min.js
https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js
https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js
//cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js
//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js
//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js
//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js
//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js
//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js
-->    
    
    
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    
    <link href="<?=base_url()?>resources/admin/admin_design/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js" type="text/javascript"></script> 
<script src="<?=base_url()?>resources/admin/chart/highcharts.js"></script>
	<script src="<?=base_url()?>resources/admin/chart/modules/exporting.js"></script> 
        <!-- <script src="https://code.jquery.com/jquery-1.12.0.min.js" type="text/javascript"></script>    
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js" type="text/javascript"></script>-->
    
   <script type="text/javascript">
    
       $(document).ready(function() {
    $('#example1').DataTable();
} );
    </script>    
    
    <!-- jQuery Knob Chart -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?=base_url()?>resources/admin/admin_design/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?=base_url()?>resources/admin/admin_design/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>resources/admin/admin_design/dist/js/app.min.js" type="text/javascript"></script>    
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--    <script src="<?=base_url()?>resources/admin/admin_design/dist/js/pages/dashboard.js" type="text/javascript"></script>    -->
    
    <!-- AdminLTE for demo purposes -->
<!--    <script src="<?=base_url()?>resources/admin/admin_design/dist/js/demo.js" type="text/javascript"></script>-->
    <script src='<?=base_url()?>resources/admin/confirm_message/jConfirm-v2.js'></script>    
        
     <link rel="stylesheet" href="<?=base_url()?>resources/admin/message/alertify.core.css" />
    <link rel="stylesheet" href="<?=base_url()?>resources/admin/message/alertify.default.css" id="toggleCSS" />
        
        
    <script src="<?=base_url()?>resources/admin/message/alertify.min.js"></script>
        <!-- Color box-->
     <link rel="stylesheet" href="<?=base_url()?>resources/admin/colorbox/colorbox.css"  />
        
        
    <script src="<?=base_url()?>resources/admin/colorbox/jquery.colorbox-min.js"></script>
        
        <script>
            
        		function reset_alertify () {
        			$("#toggleCSS").attr("href", "<?=base_url()?>resources/admin/message/alertify.default.css");
        			alertify.set({
        				labels : {
        					ok     : "OK",
        					cancel : "Cancel"
        				},
        				delay : 8000,
        				buttonReverse : false,
        				buttonFocus   : "ok"
        			});
        		}
        </script>    
      

        
    <script>
   
     $('.jConfirmTwo').jConfirm({ 
	message: "Are you sure?", 
	confirm: "Yes!", 
	cancel: "NO", 
	openNow: false,
	callback: function(elem){
		window.location.href = elem.attr('href'); 
	} 
});

</script>    
        <script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
      $(".timepicker").timepicker({
          showInputs: false
        });
   
  });
</script>
  </body>
</html>