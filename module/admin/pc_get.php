<STYLE>
	
input[type=checkbox] {
  width: 30px
  height: 30px;
  margin-right: 8px;
  cursor: pointer;
  font-size: 27px;
}


input[type=checkbox]:after {
    content: " ";
    background-color: #9FFF9D;
    display: inline-block;
    visibility: visible;
}

input[type=checkbox]:checked:after {
    content: "\2714";
}
	</STYLE>
<?php
	
	//db conn and session check
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('pc_get.php');
	$log->debug("****START -pc_get.php****");
	include_once('../../service/common/db_connection.php');
	session_start();
	if (isset($_SESSION["user"])){
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	
 	if(isset($_GET['p'])){
		$p = $_GET['p'];
	}else{
		$_GET['p']="";
	}
	
	
	$sql = "SELECT * 
			FROM t_pc 
			WHERE pc_id in ( SELECT pc_id 
							 FROM r_nos_pc 
							 WHERE  nos_code ='{$p}' ) ";
	$result = mysqli_query($connection,$sql);
	$log->debug("****select query executed****");
	while ($row = mysqli_fetch_assoc($result)) {
		echo '<input type="checkbox" style="width:20px;height:20px;" id="green" name="checked[]" value="' . $row['pc_name'] . '" id="' . $row['pc_name'] . '"  />';
		echo '&nbsp;&nbsp;';
		echo $row['pc_name'].'  '.'('.$row['pc_code'].')';
		echo '&nbsp;&nbsp;';
		
		
		echo'<br>';echo'<br>';
	}
	
	mysqli_close($connection);
	$log->debug("****END -pc_get.php****");	
?>