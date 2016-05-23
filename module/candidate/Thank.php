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
        // without composer this line can be used
          include_once("../../lib/jsonrpcphp/JsonRPCClient.php");

        //Get Session parameters
        $myJSONRPCClient = new JsonRPCClient( LS_BASEURL );
        $sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

    
        $log->debug($added_user);
        $myJSONRPCClient->release_session_key($sessionKey );
    }
   $candidate_id  = $_SESSION['id'];
   $email = $_SESSION['email'];
   $exam_id = 	$_SESSION['exam_id'] ;
 	  
 	$query2 = "SELECT survey_id 
               FROM t_exam_survey 
               WHERE exam_id = '{$exam_id}' " ;
 	$result2=mysqli_query($connection,$query2);
 	while ($row2=mysqli_fetch_assoc($result2))
 	
 	{ 
 		//$survey_id = $row2['survey_id'];
 		
 		
 		$query3 = " SELECT exam_name, 
                       exam_pass_percentage 
                FROM t_exam_org_qp 
                WHERE exam_id  = '{$exam_id}' " ;
 		$result3=mysqli_query($connection,$query3);
 		while ($row3=mysqli_fetch_assoc($result3))
 		
 		{
    $exam_name = $row3['exam_name'];
    $exam_percentile = $row3['exam_pass_percentage'];
 			
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
      // " are replaced from survey id
 			$lime = "SELECT * 
               FROM lime_survey_.$survey_id. 
               WHERE token = '{$token}' ";
 			$result6=mysqli_query($connection,$lime);
 			while ($limerow=mysqli_fetch_assoc($result6))
 			
 			{
 				foreach($limerow as $key => $value) {
 	 			$string[]=$value;
 				}
 				
 			}
 			
 			
 		}
  }
 		
 		$num=5;
 		$num2=0;
 		$marks=0;
   // echo '<br>';
 		for ($x = 0; $x <= $num_rows-1; $x++) {
 			
 			if( $string[$num] != $string2[$num2])
 			{

      echo "  ************start************ ";
      echo $string[$num];
      echo '<br>';
       echo $string2[$num2];
      echo " ***********end**********";
     
 			}else
 			{

 				$marks=$marks+4;
 				
 			}
 			
 			
 			$num =$num+1;
 			$num2 =$num2+1;
 		}
 		echo $marks;
 		
 		$sql = "INSERT INTO t_candidate_result (exam_id, 
                                            candidate_id, 
                                            marks_scored)
 		         VALUES ('{$exam_id}', '{$candidate_id}', '{$marks}') " ;
 		
 		if ($connection->query($sql) === TRUE) {
 			//echo "New record created successfully";
 			} else {
 			//echo "Error: " . $sql . "<br>" . $connection->error;
 		}
 		
 		
 		$query = "SELECT MAX(marks_scored) 
              FROM t_candidate_result 
              WHERE exam_id  = '{$exam_id}' " ;
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************maximum marks*********************";
 	//	echo $max= $row['MAX(marks_scored)'];
 		//echo "**************************************";
 		//Your percentile score = { (No, of people who got less than you/ equal to you) / (no. of people appearing in the exam) } x 100
 		
 		$query = " SELECT COUNT(candidate_id) 
               FROM t_candidate_result 
               WHERE exam_id  = '{$exam_id}'  and marks_scored <= '{$marks}' ";
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
 	
 	echo $num_rows;
  $four = 4;
  $num_of_q = $num_rows;
  $total_marks = ($num_of_q * $four );
  echo $total_marks;
 
 
 echo "percent". $exam_percentile;
 $eligible = (($marks)/($total_marks))*100;
 echo "eligible".$eligible;
 
 if ($exam_percentile < $eligible){
 $date = date("Y/m/d");
 echo "pass";
 $sql = "UPDATE t_candidate_exam SET  fail = '1' , exam_date = '$date' WHERE (candidate_id = '{$_SESSION['id']}' AND exam_id = '{$exam_id}' ) " ;
 
  if (mysqli_query($connection, $sql)) {

 } else {
     echo "Error updating record: " . mysqli_error($connection);
 }
//mail on pass

	$query4 = " select * from t_candidate_exam where (candidate_id = '{$_SESSION['id']}' and exam_id = '{$exam_id}' ) " ;
 		$result4 = mysqli_query($connection , $query4);
 		$row4 = mysqli_fetch_assoc($result4);
//	echo "***************total people of 92 exAM***********************";
 	  $exam_date = $row4['exam_date'];

$msg = "Dear ".$_SESSION['name'].",

Congratulations !!

We are please to inform you that you have succesfully passed the exam ".$exam_name."  on ". $exam_date.".

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
mail($email,"MyskillIndex",$msg);

 
 }else
 {
 
 
 $date = date("Y/m/d");
 echo "fail";
 $sql = "UPDATE t_candidate_exam 
         SET  fail = '0' , exam_date = '$date' 
         WHERE (candidate_id = '{$candidate_id}' AND exam_id = '{$exam_id}' ) " ;
 
  if (mysqli_query($connection, $sql)) {
     echo "fail ho gya";
 } else {
     echo "Error updating record: " . mysqli_error($connection);
 }
 
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

mail($email,"MyskillIndex",$msg);
 
 }

header('Location: dashboard.php');

?>
 

