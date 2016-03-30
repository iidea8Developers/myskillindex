<?php
	//USAGE: on SignUP - call from index.php
	// Code to register a candidate user in myskillindex
	
	//db conn and session check
	session_start();
	include_once('../common/db_connection.php');
	include_once('../../config/config.txt');
	
	// Inititate Log4php logger
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('Login_check.php');
	$log->debug("****START - register.php****");
	
	// Set variable values for all attributes of registration form
	if (isset( $_POST['fname'])) {
	  $fname= strtoupper(trim($_POST['fname']));
	  $log->debug("First Name: ".$fname);
	}else 
		{echo	$fname=" fname not set";}
 	if (isset( $_POST['mname'])) {
	  $mname= strtoupper(trim($_POST['mname']));
	  $log->debug("Middle Name: ".$mname);
	}else 
		{echo	$mname="mname not set";}
	if (isset( $_POST['lname'])) {
	  $lname= strtoupper(trim($_POST['lname']));
	  $log->debug("Last Name: ".$lname);
	}else{echo	$lname="lname not set";}
	if (isset( $_POST['home'])) {
	  $home= strtoupper(trim($_POST['home']));
	  $log->debug("Home Address: ".$home);
	}else {echo	$home="home not set";}
  	if (isset( $_POST['street'])) {
	  $street= strtoupper(trim($_POST['street']));
	  $log->debug("Street Name: ".$street);
	}else {echo	$street="street not set";}
  	if (isset( $_POST['state'])) {
	  $state= strtoupper(trim($_POST['state']));
	  $log->debug("State Name: ".$state);
	}else {echo $state="state not set";}
 
 	if (isset( $_POST['pincode'])) {
	  $pincode= strtoupper(trim($_POST['pincode']));
	}else {echo $pincode="pincode not set";}
  	if (isset( $_POST['city'])) {
	  $city= strtoupper(trim($_POST['city']));
	  $log->debug("City Name: ".$city);
	}else {echo	$city="city not set";}
 	if (isset( $_POST['aadhar'])) {
	  $aadhar= strtoupper(trim($_POST['aadhar']));
	  $log->debug("Aadhar Number: ".$aadhar);
	}else {echo	$aadhar="aadhar not set";}
  	if (isset( $_POST['email'])) {
	  $email= trim($_POST['email']);
	  $log->debug("Email : ".$email);
	}else{echo	$email="email not set";}
 	 if (isset( $_POST['password'])) {
	  $password= trim($_POST['password']);
	  $log->debug("Password: ".$password);
	}else{echo	$password="password not set";}
 	if (isset( $_POST['contact'])) {
	  $contact= trim($_POST['contact']);
	  $log->debug("Contact : ".$contact);
	}else{echo	$contact="contact not set";}
 
	// Generate random string
	function random_string($length) 
	{
		$key = '';
		$keys = array_merge(range(0, 9));
		for ($i = 0; $i < $length; $i++) 
		{
			$key .= $keys[array_rand($keys)];
		}
		return $key;
	}
	
	$string = random_string(6);
	$log->debug("Candidate ID  : ".$string);

	// check if the user already exists
	$query= "SELECT candidate_id 
			 FROM t_candidate_1 
			 WHERE candidate_email='{$email}'";
	$log->debug("SQL Statement - ".trim($query));
	$result=mysqli_query($connection,$query);
		
	if (($result->num_rows > 0))
	{
		echo "User already exists, Please sign in";
		$log->debug("User already exists ");
	}
	else
		{
		$sql = "INSERT INTO t_candidate_1 (
											candidate_id ,
											candidate_fname,
											candidate_mname,
											candidate_lname ,
											candidate_email,
											candidate_password ,
											candidate_address_home,
											candidate_address_street,
											candidate_address_postalcode,
											candidate_address_city,
											candidate_address_state,
											candidate_contact ,
											candidate_aadhar ,
											candidate_image
										  )
								VALUES ('{$string}', '{$fname}', '{$mname}','{$lname}','{$email}','{$password}','{$home}','{$street}','{$pincode}','{$city}','{$state}'  ,'{$contact}','{$aadhar}','avatar.png')";
		$log->debug(" Register.php SQL Statement - ".trim($sql));

		if ($connection->query($sql) === TRUE) {
			//modified by jitendra on 30 march 
			$subject = "Successful registration on myskillindex ";
			$message = "Congratulations! your account is created. Please sign-in with your username : $email  and password : $password to access myskill index.";
			mail($email,$subject,$message);
			// ****************** Call service to send email with welcome note and username and password **********
			$log->debug(" New user record created successfully ");
			} else {
					echo "Unfortunately, our system is not able to register your at this moment. Please try after some time.";
					$log->error(" Register.php  - SQL Statement - ".$sql." ERROR MSG : ". $connection->error);
					}
	
		header('Location: ../../module/candidate/index.php');
		}
		$connection->close();
?>