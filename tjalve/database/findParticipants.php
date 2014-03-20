<?php
	include "config.php";

	$contactId = $_GET['contactId'];
	$query = "SELECT * FROM participant WHERE contactId = '$contactId'";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$disc = [];
	while($row = $data->fetch_object()) {
		$disciplinesquery = "SELECT * FROM disciplines WHERE participantId = '$row->participantId'";
		$disciplinesquerydata = mysqli_query($con, $disciplinesquery);

		if (!$disciplinesquerydata) {
		  die('Error: ' . mysqli_error($con));
		}

		$discDisciplines = [];
		while($disciplineRow = $disciplinesquerydata->fetch_object()) {
			$discDisciplines[] = ['discipline' => $disciplineRow->discipline, 'ageClass' => $disciplineRow->class];
		}
		$disc[] = [	'firstName' => $row->firstName, 
					'lastName' => $row->lastName,
					'disciplines' => $discDisciplines,
					'participantId' => $row->participantId,
					'prio' => $row->prio];
	}

	echo json_encode($disc);
?>