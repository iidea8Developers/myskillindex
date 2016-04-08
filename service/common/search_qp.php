<?php
    //database configuration
  include_once('../../service/common/db_connection.php');
  include_once('../../lib/log4php/Logger.php');
  Logger::configure('../../config/log_config.xml');
  $log = Logger::getLogger('search_qp.php');
  $log->debug("****START -search_qp.php****");
     
$data=array();
    //get search term
   $searchTerm = $_GET['term'];
  //$searchTerm = "f";
    
    //get matched data from skills table
  try{
      $result=  mysqli_query($connection,"SELECT qp_name 
                                          FROM t_qp 
                                          WHERE qp_name 
                                          LIKE '%".$searchTerm."%' ");
       if(!$result){
          $log->error("Error in creating DB connection for : Username = ".dbuser." , Password : ".dbpass." , DBName : ".dbname." , DBHost : ".dbhost);
          throw new exception($connection->error);
        }   
       while ($row= mysqli_fetch_assoc($result))
        {
          $data[] = $row['qp_name'];
        }
     //return json data
        echo json_encode($data);
    }   
    catch(Exception $e)
    {
            $log->error($e->getMessage());
    } 
    mysqli_close($connection);
    $log->debug("****END -search_qp.php****");
?>
