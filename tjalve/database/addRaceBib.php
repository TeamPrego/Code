<?php
	include "config.php";

	$competition = $_GET['competition'];
	$count = $_GET['startNumber'];
	echo $competition;
	echo $count;

	$dataCompetition = mysqli_query($con, "SELECT * FROM competition WHERE competitionName = '$competition'");
	
	if (!$dataCompetition) {
	  die('Error: ' . mysqli_error($con));
	}

	$competitionId = $dataCompetition->fetch_object()->compID;
	$dataContact = mysqli_query($con, "SELECT * FROM contact WHERE competitionId = '$competitionId'");
	
	if (!$dataContact) {
	  die('Error: ' . mysqli_error($con));
	}
	while($rowContact = $dataContact->fetch_object()) {
		$dataParticipant = mysqli_query($con, "SELECT * FROM participant WHERE contactId = '$rowContact->contactId'");

		if (!$dataContact) {
		  die('Error: ' . mysqli_error($con));
		}

		while($rowParticipant = $dataParticipant->fetch_object()) {
			$queryUpdate = "UPDATE `participant` SET `bib` = '$count' WHERE `participantId` = '$rowParticipant->participantId'";
			$fjong = mysqli_query($con, $queryUpdate);
			$count += 1;
		}
	}

	mysqli_close($con);
?>