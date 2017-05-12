<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Track extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/generalsetting_model','generalsetting');
    }

    function index()
    {
        if($this->session->userdata('id') )
        {
            $data['pageTitle']=' track ';
            $this->template->set('adminMenue','Dashboard');
            $this->template->set('adminSubMenue','ManagePages');
            $this->template->load('admin/Container', 'admin/track/track',$data);
        } else {
            redirect(site_url('admin/Admin'));
        }
    }
    function mydrivers()
    {
        $this->db->where('kitchenId',$this->session->userdata('kitchen_id'));
        $data['drivers'] = $this->db->get('drivers')->result();
        echo json_encode($data);
    }
 }//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */