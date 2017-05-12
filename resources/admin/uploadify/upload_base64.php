<?php
$new_file_name = uniqid().'.png';
if(isset($_POST["image"]))
    $img = $_POST["image"];
else
{
    $json = json_decode(file_get_contents('php://input'));
    if(isset($json->image))
        $img = $json->image;
    else
        die('error');
}
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$success = file_put_contents('uploads/'.$new_file_name, $data);
echo $new_file_name;

?>