	<center><h3 style="margin-top:-35px;">Certificates </h3><img onclick="loadDoc2()" src="images/refresh.png" height="30" width="30" ></center>
					<hr>
					
              <table class="table" style="background: rgba(255,255,255,0);">
						<thead>
							<tr>
								<th><center>Certificates of Completion</center></th>
								<th><center>Completion Date</center></th>
                                                                    	
								<th><center>Marks Scored</center></th>
                                                                     	<th><center>Percentile</center></th>
                                                                     	<th><center>Download Certificate</center></th>
                                                                   
							
							</tr>
						</thead>
                                                                   	<tbody>
              
              
           
           
					
				
					    <?php 
                                                                               
                                                                               	session_start();
	include('db_connection.php');
 
 
 
 //code for percentile **********************************************************************************************************888//////
 
 
 
 	$query = "select MAX(marks_scored) from t_candidate_result where exam_id  = '{$_SESSION['exam_id']}' " ;
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************maximum marks*********************";
 	//	echo $max= $row['MAX(marks_scored)'];
 		//echo "**************************************";
 		//Your percentile score = { (No, of people who got less than you/ equal to you) / (no. of people appearing in the exam) } x 100
 		
 		$query = " select COUNT(candidate_id) from t_candidate_result where exam_id  = '{$_SESSION['exam_id']}'  and marks_scored <= '{$marks}' ";
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "*****************num of people equal or less than u *********************";
 	    $num_people = $row['COUNT(candidate_id)'];
 	//	echo "**************************************";
 		
 		$query = " select COUNT(candidate_id) from t_candidate_result where exam_id = '{$_SESSION['exam_id']}'  ";
 		$result = mysqli_query($connection , $query);
 		$row = mysqli_fetch_assoc($result);
 	//	echo "***************total people of 92 exAM***********************";
 	    $num_people_app = $row['COUNT(candidate_id)'];
 	//	echo "**************************************";
 		
 		
 		$percentile = ($num_people/$num_people_app)*100 ;
 		//echo '<br>';
 		//echo $percentile;
 	echo '	<body style="background-color:lightgrey;"> ';
 
 
 
    echo '</body>';

 
 
 //***********************************************************************************************************************************
          $id=    $_SESSION['id'];
              $query = "select * from t_candidate_result where candidate_id = '{$_SESSION['id']}' " ;
               $result = mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($result))
               {
               
               $marksS = $row['marks_scored'];
                  $exam_id = $row['exam_id'];
                   $query2 = "select * from t_exam_org_qp where exam_id = '{$exam_id}' " ;
               $result2 = mysqli_query($connection,$query2);
               while($row2 = mysqli_fetch_assoc($result2))
               {
                 $examN = $row2['exam_name'];
                    $query3 = "select * from t_candidate_exam where exam_id = '{$exam_id}' AND candidate_id= '{$id}' AND fail = '1' ";
               $result3 = mysqli_query($connection,$query3);
               while($row3 = mysqli_fetch_assoc($result3))
               {
                  
                   $examD = $row3['exam_date'];
                   
                   
					echo '	<tr>
								<td><center><strong>'.$examN.'</center></td>
							<td><center><strong>'.$examD.'</center></td>
							<td><center><strong>'.$marksS.'</center></td>
                                                              <td><center><strong>'.$percentile.'</center></td>
                                                                          	<td><center>
                                                                            
                                                                          <a href="certificate.php?id='. $exam_id.'">  <img height="20" width="20" src="http://52.36.229.255/myscore/candidate/pdf.png" /></a></center></td>
							</tr>';
               
             } } }
             
             ?>
							
						</tbody>
					</table>
                  
                  
                  
                  
                  
                  
