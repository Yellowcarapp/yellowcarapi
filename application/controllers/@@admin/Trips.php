<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Trips extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/trips_model','users');		
	}
//######################	
function pricingForm()
	  {
	
	  $id=$this->uri->segment(4);//$this->session->userdata('id');//$this->uri->segment(4);
	   if($this->session->userdata('id'))
			   {
				   $data['countries']=$countries = $this->users->tblLIst('countries');
             $data['cities'] = $this->users->tblLIst('cities','countryId',$countries[0]['countryId']);
            $data['package'] = $this->users->tblLIst('packages','packageStatus','1');
            $data['levels'] = $this->users->tblLIst('levels','levelStatus','1');
            $data['tripTypes'] = $this->users->tblLIst('tripTypes','typeStatus','1');
				  if($id && $id!='saved') 
					   {    
							$data['page'] =$page= $this->users->Details($id);
                       $data['info'] = $this->users->getPeicingData($page['packageId'],$page['countryId'],$page['cityId']);
                       $data['cities'] = $this->users->tblLIst('cities','countryId',$page['countryId']);
							$data['pageTitle']=lang('edit_pricing');
					   } else {
	 						$data['pageTitle']=lang('Add_pricing');
					   }
				  
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 }
				    
				  $this->template->load('admin/Container', 'admin/trips/form',$data); 
		       
			   } else {
			   
			   redirect(site_url('').'/admin/Admin');
			   
			   }
	  
	  }	
   
//===========#######################members######################=====================
   function SavePricing()
    {
       $pageid=$this->input->post('pageid', TRUE); 
	 $packageId=$this->input->post('packageId', TRUE);
	 $countryId=$this->input->post('countryId', TRUE);
//
	  $cityId=$this->input->post('cityId', TRUE);
        $typeId=$this->input->post('typeId', TRUE);
	
 
        
    /*   
	 $nowStart=$this->input->post('nowStart', TRUE);
//
	  $minNow=$this->input->post('minNow', TRUE);
	 $laterStart=$this->input->post('laterStart', TRUE);
        
         $minLater=$this->input->post('minLater', TRUE);
	 $perKm=$this->input->post('perKm', TRUE);
       
	  $perMinute=$this->input->post('perMinute', TRUE);
	 $WaitingperHour=$this->input->post('WaitingperHour', TRUE);*/
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			
             if($pageid) //update
						    {
                   $this->db->where('packageId', $packageId);
                 $this->db->where('countryId', $countryId);
                 $this->db->where('cityId', $cityId);
						   $this->db->delete('prices'); 
          /*        $nowStart=$this->input->post('nowStart', TRUE);
//
	  $minNow=$this->input->post('minNow', TRUE);
	 $laterStart=$this->input->post('laterStart', TRUE);
        
         $minLater=$this->input->post('minLater', TRUE);
	 $perKm=$this->input->post('perKm', TRUE);
       
	  $perMinute=$this->input->post('perMinute', TRUE);
	 $WaitingperHour=$this->input->post('WaitingperHour', TRUE);
                 $data =  array('packageId' => $packageId
						   ,  'countryId' => $countryId 
						 ,  'cityId' => $cityId
                          
						 ,  'nowStart' => $nowStart
                            ,  'minNow' => $minNow    
                             , 'laterStart' => $laterStart
						 ,  'minLater' => $minLater
                            ,  'perKm' => $perKm
                                         ,  'perMinute' => $perMinute
                            ,  'WaitingperHour' => $WaitingperHour
						   ); 
                        $this->db->where('priceId',$pageid);
						     $this->db->update('prices', $data);*/
             }/*else{*/
            for($i=0;$i<count($typeId);$i++)
            {   $levelId=$this->input->post('levelId_'.$i, TRUE);
               // print_r($levelId);
                $nowStart=$this->input->post('nowStart_'.$i, TRUE);
//
                $minNow=$this->input->post('minNow_'.$i, TRUE);
                $laterStart=$this->input->post('laterStart_'.$i, TRUE);

                $minLater=$this->input->post('minLater_'.$i, TRUE);
                $perKm=$this->input->post('perKm_'.$i, TRUE);

                $perMinute=$this->input->post('perMinute_'.$i, TRUE);
                $WaitingperHour=$this->input->post('WaitingperHour_'.$i, TRUE);
             
                for($a=0;$a<count($levelId);$a++){
                if( $nowStart[$a]!='' || $minNow[$a]!='' || $laterStart[$a]!='' || $minLater[$a]!='' || $perKm[$a]!='' || $perMinute[$a]!='' ||  $WaitingperHour[$a]!=''){
                     $data =  array('packageId' => $packageId
                                    ,  'countryId' => $countryId 
                                    ,  'cityId' => $cityId
                                     ,   'typeId' => $typeId[$i] 
                            ,  'levelId' => $levelId[$a]
                           
						 ,  'nowStart' => $nowStart[$a]
                            ,  'minNow' => $minNow[$a]   
                             , 'laterStart' => $laterStart [$a]
						 ,  'minLater' => $minLater[$a]
                            ,  'perKm' => $perKm[$a]
                         ,  'perMinute' => $perMinute[$a]
                            ,  'WaitingperHour' => $WaitingperHour[$a]
						   ); 
                $this->db->insert('prices', $data);
                              $pageID=$this->db->insert_id();
                        }
                    }
						  
                }
         //   }
            
            
					/*	 $data =  array('packageId' => $packageId
						   ,  'countryId' => $countryId 
						 ,  'cityId' => $cityId
                            ,  'levelId' => $levelId
                            ,   'typeId' => $typeId
						 ,  'nowStart' => $nowStart
                            ,  'minNow' => $minNow    
                             , 'laterStart' => $laterStart
						 ,  'minLater' => $minLater
                            ,  'perKm' => $perKm
                                         ,  'perMinute' => $perMinute
                            ,  'WaitingperHour' => $WaitingperHour
						   ); 
						  
						  if($pageid) //update
						    {
                              
							 $this->db->where('priceId',$pageid);
						     $this->db->update('prices', $data);
                             
							}else{  //insert
                             // $data['network_admin']=$userId;
						      $this->db->insert('prices', $data);
                              $pageID=$this->db->insert_id();
                             
						    }*/
						
            redirect(base_url('trips/pricingList'));
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }   
    }
