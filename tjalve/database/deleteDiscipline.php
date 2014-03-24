<?php

	include "config.php";

	if (!isset($_GET['compID'])) {
	    echo 'No no no...';
	    exit;
	}

	$compID = $_GET['compID'];
	$gren = $_GET['gren'];
	$klass = $_GET['klass'];
	
	echo $compID;
	echo $gren;
	echo $klass;
	
		
	$sql = "DELETE FROM age_class WHERE compId = $compID && discipline = '$gren' && ageClass = '$klass'";

		if (!mysqli_query($con,$sql)) {
		  die('Error: ' . mysqli_error($con));
		}
		mysqli_close($con);
	header("Location: ../createCompetitionStep2.php?compID=".$compID);
?>