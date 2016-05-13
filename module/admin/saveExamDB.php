<?php
	// this page is to save exam in DB
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 09-05-2016
	
	//function for db conn and session check
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('saveExamDB.php');
	$log->debug("**** START - saveExamDB.php ****");
	session_start();
	if (isset($_SESSION["user"])){
		
		// get the file name = userid_GUID_e.xml
		$Filename = ($_SESSION['Filename']);
		
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	 

	try{
		// substring the GUID from the file name
			$file_name=explode("_", $Filename);
			$GUID = $file_name[1];
		// log file name and GUID

			$log->INFO('filename:'.$Filename.'  GUID:'.$GUID);

		// load file in to an XML DOM object using 
		// begin transaction
    		mysqli_begin_transaction($connection);
    	
    	// stop autocommit
    		mysqli_autocommit($connection, FALSE);

		//create a SimpleXML object 
	  	$xml = simplexml_load_file('../../tmp/'.$Filename);
	  		        if(!$xml){
        	$log->debug("Unable to load XML file ".$Filename." . Please contact system admin.");
        }else
        { 
    		$user = $_SESSION["user"];
    		$org_code = $xml->org;
	        $sector = $xml->sector;
	        $exam_name = $xml->examName;
	        $exam_desc = $xml->examDesc;
	        $exam_time = $xml->examDuration;
	        $exam_skill = $xml->examSkillLevel;
	        $exam_pass_percentage = $xml->examPassPercentage;
	        $qp_code = $xml->QP->qpCode;

	        	// Insert exam realtion with QP. This will give the exam id for the new exam
				$query = "INSERT INTO t_exam_org_qp 
											(exam_desc,
											org_code,
											qp_code,
											Exam_skill_level,
											exam_time,
											created_by,
											modified_by,
											created_time,
											modified_time,
											exam_name,
											exam_pass_percentage) 
							VALUES('$exam_desc', '$org_code', '$qp_code', '$exam_skill', '$exam_time', '$user', '$user', now(), now(), '$exam_name', '$exam_pass_percentage')";
					//$log->debug($query);
					$result =mysqli_query($connection,$query);
					if($result == FALSE)
						{
							throw new Exception($result);
						}
					$exam_id = mysqli_insert_id($connection);// Gets the last exam_id

			// Exam can have more than one Nos. Below code needs update to accomodate more than one NOS
	        $nos_code = $xml->QP->nos->nosCode;
		    foreach($xml->QP->nos->pc->pcId as $pc_id){
		        	
					$query = "INSERT INTO t_exam_nos_pc 
											(exam_id,
											nos_code,
											nos_weightage,
											pc_id,
											pc_weightage,
											created_by,
											modified_by,
											created_time,
											modified_time) 
								VALUES('$exam_id', '$nos_code', 1, '$pc_id', 1, '$user', '$user', now(), now())";
					$result = mysqli_query($connection,$query);
					if($result == FALSE)
						{
							throw new Exception($e);
						}
					foreach($xml->QP->nos->pc->questions->questionId as $questionId){
		        		$query = "INSERT INTO r_exam_que 
		        								(exam_id,
		        								qid,
		        								created_by,
		        								modified_by,
		        								created_time,
		        								modified_time) 
		        					VALUES($exam_id, '$questionId' , '$user', '$user', now(), now())";
						$result =mysqli_query($connection,$query);
						if($result == FALSE)
										{
											throw new Exception($result);
										}
						}// close for each question
				} // close for each PC
				mysqli_commit($connection);
				
			} // end of else for xml is ok

   }
	catch(exception $e){
		mysqli_rollback($connection);
		$log->debug($e->getMessage());
		//$log->debug("****rollback called****");

	}
	
	$log->debug("****END- saveExamDB.php****");
	header('Location: createlss.php');
?>