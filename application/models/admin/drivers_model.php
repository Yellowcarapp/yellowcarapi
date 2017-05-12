<?php

class Drivers_model extends CI_Model {

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
              $this->db->where('network_id',$id);
              $query = $this->db->get('network  a INNER JOIN admins as c On a.network_admin=c.userId');
              return $query->row_array();
   
   } 
//##########################page###########################
function tblLIst($table='',$column='',$id='',$wh='')
   {
  $network= $this->session->userdata('network');
   	          $this->db->select('*');
            if($column!='')
              $this->db->where($column,$id);
    if($network!=-1 && $table=='drivers')
        $this->db->where('networkId',$network);
    if($wh!='')$this->db->where($wh,'',false);
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 
 function members()
   {
              $this->db->select('*');
              $query = $this->db->get('users');
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
        $network= $this->session->userdata('network');
          $this->db->select('driverId as id,CONCAT(driverFName," ",driverLName," ( ",driverMobile," ) ") as name,drivercode as code',FALSE);
			    $this->db->from('drivers');
        $wh='';
         if($network!=-1){
      //  $this->db->where('networkId',$network);
             $wh.=' networkId ='.$network;
         }
        if($wh!='') $wh.=' AND ';
        $wh.="(driverFName LIKE '%".$q."%' OR  driverLName LIKE '%".$q."%' OR drivercode LIKE '%".$q."%' OR driverMobile LIKE '%".$q."%' OR carNumber LIKE '%".$q."%')";
        $this->db->where($wh,'',FALSE);
				/*$this->db->like('driverFName',$q);
                $this->db->or_like('driverLName',$q);
                $this->db->or_like('drivercode',$q);
        $this->db->or_like('driverMobile',$q);
        $this->db->or_like('carNumber',$q);*/
        
              $query = $this->db->get();
              return $query->result_array(); 
    }
//===========================	   
    

}//end model


?>