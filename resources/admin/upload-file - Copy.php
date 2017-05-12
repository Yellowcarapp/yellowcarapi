<?php

$uploaddir = '../uploads/'; 



$uploadfileNameStr=str_replace (" ", "", $_FILES['uploadfile']['name']);

$ext = substr(strrchr($uploadfileNameStr, '.'), 1);

$realname=basename(time().'.'.$ext); //.$uploadfileNameStr

$file = $uploaddir.$realname; 



  

  

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 

 echo $realname; 

 // createThumbsWaterMark('../upload/'.$realname,$realname,'../upload/',$thumY='0');

 // createThumbsWaterMark('../upload/'.$realname,$realname,'../upload/thum/',$thumY='1');

/* echo "<script>alert('".$realname."');</script>";*/

  $creatThum=@createThumbs( '../uploads/', '../uploads/thums/', '150',$realname);

   

 } else {

	echo "Error : try again";

}

 //---------function create thumnails img-----

function createThumbs($pathToImages,$pathToThumbs,$thumbWidth,$fname='')

{

 

  // open the directory

  $dir = @opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:

 // while (false !== ($fname = readdir( $dir ))) {

    // parse path for the extension

    

    $info = @pathinfo($pathToImages . $fname);

    // continue only if this is a JPEG image

    if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg'|| strtolower($info['extension']) == 'png' )

    {

		// echo "$fname <br />";

	   // echo "$pathToImages <br />";

    //  echo "Creating thumbnail for {$fname} <br />";



      // load image and get image size

      $img = @imagecreatefromjpeg( "{$pathToImages}{$fname}" );

      $width = @imagesx( $img );

      $height = @imagesy( $img );



      // calculate thumbnail size

      $new_width = $thumbWidth;

      $new_height = @floor( $height * ( $thumbWidth / $width ) );



      // create a new temporary image

      $tmp_img = @imagecreatetruecolor( $new_width, $new_height );



      // copy and resize old image into new image

      @imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );



      // save thumbnail into a file

     $img=@imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );

	  

    }

	

	 

	

 // }

  // close the directory

 // closedir( $dir );

 } // end createThumbs

 



function  createThumbsWaterMark($img='',$realname='',$path='',$thumY='0')

  {

  //Thumbnail sample

  if($img)

   {

			include_once ('thumnails/Thumbnail.class.php');

			

			$thumb=new Thumbnail($img);	        // Contructor and set source image file

			

			//$thumb->memory_limit='32M';               //[OPTIONAL] set maximun memory usage, default 32 MB ('32M'). (use '16M' or '32M' for litter images)

			//$thumb->max_execution_time='30';             //[OPTIONAL] set maximun execution time, default 30 seconds ('30'). (use '60' for big images o slow server)

			

			/*

			$thumb->quality=85;                         // [OPTIONAL] default 75 , only for JPG format

			$thumb->output_format='JPG';                // [OPTIONAL] JPG | PNG

			$thumb->jpeg_progressive=0;               // [OPTIONAL] set progressive JPEG : 0 = no , 1 = yes

			$thumb->allow_enlarge=false;              // [OPTIONAL] allow to enlarge the thumbnail

			//$thumb->CalculateQFactor(10000);          // [OPTIONAL] Calculate JPEG quality factor for a specific size in bytes

			//$thumb->bicubic_resample=false;             // [OPTIONAL] set resample algorithm to bicubic

			*/

			

			 $thumb->img_watermark='thumnails/watermark.png';	    // [OPTIONAL] set watermark source file, only PNG format [RECOMENDED ONLY WITH GD 2 ]

  			 $thumb->img_watermark_Valing='BOTTOM';   	    // [OPTIONAL] set watermark vertical position, TOP | CENTER | BOTTOM

			 $thumb->img_watermark_Haling='CENTER';   	    // [OPTIONAL] set watermark horizonatal position, LEFT | CENTER | RIGHT

		/*	

			$thumb->txt_watermark='www.amrgafar.com';	    // [OPTIONAL] set watermark text [RECOMENDED ONLY WITH GD 2 ]

			$thumb->txt_watermark_color='FF0000';	    // [OPTIONAL] set watermark text color , RGB Hexadecimal[RECOMENDED ONLY WITH GD 2 ]

			$thumb->txt_watermark_font=5;	            // [OPTIONAL] set watermark text font: 1,2,3,4,5

			$thumb->txt_watermark_Valing='BOTTOM';   	// [OPTIONAL] set watermark text vertical position, TOP | CENTER | BOTTOM

			$thumb->txt_watermark_Haling='CENTER';       // [OPTIONAL] set watermark text horizonatal position, LEFT | CENTER | RIGHT

			$thumb->txt_watermark_Hmargin=10;           // [OPTIONAL] set watermark text horizonatal margin in pixels

			$thumb->txt_watermark_Vmargin=10;           // [OPTIONAL] set watermark text vertical margin in pixels

			*/

			if($thumY=='1')

			  {

			$thumb->size_width(150);				    // [OPTIONAL] set width for thumbnail, or

			$thumb->size_height(113);				    // [OPTIONAL] set height for thumbnail, or

			$thumb->size_auto(150);					    // [OPTIONAL] set the biggest width or height for thumbnail

			$thumb->size(250,213);		            // [OPTIONAL] set the biggest width and height for thumbnail

			  }

			$thumb->process();   				        // generate image

			

			//$thumb->show();						        // show your thumbnail, or

			

			$thumb->save($realname,$path);			// save your thumbnail to file, or

			//$image = $thumb->dump();                  // get the image

			

			 echo ($thumb->error_msg);                 // print Error Mensage

  }

}

 

?>