<?php
	// this page is to generate xml for second page of create exam
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 03-05-2016
	
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
		$file_name=$_SESSION['filename'];

		// substring the GUID from the file name
		
		// log file name and GUID
		// load file in to an XML DOM object using 

		/*<?php 

    /*** create a SimpleXML object **/
    if( ! $xml = simplexml_load_file('userid_GUID_e.xml') ) 
    { 
        echo "Unable to load XML file"; 
    }else
    {
	
    } 

	}
	catch(exception $e){

	}
    


	$log->debug("****END- saveExamDB.php****");
?>