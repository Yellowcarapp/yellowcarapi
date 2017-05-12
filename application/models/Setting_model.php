<?php
class Setting_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()

    {
        // Call the Model constructor
        parent::__construct();

     }

 //================	   

function GeneralSetting($uriLang='en')
	    {     
		    // $this->db->select('title_'.lang('db').' as SiteTitle,description_'.lang('db').' as SiteDescription,keyword_'.lang('db').' as  SiteMeta,phone,fax,hr_email,mob,email,google_analytic,manual_activate_text_'.lang('db').' as  manual_activate_text,contacts_'.lang('db').' as contacts,address_'.lang('db').' as address,ElectronicLibraryLink,programs_sh_'.lang('db').' as Vision,research_sh_'.lang('db').' as research_sh,title_en,title_ar,facebook,twiter,youtube,youtube_user,rss');
		       $this->db->select('*');
		      $this->db->from('settings');
		      $query = $this->db->get(); 			  
              return $query->row_array();
		}
//=================
 function home_settings()
 {
  	            $this->db->select('*');
				$this->db->from('home_settings');
			 
				//$this->db->order_by('user_id','DESC');
				 
                $query = $this->db->get();
                return $query->row_array();

 }

//=================
 function about_us()
 {
  	            $this->db->select('*');
				$this->db->from('about_pages');
			 
				//$this->db->order_by('user_id','DESC');
				 
                $query = $this->db->get();
                return $query->row_array();

 }
//=================
 function seo($id='')
 {
  	            $this->db->select('*');
				$this->db->from('seo');
			 	$this->db->where("id",$id);
				//$this->db->order_by('user_id','DESC');
				 
                $query = $this->db->get();
                return $query->row_array();

 }

// ===================
 function get_advs()
 {
		/*$this->db->select('*');
		$this->db->where('home_sett_id',1);
		$this->db->from('home_settings');

		 $this->db->where('advs_start_date <=',time());
		 $this->db->where('advs_end_date >=',time());

		//$this->db->order_by('user_id','DESC');
		 
		$query = $this->db->get();
		return $query->row_array();*/
 }	
//====================
function social()
    { 
                $this->db->select('id,title_'.lang('lang').' as title,image,link,type');
				$this->db->where('active','1');
                 $query = $this->db->get('social');
                return $query->result_array();
    }	
//==============
function get_about_links()
{
		$this->db->select('*');
		$this->db->order_by('page_id','asc');
		$query = $this->db->get('about_pages');
		return $query->result_array();
}
//==============
function get_categories($type="",$limit='')
{
		/*$this->db->select('*');
		$this->db->order_by('id','desc');
		if($limit) $this->db->limit($limit);
		if($type) $this->db->where("type",$type);
		$query = $this->db->get('category');
		return $query->result_array();*/
}
//==============
function get_plugins($limit='')
{
		$this->db->select('*');
		$this->db->order_by('id','desc');
		if($limit) $this->db->limit($limit);
		$query = $this->db->get('plugins');
		return $query->result_array();
}
//==============
function get_themes($cat_id='',$limit='')
{
/*$this->db->select('themes.*,authors.title_en as author_name,category.title_en as cat_title');
$this->db->from('themes');
$this->db->join('authors', 'authors.id = themes.author');		
$this->db->join('category', 'category.id = themes.cat_id');			
if($cat_id) $this->db->where("themes.cat_id",$cat_id);	
if($limit) $this->db->limit($limit);	
$query = $this->db->get();
return $query->result_array();
}
//==============
function view_themes($column='',$limit='',$type='')
{
$this->db->select('themes.*,authors.title_en as author_name,category.title_en as cat_title');
$this->db->from('themes');
$this->db->join('authors', 'authors.id = themes.author');		
$this->db->join('category', 'category.id = themes.cat_id');			
if($type) $this->db->where("themes.type",$type);    
if($limit) $this->db->limit($limit);	
if($column) $this->db->order_by($column,"desc") ;   
$query = $this->db->get();
return $query->result_array();*/
}
//==============
function get_additional($cat_id='',$limit='')
{
$this->db->select('*');
$this->db->from('additional');
if($cat_id) $this->db->where("cat_id",$cat_id);	
if($limit) $this->db->limit($limit);	
$query = $this->db->get();
return $query->result_array();
}
//==============
function get_countries($cat_id='',$limit='')
{
/*$this->db->select('*');
$this->db->from('country');
if($cat_id) $this->db->where("cat_id",$cat_id);	
if($limit) $this->db->limit($limit);	
$query = $this->db->get();
return $query->result_array();*/
}
// ===============================================
function CountCart($user_id ="")
{
$this->db->from("cart");
$this->db->where("user_id",$user_id);	
$this->db->where("pay","0");	
return $this->db->count_all_results();
}
//==============
function get_themes_tags()
{
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$this->db->where('active','1');
		$query = $this->db->get('themes_tags');
		return $query->result_array();
}
//==============
function get_platforms()
{
		$this->db->select('*');
        $this->db->where('active','1');
		$this->db->order_by('id','desc');
		$query = $this->db->get('plateform');
		return $query->result_array();
}
// ===============================================
function CountALL($table='',$column='',$id='')
{
$this->db->from($table);
if($column && $id) $this->db->where($column,$id);	
return $this->db->count_all_results();
}
// ===============================================
}

?>