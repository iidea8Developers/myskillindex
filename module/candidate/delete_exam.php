<?php 
    //Delete the registered exam  
    // created by:  vivek kumar
    // created on:  05-04-2016
    // modified by: vivek kumar
<<<<<<< HEAD
    // modified on: 08-04-2016
=======
    // modified on: 12-04-2016
>>>>>>> origin/master

	session_start();
	include_once("../../service/common/db_connection.php");
	include_once('../../config/config.txt');
	include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');

	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('delete_exam.php');

	$log->info("****START delete_exam.php****");
  	$id=$_GET["id"];

	//$id = mysql_escape_string($id);
	if(isset($_GET["id"])) {
		$query="DELETE FROM t_candidate_exam WHERE exam_id = $id ";
    	mysqli_query($connection,$query);
    	$log->info("****END delete_exam.php****");
	}
	mysqli_close($connection);
?>