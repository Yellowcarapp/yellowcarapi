<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Generalsetting extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/generalsetting_model','generalsetting');
		
		
	}
 
//#############################cats###############
    function  BrandsForm()
	  {
	   $id=$this->uri->segment(4);	   
		$session_data = $this->session->userdata('admin_logged_in');	
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			     
				   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('brands','brandId',$id);
 						$data['pageTitle']=lang('edit_brand');
 				   } else {
  						$data['pageTitle']=lang('Add_brand');
 				   }
				    
 				  $this->template->load('admin/Container', 'admin/generalsetting/brand/cat_page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveBrand()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $brandName_ar=$this->input->post('brandName_ar', TRUE);
	$brandName_en=$this->input->post('brandName_en', TRUE);
        $brandName_ur=$this->input->post('brandName_ur', TRUE);
	 $brandStatus=$this->input->post('brandStatus', TRUE);

	 
 
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('brandName_ar' => $brandName_ar
                                        ,'brandName_en' => $brandName_en
                                        ,'brandName_ur' => $brandName_ur
						   ,  'brandStatus' => $brandStatus 
						 
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('brandId',$pageid);
						     $this->db->update('brands', $data);
							}else{  //insert
						      $this->db->insert('brands', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/AllBrands')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AllBrands()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{					 
						$data['pages'] = $this->generalsetting->page_list('brands');
						$data['pageTitle']=lang('All_brand');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/brand/cat_page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function DeleteBrand()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                            $brandStatus=$this->uri->segment(5);
					   
        $data=array('brandStatus' => !$brandStatus);
						   $this->db->where('brandId', $page_id);
						   $this->db->update('brands',$data);
						    
						   }
				  redirect(base_url('generalsetting/AllBrands')); 
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
 
 //##############################
 function addCurrency()
 {
     $id=$this->uri->segment(4);	   
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			     
				   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('currency','curr_id',$id);
 						$data['pageTitle']='Edite Brands  ';
 				   } else {
  						$data['pageTitle']='Add  Brands ';
 				   }
				    $this->load->view('admin/generalsetting/currency/page_form', $data);
 				//  $this->template->load('admin/Container', 'admin/generalsetting/brand/cat_page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }  
 }
 //********************************************/
    function SaveCurrency()
    {
         $pageid=$this->input->post('pageid', TRUE); 
	 $curr_name_ar=$this->input->post('curr_name_ar', TRUE);
	$curr_name_en=$this->input->post('curr_name_en', TRUE);
        $curr_name_ur=$this->input->post('curr_name_ur', TRUE);
        
	 $curr_abbr_ar=$this->input->post('curr_abbr_ar', TRUE);
$curr_abbr_en=$this->input->post('curr_abbr_en', TRUE);
        $curr_abbr_ur=$this->input->post('curr_abbr_ur', TRUE);
        $curLang=lang('db');
	 if( $curLang=='ar')$curr_name=$curr_name_ar;
        else $curr_name=$curr_name_en;
 
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('curr_name_ar' => $curr_name_ar
                                        ,'curr_name_en' => $curr_name_en
                                        ,'curr_name_ur' => $curr_name_ur
                                        ,  'curr_abbr_ar' => $curr_abbr_ar
                                         ,  'curr_abbr_en' => $curr_abbr_en
                                         ,  'curr_abbr_ur' => $curr_abbr_ur
						 
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('curr_id',$pageid);
						     $this->db->update('currency', $data);
                              echo "<script>$('#cboxClose').click();$('#countryCurrency  option').filter(function() { 
        return ($(this).val() == '".$pageid."'); //To select Blue
    }).html('".$curr_name."');</script>";
							}else{  //insert
						      $this->db->insert('currency', $data);
                              $pageID=$this->db->insert_id();
                              echo "<script>$('#cboxClose').click();$('#countryCurrency')         .append($('<option></option>')        .attr('value',".$pageID.")  .text('".$curr_name."')); </script>";
						    }
						
					 echo "<script></script>";
						 //  redirect(base_url('generalsetting/AllBrands')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
    }
 
