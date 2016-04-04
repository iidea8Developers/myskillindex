<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 
     It have form to upload CSV file and it called upload.php to upload question in database
     modifird by jitendra dayama
     modified on: 04-04-2016
-->
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
	padding:0;
	margin: 0;
}
h2 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #898989;
	padding:0;
	margin: 0;
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
    
    		<h1>Upload new csv by browsing to file and clicking on Upload</h1><br>

			<form enctype='multipart/form-data' action='upload.php'  method='post'>

	 			<h2>File name to import:</h2><br>

	 			<input size='50' type='file' name='filename'><br>

     			<input type='submit' name='submit' value='Upload'>
     		</form>
		</div>
	</div>
</body>
</html>
