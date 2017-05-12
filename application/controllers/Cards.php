<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cards extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/Generalsetting_model','generalsetting');
	    $this->load->model('admin/Cards_model','cards');
		
		
	}
 
//===========#######################PageS######################=====================
    function  cardsForm()
	  {
	   $page_id=$this->uri->segment(3);
              
	   
	   if($this->session->userdata('id')  )
			   {
			      $data['currency'] = $this->generalsetting->All('currency','curr_id');
            $data['countries'] = $this->generalsetting->All('countries','countryId');
				
				  if($page_id && $page_id!='saved') 
				   {    

						$data['page'] = $this->generalsetting->Details("cards","cardId",$page_id);
						 
						$data['pageTitle']='Edit Card';
				  
				   } else {
				    
 						$data['pageTitle']='Add Card';
				  
				   }
				   
 				   
				  $this->template->set('adminMenue','Dashboard');
				  $this->template->set('adminSubMenue','Create a new Page');
			 
 				  $this->template->load('admin/Container', 'admin/cards/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
			   }
	  
	  }	
	
	//============================
	function SaveCard()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $cardNumber=$this->input->post('cardNumber', TRUE);
	 $cardCredit=$this->input->post('cardCredit', TRUE);
	// $cardUsed=$this->input->post('cardUsed',TRUE);
	 $cardCreated=date('Y-m-d H:i:s');
	//$cardCountry=$this->input->post('cardCountry',TRUE);
	//$cardCurrency=$this->input->post('cardCurrency',TRUE);
	  
		
       
 if($this->session->userdata('id')  )
			   {   
$check=$this->generalsetting->All('cards','cardId','cardNumber',$cardNumber );
       if(count($check)==0){
       $data =  array('cardNumber' => $cardNumber 
						   ,  'cardCredit' => $cardCredit 
						   
						   ); 
                        $data['cardCreated']=$cardCreated;
						      $this->db->insert('cards', $data);
         
     echo "<script>document.location='".site_url('Cards/cardsList')."';</script>";
       }else {
            echo "<script>alert('duplicate');document.location='".site_url('Cards/cardsList')."';</script>";
       }
	          } else {
			   
			    redirect(base_url());
			   
			   }
	   
	   }
   
//============================
function cardsList()
     {
	 
	  if($this->session->userdata('id')  )
			   {
					 
						$data['pages'] = $this->generalsetting->All('cards','cardId');	
						$data['pageTitle']=lang('Cards');
						
					  $this->template->set('adminMenue','Dashboard');
					  $this->template->set('adminSubMenue','ManagePages');
					  $this->template->load('admin/Container', 'admin/cards/page_list',$data);
		     } else {
			   redirect(base_url());
			 }
	 }
 //============================
function Deletecard()
     {
	 
	  if($this->session->userdata('id')  )
			   {
						$page_id=$this->uri->segment(3);
						
						if($page_id)
						   {
						  $this->db->where('cardId', $page_id);
						  $this->db->delete('cards');
						   
						  }
				  redirect(site_url('Cards/cardsList')); 
						 
		     } else {
			   redirect(base_url());
			 }
	 }
 
function saveFile()
{
    $file=$this->input->post('file', TRUE); 
    $this->load->library('csvreader');
$filePath1 = './resources/uploads/files/csv/';
    $filePath=$filePath1.$file;
    $data['csvData'] = $this->csvreader->parse_file($filePath);
foreach($data['csvData'] as $cd){
    $check=$this->generalsetting->All('cards','cardId','cardNumber',$cd['cardNumber']);
    if(count($check)==0){
            $results_array = array(
                           'cardNumber' => $cd['cardNumber'],
                           'cardCredit' => $cd['cardCredit']
                           
                           );        
           $this->db->set($results_array);
           $this->db->insert('cards', $results_array);
        }

        } 
    //  redirect(site_url('cards/cardsList')); 
     echo "<script>document.location='".site_url('Cards/cardsList')."';</script>";

}
  
//=====#########################
 

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */