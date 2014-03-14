<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
include "templates/adminheader.php";
?>
<h1> Skapa tävling </h1>

<table class ="createcompTable">
	<form id="compForm" name="compForm" method="post" action="database/addCompetition.php"> 
		<tr>
			<td>Tävlingsnamn:</td>
			<td><input name="compName" id="compName"></input></td>
			<td>Arrangör:</td>
			<td><input name="organizer" id="organizer"></input></td>
		</tr>
		
		<tr>
			<td>Datum:</td>
			<td><input name="date" id="date" placeholder="ÅÅÅÅ-MM-DD" required></input></td>
			<td>Sista anmäl.dag:</td>
			<td><input name="lastDay" id="lastDay" placeholder="ÅÅÅÅ-MM-DD" required></input></td>
		</tr>
		
		<tr>
		<td>Tävlingslogga:</td>
		<td>
			<form action="upload_file.php" method="post"
				enctype="multipart/form-data">
				<!--<label for="file">Filename:</label>-->
				<input type="file" name="file" id="file">
			<td>
				<input type="submit" name="submit" value="Spara!!!!!!!!!!!">
			</td>
			</form>
		</td>
		</tr>	
	</form>
</table>

<!--The Progress Bar -->
<div class=progressBar>
	0% klart
</div>	

<?php
include "templates/adminfooter.php";
?>