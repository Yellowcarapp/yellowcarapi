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
	
	  $id=$this->uri->segment(3);//$this->session->userdata('id');//$this->uri->segment(4);
	   if($this->session->userdata('id'))
			   {
				   $data['countries']=$countries = $this->users->tblLIst('countries','countryStatus','1');
             $data['cities'] = $this->users->tblLIst('cities','countryId',$countries[0]['countryId']);
				  if($id && $id!='saved') 
					   {    
                      
							$data['page']=$page = $this->users->Details($id);
                       set_cookie('network_id', $id,36000); 
                       $data['cities'] = $this->users->tblLIst('cities','countryId',$page['network_country']);
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
			   
			   redirect(base_url());
			   
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
                              delete_cookie('network_id');
							}else{  //insert
                              $data['network_admin']=$userId;
						      $this->db->insert('network', $data);
                              $pageID=$this->db->insert_id();
                              $userUdata['network']=$pageID;
                                $this->db->where('userId',$userId);
						     $this->db->update('admins', $userUdata);
                             
						    }
          //  if(isset($_COOKIE['network_id']))
           
                 redirect(base_url('drivers/networkList'));
					
           
						  
	          } else {
			   
			    redirect(base_url());
			   
			   }   
    }
    //************************
    function check_network()
    {
        $name=$_REQUEST['fieldValue'];//$this->input->post('fieldValue',TRUE);
        $validateId=$_REQUEST['fieldId'];
        if(isset($_COOKIE['network_id']) && $_COOKIE['network_id']!='')
            $wh=' network_id <>'.$_COOKIE['network_id'];
        else $wh='';
        $check=$this->users->tblLIst('network','network_name',$name,$wh);
        $arrayToJs = array();
        $arrayToJs[0] = $validateId;
            if(count($check)==0){
               $arrayToJs[1] = true;	
            }else{
               $arrayToJs[1] = false;	
            }
        echo json_encode($arrayToJs);	
    }
//=========================
     function delete()
   {
    $id=$this->uri->segment(3);
     $sts=$this->uri->segment(4);
			 if($this->session->userdata('id'))
			   {			
						if($id )
						   {
                            $data=array('network_active'=>!$sts);
						   $this->db->where('network_id', $id);
						   $this->db->update('network',$data); 
                            /*
                             $data=array('userStatus'=>!$sts);
						   $this->db->where('network', $id);
						   $this->db->update('admins',$data); 
                            */
                           
                            
						   }
						 redirect(site_url('drivers/networkList'));
				} else {
			  redirect(base_url());
			 }		   
						   
   }	 

