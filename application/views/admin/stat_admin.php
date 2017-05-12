       <!-- Main content -->
		<hgroup id="main-title" class="thin">
			<h1>احصائيات عامه</h1>
		</hgroup>

		<div class="with-padding">

			<table class="table responsive-table" id="sorting-advanced" style="width:70%;">

				<thead>
					<tr>
						<th scope="col" width="25%" >اجمالي العقارات</th>
						<th scope="col" width="25%" class="align-center hide-on-tablet">عقارات مضافه حديثا</th>
						<th scope="col" width="25%" class="hide-on-tablet">عقارات تنتظر التفعيل</th>
						<th scope="col" width="25%" class="hide-on-tablet">العقارات المنشوره</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td colspan="6">
 						</td>
					</tr>
				</tfoot>
				<tbody>
                        <tr>
                            <td>
                              <?=$total_stat ?>
                            </td>
                            <td>
                              <?=$new_added ?>
                            </td>
                            <td>
                              <?=$wait_active ?>
                            </td>
                            <td>
                              <?=$active ?>
                            </td>

                        </tr>
				 
			  </tbody>

			</table>


		</div>


	<!-- End main content -->
			<?php //$this->load->view('admin/js/data_table_list'); ?>    

 
              
       