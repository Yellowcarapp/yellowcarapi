       <!-- Main content -->
		<hgroup id="main-title" class="thin">
			<h1><?=$pageTitle; ?></h1>
		</hgroup>

		<div class="with-padding">

			<table class="table responsive-table" id="sorting-advanced">

				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col" width="30%" >Title en</th>
						<th scope="col" width="35%" class="align-center hide-on-tablet">type</th>
						<th scope="col" width="10%" class="align-center hide-on-tablet">num op pic</th>
						<th scope="col" width="10%" class="hide-on-tablet">Status</th>
						<th scope="col" width="15%" class="align-center">Actions</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td colspan="6">
 						</td>
					</tr>
				</tfoot>

				<tbody>
				
				
  <?php foreach($pages as $pages) { ?>       
	
					<tr>
						<th scope="row" class="checkbox-cell">
						<?=$pages['id'] ?>
						</th>
						    <td>
							<?=$pages['title_ar'] ?> - <?=$pages['title_en'] ?>
							 
								
							</td>
						   <td>
							<?php if(isset($pages['kind'])&&$pages['kind']==1) {  ?>
						   سوق نسائي
 						    <?php } else  if(isset($pages['kind'])&&$pages['kind']==2) {  ?>
							معدات وادوات
							<?php }  else {  ?>
								سيارات
							<?php } ?>	
 							</td>
						<td>
							 <?=$pages['max_img_upload_for_product'] ?>
								 
						</td>
						<td> 
							<?php if($pages['active']==1) { ?>
 									<small class="tag green-bg">Active</small>
					        <?php } else { ?>
					               <small class="tag red-bg">InActive</small>
					        <?php } ?> 	
 					   </td>
					 
						<td class="low-padding align-center">
                        	<span class="button-group compact"> 
                        	   <a href="<?=site_url('Members/PackageForm/'.$pages['id']); ?>" class="button icon-pencil">Edit</a>
  
								<a href="<?=site_url('Members/DeletePackage/'.$pages['id']); ?>"   class="button icon-trash with-tooltip confirm" title="Delete"></a>
 							</span>
                      </td>
                      
					</tr>
		<?php } ?>			
				 
			  </tbody>

			</table>


		</div>


	<!-- End main content -->
			<?php $this->load->view('admin/js/data_table_list'); ?>    

 
              
       