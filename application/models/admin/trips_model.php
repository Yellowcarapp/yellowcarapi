<?php

class Trips_model extends CI_Model {

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
              $this->db->where('priceId',$id);
              $query = $this->db->get('prices');
              return $query->row_array();
   
   } 
//##########################page###########################
function tblLIst($table='',$column='',$id='',$group='')
   {
   
   	          $this->db->select('*');
            if($column!='')
              $this->db->where($column,$id);
    if($group!='')
    {
        $grp=explode(',',$group);
        for($i=0;$i<count($grp);$i++)
        {
            $this->db->group_by($grp[$i]);
        }
    }
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 
 function getPeicingData($package='',$country='',$city='')
   {
              $this->db->select('*');
                  $this->db->where('packageId',$package);
      $this->db->where('countryId',$country);
      $this->db->where('cityId',$city);
              $query = $this->db->get('prices');
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
    //*******************************/
    function get_driversReffer($q='')
    {
          $this->db->select('*');
			    $this->db->from('drivers');
				$this->db->like('driverFName',$q);
                $this->db->like('driverLName',$q);
                $this->db->like('drivercode',$q);
              $query = $this->db->get();
              return $query->result_array(); 
    }
//===========================	   
    

}//end model


?>