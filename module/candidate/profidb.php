
 <?php
 session_start();
	include('../../service/common/db_connection.php');
 

 echo $fname= strtoupper(trim($_POST['fname']));
 echo "***************************"; 
 echo  $mname = strtoupper(trim($_POST['mname']));
  echo "***************************"; 
 echo  $lname = strtoupper(trim($_POST['lname']));
  echo "***************************"; 
 echo  $email = $_POST['email'];
  echo "***************************"; 
 echo $contact = strtoupper(trim($_POST['contact']));
  echo "***************************"; 
 echo $street  = strtoupper(trim($_POST['street']));
  echo "***************************"; 
 echo $home  = strtoupper(trim($_POST['home']));
  echo "***************************"; 
 echo  $pincode =  strtoupper(trim($_POST['pincode']));
  echo "***************************"; 
 echo $city = strtoupper(trim($_POST['city']));
  echo "***************************"; 
 echo $state = strtoupper(trim($_POST['state']));
  echo "***************************"; 
 echo $aadhar = strtoupper(trim($_POST['aadhar']));
  echo "***************************"; 
 echo $image = $_SESSION['image'];
  echo "***************************"; 
 echo $id = $_SESSION['id'];
  echo "***************************"; 
 echo $pass = $_POST['pass'];
  echo "***************************"; 
 
 
  
  $sql = " update t_candidate_1 set candidate_fname = '{$fname}' ,  candidate_mname = '{$mname}' , candidate_mname = '{$lname}' , 
   candidate_email = '{$email}' ,  candidate_password = '{$pass}' , candidate_address_home = '{$home}' , candidate_address_street = '{$street}' ,
   candidate_address_city = '{$city}' , candidate_address_state = '{$state}' , candidate_address_postalcode  = '{$pincode}' , 
   candidate_aadhar  = '{$aadhar}' ,  candidate_contact = '{$contact}' , image = '{$image}'  , candidate_password = '{$pass}'
  
  
  
  
  
  where candidate_id = '{$_SESSION['id']}' " ;
  
  echo $sql;

  if ($connection->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
   
 
 
 
header('Location: dashboard.php');
 // (id, candidate_id, candidate_fname, candidate_mname, candidate_lname, candidate_email, candidate_password, candidate_address_home, candidate_address_street, //candidate_address_city , candidate_address_state , candidate_address_postalcode , candidate_aadhar , candidate_contact, image)
 ?>

