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

	$clubquery = "SELECT clubId FROM contact WHERE contactId = '$cId'";
	$clubData = mysqli_query($con, $clubquery);

	if (!$clubData) {
	  die('Error: ' . mysqli_error($con));
	}

	$clubId = $clubData->fetch_object()->clubId;
	//echo($club);
	$clubQuery2 = "SELECT club FROM clubs WHERE clubId = '$clubId'";
	$theClubData = mysqli_query($con, $clubQuery2);

	if(!$theClubData) {
		die('Errir: ' . mysqli_error($con));
	}

	$theClub = $theClubData->fetch_object()->club;

	//Select all clubs
	$allClubs = "SELECT club FROM clubs";
	$allClubsData = mysqli_query($con, $allClubs);

	$clubsArray = [];
	while($clubRow = $allClubsData->fetch_object()) {
		$clubsArray[] = ['clubName' => $clubRow->Name];
	}

	$part = [];
	$disciplinesquery = "SELECT * FROM participantdisciplines WHERE participantId = '$pId'";
	$data = mysqli_query($con, $disciplinesquery);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$discDisciplines = [];
	while($discRow = $data->fetch_object()) {
		$discDisciplines[] = ['pIndex' => $discRow->pIndex, 'discipline' => $discRow->discipline, 'ageClass' => $discRow->yearClass];
	}
	$part[] = [	'firstName' => $firstName,
				'lastName' => $lastName,
				'birthYear' => $birthYear,
				'club' => $theClub,
				'disciplines' => $discDisciplines, 
				'clubs' => $clubsArray,
				'contactId' => $cId];

	echo json_encode($part);
?>