//===========#######################PageS######################=====================
    function  networkList()
	  {
	  
	   if($this->session->userdata('id'))
			   {
           
			       $data['type'] = 1;
				   $data['pages'] = $this->users->driverList();//tblLIst('network a INNER JOIN countries b ON a.network_country=b.countryId INNER JOIN admins as c On a.network_admin=c.userId');	
				   $data['pageTitle']='Network List';
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/list',$data); 
		       
	   } else {
			   
			   redirect(base_url());
			   
			   }
	  
	  }	
    

    //***************************//
  function  driverForm()
	  {
	   $id=$this->uri->segment(3);
	
	  if($this->session->userdata('id'))
			   {
            $data['countries']=$countries = $this->users->tblLIst('countries','countryStatus','1');
             $data['cities'] = $this->users->tblLIst('cities','countryId',$countries[0]['countryId']);
            $data['package'] = $this->users->tblLIst('packages','packageStatus','1');
            $data['network'] = $this->users->tblLIst('network','network_active','1','network_country ='.$countries[0]['countryId']);
            $data['brand'] =$brand = $this->users->tblLIst('brands');
            $data['levels'] = $this->users->tblLIst('levels','levelStatus','1');
           $data['models'] = $this->users->tblLIst('models','brandId',$brand[0]['brandId']);
           $data['tripType'] = $this->users->tblLIst('tripTypes','typeStatus','1');
			     if($id ) 
					   {    $info = $this->users->tblLIst('drivers','driverId',$id);
                         $data['cities'] = $this->users->tblLIst('cities','countryId',$info[0]['driverCountryId']);
                        $data['network'] = $this->users->tblLIst('network','network_active','1','network_country ='.$info[0]['driverCountryId']);
                          $data['models'] = $this->users->tblLIst('models','brandId',$info[0]['brandId']);
							$data['page']=$info[0];
							 set_cookie('driver_id', $id,36000); 
							$data['pageTitle']=lang('edit_driver');
					   } else {
	 						$data['pageTitle']=lang('Add_driver');
					   }
			
  				  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
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
 
        
        $driverMobile=ltrim($this->input->post('driverMobile', TRUE),0);
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
         $carNumber2=$this->input->post('carNumber2', TRUE);
  
          //
	  $carBackPhoto=$this->input->post('attached_files_imageB', TRUE);
	 $licensePhoto=$this->input->post('attached_files_imageL', TRUE);
   $nationalID=$this->input->post('nationalID', TRUE);
	  $birthdate=$this->input->post('birthdate', TRUE);
         $sequenceNumber=$this->input->post('sequenceNumber', TRUE);
 	 $driverIdnumber=$this->input->post('driverIdnumber', TRUE);
        $licenseNumber=$this->input->post('licenseNumber', TRUE);
	 $drivercode=$this->input->post('drivercode', TRUE);
$carNumber=$this->input->post('carNumber',TRUE);
	  $refercode=$this->input->post('refercode', TRUE);
	 
        $seatNo=$this->input->post('seatNo',TRUE);
       $driver_paymethod=$this->input->post('driver_paymethod',TRUE);
       //$driver_payLevel=$this->input->post('driver_payLevel',TRUE);
	 $driverActivation=$this->input->post('driverActivation',TRUE);
       $driverIdnumber=$this->input->post('driverIdnumber',TRUE);
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
                                          ,'carNumber'=>$carNumber,'carNumber2'=>$carNumber2
                                        ,  'packageId' => $packageId
                                         ,  'driverCountryId' => $driverCountryId
                                          ,  'driver_trip_type' => $driver_trip_type
                                        ,  'driverCityId' => $driverCityId
                                        ,  'networkId' => $networkId
                                        ,  'adminId' => $adminId
                                        ,  'driverGender' => $driverGender
                                        ,  'driverSmoker' => $driverSmoker
                                        ,  'brandId' => $brandId
                                        ,'driverIdnumber'=>$driverIdnumber
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
                                        //,'driver_payLevel'=>$driver_payLevel
                                        ,'sequenceNumber'=>$sequenceNumber
						   ); 
						  $sa=str_split($carNumber);
              $endPoint = $this->input->post('endPoint');
                              
						
{
	//yahia code Start
	$user = ($pageid)?$this->db->where('driverId',$pageid)->get('drivers')->result_array():false;
	if(!$user || empty($user['captainReferenceNumber']) || empty($user['vehicleReferenceNumber']))
	{
		if(empty($user['captainReferenceNumber']))
		{
            $checkDriver= $this->checlDriverApi($driverIdnumber,$driverbirth,$driverEmail,$driverMobile);
            if($checkDriver['resultMessage']=='Success')
            {
                $data['captainReferenceNumber']=$checkDriver['referenceNumber'];
                
            }
            else {
                echo "<script>alert('".$checkDriver['resultMessage']."')</script>";
                die();
            }

				
				
		}
		if(empty($user['vehicleReferenceNumber']))
		{
            $checkCar=$this->checkCarApi($carNumber2,$carNumber,$sequenceNumber);
            if($checkCar['resultMessage']=='Success')
            {
                $data['vehicleReferenceNumber']=$checkCar['vehicleReferenceNumber'];
                
            }
            else {
                echo "<script>alert('".$checkCar['resultMessage']."')</script>";
                die();
            }
	
		}
		
	}
	//yahia code End
}
//die();
          
             if($pageid) //update
						    {
                              if($driverPass!='')
                                   $data['driverPass']=md5($driverPass);
							 $this->db->where('driverId',$pageid);
						     $this->db->update('drivers', $data);
						      delete_cookie('driverid');
                                    
                               			
                                                         if($endPoint && strlen($endPoint)==98){
								$title = 'congratulations';
								$msg = 'your account has been activated';
								$message['default'] = $msg;
								$message['GCM'] = json_encode(array('data'=>array('message'=>$msg,'title'=>$title)));
								$message['APNS'] =json_encode(array('aps'=>array('alert' => $msg,'title'=>$title)));
								
								$re= $this->s3->publish(array('TargetArn' => $endPoint,'Message' => json_encode($message),'MessageStructure' => 'json'));
                                     }
							
							}else{  //insert 
                              $data['driverPass']=md5($driverPass);
                             // $data['driverActivation']='0';
                              $data['driverCreateDate']=date('Y-m-d');
						      $this->db->insert('drivers', $data);
                              $_SESSION['driverCount']= $_SESSION['driverCount']+1;
                              $pageID=$this->db->insert_id();
                 $this->addDefaultCredit($pageID);
                 
                             
						    }
						echo "<script>document.location='".base_url('drivers/driverList')."';</script>";
          //  redirect(base_url('drivers/driverList'));
						  
	          } else {
			   
			    redirect(base_url());
			   
			   }   
    }
    //*****************************************//
    function checlDriverApi($driverIdnumber='',$birthdate='',$driverEmail='',$driverMobile='')
    {
        $form_url = "https://wasl.elm.sa/WaslPortalWeb/rest/DriverRegistration/send";
			$data_to_post = array();
			$data_to_post['apiKey'] = $this->config->item('waslApiKey');
			$data_to_post['captainIdentityNumber'] = $driverIdnumber;
			$data_to_post['dateOfBirth'] = $birthdate;
			$data_to_post['emailAddress'] = $driverEmail;
			$data_to_post['mobileNumber'] = '966'.ltrim(ltrim($driverMobile,'966'),0);
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_URL, $form_url);
			curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
			curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data_to_post));
			curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($curl);
			curl_close($curl);
			$result = json_decode($result, true);
        
		/*	if($result['resultMessage']=='Success')
			{$msg='';
             $reference=$result['referenceNumber'];
			if($result['referenceNumber'])
				$this->db->where('driverId',$pageid)->update('drivers', array('captainReferenceNumber'=>$result['referenceNumber']));
				}else {
				$msg=$result['resultMessage'];
                $reference=''
				}*/
        return $result;
				
    }
    //***********************************************//
    function checkCarApi($carNumber2='',$carNumber='',$sequenceNumber='')
    {
        	$carNumberList=explode(' ',$carNumber2);
			$form_url = "https://wasl.elm.sa/WaslPortalWeb/rest/VehicleRegistration/send";
			$data_to_post = array();
			$data_to_post['apiKey'] = $this->config->item('waslApiKey');
			$data_to_post['plateLetterRight'] = $carNumberList[0];
			$data_to_post['plateLetterMiddle'] = $carNumberList[1];
			$data_to_post['plateLetterLeft'] = $carNumberList[2];
			$data_to_post['plateNumber'] = $carNumber;
			$data_to_post['plateType'] = 2;
			$data_to_post['vehicleSequenceNumber'] = $sequenceNumber;
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_URL, $form_url);
			curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
			curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data_to_post));
			curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_ENCODING ,"");
			$result = curl_exec($curl);
			curl_close($curl);
			$result = json_decode($result, true);
			/*if($result['resultMessage']=='Success')
			{$msg='';
			if($result['vehicleReferenceNumber'])
				$this->db->where('driverId',$pageid)->update('drivers', array('vehicleReferenceNumber'=>$result['vehicleReferenceNumber']));
				print_r($result);
				} else {
				$msg=$result['resultMessage'];
				}*/
        return $result;
    }
    //*****************************//
    function addDefaultCredit($id='')
    {
        
						 $data =  array('acc_date' => date('Y-m-d')
                                        ,  'acc_driver' => $id 
                                        ,  'acc_mode' => 1
                                        ,  'acc_value' => 10
                                        ,  'acc_com_id' => 1
                                       
                                        );
         $this->db->insert('accounts', $data);
                            //  $pageID=$this->db->insert_id();
    }
