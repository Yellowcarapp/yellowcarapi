<?php

class Finnance_model extends CI_Model {

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
              $this->db->where('acc_id',$id);
      $this->db->from('accounts');
        $this->db->join('drivers',' driverId=acc_driver');
              $query = $this->db->get();
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
 //*****************************************//
    function financeList()
    {
         $this->db->select('*');
           $this->db->from('accounts');
        $this->db->join('drivers',' driverId=acc_driver');
       
      
              $query = $this->db->get();
             
              return $query->result_array();
    }
    //***************************//
    function balance_detail($id='')
    {
       $this->db->select('*');
           $this->db->from('accounts');
        $this->db->join('drivers',' driverId=acc_driver');
       $this->db->where('acc_driver',$id);
      
              $query = $this->db->get();
             
              return $query->result_array();  
    }
//***********************************************//
    function getBalance($id='',$mode='0')
    {
         $this->db->select('*,sum(acc_value) AS debitVal');
              $this->db->where('acc_driver',$id);
          $this->db->where('acc_mode',$mode);
              $query = $this->db->get('accounts ');
              return $query->row_array();
    }
    //****************************************//
        function listAccount($tbl='')
         {$network= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
   	          $this->db->select("*,CONVERT_TZ(acc_date,'+00:00','".$TimeZone."') as accDate",false);
             if($network!=-1 )
        $this->db->where('networkId',$network);
          $this->db->order_by('acc_date','DESC');
              $query = $this->db->get($tbl);
              return $query->result_array();
   
   } 
     //****************************************//
        function listAccount_1()
         {$network= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
   	          $this->db->select("*,CONVERT_TZ(acc_date,'+00:00','".$TimeZone."') as accDate",false);
             if($network!=-1 )
        $this->db->where('networkId',$network);
          $this->db->order_by('acc_date','DESC');
            $this->db->from('accounts');
        $this->db->join('drivers',' driverId=acc_driver');
          $this->db->join('acc_coment a','accounts.acc_com_id=a.acc_com_id ','Left');
              $query = $this->db->get();
              return $query->result_array();
   
   } 
//===========================	   
    

}//end model


?>