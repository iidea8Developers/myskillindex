<!-- This is Login page -->
<!-- Html css layout created by vivek kumar -->
<!-- login Page for Admin Module of MySkill Index -->

<!DOCTYPE html>
<html lang="eng">
	<head>
		<title></title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="../../css/admin/admin_css.css">
		
		<script type="text/javascript">
			$("document").ready(function(){
				
				$('input').focus(function(){
		        	this.value="";
					//$('#error_message').html("");
					$("#password_error").html("");
				});

    			//login form validation 
    			//written by jitendra on 08-04-2016

    			$("#admin_login_btn").click(function(){
    			//to check input fields are filled
				if(($("#username").val() == "") || ($("#password").val() == "" )){
    		         $("#password_error").html("Username or password is missing");
    		         return false;
				}
				else{
					var request;
					// associated array is created that is passed using send()
					// username and password are key of array that is fetched by login_check.php using post
				    var fe1 = "username="+ $("#username").val() + "&password="+ $("#password").val()+ "&requestor="+ "admin";
					// create XMLHttpRequest object 
					if(window.XMLHttpRequest){
						request = new XMLHttpRequest();
					}
					else{
						request = new ActiveXObject("Microsoft.XMLHTTP");
					}
					//request made to server
    		        request.open("POST","../../service/common/login_check.php",true);
    		        
    		        // Set content type header information for sending url encoded variables in the request
    		        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					
					// Access the onreadystatechange event for the XMLHttpRequest object
					request.onreadystatechange = function() {
						if((request.readyState == 4) && (request.status == 200)){
							var response = request.responseText.trim();
							//$("#password_error").html(response);
							//alert(response);
							// to check whether logged in or not
							 if(response == "success")
							 {   //alert("success");
							    //$("#password_error").html("success");
							    window.location.href = "admin_dashboard.php";
    		    		           }
    		               else{
    		               	    //alert("log in failed");
    		                	$("#password_error").html(response);
    		               }
						}
					}
					// Send the data to PHP now..
					request.send(fe1);
					// stop form submission
					return false;
				}
				});
			});
		</script>

	</head>
	<body>
		
		<div id="wrapper">
			<div id="header">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
						<a class="navbar-brand" class="pull-left"><img src="../../images/common/logo_myskillindex.jpeg" style="margin-top:-15px;margin-left:-14px;" height="100" width="130"></a>
						</div> <!--closing navbar-header-->
					</div> <!--closing container-fluid-->
				</nav> <!--closing navbar-default-->
			</div> <!--closing header-->
            <div id="content">
            <style>
				body
				{
				background-image:url("../../images/admin/admin_login_background.jpg");
				}
			</style>
				<div class="container">
                    <div class="row">
						<div class="col-md-offset-5 col-md-3">
							<div class="form-login" >
								<form enctype="application/x-www-form-urlencoded" method="post">
									<h4><font color="#3b5998" size="5">
									Welcome Back</font></h4>
									<input type="text" id="username" name="username"class="form-control input-sm chat-input" placeholder="Username" required/>
									</br>
									<input type="text" id="password" name="password" class="form-control input-sm chat-input" placeholder="Password" required/>
									</br>
									<span class="help-block has-error" id="password_error"></span>
									<div class="wrapper">
										<span class="group-btn">     
											<button type="submit" id="admin_login_btn" style="background-color:#3b5998;color:#ffffff;height:28px;border-radius:0px;">Login <i class="fa fa-sign-in"></i></button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="footer">
				<br>
				<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
				
			</div>
		</div>
	</body>
</html>