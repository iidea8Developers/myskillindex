<!DOCTYPE html>
<?php
	session_start();
	include('../../service/common/db_connection.php');
	
	if ((isset($_SESSION["user"]))){
	}else
	{
		header("Location:../../service/common/error_page.php");
	}
	
	$query= "select * from t_candidate_1 where candidate_email='{$_SESSION['user']}'";
	$result=mysqli_query($connection,$query);
	$row=mysqli_fetch_assoc($result);
	$_SESSION['name']=$row['candidate_fname']." ".$row['candidate_mname']. " ".$row['candidate_lname'];
  $_SESSION['password'] =  $row['candidate_password'];
	$_SESSION['email']=$row['candidate_email'];
	$_SESSION['contact']=$row['candidate_contact'];
	$_SESSION['address']=$row['candidate_address_home']." ".$row['candidate_address_street']." ".$row['candidate_address_city']." ".$row['candidate_address_postalcode'];
	$_SESSION['aadhar']=$row['candidate_aadhar'];
	$_SESSION['id']=$row['candidate_id'];
  $_SESSION['image']=$row['image'];

?>


<html>
	<head>
		<title></title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
   <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
		<!-- (Optional) Latest compiled and minified JavaScript translation files -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>
		<style type="text/css">

.select-wrapper {
  background: url(http://s10.postimg.org/4rc0fv8jt/camera.png) no-repeat;
  background-size: cover;
  display: block;
  position: relative;
  width: 33px;
  height: 26px;
}
#file {
  width: 26px;
  height: 26px;
  margin-right: 200px;
 
  opacity: 0;
  filter: alpha(opacity=0)
   
   }
			/* make sidebar nav vertical */ 
			@media (min-width: 768px) {
			.sidebar-nav .navbar .navbar-collapse {
			padding: 0;
			max-height: none;
			}
      
      .hr{
	margin-top:2px;
	
	}
			
			.sidebar-nav .navbar .navbar-collapse .navbar-nav .active{
			
			
			position:relative;
			text-align:center;
			width: 100%;
			height: 100%;
			background-size: cover;
			overflow: hidden;
			
			}
			
			.sidebar-nav .navbar ul {
			
			float: none;
			display: block;
			
			}
			.sidebar-nav .navbar li {
			
			float: none;
			display: block;
			border-top-left-radius: 0px;
			border-bottom-left-radius: 0px;
			
			}

			
			#topbar1 {
			background: #ffffff;
			padding: 10px 0 10px 0;
			text-align: left;
			height: 75px;
			overflow: hidden;
			-webkit-transition: height 0.5s linear;
			-moz-transition: height 0.5s linear;
			transition: height 0.5s linear;
			}
			#topbar1 a {
			color: #fff;
			font-size:1.3em;
			line-height: 1.25em;
			text-decoration: none;
			opacity: 0.5;
			font-weight: bold;
			
			
			}
			#topbar1 a:hover {
			opacity: 1;
			}
			
			#topbar {
			background: #00BCD4;
			padding: 10px 0 10px 0;
			text-align: center;
			height: 35px;
			overflow: hidden;
			-webkit-transition: height 0.5s linear;
			-moz-transition: height 0.5s linear;
			transition: height 0.5s linear;
			}
			#topbar a {
			color: #fff;
			font-size:1.3em;
			line-height: 1em;
			text-decoration: none;
			opacity: 1;
			font-weight: bold;
			}
			#topbar a:hover {
			opacity: 1;
			}
			
			#footer {
			
			width:100%;
			height:50px;
			position: fixed;
			bottom:0;
			left:0
			}
			
			.jumbotron {
			position: relative;
			border-radius: 0px;
			background-size: cover;
			overflow: hidden;
			padding-left: 0px;
			margin-left: 0px;
			
			
			border-top: dashed 1px #03A9F4; 
			border-bottom: dashed 1px #03A9F4;
			border-right: dashed 1px #03A9F4;
			
			background-image: url('../../candidate/images/blue.svg');
			}
			
			#img1{
			
			
			height: 140px;
      margin-right: -1px;
			margin-left: -1px;
			margin-top: -1px;
      background-color: #ffffff;
			background: #ffffff;
       
      
			}
			#img2
			{
			
			
			height: 140px; 
      background-color: #ffffff;
			background: #ffffff;
			margin-left: -1px;
			margin-right: -1px;
      border-right: dashed 1px #03A9F4;
			
			}
			#img3
			{
			height: 140px;
			background-color: #ffffff;
			background: #ffffff;
			margin-right: -1px;
			margin-left: -1px;
			margin-bottom: -1px;
			
			} 
			
			#img11{
			margin-top: 25px;
			
			
			}
			#img22{
			margin-top: 25px;
			
			}
			#img33{
			margin-top: 25px;
			}
			
			
			#content{
			
			
			padding: 0;
			margin-top: 100px;
			
			}
			#content1{
			margin-top: 100px;
			
			padding: 0;
			}
			.container .jumbotron{
			
			border-top-left-radius: 0px;
			border-bottom-left-radius: 0px;
			
			}
			}
		</style>
		
	
		<script type="text/javascript">
			function cancel(){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("demo").innerHTML = xhttp.responseText;
					}
				};
				xhttp.open("GET", "ajax_info2.php", true);
				xhttp.send();
			}
      
		</script>
		<script type="text/javascript">
			function showUser(str) {
				if (str == "") {
					document.getElementById("txtHint").innerHTML = "";
					return;
					} else { 
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET","exam_detail.php?q="+str,true);
					xmlhttp.send();
				}
			}
				function showUser5(str) {
				if (str == "") {
					document.getElementById("profi").innerHTML = "";
					return;
					} else { 
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("profi").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("POST","profile_get.php",true);
					xmlhttp.send();
				}
			}
      
      function loadDoc2() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("demo3").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "ceri.php", true);
  xhttp.send();
}


 function loadDoc5() {   /*  this function is called when cancel button on profile edit section(profile.php)   */
 
 location.reload(true);  /*  location.reload if set to true,reloads the page    */
}


			
      	function showUser3(str) {
       
   
         
					if (str == "") {
					document.getElementById("txtHint").innerHTML = "";
          
					return;
					} else { 
             
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
                        
						} else {
						// code for IE6, IE5
                   
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
          
					xmlhttp.onreadystatechange = function() {
                                    
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                    
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                                                                
						}
					};
            
					xmlhttp.open("GET","upcoming.php?q="+str,true);
					xmlhttp.send();
				}
			}
      
      function loadDoc3(){
     
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("profi").innerHTML = xhttp.responseText;
					}
				};
				xhttp.open("GET", "profile.php", true);
				xhttp.send();
			}
		</script>
	
		
		<script>
			
      function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "ajax_info.php", true);
  xhttp.send();
}
      
      
			$(document).ready(function(){
				$("#img1").click(function(){
					
					$("#column2").addClass('hidden');
					$("#column3").addClass('hidden');
					$("#column1").removeClass('hidden');
					$(".jumbotron").css('background-image','url("../../images/candidate/blue.svg")');
					$(".jumbotron").css('border-top','dashed 1px #03A9F4');
					$(".jumbotron").css('border-bottom','dashed 1px #03A9F4');
					$(".jumbotron").css('border-right','dashed 1px #03A9F4');
					$("#img1").css('background-image','url("../../images/candidate/blue.svg")');
					$("#img1").css('border-top','dashed 1px #03A9F4');
					$("#img1").css('border-bottom','dashed 1px #03A9F4');
					$("#img1").css('border-left','dashed 1px #03A9F4');
					$("#img1").css('border-right','none');
					
					
					$("#img2").css('border-top','none');
					$("#img2").css('border-bottom','none');
					$("#img2").css('border-left','none');
					$("#img2").css('border-right','#03A9F4');
					
					$("#img3").css('border-top','none');
					$("#img3").css('border-bottom','none');
					$("#img3").css('border-left','none');
					$("#img3").css('border-right','#03A9F4');
					
					$("#img11").attr('src','../../images/candidate/profile_black.png');
					$("#img22").attr('src','../../images/candidate/register_green.png');
					$("#img33").attr('src','../../images/candidate/certificate_orange.png');
					$("#img2").css('background-image','none');
					$("#img3").css('background-image','none');
					
					
					
					
				});   
				$("#img2").click(function(){
					
					
					
					$("#column1").addClass('hidden');
					$("#column3").addClass('hidden'); 
					$("#column2").removeClass('hidden');
					
					$(".jumbotron").css('background-image','url("../../images/candidate/green.svg")');
					$(".jumbotron").css('border-top','dashed 1px #4CAF50');
					$(".jumbotron").css('border-bottom','dashed 1px #4CAF50');
					$(".jumbotron").css('border-right','dashed 1px #4CAF50');
					
					
					$("#img2").css('background-image','url("../../images/candidate/green.svg")');
					$("#img2").css('border-right','none');
					$("#img2").css('border-top','dashed 1px #4CAF50');
					$("#img2").css('border-bottom','dashed 1px #4CAF50');
					$("#img2").css('border-left','dashed 1px #4CAF50');
          $("#img2").css('margin-right','-1px');
					
					$("#img3").css('border-right','dashed 1px #4CAF50');
					$("#img3").css('border-top','none');
					$("#img3").css('border-left','none');
					$("#img3").css('border-bottom','none');
					$("#img3").css('background-image','none');
					
					$("#img1").css('background-image','none');
					
					$("#img1").css('border-top','none');
					$("#img1").css('border-left','none');
					$("#img1").css('border-bottom','none');
					$("#img1").css('border-right','dashed 1px #4CAF50');
					
					$("#img22").attr('src','../../images/candidate/register_black.png');
					$("#img11").attr('src','../../images/candidate/profile_blue.png');
					$("#img33").attr('src','../../images/candidate/certificate_orange.png');
					
					
					
				});
				$("#img3").click(function(){
					
					/* $("#column3").removeClass('hidden'); */
					$("#column1").addClass('hidden');
					$("#column2").addClass('hidden');
					$("#column3").removeClass('hidden');
					/*$("#column2").addClass('hidden'); */
					
					$(".jumbotron").css('background-image','url("../../images/candidate/orange.svg")');
					$(".jumbotron").css('border-top','dashed 1px #FF9800');
					$(".jumbotron").css('border-bottom','dashed 1px #FF9800');
					$(".jumbotron").css('border-right','dashed 1px #FF9800');
					
					
					$("#img3").css('background-image','url("../../images/candidate/orange.svg")');
					$("#img3").css('border-right','none');
					$("#img3").css('border-top','dashed 1px #FF9800');
					$("#img3").css('border-bottom','dashed 1px #FF9800');
					$("#img3").css('border-left','dashed 1px #FF9800');
					
					
					
					
					
					$("#img1").css('background-image','none');
					$("#img2").css('background-image','none');
					
					$("#img1").css('border-top','none');
					$("#img1").css('border-left','none');
					$("#img1").css('border-bottom','none');
					$("#img1").css('border-right','dashed 1px #FF9800');
					
					$("#img2").css('border-top','none');
					$("#img2").css('border-left','none');
					$("#img2").css('border-bottom','none');
					$("#img2").css('border-right','dashed 1px #FF9800');
					
					$("#img22").attr('src','../../images/candidate/register_green.png');
					$("#img11").attr('src','../../images/candidate/profile_blue.png');
					$("#img33").attr('src','../../images/candidate/certificate_black.png');
					
					
				});  
			});
			
			function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "profile_edit.php", true);
  xhttp.send();
}
		</script> 
	</head>
	<body style="background-color:#fff">
		
		<div id="topbar1">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../images/common/logo_myskillindex.jpeg" width="170px" height="95px" style="margin-top:-15px"></a>
	</div>
	
	<div id="topbar" >
		<a href="logout.php" color="white" ><span style="margin-right:-1350px"><img src="../../images/candidate/exit.png" width="30px" height="28px" style="margin-top:-5px">&nbsp;&nbsp;<font color="white">Logout</font></span></a>
	</div>
	
	<div class="container" style="margin-top:-50px;">
		<div class="row" >
			
			<div id="content1" class="col-md-3">
				<div class="sidebar-nav">
					<div class="navbar navbar-default" role="navigation">
						
						
						<!--    <div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"><img src="images/profile_blue.png" width="" height=""></span>
							<span class="icon-bar"><img src="images/profile_blue.png" width="" height=""></span>
							<span class="icon-bar"><img src="images/profile_blue.png" width="" height=""></span>
							</button>
							<span class="visible-xs navbar-brand">Sidebar menu</span>
						</div> <! /navbar header -->
						
						
						<div id="list" class="navbar-collapse collapse sidebar-navbar-collapse">
							<ul class="nav navbar-nav" id="mynav" >
								<li id="li1"><a  id="img1" style="background-image: url('../../images/candidate/blue.svg');border-top: dashed 1px #03A9F4;border-bottom: dashed 1px #03A9F4;border-left: dashed 1px #03A9F4;"><center><img id="img11" src="../../images/candidate/profile_black.png" width="" height=""></center></a></li>
								<li id="li2"> <a   id="img2" style="border-right: dashed 1px #03A9F4"><center><img id="img22" src="../../images/candidate/register_green.png"></center></a></li>
								<li id="li3"><a  id="img3" style="border-right: dashed 1px #03A9F4"><center><img id="img33" src="../../images/candidate/certificate_orange.png"></center></a></li>
							</ul>
						</div><!--/.nav-collapse -->
						
					</div><!-- /navbar navbar default-->
				</div><!-- /side-bar nav -->
			</div><!-- /col-md-3 -->
			
			
			
			
			<div id="content" style="display:inline-block" class="container col-md-7">
				<div class="jumbotron clearfix" style="width:800px;height:420px;position: relative;margin-top:1px;overflow:auto;background-image:url("../../images/candidate/blue.svg") ">
					
					
					<div id="column1" >
						<div><h3 style="position: absolute;margin-left:300px;margin-top:-35px;font-weight:bold" >Profile &nbsp; <img src="../../images/candidate/edit.png"
             height="20" width="20" onclick="loadDoc3()" /></h3> </div>
						<!---- Image upload button code -->

						<!---- Image upload code END-->
						
						
						<div id="userphoto" style="position: absolute;top: 0;right: 0;border: 2px solid #03A9F4;margin-top:5px;margin-right:5px">
							<?php $query="select * from t_candidate_1 where candidate_id= '{$_SESSION['id']}'
								";
								$result = mysqli_query($connection,$query);
								$row = mysqli_fetch_assoc($result);
								echo '<img "height="130" width="150" src="../../images/candidate/' . $row["image"] . '" >';
							?>
								<form id="form2" method="post" action="image_update.php" enctype="multipart/form-data">
							
								<span class="select-wrapper">
									<input type="file" name="img2" id="file"  onchange="this.form.submit()">
								</span>
							
						</form>

						</div> <!-- /userphoto -->
						
						<div id="profi" >
						<table class="table">
							<tbody>
								<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Name:</h4></td><td><?php echo '<h5>'.$_SESSION['name'].'</h5>' ?></td> </tr>
								<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Email:</h4></td><td><?php echo '<h5>'.$_SESSION['email'].'</h5>' ?></td></tr>
								<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Contact:</h4></td><td><?php echo '<h5>'.$_SESSION['contact'].'</h5>' ?></td></tr>
								<tr> <td style="width:30%"><h4 style="text-align:right;font-weight:bold">Address:</h4></td><td><?php echo '<h5>'.$_SESSION['address'].'</h5>' ?></td></tr>
								<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Aadhar Card Number:</h4></td><td><?php echo '<h5>'.$_SESSION['aadhar'].'</h5>' ?></td></tr>
								<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Candidate Id:</h4></td><td><?php echo '<h5>'.$_SESSION['id'].'</h5>' ?> </td></tr>
								
							</tbody>
							
						</table>
                      </div>
						</div>
						<!-- </div> --><!-- /container -->
						
					 <!-- /column1 -->
					
					<div id="column2" class="hidden" >
					<center><h3 style="margin-top:-35px;">Register and Upcoming Exams </h3></center>
                      <h5 style="font-weight:bold;margin-bottom:1px;">Register</h5>
					<hr class="hr">
                        
                            <div class="fleft" style="border:dashed 1px #4CAF50;width:223px;display:inline">
								<?php
									//query used to get list of nos from db
									$sql = "SELECT * FROM t_exam_org_qp";
									$result = mysqli_query($connection,$sql);
									
									echo "<select class='selectpicker' name='users' onchange='showUser(this.value)' style='width:150px;'  id='cd-dropdown' class='cd-select' >
									<option value='' >Register For The Exam</option>";
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='" . $row['exam_name'] . "'>" . $row['exam_name'] . "</option>";
										
									}
									echo "</select>";
								?>
							</div>
 
						   <div id="txtHint"><h4></h4>
							   
							   <hr>
                            <h4>Upcoming Exams</h4>
<div style="display:overflow-y:scroll">
	<table class="table" style="height:10px;display:overflow-y:scroll">
		<thead >
			<tr>
				<th>Exam Name</th>
				<th>Registered on</th>
				<th>Duartion</th>
				<th style="width:20%"></th>
				<th></th>
			</tr>
		</thead>
		<tbody style="height:10px;display:overflow-y:scroll">
		
			
			<?php $query = "select * from t_candidate_exam where candidate_id = '{$_SESSION['id']}'
				and exam_date is null " ;
				$result=mysqli_query($connection,$query);
				while ($row=mysqli_fetch_assoc($result))
				
				{   $regon = $row['registration_date'];
       
       	$exam_id= $row['exam_id'];
					$query2 = "select * from t_exam_survey where exam_id = '{$exam_id}' " ;
					$result2=mysqli_query($connection,$query2);
					while ($row2=mysqli_fetch_assoc($result2))
               $survey_link= $row2['survey_link'];
					
					{ 
						
						$query3 = "select * from t_exam_org_qp where exam_id = '{$exam_id}' " ;
						$result3=mysqli_query($connection,$query3);
						while ($row3=mysqli_fetch_assoc($result3))
						{ 
							if($i%2 == 0 ){
								$class="warning";
								
								}
								else if($i%3 == 0 ){
								$class="info";
								
								}
								else if($i%4 == 0 ){
									$class="success";
								
								}
								else if($i%5 == 0 ){
									$class="active";
								
								}
								else
								{
									$class="danger";
									}
							
							 
							echo '<tr>
							<td>' .$row3['exam_name'].'</td>
							<td>'.$regon.'</td>
							<td>'.$row3['exam_time'].'</td>';
						echo '<td ><a href="end_date.php?link='.$survey_link.'"><font>Take now</font></a></td>
							<td><span class="glyphicon glyphicon-remove"></span></td>
							</tr>
							';
							
							++$i;
							
							
						}
						
						
						}
        }
        
							
		 $rowcount=mysqli_num_rows($result3);
     // echo $rowcount;
     if($rowcount == 0){
     
       		echo '<tr>
							<td><i>Looks like you have not registered for a Exam ....</td>
							<td></td>
							<td></td>
							<td ></td>
						
							</tr>
							';
     
     }
     
     
     
     else{
     
     
     }
				
			?>
			
		</tbody>
	</table>
	<hr>
</div>
							   
							   </div>
							
							
							
						
					
						<!-- form -->
						
						
						
				</div> <!-- /column2 -->
				<div id="column3" class="hidden">
					<div id="demo3">
					<center><h3 style="margin-top:-35px;">Certificates </h3><img onclick="loadDoc2()" src="../../images/common/refresh.png" height="30" width="30" ></center>
					<hr>
					
              <table class="table" style="background: rgba(255,255,255,0);">
						<thead>
							<tr>
								<th><center>Certificates of Completion</center></th>
								<th><center>Completion Date</center></th>
                                <th><center>Marks Scored</center></th>
                                <th><center>Percentile</center></th>
                                <th><center>Download Certificate</center></th>
                                                                   
							
							</tr>
						</thead>
                                                                   	<tbody>
              
              
           
           
					
				
					    <?php 
                                                                               
                        //code for percentile **********************************************************************************************************888//////
 
 
 
 	$query = "select MAX(marks_scored) from t_candidate_result where exam_id  = '{$_SESSION['exam_id']}' " ;
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************maximum marks*********************";
 	//	echo $max= $row['MAX(marks_scored)'];
 		//echo "**************************************";
 		//Your percentile score = { (No, of people who got less than you/ equal to you) / (no. of people appearing in the exam) } x 100
 		
 		$query = " select COUNT(candidate_id) from t_candidate_result where exam_id  = '{$_SESSION['exam_id']}'  and marks_scored <= '{$marks}' ";
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************num of people equal or less than u *********************";
 	    $num_people = $row['COUNT(candidate_id)'];
 	//	echo "**************************************";
 		
 		$query = " select COUNT(candidate_id) from t_candidate_result where exam_id = '{$_SESSION['exam_id']}'  ";
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

 
 
 //***********************************************************************************************************************************                                                       
                                                                               
                                                                               
          $id=    $_SESSION['id'];
              $query = "select * from t_candidate_result where candidate_id = '{$_SESSION['id']}' " ;
               $result = mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($result))
               {
               
               $marksS = $row['marks_scored'];
                  $exam_id = $row['exam_id'];
                   $query2 = "select * from t_exam_org_qp where exam_id = '{$exam_id}' " ;
               $result2 = mysqli_query($connection,$query2);
               while($row2 = mysqli_fetch_assoc($result2))
               {
                 $examN = $row2['exam_name'];
                    $query3 = "select * from t_candidate_exam where exam_id = '{$exam_id}' AND candidate_id= '{$id}' AND fail = '1' ";
               $result3 = mysqli_query($connection,$query3);
               while($row3 = mysqli_fetch_assoc($result3))
               {
                  
                   $examD = $row3['exam_date'];
                   
                   
					echo '	<tr>
								<td><center><strong>'.$examN.'</center></td>
							<td><center><strong>'.$examD.'</center></td>
							<td><center><strong>'.$marksS.'</center></td>
                                                                <td><center><strong>'.$percentile.'</center></td>
                                                                          	<td><center>
                                                                            
                                                                          <a href="certificate.php?id='. $exam_id.'">  <img height="20" width="20" src="../../images/candidate/pdf_thumbnail.png" /></a></center></td>
							</tr>';
               
             } } }
             
             ?>
							
						</tbody>
					</table>
                  </div>
				</div> 
				
			</div> <!-- /column 3 -->
			
		</div> <!-- /jumbotron -->
	</div> <!-- /content -->
	
</div><!-- row -->
</div><!-- container most outer -->

<div id="footer" >
	<br>
	<center><code style="background-color:#ffffff;">Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
	
</div>



</body>
</html>