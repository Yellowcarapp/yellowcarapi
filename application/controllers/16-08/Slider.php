<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/slider_model','slider');
		
		
	}

	
//===========#######################PageS######################=====================
    function sliderForm()
	  {
	    
              
	   
	  if($this->session->userdata('id'))
			   {
			     
				     $page_id=$this->uri->segment(4);
                if(isset($page_id) && $page_id !=''){
		      
          
						
                      
                        $data['pageTitle']='Edit Slider image';
                    $data['page']=$this->slider->getData($page_id);
				  
				   } else {
				    
 						$data['pageTitle']='Add Slider Image';
				  
				   }
				
           
                  
				  $this->template->set('adminMenue','Slider');
				  $this->template->set('adminSubMenue','sliderList');
 				  $this->template->load('admin/Container', 'admin/slider/page_form',$data); 
		       
			  } else {
			   
			   redirect(site_url('admin'));
			 
			   }
	  
	  }	
	
	//============================
	function SaveSlider()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	
	 $active=$this->input->post('active', TRUE);
	 
	  $image=$this->input->post('attached_files_image', TRUE);
	  
		
	 
	 	   
	 
	  if($this->session->userdata('id'))
			   {   
			  
						 $data =  array(//'title_en' => $title_en 
						   //,  
						   'title_ar' => $title_ar 
						   
							, 'title_en' => $title_en
						 
						 
						   ,  'active' => $active 
						 
   							   ,'image' => $image
   
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('id',$pageid);
						     $this->db->update('slider', $data);
							  $case='update';
							  $id=$pageid;
							}else{  //insert
						      $this->db->insert('slider', $data);
							   $id=$this->db->insert_id();
							   $case='insert';
						    }
							
						
 						 
							
						
						 
						   redirect(site_url('Slider/sliderList')); 
						 
	          } else {
			   
			    redirect(site_url('admin'));
			   
			   }
	   
	   }
//============================
function sliderList()
     {
	 
	  if($this->session->userdata('id'))
			   {
					    $data['pre_page'] = "";
						$data['pages'] = $this->slider->slider_list();
						$data['pageTitle']=' Slider ';
						
					  $this->template->set('adminMenue','Slider');
					  $this->template->set('adminSubMenue','sliderList');
					  $this->template->load('admin/Container', 'admin/slider/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }

 //============================
function DeleteSlider()
     {
 	 //  $pre_page = $this->input->get('pre_page');
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
					
					 	   
						
						if($page_id)
						   {
						   $this->db->where('id', $page_id);
						   $this->db->delete('slider');
						   
						 
						   }
				  redirect(site_url('Slider/sliderList')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 
//==================================== 

 
  
//=====#########################
 

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */