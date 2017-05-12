<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
		
	var $template_data = array();

	function set($name, $value)
			{
				$this->template_data[$name] = $value;
			}

//=========	
function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
	 $this->CI->load->model('Setting_model','setting_model'); 
           $view_data['websitesetting']=$this->CI->setting_model->GeneralSetting();
			
            $view_data['TimeZoneArr']=$this->setTimeZoneArr();
 			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			

			return $this->CI->load->view($template, $this->template_data, $return);
		}
    //**********************
    function setTimeZoneArr()
    {
         $timeZonearr=[];
        $timeZonearr[0]['id']='-12:00';
         $timeZonearr[0]['val']='(UTC -12:00)';
        
          $timeZonearr[1]['id']='-11:00';
         $timeZonearr[1]['val']='(UTC -11:00)';
        
        $timeZonearr[2]['id']='-10:00';
         $timeZonearr[2]['val']='(UTC -10:00)';
        
        $timeZonearr[3]['id']='-9:00';
         $timeZonearr[3]['val']='(UTC -09:00)';
        
        $timeZonearr[4]['id']='-08:00';
         $timeZonearr[4]['val']='(UTC -08:00)';
        
        $timeZonearr[5]['id']='-07:00';
         $timeZonearr[5]['val']='(UTC -07:00)';
        
        $timeZonearr[6]['id']='-06:00';
         $timeZonearr[6]['val']='(UTC -06:00)';
        
        $timeZonearr[7]['id']='-05:00';
         $timeZonearr[7]['val']='(UTC -05:00)';
        
        $timeZonearr[8]['id']='-04:30';
         $timeZonearr[8]['val']='(UTC -04:30)';
        
        $timeZonearr[9]['id']='-04:00';
         $timeZonearr[9]['val']='(UTC -04:00)';
        
        $timeZonearr[10]['id']='-03:30';
         $timeZonearr[10]['val']='(UTC -03:30)';
        
        $timeZonearr[11]['id']='-03:00';
         $timeZonearr[11]['val']='(UTC -03:00)';
        
        $timeZonearr[12]['id']='-02:00';
         $timeZonearr[12]['val']='(UTC -02:00)';
        
        $timeZonearr[13]['id']='-01:00';
         $timeZonearr[13]['val']='(UTC -01:00)';
        
        $timeZonearr[14]['id']='+00:00';
         $timeZonearr[14]['val']='(UTC +00:00)';
        
        $timeZonearr[15]['id']='+01:00';
         $timeZonearr[15]['val']='(UTC +01:00)';
        
        $timeZonearr[16]['id']='+02:00';
         $timeZonearr[16]['val']='(UTC +02:00)';
        
        $timeZonearr[17]['id']='+03:00';
         $timeZonearr[17]['val']='(UTC +03:00)';
        
        $timeZonearr[18]['id']='+03:30';
         $timeZonearr[18]['val']='(UTC +03:30)';
        
        $timeZonearr[19]['id']='+04:00';
         $timeZonearr[19]['val']='(UTC +04:00)';
        
        $timeZonearr[20]['id']='+04:30';
         $timeZonearr[20]['val']='(UTC +04:30)';
        
        $timeZonearr[21]['id']='+05:00';
         $timeZonearr[21]['val']='(UTC +05:00)';
        
        $timeZonearr[22]['id']='+05:30';
         $timeZonearr[22]['val']='(UTC +05:30)';
        
        $timeZonearr[23]['id']='+05:45';
         $timeZonearr[23]['val']='(UTC +05:45)';
        
         $timeZonearr[24]['id']='+06:00';
         $timeZonearr[24]['val']='(UTC +06:00)';
        
         $timeZonearr[25]['id']='+06:30';
         $timeZonearr[25]['val']='(UTC +06:30)';
        
         $timeZonearr[26]['id']='+07:00';
         $timeZonearr[26]['val']='(UTC +07:00)';
        
         $timeZonearr[27]['id']='+08:00';
         $timeZonearr[27]['val']='(UTC +08:00)';
        
         $timeZonearr[28]['id']='+08:30';
         $timeZonearr[28]['val']='(UTC +08:30)';
        
         $timeZonearr[29]['id']='+09:00';
         $timeZonearr[29]['val']='(UTC +09:00)';
        
         $timeZonearr[30]['id']='+09:30';
         $timeZonearr[30]['val']='(UTC +09:30)';
        
         $timeZonearr[31]['id']='+10:00';
         $timeZonearr[31]['val']='(UTC +10:00)';
        
         $timeZonearr[32]['id']='+11:00';
         $timeZonearr[32]['val']='(UTC +11:00)';
        
         $timeZonearr[33]['id']='+12:00';
         $timeZonearr[33]['val']='(UTC +12:00)';
        
         $timeZonearr[34]['id']='+13:00';
         $timeZonearr[34]['val']='(UTC +13:00)';
        
          $timeZonearr[35]['id']='+14:00';
         $timeZonearr[35]['val']='(UTC +14:00)';
        return $timeZonearr;
    }
//=========	
function getSubMenu($menuArrSub,$mid,$count=0,$PagesArr='',$subsub='1')
        {
		 $retcount=0;
		 $subCount=0;
		 foreach($menuArrSub as $subMenuArr) 
			  { 
			    if($count==1)
				 {
				         if($subMenuArr['parrent_id']==$mid)
							 {
							  $retcount=1;
							 }
						 
				 } else {
						  if($subMenuArr['parrent_id']==$mid)
							 {
							   $subCount=$this->getSubMenu($menuArrSub,$subMenuArr['id'],'1',$PagesArr,$subsub);
							    
								if($subCount==1)
								  {
								  
								    echo "<li  class='withsub' ><a href='".site_url($subMenuArr['link'])."'>".$subMenuArr['title']."</a>"; 
									if($subsub==1)
									  {
 									     echo "<ul>";
									        foreach($menuArrSub as $subSubMenuArr)
											       {
												    if($subSubMenuArr['parrent_id']==$subMenuArr['id'])
														  {
									                       echo "<li><a href='".site_url($subSubMenuArr['link'])."'>".$subSubMenuArr['title']."</a>"; 
														     $withsub=$this->getSubMenu($menuArrSub,$subSubMenuArr['id'],'1',$PagesArr,$subsub);  
															  if($withsub>0) 
															     { 
															      echo "<ul>";
																  $this->getSubMenu($menuArrSub,$subSubMenuArr['id'],'0',$PagesArr,$subsub);
																  echo "</ul>";
															  
															     }
														   echo "</li>";
												          }
												   }
									  
									     echo "</ul>";
									  }
								    echo "</li>";
								  
								  } else {
							     
								    echo "<li><a href='".site_url($subMenuArr['link'])."'>".$subMenuArr['title']."</a>"; 
									  $subpcount=$this->getSubPage($PagesArr,$subMenuArr['id'],1,$PagesArr,$subsub);  
									  if($subMenuArr['type']==2 && $subpcount>0)
									      {
									        echo "<ul>"; 
											echo $this->getSubPage($PagesArr,$subMenuArr['id'],0,$PagesArr,$subsub);
 										    echo "</ul>";
										  }	
									echo "</li>";
							   
							     }
							 }
				 }  
			  }
			  
			  if($count==1)
				  {
			      return $retcount;
			      }
			  $menuArrSub='';  $subMenuArr=''; 
			 
		}		

//=========$this->template->addMenuLink('insert','2',$type_id,$main_cat,$position,$title_ar,$title_en,$link);
function addMenuLink($case='',$type='',$type_id='',$main_cat='1',$parrent_id='',$title_ar='',$title_en='',$link='',$active='1',$title_fr='')
        {
		  $this->CI =& get_instance();
		  if($case=='insert' || $case=='update')
		    {
			   
			   $this->CI->db->where('type_id',$type_id);
			   $this->CI->db->where('type',$type);
			   $query = $this->CI->db->get('menu');
               $numrows = $query->num_rows();
			   
			if($numrows>0)
			  {
			//===update
			    $data =  array('title_en' => $title_en 
						   ,  'title_ar' => $title_ar 
						   ,  'title_fr' => $title_fr
 						   ,  'parrent_id' => $parrent_id 
 						   ,  'main_cat' => $main_cat 
						   ,  'link' => $link 
						   ,  'type' => $type 
						   ,  'type_id' => $type_id 
						   ,  'active' =>$active
						   , 'menu_date'=>date('Y-m-d')
						   ); 
				 $this->CI->db->where('type_id',$type_id);
				 $this->CI->db->where('type',$type);
				 $this->CI->db->update('menu', $data);	
			 } else {	 
			//===insert
			  $data =  array('title_en' => $title_en 
						   ,  'title_ar' => $title_ar 
						   ,  'title_fr' => $title_fr
  						   ,  'parrent_id' => $parrent_id 
 						   ,  'main_cat' => $main_cat 
						   ,  'link' => $link 
						   ,  'type' => $type 
						   ,  'type_id' => $type_id 
						   ,  'active' =>$active
						   , 'menu_date'=>date('Y-m-d')
						   
						   ); 
				 $this->CI->db->insert('menu', $data);	
			 }
				 	   
			}
		  
		   
			if($case=='delete')
				{
				   	 $this->CI->db->where('type_id',$type_id);
				     $this->CI->db->where('type',$type);
				     $this->CI->db->delete('menu');
				}
		  
		  	
		}

//=========
function getLatestProjects($catid='0',$tab='tab1')
        {
		 $data['LatestProjectsFooter']=$this->CI->setting_model->LatestProjects('3',$catid);
		 $data['LatestProjectsFooterCount']=$this->CI->setting_model->LatestProjects('0',$catid);
		 $data['catid']=$catid;
		 $data['tab']=$tab;
		 $data['numberOfPages']=ceil(count($data['LatestProjectsFooterCount'])/3); 
		// echo count($data['LatestProjectsFooter']); exit;
	     $this->CI->load->view('common/latest_projects_fotter',$data,FALSE);
		}		
