<? 

$path='./resources/uploads/';
$file_name='pdfreport'.md5(rand(0,5000)).'.html';
$file=fopen($path.$file_name,'w');
$stringdata='';
$stringdata.=' <meta charset="UTF-8"> <table class="table table-hover" style="width: 100%;border-collapse:collapse; " border="1" cellspacing="1" cellpadding="5">';
   $stringdata.='                 <thead bgcolor="#CDCDCD" > <tr>';
                         
$stringdata.='                       <th style="width: 10%;">#</th>';
                          
                      $stringdata.=' <th>'.lang('Date').'</th>';
                         
                     $stringdata.='  <th>'.lang('Drivers').'</th>';
                     
                     $stringdata.='  <th>'.lang('Network').'</th>';
                          
                     
                         
                     $stringdata.='  <th>'.lang('totalFund').'</th>';
                          $num=5;
                        
                     $stringdata.='</tr>';
                       $stringdata.=' </thead>';
                      $stringdata.=' <tbody>';
                  
                    if(count($orders)==0){ 
                   $stringdata.='  <tr>';
                       $stringdata.='  <td colspan="'.$num.'" style="text-align: center;">'.lang('No_results').'</td>';
                    $stringdata.=' </tr>';
                     } 
                     $a=0;
                          $total=0;
                          $distanceTotal=0; 
$debit=0;$credit=0;
                          for($m=0;$m<count($orders);$m++){
                                if($m%2==0)$bg='';
                              else $bg='#CFCFCF';
                              $a++; 
                              $total+=$orders[$m]['acc_value'];
                            //  if($orders[$m]['acc_mode']==0)$debit+=$orders[$m]['acc_value'];
                              //else $credit+=$orders[$m]['acc_value'];
                        $distanceTotal+=$orders[$m]['tripKm'];
                        $stringdata.=' <tr bgcolor="'.$bg.'">';
                          $stringdata.=' <td>'. $a .'</td>';
                              
                           $stringdata.='<td>'. $orders[$m]['CreateDate'] .'</td>';
                             
                         $stringdata.='  <td>'. $orders[$m]['driverFName'].' '.$orders[$m]['driverLName'] .'</td>';
                            $stringdata.=' <td>'. $orders[$m]['network_name'] .'</td>';
                             
                          $stringdata.=' <td>'. $orders[$m]['acc_value'] .'</td>';
                            
                           
                         
                              
                          
                        $stringdata.=' </tr>';
                    }     

                   $stringdata.='</tbody>';
                      $stringdata.=' <tfoot>';
                       $stringdata.='<tr>';
$newNum=$num-2;
$mode='';
if($debit>$credit){$total=$debit-$credit;$mode=lang('debit');}
else if($debit<$credit){$total=$credit-$debit;$mode=lang('credit');}

                         $stringdata.='  <td colspan="2">'.lang('total_oper').':  </td>';
                          $stringdata.=' <td colspan="'.$newNum.'">'.count($orders).'</td>';
                           $stringdata.=' </tr>';
                       
                          $stringdata.=' <tr>';
                          $stringdata.=' <td colspan="2">'.lang('total_Fund').':  </td>';
                          $stringdata.=' <td colspan="'.$newNum.'">'.$total.'</td>';
                          
                          $stringdata.=' </tr>';
                      $stringdata.=' </tfoot>';


 $stringdata.='</table>';
fwrite($file, $stringdata);		
fclose($file);
if( $exportType==0){
echo "<script language='javascript'> window.open('".base_url().'resources/uploads/'.$file_name."','_blank');</script>";
    }else {echo $stringdata; }
?>