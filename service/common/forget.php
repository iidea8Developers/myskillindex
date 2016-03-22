<?php
// This PHP file is used for generating new password for an existing user from the "forget password" screen.
// file location ./service/common/
// created by Jitendra Dayma 
// Create Date : 21-03-2016
// Modified By:
// Modified Date: 

	session_start();
	include('db_connection.php');

// Please specify your Mail Server - Example: mail.yourdomain.com.
	if(isset($_POST['email']))
		{
			$email = $_POST['email'];
		}
		// it checks whether email is exist and set the value of email variable 
		else
		{
			$email = ['admin_email'];
		}
// check if the user already exists

    $query= "SELECT candidate_id 
			 FROM t_candidate_1 
			 WHERE candidate_email='{$email}'";
		 
	$result=mysqli_query($connection,$query);

	if (($result->num_rows > 0))
	{ 
   
		// Creates a ramdom password
		/*  The above line concatenates one character at a time for
			seven iterations within the ASCII range mentioned.
			So, we get a seven characters random OTP comprising of
			all small alphabets. 
		*/
		$str = '';
		for($i=7;$i>0;$i--)
		{
		  $str = $str.chr(rand(97,122)); 
		}
		//Update condidate new password 
		$sql = "UPDATE t_candidate_1 
		        SET candidate_password='{$str}' 
				WHERE candidate_email='{$email}'";
		$result1=mysqli_query($connection,$sql);
		// email message body
		$subject = 'New password for login';
		$msg = 'Dear '.$name.',
Your  new Password is '.$str.'
Please login to your account to change your password.
        Regards 
		Myskill Index Team
		www.MyskillIndex.com 
	 
		Reset your password here:: ';
		// send email
		mail($email,$subject,$msg);
	}
	Else
	{
		Echo "The user does not exists. Please sign up!";
	}
   
header('Location: ../../module/candidate/index.php');
$connection->close();	
?>