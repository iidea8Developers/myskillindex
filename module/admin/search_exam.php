<?php 
	//modified by : Jitendra and pranab
    // modified on: 08-04-2016
	//this page search the exam from already prepared exam
	//db conn and session check

	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('search_exam.php');
	$log->debug("****START -search_exam.php****");
	include_once('../../service/common/db_connection.php');
	session_start();
 	error_reporting(0);
	
	
	$log->INFO("USER ".$_SESSION["user"]."  SESSION ID ".session_id());
	if ((isset($_SESSION["user"]))){
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	
	if(isset($_POST['search_qp']))
	{
		$qp_name=$_POST['search_qp'];
	}else
	{
		$qp_name="";
	}
	
	if(isset($_POST['search_org']))
	{
		$org_name=$_POST['search_org'];
	}else
	{
		$org_name="";
	}
	
	if(isset($_POST['search_exam']))
	{
		$exam_name=$_POST['search_exam'];
	}else
	{
		$exam_name="";
	}
	
	$org_code="";
	$qp_code="";
	
	try{
		$sql = "select org_code FROM t_org WHERE org_name ='{$org_name}' ";
		
		$result1 = mysqli_query($connection,$sql);
		if(!$result1){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
		}
		
		while ($row = mysqli_fetch_assoc($result1)) {
			
			$org_code= $row['org_code'];
			
			
		}}catch(Exception $e){
		header("Location: ../../service/common/error_page.php");
	}
	
	try{
		$sql = "select qp_code FROM t_qp WHERE qp_name ='{$qp_name}' ";
		
		$result2 = mysqli_query($connection,$sql);
		if(!$result2){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
		}
		
		while ($row = mysqli_fetch_assoc($result2)) {
			
			$qp_code= $row['qp_code'];
			
			
		}}catch(Exception $e){
		header("Location: ../../service/common/error_page.php");
	}
	
	try{
		
		$sql = "select * from t_exam_org_qp where (exam_name  LIKE '%$exam_name%') or (qp_code  LIKE '$qp_code') or (org_code  LIKE '$org_code') ";
		
		$result3 = mysqli_query($connection,$sql);
		if(!$result3){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
		}
		
		while ($row = mysqli_fetch_assoc($result3)) {
			
			$exam_name2= $row['exam_name'];
			$exam_name3= $row['exam_desc'];
			$exam_name4= $row['exam_time'];
			$exam_id= $row['exam_id'];
			
			$query = " select *  FROM t_exam_survey where exam_id = '{$exam_id}' ";
			$result4 = mysqli_query($connection21,$query);
			$row4 = mysqli_fetch_assoc($result4);
			$exam_link= $row4['survey_link'];
			
			echo'
			<style>
			.tim{
			width: 30px;
			height: 30px;
			background-image: url(image/delete_b.png);
			background-repeat: no-repeat;
			background-color: #ffffff;
			}
			
			.tim2{
			width: 30px;
			height: 30px;
			background-image: url(image/exam.png);
			background-repeat: no-repeat;
			background-color: #ffffff;
			}
			</style>
			<div class="container" >
			<form  action ="delete_exam.php" method="post" id="form" >
			<div class="table-responsive" >
			<table class="table table-bordered table-stripped" style="background-color:#ffffff">
			<div class="row" >
			<th class="col-md-4"><font ccolor="#3b5998"><input type="text" readonly value="'.$exam_name2.'" id="img2"   name="img2" style="border-width:0px; 
			border:none;background-color : #ffffff;color: #3b5998; font-size:16px;" name="img"  ></font></th>
			
			<th class="col-md-4"><font color="#3b5998" style="font-size:16px;text-transform:none;">'.$exam_name3.'</font></th>
			
			
			<th class="col-md-2"><font color="#3b5998" style="font-size:16px;text-transform: capitalize;">'.$exam_name4.' Minutes</font></th>
			<th class="col-md-2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="tim" type="button" value="" onClick="confSubmit(this.form);"></th>
			</table>
			</div>
			</form>
			</div>
			';
		}}catch(Exception $e){
		header("Location: ../../service/common/error_page.php");
	}
	mysqli_close($connection);
	$log->debug("********END search_exam *********");	
?>