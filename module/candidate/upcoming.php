<?php
// This code is used to show upcoming exams as well as upload information in DB for upcoming exams
// Last Modified on:22-03-2016
// Last Modified Date: 22-03-2016
		
session_start();

include('../../service/common/db_connection.php');
// without composer this line can be used
include ("../../lib/jsonrpcphp/src/org/jsonrpcphp/JsonRPCClient.php");
//require_once($_SERVER['DOCUMENT_ROOT'].'jsonrpcphp-master/src/org/jsonrpcphp/jsonRPCClient.php');
// with composer support just add the autoloader
include  ("../../../limesurvey/third_party/kcfinder/core/autoload.php");		

//Get Session parameters
    $myJSONRPCClient = new \org\jsonrpcphp\JsonRPCClient( '../../../limesurvey/index.php/admin/remotecontrol' );
	$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

   	$name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $id=$_SESSION['id'];

error_reporting(E_ALL);
    
if(isset($_GET['q']))
     {
        
// Get exam id from DB for exam name passed and assign it to exam_id variable
		$exam_name = $_GET['q'];
	    $sql = "SELECT exam_id
                FROM t_exam_org_qp 
                WHERE exam_name= '{$exam_name}' ";
	    $result = mysqli_query($connection,$sql);
	    while($row=mysqli_fetch_assoc($result))
	      	{
	         $exam_id = $row['exam_id'];
        	}
 // Commented below code as this is not used today.
     	 /*$sql2 = "SELECT * 
					FROM lime_questions ";
	      $result = mysqli_query($connection2,$sql2);
	      while($row=mysqli_fetch_assoc($result))
        	{
		        $qid = $row['qid'];
			}*/
			
// Insert candidate to exam relation in t_candidate_exam table
	      $sql = "INSERT INTO t_candidate_exam 
                            (exam_id ,
                             candidate_id ,
                             registration_date )
	              VALUES ('{$exam_id}', '{$_SESSION['id']}', now())";
	
	      if ($connection->query($sql) === TRUE) 
			{
		        // write in log file for myskill index
				"New record created successfully";
			} 
           else 
             {
          		  // write error in log file for myskillindex
				  "Error: " . $sql . "<br>" . $connection->error;
             }
// GET survey_id for the exam
			$query = "SELECT survey_id 
					  FROM t_exam_survey 
					  WHERE exam_id= '{$exam_id}' ";
         $result2=mysqli_query($connection,$query);
         $row=mysqli_fetch_assoc($result2);
         $survey_id=$row['survey_id'];
	
	//query for getting survey_id from exam

	//$sql= "select exam_id from t_exam_org_qp where exam_name = '{$exam_name}' " ;
  //	$result=mysqli_query($connection,$sql);
  //	$row=mysqli_fetch_assoc($result);
	
  //	$exam_id = $row['exam_id'];
  //$name = $_SESSION['name'];
	//$email = $_SESSION['email'];
 
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
	
	      if ($connection2->query($sql) === TRUE) 
          {
	         "Table token created successfully";
		      } else {
	 	                "Error creating table: " . $connection2->error;
                  }
//******************************************************************************  

        $sql2 = " INSERT INTO lime_tokens_".$survey_id." 
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
	
 	      if ($connection2->query($sql2) === TRUE) 
             {
	             "Token Inserted Successfully - File:upcoming.php ";
              } else {
	                     "File: Upcoming.php : Error creating table: " . $connection2->error;
	                    }
      	$myJSONRPCClient->release_session_key($sessionKey );
         $survey_id;
   }
 ?>

<!-- Display for Up coming Exams on candidate Dashboard-->
<hr>
		<h4>Upcoming Exams</h4>
		<div style="display:overflow-y:scroll">
		<table class="table" style="height:10px;display:overflow-y:scroll">
		<thead >
			<tr>
				<th>Exam Name</th>
				<th>Registered on</th>
				<th>Duration</th>
				<th style="width:20%"></th>
				<th></th>
			</tr>
		</thead>
		<tbody style="height:10px;display:overflow-y:scroll">
		
			
			<?php $query = "SELECT * 
							FROM t_candidate_exam 
							WHERE candidate_id = '{$_SESSION['id']}'
				            AND exam_date is null " ;
				$result=mysqli_query($connection,$query);
				while ($row=mysqli_fetch_assoc($result))
					{  
						$regon = $row['registration_date'];
    					$exam_id= $row['exam_id'];
    					$query2 = "select * from t_exam_survey where exam_id = '{$exam_id}' " ;
    					$result2=mysqli_query($connection,$query2);
    					while ($row2=mysqli_fetch_assoc($result2))
						{ 
    						
    						$query3 = "select * from t_exam_org_qp where exam_id = '{$exam_id}' " ;
    						$result3=mysqli_query($connection,$query3);
    						while ($row3=mysqli_fetch_assoc($result3))
    						{ 
    					    	echo '<tr>
							    <td>' .$row3['exam_name'].'</td>
							    <td>'.$regon.'</td>
							    <td>'.$row3['exam_time'].'</td>';
								echo '<td ><a href="end_date.php?link='.$survey_link.'"><font>Take now</font></a></td>
							    <td><span class="glyphicon glyphicon-remove"></span></td>
								</tr>';
    						}
  						}
	    			}
					$rowcount=mysqli_num_rows($result3);
					if($rowcount == 0)
						{
							echo '<tr>
  							<td><i>Looks like you have not registered for a Exam ....</td>
	  						<td></td>
		  					<td></td>
			  				<td ></td>
				  			</tr>';
						}
					else
						 {
						 //**************** missing ELSE logic****************
						 }
			?>
			
		</tbody>
		</table>
		</div>
	
</hr>










												