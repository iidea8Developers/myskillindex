<?php 
session_start();
include_once('../../service/common/db_connection.php');
include_once('../../lib/log4php/Logger.php');
include_once('../../service/common/common_error.php');
Logger::configure('../../config/log_config.xml');
$log = Logger::getLogger('image_update.php');

$log->info("****START image_update.php****");

$user=$_SESSION['id'];

$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = @end(explode(".", $_FILES["pic"]["name"]));
$log->debug($extension);
$log->debug($_FILES["pic"]);
if(isset($_FILES['pic'])){
  $log->debug("$_POST is set");
if ((($_FILES["pic"]["type"] == "image/gif")
|| ($_FILES["pic"]["type"] == "image/jpeg")
|| ($_FILES["pic"]["type"] == "image/JPG")
|| ($_FILES["pic"]["type"] == "image/png")
|| ($_FILES["pic"]["type"] == "image/pjpeg"))
&& ($_FILES["pic"]["size"] < 200000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["pic"]["error"] > 0)
    {
    $log->debug("error code: ".$_FILES["pic"]["error"]);
    }
  else
    {
    

    if (file_exists("../../images/candidate/" . $_FILES["pic"]["name"]))
      {
      unlink("../../images/candidate/" . $_FILES["pic"]["name"]);
  move_uploaded_file($_FILES["pic"]["tmp_name"],
      "../../images/candidate/". $user.".".$extension);
      $url=$user.".".$extension;
    
      $query="update t_candidate_1 set candidate_image='$url' where candidate_id='$user'";
      if(mysqli_query($connection,$query)){
         $log->debug("Saved to Database successfully");
              }
      }
    }
  }
else
  {
  $log->debug("file size greater than 200 KB or invalid file extension");

  }
}
else
{
  $log->debug("file not set");
}

header("location:dashboard.php");
?>