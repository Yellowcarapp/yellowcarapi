<?php
/*
Uploadify v2.1.0
Release Date: August 24, 2009

Copyright (c) 2009 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

$proces=$_REQUEST['filetime'];
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	//$targetPath = '/ERP/documents'. $_REQUEST['folder'] . '/';
	$folder=substr($_REQUEST['folder'],5);
	//$targetPath =  "../resources/uploads/".$_REQUEST['folder'];// .'/redsea4Realestate/Files/';
   
    $targetPath =  "./uploads/files/small/";// .'/redsea4Realestate/Files/';
    $fileupload_name=$_FILES['Filedata']['name'];
	$fileext=substr($fileupload_name,strrpos($fileupload_name,'.')+1,strlen($fileupload_name));	
	$rand=md5(time());  
	$rand=str_replace(".","_",$rand);
	$targetFile =  str_replace('//','/',$targetPath) . $rand.".".$fileext;
	 
    // $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
   
		if($proces!=1)
		{
			//echo $targetFile.' ** '.$tempFile;
		// include_once("ImagesProcess.php"); // thumnails class
		if(move_uploaded_file($tempFile,$targetFile)){
		
            
            
        /*##################Thumbnial Small Image##################### */    
            
		$small_thumb_name=$rand.".".$fileext;
	    $thumbnail = "./uploads/files/small/".$small_thumb_name;	  
	   if($small_thumb_name!=''){
	
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
		 
		// Resize the $thumb image.
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
			 
		$meduim_thumb_name=$rand.".".$fileext;
	    $thumbnail2 = "./uploads/files/meduim/".$meduim_thumb_name;	  
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
             
             }
             /*########### thumbnail meduim image##############*/	 

		
             
			 
		/*##################Thumbnial Large Image##################### */
			 
		$large_thumb_name=$rand.".".$fileext;
	    $thumbnail1 = "./uploads/files/large/".$large_thumb_name;	  
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
             
             

		 
			  
		 $ImgCreatedNewName=$rand.'.'.$fileext; // Image Real Name
		 
	    // $imagesProcess->Resize_by_width($targetPath.$ImgCreatedNewName,$targetPath."thum/".$ImgCreatedNewName,135,$fileext);
	
		 echo $large_thumb_name;
		}
		}else{
			
		 echo 1;
			
		}	
	   }
		 //echo $picture;
		  }else{
		 echo "SSInvalid";	 
		  }
	}
	else
	{
	echo "Invalid";	
	if(move_uploaded_file($tempFile,$targetFile)){
	echo $thumb_name1;
	}
	
	}
	
}
?>