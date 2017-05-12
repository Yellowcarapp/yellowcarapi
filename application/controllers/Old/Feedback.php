<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feedback extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/page_model','page');
		
		
	}
 //============================
function index()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
						$data['pages'] = $this->page->messages_list();
						$data['pageTitle']=' Messages FeedBack ';
						
					  $this->template->set('adminMenue','feedback');
					  $this->template->set('adminSubMenue','AllKind');
					  $this->template->load('admin/Container', 'admin/feedback/page_list',$data);
		     } else {
			   redirect(site_url('admin/Admin'));
			 }
	 }
 //============================
function Delete()
     {
	 
	  if($this->session->userdata('id') !="")
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
						   $this->db->where('id', $page_id);
						   $this->db->delete('feedback'); 
						   }
				  redirect(site_url('admin/Feedback')); 
						 
		     } else {
			   redirect(site_url('admin/Admin'));
			 }
	 }
 
//===========#######################PageS######################=====================
    function  read()
	  {
	   $page_id=$this->uri->segment(4);

	   
	   if($this->session->userdata('id') !="")
			   {
			     
				   
				  if($page_id && $page_id!='saved') 
				   {    
 						$data['page'] = $this->page->read_message($page_id);
 						$data['pageTitle']='Read Message';
												  
						  if($page_id) //update
						     {
						    	$datad =  array('isread' =>'1'); 
							    $this->db->where('id',$page_id);
						        $this->db->update('feedback', $datad);
						     } 
						
 				   } else {
  						$data['pageTitle']='Add Kind';
 				   }
  				  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/feedback/page_form',$data); 
		       
			   } else {
			   
			   redirect(site_url('admin/Admin'));
			   
			   }
	  
	  }	
	
	//============================
	function Save()
	   {
	 
	 $pageid=$this->uri->segment(4);
	 $isread=$this->uri->segment(5);
	  if($this->session->userdata('id') !="")
			   {   
			  
						 $data =  array('isread' =>$isread); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('id',$pageid);
						     $this->db->update('feedback', $data);
							}else{  //insert
						      $this->db->insert('feedback', $data);
						    }
						
					 
						   redirect(site_url('admin/Feedback')); 
						  
	          } else {
			   
			    redirect(site_url('admin/Admin'));
			   
			   }
	   
	   }

	
//=====#########################
}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */