
 <?php

  // USAGE: code to update candiate profile in DB 
  // 
  // 
  session_start();
  include_once('../common/db_connection.php');
   
  // Inititate Log4php logger
  include_once('../../lib/log4php/Logger.php');
  Logger::configure('../../config/log_config.xml');
  $log = Logger::getLogger('Login_check.php');
  $log->debug("****START - profiledb.php****");

$fname= strtoupper(trim($_POST['fname']));

$mname = strtoupper(trim($_POST['mname']));
 
 $lname = strtoupper(trim($_POST['lname']));
 
 $email = $_POST['email'];
 
$contact = strtoupper(trim($_POST['contact']));
 
$street  = strtoupper(trim($_POST['street']));
 
$home  = strtoupper(trim($_POST['home']));
 
 $pincode =  strtoupper(trim($_POST['pincode']));
 
$city = strtoupper(trim($_POST['city']));
 
$state = strtoupper(trim($_POST['state']));
 
$image = $_SESSION['image'];
 
$id = $_SESSION['id'];
 
$pass = $_POST['pass'];
 
 
 
  
  $sql = " UPDATE t_candidate_1 
           SET candidate_fname = '{$fname}' , 
               candidate_mname = '{$mname}' ,
               candidate_mname = '{$lname}' , 
               candidate_email = '{$email}' ,
               candidate_password = '{$pass}' ,
               candidate_address_home = '{$home}' ,
               candidate_address_street = '{$street}' ,
               candidate_address_city = '{$city}' ,
               candidate_address_state = '{$state}' ,
               candidate_address_postalcode  = '{$pincode}' ,
               candidate_contact = '{$contact}' ,
               image = '{$image}'  ,
               candidate_password = '{$pass}'
            WHERE candidate_id = '{$_SESSION['id']}' " ;
  if ($connection->query($sql) === TRUE) {
     "Record updated successfully";
  } else {
     "Error updating record: " . $conn->error;
  }

header('Location: dashboard.php');
$log->debug("****END - profiledb.php****");
$connection->close();
 ?>

