<?php

class Slider_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
 
//##########################page###########################
function slider_list()
{
		  $this->db->select('*');
		 // $this->db->where('home_sett_id',1);
		  $query = $this->db->get('slider');
		  return $query->result_array();

}
//##########################page###########################
function getData($id='')
{
		  $this->db->select('*');
		  $this->db->where('id',$id);
		  $query = $this->db->get('slider');
		  return $query->row_array();

}
 
}//end model


?>