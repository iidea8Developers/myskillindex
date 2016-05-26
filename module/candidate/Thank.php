<?php
    include_once('../../service/common/db_connection.php');
    include_once('../../lib/log4php/Logger.php');
    Logger::configure('../../config/log_config.xml');
    $log = Logger::getLogger('Thank.php');
    $log->debug("**** START - Thank.php ****");
    session_start();
    //$log->debug($survey_id = $_GET['survey_id']);
    //$log->debug($token = $_GET['token']);
    if(isset($_GET['survey_id']) && isset($_GET['token'])){
        $survey_id = $_GET['survey_id'];
        $token = $_GET['token'];
        $lang = $_GET['lang'];
        $sDocumentType ="json";
        $sCompletionStatus='all';
        $sHeadingType='code';
        $sResponseType='short';
        $aFields=null;
        // without composer this line can be used
        include_once("../../lib/jsonrpcphp/JsonRPCClient.php");

        //Get Session parameters
        $myJSONRPCClient = new JsonRPCClient( LS_BASEURL );
        $sessionKey = $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
        //export response using token key
        $JSON_file = $myJSONRPCClient->__call('export_responses_by_token', array($sessionKey, $survey_id, $sDocumentType, $token, $lang, $sCompletionStatus, $sHeadingType, $sResponseType,$aFields));
        $JSON_file = base64_decode($JSON_file);
        $json = json_decode($JSON_file,TRUE);
        //echo '<pre>' . print_r(json_decode($JSON_file,TRUE), true) . '</pre>';
        $log->debug("json file : " . print_r(json_decode($JSON_file,TRUE), true));           

        //this data should be fetched from table using survey id and token
        $candidate_id  = $_SESSION['id'];
        $email = $_SESSION['email'];
        $exam_id = 	$_SESSION['exam_id'] ; 
        $query = "SELECT id
               FROM lime_survey_.$survey_id. 
               WHERE token = '{$token}' ";
        $result=mysqli_query($connection2,$query);
        $row = mysqli_fetch_assoc($result);
        $response_id = $row['id'];
        $log->debug($response_id);

        $query = "  SELECT teoq.exam_name, 
                           teoq.exam_pass_percentage,
                           req.qid,
                           tab.a_sortorder
                    FROM t_exam_org_qp teoq,
                         r_exam_que req,
                         t_ansbank tab
                    WHERE tab.qid = req.qid 
                    AND tab.a_iscorrect = 1
                    AND teoq.exam_id  = req.exam_id
                    AND req.exam_id = '{$exam_id}' " ;
        $log->debug($query);            
        $result=mysqli_query($connection,$query);
        $num_rows = mysqli_num_rows($result);
        $marks=0;
        $correct = 0;
        // should get response id from lime_survey_survey_id table or look for other solution

        while ($row=mysqli_fetch_assoc($result)){
            $exam_name = $row['exam_name'];
            $exam_percentage = $row['exam_pass_percentage'];
            if(($row['a_sortorder']) == ($json['responses'][0][$response_id]['q'.$row['qid']])){
                $marks = $marks + 4;
                $correct++;
                $log->debug($row['a_sortorder']); 
                $log->debug($json['responses'][0][$response_id]['q'.$row['qid']]); 
                $log->debug($marks); 
                $log->debug($correct); 
            }
        }
        $myJSONRPCClient->release_session_key($sessionKey ); 
    } 
        
        //insert marks in database 		
 		$sql = "INSERT INTO t_candidate_result (exam_id, 
                                            candidate_id,
                                            exam_token, 
                                            marks_scored)
 		         VALUES ('{$exam_id}', '{$candidate_id}','{$token}', '{$marks}') " ;
 		$log->debug($sql);
 		if ($connection->query($sql) === TRUE) {
            $log->error("exam record is added successfully to t_candidate_result table");
 		} else {
 			$log->error("Error: " . $sql . "<br>" . $connection->error);
 		}
 		
 		//it shows maximum marks scored in that exam 
 		$query = "SELECT MAX(marks_scored) 
                  FROM t_candidate_result 
                  WHERE exam_id  = '{$exam_id}' " ;
        $log->debug($query);
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	    $max= $row['MAX(marks_scored)'];
 		//Your percentile score = { (No, of people who got less than you/ equal to you) / (no. of people appearing in the exam) } x 100
 		
 		$query = "  SELECT COUNT(candidate_id) 
                    FROM t_candidate_result 
                    WHERE exam_id  = '{$exam_id}'  
                    AND marks_scored <= '{$marks}' ";
        $log->debug($query);
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	    $num_people = $row['COUNT(candidate_id)'];
 		
 		$query = "  SELECT COUNT(candidate_id) 
                    FROM t_candidate_result 
                    WHERE exam_id = '{$exam_id}'  ";
        $log->debug($query);
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	    $num_people_app = $row['COUNT(candidate_id)']; 		
 		
 		$percentile = ($num_people/$num_people_app)*100 ;
 		
 	    echo '	<body style="background-color:lightgrey;"> ';
        echo '</body>';
        echo '<h1>'.round($percentile).' Percentile <h1>';
        echo '<h1>'.  $marks .' Marks Scored <h1>';
 	    $total_marks = ($num_rows * 4 );
        echo $total_marks;
       // echo "percent". $exam_percentage;
        $percentage_scored = (($marks)/($total_marks))*100;
       // echo "percentage_scored".$percentage_scored;
 
        //check whether candidate is fail or pass
        $date = date("Y/m/d");
        if ($exam_percentage < $percentage_scored){
            echo "pass";
            $sql = "UPDATE t_candidate_exam 
                    SET fail = '1' , 
                        exam_date = '$date' 
                    WHERE (candidate_id = '{$candidate_id}' 
                    AND exam_id = '{$exam_id}' ) " ;
 
            if (!mysqli_query($connection, $sql)) {
                $log->error("Error updating record: " . mysqli_error($connection));
                echo "Error updating record: " . mysqli_error($connection);
            }else{
                
                $subject = "Result of ".$exam_name." on MyskillIndex";
                $msg = "Dear ".$_SESSION['name'].",
                    Congratulations !!

                    We are please to inform you that you have succesfully passed the exam ".$exam_name." on ".$date." with ".$percentage_scored." percentage.

                    Exam result
                    score: ".$marks." 
                    percentile: ".$percentile." 
                    time taken: <time taken to complete the exam (hr mins)>.

                    Please login in your profile at <hyperlink candidate login> and download you certificate of completion under certificate section.

                    Congratulations again and thank you for taking assessment with www.MyskillIndex.com.

                    Regards 
                    My Skill Index Team
                    www.MyskillIndex.com";

                    // send email
                    mail($email,$subject,$msg);

            }
        }//end of pass if condiction
        else{
            echo "fail";
            $sql = "UPDATE t_candidate_exam 
                    SET  fail = '0' , exam_date = '$date' 
                    WHERE (candidate_id = '{$candidate_id}' 
                    AND exam_id = '{$exam_id}' ) " ;
 
            if (mysqli_query($connection, $sql)) {
                echo "fail ho gya";
                $subject = "Result of ".$exam_name." on MyskillIndex";
                $msg = "Dear ".$_SESSION['name'].",

                We regret to inform you that you have not passed the exam ".$exam_name."  on ".$date.".

                Exam result
                Score: ".$marks." 
                Percentile: ".$percentile."
                Percentage: ".$percentage_scored." 
 
                time taken: <time taken to complete the exam (hr mins)>.

                If you wish to take the exam again, please register at <hyperlink candidate login>

                Thank you for taking assessment with www.MyskillIndex.com.


                Regards 
                My Skill Index Team
                www.MyskillIndex.com";

                mail($email,$subject,$msg);
            } else {
                echo "Error updating record: " . mysqli_error($connection);
            }
        } //end of pass fail else

        mysqli_close($connection);
        $log->debug("**** END - Thank.php ****");
?>