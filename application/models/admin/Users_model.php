<?php

class Users_model extends CI_Model {

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
    //*****************************************//
    function All($table='',$orderFileld='',$id_field='',$id='',$wh='')
   {
   
   	          $this->db->select('*');
			  if($id!='')
	              $this->db->where($id_field,$id);	
if($wh!='')$this->db->where($wh);
             	  
	          if($orderFileld) $this->db->order_by($orderFileld,"desc") ;       
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 
    //*******************************************************//
 function members()
   {$network= $this->session->userdata('network');
   $id= $this->session->userdata('id');
              $this->db->select('*');
     $this->db->where('userId <> -1');
     $this->db->where('userId <> ',$id,FALSE);
  //  $this->db->where('a.network_active',1);	
     if($network!=-1 )
        $this->db->where('network',$network);
     $this->db->from('admins c');
        $this->db->join('network a', 'a.network_admin=c.userId and a.network_active =1','left');
    $this->db->order_by('userId','DESC');
              $query = $this->db->get();
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
      function webSettings($userId='')
       {
	           $this->db->select('*');
               $query = $this->db->get('site_setting');
                return $query->row_array();
  	   }	
//===========================	   
    

}//end model


?>