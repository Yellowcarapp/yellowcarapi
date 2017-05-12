<?php
class Pages_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()

    {
        // Call the Model constructor
        parent::__construct();

     }
	 
	 function contact_us()
	 {
	 	$query = $this->db->where('id',1)->get('settings');
	 	return $query->row_array();
	 }

	 function about_us($id=1,$table='pages')
	 {
	 	
	 	$query = $this->db->where('page_id',$id)->get($table);
	 	return $query->row_array();
	 }		
	 
	 function our_works()
	 {
	 	$query = $this->db->where('active',1)->get('news');
	 	return $query->result_array();
	 }
	 
	 function videos()
	 {
	 
	 }
//================
}

?>