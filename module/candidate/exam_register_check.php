<?php
session_start();
include_once('../../service/common/db_connection.php');
$sql="SELECT exam_id FROM t_exam_org_qp WHERE exam_desc='{$_GET['q']}'";
$result=mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($result);
$sql1="SELECT * FROM t_candidate_exam WHERE exam_id='$row['exam_id']'"; 
$result1=mysqli_query($connection,$sql1);
if($result){

header("register_exam.php");
   exit;

}
else
{

 echo '<div class='error' style='display:none'>Exam already registered</div>';  

}

?>