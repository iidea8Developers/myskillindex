<?php
	//this page check whether user is already registered for exam or not and called register_exam
	//modified by: Jitendra dayma
	//modified on: 17/05/2016
	
	session_start();
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('exam_register_check.php');

	$log->info("****START exam_register_check.php****");

	$sql="SELECT exam_id 
		  FROM t_exam_org_qp 
		  WHERE exam_name ='{$_GET['q']}'";
	$result=mysqli_query($connection,$sql);
	$row = mysqli_fetch_assoc($result);
	$exam_id =$row['exam_id'];

	
	$sql1 ="SELECT *
		   FROM t_candidate_exam 
		   WHERE exam_id =$exam_id 
		   AND exam_start_time = NULL "; 
	$result1=mysqli_query($connection,$sql1);
	if(mysqli_num_rows($result1)===0){
		header('Location: register_exam.php/?exam_name='.$_GET['q']);
	}
	else
	{
		//echo "registered";
		echo "<div class='error' style='display:none'>Exam already registered</div>";  
	}
	$log->info("****END exam_register_check.php****");
?>