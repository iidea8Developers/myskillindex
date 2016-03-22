<?php 
	session_start();
	$string = $_SESSION['id'];
	include('../../service/common/db_connection.php');
	
	$path="/var/www/html/myskillindex/images/candidate/";
	
	
		$path=$path.$string.$_FILES['img2']['name'];
		echo $path;
		$path2=$path.$string.$_FILES['img2']['name'];
		echo $path2;
		if(move_uploaded_file($_FILES['img2']['tmp_name'],$path))
		{
			echo " ".basename($_FILES['img2']['name'])." has been uploaded<br/>";
			echo '<img src="/var/www/html/myskill/images/candidate/'.$string.$_FILES['img2']['name'].'" width="48" height="48"/>';
			$img=$string.$_FILES['img2']['name'];
					
		}
		else
		{
			echo "There is an error,please retry or ckeck path";
		}
	


$sql = "update t_candidate_1 set image = '{$img}' where candidate_id = '{$_SESSION['id']}' 
";

if ($connection->query($sql) === TRUE) {
	echo "New record created successfully";
	} else {
	echo "Error: " . $sql . "<br>" . $connection->error;
}
header('Location: dashboard.php');
?>