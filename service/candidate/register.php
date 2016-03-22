<?php
	session_start();
	//Code created by prakash shukla
	//this page checks the validation of successfull login
	
	//db conn and session check
	include('../common/db_connection.php');
	
	
	if (isset( $_POST['fname'])) {
	  echo	$fname= strtoupper(trim($_POST['fname']));

   
	}else 
	{
	  echo	$fname=" fname not set";
	}
 
 	if (isset( $_POST['mname'])) {
	  echo	$mname= strtoupper(trim($_POST['mname']));
	}else 
	{
	  echo	$mname="mname not set";
	}
	
 if (isset( $_POST['lname'])) {
	  echo	$lname= strtoupper(trim($_POST['lname']));
	}else 
	{
	  echo	$lname="lname not set";
	}
	
 if (isset( $_POST['home'])) {
	  echo	$home= strtoupper(trim($_POST['home']));
	}else 
	{
	  echo	$home="home not set";
	}
 
 if (isset( $_POST['street'])) {
	  echo	$street= strtoupper(trim($_POST['street']));
	}else 
	{
	  echo	$street="street not set";
	}
 
 if (isset( $_POST['state'])) {
	  echo	$state= strtoupper(trim($_POST['state']));
	}else 
	{
		  echo $state="state not set";
	}
 
 if (isset( $_POST['pincode'])) {
	  echo	$pincode= strtoupper(trim($_POST['pincode']));
	}else 
	{
		  echo $pincode="pincode not set";
	}
 
 if (isset( $_POST['city'])) {
	  echo	$city= strtoupper(trim($_POST['city']));
	}else 
	{
	  echo	$city="city not set";
	}
 
 if (isset( $_POST['aadhar'])) {
	  echo	$aadhar= strtoupper(trim($_POST['aadhar']));
	}else 
	{
	  echo	$aadhar="aadhar not set";
	}
 
 if (isset( $_POST['email'])) {
	  echo	$email= trim($_POST['email']);
	}else 
	{
	  echo	$email="email not set";
	}
 
 if (isset( $_POST['password'])) {
	  echo	$password= $_POST['password'];
	}else 
	{
	  echo	$password="password not set";
	}
 if (isset( $_POST['contact'])) {
	  echo	$contact= trim($_POST['contact']);
	}else 
	{
	  echo	$contact="contact not set";
	}
 
	
	function random_string($length) {
		
		$keys = array_merge(range(0, 9));
		
		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		
		return $key;
	}
	
$string = random_string(6);

// check if the user already exists

$query= "select candidate_id from t_candidate_1 where candidate_email='{$email}'";
	$result=mysqli_query($connection,$query);
	//$row=mysqli_fetch_assoc($result);
	
	//$id_check=$row['candidate_id'];
	if (($result->num_rows > 0))
	{echo "User already exists, Please sign in";}
	Else
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
											image
										  )
								VALUES ('{$string}', '{$fname}', '{$mname}','{$lname}','{$email}','{$password}','{$home}','{$street}','{$pincode}','{$city}','{$state}'  ,'{$contact}','{$aadhar}','avatar.png')";

		if ($connection->query($sql) === TRUE) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
	
header('Location: ../../module/candidate/index.php');
}
?>