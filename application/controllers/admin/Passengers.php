<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Passengers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/passengers_model','users');		
	}
//######################	
function profile()
	  {
	
	   $id=$this->session->userdata('id');//$this->uri->segment(4);
	   if($this->session->userdata('id'))
			   {
				  // $data['Categorys'] = $this->projects->Categorys();
				  if($id && $id!='saved') 
					   {    
							$data['page'] = $this->users->Details($id);
							$data['pageTitle']=lang('Myprofile');
					   } else {
	 						$data['pageTitle']='Add User';
					   }
				  
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 }
				    
				  $this->template->load('admin/Container', 'admin/Passengers/form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/admin');
			   
			   }
	  
	  }	
//===========#######################members######################=====================
function Form()
	  {
	   $id=$this->uri->segment(4);
	   if($this->session->userdata('id')  )
			   {
			      
				  // $data['Categorys'] = $this->projects->Categorys();
				   
				  if($id && $id!='saved') 
				   {    

						$data['page'] = $this->users->Details($id);
						 
						$data['pageTitle']='Edite Users';
				  
				   } else {
				    
 						$data['pageTitle']='Add User';
				  
				   }
				   
				   
				   
						 
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 } 
				  $this->template->load('admin/Container', 'admin/passengers/form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/admin');
			   
			   }
	  
	  }	
//============================
function Save()
	   {
	 
	  $id=$this->input->post('id', TRUE); 
	  $userEmail=$this->input->post('userEmail', TRUE);
	  $password=$this->input->post('password', TRUE);
	  $userName=$this->input->post('userName', TRUE);
    $ChangePassword=$this->input->post('ChangePassword', TRUE);
    $sendEmail=$this->input->post('sendEmail', TRUE);
     $fun=$this->input->post('fun', TRUE);
	 $timeZone=$this->input->post('timeZone', TRUE);
	  /* $country=$this->input->post('country', TRUE);
	  $address=$this->input->post('address', TRUE);
	  $job=$this->input->post('job', TRUE);
	  $birth_date=$this->input->post('birth_date', TRUE);
	  $random=time();
	  $group=$this->input->post('group', TRUE);
	  
	  $active=$this->input->post('active', TRUE);
	  
	  $admin=$this->input->post('admin', TRUE);
	  $priv=$this->input->post('priv', TRUE);
	  
	 
	

	$mobile_format = array("+"," ","-",".",",");
	$format_mobile =	$mobile;
	$mobile = str_replace($mobile_format,"",$mobile);	
  */
	  $privStr='';
      $blockArrCount=0;
 /*  if($priv!='')
     {		  
		foreach($priv as $x=>$blockAr)
			{
			 $privStr.=$blockAr;
			 if($x<count($priv)-1)  $privStr.=',';
			} 
	 }
	  */
	if($this->session->userdata('userid')=='')
     {   
 			   
			                  
										 $this->db->where("(userName='".$userName."' OR userEmail='".$userEmail."')"); 
 										 if($id)$this->db->where('userId <> ',$id);
										 $emailCount=$this->db->count_all_results('admins'); 
						  
						if($emailCount==0)
							  {	 
								 if($id) //update
									{       
												if($ChangePassword)
												 {
												  $data = array(
												   'userEmail' => $userEmail
												   ,'userPass' => md5($password) 
												   ,'userName' =>$userName
												  ,'timeZone'=>$timeZone
												   ); 
									              }else{
												    $data = array(
												   'userEmail' => $userEmail 
 												   ,'userName' =>$userName
												  ,'timeZone'=>$timeZone
												   ); 
												  }
											 $this->db->where('userId',$id);
											 $this->db->update('admins', $data);
									 
		  
									  }else{  //insert
									  	 $data = array(
										   'userEmail' => $userEmail
												   ,'userPass' => md5($password) 
												   ,'userName' =>$userName		
										   ,'timeZone'=>$timeZone
										   );
											$this->db->insert('admins', $data);
									}
									
								if($sendEmail==1)
								 {	
								 //==Send Message
									  $data['setting'] = $this->setting_model->GeneralSetting();
									  $webSiteTitle=$data['setting']['SiteTitle'];
									  $webSiteEmail=$data['setting']['email'];
									  $to=$email;
							  
							  	 
									
									$msg='Acount data was created for this email address';
									$msg.='<br> Your  Name : '.$username;
									$msg.='<br> Your Email&nbsp; : '.$email;
									$msg.='<br> Your Password : '.$password;
									$msg.='<br> Link : '.site_url();
									$msg.='<br>Regards ';
									
							  		$subject = '[Account Data] '.$webSiteTitle;
									$headers = "From: " . strip_tags($webSiteEmail) . "\r\n";
									$headers .= "Reply-To: ". strip_tags($webSiteEmail) . "\r\n";
									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=utf-8";
									 
 									$message = '<html><body>';
									$message .= '<table rules="all" style="border-color: #666;" cellpadding="10"  width="90%">';
									$message .= "<tr><td>".$msg."</td></tr>";
 									$message .= "</table>";
									$message .= "</body></html>";
									//echo $message.$webSiteEmail;
									$mail_sent =  @mail( $to, $subject, $message, $headers );
									}

                                    if($fun=='profile')
									  {
$this->session->set_flashdata('success', '1');
	
									 redirect(site_url('Passengers/profile/saved')); 
									 } else {
									 	 redirect(site_url('Passengers/memberList')); 
									 }
									 
							   } else {
													  
 													  $this->session->set_flashdata('emailExist', '1');
													  $this->session->set_flashdata('email', $email);
													  redirect(site_url('Passengers/Form/'.$id));
									  }
						
						
	          } else {
			   
			   redirect(site_url('').'admin/admin');
			   
			   }
	   
	   }
