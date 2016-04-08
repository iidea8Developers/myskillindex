<!DOCTYPE html>
<?php
	//created by prakash shukla and vivek kumar
	//this page create and search question
	session_start();
	include('db_connection.php');
	
	
	if ((isset($_SESSION["user"]))){
	}else
	{
		header("Location: error_page.php");
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="description" content="Awesome Bubble Navigation with jQuery" />
		<meta name="keywords" content="jquery, circular menu, navigation, round, bubble"/>
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style3.css" />
		<link href='http://fonts.googleapis.com/css?family=Alegreya+SC:700,400italic' rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<!-- header footer buttons line  CSS -->
		<link rel="stylesheet" href="css/head_foot_line_button.css"/>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		
		<script type="text/javascript" src="author.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
		
		//functions for autofill in input boxes
			$(function() {
				$( "#skills" ).autocomplete({
					source: 'search/search.php'
				});
			});
		</script>
		<script>
		//forms visibility control functions  
			function goto(){
			if(!(document.getElementById("question").value) || !(document.getElementById("lan").value) || !(document.getElementById("fruits").value) || !(document.getElementById("answer").value))
			{
				alert("fields empty");
			}
			else
			{
				var selection = document.getElementById('fruits').value;
				
				
				if (selection == 'five') {
					document.getElementById("asd4").setAttribute("style","display:visibility")
					document.getElementById("asd").setAttribute("style","display:none")
					document.getElementById("asd3").setAttribute("style","display:none")
					document.getElementById("asd2").setAttribute("style","display:none")
					
					
					} else if (selection == 'four'){
					document.getElementById("asd2").setAttribute("style","display:visibility;height:270px;width:500px;")
					document.getElementById("asd").setAttribute("style","display:none")
					document.getElementById("asd3").setAttribute("style","display:none")
				
					
					}else{
					
					document.getElementById("asd3").setAttribute("style","display:visibility")
					document.getElementById("asd").setAttribute("style","display:none")
					document.getElementById("asd4").setAttribute("style","display:none")
					document.getElementById("asd2").setAttribute("style","display:none")
				}
			}
			}
			function next() {
			if(document.getElementById('fruits').value=='four')
			{
		//	if((document.getElementById("4a").value) ==''|| (document.getElementById("4b")) ==''|| (document.getElementById("4c")) ==''|| (document.getElementById("4d").value)=='' || (document.getElementById("4e").value)=='')
			//   {
				//alert("fields empty");
			//	}
				
			
			if((document.getElementById("4a").value)=='' || (document.getElementById("4b").value)=='' || (document.getElementById("4c").value)=='' 
			|| (document.getElementById("4d").value)=='' || (document.getElementById("4e").value)=='')
			   {
				alert("Empty Feilds");
				}
				else {
				var selection = document.getElementById('fruits').value;
				
				document.getElementById("pc").setAttribute("style","display:visibility")
				document.getElementById("asd4").setAttribute("style","display:none")
				document.getElementById("asd3").setAttribute("style","display:none")
				document.getElementById("asd2").setAttribute("style","display:none")		
			}
			
			}
			
			if(document.getElementById('fruits').value=='five')
			{
			if((document.getElementById("5a").value)=='' || (document.getElementById("5b").value)=='' || (document.getElementById("5c").value)=='' 
			|| (document.getElementById("5d").value)=='' || (document.getElementById("5e").value)=='' || (document.getElementById("5f").value)=='')
			   {
				alert("Empty Feilds");
				}
				else {
				var selection = document.getElementById('fruits').value;
				
				document.getElementById("pc").setAttribute("style","display:visibility")
				document.getElementById("asd4").setAttribute("style","display:none")
				document.getElementById("asd3").setAttribute("style","display:none")
				document.getElementById("asd2").setAttribute("style","display:none")		
			}
			
			} if(document.getElementById('fruits').value=='text'){
			
			var selection = document.getElementById('fruits').value;
				
				document.getElementById("pc").setAttribute("style","display:visibility")
				document.getElementById("asd4").setAttribute("style","display:none")
				document.getElementById("asd3").setAttribute("style","display:none")
				document.getElementById("asd2").setAttribute("style","display:none")
			
			}
			
			
			
			
			}
			
            
			

			function editselection(){
				
				document.getElementById("pc").setAttribute("style","display:none")
				document.getElementById("asd").setAttribute("style","display:none")
				document.getElementById("asd4").setAttribute("style","display:none")
				document.getElementById("asd3").setAttribute("style","display:none")
				document.getElementById("asd2").setAttribute("style","display:none")
			}
			
			function addselection(){
				
				document.getElementById("asd").setAttribute("style","display:visible;height:320px;width:500px")
				document.getElementById("pc").setAttribute("style","display:none")
				document.getElementById("asd4").setAttribute("style","display:none")
				document.getElementById("asd3").setAttribute("style","display:none")
				document.getElementById("asd2").setAttribute("style","display:none")
			}

		</script>
		
		
</head>
<style>
	body
	
	{
	background-color:#dfe3ee;
	}
	</style>
<body>  
	<div id="back" align="left">
				<button  type="button"  onclick="window.location.href='author_qb.php'" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;">Back</button>
				
			</div>
	<div id="footer">
				<br>
				<center><code>Copyright @ 2015 iidea8. All rights reserved | <a href="#">Privacy Policy</a> | <a href="#" color="#C7254E">Terms of Use </a></code></center>
				
			</div>
	<div id="header">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
				<a class="navbar-brand" class="pull-left"><img src="image/title.png" style="margin-top:-15px;margin-left:-14px;" height="50" width="200"></a>
				</div>
				<div>
					
				</div>
			</div>
		</nav>
	</div>
	<div class="table-responsive" style="margin-top:-20px;">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th  bgcolor="#3b5998" class="col-md-12"><font color="#FFFFFF">Dashboard > Question Bank  > Add New Question</font></th>						
					</div>
				</table>
			</div>
		
		
		
		
			<form   action="insert2.php" method="post" enctype="multipart/form-data">

		<div class="container" id="asd" ">
		
			
			<div class="table-responsive">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th class="col-md-12"><font size="4" color="#3b5998">Fill Out The Question Details</font></th>	
					</div>
				</table>
				
			</div>	
			<table class="table table-bordered">
				<tbody>
					<tr>
						
						<td class="col-md-3"><label for="text"><b><font size="4" color="#3b5998">Question:</font></b></label></td>
						<td class="col-md-9"><div id="asd1" class=""><input id="question" type="text" class="form-control" name="Question"></div></td>
						
					</tr>
					<tr>
						
						<td class="col-md-3"><label for="lan"><b><font size="4" color="#3b5998">Language:</font></b></label></td>
						<td class="col-md-9">
							<div class="" id="asd2"><select  class="form-control" name="lan" id= "lan">
								<option id="lan" value="en" name="en">English</option>
							</select>
                                 </div>
						</td>
						
					</tr>
					<tr>
						
						<td class="col-md-3"> <label for="fruits"><b><font size="4" color="#3b5998">Answer Type:</font></b></label></td>
						<td class="col-md-9">
            <div class="" id="asd3">
            <select   class="form-control"  name="type" id= "fruits">
							<option value="four" name="four">Four Multiple Choice</option>
							<option value="five" name="five">Five Multiple Choice</option>
							<option value="text" name="text">Text Type Question</option>
						</select>
            </div>
            </td>
						
					</tr>
					<tr>
						
						<td class="col-md-3"><label for="video" ><b><font size="4" color="#3b5998">Youtube Video (IF any)</font></b></label></td>
						<td class="col-md-9"><input type="text" name="video" class="form-control"></td>
						
					</tr>
					<tr>
						
						<td class="col-md-3"><label for="myimage" class="control-label"><b><font size="4" color="#3b5998">Image (IF any)</font></b></label></td>
						<td class="col-md-9"> <input type="file" name="img2" id="file" class="form-control"  ></td>
						
					</tr>
					<tr>
						
						<td class="col-md-3"><label for="marks" ><b><font color="#3b5998">Question Marks:</font></b></label></td>
						<td class="col-md-9"><div class="" id="asd4"><input id="answer"  min="1" type="number"  name="a" class="form-control" max="4"></div></td>
						
					</tr>
					
					
				</tbody>
			</table>
			<button  id="button" type="button" onclick='goto()' style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;margin-left:1085px;padding:3.5px;" >Next</button>
		
	</div>
	
	
	
	<div class="container" id="asd2" style="display:none;">
	
		<div style="width:1100px;margin-left:-280px;">
			<div class="table-responsive">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th class="col-md-12"><font size="4" color="#3b5998">Add Answers To Question</font></th>	
					</div>
				</table>
			</div>
		</div>	
			<table class="table table-bordered" style="width:1100px;margin-left:-280px;">
				<tbody>
					<tr>
						<td><label for="answer6"><font size="4" color="#3b5998">Answer1:</font></label></td>
						<td><input id="4a" class="form-control" type="text" size="35" name="answer6"></td>
						
					</tr>
					<tr>
						<td><label for="answer7"><font size="4" color="#3b5998">Answer2:</font></label></td>
						<td><input id="4b" class="form-control" type="text" size="35" name="answer7"></td>
					</tr>
					<tr>
						<td><label for="answer8"><font size="4" color="#3b5998">Answer3:</font></label></td>
						<td><input id="4c" class="form-control" type="text" size="35" name="answer8"></td>
					</tr>
					<tr>
						<td><label for="answer9"><font size="4" color="#3b5998">Answer4:</font></label></td>
						<td><input id="4d" class="form-control" type="text" size="35" name="answer9"></td>
					</tr>
					<tr>
						
					</tr>
					<tr>
						<td><label ><font size="4" color="#3b5998">Correct Answer number:</font></label></td>
						<td><input id="4e" class="form-control"  min="0" type="number" size="35" name="c" ></td>
					</tr>
					
					
					
				</tbody>
			</table>
			
			
				<button type="button" style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;margin-left:765px;margin-top:10px;padding:3.5px;" id="button" type="button" value="Next" onclick='next()'>Next</button> 
				
			
		
		
	</div>
	
	<div class="container" id="asd3" style="display:none">
		
		<div >
			<div class="table-responsive">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th class="col-md-12"><font size="4" color="#3b5998">Answers Type Text</font></th>	
					</div>
				</table>
			</div>
		</div>	
			<table class="table table-bordered">
				<tbody>
					<tr>	
						
						<td><label for="text"><font size="4" color="#3b5998">Answer:</label> </td>
						<td><input type="text" name="text" value="Your answer type is Text. Press Next" class="form-control"></td>
						
					</tr>
				</tbody>
			</table>
			
			<div class="btn-group">
				<button style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;margin-left:1085px;padding:3.5px;" value="Next"  onclick="next()">Next</button>
				
			</div>
	</div>	
	
	<div class="container" id="asd4" style="display:none">
		
		<div >
			<div class="table-responsive">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th class="col-md-12"><font size="4" color="#3b5998">Add Answers To Question</font></th>	
					</div>
				</table>
			</div>
		</div>	
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td><label for="answer1"><font size="4"  color="#3b5998">Answer1:</font></label></td>
						<td><input id="5a" class="form-control" type="text" size="35" name="answer1"></td>
						
					</tr>
					<tr>
						<td><label for="answer2"><font size="4" color="#3b5998">Answer2:</font></label></td>
						<td><input id="5b" class="form-control" type="text" size="35" name="answer2"></td>
					</tr>
					<tr>
						<td><label for="answer3"><font size="4" color="#3b5998">Answer3:</font></label></td>
						<td><input id="5c" class="form-control" type="text" size="35" name="answer3"></td>
					</tr>
					<tr>
						<td><label for="answer4"><font size="4" color="#3b5998">Answer4:</font></label></td>
						<td><input id="5d" class="form-control" type="text" size="35" name="answer4"></td>
					</tr>
					<tr>
						<td><label for="answer5"><font size="4" color="#3b5998">Answer5:</font></label></td>
						<td><input id="5e" class="form-control" type="text" size="35" name="answer5"></td>
					</tr>
					<tr>
						<td><label for="answer44"><font size="4" color="#3b5998">Correct Answer number:</font></label></td>
						<td><input id="5f" class="form-control"  min="0" type="number" size="35" name="correct"></td>
					</tr>
					
				</tbody>
			</table>
			<div class="btn-group">
				
				<button style="background-color:#3b5998;color:#ffffff;height:33px;border-radius:0px;margin-left:1085px;" type="button" onclick="next()" id="button"  value="Next">Next</button>
			</div>
	</div>
	<div  id="pc"  style="display:none">
	
		<div class="container">
			<div class="table-responsive">
				<table class="table table-bordered table-stripped">
					<div class="row">
						<th class="col-md-12"><font color="#3b5998">Link Question To Performance Criteria</font></th>	
					</div>
				</table>
			</div>
		</div>	
		<center><div class="form-group">
			<label for="skills"><b><font size="4"color="#3b5998">Select PC: </label>
				<input id="skills" size="35" name="pc" required />
				<input style="background-color:#3b5998;color:#ffffff;" required id="pc" type="submit" value="Add"  />
				</div><center>
			
			</div>		
			<br>
			</form> 
			</body>
		</html>				