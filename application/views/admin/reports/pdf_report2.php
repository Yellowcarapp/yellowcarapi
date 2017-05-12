<? 
$path='./resources/uploads/';
$file_name='pdfreport'.md5(rand(0,5000)).'.html';
$file=fopen($path.$file_name,'w');
$stringdata='';
$stringdata.=' <meta charset="UTF-8"> <table class="table table-hover" style="width: 100%;border-collapse:collapse; " border="1" cellspacing="1" cellpadding="5">';
if($grCol==1) $title=lang('Country');
else if($grCol==5) $title=lang('Passengers');
else if($grCol==4) $title=lang('Network');
else if($grCol==3) $title=lang('Drivers');
else if($grCol==2) $title=lang('City');
else  if($grCol==6)$title=lang('Date');
else if($grCol==7) $title=lang('Trip_Type');
else  if($grCol==8)$title=lang('Status');
                
               $stringdata.='   <tbody bgcolor="#CDCDCD"><tr  >';
                 $stringdata.='     <th style="width: 10%;">#</th>';
$stringdata.='     <th style="width: 10%;">'.$title.'</th>';
                    $stringdata.='  <th style="width: 20%;">'.lang('Total_Trips').'</th>';
                     $stringdata.=' <th>'.lang('Total_Price').'</th>';
                    $stringdata.='  <th>'.lang('Total_Distance').'</th>';
                      
                  $stringdata.='  </tr>';
                 
                     if(count($orders)==0){ 
                 $stringdata.='   <tr>';
                   $stringdata.='     <td colspan="5" style="text-align: center;">'.lang('No_results').'</td>';
                    $stringdata.='</tr>';
                    } 
                     $a=0;for($m=0;$m<count($orders);$m++){$a++; 
                                                           if($grCol==1) $data=$orders[$m]['countryName_'.lang('db')];
else if($grCol==5) $data=$orders[$m]['passengerName'];
else if($grCol==4) $data=$orders[$m]['network_name'];
else if($grCol==3) $data=$orders[$m]['driverFName'].' '.$orders[$m]['driverLName'];
else if($grCol==2) $data=$orders[$m]['cityName_'.lang('db')];
else  if($grCol==6)$data=$orders[$m]['tripCreateDate'];
else if($grCol==7) $data=$orders[$m]['typeName_'.lang('db')];
else  if($grCol==8){
       
                             if($orders[$m]['tripStatus'] == 1){ 
                                $data=lang('sts1');
                              
                             }elseif($orders[$m]['tripStatus'] == 2){   
                                 $data=lang('sts2'); 
                             }elseif($orders[$m]['tripStatus'] == 3){    
                               $data=lang('sts3');
                             }elseif($orders[$m]['tripStatus'] == 4){   
                                $data=lang('sts4');   
                             }elseif($orders[$m]['tripStatus'] == 5){    
                                 $data=lang('sts5');    
                             }elseif($orders[$m]['tripStatus'] == 6){    
                                $data=lang('sts6');  
                             }else{ 
                                $data=lang('sts7');   
                             } 
}
                      if($m%2==0)$bg='#FFF';
                              else $bg='#CFCFCF';
                      $stringdata.='  <tr bgcolor="'.$bg.'">';
                         $stringdata.=' <td style="width: 10%;">'. $a .'</td>';
                                                            $stringdata.=' <td style="width: 10%;">'. $data .'</td>';
                         $stringdata.=' <td style="width: 20%;">'. $orders[$m]['tripCount'] .'</td>';
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