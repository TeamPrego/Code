<?php
ob_start();
	include "../config.php";

	$pId = $_GET['participantId'];
	$updFName = $_POST['fName'];
	$updLName = $_POST['lName'];
	$updBYear = $_POST['bYear'];
	echo $pId . " " . $updFName . "" . $updLName . " " . $pId . " " . $updBYear;
	
	$queryUpdate = "UPDATE participant SET firstName = '$updFName', lastName = '$updLName', birthYear = '$updBYear' WHERE participantId = '$pId'";
	$data = mysqli_query($con, $queryUpdate);
	
	if (!mysqli_query($con,$queryUpdate)) {
	  echo "Heja";
	  die('Error: ' . mysqli_error($con));
	}
	echo "klart";
	header("Location: ../../editParticipants.php");
	mysqli_close($con);
ob_flush();
?>