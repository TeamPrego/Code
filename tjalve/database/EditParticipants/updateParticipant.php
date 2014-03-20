<?php
ob_start();
	include "../config.php";
	echo 'woo';

	$pId = $_GET['participantId'];
	$updFName = $_POST['u_fName'];
	$updLName = $_POST['u_lName'];
	$updBYear = $_POST['u_bYear'];
	echo $updFName;
	echo $pId;
	echo $updLName;
	echo $updBYear;

	$queryUpdate = "UPDATE participant SET firstName = '$updFName', lastName = '$updLName', birthYear = '$updBYear' WHERE participantId = '$pId'";
	$data = mysqli_query($con, $queryUpdate);
	if (!mysqli_query($con,$queryUpdate)) {
	  die('Error: ' . mysqli_error($con));
	}

	header("Location: ../../editParticipants.php");
	mysqli_close($con);
ob_flush();
?>