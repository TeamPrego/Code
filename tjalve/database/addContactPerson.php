<?php
	include "config.php";
	
	$sql = "INSERT INTO contact (club, contactPerson, contactEmail, contactPhone)
	VALUES
	('htmlspecialchars($_POST[fName])','htmlspecialchars($_POST[lName])','htmlspecialchars($_POST[bYear])')";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	header("Location: ../applyTwo.php");
?>