<?php


require_once 'uploader.php';

// Directory where we're storing uploaded images
// Remember to set correct permissions or it won't work
$upload_dir = './resources/uploads/files/small/';
$original_upload_dir = './resources/uploads/files/original/';
$valid_extensions = array('jpeg', 'jpg', 'bmp', 'gif','png');
//echo $upload_dir ;
//print_r($valid_extensions );
$uploader = new FileUpload() ;
// Handle the upload
$result = $uploader->handleUpload($upload_dir, $valid_extensions);
$original_result = $uploader->handleUpload($original_upload_dir, $valid_extensions);

if (!$result) {
  exit(json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg())));  
}
/*else{*/
    $targetFile =  str_replace('//','/',$upload_dir) .$uploader->newFileName;
     $thumbnail = "./resources/uploads/files/small/".$uploader->newFileName;
    $fileext=substr($uploader->newFileName,strrpos($uploader->newFileName,'.')+1,strlen($uploader->newFileName));
    list($width, $height) = @getimagesize($targetFile);
		$newwidth = 55; //145;// This can be a set value or a percentage of original size ($width)
		$newheight = 55; //110;// This can be a set value or a percentage of original size ($height)
		 
		// Load the images
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		   
		 if($fileext=='jpg' || $fileext=='jpeg' || $fileext=='JPG'){
		
		 if (false !== @imagecreatefromjpeg($targetFile)){
		 $source = imagecreatefromjpeg($targetFile);	 
		 }else{
		 $source = "";	
		 }
		 }else if($fileext=='gif' || $fileext=='GIF'){
			 
		 if (false !== @imagecreatefromgif($targetFile)){
		  $source = imagecreatefromgif($targetFile);
		 }else{
		 $source = "";	
		 }	 
		
		 }else if($fileext=='png' || $fileext=='PNG'){
			
		 if (false !== @imagecreatefrompng($targetFile)){
		 $source = imagecreatefrompng($targetFile);
		 }else{
		 $source = "";	
		 }	 	 
			 
		  
		 }
  		if($source !=""){     
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		 
		// Save the new file to the location specified by $thumbnail

		if($fileext=='jpg' || $fileext=='jpeg' || $fileext=='JPG')
			imagejpeg($thumb, $thumbnail, 100);
		 else if($fileext=='gif' || $fileext=='GIF')
			 imagegif( $thumb, $thumbnail);
		  else if($fileext=='png' || $fileext=='PNG')
			 imagepng( $thumb, $thumbnail);

/*##################Thumbnial Small Image##################### */
             
             
             
             
             
		/*########### thumbnail meduim image##############*/	 
			 
		$meduim_thumb_name=$uploader->newFileName;
	    $thumbnail2 = "./resources/uploads/files/meduim/".$meduim_thumb_name;	  
	    if($meduim_thumb_name!=''){
	
		list($width, $height) = @getimagesize($targetFile);
		$newwidth2 = 150; //145;// This can be a set value or a percentage of original size ($width)
		$newheight2 = 200; //110;// This can be a set value or a percentage of original size ($height)
		 
		// Load the images
		$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
		   
		if($fileext=='jpg' || $fileext=='jpeg' || $fileext=='JPG')
		$source2 = imagecreatefromjpeg($targetFile);
		 else if($fileext=='gif' || $fileext=='GIF')
		 $source2 = imagecreatefromgif($targetFile);
		 else if($fileext=='png' || $fileext=='PNG')
		  $source2 = imagecreatefrompng($targetFile);
		 
		// Resize the $thumb image.
		imagecopyresized($thumb2, $source2, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
		 
		// Save the new file to the location specified by $thumbnail

		if($fileext=='jpg' || $fileext=='jpeg' || $fileext=='JPG')
			imagejpeg($thumb2, $thumbnail2, 100);
		 else if($fileext=='gif' || $fileext=='GIF')
			 imagegif( $thumb2, $thumbnail2);
		  else if($fileext=='png' || $fileext=='PNG')
			 imagepng( $thumb2, $thumbnail2);
             //echo 'midi';
             }
             /*########### thumbnail meduim image##############*/	 

		
             
			 
		/*##################Thumbnial Large Image##################### */
			 
		$large_thumb_name=$uploader->newFileName;
	    $thumbnail1 = "./resources/uploads/files/large/".$large_thumb_name;	  
	    if($large_thumb_name!=''){
	
		list($width, $height) = @getimagesize($targetFile);
		$newwidth1 = 400; //145;// This can be a set value or a percentage of original size ($width)
		$newheight1 = 250; //110;// This can be a set value or a percentage of original size ($height)
		 
		// Load the images
		$thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
		   
		if($fileext=='jpg' || $fileext=='jpeg' || $fileext=='JPG')
		$source1 = imagecreatefromjpeg($targetFile);
		 else if($fileext=='gif' || $fileext=='GIF')
		 $source1 = imagecreatefromgif($targetFile);
		 else if($fileext=='png' || $fileext=='PNG')
		  $source1 = imagecreatefrompng($targetFile);
		 
		// Resize the $thumb image.
		imagecopyresized($thumb1, $source1, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
		 
		// Save the new file to the location specified by $thumbnail

		if($fileext=='jpg' || $fileext=='jpeg' || $fileext=='JPG')
			imagejpeg($thumb1, $thumbnail1, 100);
		 else if($fileext=='gif' || $fileext=='GIF')
			 imagegif( $thumb1, $thumbnail1);
		  else if($fileext=='png' || $fileext=='PNG')
			 imagepng( $thumb1, $thumbnail1);

             /*##################Thumbnial Large Image##################### */
             
             

		 
			  
		 $ImgCreatedNewName=$uploader->newFileName; // Image Real Name
		 
	    // $imagesProcess->Resize_by_width($targetPath.$ImgCreatedNewName,$targetPath."thum/".$ImgCreatedNewName,135,$fileext);
	
		// echo $large_thumb_name;
           // echo 'large';
           echo json_encode(array('success' => true,'newFileName' => $uploader->newFileName));

		}
		}else{
			
		 echo 1;
			
		}	
	   
	


?>