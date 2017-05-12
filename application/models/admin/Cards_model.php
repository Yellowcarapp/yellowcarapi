<?php
class Cards_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
 
//##########################page###########################
function Details($table='',$column='',$id='')
   {
   
   	          $this->db->select('*');
              $this->db->where($column,$id);
              $query = $this->db->get($table);
              return $query->row_array();
   
   } 
 
//##########################page###########################


// ===============================================
function CheckTitle($title ="")
{
$this->db->from("themes");
$this->db->where("title",$title);	
return $this->db->count_all_results();
}
//##########################page###########################
function ListTable($table='',$column='',$id='')
   {
   
   	          $this->db->select('*');
              if($column && $id) $this->db->where($column,$id);
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 

   //----------
  function cat_list($table,$whereValue='')
   {
              $this->db->select('*');
	  		  
 				if(!empty($whereValue))
				 {
				$this->db->where($whereValue,'1');		 	 
				 }
				$this->db->from($table.' as tbl');
              $query = $this->db->get();
              return $query->result_array();
   }
   //----------
   //--------
   function page_list_join($table,$table2,$whereFeild=0,$whereValue=0)
   {
                $this->db->select('tbl.id,tbl.title_en,tbl.title_ar,tbl.active,tbl.date,parrent.title_en ctitle_ar,parrent.title_en ctitle_ar');
			    $this->db->from($table.' as tbl');
			    $this->db->join($table2.' as parrent','tbl.cat_id=parrent.id','left');
				
				 if($whereFeild && $whereValue)
						 {
						 	 $this->db->where($whereFeild,$whereValue);
						 }
						 
               //$this->db->where('pages.special < ','1');
                $query = $this->db->get();
                return $query->result_array();
   }

  //================================
    function AllUsers($whereValue='',$id='')
    {
          $this->db->select('*');
 			  $this->db->from('admins');
	  		   $this->db->where('kitchen_id',$whereValue);
        $this->db->where('id <>',$id,false);
              $query = $this->db->get();
              return $query->result_array();
    }

//##########################addons###########################
function ListAddons($kit_id='')
{
$this->db->select('dishes_addons.*,dishes_type.dish_type_title_en as type_title');
$this->db->join('dishes_type', 'dishes_type.dish_type_id = dishes_addons.addons_cat_id',"LEFT");    
$this->db->where("dishes_addons.addons_parent_id","0");    
$this->db->where("dishes_addons.addons_kit_id",$kit_id);    
$query = $this->db->get("dishes_addons");
return $query->result_array();
} 
    
    
//===========================	   
 
}//end model


?>