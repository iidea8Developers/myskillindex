<?php
	//page created by vivek kumar and prakash shukla
	//this page is to add question in create exam 
	//modified by: Jitendra Dayma
	//last modified on: o6-05-2016
	
	//function for db conn ,logging and session check
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('cteateExamToAddQuestion.php');
	$log->debug("****START - cteateExamToAddQuestion.php****");
	session_start();
	if (isset($_SESSION["user"])){
		$log->debug('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
		$log->debug($_SESSION["user"]);
		$log->debug('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
		$_SESSION["organisation"]=$_POST["org"];
		$_SESSION["sector"]=$_POST["sector"];
		$_SESSION["qp"]=$_POST["qp"];
		$_SESSION["exam_name"]=$_POST["name_of_exam"];
		$_SESSION["exam_description"]=$_POST["desc"];
		$_SESSION["exam_time"] = $_POST["time"];
		$_SESSION["exam_level"] = $_POST["skill_level"];
		$_SESSION["pass_percentage"] = $_POST["percent"];
		$_SESSION["nos_code"]=$_POST["nos"];
		$_SESSION["checked_pc"]=$_POST['checked'];
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	$log->INFO(" Add Questions Create Exam ---- USER: ".$_SESSION["user"]."  SESSION ID: ".session_id());
?>
<!DOCTYPE html>
<html lang="eng">
	<head>	
		<title>To add question in Exam</title>
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
		<!-- header footer buttons line  CSS -->
		<link rel="stylesheet" href="css/author_exam2.css"/>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="jquery.chained.remote.js"></script>	
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		<script type="text/javascript" src="angularjs.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</head>
	
</script>
<style>
#buttons{
		background:#DFDFDF;
		width:160px;
		height:80px;
		position: fixed;
		bottom:0;
		right:0;
		}
		body
		
		{
		background-color:#dfe3ee;
		}
		hr {   border-style: dotted;
		background-color: #fff;}
		</style>
<body>																		
	<div class="form-group">
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
			
			<div class="table-responsive" style="margin-top:-20px;">
					<table class="table table-bordered table-stripped">
						<div class="row">
							<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard > Search Exams > Add questions</font></th>						
						</div>
					</table>
				</div>
			
		
			 <form id="select_form" role="form" action="createExamXML.php" method="post" >

			<div class="container">
				<div class="row">
					
					<div class="col-md-3">
						<div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Organisation</font><b>
							<br>
							<div class="ui-widget">
								<div class="ui-widget"><?php echo $_SESSION["organisation"];
								?>
								</div>
							</div>
							
						</div></div>
						
						
						<div class="col-md-3">
							<div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Sector</font></b>
								<br>
								<div class="ui-widget"><?php echo $_SESSION["sector"];
									?>
							</div></div></div> 
							
							
							<div class="col-md-3">
								<div><b><font color="#3b5998"> <label style="text-decoration: underline;" >QP</font></b>
									<br>
								
									<div class="ui-widget"><?php echo $_SESSION["qp"];
										//echo "Plumber";?>
								</div></div></div> 
								
								<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Name Of Exam</font><b><br><div class="ui-widget"><?php echo $_SESSION["exam_name"];?></div></div></div>
									<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Exam Description</font></b><br><div class="ui-widget"><?php echo $_SESSION["exam_description"];?></div></div></div>
									<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Exam Time (Max)</font></b><br><div class="ui-widget"><?php echo $_SESSION["exam_time"];
										?></div></div></div>
									<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Exam Skill Level</font></b><br><div class="ui-widget"><?php echo $_SESSION["exam_level"];?></div></div></div>
								</div>
								<br>
								<hr>
								<div>
									<div class="row clearfix">
										<div class="col-md-12 column">
											<table class="table table-bordered table-hover" id="tableToModify">
												<thead>
													<tr>
														<th class="text-center">
															<font color="#3b5998"> <b> NOS</b> </font>
															
														</th>
														<th class="text-center">
															<font color="#3b5998"><b>PC Description</b></font>
														</th>
														<th class="text-center">
															<font color="#3b5998"><b>Select Question</b></font>
														</th>
														
													</tr>
												</thead>
												
												<tbody >
													<tr id="rowToClone">
														<td>
															<div>
																<div style="width:150px"  class="col-md-3">
																	<?php echo $_SESSION['nos_code'];?>		
																</div>
															</div>
														</td>
														<td>
															<div class="col-md-3">
																
																<div style="width:300px" class="input_fields_wrap" id="pcDiv2">
																	
																	<div id="nos_desc2">
																	<?php 
																	$checked_pc=$_SESSION['checked_pc'];
																	foreach ($checked_pc as $pc_name) {
																			echo $pc_name;
																			echo'<br>';
																	}
																	?>
																	</div>
																	<br>
																</div></div>	
														</td>
														<td>
															<div class="col-md-3" style="width:400px" >

																<?php  
																//query to get questions from db
																$pcvalues = implode("','", $checked_pc);
																$query = "SELECT t_qbank.q_description, t_qbank.qid
																        FROM t_qbank
																        INNER JOIN r_pc_q
																		ON  t_qbank.qid = r_pc_q.qid
																		WHERE r_pc_q.pc_id IN (SELECT pc_id
																						FROM t_pc
																						WHERE pc_name IN('".$pcvalues."'))";		
																$result = mysqli_query($connection,$query);
																while ($row= mysqli_fetch_assoc($result))
																	{
																		echo '<input type="checkbox" style="width:20px;height:20px;" id="green" name="question[]" value="' . $row['qid'] . '" id="' . $row['qid'] . '"  />';
																		echo '&nbsp;';
																		echo '&nbsp;';
																		echo '&nbsp;&nbsp;';
																		echo $row['q_description'];
																		echo '&nbsp;';
																		echo'<br>';
																		echo'<br>';
																	}
																?>
																
															</div>
														</td>
														
														<directive></directive>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								</div>
								<div id="buttons" align="right">
									<button  type="submit" value="save" name="save" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">Save</button>
									<!--<button type="submit" name="publish" value="publish" type="button" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">Publish Now</button>-->
								
									</form>
								</div>
								
								<div id="footer">
									<br>
									<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
									
								</div>
						</div>
				
				</body>
				
			</html>																																								