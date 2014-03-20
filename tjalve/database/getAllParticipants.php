<?php
	include "config.php";
	$competitionName = $_GET['competitionName'];

	$dataCompetition = mysqli_query($con, "SELECT * FROM competition WHERE compName = '$competitionName'");
	$competitionId = $dataCompetition->fetch_object()->compID;

	$queryContact = "SELECT * FROM contact WHERE competitionId = '$competitionId'";
	$dataContact = mysqli_query($con, $queryContact);
		if (!$dataContact) {
		  die('Error: ' . mysqli_error($con));
		}
	$disc = [];
	while($rowContact = $dataContact->fetch_object()) {
		$dataContactId = $rowContact->contactId;
		$queryParticipants = "SELECT * FROM participant WHERE contactId = '$dataContactId'";
		$dataParticipant = mysqli_query($con, $queryParticipants);

		if (!$dataParticipant) {
		  die('Error: ' . mysqli_error($con));
		}

		while($rowParticipant = $dataParticipant->fetch_object()) {
			$disc[] = ['fName' => $rowParticipant->firstName,
								 'lName' => $rowParticipant->lastName,
								 'bib' => $rowParticipant->bib,
								 'club' => $rowContact ->club,
								 'participantId' => $rowParticipant->participantId,
								 'prio' => $rowParticipant->prio];
		}
	}
	mysqli_close($con);	
	echo json_encode($disc);

/*
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
*/
							
?>