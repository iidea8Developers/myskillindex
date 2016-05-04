<?php
	//page created by vivek kumar and prakash shukla
	//this page is to add question in create exam 
	//modified by: Jitendra Dayma
	//modified on: 04-05-2016
	
	//function for db conn ,logging and session check
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('cteateExamToAddQuestion.php');
	$log->debug("****START - cteateExamToAddQuestion.php****");
	session_start();
	if (isset($_SESSION["user"])){
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
							<a class="navbar-brand" class="pull-left"><img src="image/title.png" style="margin-top:-15px;margin-left:-14px;" height="50" width="200"></a>
						</div>
						<div>
							
						</div>
					</div>
				</nav>
			</div>
			
			<div class="table-responsive" style="margin-top:-20px;">
					<table class="table table-bordered table-stripped">
						<div class="row">
							<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard > Search Exams > Author Exam</font></th>						
						</div>
					</table>
				</div>
			
		
			 <form id="select_form" role="form" action="exam_save.php" method="post" >

			<div class="container">
				<div class="row">
					
					<div class="col-md-3">
						<div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Organisation</font><b>
							<br>
							<div class="ui-widget">
								<div class="ui-widget"><?php echo $_SESSION["org"];
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
								
								<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Name Of Exam</font><b><br><div class="ui-widget"><?php echo $_SESSION["exam"];?></div></div></div>
									<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Exam Description</font></b><br><div class="ui-widget"><?php echo $_SESSION["desc"];?></div></div></div>
									<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Exam Time (Min)</font></b><br><div class="ui-widget"><?php echo $_SESSION["time"];
										?></div></div></div>
									<div class="col-md-3"><div><b><font color="#3b5998"> <label style="text-decoration: underline;" >Exam Skill Level</font></b><br><div class="ui-widget"><?php echo $_SESSION["skill"];?></div></div></div>
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
																	<?php echo $_POST["nos"];?>		
																</div></div>
														</td>
														<td>
															<div class="col-md-3">
																
																<div style="width:300px" class="input_fields_wrap" id="pcDiv2">
																	
																	<div id="nos_desc2">
																	<?php 
																	//query used to fetch pc details on the page
		$query= " select * from t_pc where pc_id in (select pc_id from t_exam_nos_pc where exam_id='{$_SESSION["exam_id"]}')" ;
		$result = mysqli_query($connection,$query);
		$pc_name=array();
		$i=0;
		while ($row= mysqli_fetch_assoc($result))
		{
			//$pc_name[$i] = $row['pc_name'];	
			$pc_name=$row['pc_name'];	
			$pc_id=$row['pc_id'];	
			
			echo $pc_name;
			echo'<br>';
			echo'<br>';
			      $cast[] = $row['pc_id'];
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
																			$query2= " select * from t_qbank where qid in (select qid from r_pc_q where pc_id in ('".implode("', '", $cast)."'))"; 

			$result3 = mysqli_query($connection,$query2);
			while ($row3= mysqli_fetch_assoc($result3))
		{
	     $que = $row3['q_description'];
		
		
		 echo '
	<input type="checkbox" style="width:20px;height:20px;
	" id="green" name="checked[]" value="' . $row3['qid'] . '" id="' . $row['qid'] . '"  />

	';
		 echo '&nbsp;';
		echo '&nbsp;';echo '&nbsp;&nbsp;';
		 echo $que;
		 	echo '&nbsp;';
		
		 echo'<br>';
			echo'<br>';
		}?>
																
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
									<button type="submit" name="publish" value="publish" type="button" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">Publish Now</button>
								
									</form>
								</div>
								
								<div id="footer">
									<br>
									<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
									
								</div>
						</div>
				
				</body>
				
			</html>																																								