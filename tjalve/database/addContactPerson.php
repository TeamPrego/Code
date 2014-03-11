<?php
	include "config.php";
	
	$sql = "INSERT INTO contact (contactPerson, contactEmail, contactPhone)
	VALUES
	('($_POST[contactPerson])','($_POST[contactEmail])','($_POST[contactPhone])')";

	$data = mysqli_query($con, "SELECT * FROM contact WHERE contactPhone='123'");
	$cId = $data->fetch_object()->contactId;
	$fphone  = $_GET['$cId'];

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);

	header("Location: ../applyTwo.php?&cId=".$cId);
?>