<?php
	// USAGE: Kills session and redirects user to the index.php page

	session_destroy();
	header("Location: ../../module/candidate/index.php");
	?>