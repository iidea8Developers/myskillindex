<?php 
    //Delete the registered exam  
    // created by:  vivek kumar
    // created on:  05-04-2016
    // modified by: jitendra dayma
    // modified on: 23-05-2016
	// modification : redesign whole code 

	session_start();
	include_once("../../service/common/db_connection.php");
	include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');

	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('delete_exam.php');

	$log->info("****START delete_exam.php****");

	if(isset($_POST["exam_id"]) && isset($_POST['token']) && isset($_POST['survey_id'])) {
		$aTokenIDs=array($_POST['token']);
		$iSurveyID=$_POST['survey_id'];
		$exam_id=$_POST['exam_id'];
		$exam_token = $_POST['token'];
		
		// without composer this line can be used
	    include_once("../../lib/jsonrpcphp/JsonRPCClient.php");

        //Get Session parameters and delete participant from limesurvey database
 	    $myJSONRPCClient = new JsonRPCClient( LS_BASEURL );
	    $sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
	    $deleted_user = $myJSONRPCClient->delete_participants($sessionKey,$iSurveyID, $aTokenIDs);
        //$log->debug($deleted_user);
        //$log->debug($deleted_user[$exam_token]);

		//to delete user from myskillindex database
		if($deleted_user[$exam_token]=='Invalid token ID'){
			$query="DELETE FROM t_candidate_exam 
			  		WHERE exam_id = '{$exam_id}' AND exam_token = '{$exam_token}' ";
			$result = mysqli_query($connection,$query);
			if($result){
			  	echo "success";
			}
		} 
		$myJSONRPCClient->release_session_key($sessionKey ); 	
	}
	mysqli_close($connection);
	$log->info("****END delete_exam.php****");
?>