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
?>