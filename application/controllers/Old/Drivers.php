<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 include_once APPPATH."libraries/amazon/aws-autoloader.php";
use  Aws\Sns\SnsClient;
class Drivers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/drivers_model','users');	
        $this->s3 = SnsClient::factory(array('region' => 'us-west-2',
            'credentials' => array(
                'key'=> 'AKIAJBQG3Y325KV45M3Q'
                
                ,'secret'=>'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'
            )
        ));	
	}
//######################	
function networkForm()
	  {
	
	  $id=$this->uri->segment(4);//$this->session->userdata('id');//$this->uri->segment(4);
	   if($this->session->userdata('id'))
			   {
				   $data['countries']=$countries = $this->users->tblLIst('countries');
             $data['cities'] = $this->users->tblLIst('cities','countryId',$countries[0]['countryId']);
				  if($id && $id!='saved') 
					   {    
							$data['page'] = $this->users->Details($id);
							$data['pageTitle']=lang('edit_network');
					   } else {
	 						$data['pageTitle']=lang('Add_network');
					   }
				  
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 }
				    
				  $this->template->load('admin/Container', 'admin/drivers/form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/Admin');
			   
			   }
	  
	  }	
   
//===========#######################members######################=====================
   function SaveNetwork()
    {
       $pageid=$this->input->post('pageid', TRUE); 
	 $network_name=$this->input->post('network_name', TRUE);
	 $country=explode('_',$this->input->post('network_country', TRUE));
       $network_country =$country[0];
       $timeZone=$country[1];
//
       
	  $network_active=$this->input->post('network_active', TRUE);
	 $networkLogo=$this->input->post('attached_files_image', TRUE);
 
        
        $userId=$this->input->post('userId', TRUE);
	 $userName=$this->input->post('userName', TRUE);
//
	  $userEmail=$this->input->post('userEmail', TRUE);
	 $userPass=$this->input->post('userPass', TRUE);
        
         $cityId=$this->input->post('cityId', TRUE);
	 $img=$this->input->post('attached_files_image', TRUE);
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			
            $userdata=array('userName'=>$userName
                           ,'userEmail'=>$userEmail
                            ,'job'=>1
                            ,'userStatus'=>1
                            ,'priv' =>'1,2,3,4,5,6'
                            ,'timeZone'=>$timeZone
                           ,'cityId'=>$cityId);
            if($userId){
                if($userPass!='')
                 $userdata['userPass']=md5($userPass);
                            $this->db->where('userId',$userId);
						     $this->db->update('admins', $userdata); 
            }else{
                $userdata['userPass']=md5($userPass);
                            $this->db->insert('admins', $userdata);
                              $userId=$this->db->insert_id();  
            }
						 $data =  array('network_name' => $network_name
						   ,  'network_country' => $network_country 
						 ,  'network_active' => $network_active 
                            ,  'networkLogo' => $networkLogo
                                       
						   ); 
						  
						  if($pageid) //update
						    {
                              
							 $this->db->where('network_id',$pageid);
						     $this->db->update('network', $data);
                             
							}else{  //insert
                              $data['network_admin']=$userId;
						      $this->db->insert('network', $data);
                              $pageID=$this->db->insert_id();
                              $userUdata['network']=$pageID;
                                $this->db->where('userId',$userId);
						     $this->db->update('admins', $userUdata);
                             
						    }
						
            redirect(base_url('admin/drivers/networkList'));
						  
	          } else {
			   
			    redirect(base_url('admin/admin'));
			   
			   }   
    }
//=========================
     function delete()
   {
    $id=$this->uri->segment(4);
     $sts=$this->uri->segment(5);
			 if($this->session->userdata('id'))
			   {			
						if($id )
						   {
                            $data=array('network_active'=>!$sts);
						   $this->db->where('network_id', $id);
						   $this->db->update('network',$data); 
						   }
						 redirect(site_url('admin/drivers/networkList'));
				} else {
			  redirect(site_url('').'/admin/Admin');
			 }		   
						   
   }	 

