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

	
	$doc = new DOMDocument();
	$doc->load("../../lib/XML schema/create_exam_xml_schema.xsd");
	$xpath = new DOMXPath($doc);
	$xpath->registerNamespace('xs', 'http://www.w3.org/2001/XMLSchema');
	function echoElements($indent, $elementDef) {
       	global $doc, $xpath;
       	echo "<div>" . $indent . $elementDef->getAttribute('name') . "</div>\n";
  		$elementDefs = $xpath->evaluate("xs:complexType/xs:sequence/xs:element", $elementDef);
  		foreach($elementDefs as $elementDef) {
    		echoElements($indent . "&nbsp;&nbsp;&nbsp;&nbsp;", $elementDef);
  		}
	}

	$elementDefs = $xpath->evaluate("/xs:schema/xs:element");
	foreach($elementDefs as $elementDef) {
  	echoElements("", $elementDef);
	} 
    

	$log->debug("****END-xsd_to_xml.php****");
?>