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
					 
		  $id=$this->uri->segment(4);	
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
			   redirect(site_url('admin'));
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
			   
			    redirect(site_url('admin'));
			   
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
			   redirect(site_url('admin'));
			 }
	 }
 //============================
function DeleteCat()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                              
						   $this->db->where('id', $page_id);
						   $this->db->delete('category'); 
						   }
				  redirect(site_url('Category/CategoryList')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
//=======================================================================================================================
#########################################Food Type############################################################	
 //============================
function FoodTypeForm()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
		  $id=$this->uri->segment(4);	
		  if($id){
		  $data['page'] = $this->category->Details('dishes_type','dish_type_id',$id);
		  $data['pageTitle']=' Edit Food Type ';
		  }else{
		  $data['pageTitle']=' New Food Type ';
		  }
						
					  $this->template->set('adminMenue','feedback');
					  $this->template->set('adminSubMenue','AllKind');
					  $this->template->load('admin/Container', 'admin/food_type/page_form',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
	//============================
	function SaveFoodType()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
//	 $details_ar=$this->input->post('details_ar', TRUE);
//	 $details_en=$this->input->post('details_en', TRUE);
	 //$type=$this->input->post('type', TRUE);
	 $active=$this->input->post('active', TRUE);
	 //$image=$this->input->post('attached_files_image', TRUE);
	/*$image = explode("/", $this->input->post('image'));	*/
	 $link=$this->input->post('link', TRUE);
	 $type=$this->input->post('type', TRUE);
	 $title = "";
 
	 
	  if($this->session->userdata('id'))
			   {   
			  
						   $data =  array(
                            'dish_type_title_ar' =>  $title_ar 
						   , 'dish_type_title_en' => $title_en 
						   , 'dish_type_active' => $active 
						   , 'dish_type_kit' => $this->session->userdata('kitchen_id') 
						   //,  'cat_image' => $image
			               //,  'date' =>date('Y-m-d')
						   ); 
						  
						  if($pageid) //update
						    {
							$this->db->where('dish_type_id',$pageid);
						    $this->db->update('dishes_type', $data);
							}else{  //insert
							$this->db->insert('dishes_type', $data);
							}  
							  
						   redirect(site_url('Category/AllFoodType')); 
						  
	          } else {
			   
			    redirect(site_url('admin'));
			   
			   }
	   
	   }
//============================
function AllFoodType()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 //$this->session->userdata('kithcen_id'),$column='',$id=''
						$data['pages'] = $this->category->ListTable('dishes_type','dish_type_kit',$this->session->userdata('kitchen_id'));
						$data['pageTitle']='List Food types';
						
					  $this->template->set('adminMenue','news');
					  $this->template->set('adminSubMenue','AllColor');
					  $this->template->load('admin/Container', 'admin/food_type/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 //============================
function DeleteFoodType()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                              $data =  array(
                            
						    'dish_type_active' => '2'
						   
						   ); 
						   $this->db->where('dish_type_id', $page_id);
						   $this->db->update('dishes_type',$data); 
						   }
				  redirect(site_url('Category/AllFoodType')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
//=======================================================================================================================
#########################################Cuisine############################################################	
 //============================
function CuisineForm()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
		  $id=$this->uri->segment(4);	
		  if($id){
		  $data['page'] = $this->category->Details('dishes_cuisine','cuis_id',$id);
		  $data['pageTitle']=' Edit Cuisine ';
		  }else{
		  $data['pageTitle']=' New Cuisine ';
		  }
						
					  $this->template->set('adminMenue','feedback');
					  $this->template->set('adminSubMenue','AllKind');
					  $this->template->load('admin/Container', 'admin/cuisine/page_form',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
	//============================
	function SaveCuisine()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
//	 $details_ar=$this->input->post('details_ar', TRUE);
//	 $details_en=$this->input->post('details_en', TRUE);
	 //$type=$this->input->post('type', TRUE);
	 $active=$this->input->post('active', TRUE);
	 //$image=$this->input->post('attached_files_image', TRUE);
	/*$image = explode("/", $this->input->post('image'));	*/
	 $link=$this->input->post('link', TRUE);
	 $type=$this->input->post('type', TRUE);
	 $title = "";
 
	 
	  if($this->session->userdata('id'))
			   {   
			  
						   $data =  array(
                            'cuis_title_ar' =>  $title_ar 
						   , 'cuis_title_en' => $title_en 
						   , 'cuis_active' => $active 
						   //, 'type' => "1" 
						   //,  'cat_image' => $image
			               //,  'date' =>date('Y-m-d')
						   ); 
						  
						  if($pageid) //update
						    {
							$this->db->where('cuis_id',$pageid);
						    $this->db->update('dishes_cuisine', $data);
							}else{  //insert
							$this->db->insert('dishes_cuisine', $data);
							}  
							  
						   redirect(site_url('Category/CuisineList')); 
						  
	          } else {
			   
			    redirect(site_url('admin'));
			   
			   }
	   
	   }
//============================
function CuisineList()
     {
	 
	  if($this->session->userdata('id'))
			   {
					 
						$data['pages'] = $this->category->ListTable('dishes_cuisine');
						$data['pageTitle']='List Cuisines';
						
					  $this->template->set('adminMenue','news');
					  $this->template->set('adminSubMenue','AllColor');
					  $this->template->load('admin/Container', 'admin/cuisine/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 //============================
function DeleteCuisine()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                                $data =  array(
                            
						    'cuis_active' => '2'
						   
						   ); 
						   $this->db->where('cuis_id', $page_id);
						   $this->db->update('dishes_cuisine',$data); 
						   }
				  redirect(site_url('Category/CuisineList')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
 
//=======================================================================================================================
#########################################Addons############################################################	
  
    function AllAddons(){
    
      if($this->session->userdata('id'))
			   {
					 //$this->session->userdata('kithcen_id'),$column='',$id=''
						$data['pages'] = $this->category->ListAddons($this->session->userdata('kitchen_id'));
						$data['pageTitle']='List Addons';
						
					  $this->template->set('adminMenue','news');
					  $this->template->set('adminSubMenue','AllColor');
					  $this->template->load('admin/Container', 'admin/addons/page_list',$data);
		     } else {
			   redirect(site_url('admin'));
			 }  
    
    }
    

 //============================
function AddonsForm()
     {
	 
	  if($this->session->userdata('id'))
			   {
          
		  $data['type'] = $this->category->ListTable('dishes_type','dish_type_kit',$this->session->userdata('kitchen_id'));			 
		  $id=$this->uri->segment(4);	
		  if($id){
		  $data['page'] = $this->category->Details('dishes_addons','addons_id',$id);
		  $data['pages'] = $this->category->ListTable('dishes_addons','addons_parent_id',$id);
		  $data['pageTitle']=' Edit Addon ';
		  }else{
          $data['pages'] = "";      
		  $data['pageTitle']=' New Addon ';
		  }
						
					  $this->template->set('adminMenue','feedback');
					  $this->template->set('adminSubMenue','AllKind');
					  $this->template->load('admin/Container', 'admin/addons/page_form',$data);
		     } else {
			   redirect(site_url('admin'));
			 }
	 }
  
//==========================================
    
    function SaveAddon(){
    
     $pageid=$this->input->post('pageid', TRUE); 
	 $title_en=$this->input->post('title_en', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	 $active=$this->input->post('active', TRUE);
	 $cat_id=$this->input->post('cat_id', TRUE);
	 $addons_min_choice=$this->input->post('addons_min_choice', TRUE);
	 $addons_max_choice=$this->input->post('addons_max_choice', TRUE);
     $addons_title_ar = $this->input->post('addons_title_ar');  
     $addons_title_en = $this->input->post('addons_title_en');  
     $addons_price = $this->input->post('addons_price');  
        
        if($this->session->userdata('id'))
			   {   
            
                        
			  
						   $data =  array(
                            'addons_title_ar' =>  $title_ar 
						   , 'addons_title_en' => $title_en 
						   , 'addons_active' => $active 
						   , 'addons_kit_id' => $this->session->userdata('kitchen_id') 
						   , 'addons_cat_id' => $cat_id 
						   , 'addons_max_choice' => $addons_max_choice 
						   , 'addons_min_choice' => $addons_min_choice 
						   ); 
						  
						  if($pageid) //update
						    {
							$this->db->where('addons_id',$pageid);
						    $this->db->update('dishes_addons', $data);
                              
                            $this->db->where("addons_parent_id" , $pageid);  
                            $this->db->delete("dishes_addons");  
							}else{  //insert
							$this->db->insert('dishes_addons', $data);
                            $pageid = $this->db->insert_id();  
							}  
                            
            
                            for ($i = 0; $i <$addons_title_ar; $i++){
                              
                               $addons_value = array(
                                'addons_title_ar' =>  $addons_title_ar[$i] 
						        , 'addons_title_en' => $addons_title_en[$i] 
						        , 'addons_active' => $active 
						        , 'addons_kit_id' => $this->session->userdata('kitchen_id') 
						        , 'addons_cat_id' => $cat_id 
						        , 'addons_max_choice' => $addons_max_choice 
						        , 'addons_min_choice' => $addons_min_choice 
						        , 'addons_parent_id' => $pageid 
						        , 'addons_price' => $addons_price[$i] 
                               
                               );
                                
                             if($addons_title_ar[$i] || $addons_title_en[$i] || $addons_price[$i])  $this->db->insert('dishes_addons', $addons_value);
                                
                            }    
            
                            
							  
						   redirect(site_url('Category/AllAddons')); 
						  
	          } else {
			   
			    redirect(site_url('admin'));
			   
			   }
	   
	   }
//============================
function DeleteAddon()
     {
	 
	  if($this->session->userdata('id'))
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                            
                            
                           $this->db->where("addons_parent_id" , $pageid);  
                           $this->db->delete("dishes_addons");        
                            
                           $this->db->where('addons_id', $page_id);
						   $this->db->delete('dishes_addons'); 
                            
						   }
				  redirect(site_url('Category/AllAddons')); 
						 
		     } else {
			   redirect(site_url('admin'));
			 }
	 }    
//=======================================================================================================================

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */