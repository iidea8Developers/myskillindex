<?php

session_start();
include_once('../../service/common/db_connection.php');
include_once('../../lib/log4php/Logger.php');
include_once('../../service/common/common_error.php');
Logger::configure('../../config/log_config.xml');
$log = Logger::getLogger('upcoming_controller.php');

$log->debug("***** START upcoming_controller.php");
       try 
       {
			
				
						$query = "SELECT tc.registration_date,
										 tc.exam_id,
										 tc.exam_token,
										 tes.survey_id, 
										 tes.survey_link, 
										 te.exam_name,
										 te.exam_time
				           		   FROM t_exam_survey tes,
				           		   		t_exam_org_qp te,
				           		   		t_candidate_exam tc 
						   		   WHERE tes.exam_id = te.exam_id
						   		   AND te.exam_id=tc.exam_id
						   		   AND tc.candidate_id='{$_SESSION['id']}'
						   		   AND tc.exam_date is null " ;
						$result=mysqli_query($connection,$query);
						$rowcount=mysqli_num_rows($result);
			if($rowcount == 0){
			echo '<tr><td><i>Looks like you have not registered for a Exam ....</td><td></td><td></td><td ></td></tr>';
			} 
			else 
			{
			
						while ($row=mysqli_fetch_assoc($result))
							{		
									$token = $row['exam_token'];
									$survey_id = $row['survey_id'];
									$regon = $row['registration_date'];
			       					$exam_id= $row['exam_id'];
			              			$survey_link= $row['survey_link'];
								    		echo '<tr id="qbank_'.$exam_id.'">
												<td>' .$row['exam_name'].'</td>
												<td>'.$regon.'</td>
												<td>'.$row['exam_time'].'</td>';
												echo '<td ><a href="end_date.php?link='.$survey_link.'"><font>Take now</font></a></td>
												<td><span class="glyphicon glyphicon-remove" id="del.'.$exam_id.'.'.$token.'.'.$survey_id.'" onclick="cancel_exam(this)"></span></td>
											</tr>';
							}//end of while loop
					
				} // end of else condition
        	} // end of try
			catch (Exception $e)
		       {
	             $log->error("error in sql query 1: ".$query);								
	             $log->error($e->getMessage());
	                             
	             $error_header_php="Error retrieving exam details." ;
	             $error_message_php="Error in retrieving your upcoming exam details. Please try after some time. If the error persists, please contact hello@iidea8.com";

	             custom_error($error_header_php,$error_message_p);
	            }			
    $log->debug("***** END upcoming_controller.php"); 
    $connection->close();  
    return;     
?>

