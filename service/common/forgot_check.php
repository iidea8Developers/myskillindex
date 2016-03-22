<?php
session_start();
	//Code created by vivek kumar
	//this page checks the validation of successfull login
	
	//db conn and session check
	include('db_connection.php');
	
	if(isSet($_POST['username']))
	{
		$username=$_POST['username'];
		
		
			$sql="SELECT * FROM t_candidate WHERE candidate_email='$username'";
			$result = mysqli_query($connection,$sql);
			$row= mysqli_fetch_assoc($result);
			try{
      if(!$result){
       throw new exception($connection->error);
				$log->ERROR("WRONG USERNAME PASSWORD ON LOGIN");

      }
		else if($username===$row['candidate_email'])
			  
	          {	
			
               
                $_SESSION["user"] = $_POST['username'];
				
				header('Location: forget.php');

			}

	
			else
			{
             
             echo' <script type="text/javascript">     
				alert ("This email does not exist in our database");
				location.href = "../../module/candidate/index.php";
				</script> ';
        header('Location: ../../module/candidate/index.php');

			}
		}
		catch(exception $e)
		{
		
		}
		}

?>