<?php
	ob_start();
	include "config.php";
	$sql1 = "SELECT * FROM clubs WHERE club = '$_POST[chooseClub]'";
	$data = mysqli_query($con,$sql1);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	$clubId = $data->fetch_object()->clubId;

	
	$sql = "INSERT INTO contact (competitionId ,clubId ,name, email, phone)
	VALUES
	('$_POST[competitionId]', '$clubId','$_POST[contactPerson]','$_POST[contactEmail]','$_POST[contactPhone]')";
	

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	$contactId = $con->insert_id;

	mysqli_close($con);
	header("Location: ../applyTwo.php?contactId=".$contactId."&prio=".$_POST['prio']);
	ob_end_flush();
?>