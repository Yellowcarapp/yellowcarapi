	<h2>Home Head Link</h2>

	 

     

     

 

 					

		<div class="clear"></div> <!-- End .clear -->

			

			<div class="content-box"><!-- Start Content Box -->

				

				<div class="content-box-header">

					

					<h3> Page Content </h3>

					

					<ul class="content-box-tabs" style="display:none;">

						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div -->

						<li><a href="#tab2">Forms</a></li>

					</ul>

					

					<div class="clear"></div>

					

				</div> <!-- End .content-box-header -->

				

				<div class="content-box-content">

					

					 

					

		<div class="tab-content  default-tab" id="tab1">

				

                <?php if($saved) { ?>	 

             <div class="notification success png_bg"  >

                            <a href="#" class="close"><img src="<?=base_url() ?>resources/admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>

                            <div>

                                thanks , news article saved succesfully and you can add anew one .

                            </div>

                         </div>

                <?php } ?>      

            <div class="notification attention png_bg" id="validatSubDiv" style="display:none;">

				<a href="#" class="close"><img src="<?=base_url() ?>resources/admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>

				<div>

					Attention notification. news title are required. 

				</div>

			</div>

                     

                     

						<form action="<?=site_url().'index.php/Admin/SaveHeaderLinks' ?>" method="post" id="settingForm">

                        

                         <input type="hidden" size="69" id="id" value="<?php if(isset($page['id'])) echo $page['id']; ?>" name="id"  > 

                        

							

							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

								<table>

                <tbody> 

              

                 <tr>

                    <td><label>Arabic Title:</label></td>

                        <td>

                       <input type="text" size="69" class="text-input large-input" id="title_ar" value="<?php if(isset($page['title_ar'])) echo $page['title_ar']; ?>" name="title_ar" style="text-align:right"> 

                        </td>

                </tr>

                

              

                

             <!--   <tr>

                    <td valign="middle"><label> Intor AR :</label></td>

                        <td>

                       <textarea  id="intro_ar"   name="intro_ar" style="text-align:right" ><?php if(isset($page['intro_ar'])) echo $page['intro_ar']; ?></textarea>

                        </td>

                </tr>-->

                

                

               <tr>

                    <td valign="middle"><label>Short Details AR :</label></td>

                        <td>

                          <input type="text" id="details_ar"   name="details_ar" style="text-align:right"  class="text-input large-input"  value="<?php if(isset($page['details_ar'])) echo $page['details_ar']; ?>"  />

                        </td>

                </tr>

                

                <tr>

                    <td><label>English Title:</label></td>

                    <td>

                       <input type="text" size="69" class="text-input large-input" id="title_en" value="<?php if(isset($page['title_en'])) echo $page['title_en']; ?>" name="title_en" style="text-align:left">  </td>

                </tr> 

                

                  <!--<tr>

                    <td valign="middle"><label> Intor En:</label></td>

                        <td>

                       <textarea  id="intro_en"   name="intro_en" style="text-align:left"  ><?php if(isset($page['intro_en'])) echo $page['intro_en']; ?></textarea>

                        </td>

                </tr>-->

                 

              <tr>

                    <td><label> Short Details English :</label></td>

                        <td>

                      <input type="text" id="details_en"   name="details_en" style="text-align:left"  class="text-input large-input"  value="<?php if(isset($page['details_en'])) echo $page['details_en']; ?>"  />

                        </td>

                </tr> 

                

                

                <tr>

                    <td><label> URL :</label></td>

                        <td>

                        exapmle : http://www.google.com

                        <br />

                      <input type="text"  id="page_url"   class="text-input large-input"  name="page_url" style="text-align:left"  value="<?php if(isset($page['page_url'])) echo $page['page_url']; ?>"  />

                      <br /> or choose Link  &nbsp;&nbsp;&nbsp; Pages:  

                      <select  style="width:200px;" onchange="$('#page_url').val(this.value)">

                          <option value="0"> Choose </option> 

                           <?php foreach($pages as $pagesa) { ?>

                            <option value="<?=base_url().'index.php/pages/pageDetails/'.$pagesa['id'].'' ?>"  > <?=$pagesa['title_ar'] ?> </option>

                           <?php } ?>

                          </select>

                         &nbsp;&nbsp;&nbsp;  

                          

                      Or    News:  &nbsp; &nbsp;

                      <select   style="width:200px;" onchange="$('#page_url').val(this.value)">

                          <option value="0"> Choose </option> 

                           <?php foreach($news as $news) { ?>

                            <option value="<?=base_url().'index.php/news/newsDetails/'.$news['id'].'' ?>"  > <?=$news['title_ar'] ?> </option>

                           <?php } ?>

                          </select>

                         &nbsp;&nbsp;&nbsp;  

                          <br />

                      Or  From  Main Projects :  

                   <!--   <select   style="width:200px;" onchange="$('#page_url').val(this.value)">

                          <option value="0"> Choose </option> 

                           <?php foreach($ProjectCat as $ProjectCat) { ?>

                            <option value="<?=base_url().'index.php/projects/Details/'.$ProjectCat['id'].'' ?>"  > <?=$ProjectCat['title_ar'] ?> </option>

                           <?php } ?>

                          </select>

                       Or Projects   &nbsp;  &nbsp;&nbsp;-->

                           <select   style="width:200px;" onchange="$('#page_url').val(this.value)">

                          <option value="0"> Choose </option> 

                           <?php foreach($Project as $Project) { ?>

                            <option value="<?=base_url().'index.php/projects/Details/'.$Project['id'].'' ?>"  > <?=$Project['title_ar'] ?> </option>

                           <?php } ?>

                          </select>

                      <br />

                      or from Photos &nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  

                      

                      

                       <select   style="width:200px;" onchange="$('#page_url').val(this.value)">

                          <option value="0"> Choose </option> 

                           <?php foreach($PhotoCat as $PhotoCat) { ?>

                        

                            <option value="<?=base_url().'index.php/gallery/photos/'.$PhotoCat['id'].'' ?>"  > <?=$PhotoCat['title_ar'] ?> </option>

                           <?php }  ?>

                          </select>

                          

                          

                      or from Vedios

                      

                      

                       <select   style="width:200px;" onchange="$('#page_url').val(this.value)">

                          <option value="0"> Choose </option> 

                           <?php foreach($VedioCat as $VedioCat) { ?>

                           

                            <option value="<?=base_url().'index.php/gallery/vedios/'.$VedioCat['id'].'' ?>"  > <?=$VedioCat['title_ar'] ?> </option>

                           <?php  } ?>

                          </select>     

                          

                          

                      

                        </td>

                </tr> 

                

                <tr>

                    <td><label>    Status  : </label></td>

                        <td>

                            <!--  <select  id="cat_id" name="cat_id" style="width:300px;">

                           <option value="0"> No Parrent </option> 

                           <?php foreach($Categorys as $Categorys) { ?>

                            <option value="<?=$Categorys['id'] ?>" <?php if(isset($page['cat_id'])&&$page['cat_id']==$Categorys['id']) {  ?> selected="selected" <?php } ?>> <?=$Categorys['title_ar'] ?> </option>

                           <?php } ?>

                          </select>-->

                          

                           &nbsp;  &nbsp; 

                             

                               

                           <select  id="active" name="active">

                            <option value="1">  Acitive  </option>

                            <option value="0" <?php if(isset($page['id'])&&$page['active']==0) {  ?> selected="selected" <?php } ?> >  Hidden </option>

                          </select>

                          

                          

                         

                                  

                          

                        </td>

                </tr>

                

               <?php if(isset($page['id']) && $page['id']<5) { ?> 

                   <tr>

                    <td><label>   Image  :  </label></td>

                        <td>

                                     <input type="hidden" id="img" name="img"  value="<?php if(isset($page['image'])) echo $page['image']; ?>" />

                                     <input type="hidden" id="img_name" name="img_name"  value="<?php if(isset($page['image_name'])) echo $page['image_name']; ?>" />

                                     

                                  <ul id="files"  >

                                  <?php if(isset($page['image']) && $page['image']!='' ) { ?>

                                    <li class="success">

									 <input  onclick="showValues()" checked="checked"  value='<?php if(isset($page['image'])) echo $page['image']; ?>' type="checkbox"   id="ch1"  name='<?php if(isset($page['image_name'])) echo $page['image_name']; ?>' class="ch"/><img src="<?=base_url()?>resources/uploads/thums/<?php if(isset($page['image'])) echo $page['image']; ?>" alt="" /> <?php if(isset($page['image_name'])) echo $page['image_name']; ?>

                                    

                                     </li>

                                   <?php } ?>

                                  

                                  </ul> 

                                    <input type="button" name="upload" id="upload" style="cursor:pointer;" value=" Browes " />

                                  <span id="status" > </span>

                                  

                                  

                                 

                                   

                         </td>

                </tr>

                

                <?php } ?>

            

                <tr class="alt-row">

                    <td colspan="2">

                        <center>

                            <input type="submit" class="button" value="Save" name="submit">   

                       </center>

                    </td>

                </tr>

            </tbody></table>

							 

							</fieldset>

							

							<div class="clear"></div><!-- End .clear -->

							

						</form>

						

					</div> 

                    

               

                     

					

				</div> <!-- End .content-box-content -->

				

			</div> 

         <!-- End .content-box -->

 <script>



