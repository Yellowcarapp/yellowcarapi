<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/users_model','users');		
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
							$data['pageTitle']='My Profile';
					   } else {
	 						$data['pageTitle']='Add User';
					   }
				  
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 }
				    
				  $this->template->load('admin/Container', 'admin/users/form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/Admin');
			   
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
						 
						$data['pageTitle']=lang('edit_users');
				  
				   } else {
				    
 						$data['pageTitle']=lang('Add_users');
				  
				   }
           $data['networkList']=$this->users->All('network','network_id','network_active','1');
				    $network= $this->session->userdata('network');
 			  // if($network!='-1')$job=1; else $job=-1;
				   
				   $data['network']=$network;
						 
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 } 
				  $this->template->load('admin/Container', 'admin/members/form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/Admin');
			   
			   }
	  
	  }	
//============================
function Save()
	   {
	 
	  $id=$this->input->post('pageid', TRUE); 
	  $email=$this->input->post('userEmail', TRUE);
	  $password=$this->input->post('userPass', TRUE);
	  $username=$this->input->post('userName', TRUE);
	  
	  $active=$this->input->post('userStatus', TRUE);
	  $timeZone=$this->input->post('timeZone', TRUE);
	  $userLogo=$this->input->post('attached_files_image', TRUE);
	 $priv=$this->input->post('priv', TRUE);
	  
	 // $fun=$this->input->post('fun', TRUE);
	
	
  
	  $privStr='';
      $blockArrCount=0;
   if($priv!='')
     {		  
		$privStr=implode(',',$priv);
	 }
	  
	if($this->session->userdata('userid')=='')
     {   
		 //$network= $this->session->userdata('network');
		 $network= $this->input->post('networkID', TRUE);
 			   if($network!='-1')$job=1; else $job=-1;
			                  
										 $this->db->where("(userName='".$username."' OR userEmail='".$email."')"); 
 										 if($id)$this->db->where('userId <> ',$id);
										 $emailCount=$this->db->count_all_results('admins'); 
						  
						if($emailCount==0)
							  {	if(isset($id)&& $id!=''){ 
								  $data = array(
												   'userEmail' => $email 
												    ,'timeZone'=>$timeZone
												   ,'userName' =>$username
												  ,'job' =>$job
												   ,'priv' =>$privStr
												   ,'network' =>$network
												   ,'userStatus' =>$active
												   ,'userLogo'=>$userLogo
												  
												   );
                            if($password!='')$data['userPass'] = md5($password);
											 $this->db->where('userId',$id);
											 $this->db->update('admins', $data);
									 
		  
									  }else{  //insert
									  	   $data = array(
												   'userEmail' => $email 
												   ,'userPass' => md5($password) 
												   ,'userName' =>$username
												  ,'network' =>$network
												   ,'priv' =>$privStr
                                                ,'timeZone'=>$timeZone
												,'job' =>$job
												   ,'userStatus' =>$active
												   ,'userLogo'=>$userLogo
												  
												   ); 
											$this->db->insert('admins', $data);
									}
									
								
                                 
	
									
									 	 redirect(site_url('admin/Users/memberList')); 
									 
									 
							   } else {
													  
 													  $this->session->set_flashdata('emailExist', '1');
													  $this->session->set_flashdata('email', $email);
													  redirect(site_url('admin/Users/Form/'.$id));
									  }
						
						
	          } else {
			   
			   redirect(site_url('').'admin/Admin');
			   
			   }
	   
	   }
//============================
function memberList()
     {
	 
	  if($this->session->userdata('id') )
			   {
  						//$data['pages'] = $this->admin->news_list();
						$data['pageTitle']=lang('Users');
						
 						 $data['pages']=$this->users->members();
						 
 					   $this->template->set('adminMenue','Employees');
					  $this->template->set('adminSubMenue','List users');
					  $this->template->load('admin/Container', 'admin/members/list',$data);
		     } else {
			  redirect(site_url('admin/Admin'));
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
						   $this->db->where('userId', $id);
						   $this->db->delete('admins'); 
						   }
						 redirect(site_url('admin/Users/memberList'));
				} else {
			  redirect(site_url('').'/admin/Admin');
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
			   
			   redirect(site_url('').'/admin/Admin');
			   
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
									
									redirect(site_url('admin/Users/invitationForm/'.$email));
			 
  
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
    function  Members()
	  {
	  
	   if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->members('users');	
				   $data['pageTitle']='Member List';
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/clients/page_list',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
    
//===========#######################PageS######################=====================
    function  MemberDetails()
	  {
	   $id=$this->uri->segment(4);
	  
	   
	   if($this->session->userdata('id'))
			   {
			     
				   $data['pageTitle']='Members';
				  $data['page'] = $this->users->PageDetails("users","user_id",$id);
				  //$data['pages'] = $this->users->MemberAddress($id);
 				
  				  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/clients/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin/admin'));
			   
			   }
	  
	  }	
//=========================
 function DeleteClient()
   {
       $id=$this->uri->segment(4);
			 if($this->session->userdata('id'))
			   {			
						if($id)
						   {
						   $this->db->where('user_id', $id);
						   $this->db->delete('users'); 
						   }
						 redirect(base_url('admin/users/Members'));
				} else {
			  redirect(base_url('').'/admin/admin');
			 }		   
						   
   }    
//==================================== 


}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */