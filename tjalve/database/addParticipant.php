<?php
	include "config.php";
	
	$sql = "INSERT INTO participant (firstName, lastName, birthYear, contactPerson, contactPhone, contactEmail, club)
	VALUES
	('htmlspecialchars($_POST[fName])','($_POST[lName])','($_POST[bYear])', '($_POST[contactPerson])','($_POST[contactPhone])','($_POST[contactEmail])', '$_POST[club]')";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	//header("Location: ../applyTwo.php");
	header("Location: ../../applyTwo.php");
?>