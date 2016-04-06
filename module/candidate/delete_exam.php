<?php 
include_once("../../service/common/db_connection.php")

if(isset($_GET['id'])) {
	mysql_query('DELETE FROM t_candidate_exam WHERE exam_id = '$_GET['id']'');
}
?>