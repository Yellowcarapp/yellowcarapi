  

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=lang('offers')?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <?=lang('DashBoard')?></a></li>
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
<form role="form" action="<?=site_url('Trips/Saveoffer')?>" method="post" name="formID" class="formID" id="formID">
<input type="hidden" name="pageid" id="pageid" value="<?php if(isset($page['offerId'])) echo $page['offerId'] ?>" />                                
    
       <div class="form-group">
                     <label class="full_width"><?=lang('offerText')?></label>  

<input type="text" class="form-control width_size"  data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="offerText" id="offerText" value="<?php if(isset($page['offerText'])) echo $page['offerText']; ?>" />
                        
    </div>
   
   <div class="form-group">
                     <label class="full_width"><?=lang('offerdetail')?></label>  

                      <textarea data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="offerDetails" id="offerDetails" >
<?php if(isset($page['offerDetails'])) echo $page['offerDetails']; ?>                          
                          </textarea> 
                    </div>
    

   
      
               <div class="form-group">
                      <label><?=lang('Country')?></label>
                      <select class="width_size form-control validate[required]" name="countryId" id="countryId" onchange="$('#city_Load').load( '<?= site_url('generalsetting/get_cities_with_default/') ?>/'+$(this).val());"  > 
                          <option value="-1" <?php if(isset($page['countryId'])&&$page['countryId']==-1 ) {  ?> selected="selected" <?php } ?>><?=lang('All')?></option>
                         <?php for($z=0;$z<count($countries);$z++){ ?>
                            	<option value="<?= $countries[$z]['countryId'] ?>" <?php if(isset($page['countryId'])&&$page['countryId']== $countries[$z]['countryId'] ) {  ?> selected="selected" <?php } ?> ><?= $countries[$z]['countryName_'.lang('db')] ?></option>
                            <?php } ?>    
                      </select>
                    </div>
               
            <div class="form-group">
                      <label><?=lang('City')?></label>
                     <span id="city_Load">    
                      <select class="width_size form-control validate[required]" name="cityId" id="cityId" > 
                          <option value="-1" <?php if(isset($page['cityId'])&&$page['cityId']== -1 ) {  ?> selected="selected" <?php } ?>><?=lang('All')?></option>
                              <?php for($z=0;$z<count($cities);$z++){ ?>
                                    <option value="<?= $cities[$z]['cityId'] ?>" <?php if(isset($page['cityId'])&&$page['cityId']== $cities[$z]['cityId'] ) {  ?> selected="selected" <?php } ?> ><?= $cities[$z]['cityName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        </span> 
                    </div>        
            
     <div class="form-group">
                      <label><?=lang('Levels')?> </label>
                     
                      <select class="width_size form-control validate[required]" name="levelId" id="levelId"  > 
                           <option value="-1" <?php if(isset($page['levelId'])&&$page['levelId']== -1 ) {  ?> selected="selected" <?php } ?>><?=lang('All')?></option>
                              <?php for($z=0;$z<count($levels);$z++){ ?>
                                    <option value="<?= $levels[$z]['levelId']?>" <?php if(isset($page['levelId']) && $page['levelId']== $levels[$z]['levelId'] ) {  ?> selected="selected" <?php } ?> ><?= $levels[$z]['levelName_'.lang('db')] ?></option>
                                <?php } ?> 
                      </select>
                        
                    </div>
    
    
  
    
    
    
     <div class="form-group">
                     <label class="full_width"><?=lang('offerType')?></label>  

 <select class="width_size form-control validate[required]" name="offerType" id="offerType"  > 
                           <option value="one" <?php if(isset($page['offerType'])&&$page['offerType']== 'one' ) {  ?> selected="selected" <?php } ?>><?=lang('one')?></option>
                             <option value="multi" <?php if(isset($page['offerType'])&&$page['offerType']== 'multi' ) {  ?> selected="selected" <?php } ?>><?=lang('multi')?></option>  
                      </select>
                        
    </div>
    
       <div class="form-group">
                     <label class="full_width"><?=lang('offerUser')?></label>  

 <select class="width_size form-control validate[required]" name="offerUsers" id="offerUsers"  > 
                           <option value="new" <?php if(isset($page['offerUsers'])&&$page['offerUsers']== 'new' ) {  ?> selected="selected" <?php } ?>><?=lang('new')?></option>
                             <option value="current" <?php if(isset($page['offerUsers'])&&$page['offerUsers']== 'current' ) {  ?> selected="selected" <?php } ?>><?=lang('current')?></option>  
                      </select>
                        
    </div>
          <div class="form-group">
                     <label class="full_width"><?=lang('offerValue')?></label>  

<input type="text" class="form-control width_size"  data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="offerMaxValue" id="offerMaxValue" value="<?php if(isset($page['offerMaxValue'])) echo $page['offerMaxValue']; ?>" />
                        
    </div>
    <div class="form-group">
                <label><?=lang('Date')?>:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="offerExpireDate" class="form-control pull-right date_input" id="offerExpireDate" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!" value="<?php if(isset($page['offerExpireDate'])) echo $page['offerExpireDate']; ?>">
                </div>
                <!-- /.input group -->
              </div>
      <div class="form-group">
                     <label class="full_width"><?=lang('offvalidFor')?></label>  

<input type="text" class="form-control width_size expire" style="width:70%; float:left;" data-validation-engine="validate[required]"
    data-errormessage-value-missing="this field is required!" 
    data-errormessage-custom-error="this field is required!" 
    data-errormessage="this field is required!"  name="offerValidFor" id="offerValidFor" value="<?php if(isset($page['offerValidFor'])) echo $page['offerValidFor']; ?>" /><label><?=lang('off_day')?></label>  

                        
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
	<script>
	 
		$().ready(function(){
          //*************************************************//
            $('#offerExpireDate').datepicker({
      autoclose: true,
                  format: "yyyy-mm-dd"
    });
        });
            
          	</script>

<script type="text/javascript">
  //details_urdo  
// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{

   

	

CKEDITOR.replace( 'offerDetails',
    {
        customConfig : '<?=base_url()?>resources/admin/Editor/ckeditor/config.js'
    });

 
 
	CKEDITOR.config.filebrowserBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserImageBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';
    CKEDITOR.config.filebrowserUploadUrl = '<?=base_url()?>resources/admin/Editor/Editor/upload.php?type=files';
    CKEDITOR.config.filebrowserImageUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=files';
    CKEDITOR.config.filebrowserFlashUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=files';

	
	

}

</script>


