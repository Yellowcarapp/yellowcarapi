<?php

class Page_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
 
//##########################page###########################
    function pagesList()
{
		  $this->db->select('*');
		//  $this->db->where('home_sett_id',1);
		  $query = $this->db->get('pages');
		  return $query->result_array();

}
    //************************************************/
function HomePageSettings()
{
		  $this->db->select('*');
		  $this->db->where('home_sett_id',1);
		  $query = $this->db->get('home_settings');
		  return $query->row_array();

}
//##########################page###########################
function seo($id='')
{
		  $this->db->select('*');
		  $this->db->where('id',$id);
		  $query = $this->db->get('seo');
		  return $query->row_array();

}
//#########################Page############################
function read_message($id='')
   {
		  $this->db->select('*');
          $this->db->where("id",$id);    
		  $query = $this->db->get("feedback");
		  return $query->row_array();
   
   }//#########################Page############################
function pageDetails($page_id='')
   {
		  /* $pre_page = $this->input->get('pre_page');
		 if($pre_page=="About_")	
		 	$table="about_pages";
		 else*/
		 	$table="pages";
		  $this->db->select('*');
		  $this->db->where('pageId',$page_id);
		  $query = $this->db->get($table);
		  return $query->row_array();
   
   } 
 function pages($page_id='0')
   {
		   $pre_page = $this->input->get('pre_page');
		 if($pre_page=="About_")	
		 	$table="about_pages";
		 else
		 	$table="pages";   
   
               $this->db->select('*');
              // $this->db->where('parrent_id','0');
			   if($page_id)  $this->db->where('pageId',$page_id);
               $query = $this->db->get('pages');
              return $query->result_array();
   
   }
  function pag_list()
   {
                $this->db->select('pages.page_name as title_ar,pages.page_id as id');
			    $this->db->from('pages');
			    //$this->db->join('pages as parrent','pages.parrent_id=parrent.id','left');
				$this->db->order_by('pages.page_id','asc');
               //$this->db->where('pages.special < ','1');
              $query = $this->db->get();
              return $query->result_array();
   }
  //====================================================================
	function about_pag_list()
   {
                $this->db->select('pages.page_name as title_ar,pages.page_id as id');
			    $this->db->from('about_pages as pages');
			    //$this->db->join('pages as parrent','pages.parrent_id=parrent.id','left');
				$this->db->order_by('pages.page_id','asc');
               //$this->db->where('pages.special < ','1');
              $query = $this->db->get();
              return $query->result_array();
   
   }
  //====================================================================
	function messages_list($id="")
   {
    $this->db->select('*');	
	$this->db->from('feedback');
	if($id !=""){
	$this->db->where('id',$id);
	}
	$this->db->order_by("id", "desc"); 	
	$query = $this->db->get();
	//$result = $query->result();
	return $query->result_array();

   
   }
   
//===========================	   
 
}//end model


?>