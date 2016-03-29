<!-- Candidate Site Login Screen-->

<!-- 
Modified on 26-03-2016
Modified By : Pranab Pandey

Definition: index.php is the landing page for myskillindex.com
Usage: Login , signup and forgot/retrieve password

-->

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<!-- CSS reset -->
	<link rel="stylesheet" href="../../css/candidate/reset1.css"> 
	<!-- Gem style -->
	<link rel="stylesheet" href="../../css/candidate/style1.css"> 

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
		
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 	<!-- Modernizr -->
	<script src="js/modernizr.js"></script>
  	
	<title>Log In &amp; Sign Up Form</title>

	<!-- Gem jQuery -->
	<!--Script to validate entry of username / password on signin -->
	<script>
	

		$('#form1').validate({   
		   excluded: ':hidden', 
		    	rules: 	{
			        username: {
			            minlength: 1,
			            maxlength: 15,
			            required: true
			        },
			        password: {
			            minlength: 1,
			            maxlength: 15,
			            required: true
			        }
		    	},
		    highlight: function(element) {
		        var id_attr = "#" + $( element ).attr("id") + "1";
		        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
		    },
		    unhighlight: function(element) {
		        var id_attr = "#" + $( element ).attr("id") + "1";
		        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
		    },
		    errorElement: 'span',
		    errorClass: 'help-block',
		    errorPlacement: function(error, element) {
	            if(element.length) {
	                error.insertAfter(element);
	            } else {
	            error.insertAfter(element);
	            }
		    } 
	 	});

	</script>
	<!--*************************Observation*******************
	26-03-2016: Should style not be in css file?
	-->	
	<style type="text/css">
		body{
				background-repeat: no-repeat;
				background-size: cover;
			}
		#button:hover,#button:active {
			    /* border glow effect on hover */
			    box-shadow: 0px 0px 20px #2196F3;
			    filter:progid:DXImageTransform.Microsoft.Glow(Color=black,Strength=20);
				}
		.bt-login:hover,.bt-login:active{
				box-shadow: 0px 0px 20px #2196F3;
				filter:progid:DXImageTransform.Microsoft.Glow(Color=black,Strength=20);
				}
		#footer {
				width:100%;
				height:50px;
				position: fixed;
				bottom:0;
				left:0
				}
		#topbar {
				background: #00BCD4;
				padding: 10px 0 10px 0;
				text-align: center;
				height: 40px;
				overflow: hidden; 
				-webkit-transition: height 0.5s linear;
				-moz-transition: height 0.5s linear;
				transition: height 0.5s linear;
				}
		/* topbar1 is the first header on the index landing page containing myskillindex logo */
		#topbar1{
				background: #ffffff;
				padding: 10px 0 10px 0;
				text-align: left;
				height: 75px;
				overflow: hidden;
				-webkit-transition: height 0.5s linear;
				-moz-transition: height 0.5s linear;
				transition: height 0.5s linear;
				}
		#v1		{
	              width: 40%;
	              height: 40%;
	              position: center;
				}
	</style>
	<!-- Script to show the tabs for signin, signup and forget password -->
	<script>
	<?php
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('index.php');
	?>

	//$log->info("****START index.php****");

		$(document).ready(function(){
		$(document).on('click','.signup-tab',function(e){
			e.preventDefault();
		    $('#signup-taba').tab('show');
		});	
		
		$(document).on('click','.signin-tab',function(e){
		   	e.preventDefault();
		    $('#signin-taba').tab('show');
		});
		    	
		$(document).on('click','.forgetpass-tab',function(e){
		 	e.preventDefault();
		   	$('#forgetpass-taba').tab('show');
		});

		//Ajax code written on 23/3/2016 by jitendra to show error message on login form
		//last modified on 29/03/2016 by jitendra
	$("#reset_btn").click(function(){
		//$log->info(" reset button called ");
		if($("#femail").val() == ""){
             $("#error_message").html("Enter email address");
		}
		else{
			var request;
			// associated array is created that is passed using send()
			// femail is key of array that is fetched by forget.php using post
		    var fe = "femail="+ $("#femail").val();
			// create XMLHttpRequest object 
			if(window.XMLHttpRequest){
				request = new XMLHttpRequest();
			}
			else{
				request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			//request made to server
            request.open("POST","../../service/common/forget.php",true);
            // Set content type header information for sending url encoded variables in the request
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
			request.onreadystatechange = function() {
				if((request.readyState == 4) && (request.status == 200)){
					$("#error_message").html(request.responseText);
				}
			}
			// Send the data to PHP now..
			request.send(fe);
		}
		// to stop form submission
		$("#forget_login_form").submit(function(){
			<?php $log->info("submission "); ?>
		    return false;
	    });	
	});
	//to clear error message and input value on focus
	$('input').focus(function(){
		this.value="";
		$('#error_message').html("");
	});
	});	
	</script>
	<!-- Script to validate if the pasword mathches with confirm password option-->
	<!-- ********************Observation ***************
	26-03-2016: function not used in code today. Signup page does not ask for password 2 times for confirmation.
	-->
	<script type="text/javascript">
		var password = document.getElementById("password");
		var confirm_password = document.getElementById("Cpassword");
		
		function validatePassword()
		{
		  	if(password.value != confirm_password.value) 
		  	{
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  	} else {
		    		confirm_password.setCustomValidity('');
		  			}
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
</head>

<body>
	<div id="topbar1">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../images/common/logo_myskillindex.jpeg" width="170px" height="95px" style="margin-top:-15px"></a>
	</div>
	<header role="banner" id="topbar" style="background-color:#00BCD4">
		<nav class="main-nav" id="topbar">
		</nav>
	</header>

	<div class="container">
		<!--show animation for various devices-->
		<div class="row">
			<video class="col-md-6" id="v1" autoplay loop poster="polina.jpg" id="bgvid">
	   			<source src="../../images/candidate/v2.webm" type="video/webm">
	    		<source src="../../images/candidate/v1.mp4" type="video/mp4">
			</video>
			<!--index screen main content-->
			<div class="col-md-6" style="font-family:LyonDisplay; Georgia, serif;margin-top: 130px;">
				<h1 style="font-color:#ffffff;">Online Assessment.<br class="visible-xs"> Take Anywhere !</h1>
			</div>
			<div class="col-md-6">
	        	<button id="button" class="btn btn-launch" href="javascript:;" data-toggle="modal" data-target="#loginModal" style="border:solid 1px #0074bf;width:200px;color:#0074bf;background:transparent;margin-left:160px;margin-top:40px">Sign in / Sign up</button>
			</div>
		</div>
	</div>
	<!-- **********Login Modal - IMPORTANT******************-->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:800px">
    		<div class="modal-content login-modal">
	      		<div class="modal-header id="header1" login-modal-header" style="background:transparent;border:solid 1px #2196F3;box-shadow: 0px 0px 20px #2196F3;">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#000000">
	        			<span aria-hidden="true">&times;</span>
	        		</button>
	        		<h3 class="modal-title text-center" id="loginModalLabel" style="font-family:LyonDisplay; Georgia, serif;font-weight:bold;">USER AUTHENTICATION</h4>
	      		</div>
	      		<div class="modal-body" >
	      			<div class="text-center">
		      			<div role="tabpanel" class="login-tab">
						  	<!-- Nav tabs -->
						  	<ul class="nav nav-tabs" role="tablist">
						    	<li role="presentation" class="active"><a id="signin-taba" href="#home" aria-controls="home" role="tab" data-toggle="tab">Sign In</a></li>
						    	<li role="presentation"><a id="signup-taba" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>
						    	<li role="presentation"><a id="forgetpass-taba" href="#forget_password" aria-controls="forget_password" role="tab" data-toggle="tab">Forgot Password</a></li>
						  	</ul>
						
						  	<!-- Tab panes -->
						 	<div class="tab-content">
						    	<div role="tabpanel" class="tab-pane active text-center" id="home">
						    		&nbsp;&nbsp;
						    		<span id="login_fail" class="response_error" style="display: none;">Loggin failed, please try again.</span>
						    		<div class="clearfix"></div>
						    		<form action="../../service/candidate/login_check.php" method="post" id="form1">
										<div class="form-group" id="user1">
									    	<div class="input-group">
									      		<span class="input-group-addon glyphicon glyphicon-user"></span> 
									      		<input type="text" class="form-control"  placeholder="Username" id="username" name="username" >
									      		<span class="glyphicon form-control-feedback" id="fname1"></span>
									    	</div>
									  	</div>
									  	<div class="form-group" id="passw">
									    	<div class="input-group">
									      		<span class="input-group-addon glyphicon glyphicon-user"></span>
									      		<input type="password" class="form-control" id="password" id="password" placeholder="Password" name="password" >
									    	</div>
									    	<span class="help-block has-error" id="password-error"></span>
									  	</div>
								  		<center>
								  			<button type="submit" id="login_btn" class="btn btn-block bt-login" style="border:solid 1px #0074bf;width:200px;color:#0074bf;background:transparent;" data-loading-text="Signing In....">Login</button>
								  		</center>
							  		</form>
							  		<div class="clearfix"></div>
							  		<div class="login-modal-footer">
							  			<div class="row"></div>
							  		</div>
						    	</div>
						    	<div role="tabpanel" class="tab-pane" id="profile" >
						    	    &nbsp;&nbsp;
						    	    <span id="registration_fail" class="response_error" style="display: none;">Registration failed, please try again.</span>
						    		<div class="clearfix"></div>
						    		<center>
						    			<form action="../../service/candidate/register.php" method="post" enctype="multipart/form-data">
											<div class="form-group">
										    	<div class="col-md-4">
											    	<div class="input-group" >
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" name="fname" class="form-control" id="First Name" placeholder="First Name" required title="First Name required">
											    	</div>
										    		<span class="help-block has-error" data-error='0' id="Name1-error"></span>
		                                        </div>
		                                        <div class="col-md-4">
											    	<div class="input-group" >
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" name="mname" class="form-control" id="Name2" placeholder="Middle Name" >
											    	</div>
										    		<span class="help-block has-error" data-error='0' id="Name2-error"></span>
										  	    </div>
										  	    <div class="col-md-4">
											    	<div class="input-group" >
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" class="form-control" name="lname" id="Name3" placeholder="Last Name" required title="Last name required">
											    	</div>
										    		<span class="help-block has-error" data-error='0' id="Name3-error"></span>
										  	    </div>
										  	</div>
										  	<div class="form-group">
										    	<div class="input-group">
										      		<span class="input-group-addon glyphicon glyphicon-home"></span>
										      		<input type="text" name="home" class="form-control" id="Home" placeholder="Home" >
										    	</div>
										    	<span class="help-block has-error" data-error='0' id="Home-error"></span>
										    	<div class="form-group">
										    		<div class="input-group">
											      		<span class="input-group-addon glyphicon glyphicon-home"></span>
											      		<input type="text" id="locality"  name="street" class="form-control" id="Street" placeholder="Street" >
										    		</div>
										    		<span class="help-block has-error" data-error='0' id="Street-error"></span>
										  		</div>
										  		<div class="form-group">
											    	<div class="input-group">
											      		<span class="input-group-addon glyphicon glyphicon-home"></span>
											      		<input type="text" id="autocomplete"  name="city" class="form-control" id="City" placeholder="City" required title="City required">
											    	</div>
										    		<span class="help-block has-error" data-error='0' id="City-error"></span>
										  		</div>
										  		<div class="form-group">
											    	<div class="input-group">
											      		<span class="input-group-addon glyphicon glyphicon-home"></span>
											      		<input type="text" class="form-control"  name="state" id="State" placeholder="State" required title="State required">
											    	</div>
											    	<span class="help-block has-error" data-error='0' id="State-error"></span>
										  		</div>
										  		<div class="form-group">
											    	<div class="input-group">
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" class="form-control"  name="pincode" id="postal_code" placeholder="Postal code" required title="Postal code required" pattern="[0-9]{6}">
											    	</div>
											    	<span class="help-block has-error" data-error='0' id="postal_code-error"></span>
											  	</div>
		                                  	</div>
		                                  	<div class="form-group">
										    	<div class="input-group">
										      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
										      		<input type="tel" class="form-control" pattern="[0-9]{12}" name="aadhar" id="Adhar" placeholder="Adhar" pattern="[0-9]{12}" required title="Adhar # is a 12 digit number">
										    	</div>
										    	<span class="help-block has-error" data-error='0' id="Adhar-error"></span>
										  	</div>
		                                	<div class="form-group">
										    	<div class="input-group">
										      		<span class="input-group-addon glyphicon glyphicon-envelope"></span>
										      		<input type="Email" class="form-control" name="email" id="remail" placeholder="Email" required title="Email required">
										    	</div>
										    	<span class="help-block has-error" data-error='0' id="remail-error"></span>
										  	</div>  
										  	<div class="form-group">
										    	<div class="input-group">
										      		<div class="input-group-addon"><i class="fa fa-at"></i></div>
										      		<input type="password" name="password" class="form-control" id="password" placeholder="password" minlength="6" required title="password required">
										    	</div>
										    	<span class="help-block has-error" data-error='0' id="password-error"></span>
										  	</div>
	                                        <div class="form-group">
										    	<div class="input-group">
										      		<span class="input-group-addon glyphicon glyphicon-phone-alt"></span>
										      		<input type="tel" class="form-control" pattern="[0-9]{10}" name="contact" id="contact" placeholder="contact" required title="Contact required">
										    	</div>
										    	<span class="help-block has-error" data-error='0' id="remail-error"></span>
										  	</div>                           
		                          			<div class="checkbox">
		                          				<label><input type="checkbox" value="" required/>By signing in you are agreeing to our Conditions of Use and Sale and our Privacy Notice</label>
		                          			</div>
								  			<center>
								  				<button type="submit" id="register_btn" class="btn btn-block bt-login" data-loading-text="Registering...." style="border:solid 1px #0074bf;width:200px;color:#0074bf;background:transparent;">Register</button>
								  			</center>
											<div class="clearfix"></div>
											<!--<div class="login-modal-footer">
								  					<div class="row">
														<div class="col-xs-8 col-sm-8 col-md-8">
															<i class="fa fa-lock"></i>
															<a href="javascript:;" class="forgetpass-tab"> Forgot password? </a>
														</div>
													
														<div class="col-xs-4 col-sm-4 col-md-4">
															<i class="fa fa-check"></i>
															<a href="javascript:;" class="signin-tab"> Sign In </a>
														</div>
													</div>
								  				</div>-->
										</form>
									</center>
						    	</div>
						    	<div role="tabpanel" class="tab-pane text-center" id="forget_password">
						    		&nbsp;&nbsp;
						    	    	<span id="reset_fail" class="response_error" style="display: none;"></span>
							    		<div class="clearfix"></div>
<!-- id added by jitendra in form-->
							    		 <form  method="post" id="forget_login_form">
											<div class="form-group">
										    	<div class="input-group">
										      		<span class="input-group-addon glyphicon glyphicon-envelope"></span>
										      		<input type="text" class="form-control" name="email" id="femail" placeholder="Email" required title="Please enter a valid email id.">
										    	</div>
										    	<!--Id changed in span to error_message from femail_error-->
										    	<span class="help-block has-error" data-error='0' id="error_message"></span>
										  	</div>
								  			<center>
								  			<button type="submit" id="reset_btn" class="btn btn-block bt-login" data-loading-text="Please wait...." style="border:solid 1px #0074bf;width:200px;color:#0074bf;background:transparent;">Retrieve Password</button>
								  			</center>
								  			</form><!-- end form-->
											<div class="clearfix"></div>
											<div class="login-modal-footer">
								  				<div class="row">
								  				<!--WHY empty?-->
												</div>
								  			</div>
							  	</div>
							</div>
		      			</div>
		      		</div>
		    	</div>
	   		</div>
			</div>
		</div>
	<!-- ***********Login Model Ends Here ******************-->
    <div id="footer" >
		<br>
		<center>
		<code style="background-color:#ffffff;">Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code>
		</center>
	</div>
</body>
</html>