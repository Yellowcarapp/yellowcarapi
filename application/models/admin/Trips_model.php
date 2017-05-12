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
    //*************************************//
//##########################page###########################
function tblLIst($table='',$column='',$id='',$wh='',$group='')
   {
   
   	          $this->db->select('*');
            if($column!='')
              $this->db->where($column,$id);
    if($wh!='')$this->db->where($wh);
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
    //***********************************************//
    function pricingList($group='')
    {
             $this->db->select('*');
          $this->db->from('prices a ');
            $this->db->join('packages b', 'a.packageId = b.packageId');
         $this->db->join('countries c', 'a.countryId = c.countryId and countryStatus=1');
        $this->db->join('cities d', 'a.cityId = d.cityId');
        $this->db->join('levels e', 'a.levelId=e.levelId');
        $this->db->join('tripTypes f', 'a.typeId=f.typeId');
        $this->db->where('countryStatus','1');
        $this->db->where('cityStatus','1');
         if($group!='')
        {
            $grp=explode(',',$group);
            for($i=0;$i<count($grp);$i++)
            {
                $this->db->group_by($grp[$i]);
            }
        }
              $query = $this->db->get();
        return $query->result_array();
        
    }
    //****************************************//
    function getOffers()
    {
        $this->db->select('*');
         $this->db->from('offers a');
         
            $this->db->join('countries b', 'a.countryId = b.countryId','left');
         $this->db->join('cities c', 'c.cityId = a.cityId','left');
        $this->db->join('levels d', 'a.levelId = d.levelId','left');
           $this->db->order_by('offerId','DESC');
              $query = $this->db->get();
        return $query->result_array();  
    }
    //*************************************//
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