<?php
	//Last Modified on: 26-03-2016
	//Last Modified by: Pranab Pandey
	//Common Code to creates database connections

	include_once('../../config/config.txt');
	// Inititate Log4php logger
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('db_connection.php');
	
	$log->debug("****START - db_connection.php****");
	
	// DB Connection to myskillindex DB
		$connection = mysqli_connect(dbhost, dbuser, dbpass, dbname);
		if(!$connection) 
			{
				$log->error("Could not connect to myskillindex db. Check connection parameters in config.txt.");
				header('Location: ../../module/candidate/index.php');
				$connection->close();
			}
	// DB Connection to Limesurvey DB for myskillindex
	/*$connection2 = mysqli_connect(dbhost21, dbuser21, dbpass21, dbname21);
		if(!$connection2) 
			{
				$log->error("Could not connect to Limesurvey db. Check Connection paramanters for Connection2 in config.txt");
				header('Location: ../../module/candidate/index.php');
				$connection->close();
			}*/
		$log->debug("****END - db_connection.php****");
?>
