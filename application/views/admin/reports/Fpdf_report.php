<? 

$path='./resources/uploads/';
$file_name='pdfreport'.md5(rand(0,5000)).'.html';
$file=fopen($path.$file_name,'w');
$stringdata='';
$stringdata.=' <meta charset="UTF-8"> <table class="table table-hover" style="width: 100%;border-collapse:collapse; " border="1" cellspacing="1" cellpadding="5">';
   $stringdata.='                 <thead bgcolor="#CDCDCD" > <tr>';
                         $num=1; 
$stringdata.='                       <th style="width: 10%;">#</th>';
                           if($DateCol==1){$num++;
                      $stringdata.=' <th>'.lang('Date').'</th>';
                          }
                         if($driverCol==1){$num++;
                     $stringdata.='  <th>'.lang('Drivers').'</th>';
                      } 

                          if($Total_PriceCol==1){$num++;
                     $stringdata.='  <th>'.lang('Total_Price').'</th>';
                          }
                     
                          $num++;
                     $stringdata.='  <th>'.lang('debit').'</th>';
                          
                          if($StatusCol==1){$num++;
                      $stringdata.=' <th style="width: 20%;">'.lang('Status').'</th>';
                         }
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
                               if($m%2==0)$bg='#FFF';
                              else $bg='#CFCFCF';
                              $a++; 
                            //  $total+=$orders[$m]['tripCost'];
                              if($orders[$m]['acc_mode']==0)$debit+=$orders[$m]['acc_value'];
                              else $credit+=$orders[$m]['acc_value'];
                        $distanceTotal+=$orders[$m]['tripKm'];
                        $stringdata.=' <tr bgcolor="'.$bg.'">';
                          $stringdata.=' <td style="width: 10%;">'. $a .'</td>';
                              if($DateCol==1){
                           $stringdata.='<td>'. $orders[$m]['CreateDate'] .'</td>';
                              }
                              if($driverCol==1){
                         $stringdata.='  <td>'. $orders[$m]['driverFName'].' '.$orders[$m]['driverLName'] .'</td>';
                             }
                             if($Total_PriceCol==1){
                          $stringdata.=' <td>'. $orders[$m]['acc_value'] .'</td>';
                            }
                           
                             if($orders[$m]['acc_mode']=='0')$mode='debit'; else $mode='credit';
                          $stringdata.=' <td>'. $mode.'</td>';
                              
                            if($StatusCol==1){
                         $stringdata.=' <td>'. $orders[$m]['acc_com_txt_'.lang('db')] .'</td>';
                             }
                        $stringdata.=' </tr>';
                    }     

                   $stringdata.='</tbody>';
                      $stringdata.=' <tfoot>';
                       $stringdata.='<tr>';
$newNum=$num-2;
$mode='';
if($debit>$credit){$total=$debit-$credit;$mode=lang('debit');}
else if($debit<$credit){$total=$credit-$debit;$mode=lang('credit');}

                         $stringdata.='  <td colspan="2">'.lang('debit').':  </td>';
                          $stringdata.=' <td colspan="'.$newNum.'">'.$debit.'</td>';
                          
                           $stringdata.='</tr>';
                        $stringdata.='<tr>';
                          $stringdata.=' <td colspan="2">'.lang('credit').':  </td>';
                        $stringdata.='   <td colspan="'.$newNum.'">'.$credit.'</td>';
                          
                         $stringdata.='  </tr>';
                          $stringdata.=' <tr>';
                          $stringdata.=' <td colspan="2">'.lang('Total').':  </td>';
                          $stringdata.=' <td colspan="'.$newNum.'">'.$total.'  ' .$mode.'</td>';
                          
                          $stringdata.=' </tr>';
                      $stringdata.=' </tfoot>';


 $stringdata.='</table>';
fwrite($file, $stringdata);		
fclose($file);
if( $exportType==0){
echo "<script language='javascript'> window.open('".base_url().'resources/uploads/'.$file_name."','_blank');</script>";
    }else {echo $stringdata; }
?>