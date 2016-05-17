
<?php
/* Usage: Code to display exam details while registering for an exam and call dashbord.php function showuser3
Updated By PP on 29/04/2016
*/
session_start();
include_once('../../service/common/db_connection.php');
include_once('../../lib/log4php/Logger.php');
include_once('../../service/common/common_error.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('exam_detail.php');

	$log->info("****START exam_detail.php****");


 $q = $_GET['q'];
  $query = "SELECT exam_id,exam_name,exam_desc,org_code,qp_code,exam_time 
  			FROM t_exam_org_qp 
  			WHERE exam_name = '{$q}' ";
  	$result = mysqli_query($connection,$query);
	$row = mysqli_fetch_assoc($result);
 
  
 $exam_id = $row['exam_id'];
 $exam_name = $row['exam_name'];
 $exam_desc = $row['exam_desc'];
 $org_code = $row['org_code'];
 $qp_code = $row['qp_code'];
 $exam_time = $row['exam_time']." Minutes";
  
    
  try{
		$query= " SELECT org_name FROM t_org WHERE org_code='{$org_code }' " ;
		$result = mysqli_query($connection,$query);
		if(!$result){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");

		}
		while ($row= mysqli_fetch_assoc($result))
		{
			$org_name = $row['org_name'];

		}
		}catch(Exception $e){
		header("Location: ../../service/common/error_page.php");
	}	
	//get qp code
	try{
		$query= " SELECT qp_name 
				  FROM t_qp 
				  WHERE qp_code='{$qp_code}' " ;
		$result = mysqli_query($connection,$query);
		if(!$result){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
		}
		while ($row= mysqli_fetch_assoc($result))
		{
			$qp_name = $row['qp_name'];
			
		}}catch(Exception $e){
		//header("Location: ../../service/common/error_page.php");
		$log->error("Exception caught : " . $e->getmessage() );
	}	

	
  echo '<hr>';
  
	echo'<div class=row><div class=col-md-6><h4 style="text-align: right"><strong>Exam Name :</strong></h4></div><div class=col-md-4><h5 style="text-align: left">'. $exam_name.'</h5></div></div>';
	echo'<div class=row><div class=col-md-6><h4 style="text-align: right"><strong>Description :</strong></h4></div><div class=col-md-4><h5><h5 style="text-align: left">'. $exam_desc.'</h5></div></div>';
	echo'<div class=row><div class=col-md-6><h4 style="text-align: right"><strong>Time :</strong></h4> </div><div class=col-md-4><h5><h5 style="text-align: left">'. $exam_time.'</h5></div></div>';
	echo'<div class=row><div class=col-md-6><h4 style="text-align: right"><strong>Organisation Name :</strong></h4> </div><div class=col-md-4><h5><h5 style="text-align: left">'. $org_name.'</h5></div></div>';
	echo'<div class=row><div class=col-md-6><h4 style="text-align: right"><strong>Qualification Packs :</strong> </h4></div><div class=col-md-4><h5><h5 style="text-align: left">'. $qp_name.'</h5></div></div>';
	
	echo '<hr style="margin-top:4px;">';

 echo 
 '<center>
 <div class="btn-group" style="margin-top:-22px">
	 <button class="btn btn-success btn-sm" onclick="showUser3(this.value)" name="'.$exam_name.'"  value="'.$exam_name.'" style="width:100px;margin-right:5px">Register</button>
			
      </div>
      
     </center>'
	;
	$log->info("****END exam_detail.php****");
	mysqli_close($connection);
?>
