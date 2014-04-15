<?php
	include "config.php";
	$competitionName = $_GET['competitionName'];

	$query = "SELECT pd.*, p.*, c.*
						FROM participantdisciplines pd
						INNER JOIN participant p ON pd.participantId = p.participantId
						INNER JOIN contact c ON p.contactId = c.contactId
						INNER JOIN competition comp ON c.competitionId = comp.competitionId
						WHERE comp.competitionName = '$competitionName'";

	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$disc = [];
	while($rowParticipant = $data->fetch_object()) {
		$disc[] = ['fName' => $rowParticipant->firstName,
							 'lName' => $rowParticipant->lastName,
							 'discipline' =>  $rowParticipant->discipline,
							 'yearClass' =>  $rowParticipant->yearClass,
							 'bib' => $rowParticipant->bib,
							 'club' => $rowParticipant ->clubId,
							 'participantId' => $rowParticipant->participantId,
							 'prio' => $rowParticipant->prio,
							 'pIndex' => $rowParticipant->pIndex];
	}
	echo json_encode($disc);
	mysqli_close($con);	
?>