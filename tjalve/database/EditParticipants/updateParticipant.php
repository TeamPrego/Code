<?php
ob_start();
	include "../config.php";

	$pId = $_GET['participantId'];
	$updFName = $_POST['fName'];
	$updLName = $_POST['lName'];
	$updBYear = $_POST['bYear'];
	$updClub = $_POST['clubsList'];
	$cId = $_POST['contactId'];
	echo $pId . " " . $updFName . "" . $updLName . " " . $pId . " " . $updBYear . " " . $updClub . " " . $cId;
	
	$queryUpdate = "UPDATE participant SET firstName = '$updFName', lastName = '$updLName', birthYear = '$updBYear' WHERE participantId = '$pId'";
	$data = mysqli_query($con, $queryUpdate);
	
	if (!mysqli_query($con,$queryUpdate)) {
	  echo "Heja";
	  die('Error: ' . mysqli_error($con));
	}

	$clubUpdate = "UPDATE clubs SET club = '$updClub' WHERE contactId = '$cId'";
	$data = mysqli_query($con, $clubUpdate);
	
	if (!mysqli_query($con,$clubUpdate)) {
	  echo "Tjoho";
	  die('Error: ' . mysqli_error($con));
	}

	echo "klart";
	header("Location: ../../editParticipants.php");
	mysqli_close($con);
ob_flush();
?>