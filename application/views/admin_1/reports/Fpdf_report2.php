<? 
$path='./resources/uploads/';
$file_name='pdfreport'.md5(rand(0,5000)).'.html';
$file=fopen($path.$file_name,'w');
$stringdata='';
$stringdata.=' <meta charset="UTF-8"> <table class="table table-hover" style="width: 100%;border-collapse:collapse; " border="1" cellspacing="1" cellpadding="5">';

                 
               $stringdata.='   <tbody  bgcolor="#CDCDCD" ><tr  >';
                 $stringdata.='     <th style="width: 10%;">#</th>';
                    $stringdata.='  <th style="width: 20%;">'.lang('Total_Trips').'</th>';
                     $stringdata.=' <th>'.lang('Total_Price').'</th>';
                    $stringdata.='  <th>'.lang('Total_Distance').'</th>';
                      
                  $stringdata.='  </tr>';
               
                     if(count($orders)==0){ 
                 $stringdata.='   <tr>';
                   $stringdata.='     <td colspan="4" style="text-align: center;">'.lang('No_results').'</td>';
                    $stringdata.='</tr>';
                    } 
                     $a=0;for($m=0;$m<count($orders);$m++){$a++; 
                                                            if($m%2==0)$bg='#FFF';
                              else $bg='#CFCFCF';
                      $stringdata.='  <tr bgcolor="'.$bg.'">';
                         $stringdata.=' <td>'. $a .'</td>';
                         $stringdata.=' <td>'. $orders[$m]['tripCount'] .'</td>';
                        $stringdata.='  <td>'. $orders[$m]['totalCost'] .'</td>';
                        $stringdata.='  <td>'. $orders[$m]['totalDistance'] .'</td>';
                          
                         
                       $stringdata.=' </tr>';
                     } 

                 $stringdata.=' </tbody>';


$stringdata.='</table>';
fwrite($file, $stringdata);		
fclose($file);
if( $exportType==0){
echo "<script language='javascript'> window.open('".base_url().'resources/uploads/'.$file_name."','_blank');</script>";
} else {
    echo $stringdata;
}
?>