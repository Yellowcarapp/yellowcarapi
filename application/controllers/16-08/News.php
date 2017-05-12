<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/generalsetting_model','generalsetting');
		
		
	}
 
//===========#######################PageS######################=====================
    function index()
		{
		
		  
        echo 'INNNNNNNNN';
 			  
  
			 
		}
    
    function  NewsForm()
	  {
	   $page_id=$this->uri->segment(4);
              
	   
	   if($this->session->userdata('id'))
			   {
			     
				   
				  if($page_id && $page_id!='saved') 
				   {    

						$data['page'] = $this->generalsetting->Details("news","newsId",$page_id);
						 
						$data['pageTitle']=lang('edit_News');
				  
				   } else {
				    
 						$data['pageTitle']=lang('Add_News');
				  
				   }
				   
 				   
				  $this->template->set('adminMenue','Dashboard');
				  $this->template->set('adminSubMenue','Create a new Page');
			 
 				  $this->template->load('admin/Container', 'admin/news/page_form',$data); 
		       
			   } else {
			   
			   redirect(site_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveNews()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $newsTitle=$this->input->post('newsTitle', TRUE);
	 $newsDetails=$this->input->post('newsDetails', TRUE);
	 $newsLanguage=$this->input->post('newsLanguage', TRUE);
	 $newsStatus=$this->input->post('newsStatus', TRUE);
	 
	
	 $image=$this->input->post('attached_files_image', TRUE);
	
	  
			 	 
	  if($this->session->userdata('id'))
			   {   
			  
						 $data =  array('newsTitle' => $newsTitle 
						   ,  'newsDetails' => $newsDetails
						   ,  'newsLanguage' => $newsLanguage 
						   ,  'newsStatus' => $newsStatus 
 						  
						   ,  'newsImage' => $image 
			               ,  'newsDate' =>date('Y-m-d H:i:s')
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('newsId',$pageid);
						     $this->db->update('news', $data);
							}else{  //insert
						      $this->db->insert('news', $data);
						    }
						
					 
						   redirect(site_url('News/NewsList')); 
						  
	          } else {
			   
			    redirect(site_url('admin'));
			   
			   }
	   
	   }
//============================
function NewsList()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
						$data['pages'] = $this->generalsetting->All("news","newsId");
						$data['pageTitle']=' News ';
						
					  $this->template->set('adminMenue','Dashboard');
					  $this->template->set('adminSubMenue','ManagePages');
					  $this->template->load('admin/Container', 'admin/news/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 //============================
function DeleteNews()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
						  $this->db->where('newsId', $page_id);
						  $this->db->delete('news');
						   
						  }
				  redirect(site_url('News/NewsList')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 

 
  
//=====#########################
 

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */