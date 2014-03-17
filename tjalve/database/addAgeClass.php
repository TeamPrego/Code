<?php
	include "config.php";
	
	var_dump($_POST['age']);
	
	$sql = "INSERT INTO `submission`.`age_class` (`compID`, `ageClass`, `event`) 
	VALUES (NULL,'$_POST[age]','$_POST[event]')";
	
	
	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	//include "upload_file.php";
	//$data = mysqli_query($con, "SELECT compID FROM competition WHERE compName='$_POST[compName]'");
	//$compID = $data->fetch_object()->compID;

	mysqli_close($con);
	
	header("Location: ../createCompetition.php?compID=".$compID);
?>
