   <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                       
                        <th><?=lang('Date')?></th>
                          <th><?=lang('finnanceMode')?></th>
                          <th><?=lang('Accvalue')?></th>
                      
                      </tr>
                    </thead>
                    <tbody>
                    <?php $total=0;$a=0;$debit=0; $credit=0; foreach($balance as $pages){$a++ ?>    
                      <tr>
                        <td><?=$a?></td>
                      
                        <td><?=$pages['acc_date'];?></td>
                           <td><? if($pages['acc_mode']==0) {$debit+=$pages['acc_value'];echo lang('debit');} else {$credit+=$pages['acc_value'];echo lang('credit');}?></td>
                            <td><?=$pages['acc_value'];?></td>
                       
                      </tr>
                    <?php } ?>    
                      <tr>
                        <td colspan="2"><?=lang('Total')?></td>
                          <? if($debit > $credit)
                                { $total=$debit-$credit;
                                    $mode=lang('debit');
   
                                }else if($credit  > $debit){
      $total=$credit-$debit;
      $mode=lang('credit');
  
}else {$total='0'; $mode=lang('balance');} ?>
                          <td><?=$mode?></td>
                          <td><?=$total?></td>
                        </tr>  
                    </tbody>
                  </table>