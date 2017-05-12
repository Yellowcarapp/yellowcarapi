<?php

class Admin_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
 

    function checkUser($username='',$password='')
		 {
	   //Query the data table for every record and row
  			  $this->db->select('*');
			  $this->db->where('userName',$username);
			  $this->db->where('userPass',md5($password));	
        $this->db->where('userStatus',1);	
     //   $this->db->where('a.network_activeA',1);	
        $this->db->from('admins c');
      $this->db->join('network a', 'a.network_id = c.network and a.network_active=1','left');
			  $query = $this->db->get();
 			  
              return $query->row_array();
 	   }
//==================================================
  function webSettings($userId='')
       {
	           $this->db->select('*');
               $query = $this->db->get('settings');
                return $query->row_array();
  	   }	
// ===============================================
  function getNewDrivers($network='')
  {
         $this->db->select('*');
                $this->db->from('drivers');
       $this->db->where('driverActivation','0');
      if($network!='-1')$this->db->where('networkId',$network);
	   return $this->db->count_all_results();

  } 
 
// ===============================================
  function get_open_orders()
  {
	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');
       
       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));
       
       if($this->session->userdata('emp_type')!=1){

           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }
              //  $this->db->where('ord_kit_id',$kitchen_id);
           // if($child!="")      
               // $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);                                
       }         
       
       $this->db->where('current_status',0);
	   return $this->db->count_all_results();

  } 
// ===============================================
  function get_approved_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));

       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
        
           /*if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);    */                            
       }         

       $this->db->where('current_status',1);
	   return $this->db->count_all_results();

  } 
  
    
  
// ===============================================
  function get_ready_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));

       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
        
          /* if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);   */                             
       }         

       $this->db->where('current_status',2);
	   return $this->db->count_all_results();
  } 

// ===============================================
  function get_readypickup_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));

       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
           /*if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);  */                              
       }         

       $this->db->where('current_status',3);
	   return $this->db->count_all_results();
  } 
    /*****************/
  function get_Levels()
{
    $this->db->select('levelId as id,levelName_'.lang('db').' as name');
    $this->db->from('levels');
   
    $this->db->where('levelStatus','1');
   
      
    $query = $this->db->get();
    return $query->result_array();
}
// ===============================================
  function get_assignedtodriver_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));
  
       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
          /* if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);*/                                
       }         
  
       $this->db->where('current_status',4);
	   return $this->db->count_all_results();
  } 
  
  
  
  
  
// ===============================================
  function get_delivering_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));

       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
        
          /* if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);  */                              
       }         

       $this->db->where('current_status',5);
	   return $this->db->count_all_results();
  } 
  
// ===============================================
  function get_delivered_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));

       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
           /*if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);*/                                
       }         

       $this->db->where('current_status',6);
	   return $this->db->count_all_results();
  } 
  
// ===============================================
  function get_canceled_orders()
  {
   	   $kitchen_id = $this->session->userdata('kitchen_id');
       $child = $this->session->userdata('childs');

       $this->db->from('orders');
       $this->db->where('ord_date',date('Y-m-d'));
       if($this->session->userdata('emp_type')!=1){
           if($kitchen_id!=0){
                $where_str = " ( orders.ord_kit_id = ".$kitchen_id;
                
                if($child!="")
                    $where_str .= " OR orders.ord_kit_id in (".$child.") ) ";
                else           
                    $where_str .= ")";

                $this->db->where($where_str,NULL,FALSE);                        
           }        
          /* if($kitchen_id!=0)
                $this->db->where('ord_kit_id',$kitchen_id);
            if($child!="")      
                $this->db->or_where("orders.ord_kit_id in (".$child.")",null,FALSE);     */                           
       }         

       $this->db->where('current_status',7);
	   return $this->db->count_all_results();
  } 









  
  function get_new_orders()
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',0);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();
    
    
  }
  function get_all_approved_orders()
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',1);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();
    
    
  }
  
  function get_prep_orders()
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',2);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();    
    
  }
  
  function get_all_readypickup_orders()  
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',3);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();    
    
  }
  
  function get_all_assignedtodriver_orders() 
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',4);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();    
    
    
    
  }
  
  function get_all_delivered_orders()
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',5);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();    
    
  }
  
  function get_not_delivered_orders()
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',6);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();    
    
  }  
  function get_all_canceled_orders()
  {
    $kit_id = $this->session->userdata('kitchen_id');
    $this->db->select('orders.*,users.frist_name,users.last_name,kit_title_ar');
    $this->db->from('orders');
    $this->db->join('users','orders.ord_user_id=users.user_id','left');
    $this->db->join('kitchen','orders.ord_kit_id=kitchen.kit_id','left');
    $this->db->where('current_status',7);
    $this->db->where('ord_date',date('Y-m-d'));
    if($kit_id!=""){
        $this->db->where("orders.ord_kit_id",$kit_id);        
        $this->db->or_where("kitchen.kit_parent_id",$kit_id);        
    }
    $this->db->order_by('ord_id','desc');
    $query = $this->db->get();
    return $query->result_array();    
    
  }  
    
  
 // ===============================================
  function get_stats()
  {
	   $this->db->from('realestates');
	   return $this->db->count_all_results();

  } 
  // ==============================================
  function new_added()
  {
	   $this->db->from('realestates');
	   $this->db->where('realestate_active',0);
	   return $this->db->count_all_results();
  }		
  // ===============================================
  function wait_active()
  {
	   $this->db->from('realestates');
	   $this->db->where('realestate_active',1);
	   return $this->db->count_all_results();

  }

  // ===============================================
  function active()
  {
	   $this->db->from('realestates');
	   $this->db->where('realestate_active',2);
	   return $this->db->count_all_results();

  }
  // ===============================================
  function all_requets()
  {
	   $this->db->from('request_product');
	   return $this->db->count_all_results();

  }
  // ===============================================
  function not_delivered_requests()
  {
	   $this->db->from('request_product');
	   $this->db->where('delivered',0);
	   return $this->db->count_all_results();

  }
  // ===============================================
  function delivered_requests()
  {
	   $this->db->from('request_product');
	   $this->db->where('delivered',1);
	   return $this->db->count_all_results();

  }
//===============================================================================
	public function insert_product($data){
    // function insert category    
    $this->db->insert('images', $data);
    }
    //*****************************************/
     function kitchen_data($data){
         
          $this->db->select('*');
			  $this->db->where('kit_id',$data);
			  $query = $this->db->get('kitchen');
 			  
              return $query->row_array();
        
    }
    /**************************************/
    function Count_limit($tbl,$cl,$wh)
    {
           $this->db->from($tbl);
	   $this->db->where($cl,$wh);
	   return $this->db->count_all_results();
    }
    //*****************************/
    function getChilds($kit_id)
    {
          $this->db->select('GROUP_CONCAT(`kit_id`) as childs');
		  $this->db->where('kit_parent_id',$kit_id);
		  $query = $this->db->get('kitchen');
 			  
          return $query->row_array();
        
    }
    //*****************************/
    function getAllBranches($kit_id)
    {
          $this->db->select('*');
		  $this->db->where('kit_parent_id',$kit_id);
          $this->db->join('cities','kit_city_id = city_id','left');
		  $query = $this->db->get('kitchen');
 			  
          return $query->result_array();        
        
    }
    

}//end model


?>