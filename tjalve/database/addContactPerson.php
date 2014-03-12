<?php
	include "config.php";
	
	$sql = "INSERT INTO contact (contactPerson, contactEmail, contactPhone)
	VALUES
	('($_POST[contactPerson])','($_POST[contactEmail])','($_POST[contactPhone])')";

	$contactPhone = ($_POST[contactPhone]);

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	header("Location: ../applyTwo.php?contactPhone=".$contactPhone);
?>