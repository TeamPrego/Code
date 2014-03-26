<?php
ob_start();
	include "../config.php";
	$pId = $_GET['participantId'];
	$query = "SELECT * FROM participant WHERE participantId = '$pId'";
	$cData = mysqli_query($con, $query);

	if (!$cData) {
	  die('Error: ' . mysqli_error($con));
	}

	$participant = $cData->fetch_object();

	$cId = $participant->contactId;
	$firstName = $participant->firstName;
	$lastName = $participant->lastName;
	$birthYear = $participant->birthYear;
	//echo($cId);

	$clubquery = "SELECT club FROM contact WHERE contactId = '$cId'";
	$clubData = mysqli_query($con, $clubquery);

	if (!$clubData) {
	  die('Error: ' . mysqli_error($con));
	}

	$club = $clubData->fetch_object()->club;
	//echo($club);

	//Select all clubs
	$allClubs = "SELECT Name FROM clubs";
	$allClubsData = mysqli_query($con, $allClubs);

	$clubsArray = [];
	while($clubRow = $allClubsData->fetch_object()) {
		$clubsArray[] = ['clubName' => $clubRow->Name];
	}

	$part = [];
	$disciplinesquery = "SELECT * FROM disciplines WHERE participantId = '$pId'";
	$data = mysqli_query($con, $disciplinesquery);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$discDisciplines = [];
	while($discRow = $data->fetch_object()) {
		$discDisciplines[] = ['pIndex' => $discRow->pIndex, 'discipline' => $discRow->discipline, 'ageClass' => $discRow->class];
	}
	$part[] = [	'firstName' => $firstName,
				'lastName' => $lastName,
				'birthYear' => $birthYear,
				'club' => $club,
				'disciplines' => $discDisciplines, 
				'clubs' => $clubsArray];

	echo json_encode($part);
?>