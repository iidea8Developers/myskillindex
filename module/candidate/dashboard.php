<!DOCTYPE html>
<!-- It dispaly profile,upcoming exam of user,enable user to register for exam, and show certificated of exams completed user 
      created by vivek singh
      last time modified by vivek singh
      modified on 12-04-2016
      modifiction: corrected original get request as get is more fast than post and post is not required for this small data -->
<?php
	/*
	Usage: Main Candidate display screen. 
			User has option to 
			1. Update Profile
			2. Search and Register for exams
			3. Launch exams
			4. view history and certificates

	*/

	session_start();
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');

	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('Dashboard.php');

	$log->info("****START Dashboard.php****");
	// session check
	if ((isset($_SESSION["user"]))){
		$log->debug("SESSION OK - Session User :".$_SESSION["user"]);
		}
		else
		{
			$log->error("Session ERROR - Session User :".$_SESSION["user"]);
			session_destroy();
			header("Location:../../service/common/error_page.php");
		}
	// Fetch Candidate Details from t_candidate_1 table
	try
	{
		$query= "SELECT candidate_id,
						candidate_fname,
						candidate_mname,
						candidate_lname,
						candidate_email,
						candidate_password,
						candidate_address_home,
						candidate_address_street,
						candidate_address_city,
						candidate_address_state,
						candidate_address_postalcode,
						candidate_aadhar,
						candidate_contact,
						candidate_image
				 	FROM t_candidate_1 
				 	WHERE candidate_email='{$_SESSION['user']}'";
		$log->debug("Fetching Candidate Details - SQL Statement - ".$query);
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_assoc($result);
		$_SESSION['name']     = $row['candidate_fname']." ".$row['candidate_mname']. " ".$row['candidate_lname'];
	  	$_SESSION['password'] = $row['candidate_password'];
		$_SESSION['email']    = $row['candidate_email'];
		$_SESSION['contact']  = $row['candidate_contact'];
		$_SESSION['address']  = $row['candidate_address_home']." ".$row['candidate_address_street']." ".$row['candidate_address_city']." ".$row['candidate_address_postalcode'];
		$_SESSION['id']       = $row['candidate_id'];
	  	$_SESSION['image']    = $row['candidate_image'];
	  	
  	}catch(exception $e)
				{
				    // log error msg in log file
				    $log->error($e->getMessage());
				    //$elog->error("critical system failure");
				 }
?>

<html>
	<head>
		<title></title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
		
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css">


		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
   		
		<!-- (Optional) Latest compiled and minified JavaScript translation files 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>-->
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
			.sidebar-nav .navbar .navbar-collapse {padding: 0;max-height: none;}
	        .hr{margin-top:2px;}
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
			#topbar1 a:hover {opacity: 1;}
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
			#topbar a:hover {opacity: 1;}
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

			.error {
    width:200px;
    height:20px;
    height:auto;
    position:absolute;
    left:50%;
    margin-left:-100px;
    bottom:10px;
    background-color: #383838;
    color: #F0F0F0;
    font-family: Calibri;
    font-size: 20px;
    padding:10px;
    text-align:center;
    border-radius: 2px;
    -webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
}


			#img1{
				height: 140px;
	      		margin-right: -1px;
				margin-left: -1px;
				margin-top: -1px;
	      		background-color: #ffffff;
				background: #ffffff;
			}
			#img2{
				height: 140px; 
	      		background-color: #ffffff;
				background: #ffffff;
				margin-left: -1px;
				margin-right: -1px;
	      		border-right: dashed 1px #03A9F4;
			}
			#img3{
				height: 140px;
				background-color: #ffffff;
				background: #ffffff;
				margin-right: -1px;
				margin-left: -1px;
				margin-bottom: -1px;
			} 
			#img11{margin-top: 25px;}
			#img22{margin-top: 25px;}
			#img33{margin-top: 25px;}
			#content{
				padding: 0;
				margin-top: 100px;
			}
			#content1{
				margin-top: 100px;
				padding: 0;
			}

			
			/* ******************Check Below Syntax********************** 
			Container to call jumbotron
			*/
			.container .jumbotron{
				border-top-left-radius: 0px;
				border-bottom-left-radius: 0px;
			}
			}
		</style>
    	<!--Java Script functions to display information on the screen-->

<script type="text/javascript">
	

			// showUser3 calls upcoming.php
			 function showUser3(str) 
	     	{
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
								document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
							}
						};
					
						xmlhttp.open("GET","register_exam.php?q="+str,true);
						xmlhttp.send(null);
            //windows.location.reload(true);                                               
						}
			}  
			// showUser5 calls profile_get.php
			
      		function loadDoc2() 
      		{
  				var xhttp = new XMLHttpRequest();
  				xhttp.onreadystatechange = function() {
    				if (xhttp.readyState == 4 && xhttp.status == 200) {
     					document.getElementById("demo3").innerHTML = xhttp.responseText;
    				}
  				};
		
  				xhttp.open("GET", "ceri.php", true);
  				xhttp.send();
			}
			function loadDoc3()
      		{
     			// Image upload button call
     			var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("profi").innerHTML = xhttp.responseText;
					}
				};
			
				xhttp.open("GET", "profile.php", true);
				xhttp.send();
			}

			// this function is used to return back to dashboard after click on cancel
			function loadDoc5() 
			{
			 /* var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (xhttp.readyState == 4 && xhttp.status == 200) {
			     document.getElementById("profi").innerHTML = xhttp.responseText;
			    }
			  };
			  xhttp.open("GET", "profile_get.php", true);
			  xhttp.send();*/
			
			  window.location.assign("dashboard.php")
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
                	var xhttp = new XMLHttpRequest();
  					xhttp.onreadystatechange = function() {
				    	if (xhttp.readyState == 4 && xhttp.status == 200) {
				    		document.getElementById("upcoming").innerHTML = xhttp.responseText;
    					}
  					};
			  		xhttp.open("GET", "upcoming_controller.php", true);
			  		xhttp.send();
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
            // it will delete the exam 
			function cancel_exam(val1){
				var xhttp;
        		xhttp = new XMLHttpRequest();
        		xhttp.open("GET","delete_exam.php?id=" + (val1.id).split('_')[1], true);
       			xhttp.onreadystatechange = function() {
       				
            		if (xhttp.readyState == 4 && xhttp.status == 200) {
                		
            		}
        		};
        		xhttp.send();                
             
			}	
            
            // this function is used to hide deleted exam on the front end side
			function cancel_exam_front(val2){
            $(val2).parent().parent().hide();
            }
</script> 

<script type="text/javascript">
	
$(window).load(function(){

	$('#cd-dropdown').change(function() {
  var value = $( "#cd-dropdown option:selected").val();
    console.log(value);
    if(value){
        $('#myModal').modal('show');
   }
   if(!value){
        $('#myModal').modal('false');
   }

   $.ajax({
          type : 'get',
           url : 'exam_detail.php', // in here you should put your query 
          data :  'q='+ value, // here you pass your id via ajax .
                      
       success : function(r)
           {
              // now you can show output in your modal 
              $('#myModal').show();  // put your modal id 
             $('.something').show().html(r);
           }
    });
});



	$('.glyphicon-pencil').click(function() {
  
        $('#myModal2').modal(

        {
            show: true
        });
  

   $.ajax({
          type : 'get',
           url : 'profile.php', // in here you should put your query 
       success : function(r)
           {
              // now you can show output in your modal 
              $('#myModal2').show();  // put your modal id 
             $('.something2').show().html(r);
           }
    });
});
    
});



</script>
<script type="text/javascript">
	
$('.error').fadeIn(400).delay(3000).fadeOut(400);

	
</script>
<body style="background-color:#fff">
	<div id="topbar1">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../images/common/logo_myskillindex.jpeg" width="170px" height="95px" style="margin-top:-15px"></a>
	</div>
	<div id="topbar" >
		<a href="logout.php" color="white" ><span style="margin-right:-1350px"><img src="../../images/candidate/exit.png" width="30px" height="28px" style="margin-top:-5px">&nbsp;&nbsp;<font color="white">Logout</font></span></a>
	</div>
	<!-- Side panel Navigation Tabs - profile / register or upcoming / certificates-->
	<div class="container" style="margin-top:-50px;">
		<div class="row" >
			<div id="content1" class="col-md-3">
				<div class="sidebar-nav">
					<div class="navbar navbar-default" role="navigation">
							<!-- Code to make nav bar verticle (default is horizontal)-->							
							<div id="list" class="navbar-collapse collapse sidebar-navbar-collapse">
								<ul class="nav navbar-nav" id="mynav" >
									<li id="li1">
										<a  id="img1" style="background-image: url('../../images/candidate/blue.svg');border-top: dashed 1px #03A9F4;border-bottom: dashed 1px #03A9F4;border-left: dashed 1px #03A9F4;">
											<center>
												<img id="img11" src="../../images/candidate/profile_black.png" width="" height="">
											</center>
										</a>
									</li>
									<li id="li2"> 
										<a   id="img2" style="border-right: dashed 1px #03A9F4">
											<center>
												<img id="img22" src="../../images/candidate/register_green.png">
											</center>
										</a>
									</li>
									<li id="li3">
										<a  id="img3" style="border-right: dashed 1px #03A9F4">
											<center>
												<img id="img33" src="../../images/candidate/certificate_orange.png">
											</center>
										</a>
									</li>
								</ul>
							</div><!--/.nav-collapse -->
					</div><!-- /navbar navbar default-->
				</div><!-- /side-bar nav -->
			</div><!-- /col-md-3 -->
			<div id="content" style="display:inline-block" class="container col-md-7">
				<div class="jumbotron clearfix" style="width:800px;height:420px;position: relative;margin-top:1px;overflow:auto;background-image: url('../../images/candidate/blue.svg'); ">
					<div id="column1" >
						<div>
							<h3 style="position:absolute;margin-left:300px;margin-top:-35px;font-weight:bold" >
								Profile &nbsp; 
								<span class="glyphicon glyphicon-pencil"></span>
							</h3> 
						</div><!-- Profile Update button code -->
							<!-- Image load code START-->
						<div id="userphoto" style="position: absolute;top: 0;right: 0;border: 2px solid #03A9F4;margin-top:5px;margin-right:5px">
							<?php 
								$log->debug("Dashboard.php - inside div id = userphoto ");
								try{
								$query="SELECT candidate_image
										FROM t_candidate_1 
										WHERE candidate_id = '{$_SESSION['id']}'";
								$log->debug("Dashboard.php - SQL Query ".$query);
								$result = mysqli_query($connection,$query);
								if($result == FALSE)
								{
									throw new Exception($result);
								}
								$row = mysqli_fetch_assoc($result);
								//$error = 'Always throw this error';
                                //throw new Exception($this->mysqli->error);
								}
								catch(Exception $e){
									$log->error("error in sql query: ".$query);
									$log->error($e->getMessage());
                                	$error_header_php="Error retrieving profile details." ;
                                	$error_message_php="Error in retrieving your profile details. Please try after some time. If the error persists, please contact admin@iidea8.com";
                                	custom_error($error_header_php,$error_message_php);
								}
	 echo '<img "height="130" width="150" src="../../images/candidate/' . $row["candidate_image"]. '" >';
							?>
		<form  method="post" action="image_update.php" enctype="multipart/form-data">
								<span class="select-wrapper">
									<input type="file" name="pic" id="file"  onchange="this.form.submit()">
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
								
										<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Candidate Id:</h4></td><td><?php echo '<h5>'.$_SESSION['id'].'</h5>' ?> </td></tr>
									</tbody>
								</table>
	                      	</div> <!-- /profi-->

	                      	<div id="myModal2" class="modal fade" role="dialog">
                               <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <center><h4 class="modal-title">Profile Information change</h4></center>
                                    </div>
                                    <div class="modal-body" id="content2">
                                      
                                      <div class="something2" style="display:none;">
                    
                                      </div>
                                    </div>
                                   
                                  </div>
                              
                                </div>
                              </div>
						</div><!-- /column 1-->
						<!-- </div> --><!-- /container -->
						<div id="column2" class="hidden" >
                         
							<center><h3 style="margin-top:-35px;">Register and Upcoming Exams </h3></center>
                      		<h5 style="font-weight:bold;margin-bottom:1px;">Register</h5>
							<hr class="hr">
                            <div class="fleft" style="border:dashed 1px #4CAF50;width:223px;display:inline">
								<?php
									//query used to get list of nos from db
									$sql = "SELECT exam_name
										    FROM t_exam_org_qp";
									$result = mysqli_query($connection,$sql);
									$log->debug("in CLass fleft - SQL Statement - ".$sql);
									echo "<select class='selectpicker' name='users' style='width:150px;'  id='cd-dropdown' class='cd-select' >
									<option value='' id='select-option'>Register For The Exam</option>";
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='" . $row['exam_name'] . "'>" . $row['exam_name'] . "</option>";
										$log->debug("in CLass fleft / result rows - ".$row['exam_name']);
									}
									echo "</select>";

								?>

								<div class='error' style='display:none'>Event Created</div>
							
							</div><!-- / fleft-->

							<div id="myModal" class="modal fade" role="dialog">
                               <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <center><h4 class="modal-title">Exam Details</h4></center>
                                    </div>
                                    <div class="modal-body" id="content">
                                      
                                      <div class="something" style="display:none;">
                    
                                      </div>
                                    </div>
                                   
                                  </div>
                              
                                </div>
                              </div>

			             
						
 							<div id="txtHint"></div><!-- / txtHint-->
							 	<hr>
							 	<div id="txtHint2"><!-- this div is used to append  upcoming exam part-->
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
											<tbody style="height:10px;display:overflow-y:scroll" id="upcoming">
											</tbody>
										</table>
									<hr>
									</div> <!-- display:overflow-y:scroll -->
							 </div> <!-- txthint2 -->
						</div> <!-- /  column2 -->
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
                     
              				/*	$sql = "SELECT marks_scored FROM t_candidate_result WHERE candidate_id='{$_SESSION['id']}'";
									$result = mysqli_query($connection,$sql);
									while ($row = mysqli_fetch_assoc($result)) {
										$sql1="SELECT exam_id,exam_end_time,candidate_id FROM t_candidate_exam";
										$result1 = mysqli_query($connection,$sql1);
                                         while ($row1 = mysqli_fetch_assoc($result1)){ */


                                         $sql ="	SELECT 	
                                                 	tc1.candidate_fname,
                                                 	tc1.candidate_lname,
                                                 	tce.exam_id,
                                                 	te.exam_desc,
                                                 	tce.exam_end_time,
                                                 	tcr.marks_scored
                                                 	
                                                 FROM t_candidate_exam tce,
                                                 	 t_candidate_1 tc1,
                                                 	 t_exam_org_qp te,
                                                 	 t_candidate_result tcr
                                                 	
                                                 WHERE tc1.candidate_id = '{$_SESSION['id']}'
                                                 AND   tc1.candidate_id = tce.candidate_id
                                                 AND   tce.exam_id = te.exam_id 
                                                 AND   tce.exam_id = tcr.exam_id";
                                                 $result = mysqli_query($connection,$sql);
                                                 while($row = mysqli_fetch_assoc($result)){
									echo '	<tr>
													<td><center><strong>'.$row['exam_desc'].'</center></td>
													<td><center><strong>'.$row['exam_end_time'].'</center></td>
													<td><center><strong>'.$row['marks_scored'].'</center></td>
                                                    <td><center><strong>'.$row['marks_scored'].'</center></td>
                                                    <td><center><a href="certificate_html.php?end_date='.$row['exam_end_time'].'&fname='.$row['candidate_fname'].'&lname='.$row['candidate_lname'].'&mscored='.$row['marks_scored'].'&examdesc='.$row['exam_desc'].'"   target="_blank">  <img height="20" width="20" src="../../images/candidate/pdf_thumbnail.png" /></a></center></td>
											 </tr>';
                                      }
								//	}
								// }
                   					
                   					?>
								</tbody>
								</table>
                  			</div><!-- / demo3-->
						</div> <!--/ column3-->
					</div> <!-- /jumbotron -->
				</div> <!-- /content -->
			</div> <!-- /row -->
	
		</div><!-- container -->
		<div id="footer" >
			<br>
			<center><code style="background-color:#ffffff;">Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
		</div>

	</body>
</html>