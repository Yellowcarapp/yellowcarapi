<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   define('PW_AUTH', 'NAk496EntwbE5FgpbfxYGysbKFPe7HacD0sHudddEgxmSwQIc7wON6BmYQ1juSmO1VHhsz1XUEyiVwZ6tBmH');
   define('PW_APPLICATION', 'FF41B-2DB81');
 
 
class Pushwoosh { 

    
    function doPostRequest($url, $data, $optional_headers = null) {
        $params = array(
            'http' => array(
                'method' => 'POST',
                'content' => $data
            ));
        if ($optional_headers !== null)
            $params['http']['header'] = $optional_headers;
 
        $ctx = stream_context_create($params);
        $fp = fopen($url, 'rb', false, $ctx);
        if (!$fp)
            throw new Exception("Problem with $url, $php_errmsg");
 
        $response = @stream_get_contents($fp);
        if ($response === false)
            return false;
       // return $response;
    }
 
    function pwCall( $action, $data = array() ) {
        $url = 'https://cp.pushwoosh.com/json/1.3/' . $action;
        $json = json_encode( array( 'request' => $data ) );
        $res = $this->doPostRequest( $url, $json, 'Content-Type: application/json' );
       // print_r( @json_decode( $res, true ) );
    }
	
 function send($message='',$badge='1')
  {
  	if($message)
	 	 {
		    $this->pwCall( 'createMessage', array(
		        'application' => PW_APPLICATION,
		        'auth' => PW_AUTH,
		        'notifications' => array(
		                    array(
		                        'send_date' => 'now',
		                        'content' => $message,
		                        'ios_badges' =>$badge,
		                        'data' => array( 'custom' => 'json data' ),
		                        'link' => ''//'http://pushwoosh.com/'
		                    )
		                )
		            )
		        );
		 }  
   }		
//===========
}



/* End of file Template.php */

/* Location: ./system/application/libraries/Template.php */