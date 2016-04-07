<?php 
    //Delete the registered exam  
    // created by:  vivek singh
    // created on:  05-04-2016
    // modified by: jitendra dayma
    // modified on: 07-04-2016

	session_start();
	include_once("../../service/common/db_connection.php");
	include_once('../../config/config.txt');
	include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');

	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('delete_exam.php');

	$log->info("****START delete_exam.php****");
  	$id=$_POST["id"];

	//$id = mysql_escape_string($id);
	if(isset($_POST["id"])) {
		$query="DELETE FROM t_candidate_exam WHERE exam_id = $id ";
    	mysqli_query($connection,$query);
    	$log->info("****END delete_exam.php****");
	}
	mysqli_close($connection);
?>