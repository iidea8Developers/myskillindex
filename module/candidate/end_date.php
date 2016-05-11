<?php 
	// this service is used to invoke exam from the upcoming section
 // Modified on: 29-04-2016
 // modified by: Pranab Pandey
 
	session_start();
	include_once('../../service/common/db_connection.php');
  // Inititate Log4php logger
  include_once('../../lib/log4php/Logger.php');
  Logger::configure('../../config/log_config.xml');
  $log = Logger::getLogger('end_date.php');
  $log->debug("****START - end_date.php****");

  $link = $_GET['link'];
  Echo "<font color='#FF6F00'><h3><br><br><br><br><br><br><br><br><br><center>My Skill Index require pop ups to be unblocked";
  Echo "<br><strong>Step 1</strong><br>
  Unblock Popup and go back";
  Echo "<br><strong>Step 2</strong><br>
  Try Again";
	
 // select survey link for the exam
	$query= "SELECT exam_id FROM t_exam_survey WHERE survey_link = '{$link}' " ;
	$result = mysqli_query($connection , $query);
	while ($row=mysqli_fetch_assoc($result))
	{
		$exam_id =  $row['exam_id'];
    $_SESSION['exam_id']=$exam_id ;
    $cid = $_SESSION['id'];
	}
  $query_update= "UPDATE  t_candidate_exam 
                  SET exam_date = CURDATE(),
                      exam_start_time = NOW()
                  WHERE  exam_id =$exam_id
                  AND candidate_id =$cid";
  $result = mysqli_query($connection , $query_update);
  $log->debug("****session _id =".$_SESSION['id']);
 $log->debug("****END - end_date.php****");
 $connection->close();
?>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
	<script>
	  $(window).load(function() 
      {
   // executes when complete page is fully loaded, including all frames, objects and images
      var newTab = window.open('<?php echo $link; ?>', '_blank');
      newTab.location;
	    window.location.href = "dashboard.php";
      }
     );
	</script>
</body>