//============================
function memberList()
     {
	 
	  if($this->session->userdata('id') && $this->session->userdata('emp_type') == 1)
			   {
  						//$data['pages'] = $this->admin->news_list();
						$data['pageTitle']='Members ';
 	 //################Padging###############//	
						$this->load->library('pagination');		
						$start=$this->uri->segment(4);		
						$config['uri_segment'] = 4;
						$config['num_links'] = 10;
						$config['base_url'] = site_url('Users/memberList');
						$config['total_rows'] = $this->db->count_all('users');
						$config['per_page'] = '50';
						$config['full_tag_open'] = '<div class="pagination"><center>';
						$config['full_tag_close'] = '</center></div>';
						$config['cur_tag_open'] = '<a href="#" class="number current"> ';
						$config['cur_tag_close'] = '</a>';
						$config['first_link'] ='First';
  						$config['last_link'] ='Latest';
  						$config['anchor_class'] =' class="number" ';
						 
 						//$config['next_link'] ='<a href="#" title="Next Page">Next &raquo;</a>';
  						//$config['prev_link'] ='<a href="#" title="Prev Page">Prev &raquo;</a>';
						 
						 $this->pagination->initialize($config);
 						 $data['pages']=$this->users->members_list($start,$config['per_page']);
						 $data['pageingLinks']=$this->pagination->create_links();
	  //################Padging###############//
 					   $this->template->set('adminMenue','Employees');
					  $this->template->set('adminSubMenue','List users');
					  $this->template->load('admin/Container', 'admin/users/list',$data);
		     } else {
			  redirect(site_url('admin'));
			 }
	 }
//=========================
 function delete()
   {
    $id=$this->uri->segment(4);
			 if($this->session->userdata('id'))
			   {			
						if($id && $id>1)
						   {
						   $this->db->where('id', $id);
						   $this->db->delete('users'); 
						   }
						 redirect(site_url('Users/memberList'));
				} else {
			  redirect(site_url('').'/admin/admin');
			 }		   
						   
   }	 
//==================================== 
function invitationForm()
  {
       $email=$this->uri->segment(4);
	   if($this->session->userdata('id'))
			   {
			       $data['email']=$email;
				   
				  $this->template->set('adminMenue','Employees');
				  $this->template->set('adminSubMenue','Add user');
				  $this->template->load('admin/Container', 'admin/users/invite_form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/admin');
			   
			   }
  }
