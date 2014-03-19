<?php
ob_start();
	include "database/config.php";
	echo "zup?";

	$pId = $_GET['participantId'];
	$updFName = $_POST['u_fName'];
	$updLName = $_POST['u_lName'];
	$updBYear = $_POST['u_bYear'];
	
	$queryUpdate = "UPDATE participant SET firstName = '$updFName', lastName = '$updLName', birthYear = '$updBYear' WHERE participantId = '$pId' ";
	$data = mysqli_query($con, $queryUpdate);

	header("Location: editParticipants.php");
	mysqli_close($con);
ob_flush();
?>