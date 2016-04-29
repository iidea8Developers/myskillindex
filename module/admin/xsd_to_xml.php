<?php
	// this page is to 
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 18-04-2016
	
	//function for db conn and session check
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('xsd_to_xml.php');
	$log->debug("****START -xsd_to_xml.php****");
	session_start();
	if (isset($_SESSION["user"])){
		$organisation=$_POST["org"];
		$sector=$_POST["sector"];
		$qp=$_POST["qp"];
		$exam_name=$_POST["name_of_exam"];
		$exam_description=$_POST["desc"];
		$exam_time = $_POST["time"];
		$exam_level = $_POST["skill_level"];
		$pass_percentage = $_POST["percent"];
		$nos=$_POST["nos"];
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}

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

	$qpId = $xml->createElement("qpId");
	$qpId = $QP->appendChild($qpId);

	$nos = $xml->createElement("nos");
	$nos = $QP->appendChild($nos);

	$nosName = $xml->createElement("nosName");
	$nosName = $nos->appendChild($nosName);

	$nosId = $xml->createElement("nosId");
	$nosId = $nos->appendChild($nosId);

	$nosWeightage = $xml->createElement("nosWeightage");
	$nosWeightage = $nos->appendChild($nosWeightage);

	$pc = $xml->createElement("pc");
	$pc = $nos->appendChild($pc);

	$pcName = $xml->createElement("pcName");
	$pcName = $pc->appendChild($pcName);

	$pcId = $xml->createElement("pcId");
	$pcId = $pc->appendChild($pcId);

	$pcWeightage = $xml->createElement("pcWeightage");
	$pcWeightage = $pc->appendChild($pcWeightage);

	echo "<xmp>".$xml->saveXML()."</xmp>";
	
	// save thisxml in to a .xml file in the folder called tmp
	// file name should be like - userid_GUID_e.xml
	// pass the file name to the process called saveExamDB.php


	/*this section will create xml file in location entered in save() function.
	$doc->formatOutput=true;
	$string_value = $doc->saveXML();
	$doc->save("Exam.xml");*/
	
	$log->debug("****END-xsd_to_xml.php****");
?>