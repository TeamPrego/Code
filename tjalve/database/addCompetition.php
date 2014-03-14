<?php
	include "config.php";
	
	$sql = "INSERT INTO `submission`.`competition` (`compID`, `compName`, `compArr`, `compDate`, `compLastDate`, `compIcon`) 
	VALUES (NULL,'$_POST[compName]','$_POST[organizer]','$_POST[date]','$_POST[lastDay]','$_POST[file]')";
	
	
	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}

	$data = mysqli_query($con, "SELECT compID FROM competition WHERE compName='$_POST[compName]'");
	$contactId = $data->fetch_object()->compID;

	mysqli_close($con);
	
	header("Location: ../createCompetitionStep2.php?compID=".$compID);
?>
