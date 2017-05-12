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
	   $page_id=$this->uri->segment(4);
              
	   
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
			   
			   redirect(site_url('admin'));
			   
			   }
	  
	  }	
	
	//============================
	function SaveCard()
	   {
	 
	 $pageid=$this->input->post('pageid', TRUE); 
	 $cardNumber=$this->input->post('cardNumber', TRUE);
	 $cardCredit=$this->input->post('cardCredit', TRUE);
	 $cardUsed=$this->input->post('cardUsed',TRUE);
	 $cardCreated=date('Y-m-d H:i:s');
	$cardCountry=$this->input->post('cardCountry',TRUE);
	$cardCurrency=$this->input->post('cardCurrency',TRUE);
	  
		
       
 if($this->session->userdata('id')  )
			   {   
      for($i=0;$i<$cardNumber;$i++){
         
            $date = random_string('numeric',4).time();
           if(intval($date)<0){
               $date=intval($date)*intval(-1);
               $secondPart=mt_rand(1,intval($date));}
            else{
                    $secondPart=mt_rand(1,intval($date));
            }
          
           
           
            $string= random_string('numeric', 8).substr($secondPart,0,8);
            $arr=str_split($string,4);
          $num=implode(' ',$arr);
       $data =  array('cardNumber' => $num 
						   ,  'cardCredit' => $cardCredit 
						   ,  'cardUsed' => $cardUsed 
						  ,'cardCountry'=>$cardCountry
                      ,'cardCurrency'=>$cardCurrency
						   ); 
                        $data['cardCreated']=$cardCreated;
						      $this->db->insert('cards', $data);
            }
			  
					/*	 $data =  array('cardNumber' => $cardNumber 
						   ,  'cardCredit' => $cardCredit 
						   ,  'cardUsed' => $cardUsed 
						  
						   ); 
						  
						  if($pageid) //update
						    {
							 $this->db->where('cardId',$pageid);
						     $this->db->update('cards', $data);
							}else{  //insert
                              $data['cardCreated']=$cardCreated;
						      $this->db->insert('cards', $data);
						    }
						*/
						  /* redirect(site_url('ards/cardsList')); */
     echo "<script>document.location='".site_url('Cards/cardsList')."';</script>";
						  
	          } else {
			   
			    redirect(site_url('admin'));
			   
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
			   redirect(site_url('admin'));
			 }
	 }
 //============================
function Deletecard()
     {
	 
	  if($this->session->userdata('id')  )
			   {
						$page_id=$this->uri->segment(4);
						
						if($page_id)
						   {
						  $this->db->where('cardId', $page_id);
						  $this->db->delete('cards');
						   
						  }
				  redirect(site_url('Cards/cardsList')); 
						 
		     } else {
			   redirect(site_url('admin'));
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
    $results_array = array(
                           'cardNumber' => $cd['cardNumber'],
                           'cardCredit' => $cd['cardCredit']
                           
                           );        
           $this->db->set($results_array);
           $this->db->insert('cards', $results_array);


        } 
    //  redirect(site_url('cards/cardsList')); 
     echo "<script>document.location='".site_url('Cards/cardsList')."';</script>";

}
  
//=====#########################
 

}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */