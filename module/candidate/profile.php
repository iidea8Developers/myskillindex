<?php	
/* Usage: Code to display candidate details on dashboard
Updated By PP on 29/04/2016
*/
	session_start();
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	include_once('../../service/common/common_error.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('profile.php');
	
	$log->debug("***** START profile.php********");

	$query= "SELECT candidate_fname,
					candidate_mname,
					candidate_lname,
					candidate_contact,
					candidate_address_home,
					candidate_address_street,
					candidate_address_city,
					candidate_address_postalcode,
					candidate_id,
					candidate_password,
					candidate_address_state
			 FROM t_candidate_1 
			 WHERE candidate_email='{$_SESSION['user']}'";
	$result=mysqli_query($connection,$query);
	$row=mysqli_fetch_assoc($result);
	$_SESSION['name']=$row['candidate_fname']." ".$row['candidate_mname']. " ".$row['candidate_lname'];
	$_SESSION['contact']=$row['candidate_contact'];
	$_SESSION['address']=$row['candidate_address_home'];
	$row['candidate_address_street'];
	$row['candidate_address_city'];
	$row['candidate_address_postalcode'];
	$_SESSION['id']=$row['candidate_id'];
	$_SESSION['id']=$row['candidate_id'];

	$log->debug("***** END profile.php*******");
	mysqli_close($connection);
 ?> 
 
  <style>
.form-page input[type="text"] {
        border: none;
        background-color: transparent;
        /* Other stuff: font-weight, font-size */
}
</style>
  <form action="profidb.php" method="post">
  <table class="table">
							<tbody>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">First Name:</h4></td><td><?php echo '<input class="form-control" name="fname" value="'.$row['candidate_fname'].'"style="margin-top:8px;" type="text" required title="First name required">';  ?></td> </tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Middle Name:</h4></td><td><?php echo '<input class="form-control" name="mname"  value="'.$row['candidate_mname'].'" style="margin-top:8px;" type="text">';  ?></td> </tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Last Name:</h4></td><td><?php echo '<input class="form-control" name="lname"  value="'.$row['candidate_lname'].'"style="margin-top:8px;" type="text" required title="Last name required">';  ?></td> </tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Contact:</h4></td><td><?php echo '<input class="form-control" name="contact" value="'.$row['candidate_contact'].' "style="margin-top:8px;" type="text" pattern="[0-9]{10}">';  ?></td></tr>
	<tr> <td style="width:30%"><h4 style="text-align:right;font-weight:bold">Home Address:</h4></td><td><?php echo '<input  class="form-control" name="home" value="'.$row['candidate_address_home'].'"style="margin-top:8px;" type="text" required title="Home Address required">';  ?></td></tr>
	<tr> <td style="width:30%"><h4 style="text-align:right;font-weight:bold">Street Address:</h4></td><td><?php echo '<input class="form-control" name="street" value="'.$row['candidate_address_street'].'"style="margin-top:8px;" type="text" required title="Street Address required">';  ?></td></tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">City:</h4></td><td><?php echo '<input class="form-control" name="city" value="'.$row['candidate_address_city'].'"style="margin-top:8px;" type="text" required title="City required">';  ?> </td></tr>            
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Pincode:</h4></td><td><?php echo '<input class="form-control" name="pincode" value="'.$row['candidate_address_postalcode'].'"style="margin-top:8px;" type="text" pattern="[0-9]{6}">';  ?> </td></tr>            
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">State:</h4></td><td><?php echo '<input class="form-control" name="state" value="'.$row['candidate_address_state'].' "style="margin-top:8px;" type="text" required title="State required">';  ?></td></tr>            
    <tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Password:</h4></td><td><?php echo '<input class="form-control" name="pass" value="'.$row['candidate_password'].' "style="margin-top:8px;" type="text" minlenght="6" required>';  ?></td></tr>
      	      </tbody>
              </table>
              
              <center>	
              <div class="btn-group">
              <input class="btn btn-success btn-sm" type="submit" value="Save" style="display:inline;margin-left:5px;width:100px">
              <input class="btn btn-success btn-sm" type="button" value="Cancel" style="display:inline;margin-left:5px;width:100px" onclick="loadDoc5()">
              </div>
               </center>
	</form>
