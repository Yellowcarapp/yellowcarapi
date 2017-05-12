<?php
function reciveMsg($to='' ,$subject='',$name='',$email='',$phone='',$mobile='',$message='',$file='')
	    {
global $to;
              $to=$_REQUEST['to']; 
              $subject=$_REQUEST['subject']; 
              $name=$_REQUEST['name']; 
              $email=$_REQUEST['email']; 
              $mobile=$_REQUEST['phone']; ; 
              $message=nl2br($_REQUEST['message']);
     $data = json_decode(file_get_contents('php://input'));
     $img = $data->img;
     $img2='';    
     if($img)
         {
            $fileext    = '.png';
			$new_file_name = uniqid().$fileext;
			$img = $img.'.'.$fileext;
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$success = file_put_contents('uploads/'.$new_file_name, $data);
			$img2=base_url().'uploads/'.$new_file_name;
         }	 
			   
        $file='';
        if( $email!='' && $name!='' && $subject!='' && $message!='' )
{
	$filepath='';
				$messageText = "<html><body><table width='100%' dir='rtl' align='right'  ><tr><td>";
		$messageText .= " <br>   ".$name;
		$messageText .= "  <br>   ".$mobile; 
		$messageText .= "  <br> <br>   ".$message." <br>";
		$messageText .= "</td></tr></table></body></html> "; 				

		$headers = "From: " . strip_tags($email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $messageText, $headers);
 		$response = array('send' => 1,'message' => 'شكرا لك تم استقبال رسالتك بنجاح');
		echo json_encode($response);	
	} else {
		$response = array('send' => 0,'message' => 'عفو : هناك بيانات مطلوبه');
		echo json_encode($response);
	}					
}
reciveMsg();
?>