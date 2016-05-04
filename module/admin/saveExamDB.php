<?php
	// this page is to save exam in DB
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 29-04-2016
	
	//function for db conn and session check
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('saveExamDB.php');
	$log->debug("****START - saveExamDB.php****");
	session_start();
	if (isset($_SESSION["user"])){
		
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}

	try{
		// get the file name = userid_GUID_e.xml
		// substring the GUID from the file name
		// log file name and GUID
		// load file in to an XML DOM object using 

		/*<?php 

    /*** create a SimpleXML object **
    if( ! $xml = simplexml_load_file('userid_GUID_e.xml') ) 
    { 
        echo "Unable to load XML file"; 
    } 
    else 
    { 
        echo $xml->Myskillindex[1]->org;
        echo $xml->Myskillindex[1]->exam_name; 
        echo $xml->Myskillindex[1]->sector;

        // insert in DB exam
        //
        /* 
Create Exam

INSERT INTO `t_exam_org_qp` 
(`exam_id`, `exam_desc`, `org_code`, `qp_code`, `Exam_skill_level`, `exam_time`, `created_by`, `modified_by`, `created_time`, `modified_time`, `exam_name`, `exam_pass_percentile`) 
VALUES(001, 'General Awareness 001', '1', 'MSI / QG 0001', 'level 2', 30, 'root', 'root', now(), now(), 'General Awareness 001', 60);

INSERT INTO `t_exam_nos_pc` 
(`exam_id`, `nos_code`, `nos_weightage`, `pc_id`, `pc_weightage`, `created_by`, `modified_by`, `created_time`, `modified_time`) 
VALUES(001, 'MSI/ G 0001', 0, 56, 0, 'root', 'root', now(), now());

INSERT INTO `r_exam_que` (`exam_id`, `qid`, `created_by`, `modified_by`, `created_time`, `modified_time`) VALUES(001, 406 , 'root', 'root', now(), now());
INSERT INTO `r_exam_que` (`exam_id`, `qid`, `created_by`, `modified_by`, `created_time`, `modified_time`) VALUES(001, 407 , 'root', 'root', now(), now());
INSERT INTO `r_exam_que` (`exam_id`, `qid`, `created_by`, `modified_by`, `created_time`, `modified_time`) VALUES(001, 408 , 'root', 'root', now(), now());

INSERT INTO `t_exam_survey` (`survey_link`, `survey_id`, `exam_id`, `created_by`, `modified_by`, `created_time`, `modified_time`) VALUES('http://52.39.26.22/limesurvey/index.php/275875?lang=en', 275875, 001, 'root', 'root', now(), now());

 ************************ END Exam creation in MSI ********************************************* */ 
    } */

?> 



	}
	catch {}


	$log->debug("****END- saveExamDB.php****");
?>