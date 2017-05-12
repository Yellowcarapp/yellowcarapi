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
						<th scope="col" width="35%" class="align-center hide-on-tablet">Title  ar</th>
						<th scope="col" width="10%" class="align-center hide-on-tablet">Default</th>
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
							<?=$pages['group_name_ar'] ?>
							</td>
						   <td>
							<?=$pages['group_name_en'] ?>
 							</td>
						<td>
							 
								<?php if($pages['defaultgroup']==1) { ?>
 									<small class="tag green-bg">Default</small>
					        <?php }   ?> 	
						</td>
						<td> 
							<?php if($pages['status']==1) { ?>
 									<small class="tag green-bg">Active</small>
					        <?php } else { ?>
					               <small class="tag red-bg">InActive</small>
					        <?php } ?> 	
 					   </td>
					 
						<td class="low-padding align-center">
                        	<span class="button-group compact"> 
                        	   <a href="<?=site_url('admin/Members/CatForm/'.$pages['id']); ?>" class="button icon-pencil">Edit</a>
  
								<a href="<?=site_url('admin/Members/DeleteCat/'.$pages['id']); ?>"   class="button icon-trash with-tooltip confirm" title="Delete"></a>
 							</span>
                      </td>
                      
					</tr>
		<?php } ?>			
				 
			  </tbody>

			</table>


		</div>


	<!-- End main content -->
			<?php $this->load->view('admin/js/data_table_list'); ?>    

 
              
       