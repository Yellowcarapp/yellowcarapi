<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/social_model','page');
		
		
	}
 
//===========#######################PageS######################=====================
    function  Form()
	  {
	   $page_id=$this->uri->segment(3);
              
			  
			  
			   $this->db->select('*');
 			   $this->db->from('news_cats');
               $query = $this->db->get();
               $data['cats']= $query->result_array();
	   
	   
	   
	   if($this->session->userdata('id'))
			   {
			     
				   
				  if($page_id && $page_id!='saved') 
				   {    

						$data['page'] = $this->page->pageDetails($page_id);
						 
						$data['pageTitle']='Edite Shortcut';
				  
				   } else {
				    
 						$data['pageTitle']='Add Shortcut';
				  
				   }
				   
 				   
				  $this->template->set('adminMenue','Dashboard');
				  $this->template->set('adminSubMenue','Create a new Page');
			 
 				  $this->template->load('admin/Container', 'admin/social/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
			   }
	  
	  }	
	
	//============================
	function SavePage()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	 $details_ar=$this->input->post('details_ar', TRUE);
	 $details_en=$this->input->post('details_en', TRUE);
	 $type=$this->input->post('type', TRUE);
	 $active=$this->input->post('active', TRUE);
	 $image=$this->input->post('image', TRUE);
	 $link=$this->input->post('link', TRUE);
	 $type=$this->input->post('type', TRUE);
	  
			 	 
	  if($this->session->userdata('id'))
			   {   
			  
						 $data =  array('title_en' => $title_en 
						   ,  'title_ar' => $title_ar 
						   ,  'details_ar' => $details_ar 
						   ,  'details_en' => $details_en 
 						   ,  'active' => $active 
						   ,  'image' => $image 
			               ,  'link' =>$link
			               ,  'type' =>$type
			               ,  'date' =>date('Y-m-d H:i:s')
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('id',$pageid);
						     $this->db->update('social', $data);
							}else{  //insert
						      $this->db->insert('social', $data);
						    }
						
					 
						   redirect(site_url('Social/All')); 
						  
	          } else {
			   
			    redirect(base_url());
			   
			   }
	   
	   }
//============================
function All()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
						$data['pages'] = $this->page->pag_list();
						$data['pageTitle']=' social ';
						
					  $this->template->set('adminMenue','Dashboard');
					  $this->template->set('adminSubMenue','ManagePages');
					  $this->template->load('admin/Container', 'admin/social/page_list',$data);
		     } else {
			   redirect(base_url());
			 }
	 }
 //============================
function DeletePage()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(3);
						
						if($page_id)
						   {
						  // $this->db->where('id', $page_id);
						    // $this->db->delete('social');
						    $data =  array('active'=>'0','date'=>date('Y-m-d H:i:s'));
						    $this->db->where('id', $page_id);
						    $this->db->update('social', $data);
						 
						   }
				  redirect(site_url('Social/All')); 
						 
		     } else {
			   redirect(base_url());
			 }
	 }
 

 
  
//=====#########################
 

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */