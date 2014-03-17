<?php
	include "config.php";

	$contactId = $_GET['contactId'];
	$query = "SELECT * FROM participant WHERE contactId = '$contactId'";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = false;
	while($row = $data->fetch_object()) {
		$count = true;
		echo "<div id='confirmedParticipantOneEach'><table id='confirmedParticipantTable'><tr><td>Namn</td>" 
				. "<td>" . $row->lastName . ", " . $row->firstName . "</td></tr>";

		$disciplinesquery = "SELECT * FROM disciplines WHERE participantId = '$row->participantId'";
		$disciplinesquerydata = mysqli_query($con, $disciplinesquery);
		
		if (!$disciplinesquerydata) {
		  die('Error: ' . mysqli_error($con));
		}
		
		while($disciplineRow = $disciplinesquerydata->fetch_object()) {
			echo "<tr><td>" 
				. $disciplineRow->class . "</td><td>" 
				. $disciplineRow->discipline . "</td>";
		}

		echo "<td><a href='database/deleteParticipants.php?participantId=".$row->participantId."'><button id='deleteButton'>Radera</button></a></td> </tr></table></div>";
	}
	if(!$count)
		echo "<div id='noParticipants'>Finns än inga deltagare registrerade ännu</div>";

	mysqli_close($con);							
?>