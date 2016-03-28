<?php
session_start();
	//Code created by prakash shukla
	//this page checks the validation of successfull login
	
	//db conn and session check
	include('../common/db_connection.php');
	if(isSet($_POST['username']) && isSet($_POST['password']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		try{
			$sql="SELECT * FROM t_candidate_1 WHERE candidate_email='$username' and candidate_password='$password'";
			
			$result = mysqli_query($connection,$sql);
			if(!$result){
				throw new exception($connection->error);
				$log->ERROR("WRONG USERNAME PASSWORD ON LOGIN");
			}		
			if ($row= mysqli_fetch_assoc($result))
			{
				$_SESSION["user"] = $_POST['username'];
				
				header('Location:../../module/candidate/dashboard.php');
			}
			else    {
				/*echo' <script type="text/javascript">     
				alert ("Login failed. Try Again!");
				location.href = "../../module/candidate/index.php";
				</script> '; */
				
				//modified code
				die(header("location:../../module/candidate/index.php?loginFailed=true&reason=password"));
			}	 
			
		}catch(exception $e)
		{
		    $log->ERROR($e->getMessage());
		}
		}
?>