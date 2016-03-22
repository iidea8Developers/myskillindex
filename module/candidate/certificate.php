
	<?php
		// this starts the session
		session_start();
   	ini_set("session.auto_start", 0);
    ob_start();
		error_reporting(E_ALL);
		
			include('../../service/common/db_connection.php');
		// little script to pull the current date/time; can also be done via JavaScript or 100 other ways
		include("../../lib/now.fn");
		
	//	$_SESSION['name']="aaaaaaaaaaaa";
		// this pulls input variables from the session form 
		$candidate_id = $_SESSION['id'];
		//	echo $candidate_id;
		//echo "<br>";
   // $_GET['id']=127;
		$exam_id = $_GET['id'];
		
		$query3 = " select * from t_exam_org_qp where exam_id  = '{$exam_id}' " ;
		$result3=mysqli_query($connection,$query3);
		while ($row3=mysqli_fetch_assoc($result3))
		
		{
			
		$exam_name = $row3['exam_name'];
			}
	
   require('WriteHTML.php');
			$exam_name;
$pdf=new PDF_WriteTag();
$pdf->SetMargins(30,15,25);
$pdf->SetFont('courier','',12);
$pdf->AddPage();
$pdf->Image('cer_back.jpg',0,0,210,200);

// Stylesheet
$pdf->SetStyle("p","courier","N",22,"10,100,250",15);
$pdf->SetStyle("h1","times","N",10,"102,0,102",0);
$pdf->SetStyle("a","times","BU",9,"0,0,255");
$pdf->SetStyle("pers","times","I",0,"255,0,0");
$pdf->SetStyle("place","arial","U",0,"153,0,0");
$pdf->SetStyle("vb","times","B",0,"102,153,153");
$pdf->SetFont('times','B',28);
// Title
$txt="<pers>Certificate of Completion<pers>";

$pdf->WriteTag(0,10,$txt,5,"C",0,7);

$pdf->Ln(10);

// Text

$txt=" 


<p>Presented to</p>

<p><pers>".$_SESSION['name']."<pers></p>

<p>In recognition for participation in the MySkill Index skill test</p>

<p><pers>".$exam_name."</pers></p>
<h1><place>[Certificate no. : 555555 (to be generated from db)]</place></h1>

";
$pdf->SetFont('courier','B',30);
$pdf->SetLineWidth(0.1);
$pdf->SetFillColor(255,255,204);
$pdf->SetDrawColor(80,0,102);
$pdf->WriteTag(0,10,$txt,1,"C",0,7);

$pdf->Ln(5);

// Signature
$txt="<a href='http://www.myskillindex.com'>Powered By MySkill Index</a>";
$pdf->WriteTag(0,10,$txt,0,"R");

ob_end_clean();

$pdf->Output();

?>
	
			
			

						</body>
						
					</html>		