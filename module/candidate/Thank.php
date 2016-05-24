 <?php
    include_once('../../service/common/db_connection.php');
    include_once('../../lib/log4php/Logger.php');
    Logger::configure('../../config/log_config.xml');
    $log = Logger::getLogger('Thank.php');
    $log->debug("**** START - Thank.php ****");
    session_start();
    $log->debug($survey_id = $_GET['survey_id']);
    $log->debug($token = $_GET['token']);
    if(isset($_GET['survey_id']) && isset($_GET['token'])){
        $survey_id = $_GET['survey_id'];
        $token = $_GET['token'];
        $lang = $_GET['lang']
        $sDocumentType = 'json';
        $sCompletionStatus='all';
        $sHeadingType='full';
        $sResponseType='long';
        // without composer this line can be used
        include_once("../../lib/jsonrpcphp/JsonRPCClient.php");

        //Get Session parameters
        $myJSONRPCClient = new JsonRPCClient( LS_BASEURL );
        $sessionKey = $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
        //export response using token key
        $JSON_file = $myJSONRPCCLient->export_responses_by_token($sessionKey, $survey_id, $sDocumentType, $token, $lang, $sCompletionStatus, $sHeadingType, $sResponseType);
        //to iterator over the json file
        $jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode(base64_decode(file_get_contents($JSON_file)),TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);
        $JSON_file = base64_decode(file_get_contents($JSON_file));

        echo $JSON_file;
        foreach ($jsonIterator as $key => $val) {
            if(is_array($val)) {
                echo "$key:\n";
            } else {
                echo "$key => $val\n";
            }
        }

        print_r($JSON_file);
        $myJSONRPCClient->release_session_key($sessionKey );
    
   

//it is second method to export result and show the user
        //this data should be fetched from table using survey id and token
        $candidate_id  = $_SESSION['id'];
        $email = $_SESSION['email'];
        $exam_id = 	$_SESSION['exam_id'] ; 	



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
        $result=mysqli_query($connection,$query);
        $num_rows = mysqli_num_rows($result);
        while ($row=mysqli_fetch_assoc($result)){
            $exam_name = $row['exam_name'];
            $exam_percentage = $row['exam_pass_percentage'];
            echo     $string1[]= "A".$row['a_sortorder'];
        }	
 		
        $lime = "SELECT * 
               FROM lime_survey_.$survey_id. 
               WHERE token = '{$token}' ";
            $result=mysqli_query($connection,$lime);
            while ($limerow=mysqli_fetch_assoc($result)){
                foreach($limerow as $key => $value) {
                $string[]=$value;
                }
            }
 		/*$query = "  SELECT exam_name, 
                           exam_pass_percentage 
                    FROM t_exam_org_qp 
                    WHERE exam_id  = '{$exam_id}' " ;
 		$result=mysqli_query($connection,$query);
 		while ($row=mysqli_fetch_assoc($result)){
            $exam_name = $row['exam_name'];
            $exam_percentile = $row['exam_pass_percentage'];
 			
 			$Query = "SELECT * 
                FROM r_exam_que 
                WHERE exam_id =  '{$exam_id}' " ;
 			$result4=mysqli_query($connection,$Query);
 			$num_rows = mysqli_num_rows($result4);

 			while ($row4=mysqli_fetch_assoc($result4))				
 			{
 				
 				$Query2 = "SELECT DISTINCT a_iscorrect  
                   FROM t_ansbank 
                   WHERE qid = '{$row4['qid']}' " ;
 				$result5=mysqli_query($connection,$Query2);
 				while ($row5=mysqli_fetch_assoc($result5))
 				{
 				echo	 $string2[]= "A".$row5['a_iscorrect'];
 				}
 				
 			}
        }  */  		
 
 		$num=9;
 		$num1=0;
 		$marks=0;
    //calculate marks
 		for ($x = 0; $x <= $num_rows-1; $x++) {
 			
 			if( $string[$num] != $string1[$num1])
 			{

      echo "  ************start************ ";
      echo $string[$num];
      echo '<br>';
       echo $string1[$num2];
      echo " ***********end**********";
     
 			}else
 			{
        //should come from  question weightage from t_question bank and add this q_weightage in select query used in starting
 				$marks=$marks+4;
 				
 			}
 			
 			
 			$num =$num+1;
 			$num1 =$num1+1;
 		}
 		echo $marks;

    //insert marks in database 		
 		$sql = "INSERT INTO t_candidate_result (exam_id, 
                                            candidate_id, 
                                            marks_scored)
 		         VALUES ('{$exam_id}', '{$candidate_id}', '{$marks}') " ;
 		
 		if ($connection->query($sql) === TRUE) {
      $log->error("exam record is added successfully to t_candidate_result table");
 			} else {
 			$log->error("Error: " . $sql . "<br>" . $connection->error);
 		}
 		
 		//it shows maximum marks scored in that exam 
 		$query = "SELECT MAX(marks_scored) 
              FROM t_candidate_result 
              WHERE exam_id  = '{$exam_id}' " ;
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************maximum marks*********************";
 	  echo $max= $row['marks_scored'];
 		//echo "**************************************";
 		//Your percentile score = { (No, of people who got less than you/ equal to you) / (no. of people appearing in the exam) } x 100
 		
 		$query = " SELECT COUNT(candidate_id) 
               FROM t_candidate_result 
               WHERE exam_id  = '{$exam_id}'  
               AND marks_scored <= '{$marks}' ";
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************num of people equal or less than u *********************";
 	    $num_people = $row['COUNT(candidate_id)'];
 	//	echo "**************************************";
 		
 		$query = " SELECT COUNT(candidate_id) 
               FROM t_candidate_result 
               WHERE exam_id = '{$exam_id}'  ";
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "***************total people of 92 exAM***********************";
 	    $num_people_app = $row['COUNT(candidate_id)'];
 	//	echo "**************************************";
 		
 		
 		$percentile = ($num_people/$num_people_app)*100 ;
 		//echo '<br>';
 		//echo $percentile;
 	echo '	<body style="background-color:lightgrey;"> ';
 
 
 
 echo '</body>';
 echo '<h1>'.round($percentile).' Percentile <h1>';
 echo '<h1>'.  $marks .' Marks Scored <h1>';
 	
 	
  $total_marks = ($num_rows * 4 );
  echo $total_marks;
 
 
 echo "percent". $exam_percentage;
 $eligible = (($marks)/($total_marks))*100;
 echo "eligible".$eligible;
 
//check whether candidate is fail or pass
  $date = date("Y/m/d");
 if ($exam_percentage < $eligible){
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
    /*$query = "SELECT exam_date 
              FROM t_candidate_exam 
              WHERE (candidate_id = '{$candidate_id}' 
              AND exam_id = '{$exam_id}' ) " ;
    $result = mysqli_query($connection , $query);
    $row = mysqli_fetch_assoc($result);

    $exam_date = $row['exam_date'];*/

    $subject = "Result of ".$exam_name." on MyskillIndex";
    $msg = "Dear ".$_SESSION['name'].",

Congratulations !!

We are please to inform you that you have succesfully passed the exam ".$exam_name." on ".$date." with ".$eligible." percentage.

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
else
 {
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
score: ".$marks." 
percentile: ".$percentile." 
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
 
}//end of pass fail else

header('Location: dashboard.php');

?>
 

