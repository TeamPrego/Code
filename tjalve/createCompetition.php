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
			<td><input name="compName" id="compName" size="31%" ></input></td>
			<td>Arrangör:</td>
			<td><input name="organizer" id="organizer" ></input></td>
			<td></td>
		</tr>
		
		<tr>
			<td>Datum:</td>
			<td><input name="dateFrom" id="dateFrom" placeholder="ÅÅÅÅ-MM-DD" size="12%"></input>-<input name="dateTo" id="dateTo" placeholder="ÅÅÅÅ-MM-DD" size="12%" ></input></td>
			<td>Sista anmäl.dag:</td>
			<td><input name="lastDay" id="lastDay" placeholder="ÅÅÅÅ-MM-DD" ></input></td>
		</tr>
		
		<tr>
		<td>Tävlingslogga:</td>
		<td>
				<label for="file">Filename:</label>
				<input type="file" name="file" id="file">
			
			<td>
<<<<<<< HEAD
				<input type="submit" name="submit" value="Fortsätt">
=======
				<input type="submit" name="submit" value="Spara">
>>>>>>> d9bac53153d34c664ac0af21ca60fd27f68542ef
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