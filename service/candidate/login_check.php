<?php
	session_start();
	
	// Last Modified on : 26-03-2016
	// Last Modified By : Pranab Pandey
	
	// Usage : Checks the Login Validation 
		
	//db conn and session check
	include_once('../common/db_connection.php');
	include_once('../../config/config.txt');
	
	// Inititate Log4php logger
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('Login_check.php');
	//$elog = Logger::getLogger('errMailService');
	$log->debug("****START - login_check.php****");

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		try{
				$sql="SELECT candidate_email 
					  FROM ".dbname.".t_candidate_1 
					  WHERE candidate_email='".$username."' 
					  AND candidate_password='".$password."'";
				$log->debug("SQL Statement - ".trim($sql));
				$result = mysqli_query($connection,$sql);
				
				if(!$result){
					$log->error("Error in creating DB connection for : Username = ".dbuser." , Password : ".dbpass." , DBName : ".dbname." , DBHost : ".dbhost);
					throw new exception($connection->error);
				}		
				if ($row= mysqli_fetch_assoc($result))
				{
					$_SESSION["user"] = $_POST['username'];
					$log->info("LOGIN Successfull - Username: ".$username." Password: ".$password);
					$log->info("Invoking Dashboard.php ");
					header('Location:../../module/candidate/dashboard.php');
				}else 	{
						
		                $log->debug(" User Login Failed : Invalid Username, Password");
						//echo is modified and header is comment out by JD
						echo' Login Failed. Try again';
						//header('Location: ../../module/candidate/index.php');
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