//===========#######################PageS######################=====================
    function  networkList()
	  {
	  
	   if($this->session->userdata('id'))
			   {
           
			       $data['type'] = 1;
				   $data['pages'] = $this->users->tblLIst('network a INNER JOIN countries b ON a.network_country=b.countryId INNER JOIN admins as c On a.network_admin=c.userId');	
				   $data['pageTitle']='Network List';
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/list',$data); 
		       
	   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
    

    //***************************
  function  driverForm()
	  {
	   $id=$this->uri->segment(4);
	  
	   
	  if($this->session->userdata('id'))
			   {
            $data['countries']=$countries = $this->users->tblLIst('countries','countryStatus','1');
             $data['cities'] = $this->users->tblLIst('cities','countryId',$countries[0]['countryId']);
            $data['package'] = $this->users->tblLIst('packages','packageStatus','1');
            $data['network'] = $this->users->tblLIst('network','network_active','1');
            $data['brand'] =$brand = $this->users->tblLIst('brands','brandStatus','1');
            $data['levels'] = $this->users->tblLIst('levels','levelStatus','1');
           $data['models'] = $this->users->tblLIst('models','brandId',$brand[0]['brandId']);
           $data['tripType'] = $this->users->tblLIst('tripTypes','typeStatus','1');
			     if($id ) 
					   {    $info = $this->users->tblLIst('drivers','driverId',$id);
                         $data['cities'] = $this->users->tblLIst('cities','countryId',$info[0]['driverCountryId']);
                          $data['models'] = $this->users->tblLIst('models','brandId',$info[0]['brandId']);
							$data['page']=$info[0];
							$data['pageTitle']=lang('Add_driver');
					   } else {
	 						$data['pageTitle']=lang('edit_driver');
					   }
			
  				  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
//=========================
  function SaveDriver()
    {
       $pageid=$this->input->post('pageid', TRUE); 
	 $driverFName=$this->input->post('driverFName', TRUE);
	 $driverLName=$this->input->post('driverLName', TRUE);
//
	  $driverEmail=$this->input->post('driverEmail', TRUE);
	 $driverPass=$this->input->post('driverPass', TRUE);
 
        
        $driverMobile=$this->input->post('driverMobile', TRUE);
	 $driverImage=$this->input->post('attached_files_image', TRUE);
//
	  $packageId=$this->input->post('packageId', TRUE);
	 $driverCountryId=$this->input->post('driverCountryId', TRUE);
        
         $driverCityId=$this->input->post('cityId', TRUE);
	 $network=explode('_',$this->input->post('networkId', TRUE));
       
        $networkId=$network[0];
        //
	  $adminId=$network[1];//$this->input->post('adminId', TRUE);
	 $driverGender=$this->input->post('driverGender', TRUE);
 
        
        $driverSmoker=$this->input->post('driverSmoker', TRUE);
	 $brandId=$this->input->post('brandId', TRUE);
//
	  $levelId=$this->input->post('levelId', TRUE);
	 $modelId=$this->input->post('modelId', TRUE);
        
         $year=$this->input->post('year', TRUE);
	 $carFrontPhoto=$this->input->post('attached_files_imageF', TRUE);
        
  
          //
	  $carBackPhoto=$this->input->post('attached_files_imageB', TRUE);
	 $licensePhoto=$this->input->post('attached_files_imageL', TRUE);
 
        
        $licenseNumber=$this->input->post('licenseNumber', TRUE);
	 $drivercode=$this->input->post('drivercode', TRUE);
$carNumber=$this->input->post('carNumber',TRUE);
	  $refercode=$this->input->post('refercode', TRUE);
	 
        $seatNo=$this->input->post('seatNo',TRUE);
       $driver_paymethod=$this->input->post('driver_paymethod',TRUE);
       $driver_payLevel=$this->input->post('driver_payLevel',TRUE);
	 $driverActivation=$this->input->post('driverActivation',TRUE);
       $driverIdnumer=$this->input->post('driverIdnumer',TRUE);
	 $driverbirth=$this->input->post('driverbirth',TRUE);
      if($this->input->post('driver_trip_type',TRUE))
      $driver_trip_type=implode(',',$this->input->post('driver_trip_type',TRUE));
      else  $driver_trip_type='';
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('driverFName' => $driverFName
                                        ,  'driverLName' => $driverLName 
                                        ,  'driverEmail' => $driverEmail 
                                        ,  'driverMobile' => $driverMobile
                                        ,  'driverImage' => $driverImage 
                                        ,'carNumber'=>$carNumber
                                        ,  'packageId' => $packageId
                                         ,  'driverCountryId' => $driverCountryId
                                          ,  'driver_trip_type' => $driver_trip_type
                                        ,  'driverCityId' => $driverCityId
                                        ,  'networkId' => $networkId
                                        ,  'adminId' => $adminId
                                        ,  'driverGender' => $driverGender
                                        ,  'driverSmoker' => $driverSmoker
                                        ,  'brandId' => $brandId
                                        ,'driverIdnumer'=>$driverIdnumer
                                        ,'driverbirth'=>$driverbirth
                                        ,  'levelId' => $levelId
                                        ,  'modelId' => $modelId
                                        ,  'carYear' => $year
                                        ,  'carFrontPhoto' => $carFrontPhoto
                                        ,  'carBackPhoto' => $carBackPhoto
                                        ,  'licensePhoto' => $licensePhoto
                                        ,'seatNo'=>$seatNo
                                        ,'driverActivation'=>$driverActivation
                                        ,  'licenseNumber' => $licenseNumber
                                        ,  'drivercode' => $drivercode
                                        ,  'refercode' => $refercode
                                        ,'driver_paymethod'=>$driver_paymethod
                                        ,'driver_payLevel'=>$driver_payLevel
                                       
						   ); 
						  $sa=str_split($carNumber);
            
						 if($pageid) //update
						    {
                              if($driverPass!='')
                                   $data['driverPass']=md5($driverPass);
							 $this->db->where('driverId',$pageid);
						  //   $this->db->update('drivers', $data);
                             if($driverActivation==1 && $this->input->post('OlddriverActivation')==0)
							 {
        /*                         							 {

$form_url = "https://wasl.elm.sa/WaslPortalWeb/rest/DriverRegistration/send";
$data_to_post = array();
$data_to_post['apiKey'] = 'EE5F22B0-7706-4197-A84B-90E446A5F086';
$data_to_post['captainIdentityNumber'] = $driverIdnumer;
$data_to_post['dateOfBirth'] = $driverbirth;
$data_to_post['emailAddress'] = $driverEmail;
$data_to_post['mobileNumber'] = $driverMobile;
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL, $form_url);
curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
$result = curl_exec($curl);
curl_close($curl);
$sa=str_split($carNumber);
$form_url = "https://wasl.elm.sa/WaslPortalWeb/rest/VehicleRegistration/send";
$data_to_post = array();
$data_to_post['apiKey'] = 'EE5F22B0-7706-4197-A84B-90E446A5F086';
$data_to_post['plateLetterRight'] = $sa[0];
$data_to_post['plateLetterMiddle'] = $sa[1];
$data_to_post['plateLetterLeft'] = $sa[2];
$data_to_post['plateNumber'] = $sa[3].$sa[4].$sa[5];
$data_to_post['plateType'] = '1';
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL, $form_url);
curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
$result = curl_exec($curl);
curl_close($curl);
*/
								$title = 'congratulations';
								$msg = 'your account has been activated';
								$message['default'] = $msg;
								$message['GCM'] = json_encode(array('data'=>array('message'=>$msg,'title'=>$title)));
								$message['APNS'] =json_encode(array('aps'=>array('alert' => $msg,'title'=>$title)));
								$endPoint = $this->input->post('endPoint');
								$re= $this->s3->publish(array('TargetArn' => $endPoint,'Message' => json_encode($message),'MessageStructure' => 'json'));
							 }
							}else{  //insert 
                              $data['driverPass']=md5($driverPass);
                              $data['driverActivation']='0';
                              $data['driverCreateDate']=date('Y-m-d');
						      $this->db->insert('drivers', $data);
                              $pageID=$this->db->insert_id();
                             
						    }
						
            redirect(base_url('admin/drivers/driverList'));
						  
	          } else {
			   
			    redirect(base_url('admin/admin'));
			   
			   }   
    }
//=========================
 function DeleteDriver()
   {
       $id=$this->uri->segment(4);
     $status=$this->uri->segment(5);
			 if($this->session->userdata('id'))
			   {			
						if($id)
						   {
                            $data=array('passengerActivation'=>!$status);
						   $this->db->where('passengerId', $id);
						   $this->db->update('passengers',$data); 
						   }
						 redirect(base_url('admin/passengers/passengerList'));
				} else {
			  redirect(base_url('').'/admin/admin');
			 }		   
					   
   }    
    //*******************************************//
  function  driverList()
	  {
	  
	  if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->tblLIst('drivers');	
				   $data['pageTitle']=lang('DriverList');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/page_list',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
      //*********************************/
   function get_Model()
    {$brand_id = $this->uri->segment(4); 
        $data['models'] = $this->users->tblLIst('models','brandId',$brand_id);
	$this->load->view('admin/drivers/get_models',$data);
    }
    /******************************/
    function checkCode()
    {
        $code=$this->input->post('code', TRUE);
         $check = $this->users->tblLIst('drivers','drivercode',$code);
        if(count($check)>0)
            $html='1';
        else $html='0';
        echo $html;
    }
    //***************************//
     function checkID()
    {
        $code=$this->input->post('code', TRUE);
         $check = $this->users->tblLIst('drivers','driverIdnumer',$code);
        if(count($check)>0)
            $html='1';
        else $html='0';
        echo $html;
    }
    //*******************************************//
    function checkItemUnique()
    {
        $val=$this->input->post('val', TRUE);//$_REQUEST['val'];
         $mode=$this->input->post('mode', TRUE);//$_REQUEST['mode'];
    //    echo $val.' ****** '.$mode;
        $check=array();
      if($mode==1)//email
      {
           $check = $this->users->getTable("drivers","driverEmail",$val);
          $msg='  Error. This email address aleardy exist , please choose another email.';
      }else if($mode==2)
      {
          $check = $this->users->getTable("drivers","driverMobile",$val); 
           $msg='  Error. This mobile number  aleardy exist , please choose another number.';
      }
      //  echo count($check);
        if(count($check)>0)
        {
            echo "<script>$('#erroPlace').css('display','block');$('#msgPlace').html('".$msg."')</script>";
         // $this->session->set_flashdata('emailExist', '1');  
          //  $this->session->set_flashdata('checkMsg', $msg);   
        }else {
            echo "<script>$('#erroPlace').css('display','none');</script>";  
        }
    }
    //************************************/
    function getReffer()
    {
         $q=$_GET['q'];//, TRUE);
          $arr = $this->users->get_driversReffer($q);
        echo json_encode($arr);
    }
    
//############################# Comment #############################//
    function driverComment()
    {  $id=$this->uri->segment(4);
          if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->tblLIst('		`trips`  INNER JOIN passengers ON tripPassengerId = passengers.passengerId  LEFT JOIN countries ON tripCountryId = countries.countryId  LEFT JOIN cities ON tripCityId = cities.cityId','tripDriverId',$id,'tripLeaveComment <>""');	
				   $data['pageTitle']=lang('CommentList');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/comment_list',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
    }
//=====*/=============================== 
  


}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */