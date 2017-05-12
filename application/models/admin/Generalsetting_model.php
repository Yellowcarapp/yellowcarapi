<?php
class Generalsetting_model extends CI_Model {

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
function All($table='',$orderFileld='',$id_field='',$id='',$wh='')
   {
   
   	          $this->db->select('*');
			  if($id!='')
	              $this->db->where($id_field,$id);	
if($wh!='')$this->db->where($wh);
              /*if($table=='countries' || $table=='cities')    
                  $this->db->where('id <>',-1);    			  
              */    		  
	          if($orderFileld) $this->db->order_by($orderFileld,"desc") ;       
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 
    //**********************************************/
    function All_list($table='',$id_field='',$id='',$col='',$val='')
   {
   
   	          $this->db->select('*');
			  if($id!='')
	              $this->db->where($id_field,$id);	
if($val!='')$this->db->where($col,$val);
              /*if($table=='countries' || $table=='cities')    
                  $this->db->where('id <>',-1);    			  
              */    		  
	          //if($id_field) $this->db->order_by($id_field,"desc") ;       
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 


 
   //----------
  function page_list($table,$whereFeild=0,$whereValue=0)
   {
   	if($table=='members')
	  {
              $this->db->select('name,user_id as id');
	  } else {
	  	      $this->db->select('*');
	  }	
				if($whereFeild && $whereValue)
				 {
				 	 $this->db->where($whereFeild,$whereValue);
				 }
				$this->db->from($table.' as tbl');
              $query = $this->db->get();
              return $query->result_array();
   }
 
    //--------

   //--------
   function ListCities($column ='',$id='')
   {
                $this->db->select('cities.*,countries.*');
			    $this->db->from('cities');
			    $this->db->join('countries','cities.countryId=countries.countryId and countryStatus=1','left');
                if($id && $column) $this->db->where($column,$id);
       $this->db->order_by('cityId','DESC');
				$query = $this->db->get();
                return $query->result_array();
   }
   //--------
function AllDistricts($column='',$id='')
{
$this->db->select('places.*,cities.*,countries.*');
$this->db->from('places');

$this->db->join('cities','places.cityId=cities.cityId','left');
    $this->db->join('countries','cities.countryId=countries.countryId and countryStatus=1','left');
if($id && $column) $this->db->where($column,$id);    
$query = $this->db->get();
return $query->result_array();
}

// ------------
   function get_network()
   {
		$cntry_id = $this->uri->segment(3);   
		$this->db->select('*');
		$this->db->from('network');
       if($cntry_id !='-1')
		$this->db->where("network_country",$cntry_id);
		$query = $this->db->get();
		return $query->result_array();
   }	  
// ------------
   function get_cities()
   {
		$cntry_id = $this->uri->segment(3);   
		$this->db->select('*');
		$this->db->from('cities');
       if($cntry_id !='-1')
		$this->db->where("countryId",$cntry_id);
		$query = $this->db->get();
		return $query->result_array();
   }	 
    //*************************/
     function get_currencies()
   {
		$cntry_id = $this->uri->segment(3);   
		$this->db->select('*');
		$this->db->from('currency ');
         $this->db->join('countries','countryCurrency=curr_id','inner');
		$this->db->where("countryId",$cntry_id);
		//$this->db->where("cities.city_active",1);
		$query = $this->db->get();
		return $query->result_array();
   }	
    //************************************************//
     function get_Models()
   {
		
		$this->db->select('*');
		$this->db->from('models a');
         $this->db->join('brands b','a.brandId=b.brandId','inner');
		
		$query = $this->db->get();
		return $query->result_array();
   }	 

// ------------
   function get_districts()
   {
		$city_id = $this->uri->segment(3);   
		$this->db->select('*');
		$this->db->from('area');
		$this->db->where("area_city_id",$city_id);
		//$this->db->where("area.area_active",1);
		$query = $this->db->get();
		return $query->result_array();
   }	 
 
//===========================
   function query($qryCheck)
   {
        switch($qryCheck)
        {
            case 'other_countries': 
                $qryStr = "SELECT realestate_id as id , realestate_cntry_other as cntry_other,1 as type FROM realestates WHERE Not ISNULL(realestate_cntry_other) AND realestate_cntry_other <> '' UNION SELECT realrequest_id as id ,realrequest_cntry_other as cntry_other , 2 as type FROM realrequests WHERE Not ISNULL(realrequest_cntry_other) AND realrequest_cntry_other <> '' UNION SELECT allarm_id as id, allarm_country_other as cntry_other,3 as type from allarm WHERE NOT ISNULL(allarm_country_other) AND allarm_country_other <> ''";
            break;
        }
    
    
    
        $query = $this->db->query($qryStr);
 		return $query->result_array();
   }  	   
 
}//end model


?>