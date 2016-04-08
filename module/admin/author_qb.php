<!DOCTYPE html>
<?php
	// created by jitendra dayma 
    // created on : 08-04-2016
	// this page is for searching and creating questions
	
	// below code is for db conn setup and session check
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('author_qb.php');
	$log->debug("****START -author_qb.php****");
	session_start();
	$log->debug($_SESSION["user"]);
	if (isset($_SESSION["user"])){
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
?>
<html>
	<head>
		<title>Question Bank</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Alegreya+SC:700,400italic' rel='stylesheet' type='text/css' />
		<!-- header footer buttons line  CSS -->
		<link rel="stylesheet" href="../../css/admin/author_qb.css"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
		<!-- jQuery library -->
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			<script>
			// ajax script for searching Questions 
			function ajax_post(){
				// Create our XMLHttpRequest object
				var hr = new XMLHttpRequest();
				// Create some variables we need to send to our PHP file
				var url = "ajax/search_que.php";
				var fn = document.getElementById("search_org").value;
				
				
				var vars = "search_org="+fn;
				hr.open("POST", url, true);
				// Set content type header information for sending url encoded variables in the request
				hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				// Access the onreadystatechange event for the XMLHttpRequest object
				hr.onreadystatechange = function() {
					if(hr.readyState == 4 && hr.status == 200) {
						var return_data = hr.responseText;
						document.getElementById("row2").innerHTML = return_data;
					}
				}
				// Send the data to PHP now... and wait for response to update the status div
				hr.send(vars); // Actually execute the request
				document.getElementById("row2").innerHTML = "processing...";
			}
			
		//function  used for edit questions button
       function myFunction2() {
		// Create our XMLHttpRequest object
				var hr = new XMLHttpRequest();
				// Create some variables we need to send to our PHP file
				var url = "ajax/edit_que.php";
				var fn = document.getElementById("img2").value;
				
				
				var vars = "img2="+fn;
				hr.open("POST", url, true);
				// Set content type header information for sending url encoded variables in the request
				hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				// Access the onreadystatechange event for the XMLHttpRequest object
				hr.onreadystatechange = function() {
					if(hr.readyState == 4 && hr.status == 200) {
						var return_data = hr.responseText;
						document.getElementById("row2").innerHTML = return_data;
					}
				}
				// Send the data to PHP now... and wait for response to update the status div
				hr.send(vars); // Actually execute the request
				document.getElementById("row2").innerHTML = "processing...";

       }
</script>
<style>
	body
	
	{
	background-color:#dfe3ee;
	}
	
	</style>
	</head> 
	<body>
		<div class="wrapper">
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
		</div>
		
		<center><p><b><font color="#009AD9" size="5"></font><p></center>
			
			
			<center>
			<div class="table-responsive" style="margin-top:-20px;">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard > Question Bank</font></th>						
					</div>
				</table>
			</div>
			</center>
			<div class="container">				
				<div class="row">				
					<div class="col-md-4">
						<div >				
							<b><font color="#3b5998"> Search Question</font></b>				
							<br>				
							<div class="ui-widget" >
								<input  class="form-control" style="width:380px;"  type="text" id="search_org">						
							</div>			
						</div>
					</div>	
					<div class="col-md-4">
						<div>
							<button  style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;" id="button"  onclick="ajax_post();" >Search Questions</button>&nbsp;&nbsp;
							<button  id="button" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;"  onclick="window.location.href='author_qb_c.php'" >Create New</button>
						</div>
						<div>
						</div>
					</div>
					<div class="col-md-2">
						<div style="padding-left:-10px;">
						</div>
						<div>								
						</div>							
					</div>
					<div class="col-md-2">	
					</div>			
				</div>
				<br>
			</div>
			<center>
			<div class="table-responsive" style="width:1140px;">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Search Result</font></th>	
					</div>											
				</table>
			</div>
			</center>
			
			<div id="row2" >
			</div>
			
			<div id="back" align="left">
				<button type="submit" type="button" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;" onclick="window.location.href='dashboard.php'" class="btn btn-primary btn-md">Back</button>				
			</div>
			<hr class="line">				
			<div id="footer">
				<br>
				<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>				
			</div>
			
			</body>
			</html>																							