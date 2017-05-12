<?php
class Home_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()

    {
        // Call the Model constructor
        parent::__construct();

     }
//########################################################################
function Details($table='',$column='',$id='')
   {
   
   	          $this->db->select('*');
              $this->db->where($column,$id);
              $query = $this->db->get($table);
              return $query->row_array();
   
   } 
//================
	function ALL($table='',$column='',$id='')
	{
			$this->db->select('*');
			$this->db->from($table);
			if($column && $id){
			$this->db->where($column,$id);
			}
			$query = $this->db->get();
			return $query->result_array();
	}
	
//===============================================================
public function register($data){
$this->db->insert('members', $data);
return $this->db->insert_id();   		
}	
//===============================================================
	public function check_email($data){
   $this->db->select('*');
	$this->db->from('members');
	$this->db->where('email', $data);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
 }
//======================================================================================================    
public function login_name(){
$this->db->where('email',$this->input->post('login_email'));
$query = $this->db->get('members');
if($query->num_rows()==1)
{
return true;
}
else
{
return false;
}
}
//======================================================================================================    
public function login_password(){
$this->db->where('email',$this->input->post('login_email'));
$this->db->where('password',md5($this->input->post('login_password')));	
$query = $this->db->get('members');
if($query->num_rows()==1)
{
return true;
}
else
{
return false;
}
}
//===============================================================
    public function get_user($name,$password){
    $this->db->select('*');	
	$this->db->from('members');
	$this->db->where('email',$name);
	$this->db->where('password',md5($password));
	$query = $this->db->get();
	$result = $query->result();
	return $query->row_array();
}
//========================================================================================

public function get_user_randomv($email){

$this->db->select('*');

$this->db->from('members');

$this->db->where('email', $email); 

$query = $this->db->get();

$result = $query->result();

return $query->row_array();

}
 //================	   

function get_setting()
	    {     
$this->db->select('*');
$this->db->from('settings');
$query = $this->db->get(); 			  
return $query->row_array();
}
//===========================================================================================    

public function check_sending_email($email){

$this->db->where('email',$email);

$query = $this->db->get('members');

if($query->num_rows()==1)

{

return true;

}

else

{

return false;

}

}
//======================================================================================================    
public function check_Useremail($data){
$this->db->select('*');
$this->db->from('members');
$this->db->where('email', $data);
$query = $this->db->get();
$result = $query->result();
return $result;
 }
//##########################page###########################
function List_cats_themes($cat_name='',$limit='')
{
$this->db->select('themes.*,category.title_en as cat_title,authors.title_en as author_name');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');		
$this->db->join('authors', 'authors.id = themes.author');			
if($cat_name) $this->db->where("category.title_en",$cat_name);	
if($limit) $this->db->limit($limit);	
$this->db->order_by('themes.id','desc')	;
$query = $this->db->get();
return $query->result_array();
} 
//===============================================================
public function check_id($id)
{
    $this->db->where('id',$id);
    $query=$this->db->get('members');
    if($query->num_rows()==1)
    {
      return true;
    }
    else
    {
      return false;
    }
}
//======================================================================================================    
public function CheckEmail(){
$this->db->where('email',$this->input->post('email'));
$this->db->where('unique_id',$this->input->post('unique'));
$this->db->where('id',$this->input->post('id_customer'));
$query = $this->db->get('members');
if($query->num_rows()==1)
{
return true;
}
else
{
return false;
}
}

//=========================================================================================
}

?>