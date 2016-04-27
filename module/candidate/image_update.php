<?php 
    include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');
	include_once('../../service/common/db_connection.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('image_update.php');

	$log->info("****START image_update.php****");
	session_start();
	$string = $_SESSION['id'];

	function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);

    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}

	
 // valid extensions	
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
// need to add exception handling- call the error model for display message

// upload directory
$path = '../../images/profiles/'; 



if(isset($_FILES['image']))
{

	$log->debug("enterd isset"); 
$maxsize    = 1024;

 $img = $_FILES['image']['name'];
 $tmp = $_FILES['image']['tmp_name'];
 $log->debug("$tmp = ".$tmp); 


 // get uploaded file's extension
 $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
 
 // can upload same image using rand function
 $final_image = rand(1000,1000000).$img;
 
 // check's valid format
 if(in_array($ext, $valid_extensions)) 
 {     
  $path = $path.strtolower($final_image); 
  $log->debug($path);
  if($_FILES['image']['size']<=$maxsize)
  {
  if(move_uploaded_file($tmp,$path)) 
  {
  	$log->debug("entered move_upload_file");
  	$sql = "UPDATE t_candidate_1 
  			SET candidate_image = '{$img}' 
  			WHERE candidate_id = '{$_SESSION['id']}' ";
    mysqli_query($connection,$sql);
    $log->debug("query executed=".$sql);
  }
  else 
  {
     $log->debug("Error in move_uploaded_file ");
  }
}
  else
  {
  	$log->debug("file size larger than 1mb ");
  }
 }
  else 
 {
  $log->debug("invalid file type ");
 }
}

mysqli_close($connection);
header('Location: dashboard.php');
$log->info("****END image_update.php****");
?>