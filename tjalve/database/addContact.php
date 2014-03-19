<?php
	ob_start();
	include "config.php";
	
	$sql = "INSERT INTO contact (competitionId ,club ,contactPerson, contactEmail, contactPhone)
	VALUES
	('$_POST[competitionId]', '$_POST[chooseClub]','$_POST[contactPerson]','$_POST[contactEmail]','$_POST[contactPhone]')";
	

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	$contactId = $con->insert_id;

	mysqli_close($con);
	header("Location: ../applyTwo.php?contactId=".$contactId);
	ob_end_flush();
?>