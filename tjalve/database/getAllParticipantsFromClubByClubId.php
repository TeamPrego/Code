<?php
	include "config.php";
	$clubId = $_GET['clubId'];

	$query = "SELECT pd.*, p.*
						FROM participantdisciplines pd
						INNER JOIN participant p ON pd.participantId = p.participantId
						INNER JOIN contact c ON p.contactId = c.contactId
						WHERE c.clubId = '$clubId'";
	
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$array = [];
	while($row = $data->fetch_object()) {
		$array[] = ['clubId' => $clubId,
								'firstName' => $row->firstName,
								'lastName' => $row->lastName,
								'birthYear' => $row->birthYear,
								'yearClass' => $row->yearClass,
								'discipline' => $row->discipline];
	}
	echo json_encode($array);
?>