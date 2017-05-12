<?php 
require 'socket/client.php';
$elephant = new Client('http://nodejs.dreamsoft-it.org:1919', 'socket.io', 1, false, true, true);
$elephant->init();
$data = explode('-',$_GET['data']);
$send=array('room'=>'kitchen_'.$data[0],'driverId'=>$data[1],'current_orders'=>$data[2]);
$re= $elephant->send(Client::TYPE_EVENT,null,null,json_encode(array('name' => 'update', 'args' =>$send)));
$elephant->close();

 ?>