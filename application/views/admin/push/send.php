<html>
    <head>
        <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.js" type="text/javascript"></script>    
    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
        <link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css"/>
        <link href="<?=base_url() ?>resources/admin/admin_design/style_<?=lang('db')?>.css" rel="stylesheet" type="text/css" />  
        <style>
            label{width:10%;display:inline-block;}    
        </style>
    </head>
    <body>

        <form method="POST">
            <p>
                <label>Send To</label> 
                <input type="radio" name="topic" value="arn:aws:sns:us-west-2:043610388509:TaxiNewPassenger" checked="checked" onClick="To('passenger')"/> Passengers 
                <input type="radio" name="topic" value="arn:aws:sns:us-west-2:043610388509:TaxiNewDriver"  onClick="To('driver')"/> Drivers 
            </p>
            <p>
                <label>Title</label>
                <input type="text" name="notTitle" id="notTitle" size="80" require/>
            </p>
            <p>
                <label>message</label>
                <input type="text" name="notMsg" id="notMsg" size="80" require/>
            </p>
            <input type="hidden" name="notType" value="passenger" id="notType"/>
            <div class="add_new" style="width:200px">
                <input type="submit" class="btn btn-block AddNewTrip" value="Send">
            </div> 
        </form>
        <script>
            function To(Type)
            {
                document.getElementById('notType').value=Type
            }
            function SendPush()
            {
                var data = $('form').serialize();
                $.ajax({
                    method:'POST',
                    type:'json',
                    url:'<?php echo site_url('Push/index')?>',
                    data:data,
                    success:function(res){
                        console.log(res);
                        parent.jQuery.colorbox.close()
                    }
                })
            }
            $(function(){
                $('form').submit(function(e){
                    var notMsg = $('#notMsg')
                    var notTitle = $('#notTitle')
                    valid=true;
                    if(!notTitle.val() || !notTitle.val().length)
                    {
                        valid=false;
                        notTitle.css('border','1px solid red');
                    }
                    else
                    {
                        notTitle.css('border','1px solid green');
                    }
                    if(!notMsg.val() || !notMsg.val().length)
                    {
                        valid=false;
                        notMsg.css('border','1px solid red');
                    }
                    else
                    {
                        notMsg.css('border','1px solid green');
                    }
                    if(valid) SendPush();
                    e.preventDefault();
                    return false;
                });
            })
        </script>
    </body>
</html>