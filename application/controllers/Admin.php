<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
 
function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/Admin_model','admin');		
	}

	function AddTrip($passengerId=false)
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$_POST['coords'] = json_decode($_POST['coords']);
			$_POST['tripDriverId'] = intval($_POST['tripDriverId']);
			$_POST['from']=array('location'=>json_decode($_POST['tripFrom']),'address'=>$_POST['tripFromAddress']);
			$_POST['to']=array('location'=>json_decode($_POST['tripTo']),'address'=>$_POST['tripToAddress']);
			
			$Passenger = $this->db->where('passengerId',$passengerId)->get('passengers')->row_array();
 			/*$prices = $this->db->where('typeId',$_POST['tripType'])
						->where('levelId',$_POST['tripLevelId'])
						->where('packageId',1)
						->where('cityId',3)
						->get('prices')
						->row_array();
			if($prices && is_array($prices) && !empty($prices))
			{
				$_POST['tripStart'] = $prices['nowStart'];//laterStart
				$_POST['tripPerKm'] = $prices['perKm'];
				$_POST['tripPerMinute'] = $prices['perMinute'];
				$_POST['tripMinCost'] = $prices['minNow'];//minLater
				$_POST['tripWaitingPerHour'] = $prices['WaitingperHour'];
			}*/
			unset($_POST['coords']);
			unset($_POST['tripTo']);
			unset($_POST['tripFrom']);
			unset($_POST['tripToAddress']);
			unset($_POST['tripFromAddress']);
			if($_POST['tripNow'])unset($_POST['tripDueDate']);
			$send['networkId'] = $this->session->userdata('network');
			$send['trip'] = $_POST;
			$send['passenger'] = $Passenger;
			$send = json_encode($send);
			
			//$ch = curl_init('http://taxinew.mybluemix.net/api/trip');                                                                      
            $ch=curl_init($this->config->item('APISERVER').'trip');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $send);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($send))                                                                       
			);                                                                                                                   
			$result = curl_exec($ch);
		
			header('Content-Type: application/json');
			echo json_encode($result);
			die();
		}
		if($passengerId)
		{
			$data['Passenger'] = $this->db->where('passengerId',$passengerId)->get('passengers')->row_array();
			$data['tripTypes']=$this->db->get('tripTypes')->result_array();
			$data['Levels']=$this->db->get('levels')->result_array();
			$data['Drivers']=$this->db->get('drivers')->result_array();
			$this->load->view('admin/main/AddTrip',$data);
		}
		else 
		{
			$data['countries'] = $this->db->where('countrystatus',1)->get('countries')->result_array();
			$this->load->view('admin/main/TripPassenger',$data);
		}
	}
	function CreatePassenger()
	{
		$_POST['passengerMobile'] = $_POST['countryTel'].$_POST['passengerMobile'];
		if(isset($_POST['countryTel']))unset($_POST['countryTel']);
		$this->db->insert('passengers',$_POST);
		header('Content-Type: application/json');
		$data['passengerId'] = $this->db->insert_id();
		echo json_encode($data);
	}
	function CheckPassenger()
	{
		header('Content-Type: application/json');
		$data = $this->db->where('passengerMobile',$this->input->post('countryTel').ltrim($this->input->post('passengerMobile'),'0'))
					->get('passengers')->row_array();
		echo json_encode($data);
	}
 //===========================
	function index()
		{
       // echo $this->session->userdata('id');
		
		   if($this->session->userdata('id'))
			   {

						
					/*  $data['open_orders'] = $this->admin->get_open_orders();
                      $data['approved_orders'] = $this->admin->get_approved_orders();
					  $data['ready_orders'] = $this->admin->get_ready_orders();	
                      
                      $data['readypickup_orders'] = $this->admin->get_readypickup_orders();
                      $data['assignedtodriver_orders'] = $this->admin->get_assignedtodriver_orders();
                      
					  $data['delivered_orders'] = $this->admin->get_delivering_orders();	
					  $data['not_delivered'] = $this->admin->get_delivered_orders();	
                      $data['canceled_orders'] = $this->admin->get_canceled_orders();*/
					  $settings = $this->db->get('settings')->result();
					  $startPoint;
					  foreach($settings as $setting)
					  {
						  if($setting->name=='MApStartPoint')
						  $data['startPoint']= explode(',',$setting->value);
					  }
					  $data['countries']=$this->db->get('countries')->result();
					  $data['cities']=$this->db->get('cities')->result();
					  $data['levels']=$this->admin->get_Levels();//$this->db->select('levelId as id,levelName_'.lang('db').' as name')->from('levels')->result();
					  $data['MAIN'] = "MAIN";	
					  $this->template->set('adminMenue','Dashboard');
					  $this->template->set('adminSubMenue',' ');
  			          $this->template->load('admin/Container', 'admin/main/main',$data); 
			   } else {
					$data['Error']='0';
					//$data['websitesetting']=$this->setting_model->GeneralSetting(lang('lang'));
					$this->load->view('admin/login',$data); 
 			   }
  
			 
		}
 //===========================
   function filemanager()
       {
		   $data['title']='filemanager';
		   $this->load->view('admin/filemanager_temp',$data); 
	   }
    /***********************************/
    function switchLanguage($language = "") {
         $language=$this->input->post('language', TRUE);
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        echo "<script>document.location.reload();</script>";
       // redirect($_SERVER['HTTP_REFERER']);
    }
 //===========================
   function SignOut()
     {
			 $array_items = array(
			   'id'  => '',
			   'username'  => '',
			   'email'     =>'',
			   'password'     => '',
			   'logged_in' => false
				   );
 		  $this->session->unset_userdata($array_items);
		  
		  	$this->session->sess_destroy();
		  
		  redirect(base_url());
	 }
 //=====================================
function login($ajax=false,$username=false,$password=false)
     {
	    
		 if($this->session->userdata('id'))
			  {
			        redirect(base_url());

			  } else {
			  	
				//echo "ddd";
						 
						 
						 if($ajax!='ajax')
						   {
						 	 $username=$this->input->post('username', TRUE);
						 	 $password=$this->input->post('password', TRUE);
						 }
						 
						 //echo $username.'cc'.$password;
						  if($password && $username) 
							{
							
							 $data['user'] = $this->admin->checkUser($username,$password);
                              $drivers = $this->admin->getNewDrivers($data['user']['network']);
							   if($data['user']['network']!=-1 && $data['user']['network_active']==1  )
                                   $act=1;
                              else if($data['user']['network']==-1 || $data['user']['network']==0)$act=1;
                              else $act=0;
							   if(isset($data['user']['userId']) && $data['user']['userId'] && $act==1 )
								  {
                                  
									
                                   
										$newdata = array(
									   'id'          => $data['user']['userId'],
									   'username'    => $data['user']['userName'],
									   'priv'  => $data['user']['priv'],
									   'email'       => $data['user']['userEmail'],
									   'password'    => $data['user']['userPass'],
                                        'network'    => $data['user']['network'],
                                        'job'    => $data['user']['job'],
                                            'timeZone'=>$data['user']['timeZone'],
                                            'driverCount'=>$drivers,
									   'logged_in'   => TRUE
									   );
                               
                                   
                                   
									$this->session->set_userdata($newdata);
									  
									 
									 
									  if($ajax=='ajax')
						  				 {
  											$arr = array('logged' => 1);
											echo json_encode($arr);
 										 }else{
											redirect(base_url());
										 }
								  }else{ //error user name or password
								  
								  
									  if($ajax=='ajax')
						  				 {
  											$arr = array('logged' => 0,'act'=>$data['user']['network']);
											echo json_encode($arr);
 										 }else{

								   $data['Error']='1';
								   $data['websitesetting']=$this->setting_model->GeneralSetting(lang('lang'));
								   $this->load->view('admin/login',$data); 										 }
								  
								  }
						   
							}else{
							 
							redirect(base_url());
							
							}
			
			}
	 
	 }
// ==========##############################Contact_us####################=====================
function Contact_us($emailerror='')
{
	
			if ($this->uri->segment(3) === FALSE)
				{
					$resultNotification = 0;
				}
				else
				{
					$resultNotification = $this->uri->segment(3); // 1 saved sucess 2 email error
				}
					
	  		  if($this->session->userdata('id'))
			   {
			      $data['setting'] = $this->admin->webSettings($this->session->userdata('id'));
				  $data['resultNotification']=$resultNotification; 
				  //$this->template->set('adminMenue','Website Settings');
				  //$this->template->set('adminSubMenue','');
				  $this->template->load('admin/Container', 'admin/main/contact_us',$data); 
		       
			   } else {
			   
			   		redirect(base_url());
			   
			   }	

}	 
//===========#######################Settings######################=====================
function Settings($emailerror='')
    {
	
			if ($this->uri->segment(3) === FALSE)
				{
					$resultNotification = 0;
				}
				else
				{
					$resultNotification = $this->uri->segment(3); // 1 saved sucess 2 email error
				}
					
	  		  if($this->session->userdata('id'))
			   {
			      $data['setting'] = $this->admin->webSettings($this->session->userdata('id'));

 				  $data['lat']=$data['setting']['lat'];
				  $data['lon']=$data['setting']['lon'];
				  $data['zoom']=$data['setting']['zoom'];	
				  $data['edit']=true;				  
				  
				  $data['resultNotification']=$resultNotification; 
				  $this->template->set('adminMenue','Website Settings');
				  $this->template->set('adminSubMenue','');
				  $this->template->load('admin/Container', 'admin/main/setting_info',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
			   }
	 
	}
 //===============================	
function SaveSettings()
	 {
	
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	 $phone=$this->input->post('phone', TRUE);
	 $mob = $this->input->post('mob', TRUE);
	 $fax=$this->input->post('fax', TRUE);
	 $address_en=$this->input->post('address_en', TRUE);
	 $address_ar=$this->input->post('address_ar', TRUE);
	 $contacts_en=$this->input->post('contacts_en');
	 $contacts_ar=$this->input->post('contacts_ar');
	 
	 $POBox=$this->input->post('POBox', TRUE);
	 $description_ar=$this->input->post('description_ar', TRUE);
	 $description_en=$this->input->post('description_en', TRUE);
	 $keyword_ar=$this->input->post('keyword_ar', TRUE);
	 $keyword_en=$this->input->post('keyword_en', TRUE);
	 $hr_email=$this->input->post('hr_email');
	 $email=$this->input->post('email', TRUE);
	 $facebook=$this->input->post('facebook', TRUE);
	 $twiter=$this->input->post('twiter', TRUE);
	 $rss=$this->input->post('rss', TRUE);
	 $youtube=$this->input->post('youtube', TRUE);	 
	 $youtube_user=$this->input->post('youtube_user', TRUE);	 	 
	 $username=$this->input->post('username', TRUE);
	 $password=$this->input->post('password', TRUE);
	 $google_analytic=$this->input->post('google_analytic');
	 $ElectronicLibraryLink=$this->input->post('ElectronicLibraryLink');
	 
	 $programs_sh_en=$this->input->post('programs_sh_en');
	 $programs_sh_ar=$this->input->post('programs_sh_ar');
	 $research_sh_en=$this->input->post('research_sh_en');
	 $research_sh_ar=$this->input->post('research_sh_ar');
	 
	 $title_fr=$this->input->post('title_fr', TRUE);
	 $keyword_fr=$this->input->post('keyword_fr', TRUE);
	 $description_fr=$this->input->post('description_fr', TRUE);
	 $contacts_fr=$this->input->post('contacts_fr');
	 
	  $lat=$this->input->post('contact_latitude');
	  $lon=$this->input->post('contact_longitude');
	  $zoom=$this->input->post('zoom_level');

	 $this->load->helper('email');
//echo $phone; exit;
			if (valid_email($email))
			{
			      
						  $data = array(
							   'title_en' => $title_en,
							   'title_ar' => $title_ar,
							   'phone' => $phone,
							   'mob' => $mob,
							   'fax' => $fax,
							   'address_en' => $address_en,
							   'address_ar' => $address_ar,
							   'contacts_ar' => $contacts_ar,
							   'contacts_en' => $contacts_en,
							   'POBox' => $POBox,
							   'description_ar' => $description_ar,
							   'description_en' => $description_en,
							   'keyword_ar' => $keyword_ar,
							   'keyword_en' => $keyword_en,
							   'hr_email' => $hr_email,
							   'email' => $email,
							   'facebook' => $facebook,
							   'twiter' => $twiter,
							   'rss' => $rss,		
							   'youtube' => $youtube,
							   'youtube_user' => $youtube_user,
							   'google_analytic' => $google_analytic
							   ,'ElectronicLibraryLink'=>$ElectronicLibraryLink
							   ,'programs_sh_en'=>$programs_sh_en
							   ,'programs_sh_ar'=>$programs_sh_ar
							   ,'research_sh_en'=>$research_sh_en
							   ,'research_sh_ar'=>$research_sh_ar
   							   ,'title_fr'=>$title_fr
   							   ,'description_fr'=>$description_fr
   							   ,'contacts_fr'=>$contacts_fr
   							   ,'keyword_fr' => $keyword_fr
                               , 'active_type'=>$this->input->post('active_type')
							   , 'manual_activate_text_en'=>$this->input->post('manual_activate_text_en')
							   , 'manual_activate_text_ar'=>$this->input->post('manual_activate_text_ar')
							   , 'lat'=>$lat
							   , 'lon'=>$lon
							   , 'zoom'=>$zoom
							);


						$this->db->where('id','1');
						$this->db->update('settings', $data);
						
						
						
						if($password)
						  {
						  
						   $datau = array(
							   'username' => $username,
							   'password' => md5($password)
							);
						  
						     $this->db->where('id',$this->session->userdata('id'));
						     $this->db->update('users', $datau);
							 
							 		$newdata = array(
									   'id'  => $this->session->userdata('id'),
									   'username'  => $username,
									   'email'     => $this->session->userdata('email'),
									   'password'     => md5($password),
									   'logged_in' => TRUE
										   );
										   
									$this->session->set_userdata($newdata);
							 
						  }
						
						
						
						redirect(base_url('').'Settings/1'); 
				  
			} else {
			
			  redirect(base_url('').'Settings/2');
			  
			}
	 
 
	 
	 
	 
	 }
//================
function alertTBL()
     {
     	
       // $this->db->query('alter table gam3yat_cats  add column cat_time varchar  (255) ');
     //	$this->db->query('alter table city  add column   city_time  (255) ');
    
        $this->db->query('alter table news  add column time varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank1_name_en varchar  (255) ');


           $this->db->query('alter table gam3yat  add column bank1_num_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank1_num_en varchar  (255) ');

    
           $this->db->query('alter table gam3yat  add column bank1_other_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank1_other_en varchar  (255) ');

    
       $this->db->query('alter table gam3yat  add column bank2_name_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank2_name_en varchar  (255) ');


           $this->db->query('alter table gam3yat  add column bank2_num_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank2_num_en varchar  (255) ');

    
           $this->db->query('alter table gam3yat  add column bank2_other_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank2_other_en varchar  (255) ');
    
    
    
       $this->db->query('alter table gam3yat  add column bank3_name_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank3_name_en varchar  (255) ');


           $this->db->query('alter table gam3yat  add column bank3_num_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank3_num_en varchar  (255) ');

    
           $this->db->query('alter table gam3yat  add column bank3_other_ar varchar  (255) ');
        $this->db->query('alter table gam3yat  add column bank3_other_en varchar  (255) ');
		 
		  
	 echo time();
	 }	 
 ////////////////////////////////////////
    public function getAllItems ()
    {
	        $kit_id = $this->session->userdata('kitchen_id');
            
            $status = $this->uri->segment(3);    
    		/* Array of database columns which should be read and sent back to DataTables. Use a space where
			 * you want to insert a non-database field (for example a counter or static image)
			 */
             
  		      if($kit_id!=0)
              {
                $child = $this->session->userdata('childs');
               
              }  

             if($this->session->userdata('emp_type')==1){
    			 $aColumns =array("ord_id as nid","if(kit.kit_parent_id=0,kit.kit_title_ar,kitparent.kit_title_ar) as rest_title ","ord_user_id","ord_total_price","ord_date","current_status as nActive","frist_name","last_name");
    			 $aColumnsAlias =array("nid","rest_title","ord_user_id","ord_total_price","ord_date","nActive");
    			 $aColumnsSearch=array("ord_id","kit_title_ar","ord_user_id","ord_total_price","ord_date","current_status");
                $this->db->_protect_identifiers=false;                    
       			$sTable = 'orders';
                $this->db->join('users','orders.ord_user_id=users.user_id','left');
                $this->db->join('kitchen as kit','orders.ord_kit_id=kit.kit_id','left');
                $this->db->join('kitchen as kitparent',"kit.kit_parent_id <> 0 AND kit.kit_parent_id = kitparent.kit_id",'left',false);
                
                $this->db->where('current_status',$status);
                $this->db->where('ord_date',date('Y-m-d'));

             }   
             else if($this->session->userdata('emp_type')==2)
             {
            	 $aColumns =array("ord_id as nid","kit_title_ar","ord_user_id","ord_total_price","ord_date","current_status as nActive","frist_name","last_name","ord_kit_id");
    			 $aColumnsAlias =array("nid","kit_title_ar","ord_user_id","ord_total_price","ord_date","nActive");
    			 $aColumnsSearch=array("ord_id","kit_title_ar","ord_user_id","ord_total_price","ord_date","current_status");
                $this->db->_protect_identifiers=false;
                $sTable = 'orders';                
                $this->db->join('users','orders.ord_user_id=users.user_id','left');
                $this->db->join('kitchen as kit','orders.ord_kit_id=kit.kit_id','left');
                $this->db->where('current_status',$status);
                $this->db->where('ord_date',date('Y-m-d'));
                if($kit_id!=0){
                    $where_str = " ( orders.ord_kit_id = ".$kit_id;
                    
                    if($child!="")
                        $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                    else           
                        $where_str .= ")";

                    $this->db->where($where_str,NULL,FALSE);                        
                        //$this->db->where("orders.ord_kit_id",$kit_id);
                        //$this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);        
                }

             }else{
            	 $aColumns =array("ord_id as nid","ord_user_id","ord_total_price","ord_date","current_status as nActive","frist_name","last_name");
    			 $aColumnsAlias =array("nid","ord_user_id","ord_total_price","ord_date","nActive");
    			 $aColumnsSearch=array("ord_id","ord_user_id","ord_total_price","ord_date","current_status");
                $this->db->_protect_identifiers=false;
    			$sTable = 'orders';
                $this->db->join('users','orders.ord_user_id=users.user_id','left');
                $this->db->join('kitchen as kit','orders.ord_kit_id=kitchen.kit_id','left');
                $this->db->where('current_status',$status);
                $this->db->where('ord_date',date('Y-m-d'));
                $this->db->where("orders.ord_kit_id",$kit_id);  
                
                
                
             }
             
			// DB table to use
			//$sTable = 'news join news_cats on news.cat_id=news_cats.id  and news.active<>0';
            
            //$this->db->where('parent',0);
			//$this->db->join('items','request_item_id = item_id');
            //
            $iDisplayStart = $this->input->get_post('iDisplayStart', true);
			$iDisplayLength = $this->input->get_post('iDisplayLength', true);
			$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
			$iSortingCols = $this->input->get_post('iSortingCols', true);
			$sSearch = $this->input->get_post('sSearch', true);
			$sEcho = $this->input->get_post('sEcho', true);
		
			// Paging
			if(isset($iDisplayStart) && $iDisplayLength != '-1')
			{
				$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
			}
			
			// Ordering
			if(isset($iSortCol_0))
			{
				for($i=0; $i<intval($iSortingCols); $i++)
				{
					$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
					$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
					$sSortDir = $this->input->get_post('sSortDir_'.$i, true);
		
					if($bSortable == 'true')
					{
						$this->db->order_by($aColumnsAlias[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
				}
			}
			
			/* 
			 * Filtering
			 * NOTE this does not match the built-in DataTables filtering which does it
			 * word by word on any field. It's possible to do here, but concerned about efficiency
			 * on very large tables, and MySQL's regex functionality is very limited
			 */
			if(isset($sSearch) && !empty($sSearch))
			{
				for($i=0; $i<count($aColumns); $i++)
				{
					$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
					
					// Individual column filtering
					if(isset($bSearchable) && $bSearchable == 'true')
					{
						$this->db->or_like($aColumnsSearch[$i], $this->db->escape_like_str($sSearch));
					}
				}
			}
			
			// Select Data
			$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ',' ',implode(',', $aColumns)),false);
			$rResult = $this->db->get($sTable);
		
			// Data set length after filtering
			$this->db->select('FOUND_ROWS() AS found_rows');
			//$this->db->order_by('ndate');
			$iFilteredTotal = $this->db->get()->row()->found_rows;
		
			// Total data set length
			$iTotal = $this->db->count_all($sTable);
		      
              
			// Output
			$output = array(
				'sEcho' => intval($sEcho),
				'iTotalRecords' => $iTotal,
				'iTotalDisplayRecords' => $iFilteredTotal,
				'aaData' => array()
			);
			
			foreach($rResult->result_array() as $aRow)
				{
					$row = array();
				$row["DT_RowId"]= "rowTable".$aRow['nid'];

				 //   print_r($aColumns);
				//	echo "<br>";
					 
					foreach($aColumnsAlias as $col)
						{
                            if($this->session->userdata('emp_type')==2 && $col=="kit_title_ar")						  
                            {
                                    $allBranches = $this->admin->getAllBranches($kit_id);
                                    $sel_string = "<select class='form-control' name='nActive".$aRow['nid']."' id='nActive".$aRow['nid']."' onchange='changeBranch($(this).val(),".$aRow['nid'].");'>";
                                    for($z=0;$z<count($allBranches);$z++){
                                        $sel_string .= "<option value='".$allBranches[$z]['kit_id']."'";
                                      
                                        if($aRow['ord_kit_id']==$allBranches[$z]['kit_id'])    
                                            $sel_string .=" selected='selected'"; 

                                        $sel_string .= ">".$allBranches[$z]['city_title_ar']."</option>";  
                                    }
                                    $sel_string .= "</select>";
                                    $row[] = $sel_string;
                                
                                
                            }
                            else
                          
                            if($col=="ord_user_id")
                            {
                                $row[] = $aRow["frist_name"]." ".$aRow["last_name"];
                            }
                            else if($col=="nActive")
                            {
                                $sel_string = "<select class='form-control' name='nActive".$aRow['nid']."' id='nActive".$aRow['nid']."' onchange='changeState(".$aRow[$col].",$(this).val(),".$aRow['nid'].");'>
                                                <option value='0' ";
                                if($aRow[$col]=="" || $aRow[$col] == 0)                 
                                      $sel_string .=" selected='selected'";
                                $sel_string .= ">Order placed</option>
                                                <option value='1'";
                                if($aRow[$col] == 1)                 
                                      $sel_string .=" selected='selected'";
                                                
                                $sel_string .= " >Approved</option>
                                                <option value='2'";
                                if($aRow[$col] == 2)                 
                                      $sel_string .=" selected='selected'";
                                                
                                $sel_string .= "  >Preparing</option>
                                                <option value='3'";
                                if($aRow[$col] == 3)                 
                                      $sel_string .=" selected='selected'";
                                                
                                $sel_string .= " >Ready to Pick up</option>
                                                <option value='4'";
                                if($aRow[$col] == 4)                 
                                      $sel_string .=" selected='selected'";
                                                
                                $sel_string .= " >Assigned to driver</option>
                                                <option value='5'";
                                if($aRow[$col] == 5)                 
                                      $sel_string .=" selected='selected'";
                                                
                                $sel_string .= ">Delivered</option>
                                                <option value='6'";
                                                
                                if($aRow[$col] == 6)                 
                                      $sel_string .=" selected='selected'";

                                $sel_string .= ">Not Delivered</option>
                                                <option value='7'";
                                                
                                if($aRow[$col] == 7)                 
                                      $sel_string .=" selected='selected'";
                                                
                                $sel_string .= " >Canceled or Reject</option>                                                                                                
                                
                                </select>";
                                $row[] = $sel_string;
                            }
							else if($col=="social_url")
							{
                                $row[] = "<a href='".$aRow[$col]."' target='_blank'>".$aRow[$col]."</a>";
                            }                          
    						else if($col=="offerImg")
							{
							    if($aRow[$col]!='' ) 
                                    $row[] = "<img src='". $this->config->item('api_url') .'uploads/'.$aRow[$col]."' width='75px' height='45px' />";
                                else    
                                    $row[] = "";
                            }   
                            else if($col == "offerNotification")
                            {
                                if($aRow[$col]==0)
									$row[] = "ظ„ط§";						
								else if($aRow[$col]==1)
									$row[] = "ظ†ط¹ظ…";                                
                            }                       
							/*else if($col=="nActive")
							{
								if($aRow[$col]==0)
									$row[] = "ط؛ظٹط± ظپط¹ط§ظ„";						
								else if($aRow[$col]==1)
									$row[] = "ظپط¹ط§ظ„";						
							}*/
							else
								$row[] = $aRow[$col];
						}
				
					$output['aaData'][] = $row;
				}
		
        
			echo json_encode($output);
      
      
            

    } 
 ////////////////////////////////////////////
    function delete_order()
    {
            $item_id = $this->input->post('item_id');
			$social_id=$this->input->post("social_id");
			$status = $this->input->post('status');
            
            
			if($social_id)
			   {
			    $this->db->where('ord_id', $social_id);
			    $this->db->delete('orders'); 
                echo "<script>$('#rowTable".$social_id."').remove();</script>";
			   }
               else
               {
				$this->db->where_in('ord_id', $item_id);
        		$this->db->delete('orders'); 
               }
		//	redirect(site_url('realestate/All'));
        echo "<script>//tableProducts.ajax.reload();</script>";	  
        
        if($status!="")
        {
            $val_stat = $this->admin->get_stat_counts($status); 
             echo "<script>$('#stateCnt".($status+1)."').html(".$val_stat.");</script>";   
        }
        
        
              
    }
 ///////////////////////////////////////////////////
    function changeState()
    {
        $id = $this->input->post('id');
        $value = $this->input->post('value');
		$old_val = $this->input->post('old_val');
        				  
	   $datau = array(
		   'current_status' => $value
		);
	  
	     $this->db->where('ord_id',$id);
	     $this->db->update('orders', $datau);
        
        echo "<script>$('#rowTable".$id."').remove();</script>";
        echo "<script>table".($value+1).".fnDraw();</script>";        
        
        $val_stat = $this->admin->get_stat_counts($value);
        $old_stat = $this->admin->get_stat_counts($old_val);
        
        echo "<script>$('#stateCnt".($old_val+1)."').html(".$old_stat.");$('#stateCnt".($value+1)."').html(".$val_stat.");</script>";
        
        
    }
    function changeBranch()
    {
        
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        				  
	   $datau = array(
		   'ord_kit_id' => $value
		);
	  
	     $this->db->where('ord_id',$id);
	     $this->db->update('orders', $datau);
        
        
    }    
    

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */