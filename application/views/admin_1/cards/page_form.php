      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cards
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
            <li class="active"><?=$pageTitle?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$pageTitle?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<form role="form" action="<?=site_url('admin/Cards/SaveCard')?>" method="post" name="formID" class="formID" id="formID">


   
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['cardId'])) echo $page['cardId'] ?>" />                                

    
    
    
                     
               
    
               
    
    
    
    <div class="form-group">
                     <label class="full_width">Card Number</label>  

<input type="text" class="form-control width_size " data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" name="cardNumber" id="cardNumber" value="<?php if(isset($page['cardNumber'])) echo $page['cardNumber'] ?>"/>
                    </div>
    
    
      
    <div class="form-group">
                     <label class="full_width">Card Credit</label>  

<input type="text" class="form-control width_size" data-validation-engine="validate[required,custom[number]]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is must have number only!" 
    data-errormessage="this field is required!" name="cardCredit" id="cardCredit" value="<?php if(isset($page['cardCredit'])) echo floor($page['cardCredit'])  ?>"/>
                    </div>
    
    
       <div class="form-group">
                      <label><?=lang('Country')?></label>
                      <select class="width_size form-control validate[required]" name="cardCountry" id="cardCountry" onchange="$('#currency_Load').load( '<?= base_url('admin/generalsetting/get_currency/') ?>/'+$(this).val());" > 
                         <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'] ?>" <?php if(isset($page['cardCountry'])&&$page['cardCountry']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
      <div class="form-group">
                     <label class="full_width">Currency</label>
          <span id="currency_Load">
                           <select class="width_size form-control validate[required]" name="cardCurrency" id="cardCurrency"  > 
                         <?php for($z=0;$z<count($currency);$z++){ ?>
                            	<option value="<?= $currency[$z]['curr_id'] ?>" <?php if(isset($page['cardCurrency'])&&$page['cardCurrency']== $currency[$z]['curr_id'] ) {  ?> selected="selected" <?php } ?> ><?= $currency[$z]['curr_name_'.lang('db')].'-'.$currency[$z]['curr_abbr_'.lang('db')] ?></option>
                            <?php } ?>    
                           </select></span>
                    </div>
                    <!-- radio -->
                    <div class="form-group">
                     <label class="full_width"><?=lang('Status')?></label>      
                     
                      <div class="checkbox">
                        <label>
<input type="checkbox" name="cardUsed" id="optionsRadios2" value="1" <?php if(isset($page['cardUsed']) && $page['cardUsed'] == 1) echo "checked" ?>  />
                         Used    
                        </label>
                      </div>
                    
                    </div>
 
                      
                  <div class="box-footer center">
                    <button type="submit" class="btn btn-flat btn-primary"><?=lang('Save')?></button>
                  </div>
   
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->






