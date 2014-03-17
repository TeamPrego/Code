<!--Primary admin page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
	include "templates/adminheader.php";
?>
<h1>Bestäm nummerlapp</h1>

<div id = "leftPartOfApplication">
	<h2>Nummerlappsinformation</h2>

	<form method='POST' id='firstForm' name='firstForm' action='database/addRaceBib.php'>

	<?php
	include "database/config.php";

	$query = "SELECT * FROM participant";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object())
		$count +=1;

	echo "<table>
		<tr><td>Välj tävling: </td> <td>Scroll</td>
		<tr><td>Antaltävlande:</td> <td>".$count."</td>
		<tr><td>Startnummer: </td> <td><input name='bibBegin' value='10'></input></td>
	</table>
	<input type='submit' name='addParticipator' id='addParticipator' value='Uppdatera'/></form>";
	?>
</div>

<div id = "rightPartOfApplication">
	<h2>Tävlingsdeltagare</h2>
	<?php
		include "database/getAllParticipants.php";
	?>
</div>

<div class=progressBar>
	0% klart
</div>

<?php
	include "templates/adminfooter.php";
?>