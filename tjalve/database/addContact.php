<?php
	include "config.php";
	
	$sql = "INSERT INTO contact (club ,contactPerson, contactEmail, contactPhone)
	VALUES
	('$_POST[chooseClub]','$_POST[contactPerson]','$_POST[contactEmail]','$_POST[contactPhone]')";
	
	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}

	$data = mysqli_query($con, "SELECT contactId FROM contact WHERE contactPhone='$_POST[contactPhone]'");
	$contactId = $data->fetch_object()->contactId;

	mysqli_close($con);
	//header("Location: ../../applyTwo.php?&cId=".$cId);
	header("Location: ../applyTwo.php?contactId=".$contactId);
?>