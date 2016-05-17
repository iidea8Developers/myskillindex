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

error_reporting(E_ALL);
    
if(isset($_GET['q']))
     {
        
	// Get exam id from DB for exam name passed and assign it to exam_id variable
		$exam_name = $_GET['q'];
	    $sql ="SELECT exam_id
                FROM t_exam_org_qp 
                WHERE exam_name= '{$exam_name}' ";
	    $result = mysqli_query($connection,$sql);
	    while($row=mysqli_fetch_assoc($result))
	      	{
	         $exam_id = $row['exam_id'];
			 //echo $exam_id;
			}
	//	$_session['id'] = candidate_id		
	// Insert candidate to exam relation in t_candidate_exam table
	      $sql = "INSERT INTO t_candidate_exam 
                            (exam_id ,
                             candidate_id ,
                             registration_date )
	              VALUES ('{$exam_id}', '{$_SESSION['id']}', now())";
	
	      if ($connection->query($sql) === TRUE) 
			{
		        // write in log file for myskill index
				$log->debug("New record created successfully");
			} 
           else 
             {
          		  // write error in log file for myskillindex
				 $log->error( "Error: " . $sql . "<br>" . $connection->error);
             }
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

   	$name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $id=$_SESSION['id'];
	 
 	// sql to create table 
  //********Correct this - no tables are to be created in the PHP code
  //******** Add create table to the SQL DB scripts and correct below logic
	$sql=" CREATE TABLE IF NOT EXISTS `lime_tokens_".$survey_id."` 
          (	`tid` int(11) NOT NULL AUTO_INCREMENT,
	          `participant_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
	          `firstname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
	          `lastname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
	          `email` text COLLATE utf8_unicode_ci,
	          `emailstatus` text COLLATE utf8_unicode_ci,
	          `token` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
	          `language` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
	          `blacklisted` varchar(17) COLLATE utf8_unicode_ci DEFAULT NULL,
	          `sent` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
            `remindersent` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
            `remindercount` int(11) DEFAULT '0',
            `completed` varchar(17) COLLATE utf8_unicode_ci DEFAULT 'N',
            `usesleft` int(11) DEFAULT '1',
            `validfrom` datetime DEFAULT NULL,
            `validuntil` datetime DEFAULT NULL,
            `mpid` int(11) DEFAULT NULL,
           PRIMARY KEY (`tid`),
           KEY `idx_token_token_175735_20391` (`token`)
	        ) 
          ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ";
	
	      if ($connection->mysqli_query($sql) === TRUE) 
          {
	         "Table token created successfully";
		      } else {
	 	                "Error creating table: " . $connection->error;
                  }
//********** INSERT Token in Lime Survey Tables - Using Connection2 ********************************  

        $sql2 = " INSERT INTO limesurvey.lime_tokens_".$survey_id." 
                              (tid,
                               participant_id,
                               firstname,
                               lastname,
                               email,
                               emailstatus, 
                               token, 
                               language, 
                               blacklisted, 
                               sent, 
                               remindersent,
                               remindercount,
                               completed, 
                               usesleft, 
                               validfrom, 
                               validuntil, 
                               mpid) 
                  VALUES ('', '{$id}', '{$name}', '', '{$email}', 'OK', '{$id}', 'en', NULL, 'N', 'N', 0, 'N', 1, NULL, NULL, NULL)";
	
 	      if ($connection->query($sql2) === TRUE) 
             {
	             $log->debug("Token Inserted Successfully - File:register_exam.php ");
              } else {
	                     $log->error("File: register_exam.php : Error creating table: " . $connection->error);
	                    }
      	$myJSONRPCClient->release_session_key($sessionKey );
         //$survey_id;
   }
 ?>

 











												