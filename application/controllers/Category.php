<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Category extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/Category_model','category');		
	}
#########################################Category############################################################	
 //============================
function CategoryForm()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
		  $id=$this->uri->segment(3);	
		  if($id){
		  $data['page'] = $this->category->Details('category','id',$id);
		  $data['pageTitle']=' تعديل التصنيف  ';
		  }else{
		  $data['pageTitle']=' اضافة تصنيفات  ';
		  }
						
					  $this->template->set('adminMenue','feedback');
					  $this->template->set('adminSubMenue','AllKind');
					  $this->template->load('admin/Container', 'admin/category/page_form',$data);
		     } else {
			   redirect(base_url());
			 }
	 }
	//============================
	function SaveCat()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	 $details_ar=$this->input->post('details_ar', TRUE);
	 $details_en=$this->input->post('details_en', TRUE);
	 $type=$this->input->post('type', TRUE);
	 $active=$this->input->post('active', TRUE);
	 $image=$this->input->post('attached_files_image', TRUE);
	/*$image = explode("/", $this->input->post('image'));	*/
	 $link=$this->input->post('link', TRUE);
	 $type=$this->input->post('type', TRUE);
	 $title = "";
 
	 
	  if($this->session->userdata('id'))
			   {   
			  
						   $data =  array(
						    'active' => $active 
						   , 'type' => "1" 
						   //,  'cat_image' => $image
			               ,  'date' =>date('Y-m-d')
						   ); 
						  
						  if($pageid) //update
						    {
							  
							$data['title_en'] = $this->input->post('title_en') ;
							$path = $_SERVER['DOCUMENT_ROOT']."/hybapps/themes_market/".$this->input->post('title_en');	
							if (!file_exists($path)) {
    						mkdir($path, 0777, true);
							} 
							  
							$this->db->where('id',$pageid);
						    $this->db->update('category', $data);
							}else{  //insert
							  
							for ($i = 0; $i <sizeof($this->input->post('title_en')); $i++){
							$title = $this->input->post('title_en')[$i];
							if($title){
							$data['title_en'] = $title; 
								
							$path = $_SERVER['DOCUMENT_ROOT']."/hybapps2/resources/uploads/theme/".$title;	
							if (!file_exists($path)) {
    						mkdir($path, 0777, true);
							//echo "done";
							}
								
							}		
								
							//print_r($data);	
							$this->db->insert('category', $data);
							}  
							  
						     
						    }
						
					 		//echo $_SERVER['DOCUMENT_ROOT'];
						   redirect(site_url('Category/CategoryList')); 
						  
	          } else {
			   
			    redirect(base_url());
			   
			   }
	   
	   }
//============================
function CategoryList()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
						$data['pages'] = $this->category->ListTable('category',"type","1");
						$data['pageTitle']='عرض التصنيفات';
						
					  $this->template->set('adminMenue','news');
					  $this->template->set('adminSubMenue','AllColor');
					  $this->template->load('admin/Container', 'admin/category/page_list',$data);
		     } else {
			   redirect(base_url());
			 }
	 }
 //============================
function DeleteCat()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(3);
						
						if($page_id)
						   {
                              
						   $this->db->where('id', $page_id);
						   $this->db->delete('category'); 
						   }
				  redirect(site_url('Category/CategoryList')); 
						 
		     } else {
			   redirect(base_url());
			 }
	 }
//=======================================================================================================================

//=======================================================================================================================

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */