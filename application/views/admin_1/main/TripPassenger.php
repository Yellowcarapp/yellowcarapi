<style>
    input{padding:5px;width:90%;}
    select{padding:5px;width:30%;}
    input[name=passengerMobile]{padding:5px;width:50% !important;}
    p{margin: 0px;margin-top:5px;}
    #Error{color:red;font-size:10px;}
    label{width:9%;display:inline-block;}
    #User{display:none;}
    </style>
<form method="post" onsubmit="return false;" class="popup_addorder">
    <div class="input_form">
        <label>Mobile</label>
        <select name="passengerCountryId">
            <?php if(isset($countries) && is_array($countries) && count($countries)):?>
            <?php foreach($countries as $key=>$country):?>
            <option <?php echo ($key==0)?'selected=""':''?> value="<?php echo $country['countryId']?>"><?php echo $country['countryName_'.lang('db')]?></option>
            <?php endforeach?>
            <?php endif?>
        </select>
        <!--
            <select name="countryTel">
            <?php if(isset($countries) && is_array($countries) && count($countries)):?>
            <?php foreach($countries as $key=>$country):?>
            <option <?php echo ($key==0)?'selected=""':''?> value="<?php echo $country['countryTel']?>"><?php echo $country['countryName_'.lang('db')]?></option>
            <?php endforeach?>
            <?php endif?>
        </select>
            -->
        <input type="number" name="passengerMobile" id="passengerMobile"/>
    </div>
        <p id="User" class="user"></p>
        <p id="Error"></p>

   

        
    <div class="input_form">
        <label>Name</label>
        <input type="text" name="passengerName" id="passengerName"/>
    </div>
    <div class="input_form">
        <label>Email</label>
        <input type="email" name="passengerEmail" id="passengerEmail"/>
    </div>
   <!-- <button class="CreatePassenger">Create</button>-->
    <div class="col-sm-12 two_btn">
     <button type="button" id="CreatePassenger" class="btn btn-block">Create User</button>
     <button type="button" id="AddTrip" class="btn btn-block">Add Trip</button>
    </div>
   

</form>
    <link href="<?=base_url() ?>resources/admin/admin_design/style_<?=lang('db')?>.css" rel="stylesheet" type="text/css" />  
    <link href="<?=base_url()?>resources/admin/admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <script src="<?=base_url()?>resources/admin/admin_design/bootstrap/js/bootstrap.js" type="text/javascript"></script>    

<script>
    $('#AddTrip').hide()
    $('#passengerMobile').keypress(function(e){
        if(e.which == 13)
        {
            if(!$(this).val().length) return false;
            var data = $('form').serialize();
            $.ajax({method:'POST',type:'json',data : data, url:'<?php echo site_url('admin/Admin/checkpassenger')?>',
                success:function(res){
                    if(res.passengerId)
                    {
                        $('input[name=passengerName]').val(res.passengerName)
                        $('input[name=passengerName]').attr('disabled','disabled');
                        $('input[name=passengerEmail]').val(res.passengerEmail)
                        $('input[name=passengerEmail]').attr('disabled','disabled');;

                        $('#User').html('<a href="<?php echo site_url('admin/admin/AddTrip')?>/'+res.passengerId+'">'+res.passengerName+'</a>');
                        $('#Error').html('');
                        $('#AddTrip').show()
                        $('#CreatePassenger').hide()
                    }
                    else
                    {
                        $('input[name=passengerName]').val('').removeAttr('disabled');
                        $('input[name=passengerEmail]').val('').removeAttr('disabled');
                        $('#passengerName').focus();
                        $('#User').html('');
                        $('#Error').html('USer Not Found , Create New User');
                        $('#AddTrip').hide()
                        $('#CreatePassenger').show()
                    }
                }
            });
        }
    });
    $('#CreatePassenger').click(function(e){
        e.preventDefault()
        if(!$('#passengerMobile').val().length || !$('#passengerName').val().length || !$('#passengerEmail').val().length) return false;
        var data = $('form').serialize();
        $.ajax({
            method:'POST',
            type:'json',
            url:'<?php echo site_url('admin/admin/createpassenger')?>',
            data : data,
            success:function(res){
                if(res.passengerId)
                    window.location = '<?php echo site_url('admin/admin/AddTrip')?>/'+res.passengerId;
            }
        });
        return false
    });
    $('#AddTrip').click(function(e){
        e.preventDefault()
        window.location = $('#User a').attr('href')
    });
</script>