<?php
// Funtion to prepare Data URI:
// @ parm: Image filepath, Image Size
// reutn : data_uri string
function thumbnail_data_uri($filename,$width=0,$height=0) 
{
 
 // Get Image Header Type
      $image_info = getimagesize($filename);
      $image_type = $image_info[2];

 // Check the Size is Specified
 if($width!=0 and $height!=0)
 {
      if( $image_type == IMAGETYPE_JPEG ) {
         $image = imagecreatefromjpeg($filename);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         $image = imagecreatefromgif($filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         $image = imagecreatefrompng($filename);
   imagealphablending($image, true);

      } 

 $new_image = imagecreatetruecolor($width, $height);
 imagealphablending($new_image, false);
 imagesavealpha($new_image, true);     
      imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image),imagesy($image));
      $image = $new_image; 
   
 ob_start();
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($image);
      } 
 $content=ob_get_clean();   
   
   
 }else
 $content=file_get_contents($filename,true);
 
 
 
 $base64 = base64_encode($content); 
 return "data:$image_type;base64,$base64";
}

?>
<?php 
echo thumbnail_data_uri($_REQUEST['image'],$_REQUEST['width'],$_REQUEST['height']);
exit;
?>
<!--
	<img src="<?php echo thumbnail_data_uri($_REQUEST['image'],$_REQUEST['width'],$_REQUEST['height']);?>" alt="">
<img src="<?php echo thumbnail_data_uri('http://upload.wikimedia.org/wikipedia/commons/f/f3/New_Home.jpg',320,'');?>" alt="">
<img src="<?php echo thumbnail_data_uri('http://upload.wikimedia.org/wikipedia/commons/f/f3/New_Home.jpg',100,100);?>" alt="">
<img src="<?php echo thumbnail_data_uri('http://upload.wikimedia.org/wikipedia/commons/f/f3/New_Home.jpg',150,150);?>" alt="">
<img src="<?php echo thumbnail_data_uri('http://upload.wikimedia.org/wikipedia/commons/f/f3/New_Home.jpg',100,100);?>" alt="">
-->