//=========================
 function DeleteDriver()
   {
       $id=$this->uri->segment(3);
     $status=$this->uri->segment(4);
			 if($this->session->userdata('id'))
			   {			
						if($id)
						   {
                            
                             
                                   $this->db->where('driverId', $id);
                                   $this->db->delete('drivers'); 
                            
						   }
						 redirect(base_url('drivers/driverList'));
				} else {
			  redirect(base_url());
			 }		   
					   
   } 
    //***********************************//
    function driverEmpty()
    {
        $id=$this->uri->segment(3);
			 if($this->session->userdata('id'))
			   {			
						if($id)
						   {
                            //$data=array('deviceId'=>'');
                            $this->db->set('deviceId','');
						   $this->db->where('driverId', $id);
						   $this->db->update('drivers'); 
						   }
						 redirect(base_url('drivers/driverList'));
				} else {
			  redirect(base_url());
			 }	  
    }
    //*******************************************//
  function  driverList()
	  {
	  
	  if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->driver_List();//tblLIst('drivers');	
				   $data['pageTitle']=lang('DriverList');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/page_list',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
			   }
	  
	  }	
      //*********************************/
   function get_Model()
    {$brand_id = $this->uri->segment(3); 
        $data['models'] = $this->users->tblLIst('models','brandId',$brand_id);
	$this->load->view('admin/drivers/get_models',$data);
    }
   /******************************/
    function checkCode()
    {  $code=$_REQUEST['fieldValue'];//$this->input->post('fieldValue',TRUE);
        $validateId=$_REQUEST['fieldId'];
        if(isset($_COOKIE['driver_id']) && $_COOKIE['driver_id']!='')
            $wh=' driverId <>'.$_COOKIE['driver_id'];
        else $wh='';
         $check = $this->users->tblLIst('drivers','drivercode',$code,$wh);
        $arr= array();
        $arr[0] = $validateId;
            if(count($check)>0){
              $arr[1] = false;	
            }else{
               $arr[1] = true;	
            }
        echo json_encode($arr);	
    }
    //***********************************//
    function check_Seq()
    {
         $name=$_REQUEST['fieldValue'];//$this->input->post('fieldValue',TRUE);
        $validateId=$_REQUEST['fieldId'];
         if(isset($_COOKIE['driver_id']) && $_COOKIE['driver_id']!='')
            $wh=' driverId <>'.$_COOKIE['driver_id'];
        else $wh='';
        $checkA=$this->users->tblLIst('drivers','sequenceNumber',$name,$wh);
       // $arr= array();
       // $arr[0] = $validateId;
            if(count($checkA)>0){
              $arr= array($validateId,false);
            }else{
                $arr= array($validateId,true);
            }
        //$arr= array($validateId,$sts);
        echo json_encode($arr);	
    }
    //***************************//
     function checkID()
    {
        $code=$_REQUEST['fieldValue'];//$this->input->post('fieldValue',TRUE);
        $validateId=$_REQUEST['fieldId'];//$this->input->post('code', TRUE);
          if(isset($_COOKIE['driver_id']) && $_COOKIE['driver_id']!='')
            $wh=' driverId <>'.$_COOKIE['driver_id'];
        else $wh='';
         $check = $this->users->tblLIst('drivers','driverIdnumber',$code,$wh);
      /*  if(count($check)>0)
            $html='1';
        else $html='0';
        echo $html;*/
          $arr= array();
        $arr[0] = $validateId;
            if(count($check)>0){
              $arr[1] = false;	
            }else{
               $arr[1] = true;	
            }
        echo json_encode($arr);	
    }
    //*********************************//
     function checkMobile()
    {
        $code=$_REQUEST['fieldValue'];//$this->input->post('fieldValue',TRUE);
        $validateId=$_REQUEST['fieldId'];//$this->input->post('code', TRUE);
          if(isset($_COOKIE['driver_id']) && $_COOKIE['driver_id']!='')
            $wh=' driverId <>'.$_COOKIE['driver_id'];
        else $wh='';
         $check = $this->users->tblLIst('drivers','driverMobile',$code,$wh);
      /*  if(count($check)>0)
            $html='1';
        else $html='0';
        echo $html;*/
          $arr= array();
        $arr[0] = $validateId;
            if(count($check)>0){
              $arr[1] = false;	
            }else{
               $arr[1] = true;	
            }
        echo json_encode($arr);	
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
    {  $id=$this->uri->segment(3);
          if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->driverComment();//tblLIst('		`trips`  INNER JOIN passengers ON tripPassengerId = passengers.passengerId  LEFT JOIN countries ON tripCountryId = countries.countryId  LEFT JOIN cities ON tripCityId = cities.cityId','tripDriverId',$id,'tripLeaveComment <>""');	
				   $data['pageTitle']=lang('CommentList');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/drivers/comment_list',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
			   }
	  
    }
//=====*/=============================== 
  


}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */