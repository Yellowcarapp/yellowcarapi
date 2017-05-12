<?php
$file = uniqid().'.mp4';
move_uploaded_file ($_FILES['video']["tmp_name"],'resources/uploads/'.$file);
echo $file;
?>