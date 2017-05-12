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
    $this->db->from('network a ');
       $this->db->join('admins c', 'a.network_admin=c.userId');
      
              $query = $this->db->get();
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
     if($network!=-1 && $table=='network')
        $this->db->where('network_id',$network);
    if($wh!='')$this->db->where($wh,'',false);
    
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 
    //***************************************************//
     function driver_List()
    {$network= $this->session->userdata('network');
        $this->db->select("*,if(b.acc_mode=1,sum(b.acc_value),'0') as debitVal,if(b.acc_mode=0,sum(b.acc_value),'0') as creditVal");
           $this->db->from('drivers a');
          $this->db->join('network c ', 'a.networkId = c.network_id','left');
          $this->db->join('accounts b', 'b.acc_driver = a.driverId','left');
           $this->db->where('driverActivation <>','2');
          if($network!=-1 )
        $this->db->where('networkId',$network);
       $this->db->order_by('driverActivation','ASC'); 
      $this->db->order_by('driverId','DESC');
         $this->db->group_by('driverId');
              $query = $this->db->get();
             
              return $query->result_array();  
    }
    //********************************************//
    function driverList()
    {
        $this->db->select('*');
           $this->db->from('network a ');
        $this->db->join('countries b',' a.network_country=b.countryId');
       $this->db->join('admins c', 'a.network_admin=c.userId');
       
      $this->db->where('countryStatus','1');
         $this->db->order_by('network_id','DESC');
              $query = $this->db->get();
             
              return $query->result_array();  
    }
    //**************************************//
    function driverComment($id='')
    {
         $this->db->select('*');
           $this->db->from('trips ');
        $this->db->join('passengers',' tripPassengerId = passengers.passengerId');
       $this->db->join('countries', 'tripCountryId = countries.countryId','left');
      $this->db->join('cities', 'tripCityId = cities.cityId','left');
        $this->db->where('tripDriverId',$id);
         $this->db->where('tripLeaveComment <>""');
              $query = $this->db->get();
             
              return $query->result_array(); 
    }
    //**********************************************//
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
    //*******************************/
    function getTable($tbl='',$col='',$val='')
    {
           $this->db->select('*');
			    $this->db->from($tbl);
        if($val!='')
				$this->db->where($col,$val);
			   
                $query = $this->db->get();
                return $query->result_array();
    }
    //*****************************//
    function driverBlance($id='')
    { $this->db->select("if(b.acc_mode=1,sum(b.acc_value),'0') as debitVal,if(b.acc_mode=0,sum(b.acc_value),'0') as creditVal");
			    $this->db->from('drivers a');
     $this->db->join('accounts b', 'b.acc_driver = a.driverId');
       
				$this->db->where('a.driverId',$id);
			   
                $query = $this->db->get();
                return $query->result_array();
        
    }
//===========================	   
    

}//end model


?>