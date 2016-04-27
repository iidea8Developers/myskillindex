<?php
    //db conn and session check
  include_once('../../lib/log4php/Logger.php');
  Logger::configure('../../config/log_config.xml');
  $log = Logger::getLogger('search_org.php');
  $log->debug("****START -search_org.php****");
  include_once('../../service/common/db_connection.php');
     
  $data=array();
    //get search term
   $searchTerm = $_GET['term'];
	//$searchTerm = "f";
    
    //get matched data from skills table
  try{
      $result=  mysqli_query($connection,"SELECT org_name 
                                          FROM t_org 
                                          WHERE org_name 
                                          LIKE '%".$searchTerm."%' ");
       if(!$result){
          $log->error("Error in creating DB connection for : Username = ".dbuser." , Password : ".dbpass." , DBName : ".dbname." , DBHost : ".dbhost);
          throw new exception($connection->error);
        }   
       while ($row= mysqli_fetch_assoc($result))
        {
    		  $data[] = $row['org_name'];
        }
     //return json data
        echo json_encode($data);
    }   
    catch(Exception $e)
    {
            $log->error($e->getMessage());
    } 
    mysqli_close($connection);
    $log->debug("****END -search_org.php****");
?>