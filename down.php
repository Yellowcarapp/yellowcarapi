<?php
if($_GET['file']){
//include_once "library.php";
//include "dream-classes/zip.lib.php";
//---------Show Data------------------
	
		
			$Folder='./';
			$filename = $Folder.$_REQUEST['file'];
			$base=basename($_REQUEST['file']);
		//echo $filename;
/*if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');*/


$file_extension = strtolower(substr(strrchr($filename,"."),1));


if( $filename == "" ) 
{
  echo "<html><body>File name ==''</body></html>";
  exit;
} 
elseif ( ! file_exists( $filename ) ) 
{
//echo $filename;
  echo "<html><body>File name not exist</body></html>";
  exit;
};
switch( $file_extension )
{
  case "xls": $ctype="application/vnd.ms-excel"; break;
  case "pdf": $ctype="application/pdf"; break;
  case "exe": $ctype="application/octet-stream"; break;
  case "zip": $ctype="application/zip"; break;
  case "doc": $ctype="application/msword"; break;
  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  default: $ctype="application/force-download";
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers 
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=".$_GET['file'].";" );
header("Content-Transfer-Encoding: binary");
//header("Content-Length: ".filesize($filename));

readfile("$filename");
exit();
} else {
echo 'File Requested not found';
								}

?>
