<!DOCTYPE html>
<?php
	//page created by prakash shukla
	//db conn and session check
	//include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('assessment.php');
	$log->debug("****START -assessment.php****");
	session_start();
	if (isset($_SESSION["user"])){
		
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
?>
<html>
	<head>
		<title>Search page</title>
		
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
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<script>
			//function for autofill input boxes
			$(function() {
				$( "#search_qp" ).autocomplete({
					source: '../../service/common/search_qp.php'
					
				});
			});
			
			$(function() {
				$( "#search_org" ).autocomplete({
					source: '../../service/common/search_org.php'
					
				});
			});
			
			
			//function for confirm before delete
			function confSubmit(form) {
				if (confirm("Are you sure you want to delete the exam?")) {
					form.submit();
				}
				
				else {
					alert("You decided to not delete the exam!");
				}
			}
			
			//ajax function for dynamically populayte results on the page
			function ajax_post(){
				// Create our XMLHttpRequest object
				var hr = new XMLHttpRequest();
				// Create some variables we need to send to our PHP file
				var url = "search_exam.php";
				var fn = document.getElementById("search_org").value;
				var ln = document.getElementById("search_qp").value;
				var ln2 = document.getElementById("search_exam").value;
				
				var vars = "search_exam="+ln2+"&search_org="+fn+"&search_qp="+ln;
				hr.open("POST", url, true);
				// Set content type header information for sending url encoded variables in the request
				hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				// Access the onreadystatechange event for the XMLHttpRequest object
				hr.onreadystatechange = function() {
					if(hr.readyState == 4 && hr.status == 200) {
						//alert(hr.responseText.trim());
						var return_data = hr.responseText;
						document.getElementById("row2").innerHTML = return_data;
						//document.getElementById("search_exam").value = "";
                        //document.getElementById("search_org").value = "";
	                    //document.getElementById("search_qp").value = "";
					}
				}
				// Send the data to PHP now... and wait for response to update the status div
				hr.send(vars); // Actually execute the request
				document.getElementById("row2").innerHTML = "processing...";
			}
			$('document').ready(function(){
				$('input').focus(function(){
					this.value="";
				});
			});
		</script>
</head> 
<style>
	body
	
	{
	background-color:#dfe3ee;
	}
</style>	
<body>
	<div class="wrapper">
		<div id="header">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
					<a class="navbar-brand" class="pull-left"><img src="../../images/common/logo_myskillindex.jpeg" style="margin-top:-15px;margin-left:-14px;" height="50" width="200"></a>					</div>
					<div>
						
					</div>
				</div>
			</nav>
		</div></div>
		<div class="table-responsive" style="margin-top:-20px;">
			<table class="table table-bordered table-stripped">
				<div class="row">
					<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard > Search Exams</font></th>						
				</div>
			</table>
		</div>
		
		
		<div class="container" style="width:1000x;" >
			<div class="row">
				<div class="col-md-3">
					<div>
						<b><font color="#3b5998"> ORG</font></b>
						<br>
						<div class="ui-widget">
							<input name="org" class="form-control" name="search_org" type="text" id="search_org">
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div>
						<b><font color="#3b5998"> &nbsp;QP</font></b>
						<br>
						<div class="ui-widget">
							<input name="qp" class="form-control" type="text" name="search_qp" id="search_qp">
						</div>
					</div>
				</div> 
				<div class="col-md-2">
					<div>
						<b><font color="#3b5998">&nbsp; Name Of Exam</font><b><br><input class="form-control" type="text" name="search_exam" id="search_exam" value="" >
						</div>
						</div>
						<div class="col-md-4">
							
							<button style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;margin-left:-14px;" id="button" onclick="ajax_post();" >Search Exams
								&nbsp;&nbsp;
								<button type="submit" type="button"  onclick="window.location.href='create_exam.php'"  style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;margin-left:14px;">Create New Exam</button>
							</div>
							<div id="demo">
							</div>
						</div>
					</div>
				</div>
				<br>
				<center><div class="table-responsive" style="width:1140px;">
					<table class="table table-bordered table-stripped">
						<div class="row">
							<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Search Result</font></th>	
						</div>											
					</table>
				</div>
				<div class="container">
					
					<div class="table-responsive">
						<table class="table table-bordered table-stripped">
							<div class="row">
								<th class="col-md-4"><font color="#3b5998" size="4">Exam Name</font></th>
								<th class="col-md-4"><font color="#3b5998" size="4">Exam Description</font></th>
								<th class="col-md-4"><font color="#3b5998" size="4">Exam Time </font></th>
							</div>	
						</table>
					</div>
				</div>
				</div>	
				<div id="row2" class="row2">
					
				</div>
				
				
				<div id="back" align="left">
					<button  type="button" onclick="window.location.href='admin_dashboard.php'" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">Back</button>
				</div>
				<div id="footer">
					<br>
					<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
					
				</div>
				
			</body>
		</html>						