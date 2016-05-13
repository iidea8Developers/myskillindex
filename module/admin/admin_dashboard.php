<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php  
	//This code generate a dashboard page for admin
    // created by: Pranab and Jitendra
    // Created on : 08-4-2016
    include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('admin_dashboard.php');
	$log->debug("****START -admin_dashboard.php****");
	session_start();
	if ((isset($_SESSION["user"]))){
		
	}else
	{
  header("Location: ../../service/common/error_page.php");
	}
	
?>
<!-- Page created by Vivek kumar -->
<html>
    <head>
        <title>Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Admin" />
        <meta name="keywords" content="jquery, background image, animate, menu, navigation, css3, cross-browser compatible"/>
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script>
        <!-- header footer buttons line  CSS -->
		<link rel="stylesheet" href="../../css/admin/admin_dashboard.css"/>
   
		<style type="text/css">
          body{

            background-image: url("../../images/admin/dashboard_background.jpg");
		

          }
		</style>
	</head>
    <body>
		<div id="wrapper">
			<div id="header">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<a class="navbar-brand" class="pull-left"><img src="../../images/common/logo_myskillindex.jpeg" style="margin-top:-15px;margin-left:-14px;" height="50" width="200"></a>
						</div>
						<div>
							
						</div>
					</div>
				</nav>
			</div>
			<div class="table-responsive" style="margin-top:-20px;">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard</font></th>						
					</div>
				</table>
			</div>
			<div id="content">				
				
				<div class="container">
					<br>
					<br>
					<br>
					<br>
					
					<div class="row">
						<div class="col-md-3">
							<a href="author_qb.php" style="text-decoration: none">
								
								<center>
									<div id="zoomable">
										<img src="../../images/admin/q_bank.jpg" class="img-rounded" height="300" width="200" >
										
										<div class="jumbotron" style="width:200px;height:150px;margin-bottom:0px;">  
											<p style="font-family: ‘Times New Roman’, Times, serif;font-size:23px;">Question Bank</p><font size="4" style="font-family: ‘Times New Roman’, Times, serif;">Create Questions of diffrent types and category for exam </font>
										</div>
										
										<div class="jumbotron" style="width:200px;height:0px;background-color:#9C27B0;padding: 0.5em ;"></div>
									</div>
									
								</center>
								
								
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="#" style="text-decoration: none">
								<center>
									<div id="zoomable">
										
										<img src="../../images/admin/association.jpg" class="img-rounded" height="300" width="200">
										<div class="jumbotron" style="width:200px;height:150px;margin-bottom:0px;">   
											<p style="font-family: ‘Times New Roman’, Times, serif;font-size:23px;">Association</p><font size="4" style="font-family: ‘Times New Roman’, Times, serif;">-- Work In Progress -- </font>
										</div>
										<div class="jumbotron" style="width:200px;background-color:#E91E63;padding: 0.5em ;margin-top:0px"></div>
									</div>
									
								</center>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="assessment.php" style="text-decoration: none">
								<center>
									<div id="zoomable">    
										<img src="../../images/admin/assessment.jpg" class="img-rounded" height="300" width="200">
										<div class="jumbotron" style="width:200px;height:150px;margin-bottom:0px;;">  
											<p style="font-family: ‘Times New Roman’, Times, serif;font-size:23px">Assesment</p><font size="4" style="font-family: ‘Times New Roman’, Times, serif;">Easily configure the assessment workflow process</font>
										</div>
										<div class="jumbotron" style="width:200px;background-color:#0091EA;padding: 0.5em"></div>
									</div>
								</center>    
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="#" style="text-decoration: none">
								<center>
									<div id="zoomble">   
										<img src="../../images/admin/reports.jpg" class="img-rounded" height="300" width="200">
										<div class="jumbotron" style="width:200px;height:150px;margin-bottom:0px;"> 
											<p style="font-family: ‘Times New Roman’, Times, serif;font-size:23px">Reports</p><font size="4" style="font-family: ‘Times New Roman’, Times, serif;">This content refreshed at any time, automatically updated, and delivered at scheduled intervals.</font>
										</div>
										<div class="jumbotron" style="width:200px;background-color:#CDDC39;padding: 0.5em"></div>
									</div>
								</center>
							</a>
						</div>
						
						
					</div>
					<div id="push">
						<div id="footer">
					
					<center><code>Copyright @ 2015 Iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
					
				</div>
						
						</div>
				</div>
				
				
				<div>  
				</body>
			</html>						