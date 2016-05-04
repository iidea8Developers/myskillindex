<?php
// this code generates pdf from html through mpdf library
// this code is not called from any code right now
// it should be called from certificate section in column3 from dashboard
session_start();
   include_once('../../service/common/db_connection.php');
   include_once('../../lib/log4php/Logger.php');
   include_once('../../service/common/common_error.php');
   include_once("../../lib/mpdf60/mpdf.php");

   Logger::configure('../../config/log_config.xml');
   $log = Logger::getLogger('certificate_html.php');
   $log->info("****certificate_html.php****");

$html = ob_get_clean();
$html=utf8_encode($html);
$html .= '
<!DOCTYPE html>
<html>
<head>
   <title></title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   
   <!-- Latest compiled JavaScript -->
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body >
<div style="width:800px; height:900px; padding:20px; text-align:center; border: 10px solid #1B5E20;background-image:url(../../images/candidate/cert_background.jpg)" >

       <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
       <br><br>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br><br>
       <span style="font-size:30px"><b>$student.getFullName()</b></span><br/><br/>
       <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
       <span style="font-size:30px">$course.getName()</span> <br/><br/>
       <span style="font-size:20px">with score of <b>$grade.getPoints()%</b></span> <br/><br/><br/><br/>
       <span style="font-size:25px"><i>dated</i></span><br>
      #set ($dt = $DateFormatter.getFormattedDate($grade.getAwardDate(), "MMMM dd, yyyy"))
      <span style="font-size:30px">$dt</span>
      <div>
      <img src="../../images/common/logo_myskillindex_cert.svg" height="130px" style="margin-left:10px" />
      </div>
</div>
</div>
</body>
</html>';
$mpdf=new mpdf();
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';
$mpdf->WriteHTML($html);
$mpdf->Output('menu-pdf','I');

?>