$("#settingForm").submit(function() {

		  if($("#title_ar").val() == ""   ) { 												 

		       $("#validatSubDiv").css('display','block');

			    $("#title_ar").focus();

			   return false;

		  }else  if ($("#title_en").val() == ""   ) { 												 

		       $("#validatSubDiv").css('display','block');

			    $("#title_en").focus();

			   return false;

		  }else{

		       $("#validatSubDiv").css('display','none');

			   return true;

		  }

		  

});

</script>

<!--<script type="text/javascript">



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

    var editor = CKEDITOR.replace( 'details_ar' );

    var editor = CKEDITOR.replace( 'details_en' );

	CKEDITOR.config.filebrowserBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=files';

    CKEDITOR.config.filebrowserImageBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=images';

    CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/browse.php?type=flash';

    CKEDITOR.config.filebrowserUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=files';

    CKEDITOR.config.filebrowserImageUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=images';

    CKEDITOR.config.filebrowserFlashUploadUrl = '<?=base_url()?>resources/admin/Editor/kcfinder/upload.php?type=flash';

 

	

	/*var editor = CKEDITOR.replace( 'intro',

				{

					// Defines a simpler toolbar to be used in this sample.

					// Note that we have added out "MyButton" button here.

					toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['newplugin']]

				});*/

}



		</script>-->

   <script>     

        

		var btnUpload=$('#upload');

		var status=$('#status');

		new AjaxUpload(btnUpload, {

			action: '<?=base_url()?>resources/admin/upload-file.php',

			name: 'uploadfile',

			onSubmit: function(file, ext){

				 if (! (ext && /^(jpg|png|jpeg )$/.test(ext))){ 

                    // extension is not allowed 

					status.text('Only JPG, PNG   files are allowed');

					return false;

				}

				status.text('Uploading...');

			},

			onComplete: function(file, response){

				//On completion clear the status

				status.text('');

				//Add uploaded file to list

				if(response!="error"){

				   

                    var imgname=$('#img_name').val();

				    var img=$('#img').val();

					

					$('#img_name').val(file);

					$('#img').val(response);

					 

					$('<li></li>').appendTo('#files').html('<input  onclick="showValues()" checked="checked" alt='+file+' value='+response+' type="checkbox" name='+file+' value="check1" id="ch1" class="ch"/>'+file).addClass('success').attr("id", response);

					 $('#upload').css('display','none');

				} else{

					$('<li></li>').appendTo('#files').text(file).addClass('error');

				}

			}

		});

	//===========================	

	function showValues() {

	 var fields = $(".ch").serializeArray();

       $("#img").val('');  $("#img_name").val('');

	   jQuery.each(fields, function(i, field){

		        var resin=$("#img").val();var resinname=$("#img_name").val();

        		$("#img").val(field.value); $("#img_name").val(field.name);

		 

	  });

	  $('#upload').css('display','block');

    }

    $(".ch").click(showValues);

    showValues();	

	 

	 <?php if(isset($page['image'])&& $page['image']!='') { ?>  $('#upload').css('display','none'); <?php } ?>

 </script>