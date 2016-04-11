<?php	
	// this page is used by  create_exam.php to create new assessment
	// page created by prakash shukla
	// modified by: Jitendra Dayma
	// modified on: 11-04-2016

	//function for db conn and session check
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('insert_exam_nos.php');
	$log->debug("****START -insert_exam_nos.php****");
	include_once('../../service/common/db_connection.php');
	session_start();
	if (isset($_SESSION["user"])){
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	
	$log->INFO("First page: Create Exam ---- USER: ".$_SESSION["user"]."  SESSION ID: ".session_id());
	
	
	
	if(isset($_POST["org"])){
		$_SESSION["org"] = $_POST["org"];
	}else
	{
		$_POST["org"]="Not set";
	}
	if(isset($_POST["sector"])){
		$_SESSION["sector"] = $_POST["sector"];
	}else
	{
		$_POST["sector"]="Not set";
		}if(isset($_POST["qp"])){
		$_SESSION["qp"] = $_POST["qp"];
	}else
	{
		$_POST["qp"]="Not set";
		}if(isset($_POST["time"])){
		$_SESSION["time"] = $_POST["time"];
	}else
	{
		$_POST["time"]="Not set";
		}if(isset($_POST["skill"])){
		$_SESSION["skill"] = $_POST["skill"];
	}else
	{
		$_POST["skill"]="Not set";
		}
	if(isset($_POST["desc"])){
		$_SESSION["desc"] = $_POST["desc"];
	}else
	{
		$_POST["desc"]="Not set";
	}
	if(isset($_POST["exam"])){
		$_SESSION["exam"] = $_POST["exam"];
	}else
	{
		$_POST["exam"]="Not set";
	}
	if(isset($_POST["desc"])){
		$_SESSION["desc"] = $_POST["desc"];
	}else
	{
		$_POST["desc"]="Not set";
	}
	if(isset($_POST["nos"])){
		echo "nos is set ";
		echo $_POST["nos"];
	}else
	{
		$_POST["nos"]="Not set";
	}
	if(isset($_POST["total_marks"])){
		
		echo $_POST["total_marks"];
	}else
	{
		$_POST["total_marks"]=0;
		echo $_POST["total_marks"];
	}
	
	if(isset($_POST["percent"])){
		$_SESSION["percent"] = $_POST["percent"];
	}else
	{
		$_POST["percent"]="Not set";
	}
	
	//get org code
	try{
		$query="SELECT org_code 
				FROM t_org 
				WHERE org_name='{$_SESSION["org"]}' " ;
		$result = mysqli_query($connection,$query);
		if(!$result){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
			echo "org query failed";
		}
		while ($row= mysqli_fetch_assoc($result))
		{
			$org_code = $row['org_code'];
			//echo $org_code."this is org";
		}
		/*}catch(Exception $e){
		header("Location: ../../service/common/error_page.php");
	}	
	//get qp code
	try{*/
		$query="SELECT qp_code 
				FROM t_qp 
				WHERE qp_name='{$_SESSION["qp"]}' " ;
		$result = mysqli_query($connection,$query);
		if(!$result){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
		}
		while ($row= mysqli_fetch_assoc($result))
		{
			$qp_code = $row['qp_code'];
			//echo $qp_code."this is qp";
		}
		/*}catch(Exception $e){
		//header("Location: ../../service/common/error_page.php");
		echo "Exception caught ";
	}	
	//get nos name
	try{*/
		$query="SELECT nos_name 
				FROM t_nos 
				WHERE nos_code='{$_POST["nos"]}' " ;
		$result = mysqli_query($connection,$query);
		if(!$result){
			throw new exception($connection->error);
			$log->ERROR("DATABASE QUERY FAILED ");
		}
		while ($row= mysqli_fetch_assoc($result))
		{
			$nos_name = $row['nos_name'];
			//echo $org_code."this is org";
		}
	}catch(Exception $e){
		//header("Location: ../../service/common/error_page.php");
		$log->error("$e->getmessage()");
	}	
	//insertion into t_exam_org_qp table
	$sql = "INSERT INTO t_exam_org_qp(exam_name,
		  							exam_desc,
		  							exam_pass_percentile,
		  							org_code,
		  							qp_code,
		  							exam_skill_level,
		  							exam_time,
		  							created_by,
		  							modified_by,
		  							created_time,
		  							modified_time)
								VALUES ('{$_SESSION["exam"]}','{$_SESSION["desc"]}', '{$_SESSION["percent"]}','{$org_code}','{$qp_code}', '{$_SESSION["skill"]}','{$_SESSION["time"]}','root','root',now(),now())";
	
	if ($connection->query($sql) === TRUE) {
		echo "New record created successfully";
		$last_id = $connection->insert_id;
		$_SESSION['exam_id']=$last_id ;
		//define("exam_loop", "1");
		echo "New record created successfully. Last inserted ID is: " . $last_id;
	}else {
		echo "Error: " . $sql . "<br>" . $connection->error;
		$log->ERROR("'Error: ' . $sql . '<br>' . $connection->error ");
		//	header("Location: ../../service/common/error_page.php");
	}
	
	//echo $nos_name;
	
	//insert into nos_pc relational table
	if( isset($_POST['checked']) && is_array($_POST['checked']) ) {
		foreach($_POST['checked'] as $pc) {
			// eg. "I have a grapefruit!"
			//echo "I have a {$pc}!";
			try{
				$sql2= "SELECT pc_id 
						FROM t_pc 
						WHERE pc_name = '{$pc}' ";
				$result = mysqli_query($connection,$sql2);
				if(!$result){
					throw new exception($connection->error);
					$log->ERROR("DATABASE QUERY FAILED ");
				}
				while ($row= mysqli_fetch_assoc($result)){
					$pc_id= $row['pc_id'];
					
				}
			}catch(Exception $e){
				//header("Location: ../../service/common/error_page.php");
				$log->error("$e->getmessage()");
			}	
			echo $_POST["nos"];
			$pc_query="INSERT INTO t_exam_nos_pc (exam_id,
												nos_code,
												nos_weightage,
												pc_id,
												pc_weightage,
												created_by,
												modified_by,
												created_time,
												modified_time)
											VALUES ('{$_SESSION['exam_id']}','{$_POST["nos"]}','0','{$pc_id}','0','{$_SESSION["user"]}','{$_SESSION["user"]}',NOW(),'NULL')";
			if ($connection->query($pc_query) === TRUE) {
				echo "New record created successfully";
				header('Location: create_exam.php');
				//echo "New record created successfully. Last inserted ID is: " . $last_id;
			} else {
				echo "Error: " . $pc_query . "<br>" . $connection->error;
				//header('Location: author_exams.php');
				$log->ERROR("DATABASE QUERY FAILED ");
				//header("Location: error_page.php");
			}
		}
	}
	mysqli_close($connection);
	$log->debug("****END -insert_exam_nos.php****");
?>	