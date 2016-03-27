<?php 
	// this service is used to invoke exam from the upcoming section
 // Modified on: 21-03-2016
 // modified by: Vivek Kumar
 
	session_start();
  //$_SESSION['id'];
	include_once('../../service/common/db_connection.php');

  $link = $_GET['link'];
  Echo "<font color='#FF6F00'><h3><br><br><br><br><br><br><br><br><br><center>My Skill Index require pop ups to be unblocked";
  Echo "<br><strong>Step 1</strong><br>
  Unblock Popup and go back";
  Echo "<br><strong>Step 2</strong><br>
  Try Again";
	
 // select survey link for the exam
	$query= "select * from t_exam_survey where survey_link = '{$link}' " ;
	$result = mysqli_query($connection , $query);
	while ($row=mysqli_fetch_assoc($result))
	{
		$exam_id =  $row['exam_id'];
   $_SESSION['exam_id']=$exam_id ;
	}
 
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


