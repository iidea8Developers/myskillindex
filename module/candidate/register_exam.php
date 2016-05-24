<?php
// This code is used to show upcoming exams as well as upload information in DB for upcoming exams
// Last Modified on:22-03-2016
// Last Modified Date: 22-03-2016
		
session_start();

	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('register_exam.php');

	$log->info("****START resister_exam.php****");

//error_reporting(E_ALL);
    
if(isset($_GET['exam_name']))
    {
        // Get exam id from DB for exam name passed and assign it to exam_id variable
		    $exam_name = $_GET['exam_name'];
        $log->debug($exam_name);
	      $sql ="SELECT exam_id
                FROM t_exam_org_qp 
                WHERE exam_name= '{$exam_name}' ";
	      $result = mysqli_query($connection,$sql);
	      while($row=mysqli_fetch_assoc($result))
	      	  {
	             $exam_id = $row['exam_id'];
                $log->debug($exam_id);			 
			      }
	      //	$_session['id'] = candidate_id		
        // GET survey_id for the exam
			  $query = "SELECT survey_id 
					        FROM t_exam_survey 
					        WHERE exam_id= '{$exam_id}' ";
         $result2=mysqli_query($connection,$query);
         $row=mysqli_fetch_assoc($result2);
         $survey_id=$row['survey_id'];
         
         // without composer this line can be used
	      include_once("../../lib/jsonrpcphp/JsonRPCClient.php");

        //Get Session parameters
 	    $myJSONRPCClient = new JsonRPCClient( LS_BASEURL );
	    $sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

        $aParticipantData = array(
            'user'=>array('firstname'=>$_SESSION['f_name'],
                    'lastname'=> $_SESSION['l_name'] ,
                    'email'=>$_SESSION['email'],
                    'language'=>'en',
                    'emailstatus'=>'ok'),
            );

        $added_user = $myJSONRPCClient->add_participants($sessionKey, $survey_id, $aParticipantData, 1);
        $log->debug($added_user);
        $user_token = $added_user['user']['token'];
        $log->debug($user_token);
        $query = "INSERT INTO t_candidate_exam 
                                    (exam_id ,
                                    candidate_id ,
                                    registration_date,
                                    exam_token )
                        VALUES ('{$exam_id}', '{$_SESSION['id']}', now(),'{$user_token}')";

  
        if ($connection->query($query) === TRUE) 
            {   
                // mail the info of test to user
                $email= $_SESSION['email'];
                $subject = "MySkillIndex - Registered for exam ";
                $msg = " Dear ".$_SESSION['name'].",
                You have reegistered for exam named as ".$exam_name." on myskillindex.com.
                Your token for this exam is : ".$user_token.". ";

                mail($email,$subject,$msg);
                $log->debug("New record for exam is created successfully and information is mailed to user");
            } 
           else 
            {
                $log->error( "Error: " . $query . "<br>" . $connection->error);
            };


            $myJSONRPCClient->release_session_key($sessionKey );
        mysqli_close($connection);
        $log->info("****END resister_exam.php****");    
 	}
 ?>

 











												