//=========================
     function delete()
   {
    $id=$this->uri->segment(4);
     $sts=$this->uri->segment(5);
			 if($this->session->userdata('id'))
			   {			
						if($id )
						   {
                        //    $data=array('network_active'=>!$sts);
						   $this->db->where('priceId', $id);
						   $this->db->delete('prices'); 
						   }
						 redirect(site_url('Trips/pricingList'));
				} else {
			  redirect(site_url('').'/admin');
			 }		   
						   
   }	 

//===========#######################PageS######################=====================
    function  pricingList()
	  {
	  
	   if($this->session->userdata('id'))
			   {
           
			       $data['type'] = 1;
				   $data['pages'] = $this->users->tblLIst('		prices a INNER JOIN packages b ON a.packageId = b.packageId INNER JOIN countries c ON a.countryId = c.countryId INNER JOIN cities d ON a.cityId = d.cityId INNER JOIN levels e ON a.levelId=e.levelId INNER JOIN tripTypes f ON a.typeId=f.typeId','','','a.packageId,a.countryId,a.cityId');	
				   $data['pageTitle']='Pricing List';
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/trips/list',$data); 
		       
	   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
    
/********************************************/
    function getData()
    {
         $packageId=$this->input->post('packageId', TRUE);
	 $countryId=$this->input->post('countryId', TRUE);

	  $cityId=$this->input->post('cityId', TRUE);
         $data['info'] = $this->users->getPeicingData($packageId,$countryId,$cityId);
    }
    //***************************//
  function  offerForm()
	  {
	   $id=$this->uri->segment(4);
	  
	   
	  if($this->session->userdata('id'))
			   {
            $data['countries']=$countries = $this->users->tblLIst('countries','countryStatus','1');
             $data['cities'] = $this->users->tblLIst('cities','countryId',$countries[0]['countryId']);
           
            $data['levels'] = $this->users->tblLIst('levels','levelStatus','1');
			     if($id && $id!='saved') 
					   {    $editData=$this->users->tblLIst('offers','offerId',$id);
							$data['page'] =$page= $editData[0];
                             $data['cities'] = $this->users->tblLIst('cities','countryId',$page['countryId']);

							$data['pageTitle']=lang('edit_offer');
					   } else {
	 						$data['pageTitle']=lang('Add_offer');
					   }
			
  				  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/trips/offer_form',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
//=========================
  function Saveoffer()
    {
       $pageid=$this->input->post('pageid', TRUE); 
	 $offerText=$this->input->post('offerText', TRUE);
	 $offerDetails=$this->input->post('offerDetails', TRUE);
//
	  $countryId=$this->input->post('countryId', TRUE);
	 $cityId=$this->input->post('cityId', TRUE);
 
        
        $levelId=$this->input->post('levelId', TRUE);
	 $offerType=$this->input->post('offerType', TRUE);
//
	  $offerUsers=$this->input->post('offerUsers', TRUE);
	 $offerMaxValue=$this->input->post('offerMaxValue', TRUE);
        
         $offerExpireDate=$this->input->post('offerExpireDate', TRUE);
	
	 $offerValidFor=$this->input->post('offerValidFor', TRUE);
 
        
       
	 
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			  
						 $data =  array('offerText' => $offerText
                                        ,  'offerDetails' => $offerDetails 
                                        ,  'countryId' => $countryId 
                                        ,  'cityId' => $cityId
                                        ,  'levelId' => $levelId
                                        
                                        ,  'offerType' => $offerType
                                         ,  'offerUsers' => $offerUsers
                                        
                                        ,  'offerMaxValue' => $offerMaxValue
                                        ,  'offerExpireDate' => $offerExpireDate
                                        ,  'offerValidFor' => $offerValidFor
                                        
                            
                                       
						   ); 
						 
						 if($pageid) //update
						    {
                             
							 $this->db->where('offerId',$pageid);
						     $this->db->update('offers', $data);
                             
							}else{  //insert 
                              
						      $this->db->insert('offers', $data);
                              $pageID=$this->db->insert_id();
                             
						    } 
						
            redirect(base_url('trips/offerList'));
						  
	          } else {
			   
			    redirect(base_url('admin'));
			   
			   }  
      
    }
//=========================
 function Deleteoffer()
   {
       $id=$this->uri->segment(4);
			 if($this->session->userdata('id'))
			   {			
						if($id)
						   {
						   $this->db->where('offerId', $id);
						   $this->db->delete('offers'); 
						   }
						redirect(base_url('trips/offerList'));
				} else {
			  redirect(base_url('admin'));
			 }		   
					   
   }    
    //*******************************************//
  function  offerList()
	  {
	  
	  if($this->session->userdata('id'))
			   {
			       $data['type'] = 1;
				   $data['pages'] = $this->users->tblLIst('`offers` a   LEFT JOIN countries b ON a.countryId = b.countryId  LEFT JOIN cities c ON c.cityId = a.cityId  LEFT JOIN levels d ON a.levelId = d.levelId');	
				   $data['pageTitle']=lang('offerList');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/trips/offers_list',$data); 
		       
			   } else {
			   
			   redirect(base_url('admin'));
			   
			   }
	  
	  }	
      //*********************************/
   function get_Model()
    {$brand_id = $this->uri->segment(4); 
        $data['models'] = $this->users->tblLIst('models','brandId',$brand_id);
	$this->load->view('admin/drivers/get_models',$data);
    }
    /******************************/
    function checkCode()
    {
        $code=$this->input->post('code', TRUE);
         $check = $this->users->tblLIst('drivers','drivercode',$code);
        if(count($check)>0)
            $html='1';
        else $html='0';
        echo $html;
    }
    //************************************/
    function getReffer()
    {
         $q=$this->input->post('q', TRUE);
          $arr = $this->users->get_driversReffer($q);
        return json_encode($arr);
    }
//=====*/=============================== 
  


}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */