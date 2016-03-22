	
<?php	session_start();
	include('../../service/common/db_connection.php');
	

	$query= "select * from t_candidate_1 where candidate_email='{$_SESSION['user']}'";
	$result=mysqli_query($connection,$query);
	$row=mysqli_fetch_assoc($result);
	$_SESSION['name']=$row['candidate_fname']." ".$row['candidate_mname']. " ".$row['candidate_lname'];
	
	$_SESSION['email']=$row['candidate_email'];
	$_SESSION['contact']=$row['candidate_contact'];
	$_SESSION['address']=$row['candidate_address_home']." ".$row['candidate_address_street']." ".$row['candidate_address_city']." ".$row['candidate_address_postalcode'];
	$_SESSION['aadhar']=$row['candidate_aadhar'];
	$_SESSION['id']=$row['candidate_id'];
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
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">First Name:</h4></td><td><?php echo '<input name="fname" value="'.$row['candidate_fname'].'"style="margin-top:8px;" type="text" required title="First name required">';  ?></td> </tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Middle Name:</h4></td><td><?php echo '<input name="mname"  value="'.$row['candidate_mname'].'" style="margin-top:8px;" type="text">';  ?></td> </tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Last Name:</h4></td><td><?php echo '<input name="lname"  value="'.$row['candidate_lname'].'"style="margin-top:8px;" type="text" required title="Last name required">';  ?></td> </tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Email:</h4></td><td><?php echo  '<input name="email" value="'.$row['candidate_email'].' "style="margin-top:8px;" type="text" required title="Email required">';  ?></td></tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Contact:</h4></td><td><?php echo '<input name="contact" value="'.$row['candidate_contact'].' "style="margin-top:8px;" type="text" pattern="[0-9]{10}">';  ?></td></tr>
	<tr> <td style="width:30%"><h4 style="text-align:right;font-weight:bold">Home Address:</h4></td><td><?php echo '<input  name="home" value="'.$row['candidate_address_home'].'"style="margin-top:8px;" type="text" required title="Home Address required">';  ?></td></tr>
	<tr> <td style="width:30%"><h4 style="text-align:right;font-weight:bold">Street Address:</h4></td><td><?php echo '<input name="street" value="'.$row['candidate_address_street'].'"style="margin-top:8px;" type="text" required title="Street Address required">';  ?></td></tr>
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">City:</h4></td><td><?php echo '<input name="city" value="'.$row['candidate_address_city'].'"style="margin-top:8px;" type="text" required title="City required">';  ?> </td></tr>            
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Pincode:</h4></td><td><?php echo '<input name="pincode" value="'.$row['candidate_address_postalcode'].'"style="margin-top:8px;" type="text" pattern="[0-9]{6}">';  ?> </td></tr>            
	<tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">State:</h4></td><td><?php echo '<input name="state" value="'.$row['candidate_address_state'].' "style="margin-top:8px;" type="text" required title="State required">';  ?></td></tr>                  <tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Aadhar Card Number:</h4></td><td><?php echo '<input name="aadhar" value="'.$row['candidate_aadhar'].' "style="margin-top:8px;" type="text" pattern="[0-9]{12}">';  ?></td></tr>
    <tr> <td style="width:50%"><h4 style="text-align:right;font-weight:bold">Password:</h4></td><td><?php echo '<input name="pass" value="'.$row['candidate_password'].' "style="margin-top:8px;" type="text" minlenght="6" required>';  ?></td></tr>
      	      </tbody>
              </table>
              
              <center>	
              <div class="btn-group">
              <input class="btn btn-success btn-sm" type="submit" value="Save" style="display:inline;margin-left:5px;width:100px">
              <input class="btn btn-success btn-sm" type="button" value="Cancel" style="display:inline;margin-left:5px;width:100px" onclick="loadDoc5()">
              </div>
               </center>
               </form>