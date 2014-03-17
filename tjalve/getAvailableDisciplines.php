<?php

	// Validera GET variablen
	$class = $_GET['class'];
	// Processa.

	include "database/config.php";

	//$contactId = $_GET['contactId'];
	$query = "SELECT * FROM age_class WHERE ageClass = '$class'";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$disc = [];
	// Skapa innehåll baserat på nedan.
	while($row = $data->fetch_object()) {
		//$disc['gren'] = $row->discipline;
		$disc[] = ['gren' => $row->discipline];
	}

/*
	$disc = [
		[
			'gren' => 'Höjdhopp'
		],
		[
			'gren' => 'Längdhopp'
		]
	];*/

	echo json_encode($disc);
