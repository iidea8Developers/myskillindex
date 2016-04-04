
<?php
    //to upload question in bulk from csv fie to database
    // called by bulkQimport.php form
	//created by jitendra dayma
	// ccreated on: 04-04-2016

	//Connect to Database

	include_once('../../service/common/db_connection.php');
	include_once('../../config/config.txt');
	
	// Inititate Log4php logger
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('upload.php');
	
	$log->debug("****START - upload.php****");

	//Upload File
	if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r"); 
    try{
    	// begin transaction
    	mysqli_begin_transaction($connection);
    	
    	// stop autocommit
    	mysqli_autocommit($connection, FALSE);

    	// automatically detect line ending in csv file enabled
    	ini_set('auto_detect_line_endings', true);
		
		while (($data = fgetcsv($handle, 8000, ",")) !== FALSE) {
			// Make sure all data is inserted in capital case
			$import="INSERT INTO t_qbank(q_type_code,
									q_description,
									q_weightage,
									q_category,
									q_video,
									q_picture,
									q_lang_code,
									q_authorname,
									q_created_by,
									q_modified_by,
									q_modified_time,
									q_create_time) 
								values('L','$data[0]',1,'NULL','null','null','en','global','global','NULL','NULL',NOW())";

			/*$import_ans= "INSERT INTO t_ansbank(qid,
											a_code,
											a_sortorder,
											a_lang_code,
											a_desc,
											a_iscorrect,
											a_scaleid,
											a_created_by,
											a_modified_by,
											a_create_time,
											a_modified_time)
										VALUES('', '$data[0]', '$data[1]', '$data[2]', '$data[3]','$data[4]','$data[5]', '$data[6]', 'NULL','NULL',NOW())";
     
        			$import_pc ="INSERT INTO t_pc(pc_code,
									  pc_id,
									  pc_name,
									  pc_desc,
									  pc_created_by,
									  pc_modified_by,
									  pc_created_time,
									  pc_modified_time)
									VALUES('PC_SoftSkill_QB1', 27, 'Check for cracks, defects and anomalies in th', 'myskillindex SoftSkills Question Bank 1', 'root', 'root',NOW())";
	*/	
			$result = mysqli_query($connection,$import);
		    if($result == FALSE)
									{
										throw new Exception($result);
									}

			$log->debug("****query excecuted****");
			//mysqli_query($import_ans) or die(mysql_error());
			//mysqli_query($import_pc) or die(mysql_error());	
		}
		mysqli_commit($connection);
		print "Import done";	
		$log->debug("****commit called****");

	}
	catch(Exception $e){
		mysqli_rollback($connection);
		$log->debug("****rollback called****");
	}


	fclose($handle);
    //view upload form
}
//close the connection
mysqli_close($connection);
$log->debug("****END - upload.php****");
//header("Location:bulkQimport.php");
?>