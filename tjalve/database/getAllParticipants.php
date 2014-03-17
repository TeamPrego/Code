<?php
	include "config.php";
	echo "<form method='POST' id='firstForm' name='firstForm' action='database/changeRaceBib.php'>";
	echo "<table class ='firstTableList'>
			. <tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>";

	$query = "SELECT * FROM participant";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object()) {
		if($count%2 === 0)
			$which = "even";
		else
			$which = "odd";

		echo "<tr class='$which'>
				<td><input class='$which' name='$row->participantId'value='$row->bib' style='width: 30px'></input> </td><td>" . $row->lastName . ", " . $row->firstName . "</td>";

		$queryId = "SELECT * FROM contact WHERE contactId = '$row->contactId'";
		$dataId = mysqli_query($con, $queryId);
		
		if (!$dataId) {
		  die('Error: ' . mysqli_error($con));
		}

		echo "<td>" . $dataId->fetch_object()->club . "</td></tr>";
		$count += 1;
	}

	echo "</table>";
	echo "<input type='submit' name='addParticipator' id='addParticipator' value='Uppdatera'/></form>";

	if($count === 0)
		echo "<div id='noParticipants'>Finns än inga deltagare registrerade ännu</div>";

	mysqli_close($con);							
?>