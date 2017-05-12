 <!-- Main content -->
		<noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>
		<hgroup id="main-title" class="thin">
			<h1>المديرين</h1>
		</hgroup>

		<div class="with-padding">

			<table class="table responsive-table" id="sorting-advanced">

				<thead>
					<tr>
						<th scope="col">num</th>
						<th scope="col" width="40%" >اللاسم</th>
						<th scope="col" width="25%" class="align-center hide-on-tablet">البريد</th>
						<th scope="col" width="10%" class="align-center hide-on-tablet">التاريخ</th>
						<th scope="col" width="10%" class="hide-on-tablet">الحاله</th>
						<th scope="col" width="15%" class="align-center">العمليات</th>
					</tr>
				</thead>

				<!--<tfoot>
					<tr>
						<td colspan="6">
							6 entries found
						</td>
					</tr>
				</tfoot>-->

				<tbody>
				
				
         <?php foreach($pages as $pages) { ?>       
              					<tr>
						<th scope="row" class="checkbox-cell">
						<?=$pages['id'] ?>
						</th>
						<td>
							<?=$pages['name'] ?></td>
						<td><?=$pages['email'] ?>
							
 
						</td>
						<td><?=$pages['reg_date'] ?>
								
						</td>
						<td> 
 					         <?php if($pages['active']) { ?>
									<small class="tag green-bg">فعال</small>
					        <?php } else { ?>
									<small class="tag red-bg">غير فعال</small>
					         <?php } ?>
 					   </td>
					 
						<td class="low-padding align-center">
                        	<span class="button-group compact">
								<a href="<?=site_url('admin/Users/Form/'.$pages['id']); ?>" class="button icon-pencil">تعديل</a>
							<!--    <a href="<?=site_url('pages/details/'.$pages['id']); ?>" class="button icon-link with-tooltip" title="View Link"></a> -->
							<?php if($pages['id']>1) { ?>
 								<a href="<?=site_url('admin/Users/delete/'.$pages['id']); ?>"   class="button icon-trash with-tooltip confirm" title="حذف"></a>
 							<?php } ?>
 							</span>
                      </td>
                      
					</tr>
         <?php } ?>
               
   			  </tbody>

			</table>


		</div>


	<!-- End main content -->
			<?php //$this->load->view('admin/js/data_table_list'); ?>             
   