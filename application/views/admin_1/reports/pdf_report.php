
<? 

$path='./resources/uploads/';
$file_name='pdfreport'.md5(rand(0,5000)).'.html';
$file=fopen($path.$file_name,'w');
$stringdata='';
$stringdata.=' <meta charset="UTF-8"> <table class="table table-hover" style="width: 100%;border-collapse:collapse; " border="1" cellspacing="1" cellpadding="5">';
   $stringdata.='                 <thead bgcolor="#CDCDCD" > <tr >';
                         $num=1; 
$stringdata.='                       <th style="width: 10%;">#</th>';
                        if($passengerCol==1){$num++;
                    $stringdata.='   <th style="width: 20%;">'.lang('Passengers').'</th>';
                      }
                         if($driverCol==1){$num++;
                     $stringdata.='  <th>'.lang('Drivers').'</th>';
                      } 
                          if($Total_PriceCol==1){$num++;
                     $stringdata.='  <th>'.lang('Total_Price').'</th>';
                          }
                          if($DateCol==1){$num++;
                      $stringdata.=' <th>'.lang('Date').'</th>';
                          }
                          if($DistancesCol==1){$num++;
                     $stringdata.='  <th>'.lang('Distance').'</th>';
                          } 
                          if($StatusCol==1){$num++;
                      $stringdata.=' <th style="width: 20%;">'.lang('Status').'</th>';
                         }
                     $stringdata.='</tr>';
                       $stringdata.=' </thead>';
                 
                    if(count($orders)==0){ 
                   $stringdata.='  <tr>';
                       $stringdata.='  <td colspan="'.$num.'" style="text-align: center;">'.lang('No_results').'</td>';
                    $stringdata.=' </tr>';
                     } 
                     $a=0;
                          $total=0;
                          $distanceTotal=0; 
                          for($m=0;$m<count($orders);$m++){
                              if($m%2==0)$bg='#FFF';
                              else $bg='#CFCFCF';
                              $a++; 
                              $total+=$orders[$m]['tripCost'];
                        $distanceTotal+=$orders[$m]['tripKm'];
                        $stringdata.=' <tr bgcolor="'.$bg.'">';
                          $stringdata.=' <td>'. $a .'</td>';
                              if($passengerCol==1){
                         $stringdata.='  <td>'. $orders[$m]['passengerName'] .'</td>';
                             }
                              if($driverCol==1){
                         $stringdata.='  <td>'. $orders[$m]['driverFName'].' '.$orders[$m]['driverLName'] .'</td>';
                             }
                             if($Total_PriceCol==1){
                          $stringdata.=' <td>'. $orders[$m]['tripCost'] .'</td>';
                            }
                            if($DateCol==1){
                           $stringdata.='<td>'. $orders[$m]['CreateDate'] .'</td>';
                              }
                              if($DistancesCol==1){
                          $stringdata.=' <td>'. $orders[$m]['tripKm'].'</td>';
                              }
                            if($StatusCol==1){
                          $stringdata.=' <td>';
                               
                             if($orders[$m]['tripStatus'] == 1){ 
                                 $stringdata.=lang('sts1');
                              
                             }elseif($orders[$m]['tripStatus'] == 2){   
                                 $stringdata.=lang('sts2'); 
                             }elseif($orders[$m]['tripStatus'] == 3){    
                               $stringdata.=lang('sts3');
                             }elseif($orders[$m]['tripStatus'] == 4){   
                                $stringdata.=lang('sts4');   
                             }elseif($orders[$m]['tripStatus'] == 5){    
                                 $stringdata.=lang('sts5');    
                             }elseif($orders[$m]['tripStatus'] == 6){    
                                $stringdata.=lang('sts6');  
                             }else{ 
                                $stringdata.=lang('sts7');   
                             } 
                              
                           $stringdata.='</td>';
                             }
                        $stringdata.=' </tr>';
                    }     

                   $stringdata.='</tbody>';
                      $stringdata.=' <tfoot>';
                       $stringdata.='<tr>';
$newNum=$num-2;
                         $stringdata.='  <td colspan="2">'.lang('Total_Price').':  </td>';
                          $stringdata.=' <td colspan="'.$newNum.'">'.$total.'</td>';
                          
                           $stringdata.='</tr>';
                        $stringdata.='<tr>';
                          $stringdata.=' <td colspan="2">'.lang('Total_Trips').':  </td>';
                        $stringdata.='   <td colspan="'.$newNum.'">'.count($orders).'</td>';
                          
                         $stringdata.='  </tr>';
                          $stringdata.=' <tr>';
                          $stringdata.=' <td colspan="2">'.lang('Total_Distance').':  </td>';
                          $stringdata.=' <td colspan="'.$newNum.'">'.$distanceTotal.'  ' .lang('KM').'</td>';
                          
                          $stringdata.=' </tr>';
                      $stringdata.=' </tfoot>';


 $stringdata.='</table>';
fwrite($file, $stringdata);		
fclose($file);
if( $exportType==0){
echo "<script language='javascript'> window.open('".base_url().'resources/uploads/'.$file_name."','_blank');</script>";
} else {
    echo $stringdata;
}
?>