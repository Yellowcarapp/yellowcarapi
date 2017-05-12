<?php
class Theme_model extends CI_Model {

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
//##########################page###########################
function GetCode($cat_id='')
{
$this->db->select('*');
$this->db->where("cat_id",$cat_id);
$this->db->order_by("code","desc");	
$query = $this->db->get("themes");
return $query->row_array();
} 
//##########################page###########################
function ListThemes()
{
$this->db->select('themes.*,category.title_en as cat_title');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');
$this->db->order_by('themes.id','desc')	;	
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function ListUserThemes($theme_id='',$user_id='')
{
$this->db->select('themes.*,category.title_en as cat_title');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');
if($theme_id) $this->db->where("themes.id <>",$theme_id);    
if($user_id) $this->db->where("themes.user_id",$user_id);    
$this->db->order_by('themes.id','desc')	;	
$this->db->limit("8");    
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function ListSimilarThemes($theme_id='',$tags='')
{
$this->db->select('*');
$this->db->from('themes');
if($theme_id) $this->db->where("id <>",$theme_id);    
if(!empty($tags)){ $where = "themes_tags IN ($tags)";$this->db->where($where); }     
//if(!empty($tags)) $this->db->where("FIND_IN_SET('$tags',themes_tags) !=", "0");		        
$this->db->where('type','1')	;	
$this->db->order_by('id','desc')	;	
$this->db->limit("4");    
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function ThemesComment($theme_id='')
{
$this->db->select('theme_comment.*,members.*');
$this->db->from('theme_comment');
$this->db->join('members', 'theme_comment.user_id = members.id');
$this->db->where("theme_comment.theme_id",$theme_id);    
$this->db->order_by('theme_comment.id','desc')	;	
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function ThemeDetails($id='')
{
$this->db->select('themes.*,category.title_en as cat_title,authors.title_en as author_title');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id',"LEFT");		
$this->db->join('authors', 'authors.id = themes.author',"LEFT");		
$this->db->where("themes.id",$id);	
$query = $this->db->get();
return $query->row_array();
} 
//##########################page###########################
function ListMoreThemes($cat_name='',$last_id='',$limit='')
{
$this->db->select('themes.*,category.title_en as cat_title,authors.title_en as author_name');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');		
$this->db->join('authors', 'authors.id = themes.author');			
if($cat_name) $this->db->where("category.title_en",$cat_name);	
if($last_id) $this->db->where("themes.id <",$last_id);	
if($limit) $this->db->limit($limit);	
$this->db->order_by('themes.id','desc')	;	
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function Last_theme_id($cat_name='',$last_id='',$limit='')
{
$this->db->select('themes.*');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');		
if($last_id) $this->db->where("themes.id <",$last_id);		
if($cat_name) $this->db->where("category.title_en",$cat_name);	
if($limit) $this->db->limit($limit);		
$this->db->order_by('themes.id','asc')	;	
$query = $this->db->get();
return $query->row_array();
} 
//##########################page###########################
function List_tag_themes($term='',$tag_id='',$limit='')
{
$this->db->select('themes.*,category.title_en as cat_title,authors.title_en as author_name');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');		
$this->db->join('authors', 'authors.id = themes.author');			
//if($tag_id) $this->db->where("themes.title_en",$tag_id);	
//if(!empty($tag_id)){ $where = "themes.themes_tags IN ($tag_id)";$this->db->where($where); }    
//if(!empty($tag_id)) $this->db->where("FIND_IN_SET('$tag_id',themes.themes_tags) !=", "0");		    
if($term){
$this->db->like("themes.title",$term);
$this->db->or_like("authors.title_en",$term);
$this->db->or_like("themes.desc",$term);
$this->db->or_like("themes.breifly",$term);
$this->db->where("FIND_IN_SET('$term',themes.tags_title) !=", "0");
}    
if($limit) $this->db->limit($limit);	
$this->db->order_by('themes.id','desc')	;
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function ListAllThemes($term='',$tag='',$type='',$platform='',$min_price='',$max_price='',$order='',$per_pg='',$offset='')
{
$this->db->select('themes.*,category.title_en as cat_title,authors.title_en as author_name');
$this->db->join('category', 'category.id = themes.cat_id');		
$this->db->join('authors', 'authors.id = themes.author');			
if($term){
$this->db->like("themes.title",$term);
$this->db->or_like("authors.title_en",$term);
$this->db->or_like("themes.desc",$term);
$this->db->or_like("themes.breifly",$term);
$this->db->where("FIND_IN_SET('$term',themes.tags_title) !=", "0");
}    
    
if($tag) $this->db->where("FIND_IN_SET('$tag',tags_title) !=", "0");		        
if($type && $type !="undefined")$this->db->where("themes.type",$type);
if($platform) $this->db->where("FIND_IN_SET('$platform',themes.plateforms) !=", "0");		            
    
    

if($min_price) $this->db->where("theme_only_price >=",$min_price);
    
if($max_price) $this->db->where("theme_only_price <=",$max_price);
    
if($order == "sellers") $this->db->order_by("themes.download_num" , "desc");
elseif($order == "rate") $this->db->order_by("themes.rate" , "desc");
elseif($order == "price-des") $this->db->order_by("themes.theme_only_price" , "desc");
elseif($order == "price-asc") $this->db->order_by("themes.theme_only_price" , "asc");
elseif($order == "newest") $this->db->order_by("themes.id" , "desc");
else $this->db->order_by("themes.id","desc");    
    
$query=$this->db->get('themes',$per_pg,$offset);
return $query->result_array();
} 
// ===============================================
function CountAllThemes($term='',$tag='',$type='',$platform='',$min_price='',$max_price='')
{
$this->db->from("themes");
$this->db->join('authors', 'authors.id = themes.author');			    
if($term){
$this->db->like("themes.title",$term);
$this->db->or_like("authors.title_en",$term);
$this->db->or_like("themes.desc",$term);
$this->db->or_like("themes.breifly",$term);
$this->db->where("FIND_IN_SET('$term',themes.tags_title) !=", "0");
} 
if($tag) $this->db->where("FIND_IN_SET('$tag',themes.tags_title) !=", "0");		        
if($type)$this->db->where("type",$type);
if($platform) $this->db->where("FIND_IN_SET('$platform',themes.plateforms) !=", "0");		            
if($min_price ){
$this->db->where("themes.theme_only_price >=",$min_price);
}    
if($max_price){
$this->db->where("themes.theme_only_price <=",$max_price);
}    
return $this->db->count_all_results();
}

    
//##########################page###########################
function Last_theme_tags($tag_id='',$last_id='',$limit='')
{
$this->db->select('themes.*');
$this->db->from('themes');
$this->db->join('category', 'category.id = themes.cat_id');		
if($last_id) $this->db->where("themes.id <",$last_id);		
//if(!empty($tag_id)){ $where = "themes.themes_tags IN ($tag_id)";$this->db->where($where); }    
if(!empty($tag_id)) $this->db->where("FIND_IN_SET('$tag_id',themes.themes_tags) !=", "0");		        
if($limit) $this->db->limit($limit);		
$this->db->order_by('themes.id','asc')	;	
$query = $this->db->get();
return $query->row_array();
} 
//##########################page###########################
function ListTable($table='',$column='',$id='')
   {
   
   	          $this->db->select('*');
              if($column && $id) $this->db->where($column,$id);
              $query = $this->db->get($table);
              return $query->result_array();
   
   } 
//##########################page###########################
function ChangeCartItem($theme_id='')
{
$this->db->select('*');
$this->db->where("id",$theme_id);
$query = $this->db->get("themes");
return $query->row_array();
} 
//================
function TotalCartPrice($user_id='')
{
$this->db->select('sum(price) as total');
$this->db->from('cart');
$this->db->where('user_id',$user_id);
$query = $this->db->get();
return $query->row_array();
}
//##########################page###########################
function ListCartThemes($user_id='')
{
$this->db->select('themes.*,cart.id as cart_id,cart.payment_date as payment_date,cart.price as price,cart.theme_id,cart.type as cart_type');
$this->db->from('cart');
$this->db->join('themes', 'themes.id = cart.theme_id');			
if($user_id) $this->db->where("cart.user_id",$user_id);	
$this->db->where("cart.pay","0");	
$this->db->order_by('cart.id','desc')	;	
$query = $this->db->get();
return $query->result_array();
} 
//##########################page###########################
function ListDownloadhemes($user_id='')
{
$this->db->select('themes.*,cart.id as cart_id,category.title_en as cat_title,cart.payment_date as payment_date,cart.price as price,cart.theme_id,cart.type as cart_type,rate_theme.rate as theme_rate');
$this->db->from('cart');
$this->db->join('themes', 'themes.id = cart.theme_id');			
$this->db->join('category', 'category.id = themes.cat_id');			
$this->db->join('rate_theme', 'rate_theme.theme_id = cart.theme_id',"LEFT");			
if($user_id) $this->db->where("cart.user_id",$user_id);	
$this->db->where("cart.pay","1");	
$this->db->where("cart.invoice <>"," ");	
$this->db->order_by('cart.id','desc')	;	
$query = $this->db->get();
return $query->result_array();
} 
//================
function TotalReviews($theme_id='')
{
$this->db->select('count(reviews) as total');
$this->db->from('themes');
$this->db->where('id',$theme_id);
$query = $this->db->get();
return $query->row_array();
}
// ===============================================
function CountAll($table="" , $column ="" , $value = "", $column1 ="" , $value1 = "")
{
$this->db->from($table);
if($column && $value) $this->db->where($column,$value);	
if($column1 && $value1) $this->db->where($column1,$value1);	
return $this->db->count_all_results();
}
//########################################################################
function GetThemeRate($column='',$value='')
{
$this->db->select('sum(rate) as total , count(*) as count');
$this->db->from('rate_theme');
if($column && $value) $this->db->where($column,$value);
$query = $this->db->get();
return $query->row_array();
} 

//===========================	   
 
}//end model


?>