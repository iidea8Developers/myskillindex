<?php 
    //Delete the registered exam  
    // created by:  vivek kumar
    // created on:  05-04-2016
    // modified by: vivek kumar

    // modified on: 08-04-2016

    // modified on: 12-04-2016


	session_start();
	include_once("../../service/common/db_connection.php");
	include_once('../../config/config.txt');
	include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');

	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('delete_exam.php');

	$log->info("****START delete_exam.php****");
  	$id=$_GET["id"];

	//$id = mysql_escape_string($id);
	if(isset($_GET["token"])) {
		$aTokenIDs=array($_GET['token']);
		$iSurveyID=$_GET['survey_id'];
		$exam_id=$_GET['exam_id'];
		// without composer this line can be used
	    include_once("../../lib/jsonrpcphp/JsonRPCClient.php");

        //Get Session parameters
 	    $myJSONRPCClient = new JsonRPCClient( LS_BASEURL );
	    $sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
	    $deleted_user = $myJSONRPCClient->delete_participants($sessionKey,$iSurveyID, $aTokenIDs);
        $log->debug($deleted_user);

		$myJSONRPCClient->release_session_key($sessionKey );

		$query="DELETE FROM t_candidate_exam WHERE exam_id = $exam_id AND exam_token = $_GET['token'] ";
    	mysqli_query($connection,$query);
    	$log->info("****END delete_exam.php****");
	}
	mysqli_close($connection);
?>