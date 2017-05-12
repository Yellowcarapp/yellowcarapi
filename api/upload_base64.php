<?php
if(isset($_POST["image"]))
    $imgs = $_POST["image"];
else
{
    $json = json_decode(file_get_contents('php://input'));
    if(isset($json->image))
        $imgs = $json->image;
    else
        die('error');
}
if(count($imgs))
{
    for($i=0;$i< count($imgs);$i++)
    {
        $img = $imgs[$i];
        $new_file_name = uniqid().'.png';
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $success = file_put_contents('resources/uploads/files/original/'.$new_file_name, $data);
        $return[]= $new_file_name;
    }
    echo json_encode($return);
}

?>

