<!DOCTYPE html>
<?php  
	// page created by vivek kumar and prakash shukla
	// modified by: Jitendra dayma
	// modified on: 08-04-2016
	// this page is to create Assesment
	
	//function for db conn and session check
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('create_exam.php');
	$log->debug("****START -create_exam.php****");
	include_once('../../service/common/db_connection.php');
	session_start();
	if (isset($_SESSION["user"])){
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
?>
<html lang="eng" >
	<head>		
		<title>Create Exam</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Alegreya+SC:700,400italic' rel='stylesheet' type='text/css' />		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="jquery.chained.remote.js"></script>
		
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		<script type="text/javascript" src="angularjs.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
			$("document").ready(function(){	
				// jquery function to Autofill input boxes
				$("select#search_org").change(function(){
					var id = $("select#category option:selected").attr('value');
					$.post("select_type.php", {id:id}, function(data){
						$("select#type").html(data);
					});
				});
				
				//$(function() {
					$( "#search_org" ).autocomplete({
						source: '../../service/common/search_org.php'
						
					});
				//});
				
				//$(function() {
					$( "#search_qp" ).autocomplete({
						source: '../../service/common/search_qp.php'
						
					});
				//});

				//$(function() {
					$( "#search_sector" ).autocomplete({
						source: '../../service/common/search_sector.php'
						
					});
				//});
			});	
			//ajax function to pull list of Pc dynamically on the page
			
			function showUser(str) {
				if (str == "") {
					document.getElementById("pc_fetch").innerHTML = "";
					document.getElementById("nos_desc").innerHTML = "";
					
					return;
					} else { 
						if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp = new XMLHttpRequest();
			            	xmlhttp2 = new XMLHttpRequest();
							} else {
								// code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			            		xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
							}
						xmlhttp.open("GET","pc_get.php?p="+str,true);
						xmlhttp.onreadystatechange = function() {
							if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
								document.getElementById("pc_fetch").innerHTML = xmlhttp.responseText;
							}
						};
						xmlhttp.send();
						//request to get description of nos
						xmlhttp2.open("GET","nos_desc_get.php?q="+str,true);
						xmlhttp2.onreadystatechange = function() {	
							if (xmlhttp2.readyState == 4 && xmlhttp.status == 200) {
								document.getElementById("nos_desc").innerHTML = xmlhttp2.responseText;
							}
						};
						xmlhttp2.send();
					}
				}
		</script>
		<style>
			body{
			background-color:#dfe3ee;
			}
			.checkbxinput {
				color: green;
				background-color: green;
			}
			hr{
				color: #000;
				background-color: #000;
				height: 1px;
			}
			
			#footer {
				background:#DFDFDF;
				width:100%;
				height:50px;
				position: fixed;
				bottom:0;
				left:0;
			}
			#add_nos{
				background:#DFDFDF;
				width:128px;
				height:80px;
				position: fixed;
				bottom:0;
				right:0;
			}
			#back{
				background:#DFDFDF;
				width:128px;
				height:80px;
				position: fixed;
				bottom:0;
				left:-20;
			}

			
		</style>
	</head>
	<body> 
		<div class="form-group">
			<div class="wrapper">
				<div id="header">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
								<a class="navbar-brand" class="pull-left"><img src="../../images/common/logo_myskillindex.jpeg" style="margin-top:-15px;margin-left:-14px;" height="50" width="200">
								</a>
							</div>
						</div>
					</nav>
				</div><!--closed header-->
				<div class="table-responsive" style="margin-top:-20px;">
					<table class="table table-bordered table-stripped">
						<div class="row">
							<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard > Search Exams > Create Exam</font>
							</th>						
						</div>
					</table>
				</div>
				<form id="select_form"  action="xsd_to_xml.php" method="post" >
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998">Organisation</font><b>
									<br>
									<div class="ui-widget">
										<input name="org" type="text" placeholder="Global" id="search_org" required>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998"> Sector</font></b>
									<br>
									<input name="sector" type="text" id="search_sector"required>
								</div>
							</div> 
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998"> QP</font></b>
									<br>
									<input name="qp" type="text" id="search_qp" required>
								</div>
							</div>
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998"> Name Of Exam</font><b><br>
									<input type="text" value="" name="name_of_exam" required>
								</div>
							</div>
						</div> 
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998"> Exam Description</font></b>
									<br>
									<input type="text" name="desc" value="" required>
								</div>
							</div>
							<div class="col-md-3"  >
								<div>
									<div  class="form-group">
	  									<label for="sel1"><b><font color="#3b5998">Exam Time</font></label>
	  									<select style="height:25px;width:185px;font-size: 13px;"  name="time" class="form-control" id="sel1">
	    									<option value="30" selected="selected">30 Minutes</option>
	    									<option value="45" >45 Minutes</option>
	    									<option value="60" > 60 Minutes</option>
	    								</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998"> Exam Skill Level</font></b>
									<br>
									<input type="text" name="skill_level" value="" required>
								</div>
							</div>
							<div class="col-md-3">
								<div>
									<b><font color="#3b5998"> Exam Passing Percentage</font></b>
									<br>
									<input type="number" step="0.01" name="percent" value="" required>
								</div>
							</div>
						</div>
					</div>
				<!-- input field ends-->
					<div class="container">
						<br>
						<br>
						<div class="row clearfix">
							<div class="col-md-12 column">
								<table class="table table-bordered table-hover" id="tableToModify">
									<thead>
										<tr>
											<th class="text-center">
												<font color="#3b5998"> <b> NOS</b> </font>
											</th>
											<th class="text-center">
												<font color="#3b5998"><b>NOS Description</b></font>
											</th>
											<th class="text-center">
												<font color="#3b5998"><b>Select PC</b></font>
											</th>
										</tr>
									</thead>
									<tbody >
										<tr id="rowToClone">
											<td>
												<div>
													<div class="col-md-3">
														<?php
															//Query used to pull list of Nos in drop down box
															$nos_query = "SELECT nos_code 
																	FROM t_nos";
															$result = mysqli_query($connection,$nos_query);
															echo "<select name='nos' onchange='showUser(this.value)' style='width:150px'>";
															echo '<option value="0">Select a NOS please</option>';
															while ($row = mysqli_fetch_assoc($result)){
																echo "<option value='".$row['nos_code']."'>".$row['nos_code']."</option>";
																}
															echo "</select>";
														?>
													</div>
												</div>
											</td>
											<td>
												<div class="col-md-3">
													<div style="width:100px" class="input_fields_wrap" id="pcDiv2">
														<div id="nos_desc">
															<!--code to write description of nos -->	
														</div>
														<br>
													</div>
												</div>
											</td>
											<td>
												<div class="col-md-3" style="width:600px" >
													<div id="pc_fetch">
													<?php // PHP function or code to give Pc list?>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>		
					<div id="back" align="left">
						<button  type="back"  onclick="window.location.href='search_exam.php'" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">Back
						</button>
					</div>
					<div id="add_nos" align="right">
						<button type="submit" type="button" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">
						Add NOS
						</button>
					</div>
				</form>
				<div id="footer">
					<br>
					<center>
						<code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a>
						</code>
					</center>
				</div>
			</div>	
		</div>
	</body>					
</html>													