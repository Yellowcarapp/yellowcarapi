<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once APPPATH."libraries/amazon/aws-autoloader.php";
use  Aws\Sns\SnsClient;
class Push extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
        $this->s3 = SnsClient::factory(array('region' => 'us-west-2',
            'credentials' => array(
                'key'=> 'AKIAJBQG3Y325KV45M3Q'
                ,'secret'=>'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'
            )
        ));
        
	}
    function Index()
    {
        $title = $this->input->post('notTitle');
        $msg = $this->input->post('notMsg');
        $topic = $this->input->post('topic');
        $_POST['notDate'] = date('Y-m-d H:i:s');
        unset($_POST['topic']);
        $this->db->insert('notifications',$_POST);
        $message['default'] = $msg;
        $message['GCM'] = json_encode(array('data'=>array('message'=>$msg,'title'=>$title)));
        $message['APNS'] =json_encode(array('aps'=>array('alert' => $msg,'title'=>$title)));
        $re= $this->s3->publish(array('TopicArn' => $topic,'Message' => json_encode($message),'MessageStructure' => 'json'));
        
    }
    function send()
    {
        $this->load->view('admin/push/send');
        
    }


}