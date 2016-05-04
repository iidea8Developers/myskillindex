<!-- Candidate Site Login Screen-->

<!-- 
Modified By : vivek singh
Modification : Ajax code for forget password and log in tab 

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
	<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
 	<!-- Modernizr -->
	<script src="js/modernizr.js"></script>
  	
	<title>Log In &amp; Sign Up Form</title>

	<!-- Gem jQuery -->
	<!--Script to validate entry of username / password on signin -->
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

				.remove{
					color: #CD5C5C;
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
             $("#femail").css('border','solid 1px #CD5C5C');
             $("#i_reset").css('display','');
             return false;
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
					$("#femail").css('border','solid 1px #CD5C5C');  
					$("#i_reset").css('display','');
				}
			}
			// Send the data to PHP now..
			request.send(fe);
			return false;
		}
	});


	//this function clears all the css validation style and text on input focus
	$('input').focus(function(){
		this.value="";
		$('#error_message').html("");
		$("#password_error").html("");
		$("#username").css('border','');
        
        $("#password").css('border','');
        
        $("#i_user").css('display','none');
        $("#i_password").css('display','none');

	});
    
    //this function clears all the css validation style and text on input focus
	$('input').focus(function(){
		this.value="";
		$('#error_message').html("");
		$("#password_error").html("");
		$("#femail").css('border','');
        
        
        
        $("#i_reset").css('display','none');
       

	});

    //login form validation 
    //written by jitendra on 29/03/2016 modified by vivek singh 

    $("#login_btn").click(function(){
    	//to check input fields are filled
            
            //this function applies various styles depending upon the input to the login form   
    	    if( ($("#username").val() == "") && ($("#password").val() == "" ) ) {
              $("#username").css('border','solid 1px #CD5C5C');
               
               $("#i_user").css('display','');
               $("#password").css('border','solid 1px #CD5C5C');
              
               $("#i_password").css('display','');
             $("#password_error").html("Username and password is missing");
             return false;
             }

             else if($("#username").val() == "")
			 {
              
               $("#username").css('border','solid 1px #CD5C5C');
              
               $("#i_user").css('display','');
               $("#password_error").html("Username is missing");
               return false;
             }

             else if($("#password").val() == "")
			 {
              
               $("#password").css('border','solid 1px #CD5C5C');
              
               $("#i_password").css('display','');
               $("#password_error").html("Password is missing");
               return false;
             }
		   else{
			var request1;
			// associated array is created that is passed using send()
			// username and password are key of array that is fetched by login_check.php using post
		    var fe1 = "username="+ $("#username").val() + "&password="+ $("#password").val() + "&requestor="+ "candidate";
			// create XMLHttpRequest object 
			if(window.XMLHttpRequest){
				request1 = new XMLHttpRequest();
			}
			else{
				request1 = new ActiveXObject("Microsoft.XMLHTTP");
			}
			//request made to server
            request1.open("POST","../../service/common/login_check.php",true);
            
            // Set content type header information for sending url encoded variables in the request
            request1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			// Access the onreadystatechange event for the XMLHttpRequest object
			request1.onreadystatechange = function() {
				if((request1.readyState == 4) && (request1.status == 200)){
					var response = request1.responseText.trim();
					//$("#password_error").html(response);
					//alert(response);
					// to check whether logged in or not
					 if(response == "success")
					 {   //alert("success");
					    //$("#password_error").html("success");
					    window.location.href = "dashboard.php";
                   }
                   else{
                   	    //alert("log in failed");

                   	    //this code aplies validation style on login form
                    	$("#password_error").html(response);
                    	$("#username").css('border','solid 1px #CD5C5C');
                    	$("remove").css('color','#CD5C5C');
                    	$("#password").css('border','solid 1px #CD5C5C');
                    	
                    	$("#i_user").css('display','');
                    	$("#i_password").css('display','');
                    	

                   }
				}
			}
			// Send the data to PHP now..
			request1.send(fe1);
			// stop form submission
			return false;
		}
	});
});
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
						    		<form method="post" id="form1">
										<div class="form-group" id="user1">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-user user"></i></div>
									      		<input type="text" class="form-control"  placeholder="Username" id="username" name="username">
									      		<span style="display:none" id="i_user" class="glyphicon glyphicon-remove remove form-control-feedback" style="color:#red"></span>
									    	</div>
									  	</div>
									  	<div class="form-group" id="passw">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-user user"></i></div>
									      		<input type="password" class="form-control" id="password"placeholder="Password" name="password">
									    	    <i style="display:none" id="i_password" class="glyphicon glyphicon-remove remove form-control-feedback" style="color:#red"></i>
									    	</div>
									    	<span class="help-block has-error" id="password_error"></span>
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

						    		<!-- form structure reworked again to support validation,confirm password addedd,input icons are aligned properly with input boxes -->
						    			<form action="../../service/candidate/register.php" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
											<div class="form-group has-feedback">
										    	<div class="col-md-4">
											    	<div class="input-group" >
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" name="fname" class="form-control" id="First Name" placeholder="First Name" required>
											    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
											    	</div>
										    	</div>
		                                       </div> 

		                                       <div class="form-group">  
		                                        <div class="col-md-4">
											    	<div class="input-group" >
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" name="mname" class="form-control" id="Name2" placeholder="Middle Name" >
											    	</div>
										    	</div>
										    	</div>
										  	   
										  	   
										  	   <div class="form-group has-feedback">
										  	    <div class="col-md-4">
											    	<div class="input-group" >
											      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											      		<input type="text" class="form-control" name="lname" id="Name3" placeholder="Last Name" required>
											    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
											    	</div>
										    		
										  	    </div>
										  	    </div>
										  	
										  	  <div class="form-group">
										    	<div class="input-group">
										      		<div class="input-group-addon"><i class="fa fa-home"></i></div>
										      		<input type="text" name="home" class="form-control" id="Home" placeholder="Home" >
										    	</div>
										    </div>


										    	<div class="form-group">
										    		<div class="input-group">
											      		<div class="input-group-addon"><i class="fa fa-home"></i></div>
											      		<input type="text" id="locality"  name="street" class="form-control" id="Street" placeholder="Street" >
										    		</div>
										    		</div>
										  		
										  		 <div class="form-group has-feedback">
											    	<div class="input-group">
											      		<div class="input-group-addon"><i class="fa fa-home"></i></div>
											      		<input type="text" id="autocomplete"  name="city" class="form-control" id="City" placeholder="City" required>
											    	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
											    	</div>
										    		
										  		</div>
										  		<div class="form-group has-feedback">
											    	<div class="input-group">
											      		<div class="input-group-addon"><i class="fa fa-home"></i></div>
											      		<input type="text" class="form-control"  name="state" id="State" placeholder="State" required>
											    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
											    	</div>
											    	
										  		</div>
										  		<div class="form-group has-feedback">
											    	<div class="input-group">
											      		<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
											      		<input type="text" class="form-control"  name="pincode" id="postal_code" placeholder="Postal code" required pattern="[0-9]{6}">
											    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
											    	</div>
											    	
											  	</div>
		                                  
		                                  	<div class="form-group has-feedback">
										    	<div class="input-group">
										      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
										      		<input type="tel" class="form-control" pattern="[0-9]{12}" name="aadhar" id="Adhar" placeholder="Adhar" pattern="[0-9]{12}" required>
										    	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										    	</div>
										    	
										  	</div>
		                                	<div class="form-group has-feedback">
										    	<div class="input-group">
										      		<div class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></div>
										      		<input type="Email" class="form-control" name="email" id="remail" placeholder="Email" required>
										    	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										    	</div>
										    	</div>

										  	<div class="form-group">
                                         <label for="inputPassword" class="control-label"></label>
                                             <div class="form-group col-sm-6">
                                             <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                                            <div class="help-block">Minimum of 6 characters</div>
                                             </div>
                                           <div class="form-group col-sm-6">
                                            <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
                                            <div class="help-block with-errors"></div>
                                            </div>
                                           </div>
                                             
	                                        <div class="form-group has-feedback">
										    	<div class="input-group">
										      		<div class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></i></div>
										      		<input type="tel" class="form-control" pattern="[0-9]{10}" name="contact" id="contact" placeholder="contact" required>
										    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										    	</div>
										    	
										  	</div>  
										  	<div class="form-group has-feedback">                         
		                          			<div class="checkbox">
		                          				<label><input type="checkbox" value="" required/>By signing in you are agreeing to our Conditions of Use and Sale and our Privacy Notice</label>
		                          			</div>
		                          			</div>
								  			<center>
								  				<button type="submit" id="register_btn" class="btn btn-block bt-login" data-loading-text="Registering...." style="border:solid 1px #0074bf;width:200px;color:#0074bf;background:transparent;">Register</button>
								  			</center>
											<div class="clearfix"></div>
											
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
										      		<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
										      		<input type="text" class="form-control" name="email" id="femail" placeholder="Email" required title="Please enter a valid email id.">
										    	    <span style="display:none" id="i_reset" class="glyphicon glyphicon-remove remove form-control-feedback" style="color:#red"></span>
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