function sendInvite()
  {
  	  $email=$this->input->post('email', TRUE);
 	  $username=$this->input->post('username', TRUE);
	  
	     $this->db->where("(name='".$username."' OR email='".$email."')"); 
		 $emailCount=$this->db->count_all_results('users'); 
		 
		 $time=time();
		 if($emailCount==0)
			 {
			  	  	 $data = array(
							   'email' => $email 
							   ,'reg_date' => date('Y-m-d')
							   ,'name' =>$username
							   ,'time' =>$time
							   ,'random' =>$time
							   );
						$this->db->insert('users', $data);
						$id=$this->db->insert_id();
						
			 } else {
			 
			 	     $this->db->from('users');
					 $userquery = $this->db->get();
					 $user=$userquery->row_array();
			         $id=$user['id'];
			  	  	 $data = array('time' =>$time);
			          $this->db->where('email',$email);
					  $this->db->update('users', $data);
			 }	
			 
			 
			  //==Send Message
								  $data['setting'] = $this->setting_model->GeneralSetting();
								  $webSiteTitle=$data['setting']['SiteTitle'];
								  $webSiteEmail=$data['setting']['email'];
								  $to=$email;
						  
							 
								    $msg='<br> مرحبا : '.$username;
									$msg.='<br> تم انشاء حساب خاص بك';
									
									//$msg.='<br> البريد الالكترونى : '.$email;
									$msg.='<br> من فضلك قم باستكمال بياناتك من خلال الرابط التالى ';
									//$msg.='<br> Your Password : '.$password;
									$msg.='<br> <a href="'.site_url('staff/Register/'.$id.'/'.$time).'" >  رابط اسكتمال البيانات </a>   ';
									$msg.='<br>  يرجى العلم سيتم ايقاف الرابط بعد 72 ساعة من وصول البريد الالكترونى اليك ';
									$msg.='<br> مع الشكر ';
									$msg.='<br> '.$webSiteTitle;
									
							  		$subject = '[Employee Account Data] '.$webSiteTitle;
									$headers = "From: " . strip_tags($webSiteEmail) . "\r\n";
									$headers .= "Reply-To: ". strip_tags($webSiteEmail) . "\r\n";
									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=utf-8";
									 
 									$message = '<html><body>';
									$message .= '<table rules="all" style="border-color:#666;font-family:tahoma;font-size:12px;line-height:2;" cellspacing="10"  width="90%"  dir="rtl" align="right" >';
									$message .= "<tr><td>".$msg."</td></tr>";
 									$message .= "</table>";
									$message .= "</body></html>";
									if(site_url()=='http://localhost/work/sudan/medc/index.php')
									 {
									   echo $message;
								       exit;
									 }
									$mail_sent =  @mail( $to, $subject, $message, $headers );
									
									redirect(site_url('Users/invitationForm/'.$email));
			 
  
  }  
//===========#######################forgetAdminPassword######################=====================
function forgetAdminPassword()
	   {
	     if($this->session->userdata('id'))
			   {
			          
					  $this->template->set('adminMenue','Dashboard');
					  $this->template->set('adminSubMenue',' ');
  			          $this->template->load('admin/Container', 'admin/main/main'); 
			   
			   } else {
			   
					$data['Error']='0';
					$data['websitesetting']=$this->setting_model->GeneralSetting(lang('lang'));
					$this->load->view('admin/forget_password',$data); 
					
 			   }
	   }	
//============================
function sendAdminPassword()
      { 
	      $username=$this->input->post('username', TRUE);
		  
		  
		 if($this->uri->segment(4)=='ajax')
		   {
			 $username=$this->uri->segment(5);
			// $password=$this->uri->segment(6);
		   }
  
		  $data['websitesetting']=$this->setting_model->GeneralSetting(lang('lang'));
	      if($this->session->userdata('id'))
			   {
			          
					  $this->template->set('adminMenue','Dashboard');
					  $this->template->set('adminSubMenue',' ');
  			          $this->template->load('admin/Container', 'admin/main/main'); 
			   } else if($username=='') {
			        $data['Error']='1';
 					$this->load->view('admin/forget_password',$data); 
			   } else {
			          $data['Error']='0';
					  $this->db->select('*');
					  $this->db->where('username',$username);
					  $this->db->or_where('email',$username);
					  $query = $this->db->get('users');
					  $userData=$query->row_array();
 					  
					  //print_r($userData); echo count($userData);exit();
 					  if(count($userData)>0)
					     {    $data['Error']='2';
					          //==Send Message
							  $data['setting'] = $this->setting_model->GeneralSetting();
							  $webSiteTitle=$data['setting']['SiteTitle'];
							  $webSiteEmail=$data['setting']['email'];
							  $to=$userData['email'];
 							  //=====
							        $msg='Welcome '.$userData['username'];
									$msg.='<br> Your UserName : '.$userData['username'];
									$msg.='<br> Your Email&nbsp; : '.$userData['email'];
									//$msg.='<br> Your Password : '.$userData['password_open'];
									
									if($userData['active']<>'1')
									   {
									    $msg.='<br> But You can not access AdminCp cause you are not active';
									    $msg.='<br> you can ask admin manager '.$webSiteEmail;
									   }
									   else if($userData['admin']<>'1')
									   {
									     $msg.='<br> But You can not access AdminCp cause you do not have admin privilage';
										 $msg.='<br> you can ask admin manager '.$webSiteEmail;
									   }else{
									     $msg.='<br>  You can not access AdminCp with using  your UserName (UserName or Email) and your Password  ';
									   }
									
									$msg.='<br> Regrads';
									//echo $msg;exit;
							  		$subject = $webSiteTitle.' Your AdminCP Password';
									$headers = "From: " . strip_tags($webSiteEmail) . "\r\n";
									$headers .= "Reply-To: ". strip_tags($webSiteEmail) . "\r\n";
									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=utf-8";
									 
 									$message = '<html><body>';
									$message .= '<table rules="all" style="border-color: #666;" cellpadding="10"  width="90%">';
									$message .= "<tr><td>".$msg."</td></tr>";
 									$message .= "</table>";
									$message .= "</body></html>";
									//echo $message.$webSiteEmail;
									$mail_sent =  @mail( $to, $subject, $message, $headers );
									
									
									  if($this->uri->segment(4)=='ajax')
						  				 {
  											$arr = array('send' => 1);
											echo json_encode($arr);
 										 }
							  //=====
					     } else {
					     				 
					     			     $data['Error']='3';
							
									  if($this->uri->segment(4)=='ajax')
						  				 {
  											$arr = array('send' => '0');
											echo json_encode($arr);
 										 }
						 }
					   
					  //$this->load->view('admin/forget_password',$data); 
					
 			   }
	  
	  }
