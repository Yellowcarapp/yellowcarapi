	<h2>Home Header Links</h2>
			

		<div class="clear"></div> <!-- End .clear -->

			

			<div class="content-box"><!-- Start Content Box -->

				

				<div class="content-box-header">

					

					<h3> Links List </h3>

					

					<ul class="content-box-tabs" style="display:none;">

						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div -->

						<li><a href="#tab2">Forms</a></li>

					</ul>

					

					<div class="clear"></div>

					

				</div> <!-- End .content-box-header -->

				

				<div class="content-box-content">

					

					 

					

		    <div class="tab-content  default-tab" id="tab1">

                        

                        <table>

 							<thead>

								<tr>

								   <th>ID</th>

								   <th colspan="2">Title</th>

								   <th colspan="3">Page URL</th>

 								   <th>Edite</th>

								</tr>

								

							</thead>

						  

						 

							<tbody>

								 

                                

                              <?php foreach($pages as $pages) { ?>  

                             <tr >

								   <th>

                                    <?=$pages['id'] ?>

                                   </th>

								  

                                   <th colspan="2"><?=$pages['title_ar'] ?></th>

                                   

                                   

								   

                                   <th colspan="3">	 <a target="_blank" href="<?=$pages['page_url'] ?>" title="View Meta">View</a></th>

                                   

								   <th>

                                   <!-- Icons -->

									 

 										 <a href="<?=base_url().'index.php/admin/admin/HeaderLinksForm/'.$pages['id'] ?>" title="Edit Meta"><img src="<?=base_url() ?>resources/admin/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>

                                   

                                   </th>

                                   

                                   

								</tr>

                                

						<?php } ?>		 

								

								 

								

								 

								

								 

								

								 

								

								 

								

								 

							</tbody>

							

						</table>

                       

        	</div> 

                    

               

                     

					

				</div> <!-- End .content-box-content -->

				

			</div> 

         <!-- End .content-box -->