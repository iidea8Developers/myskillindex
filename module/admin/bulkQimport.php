<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload page</title>
<style type="text/css">
body {
	background: #E3F4FC;
	font: normal 14px/30px Helvetica, Arial, sans-serif;
	color: #2b2b2b;
}
a {
	color:#898989;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
}
a:hover {
	color:#CC0033;
}

h1 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #CC0033;
}
h2 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #898989;
}
#container {
	background: #CCC;
	margin: 100px auto;
	width: 945px;
}
#form 			{padding: 20px 150px;}
#form input     {margin-bottom: 20px;}
</style>
</head>
<body>
<div id="container">
<div id="form">

<?php

	//Connect to Database

	include_once('../../service/common/db_connection.php');
	include_once('../../config/config.txt');
	
	// Inititate Log4php logger
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('bulkQimport.php');
	
	$log->debug("****START - bulkQimport.php****");

	//Upload File
	if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		// Make sure all data is inserted in capital case
		$import="INSERT into t_qbank(qid, q_type_code, q_description, q_weightage, q_category, q_video, q_picture, q_lang_code, q_authorname, q_created_by, q_modified_by, q_modified_time, q_create_time) values('','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";

		INSERT INTO `t_ansbank` (`aid`, `qid`, `a_code`, `a_sortorder`, `a_lang_code`, `a_desc`, `a_iscorrect`, `a_scaleid`, `a_created_by`, `a_modified_by`, `a_create_time`, `a_modified_time`) VALUES(1, 236, 'A1', '1', 'en', 'Bath rooms', 1, 0, 'root', 'root', '2016-01-21 18:01:07', '2016-01-21 18:01:07');

		INSERT INTO `t_pc` (`pc_code`, `pc_id`, `pc_name`, `pc_desc`, `pc_created_by`, `pc_modified_by`, `pc_created_time`, `pc_modified_time`) VALUES('PC_SoftSkill_QB1', 27, 'Check for cracks, defects and anomalies in th', 'myskillindex SoftSkills Question Bank 1', 'root', 'root', '2016-01-21 15:51:42', '2016-01-21 15:51:42');
		
		mysql_query($import) or die(mysql_error());
	}

	fclose($handle);

	print "Import done";

	//view upload form
}else {

	print "Upload new csv by browsing to file and clicking on Upload<br />\n";

	print "<form enctype='multipart/form-data' action='upload.php' method='post'>";

	print "File name to import:<br />\n";

	print "<input size='50' type='file' name='filename'><br />\n";

	print "<input type='submit' name='submit' value='Upload'></form>";

}
$log->debug("****END - bulkQimport.php****");
?>

</div>
</div>
</body>
</html>