//===========#######################PageS######################=====================
    function  passengerList()
	  {
	  
	   if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->members('passengers');	
				   $data['pageTitle']=lang('Passengers');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/Passengers/page_list',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
    
//===========#######################PageS######################=====================
    function  passengerForm()
	  {
	   $id=$this->uri->segment(4);
	  
	   
	   if($this->session->userdata('id'))
			   {
                
				$data['package'] = $this->users->getTable('packages','packageStatus','1');
                    $data['countries'] = $this->users->getTable('countries','countryStatus','1');
 				  $data['cities'] = $this->users->getTable('cities','countryId',$data['countries'][0]['countryId'],'cityStatus');
  			
			     if(!$id){
				   $data['pageTitle']=lang('Add_passenger');
                 }else {
                      $data['page']=$page = $this->users->PageDetails("passengers","passengerId",$id);
                      $data['cities'] = $this->users->getTable('cities','countryId',$page['passengerCountryId'],'cityStatus');
                     $data['pageTitle']=lang('edit_passenger');
                 }
           	  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/Passengers/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
    //***************************
    function SavePassenger()
    {
       $pageid=$this->input->post('pageid', TRUE); 
	 $passengerName=$this->input->post('passengerName', TRUE);
	 $passengerEmail=$this->input->post('passengerEmail', TRUE);
//
	  $passengerMobile=$this->input->post('passengerMobile', TRUE);
	 $passengerPass=$this->input->post('passengerPass', TRUE);
 
        
        $packageId=$this->input->post('packageId', TRUE);
	 $passengerCountryId=$this->input->post('passengerCountryId', TRUE);
//
	  $passengerCityId=$this->input->post('cityId', TRUE);
	 $passengerSmoker=$this->input->post('passengerSmoker', TRUE);
        
         $passengerGender=$this->input->post('passengerGender', TRUE);
	 $img=$this->input->post('attached_files_image', TRUE);
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('passengerName' => $passengerName
						   ,  'passengerEmail' => $passengerEmail 
						 ,  'passengerMobile' => $passengerMobile 
                                        ,  'packageId' => $packageId
                                        ,  'passengerCountryId' => $passengerCountryId 
                                        ,  'passengerCityId' => $passengerCityId 
                                        ,  'passengerSmoker' => $passengerSmoker 
                                        ,  'passengerGender' => $passengerGender
                                         ,  'passengerImage' => $img
						   ); 
						  
						  if($pageid) //update
						    {
                              if($passengerPass!='')
                                   $data['passengerPass']=md5($passengerPass);
							 $this->db->where('passengerId',$pageid);
						     $this->db->update('passengers', $data);
                             
							}else{  //insert
                              $data['passengerPass']=md5($passengerPass);
                              $data['passengerActivation']='0';
						      $this->db->insert('passengers', $data);
                              $pageID=$this->db->insert_id();
                             
						    }
						
            redirect(base_url('admin/passengers/passengerList'));
						  
	          } else {
			   
			    redirect(base_url('admin/admin'));
			   
			   }   
    }
//=========================
 function DeletePassenger()
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
    function checkItemUnique()
    {
        $val=$this->input->post('val', TRUE);//$_REQUEST['val'];
         $mode=$this->input->post('mode', TRUE);//$_REQUEST['mode'];
    //    echo $val.' ****** '.$mode;
        $check=array();
      if($mode==1)//email
      {
           $check = $this->users->getTable("passengers","passengerEmail",$val);
          $msg='  Error. This email address aleardy exist , please choose another email.';
      }else if($mode==2)
      {
          $check = $this->users->getTable("passengers","passengerMobile",$val); 
           $msg='  Error. This mobile number  aleardy exist , please choose another number.';
      }
      //  echo count($check);
        if(count($check)>0)
        {
            echo "<script>$('#erroPlace').css('display','block');$('#msgPlace').html('".$msg."')</script>";
         // $this->session->set_flashdata('emailExist', '1');  
          //  $this->session->set_flashdata('checkMsg', $msg);   
        }else {
            echo "<script>$('#erroPlace').css('display','none');;</script>";  
        }
    }
//==================================== 


}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */