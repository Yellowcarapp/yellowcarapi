<?php
class cropImage{
 //code here

var $imgSrc,$myImage,$cropHeight,$cropWidth,$x,$y,$thumb;  

function setImage($image,$rW,$rH)
{

//Your Image
   $this->imgSrc = $image; 
                     
//getting the image dimensions
   list($width, $height) = getimagesize($this->imgSrc); 
                     
//create image from the jpeg
$ext = strtolower(substr($this->imgSrc, -4)) ;
if($ext == ".png") 
   $this-> myImage = imagecreatefrompng($this->imgSrc) or die("Error: Cannot find image!"); 
else 
   $this-> myImage = imagecreatefromjpeg($this->imgSrc) or die("Error: Cannot find image!"); 
	

       if($width > $height) $biggestSide = $width; //find biggest length
       else $biggestSide = $height; 
                     
//The crop size will be half that of the largest side 
if($rW>=$width ||  $rH>=$height)
	{
  	$this->cropWidth   = $width; 
  	$this->cropHeight  = $height; 
	
	}
else{
      $cropPercent = .5; // This will zoom in to 50% zoom (crop)
  
  $this->cropWidth   = $biggestSide*$cropPercent; 
  $this->cropHeight  = $biggestSide*$cropPercent; 
                     
}                
//getting the top left coordinate
   $this->x = ($width-$this->cropWidth)/2;
   $this->y = ($height-$this->cropHeight)/2;
             
}  



function createThumb($rW,$rH)
{
                    
  //$thumbSize = 250; // will create a 250 x 250 thumb
  $this->thumb = imagecreatetruecolor($rW, $rH); 

  imagecopyresampled($this->thumb, $this->myImage, 0, 0,$this->x, $this->y, $rW, $rH, $this->cropWidth, $this->cropHeight); 
}  

function renderImage()
{
$ext = strtolower(substr($this->imgSrc, -4));
if($ext == ".png") 
     header('Content-type: image/png');
else
     header('Content-type: image/jpeg');
 
	

   imagejpeg($this->thumb);
   imagedestroy($this->thumb); 
}  


}  
$src = $_GET['src'];  
$rH = $_GET['H'];  
$rW = $_GET['W'];  

$image = new cropImage;
$image->setImage($src,$rW,$rH);
$image->createThumb($rW,$rH);
$image->renderImage(); 

?>
