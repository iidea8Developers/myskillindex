<?php
	session_start();
	
	// Last Modified on : 30-03-2016
	// Last Modified By : Jitendra Dayma
	// Modification: comment out Header function
	
	// Usage : Checks the Login Validation 
		
	//db conn and session check
	
	
	// Inititate Log4php logger
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('Login_check.php');
	//$elog = Logger::getLogger('errMailService');
	$log->debug("****START - login_check.php****");
	include_once('../common/db_connection.php');
	include_once('../../config/config.txt');

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$requestor=$_POST['requestor'];
		$log->debug("****requestor****".$requestor);
		try{
			if ($requestor=='candidate')
			{
				$sql="SELECT candidate_email 
					  FROM ".dbname.".t_candidate_1 
					  WHERE candidate_email='".trim($username)."' 
					  AND candidate_password='".trim($password)."'";
				$log->debug("SQL Statement - ".trim($sql));
				$result = mysqli_query($connection,$sql);
			} else
				{
				$sql="SELECT username 
					  FROM t_adminusers 
					  WHERE username ='".trim($username)."' 
					  AND password='".trim($password)."'";
				$log->debug("SQL Statement - ".trim($sql));
				$result = mysqli_query($connection,$sql);	
				}				
				if(!$result){
					$log->error("Error in creating DB connection for : Username = ".dbuser." , Password : ".dbpass." , DBName : ".dbname." , DBHost : ".dbhost);
					throw new exception($connection->error);
				}		
				if ($row= mysqli_fetch_assoc($result))
				{
					$_SESSION["user"] = $_POST['username'];
					$log->info("LOGIN Successfull - Username: ".$username." Password: ".$password." requestor = ".$requestor);
					echo "success";
				}else {
					    $log->debug(" User Login Failed : Invalid Username, Password");
						//echo is modified and header is comment out by JD
						echo "Login Failed. Try again";
	
						}	 
			$log->debug("****END - login_check.php****");
			}catch(exception $e)
				{
				    // log error msg in log file
				    $log->error($e->getMessage());
				    //$elog->error("critical system failure"); -- update this to send email to system admin using errMailService
				    // header comment out by JD on 29/03/2016
				    //header('Location: ../../module/candidate/index.php');
				    $log->debug("****END - login_check.php****");
				}
		}
		$connection->close();

?>