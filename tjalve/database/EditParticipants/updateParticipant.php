<?php
ob_start();
	include "../config.php";

	$pId = $_GET['participantId'];
	$updFName = $_POST['fName'];
	$updLName = $_POST['lName'];
	$updBYear = $_POST['bYear'];
	$updClubId = $_POST['clubsList'];
	$cId = $_POST['contactId'];

	//echo $updFName . " " . $updLName . " participantId " . $pId . " birth year: " . $updBYear . " klubb id: " . $updClubId . " kontakt id: " . $cId . " 	HEJ";
	
	$queryUpdate = "UPDATE participant SET firstName = '$updFName', lastName = '$updLName', birthYear = '$updBYear' WHERE participantId = '$pId'";
	$data = mysqli_query($con, $queryUpdate);
	
	if (!mysqli_query($con,$queryUpdate)) {
	  die('Error: ' . mysqli_error($con));
	}
/*
	$whichClub = "SELECT clubId FROM clubs WHERE club = '$updClub'"
	$whichData = mysqli_query($con, $whichClub);

	if (!mysqli_query($con,$whichClub)) {
	  die('Error: ' . mysqli_error($con));
	}

	$clubId = $whichData->fetch_object();

	//Denna borde fungera på riktigt istället om man vill testa........
	UPDATE contact co
	INNER JOIN clubs c ON c.club = '$updClub'
	SET co.clubId = c.clubId 
	WHERE co.contactId = '$cId'

*/
	$clubQuery = "UPDATE contact SET clubId = '$updClubId' WHERE contactId = '$cId'";

	$clubData = mysqli_query($con, $clubQuery);

	if (!mysqli_query($con,$clubData)) {
	  die('Error: ' . mysqli_error($con));
	}

	header("Location: ../../editParticipants.php");
	mysqli_close($con);
ob_flush();
?>