//#############################News###############
    function  ModelForm()
	  {
	   $id=$this->uri->segment(4);	   
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			     
				 $data['cats'] = $this->generalsetting->page_list('brands','brandStatus','1'); 
				   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('models','modelId',$id);
 						$data['pageTitle']=lang('edit_model');
 				   } else {
  						$data['pageTitle']=lang('Add_model');
 				   } 
				   
 				  $this->template->load('admin/Container', 'admin/generalsetting/brand/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveModel()
	   {
	    $pageid=$this->input->post('pageid', TRUE); 
	   
		 
	
	 $modelTitle_ar=$this->input->post('modelTitle_ar', TRUE);
         $modelTitle_en=$this->input->post('modelTitle_en', TRUE);
         $modelTitle_ur=$this->input->post('modelTitle_ur', TRUE);
	
	 $modelStatus=$this->input->post('modelStatus', TRUE);
	 $brandId=$this->input->post('brandId', TRUE);
	 
	 
	  
	$session_data = $this->session->userdata('admin_logged_in');			
	if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
	{
						 $data =  array('modelTitle_ar' => $modelTitle_ar
                                        ,'modelTitle_en' => $modelTitle_en
                                        ,'modelTitle_ur' => $modelTitle_ur
						   ,  'modelStatus' => $modelStatus 
						   ,  'brandId' => $brandId
						   
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('modelId',$pageid);
						     $this->db->update('models', $data);
							}else{  //insert
						      $this->db->insert('models', $data);
							} 
						
					 
						   redirect(base_url('generalsetting/AllModel')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AllModel()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{
						$data['pages'] = $this->generalsetting->page_list_joinTbl('models','brands','brandId','brandId');
						$data['pageTitle']=lang('All_Model');						

					  $this->template->load('admin/Container', 'admin/generalsetting/brand/page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function DeleteModel()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   { $modelStatus=$this->uri->segment(5);
					   
        $data=array('modelStatus' => !$modelStatus);
						    $this->db->where('modelId', $page_id);
						    $this->db->update('models',$data); 
						   }
				  redirect(base_url('generalsetting/AllModel')); 
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
  //##############################
    //#############################cats###############
    function  TripTypeForm()
	  {
	   $id=$this->uri->segment(4);	   
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			     
				   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('tripTypes','typeId',$id);
 						$data['pageTitle']=lang('edit_Trip_Type');
 				   } else {
  						$data['pageTitle']=lang('Add_Trip_Type');
 				   }
				    
 				  $this->template->load('admin/Container', 'admin/generalsetting/TripType/cat_page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveTripType()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $typeName_ar=$this->input->post('typeName_ar', TRUE);
	$typeName_en=$this->input->post('typeName_en', TRUE);
        $typeName_ur=$this->input->post('typeName_ur', TRUE);
	 $typeStatus=$this->input->post('typeStatus', TRUE);

	 
 
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('typeName_ar' => $typeName_ar
                                        ,'typeName_en' => $typeName_en
                                         ,'typeName_ur' => $typeName_ur
						   ,  'typeStatus' => $typeStatus 
						 
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('typeId',$pageid);
						     $this->db->update('tripTypes', $data);
							}else{  //insert
						      $this->db->insert('tripTypes', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/AllTripType')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AllTripType()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{					 
						$data['pages'] = $this->generalsetting->page_list('tripTypes');
						$data['pageTitle']=lang('All_Trip_Type');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/TripType/cat_page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function DeleteTripType()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                            $typeStatus=$this->uri->segment(5);
					   
        $data=array('typeStatus' => !$typeStatus);
						   $this->db->where('typeId', $page_id);
						   $this->db->update('tripTypes',$data);
						    
						   }
				  redirect(base_url('generalsetting/AllTripType')); 
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
     //#############################cats###############
    function  LevelForm()
	  {
	   $id=$this->uri->segment(4);	   
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			     
				   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('levels','levelId',$id);
 						$data['pageTitle']=lang('edit_level');
 				   } else {
  						$data['pageTitle']=lang('Add_level');
 				   }
				    
 				  $this->template->load('admin/Container', 'admin/generalsetting/Levels/cat_page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveLevel()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $levelName_ar=$this->input->post('levelName_ar', TRUE);
	$levelName_en=$this->input->post('levelName_en', TRUE);
        $levelName_ur=$this->input->post('levelName_ur', TRUE);
        $img=$this->input->post('attached_files_image',TRUE);
	 $levelStatus=$this->input->post('levelStatus', TRUE);

	 
 
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('levelName_ar' => $levelName_ar
                                        ,'levelName_en' => $levelName_en
                                        ,'levelName_ur' => $levelName_ur
                                        ,'level_img'=>$img
						   ,  'levelStatus' => $levelStatus
						 
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('levelId',$pageid);
						     $this->db->update('levels', $data);
							}else{  //insert
						      $this->db->insert('levels', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/AllLevel')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AllLevel()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{					 
						$data['pages'] = $this->generalsetting->page_list('levels');
						$data['pageTitle']=lang('All_level');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/Levels/cat_page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function DeleteLevel()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
                             $levelStatus=$this->uri->segment(5);
					   
        $data=array('levelStatus' => !$levelStatus );
						   $this->db->where('levelId', $page_id);
						   $this->db->update('levels',$data);
						    
						   }
				  redirect(base_url('generalsetting/AllLevel')); 
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
//#############################cats###############
  //#############################Country###############
    function packageForm()
	  {
	   $id=$this->uri->segment(4);	   
	   $session_data = $this->session->userdata('admin_logged_in');			
	   if($this->session->userdata('id'))
	   {	   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('packages','packageId',$id);
 						$data['pageTitle']=lang('edit_Packages');
 				   } else {
  						$data['pageTitle']=lang('Add_Packages');
 				   }
				    
 				  $this->template->load('admin/Container', 'admin/generalsetting/package/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function Savepackage()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $packageName_ar=$this->input->post('packageName_ar', TRUE);
	$packageName_en=$this->input->post('packageName_en', TRUE);
        $packageName_ur=$this->input->post('packageName_ur', TRUE);
	   
	 $packageStatus=$this->input->post('packageStatus', TRUE);
	 
	 
	$session_data = $this->session->userdata('admin_logged_in');			
	if($this->session->userdata('id'))
	{ 
						 $data =  array('packageName_ar' => $packageName_ar 
						   ,'packageName_en' => $packageName_en 
                                        ,'packageName_ur' => $packageName_ur 
						  ,  'packageStatus' => $packageStatus 
						  
 						 
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('packageId',$pageid);
						     $this->db->update('packages', $data);
							}else{  //insert
						      $this->db->insert('packages', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/Allpackage')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function Allpackage()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	    if($this->session->userdata('id'))
   		{					 
						$data['pages'] = $this->generalsetting->All('packages',"packageId");
						$data['pageTitle']=lang('All_Packages');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/package/page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function Deletepackage()
     {
	 
	$session_data = $this->session->userdata('admin_logged_in');			
	if($this->session->userdata('id'))
	{
						$page_id=$this->uri->segment(4);
						
						   $countryStatus=$this->uri->segment(5);
					     
        $data=array('packageStatus' => !$countryStatus );
						    $this->db->where('packageId',$page_id);
						   $this->db->update('packages',$data);
                            
							redirect(base_url('generalsetting/Allpackage'));
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
 
 
 
	
	
	
	
 //#############################Country###############
    function CountryForm()
	  {
	   $id=$this->uri->segment(4);	   
	   $session_data = $this->session->userdata('admin_logged_in');			
	   //if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	   if($this->session->userdata('id'))
	   {	    $data['currency'] = $this->generalsetting->All('currency','curr_id');
       
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('countries','countryId',$id);
 						$data['pageTitle']=lang('edit_Country');
 				   } else {
  						$data['pageTitle']=lang('Add_Country');
 				   }
				    
 				  $this->template->load('admin/Container', 'admin/generalsetting/country/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveCountry()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $countryCode=$this->input->post('countryCode', TRUE);
	 $countryName_ar=$this->input->post('countryName_ar', TRUE);
        $countryName_en=$this->input->post('countryName_en', TRUE);
        $countryName_ur=$this->input->post('countryName_ur', TRUE);
	 $countryCurrency=$this->input->post('countryCurrency', TRUE);
	   
	 $countryStatus=$this->input->post('countryStatus', TRUE);
	 $image=$this->input->post('attached_files_image', TRUE);
	 $timeZone=$this->input->post('timeZone',TRUE);
	 
	$session_data = $this->session->userdata('admin_logged_in');			
	//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	if($this->session->userdata('id'))
	{ 
						 $data =  array('countryCode' => $countryCode 
						   ,'countryName_en' => $countryName_en 
						   ,'countryName_ar' => $countryName_ar 
                                         ,'countryName_ur' => $countryName_ur 
						  ,  'countryCurrency' => $countryCurrency 
						  
 						   ,  'countryStatus' => $countryStatus 
						   ,  'country_flag' => $image 
						 ,'timeZone'=>$timeZone
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('countryId',$pageid);
						     $this->db->update('countries', $data);
							}else{  //insert
						      $this->db->insert('countries', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/AllCountry')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AllCountry()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	    if($this->session->userdata('id'))
   		{					 
						$data['pages'] = $this->generalsetting->All('countries',"countryId");
						$data['pageTitle']=lang('All_Countries');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/country/page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function DeleteCountry()
     {
	 
	$session_data = $this->session->userdata('admin_logged_in');			
	//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	if($this->session->userdata('id'))
	{
						$page_id=$this->uri->segment(4);
						
						   $countryStatus=$this->uri->segment(5);
					      /*  $this->db->where('area_country_id',$page_id);
						    $this->db->delete('area');*/
							/*$this->db->where('countryId',$page_id);
						    $this->db->delete('cities');*/
        $data=array('countryStatus' => !$countryStatus );
						    $this->db->where('countryId',$page_id);
						   $this->db->update('countries',$data);
                            
							redirect(base_url('generalsetting/AllCountry'));
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
 
 //##############################
 
 //#############################City###############
    function CityForm()
	  {
	   $id=$this->uri->segment(4);	   

		//print_r($data['countries']);								     	   
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		if($this->session->userdata('id'))
		{
				 $data['countries'] = $this->generalsetting->All('countries','countryId','countryStatus','1');				   
				  if($id && $id!='saved') 
				   {    
 						$data['page'] = $this->generalsetting->Details('cities','cityId',$id);

 						$data['pageTitle']=lang('edit_City');
 				   } else {
  						$data['pageTitle']=lang('Add_City');
 				   }
				    
 				  $this->template->load('admin/Container', 'admin/generalsetting/city/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveCity()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $cityName_ar=$this->input->post('cityName_ar', TRUE);
	
      $cityName_en=$this->input->post('cityName_en', TRUE);
         $cityName_ur=$this->input->post('cityName_ur', TRUE);
     $cityStatus=$this->input->post('cityStatus', TRUE);
	 $countryId=$this->input->post('countryId', TRUE);
	 /*$image=$this->input->post('image', TRUE);
	 $link=$this->input->post('link', TRUE);
	 $type=$this->input->post('type', TRUE);*/
	 
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	
			  if($this->session->userdata('id'))
	{ 
						 $data =  array('cityName_ar' => $cityName_ar 
						  ,'cityName_en' => $cityName_en 
                                        ,'cityName_ur' => $cityName_ur 
						   ,  'countryId' => $countryId 
						 
                          
 						   ,  'cityStatus' => $cityStatus 
						  
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('cityId',$pageid);
						     $this->db->update('cities', $data);
							}else{  //insert
						      $this->db->insert('cities', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/AllCity')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AllCity()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		if($this->session->userdata('id'))
		{					 
                        $country_id=$this->uri->segment(4);
                        $column="";
                        if($country_id) $column = "cities.countryId";
						$data['pages'] = $this->generalsetting->ListCities($column,$country_id);
						$data['pageTitle']=lang('All_City');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/city/page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
//============================
function DeleteCity()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	    if($this->session->userdata('id'))
		{
						$page_id=$this->uri->segment(4);
						
						 /*$this->db->where('area_city_id',$page_id);
						    $this->db->delete('area');
			*/
            $cityStatus=$this->uri->segment(5);
					   
        $data=array('cityStatus' => !$cityStatus );
						    $this->db->where('cityId',$page_id);
						    $this->db->update('cities',$data);
                            redirect(base_url('generalsetting/AllCity')); 
						 
				  
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //===========================
public function getTablecity()
{
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	 $aColumns =array("cities.id as nid","countries.title_ar as title2","cities.title_ar as title","city_order","cities.active as nactive");
	 $aColumnsAlias =array("nid","title2","title","city_order","nactive");
	 $aColumnsSearch=array("cities.id","countries.title_ar","cities.title_ar","city_order","cities.active");
	// DB table to use
	$sTable = 'cities join countries on cities.country_id=countries.id AND cities.id <> -1';
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
            $row["DT_RowId"]= "city_".$aRow['nid'];
		 //   print_r($aColumns);
		//	echo "<br>";
			 
			foreach($aColumnsAlias as $col)
				{
					if($col=='nactive')		  	
					{
						 if($aRow[$col]==1) { 
								$row[]='<small class="tag green-bg">فعال</small>';
						 } else { 
							   $row[]='<small class="tag red-bg">غير فعال</small>';
						 } 
					
					}
					else
						$row[] = $aRow[$col];
				}
		
			$output['aaData'][] = $row;
		}

	echo json_encode($output);
} 
 
 
 
 //#############################Districts###############
    function placeForm()
	  {
	   $id=$this->uri->segment(4);	   

		//print_r($data['countries']);								     	   

		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		 if($this->session->userdata('id'))
		{
				 $data['countries'] = $this->generalsetting->All('countries','countryId','countryStatus','1');	
				 if(isset($data['countries'][0]['countryId']) && $data['countries'][0]['countryId']!='')
				 	$cntry_id=$data['countries'][0]['countryId'];
				 else
				 	$cntry_id='';
                    
             
             
							   
				  if($id ) 
				   {    
 						$data['page']=$page = $this->generalsetting->Details('places','placeId',$id);
							
						$cntry_id= $page['countryId'];


 						$data['pageTitle']=lang('edit_place');
 				   } else {
  						$data['pageTitle']=lang('Add_place');
 				   }
				  
				  $data['cities'] = $this->generalsetting->All_list('cities','countryId',$cntry_id,'cityStatus','1');					 			   				    
 				  
				  $this->template->load('admin/Container', 'admin/generalsetting/districts/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function Saveplace()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $placeName_ar=$this->input->post('placeName_ar', TRUE);
         $placeName_en=$this->input->post('placeName_en', TRUE);
         $placeName_ur=$this->input->post('placeName_ur', TRUE);
	 $lat=$this->input->post('lat', TRUE);
	
     $lng=$this->input->post('lng', TRUE);     
	 $placeType=$this->input->post('placeType', TRUE);
	 $countryId=$this->input->post('countryId', TRUE);
	 $cityId=$this->input->post('cityId', TRUE);	 
	
 
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
				  if($this->session->userdata('id'))
	{ 
						 $data =  array('placeName_ar' => $placeName_ar 
						   , 'placeName_en' => $placeName_en  
                                        , 'placeName_ur' => $placeName_ur  
						   ,'placeLat' => $lat
						   ,  'placeLon' => $lng 
						   ,  'placeType' => $placeType
						   ,  'countryId' => $countryId 
                          
 						   ,  'cityId' => $cityId 
						 
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('placeId',$pageid);
						     $this->db->update('places', $data);
							}else{  //insert
						      $this->db->insert('places', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/Allplaces')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function Allplaces()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		 if($this->session->userdata('id'))
		{

					 
                        $city_id=$this->uri->segment(4);
                        $column="";
                        if($city_id) $column = "places.cityId";
             
						$data['pages'] = $this->generalsetting->AllDistricts($column,$city_id);
						$data['pageTitle']=lang('All_places');
						
					 
					  $this->template->load('admin/Container', 'admin/generalsetting/districts/page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function Deleteplace()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		 if($this->session->userdata('id'))
		{
						$page_id=$this->uri->segment(4);
						$district_id=$this->input->post("placeId");
						
						if($page_id)
						   {
							
						    $this->db->where('placeId',$page_id);
						    $this->db->delete('places');
                            redirect(base_url('generalsetting/Allplaces')); 
						   }
						
				 
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
	
	
//===========#######################PageS######################=====================
function  AdvertiseForm()
{
	   $id=$this->uri->segment(4);	   
	   $session_data = $this->session->userdata('admin_logged_in');			
	   //if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	   if($this->session->userdata('id'))
	   {	    
		   
		   $data['countries'] = $this->generalsetting->All('countries','countryId');	
				 if(isset($data['countries'][0]['id']) && $data['countries'][0]['id']!='')
				 	$cntry_id=$data['countries'][0]['id'];
				 else
				 	$cntry_id='';
		   
		   
				  if($id ) 
				   {    
 						$data['page'] = $this->generalsetting->Details('advertise',"adv_id",$id);
 						$data['pageTitle']='الاعلانات';
 				   } else {
  						$data['pageTitle']='الاعلانات';
 				   }
				   
		        $data['cities'] = $this->generalsetting->All('cities','cityId','countryId',$cntry_id);	
		   
		      if(isset($data['cities'][0]['id']) && $data['cities'][0]['id']!='')
						$city_id=$data['cities'][0]['id'];
					 else
						$city_id='';
		   
		         //$data['shops'] = $this->generalsetting->ShopList($city_id,$cntry_id);	
		   
		       
 				  $this->template->load('admin/Container', 'admin/advertise/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveAdvertise()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $startDate=$this->input->post('startDate', TRUE);
	 $endDate=$this->input->post('endDate', TRUE);
	 $title_ar=$this->input->post('title_ar', TRUE);
	 $title_en=$this->input->post('title_en', TRUE);
	 $active=$this->input->post('active', TRUE);
	 $image=$this->input->post('attached_files_image', TRUE);
	 $country_id=$this->input->post('country_id', TRUE);
	 $city_id=$this->input->post('city_id', TRUE);
	 $shop_id=$this->input->post('shop_id', TRUE);
	 
	$session_data = $this->session->userdata('admin_logged_in');			
	//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	if($this->session->userdata('id'))
	{ 
						 $data =  array('start_date' => date("Y-m-d",strtotime($startDate)) 
						   //,  
						  ,  'end_date' => date("Y-m-d",strtotime($endDate)) 
						  ,  'active' => $active 
						   ,  'image' => $image 
						   ,  'adv_title_ar' => $title_ar 
						   ,  'adv_title_en' => $title_en 
			              // ,  'country_id' =>$country_id
			              // ,  'city_id' =>$city_id
                           //,  'shop_id'=>$shop_id               
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('id',$pageid);
						     $this->db->update('advertise', $data);
							}else{  //insert
						      $this->db->insert('advertise', $data);
						    }
						
					 
						   redirect(base_url('generalsetting/AdvertiseList')); 
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }
	   
	   }
//============================
function AdvertiseList()
     {
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	    if($this->session->userdata('id'))
   		{					 
						$data['pages'] = $this->generalsetting->AdvertiseList();
						$data['pageTitle']='اعدادات المول';
						
					 
					  $this->template->load('admin/Container', 'admin/advertise/page_list',$data);
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 //============================
function DeleteAdvertise()
     {
	 
	$session_data = $this->session->userdata('admin_logged_in');			
	//if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
	if($this->session->userdata('id'))
	{
						$page_id=$this->uri->segment(4);
						
						
					      
						    $this->db->where('adv_id',$page_id);
						   $this->db->delete('advertise');
                            
						 redirect(base_url('generalsetting/AdvertiseList')); 
						 
		     } else {
			   redirect(base_url('admin'));
			 }
	 }
 
 
	
	
	
	
	
	
//===========================
public function getTabledistrict()
{
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	 $aColumns =array("districts.id as nid","countries.title_ar as title2","cities.title_ar as title1","districts.title_ar as title","dis_order","districts.active as nactive");
	 $aColumnsAlias =array("nid","title2","title1","title","dis_order","nactive");
	 $aColumnsSearch=array("districts.id","countries.title_ar","cities.title_ar","districts.title_ar","dis_order","districts.active");
	// DB table to use
	$sTable = ' districts join ( cities join countries on cities.country_id=countries.id ) on cities.id = districts.city_id AND districts.id <> -1';
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
	$this->db->_protect_identifiers = FALSE;
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
		$row["DT_RowId"]= "district_".$aRow['nid'];
		 //   print_r($aColumns);
		//	echo "<br>";
			 
			foreach($aColumnsAlias as $col)
				{
					if($col=='nactive')		  	
					{
						 if($aRow[$col]==1) { 
								$row[]='<small class="tag green-bg">فعال</small>';
						 } else { 
							   $row[]='<small class="tag red-bg">غير فعال</small>';
						 } 
					
					}
					else
						$row[] = $aRow[$col];
				}
		
			$output['aaData'][] = $row;
		}

	echo json_encode($output);
} 
 
//*************************************/
    function get_cities_with_default()
{
	$data['cities'] = $this->generalsetting->get_cities();
	$this->load->view('admin/generalsetting/get_cities_with_default',$data);
} 
    //**********************************/
function get_cities()
{
    $cntry_id = $this->uri->segment(4);  
	$data['cities'] = $this->generalsetting->get_cities();
   // echo $cntry_id;
	$this->load->view('admin/generalsetting/get_cities',$data);
} 
 //****************************************/
    function get_currency()
    {
        $data['cities'] = $this->generalsetting->get_currencies();
	$this->load->view('admin/generalsetting/get_currencies',$data);
    }
    //***********************************************//
function get_districts()
{
	$data['area'] = $this->generalsetting->get_districts();
	$this->load->view('admin/generalsetting/get_districts',$data);
}
function get_shop()
{
	$city_id = $this->uri->segment(4);   	
	$data['shop'] = $this->generalsetting->ShopList($city_id);
	$this->load->view('admin/generalsetting/get_shop',$data);
} 
 
//============================
function OtherCountry()
     {
	    $search_type = $this->uri->segment(4);
        if($search_type=='') $search_type = 1;
        $data['search_type'] = $search_type; 
        
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		{					 
				//$data['pages'] = $this->generalsetting->query('other_countries');
				$data['pageTitle']='دول الزوار';
				
			 
			  $this->template->load('admin/Container', 'admin/generalsetting/other_country/page_list',$data);
	     } else {
		   redirect(base_url('admin'));
		 }
	 }  
     
 //===========================
public function getTableOtherCountry()
{
    
    $search_type = $this->uri->segment(4);
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
     $cntry = "cntry";
     if($search_type==1)
     {
        $field_name = "realestate";
        $table_name = "realestates";
     }
     else if($search_type==2)
     {
        $field_name = "realrequest";
        $table_name = "realrequests";        
     }
     else if($search_type==3)
     {
        $field_name = "allarm";
        $table_name = "allarm";    
        $cntry = "country";    
     }
	 $aColumns =array($field_name."_id as nid ", $field_name."_".$cntry."_other as other_title");
	 $aColumnsAlias =array("nid","other_title");
	 $aColumnsSearch=array($field_name."_id",$field_name."_".$cntry."_other");
	// DB table to use
	$sTable = $table_name;
    
	//WHERE 
    $this->db->where("Not ISNULL(".$field_name."_".$cntry."_other) AND ".$field_name."_".$cntry."_other <> ''",NULL,FALSE);
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
            $row["DT_RowId"]= $aRow['nid'];
		 //   print_r($aColumns);
		//	echo "<br>";
			 
			foreach($aColumnsAlias as $col)
				{
					if($col=='nactive')		  	
					{
						 if($aRow[$col]==1) { 
								$row[]='<small class="tag green-bg">فعال</small>';
						 } else { 
							   $row[]='<small class="tag red-bg">غير فعال</small>';
						 } 
					
					}
					else
						$row[] = $aRow[$col];
				}
		
			$output['aaData'][] = $row;
		}

	echo json_encode($output);
}      
      
//=====#########################

//============================
function OtherCity()
     {
	    $search_type = $this->uri->segment(4);
        if($search_type=='') $search_type = 1;
        $data['search_type'] = $search_type; 
        
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		{					 
				//$data['pages'] = $this->generalsetting->query('other_countries');
				$data['pageTitle']='مدن الزوار';
				
			 
			  $this->template->load('admin/Container', 'admin/generalsetting/other_city/page_list',$data);
	     } else {
		   redirect(base_url('admin'));
		 }
	 }  
     
 //===========================
public function getTableOtherCity()
{
    
    $search_type = $this->uri->segment(4);
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
     $cntry = "city";
     if($search_type==1)
     {
        $field_name = "realestate";
        $table_name = "realestates";
     }
     else if($search_type==2)
     {
        $field_name = "realrequest";
        $table_name = "realrequests";        
     }
     else if($search_type==3)
     {
        $field_name = "allarm";
        $table_name = "allarm";    
        $cntry = "city";    
     }
	 $aColumns =array($field_name."_id as nid ", $field_name."_".$cntry."_other as other_title");
	 $aColumnsAlias =array("nid","other_title");
	 $aColumnsSearch=array($field_name."_id",$field_name."_".$cntry."_other");
	// DB table to use
	$sTable = $table_name;
    
	//WHERE 
    $this->db->where("Not ISNULL(".$field_name."_".$cntry."_other) AND ".$field_name."_".$cntry."_other <> ''",NULL,FALSE);
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
            $row["DT_RowId"]= $aRow['nid'];
		 //   print_r($aColumns);
		//	echo "<br>";
			 
			foreach($aColumnsAlias as $col)
				{
					if($col=='nactive')		  	
					{
						 if($aRow[$col]==1) { 
								$row[]='<small class="tag green-bg">فعال</small>';
						 } else { 
							   $row[]='<small class="tag red-bg">غير فعال</small>';
						 } 
					
					}
					else
						$row[] = $aRow[$col];
				}
		
			$output['aaData'][] = $row;
		}

	echo json_encode($output);
}      

//============================
function OtherDistrict()
     {
	    $search_type = $this->uri->segment(4);
        if($search_type=='') $search_type = 1;
        $data['search_type'] = $search_type; 
        
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="" && $session_data['emp_type'] == 1 )
		{					 
				//$data['pages'] = $this->generalsetting->query('other_countries');
				$data['pageTitle']='أحياء الزوار';
				
			 
			  $this->template->load('admin/Container', 'admin/generalsetting/other_district/page_list',$data);
	     } else {
		   redirect(base_url('admin'));
		 }
	 }  
     
 //===========================
public function getTableOtherDistrict()
{
    
    $search_type = $this->uri->segment(4);
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
     $cntry = "district";
     if($search_type==1)
     {
        $field_name = "realestate";
        $table_name = "realestates";
     }
     else if($search_type==2)
     {
        $field_name = "realrequest";
        $table_name = "realrequests";        
     }
     else if($search_type==3)
     {
        $field_name = "allarm";
        $table_name = "allarm";    
        $cntry = "district";    
     }
	 $aColumns =array($field_name."_id as nid ", $field_name."_".$cntry."_other as other_title");
	 $aColumnsAlias =array("nid","other_title");
	 $aColumnsSearch=array($field_name."_id",$field_name."_".$cntry."_other");
	// DB table to use
	$sTable = $table_name;
    
	//WHERE 
    $this->db->where("Not ISNULL(".$field_name."_".$cntry."_other) AND ".$field_name."_".$cntry."_other <> ''",NULL,FALSE);
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
            $row["DT_RowId"]= $aRow['nid'];
		 //   print_r($aColumns);
		//	echo "<br>";
			 
			foreach($aColumnsAlias as $col)
				{
					if($col=='nactive')		  	
					{
						 if($aRow[$col]==1) { 
								$row[]='<small class="tag green-bg">فعال</small>';
						 } else { 
							   $row[]='<small class="tag red-bg">غير فعال</small>';
						 } 
					
					}
					else
						$row[] = $aRow[$col];
				}
		
			$output['aaData'][] = $row;
		}

	echo json_encode($output);
}      



}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */