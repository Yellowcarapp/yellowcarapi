<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/page_model','page');
		
		
	}

	function Advs()
	{
		if ($this->uri->segment(4) === FALSE)
			{
				$resultNotification = 0;
			}
			else
			{
				$resultNotification = $this->uri->segment(4); // 1 saved sucess 2 email error
			}
				
		  if($this->session->userdata('id') && $this->session->userdata('emp_type') == 1)
		   {
			  $data['page'] = $this->page->HomePageSettings();
			  
			  $data['resultNotification']=$resultNotification; 
			  $this->template->set('adminMenue','Right Advs');
			  $this->template->set('adminSubMenue','');
			  $this->template->load('admin/Container', 'admin/main/advs_page',$data); 
		   
		   } else {
		   
		   redirect(site_url('').'/admin/admin');
		   
		   }
	}
	
	function SaveAdvs()
	{
		 $attached_files_image=$this->input->post('Files4');
		 $attached_files_name_image=$this->input->post('Files4_name');
		 $start_date=$this->input->post('advs_start_date');
		 $advs_start_arr = explode("-",$start_date);		
		 $advs_start_date = mktime(0,0,0,$advs_start_arr[1],$advs_start_arr[0],$advs_start_arr[2]);
		 $end_date=$this->input->post('advs_end_date');
		 $advs_end_arr = explode("-",$end_date);
		 $advs_end_date = mktime(0,0,0,$advs_end_arr[1],$advs_end_arr[0],$advs_end_arr[2]);
		 $advs_link = $this->input->post('advs_link');
			  $data = array(
				   'home_sett_image' => $attached_files_image,
				   'home_sett_image_name' => $attached_files_name_image,
				   'advs_start_date' => $advs_start_date,
				   'advs_end_date' => $advs_end_date,
					'advs_link' => $advs_link	
				);


			$this->db->where('home_sett_id','1');
			$this->db->update('home_settings', $data);
			
			redirect(base_url('').'admin/page/Advs'); 
	}

 	function HomePage()
	{
		/*	if ($this->uri->segment(4) === FALSE)
				{
					$resultNotification = 0;
				}
				else
				{
					$resultNotification = $this->uri->segment(4); // 1 saved sucess 2 email error
				}*/
					
	  		  if($this->session->userdata('id') )
			   {
			      $data['page'] = $this->page->pagesList();
			     // $data['seo'] = $this->page->seo("1");
				  $data['pageTitle']='Pages';
				 // $data['resultNotification']=$resultNotification; 
				  $this->template->set('adminMenue',' Page');
				  $this->template->set('adminSubMenue','');
				  $this->template->load('admin/Container', 'admin/pages/page_list',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/admin');
			   
			   }

	}
 //===============================	
function SaveHomePage()
	 {
	
	 $attached_files_image=$this->input->post('attached_files_image');
	 $attached_files_name_image=$this->input->post('attached_files_name_image');
	 $home_header=$this->input->post('home_header');
	 $home_footer=$this->input->post('home_footer');

	 $home_welcome_title_ar=$this->input->post('home_welcome_title_ar');
	 $home_welcome_ar=$this->input->post('home_welcome_ar');
	 
	 $home_welcome_title_en=$this->input->post('home_welcome_title_en');
	 $home_welcome_en=$this->input->post('home_welcome_en');
	
     $keywords_ar=$this->input->post('keywords_ar',TRUE);
	 $keywords_en=$this->input->post('keywords_en',TRUE);
	
	
     $desc_ar=$this->input->post('desc_ar',TRUE);
	 $desc_en=$this->input->post('desc_en',TRUE);
     
			  $data = array(
				   'home_sett_image' => $attached_files_image,
				   'home_sett_image_name' => $attached_files_name_image,
				 //  'home_header' => $home_header,
				  // 'home_footer' => $home_footer,

				   'home_welcome_title_ar' => $home_welcome_title_ar,
				   'home_welcome_ar' => $home_welcome_ar,
				   'home_welcome_title_en' => $home_welcome_title_en,
				   'home_welcome_en' => $home_welcome_en

				);
			  $value = array(
				   'keywords_ar' => $keywords_ar,
				   'keywords_en' => $keywords_en,
				   'desc_ar' => $desc_ar,
				   'desc_en' => $desc_en

				);


			$this->db->where('home_sett_id','1');
			$this->db->update('home_settings', $data);
	
			$this->db->where('id','1');
			$this->db->update('seo', $value);
			
			redirect(base_url('').'admin/page/HomePage'); 

	 
	 }
	
	
 	function ThemeForm()
	{
			if ($this->uri->segment(4) === FALSE)
				{
					$resultNotification = 0;
				}
				else
				{
					$resultNotification = $this->uri->segment(4); // 1 saved sucess 2 email error
				}
					
	  		  if($this->session->userdata('id') )
			   {
			      
			      $data['seo'] = $this->page->seo("2");
				  
				  $data['resultNotification']=$resultNotification; 
				  $this->template->set('adminMenue','Website Home Page');
				  $this->template->set('adminSubMenue','');
				  $this->template->load('admin/Container', 'admin/main/theme_page',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/admin');
			   
			   }

	}
//===============================	
function SaveThemePage()
	 {
	
	 //$attached_files_image=$this->input->post('attached_files_image');
	 //$attached_files_name_image=$this->input->post('attached_files_name_image');
	 //$home_header=$this->input->post('home_header');
	 //$home_footer=$this->input->post('home_footer');

	// $home_welcome_title_ar=$this->input->post('home_welcome_title_ar');
	 //$home_welcome_ar=$this->input->post('home_welcome_ar');
	 
	 $title=$this->input->post('title');
	// $home_welcome_en=$this->input->post('home_welcome_en');
	
     $keywords_ar=$this->input->post('keywords_ar');
	 $keywords_en=$this->input->post('keywords_en');
	
	
     $desc_ar=$this->input->post('desc_ar');
	 $desc_en=$this->input->post('desc_en');
     
		/*	  $data = array(
				   'home_sett_image' => $attached_files_image,
				   'home_sett_image_name' => $attached_files_name_image,
				 //  'home_header' => $home_header,
				  // 'home_footer' => $home_footer,

				   'home_welcome_title_ar' => $home_welcome_title_ar,
				   'home_welcome_ar' => $home_welcome_ar,
				   'home_welcome_title_en' => $home_welcome_title_en,
				   'home_welcome_en' => $home_welcome_en

				);*/
			  $value = array(
				   'keywords_ar' => $keywords_ar,
				   'keywords_en' => $keywords_en,
				   'desc_ar' => $desc_ar,
				   'desc_en' => $desc_en,
				   'title' => $title

				);


			
			$this->db->where('id','2');
			$this->db->update('seo', $value);
			
			redirect(base_url('').'admin/page/ThemeForm/'); 

	 
	 }
	
//===========#######################PageS######################=====================
    function PageForm()
	  {
	   $page_id=$this->uri->segment(4);
	   
	   $specialPageTitle=$this->uri->segment(5);
	   $modelAction=$this->uri->segment(5);
	   $modelActionArr=@explode('-',$modelAction);
	   $data['action']=$this->uri->segment(6);
	   $data['pre_page'] = $this->input->get('pre_page');
	   	  // $data['adminMenuLinkArr'] = $this->setting_model->menuLinksAdmin();
	   
	   if($this->session->userdata('id'))
			   {
			       $data['pages'] = $this->page->pages($page_id);
				   
				  if($page_id && $page_id!='saved') 
				   {    

						$data['page'] = $this->page->pageDetails($page_id);
						 
					/*	if($page_id == 1) $data['pageTitle']='About us';
						elseif($page_id == 2) $data['pageTitle']='Term & Condition';
						elseif($page_id == 3) $data['pageTitle']='privacy & policy';
						else*/ $data['pageTitle']=lang('edit_page');
				  
				   } else {
				    
 						$data['pageTitle']=lang('Add_page');
				  
				   }
				   
				   $data['specialPageTitle']=$specialPageTitle;
				   
				  $this->template->set('adminMenue','Pages');
				  $this->template->set('adminSubMenue','Create a new Page');
/*				  if($specialPageTitle!='')
				    {
					 $this->template->set('adminMenue',$modelActionArr['0']);
				     $this->template->set('adminSubMenue',$modelActionArr['1']);
					}*/
					
				  $this->template->load('admin/Container', 'admin/pages/page_form',$data); 
		       
			   } else {
			   
			   redirect(site_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SavePage()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	 $details_ar=$this->input->post('details_ar');
	 $details_en=$this->input->post('details_en');
	
	  
	     $title_urdo=$this->input->post('title_urdo', TRUE);
		 $details_urdo=$this->input->post('details_urdo', TRUE);
	 	
	 
	
		
		 	$table="pages";  	   
	 
	  if($this->session->userdata('id'))
			   {   
			  
						 $data =  array(//'title_en' => $title_en 
						   //,  
						   'title_ar' => $title_ar 
						   ,  'details_ar' => $details_ar 
							, 'title_en' => $title_en
						   ,  'details_en' => $details_en
						 
						   	   ,'title_urdo'=>$title_urdo
						   	   ,'details_urdo'=>$details_urdo
   							  
   
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('pageId',$pageid);
						     $this->db->update($table, $data);
							  $case='update';
							  $id=$pageid;
							}else{  //insert
						      $this->db->insert($table, $data);
							   $id=$this->db->insert_id();
							   $case='insert';
						    }
							
							
							//=====craete menue Link  
							
						   redirect(site_url('Page/Pages')); 
						
	          } else {
			   
			    redirect(site_url('admin'));
			   
			   }
	   
	   }
//============================
function Pages()
     {
	 
	  if($this->session->userdata('id'))
			   {
					    $data['pre_page'] = "";
						$data['pages'] = $this->page->pagesList();
						$data['pageTitle']=lang('Pages');
						
					  $this->template->set('adminMenue','Pages');
					  $this->template->set('adminSubMenue','ManagePages');
					  $this->template->load('admin/Container', 'admin/pages/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 // ===========================
function About_Pages()
{
	  if($this->session->userdata('id'))
			   {
 					    $data['pre_page'] = "About_";
						$data['pages'] = $this->page->about_pag_list();
						$data['pageTitle']='About Pages ';
						
					  $this->template->set('adminMenue','Pages');
					  $this->template->set('adminSubMenue','ManagePages');
					  $this->template->load('admin/Container', 'admin/pages/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
} 	 
 //============================
function DeletePage()
     {
 	   $pre_page = $this->input->get('pre_page');
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
					
					 if($pre_page=="About_")	
						$table="about_pages";
					 else
						$table="pages";  	   
						
						if($page_id)
						   {
						   $this->db->where('pageId', $page_id);
						   $this->db->delete($table);
						   
						   //$this->db->where('parrent_id', $page_id);
						   //$this->db->delete($table);
						   
						  // $this->template->addMenuLink('delete','2',$page_id); 
						   
						    
						   }
				  redirect(site_url('Page/'.$pre_page.'Pages')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 
//==================================== 
 function reOrderCategory()
   {
   
      
     $id=$this->uri->segment(4);
	 $val=$this->uri->segment(5);
	
	if($id && $val)
	   {
	      $data =  array('pages_order' => $val); 
		  $this->db->where('id',$id);
		  $this->db->update('pages', $data);
	      redirect(site_url('Page/Pages'));
	   }
   
   
    
   
   }
 
  
//=====#########################
 

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */