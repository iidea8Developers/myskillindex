<?php 
session_start();
include_once("../../service/common/db_connection.php");
include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');

	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('delete_exam.php');

	$log->info("****START delete_exam.php****");
  $id=$_GET['q']);
$id = mysql_escape_string($id);
if(isset($_GET['q'])) {

	$query="DELETE FROM t_candidate_exam WHERE exam_id = ".$id."";
    mysql_query($query,$connection);
}
?>