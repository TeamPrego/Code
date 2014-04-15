<?php
ob_start();
	include "../config.php";

	//***** Get everything about participant *****
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

	//***** This club id & competition id from contact person *****
	$contactQuery = "SELECT clubId, competitionId FROM contact WHERE contactId = '$cId'";
	$contactData = mysqli_query($con, $contactQuery);

	if (!$contactData) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$datadata = $contactData->fetch_row();
	$clubId = $datadata[0];
	$competitionId = $datadata[1];
	
	//echo "competition Id: " . $competitionId . "club id: " . $clubId;
	
	//***** Get this clubname *****
	$clubQuery2 = "SELECT club FROM clubs WHERE clubId = '$clubId'";
	$theClubData = mysqli_query($con, $clubQuery2);

	if(!$theClubData) {
		die('Error: ' . mysqli_error($con));
	}

	$theClub = $theClubData->fetch_object()->club;

	//***** Get which disciplines this participant has applied to *****
	$disciplinesquery = "SELECT * FROM participantdisciplines WHERE participantId = '$pId'";
	$data = mysqli_query($con, $disciplinesquery);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$partDisciplines = [];
	while($discRow = $data->fetch_object()) {
		$partDisciplines[] = ['pIndex' => $discRow->pIndex, 'discipline' => $discRow->discipline, 'ageClass' => $discRow->yearClass];
	}

	//***** Disciplines for this competition *****
	$competitionQuery = "SELECT * FROM competitiondisciplines WHERE competitionId = '$competitionId'";
	$competitionData = mysqli_query($con, $competitionQuery);

	if (!$competitionData) {
	  die('Error: ' . mysqli_error($con));
	}

	$competition = [];
	while($compRow = $competitionData->fetch_object()) {
		$competition[] = ['ageClass' => $compRow->yearClass, 'discipline' => $compRow->discipline];
	}

	//***** Collect everything in array *****
	$part = [];
	$part[] = [	'firstName' => $firstName,
				'lastName' => $lastName,
				'birthYear' => $birthYear,
				'club' => $theClub,
				'disciplines' => $partDisciplines, 
				//'clubs' => $clubsArray,
				'clubId' => $clubId,
				'contactId' => $cId,
				'allDisciplines' => $competition];

	echo json_encode($part);
?>