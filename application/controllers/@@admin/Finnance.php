<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Finnance extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/finnance_model','users');		
	}
//######################	
function finnanceForm()
	  {
	
	  $id=$this->uri->segment(4);//$this->session->userdata('id');//$this->uri->segment(4);
	   if($this->session->userdata('id'))
			   {
				 				   $data['pages'] = $this->users->listAccount('	accounts INNER JOIN drivers ON driverId=acc_driver LEFT JOIN acc_coment as a ON accounts.acc_com_id=a.acc_com_id ');	
                    $data['comment']=$this->users->tblLIst('acc_coment','acc_com_type','0');
				  if($id && $id!='saved') 
					   {    
							$data['page'] =$page= $this->users->Details($id);
                      $driver=$page['acc_driver'];
                         $debit= $this->users->getBalance($driver,0);
                          $Crebit= $this->users->getBalance($driver,1);
                          if($debit['debitVal']>$Crebit['debitVal'])
                              $val=$debit['debitVal']-$Crebit['debitVal'].' '.lang('debit');
                          else if($debit['debitVal']<$Crebit['debitVal']) $val=$Crebit['debitVal']-$debit['debitVal'].' '.lang('credit');
                        else $val='0';
                      $data['finnanceMsg']=$val;
                      $data['comment']=$this->users->tblLIst('acc_coment','acc_com_type',$page['acc_mode']);
							$data['pageTitle']=lang('edit_finnance');
					   } else {
	 						$data['pageTitle']=lang('Add_finnance');
					   }
				  
				   if($id=='saved') // to show success notification
				     {
					 $data['saved']='1';
					 }else{
					  $data['saved']='0';
					 }
				    
				  $this->template->load('admin/Container', 'admin/finnance/page_form',$data); 
		       
			   } else {
			   
			   redirect(base_url());
			   
			   }
	  
	  }	
   
//===========#######################members######################=====================
   function SaveFinnance()
    {
       $pageid=$this->input->post('pageid', TRUE); 
	 $acc_driver=$this->input->post('refercode', TRUE);
	 //$acc_date=$this->input->post('acc_date', TRUE).' '.date('H:i:s');
//
       $date = new DateTime();
       $date->setTimezone(new DateTimeZone('UTC'));
       $acc_date= $date->format('Y-m-d H:i:s');
	  $acc_mode=$this->input->post('acc_mode', TRUE);
        $acc_credit=$this->input->post('acc_credit', TRUE);
	
 
        $acc_com_id=$this->input->post('comm', TRUE);
   $acc_comment=$this->input->post('acc_comment',TRUE);
		$session_data = $this->session->userdata('admin_logged_in');			
		if( $this->session->userdata('id') &&  $this->session->userdata('id') !="")
		{			
            
            
         
            
						 $data =  array('acc_driver' => $acc_driver
						   ,  'acc_date' => $acc_date
						 ,  'acc_mode' => $acc_mode
                            ,  'acc_value' => $acc_credit
                             ,  'acc_com_id' => $acc_com_id
                                        ,'acc_comment'=>$acc_comment
						   ); 
						  
						  if($pageid) //update
						    {
                              
							 $this->db->where('acc_id',$pageid);
						     $this->db->update('accounts', $data);
                             
							}else{  //insert
                             // $data['network_admin']=$userId;
						      $this->db->insert('accounts', $data);
                              $pageID=$this->db->insert_id();
                             
						    }
						
            redirect(site_url('finnance/finnanceForm'));
						  
	          } else {
			   
			    redirect(base_url());
			   
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
						   $this->db->where('acc_id', $id);
						   $this->db->delete('accounts'); 
						   }
						 redirect(site_url('finnance/finnanceForm'));
				} else {
			  redirect(base_url());
			 }		   
						   
   }	 

//===========#######################PageS######################=====================
    function  finnanceList()
	  {
	  
	   if($this->session->userdata('id'))
			   {
           
			      
				   $data['pages'] = $this->users->tblLIst('	accounts INNER JOIN drivers ON driverId=acc_driver');	
				   $data['pageTitle']=lang('finnance');
		   
		   		  $this->template->set('adminMenue','Feedback');
				  $this->template->set('adminSubMenue','KindForm');
 				  $this->template->load('admin/Container', 'admin/finnance/page_list',$data); 
		       
	   } else {
			   
			   redirect(base_url());
			   
			   }
	  
	  }	
    
/********************************************/
  function get_balance()
  {
      $id=$this->input->post('id',TRUE);
      $debit= $this->users->getBalance($id,0);
      $Crebit= $this->users->getBalance($id,1);
      if($debit['debitVal']>$Crebit['debitVal'])
          $val=$debit['debitVal']-$Crebit['debitVal'].' '.lang('debit');
      else IF($debit['debitVal']<$Crebit['debitVal']) $val=$Crebit['debitVal']-$debit['debitVal'].' '.lang('credit');
    else $val='0';
      if($val!='0'){
          $str='block';
      }else $str='none';
      echo "<script>$('#retBalance').html('".$val."');  $('#modal').css('display','".$str."'); </script>";
  }
  
//=========================
  
function get_comment()
{
    $id=$this->input->post('id',TRUE);
    $data['comment']=$this->users->tblLIst('acc_coment','acc_com_type',$id);
     $this->load->view('admin/finnance/comment_page',$data);
}
   
  //**********************************//
    function balanceDetails()
    {
        $id=$this->uri->segment(4); 
         $data['balance']=$this->users->tblLIst('accounts INNER JOIN drivers ON driverId=acc_driver','acc_driver',$id);
        $this->load->view('admin/finnance/balance_page',$data);
        
    }
//=====*/=============================== 
  


}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */