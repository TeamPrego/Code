<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
include "templates/adminheader.php";
?>
<h1> Skapa tävling </h1>

<table class ="createcompTable">
	<form id="compForm" name="compForm" method="post" enctype="multipart/form-data" action="createCompetition.php">
		<tr>
			<td>Tävlingsnamn:</td>
			<td><input name="compName" id="compName" ></input></td>
			<td>Arrangör:</td>
			<td><input name="organizer" id="organizer" ></input></td>
		</tr>
		
		<tr>
			<td>Datum:</td>
			<td><input name="dateFrom" id="dateFrom" placeholder="ÅÅÅÅ-MM-DD" ></input></td>
			<td><input name="dateTo" id="dateTo" placeholder="ÅÅÅÅ-MM-DD" ></input></td>
			<td>Sista anmäl.dag:</td>
			<td><input name="lastDay" id="lastDay" placeholder="ÅÅÅÅ-MM-DD" ></input></td>
		</tr>
		
		<tr>
		<td>Tävlingslogga:</td>
		<td>
				<label for="file">Filename:</label>
				<input type="file" name="file" id="file">
			
			<td>
				<input type="submit" name="submit" value="Spara!!!!!!!!!!!">
			</td>
		</td>
		</tr>	
	</form>
</table>

<?php
if(isset($_POST['compName'])!="" && $_POST['organizer']!="" && $_POST['dateFrom']!="" && $_POST['dateTo']!="" && $_POST['lastDay']!=""){
	if(!isset($_POST['file'])){
		$_POST['file'] = NULL;
	}
  include "class/competition.php";
  $temp = new Competition();
  //echo "hello ".$_POST['compName'];
  $temp->pushToDB($_POST['compName'], $_POST['organizer'], $_POST['dateFrom'], $_POST['dateTo'], $_POST['lastDay'], $_POST['file']);
}
?>
<!--The Progress Bar -->
<div class=progressBar>
	0% klart
</div>	

<?php
include "templates/adminfooter.php";
?>