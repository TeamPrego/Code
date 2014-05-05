<?php
ob_start();
	include "../class/config.php";

	$pId = $_GET['participantId'];
	$updFName = $_POST['fName'];
	$updLName = $_POST['lName'];
	$updBYear = $_POST['bYear'];
	$updClubId = $_POST['clubsList'];
	$cId = $_POST['contactId'];

	$queryUpdate = "UPDATE participant SET firstName = '$updFName', lastName = '$updLName', birthYear = '$updBYear' WHERE participantId = '$pId'";
	$data = mysqli_query($con, $queryUpdate);
	
	if (!mysqli_query($con,$queryUpdate)) {
	  die('Error: ' . mysqli_error($con));
	}

	$clubQuery = "UPDATE contact SET clubId = '$updClubId' WHERE contactId = '$cId'";

	$clubData = mysqli_query($con, $clubQuery);

	if (!mysqli_query($con,$clubData)) {
	  die('Error: ' . mysqli_error($con));
	}

	header("Location: ../editParticipantTest.php");
	mysqli_close($con);
ob_flush();
?>