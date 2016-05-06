<?php
	// this page is to generate xml for the first page of create exam
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 18-04-2016
	
	//function for db conn and session check
    include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('xsd_to_xml.php');
	$log->debug("****START -xsd_to_xml.php****");
	session_start();
	if (isset($_SESSION["user"])){
		$organisation=$_SESSION['organisation'];
		$sector=$_SESSION["sector"];
		$qp=$_SESSION["qp"];
		$exam_name=$_SESSION["exam_name"];
		$exam_description=$_SESSION["exam_description"];
		$exam_time = $_SESSION["exam_name"];
		$exam_level = $_SESSION["exam_name"];
		$pass_percentage = $_SESSION["pass_percentage"];
		$nos_code=$_SESSION["nos_code"];
		$checked_pc=$_SESSION['checked_pc'];
		$selected_q =$_POST["question"];
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	//******Sql queries needed to get qp_id and nos_name
	// query to get qp id
	$qp_query = "SELECT qp_code
				FROM t_qp
				WHERE qp_name = '{$qp}'";
	$result = mysqli_query($connection,$qp_query);
	$row = mysqli_fetch_assoc($result);
	$qp_code = $row["qp_code"];

	//query to get nos name 
	$nos_query ="SELECT nos_name
				FROM t_nos
				WHERE nos_code = '{$nos_code}'";
	$result = mysqli_query($connection,$nos_query);
	$row = mysqli_fetch_assoc($result);
	$nos_name = $row["nos_name"] ;


	$xml = new DOMDocument("1.0","UTF-8");
	$xml->formatOutput=true;

	$myskillindex = $xml->createElement("myskillindex");
	$myskillindex = $xml->appendChild($myskillindex);

	$org = $xml->createElement("org",$organisation);
	$org = $myskillindex->appendChild($org);

	$sector = $xml->createElement("sector",$sector);
	$sector = $myskillindex->appendChild($sector);

	$examId = $xml->createElement("examId");
	$examId = $myskillindex->appendChild($examId);

	$examName = $xml->createElement("examName",$exam_name);
	$examName = $myskillindex->appendChild($examName);

	$examDesc = $xml->createElement("examDesc",$exam_description);
	$examDesc = $myskillindex->appendChild($examDesc);

	$examDuration = $xml->createElement("examDuration",$exam_time);
	$examDuration = $myskillindex->appendChild($examDuration);

	$examSkillLevel = $xml->createElement("examSkillLevel",$exam_level);
	$examSkillLevel = $myskillindex->appendChild($examSkillLevel);

	$examPassPercentage = $xml->createElement("examPassPercentage", $pass_percentage);
	$examPassPercentage = $myskillindex->appendChild($examPassPercentage);

	$QP = $xml->createElement("QP");
	$QP = $myskillindex->appendChild($QP);

	$qpName = $xml->createElement("qpName",$qp);
	$qpName = $QP->appendChild($qpName);

	$qpCode = $xml->createElement("qpCode",$qp_code);
	$qpCode = $QP->appendChild($qpCode);

	$nos = $xml->createElement("nos");
	$nos = $QP->appendChild($nos);

	$nosName = $xml->createElement("nosName",$nos_name);
	$nosName = $nos->appendChild($nosName);

	$nosCode = $xml->createElement("nosCode",$nos_code);
	$nosCode = $nos->appendChild($nosCode);

	$nosWeightage = $xml->createElement("nosWeightage");
	$nosWeightage = $nos->appendChild($nosWeightage);

	$pc = $xml->createElement("pc");
	$pc = $nos->appendChild($pc);

	$questionvalues = implode("','",$selected_q);

	if(!empty($checked_pc)){
		$N = count($checked_pc);
		for($i=0;$i<$N;$i++){
			$pc_name = $checked_pc[$i];

			$pcName = $xml->createElement("pcName",$pc_name);
	    	$pcName = $pc->appendChild($pcName);

	    	$pc_query ="SELECT pc_id
						FROM t_pc
						WHERE pc_name = '{$pc_name}'";
			$result = mysqli_query($connection,$pc_query);
			$row = mysqli_fetch_assoc($result);
			$pc_id = $row["pc_id"];

			$pcId = $xml->createElement("pcId",$pc_id);
			$pcId = $pc->appendChild($pcId);

			$pcWeightage = $xml->createElement("pcWeightage");
			$pcWeightage = $pc->appendChild($pcWeightage);

			$question = $xml->createElement("questions");
			$question = $pc->appendChild($question);

			$q_query = "SELECT qid
						FROM r_pc_q
						WHERE pc_id = '{$pc_id}' 
						AND qid IN ('".$questionvalues."')";
			$result = mysqli_query($connection,$q_query);
			while($row = mysqli_fetch_assoc($result)){

				$questionId = $xml->createElement("questionId", $row["qid"]);
				$questionId = $question->appendChild($questionId);
			}
		}
	}
	// file name should be like - userid_GUID_e.xml
	$user_name = $_SESSION['user'];
	$guid = com_create_guid();
	$file_name = $user_name."_".$guid."_e.xml";
	$log->debug("****file_name:$file_name****");

	// pass the file name to the process called saveExamDB.php
	$_SESSION['Filename'] = $file_name;

	// save thisxml in to a .xml file in the folder called tmp
	$xml->save('../../tmp/'.$file_name);
	header('Location:saveExamDB.php');
	$log->debug("****END-xsd_to_xml.php****");

?>