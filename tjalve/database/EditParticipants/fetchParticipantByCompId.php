<?php
	//Fetching and printing all the participants
	include "../config.php";

	$cId = $_GET['competitionId'];	
	//echo $cId;

	$query = "SELECT p.participantId, p.firstName, p.lastName, c.competitionId
				FROM participant p
				INNER JOIN contact co ON p.contactId = co.contactId
				INNER JOIN competition c ON c.competitionId = co.competitionId
				WHERE c.competitionId = '$cId'";

	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$participantArray = [];
	while($prow = $data->fetch_object()) {
		$participantArray[] = [	'pId' => $prow->participantId, 
								'fName' => $prow->firstName, 
								'lName' => $prow->lastName];
	}
	echo json_encode($participantArray);
?>