//=========	
function getSubPage($pageArrSub,$pid,$count=0)
        {
		 $retcount=0;
		 foreach($pageArrSub as $subPageArr) 
			  { 
			    if($count==1)
				 {
				         if($subPageArr['parrent_id']==$pid)
							 {
							  $retcount=1;
							 }
						 
				 } else {
						  if($subPageArr['parrent_id']==$pid)
							 {
							  echo "<li><a href='".site_url('pages/details/'.$subPageArr['id'].'/'.url_title($subPageArr['title']))."'>".$subPageArr['title']."</a></li>";
							 }
				 }  
			  }
			  
			  if($count==1)
				  {
			      return $retcount;
			      }
			  $pageArrSub='';  $subPageArr=''; 
			 
		}	
//=========	
function getStaffLink($staffArr,$cid)
        {
		 
		 foreach($staffArr as $substaffArrArr) 
			  { 
			      if($substaffArrArr['cat_id']==$cid)
				     {
			 		  echo "<li><a href='".site_url('staff/profile/'.$substaffArrArr['id'].'/'.url_title($substaffArrArr['title']))."'>".$substaffArrArr['title']."</a></li>";
			         }
				  
			  }
			  
			  $substaffArrArr='';  $subsubstaffArrArr=''; 
			 
		}		
// ######## admin ########
function latestAdd()
       {
	   
	            $this->CI->db->select('*');
			    $this->CI->db->order_by('id','desc');
				 $this->CI->db->limit('2');
                $query = $this->CI->db->get('pages');
                $data['Lates_p']= $query->row_array();
				
			    $this->CI->db->select('*');
			    $this->CI->db->order_by('id','desc');
				 $this->CI->db->limit('2');
                $query = $this->CI->db->get('projects');
                $data['Lates_projects']= $query->row_array();
				
				$this->CI->db->select('*');
			    $this->CI->db->order_by('id','desc');
				 $this->CI->db->limit('2');
                $query = $this->CI->db->get('news');
                $data['Lates_N']= $query->row_array();
				 
			   
			   
	   
	   $this->CI->load->view('admin/main/latest_add_temp',$data); 
	   }

function GetCount($table,$where='')
        {
		       $this->CI->db->select('*');
			   if($where)  $this->CI->db->where('cat_id',$where); 
               $query = $this->CI->db->get($table);
               return $query->num_rows();
		
		}
//==== getActivity to get  Online User 
  function getActivity()
     {
	  $data['x']='1';
	  $this->CI->load->view('admin/activity_temp',$data); 
	 }
//=======	 
  
//==== getActivity to get  Online User 
  function getNumOFNewMessage()
     {
 
	          $this->CI->db->select('*');
		 
			  $this->CI->db->where('isread','0');
			  
              $query = $this->CI->db->get('feedback');
 			  
              echo $query->num_rows();
	   
	 }	 
//##############visitor
//====================
  function add_visitor() 
    { 
	  $this->CI =& get_instance();
	  //$this->CI->setting_model->visitor($this->CI->input->ip_address()); // add visitor ip
	  $ip=$this->CI->input->ip_address();
	  
	
	  
	  if($ip)
		   {
		        $record = array('v_ip'=>$ip, 
				                'v_year'=>date('Y'), 
								'v_month'=>date('m'));
			   
			   $query = $this->CI->db->get_where('visitor_count', array('v_ip'=>$ip,'v_year'=>date('Y'),'v_month'=>date('m')));
				
				if ($query->num_rows() == 0) {
				  // A record does not exist, insert one.
				  $query = $this->CI->db->insert('visitor_count', $record);
				} else {
				  // A record does exist, update it.
 				 $this->CI->db->query("update visitor_count set v_count=(v_count+1) where v_ip='$ip'");
				}
		   
		   }
	
	}
 //======
  function visitor_month_year($month='') 
    {
	 $this->CI =& get_instance();
	 $query = $this->CI->db->get_where('visitor_count', array('v_year'=>date('Y'),'v_month'=>$month));
	 return $query->num_rows();
	}		 
//=========	
function onlineUsers()
    {
	 	$ip=$this->CI->input->ip_address();
		
		$timeoutseconds = 120;
		//this is where PHP gets the time
		$timestamp = time();
		$timeout = $timestamp-$timeoutseconds;
		
		//insert the values
 		 $this->CI->db->query("INSERT INTO useronline VALUES ('$timestamp','$ip','') ");
		 $this->CI->db->query("DELETE FROM useronline WHERE timestamp<$timeout");
		 
	}
//=====
function OnlineUser()
    {
	           $this->CI->db->select('*');
			   $this->CI->db->group_by('ip');
               $query = $this->CI->db->get('useronline');
               return $query->num_rows();
	}
//###############POLL		
 
  // Set timezone
 
 
  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
   date_default_timezone_set("UTC");
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }  
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }
 	
//===========
}



/* End of file Template.php */

/* Location: ./system/application/libraries/Template.php */