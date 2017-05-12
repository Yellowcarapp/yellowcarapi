<?php

class Passengers_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
 

   
//##########################page###########################
function Details($id='')
   {
   
   	          $this->db->select('*');
              $this->db->where('userId',$id);
              $query = $this->db->get('admins');
              return $query->row_array();
   
   } 
//##########################page###########################
function PageDetails($table='',$column='',$id='')
   {
   
   	          $this->db->select('*');
              $this->db->where($column,$id);
              $query = $this->db->get($table);
              return $query->row_array();
   
   } 
 function members()
   {
     
              $this->db->select('*');
     $this->db->order_by('passengerId','DESC');
              $query = $this->db->get('passengers');
     
              return $query->result_array();
   
   }
  function members_list()
   {
                $this->db->select('*');
			    $this->db->from('users');
				$this->db->order_by('id','desc');
                $this->db->group_by('users.id ');
              $query = $this->db->get();
              return $query->result_array();
   }
function  ornaig_list($start=0,$end=0)
   {
                $this->db->select('*');
			    $this->db->from('ornaig');
				//$this->db->where('cat_type',$cat_type);
			    //$this->db->join('news_cat','news_cat.id=news.cat_id','left');
				$this->db->order_by('id','desc');
				$this->db->limit($end,$start);
                $query = $this->db->get();
                return $query->result_array();
   } 
    //**********************
    function getTable($tbl='',$column='',$val='',$wh='')
    {
          $this->db->select('*');
        $this->db->where($column,$val);
        if($wh!='')  $this->db->where($wh,'1');
              $query = $this->db->get($tbl);
              return $query->result_array();
    }
    //***********************************/
   
//===========================	   
    

}//end model


?>