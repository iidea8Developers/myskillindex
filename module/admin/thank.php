<?php
	//this is page is to say thank to admin and ask him to publish exam  
	//session check and db conn
	
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('thank.php');
	$log->debug("**** START - thank.php ****");
	session_start();
	if ((isset($_SESSION["user"]))){
		$log->debug('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
		$log->debug($_SESSION["user"]);
		$log->debug('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
	}else
	{
		header("Location: error_page.php");
	}
	$query="SELECT survey_link 
			FROM t_exam_survey 
			WHERE exam_id ='{$_SESSION["exam_id"]}' ";
	$result=mysqli_query($connection,$query);
	$row=mysqli_fetch_assoc($result);
	$exam_link=$row['survey_link'];
	$exam_name=$_SESSION["exam_name"];
	
	$log->debug("*******END - thank.php *******")
	?>
<!DOCTYPE html>
<html lang="eng" ng-app="myApp">
	<head>
		<title>Thanks</title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		
		<script type="text/javascript" src="https://code.angularjs.org/1.5.0-beta.2/angular-route.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="css/admin_css.css">
	</head>
	<body>
		
		<div id="wrapper">
			<div id="header">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
<a class="navbar-brand" class="pull-left"><img src="../../images/common/logo_myskillindex.jpeg" style="margin-top:-15px;margin-left:-14px;" height="50" width="200"></a>						</div>
						<div>
							
						</div>
					</div>
				</nav>
			</div>
            <div id="content">
                <style>
					body
					{
					background-image:url("../../images/admin/admin_login_background.jpg");
					}
				</style>
				<div class="container" style="display:inline">
					<div class="row">
						<div class="col-md-8">
							<div class="jumbotron" style="background-color: rgba(245, 245, 245, .4)" style="height:50px;width:50px">
								<br>
								
								<a><span class="glyphicon glyphicon-ok" style="font-size: 50px;colour:blue;height:30px"></span></a><p class="text-center text-nowrap text-primary" style="font-size:25px;colour:#ffffff;padding-right:10cm">Thank you for Saving Your Exam</p>
								<p class="text-center text-nowrap text-primary" style="font-size:15px;colour:#ffffff;padding-right:16cm">Exam Name --- <?php
								echo $exam_name;
								?>
								<br><a href="<?php  echo $exam_link;  ?>">View Your Exam</a>
								</p>
							</div>
							
							<div  style="padding-left:1.6cm">
							<button  name="publish" value="publish" type="button"
							onClick="window.location='search_exam.php';"
							style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;"
							>Create More</button>&nbsp;
							
							<button  
							style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;"
							name="publish" value="publish" type="button" ><a href="admin_dashboard.php" style="color: #fff; text-decoration: none;">Close</a></button>
							</div>
							
							</div>
					</div>
				</div>
				<div id="footer">
					<br>
					<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
				</div>
			</div>
		</body>
	</html>	
	
	