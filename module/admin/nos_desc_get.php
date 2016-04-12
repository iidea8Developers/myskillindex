

<?php
	// db conn and session check
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('nos_desc_get.php');
	$log->debug("****START -nos_desc_get.php****");
	include_once('../../service/common/db_connection.php');
	session_start();
	if (isset($_SESSION["user"])){
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	if(isset($_GET['q'])){
		$q = $_GET['q'];
	}else{
		$_GET['q']="";
	}
	
	$sql = "SELECT * 
			FROM t_nos 
			WHERE nos_code ='{$q}' ";
	
	$result = mysqli_query($connection,$sql);
	while ($row = mysqli_fetch_assoc($result)) {
		echo $row['nos_desc'];
		$_SESSION['nos_desc']=$row['nos_desc'];
	
	}
	mysqli_close($connection);
?>