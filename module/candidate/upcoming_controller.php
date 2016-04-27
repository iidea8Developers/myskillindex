<?php

session_start();
include_once('../../service/common/db_connection.php');
include_once('../../config/config.txt');
include_once('../../lib/log4php/Logger.php');
include_once('../../service/common/common_error.php');
Logger::configure('../../config/log_config.xml');
$log = Logger::getLogger('upcoming_controller.php');

$log->debug("***** START upcoming_controller.php");
       try {
			$query = "SELECT * 
					  FROM t_candidate_exam 
					  WHERE candidate_id = '{$_SESSION['id']}'
					  AND exam_date is null " ;
			$result=mysqli_query($connection,$query);
			while ($row=mysqli_fetch_assoc($result))
				{   $regon = $row['registration_date'];
			        $exam_id= $row['exam_id'];
					$query2 = "SELECT * 
					           FROM t_exam_survey 
							   WHERE exam_id = '{$exam_id}'" ;
							   $result2=mysqli_query($connection,$query2);
								while ($row2=mysqli_fetch_assoc($result2))
								{
			               			$survey_link= $row2['survey_link'];
									$query3 = "SELECT * 
												FROM t_exam_org_qp 
												WHERE exam_id = '{$exam_id}' " ;
										$result3=mysqli_query($connection,$query3);
										while ($row3=mysqli_fetch_assoc($result3))
											{ 
											//if($i%2 == 0 ){$class="warning";}
											//else if($i%3 == 0 ){$class="info";}
											//else if($i%4 == 0 ){$class="success";}
											//else if($i%5 == 0 ){$class="active";}
											//else {$class="danger";}
											echo '<tr id="qbank_'.$row3['exam_id'].'">
												<td>' .$row3['exam_name'].'</td>
												<td>'.$regon.'</td>
												<td>'.$row3['exam_time'].'</td>';
												echo '<td ><a href="end_date.php?link='.$survey_link.'"><font>Take now</font></a></td>
												<td><span class="glyphicon glyphicon-remove" id="del_'.$row3["exam_id"].'" onclick="cancel_exam(this);cancel_exam_front(this)"></span></td>
											</tr>';
											//++$i;
											}

										
								}
				}
			    						
				$rowcount=mysqli_num_rows($result);
				if($rowcount == 0){
				echo '<tr><td><i>Looks like you have not registered for a Exam ....</td><td></td><td></td><td ></td></tr>';
				} else {}
        	}
			catch (Exception $e)
		       {
	             $log->error("error in sql query 1: ".$query);					
	             $log->error("error in sql query 2: ".$query2);					
	             $log->error("error in sql query 3: ".$query3);					
	             $log->error($e->getMessage());
	                             
	             $error_header_php="Error retrieving exam details." ;
	             $error_message_php="Error in retrieving your upcoming exam details. Please try after some time. If the error persists, please contact admin@iidea8.com";

	             custom_error($error_header_php,$error_message_p);
	            }			
    $log->debug("***** END upcoming_controller.php"); 
    $connection->close();  
    return;     
?>

