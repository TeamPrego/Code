<?php
	include "config.php";
	
	$compID = $_GET['compID'];
	var_dump($compID);
	$name = $_POST['gren'];
	
	foreach ($name as $grentyp) { 
		$quary = "INSERT INTO age_class (compId, ageClass, discipline)
		VALUES ('$compID', '$_POST[chooseClass]', '$grentyp')";

		if (!mysqli_query($con,$quary)) {
		  die('Error: ' . mysqli_error($con));
		}
	}
	mysqli_close($con);
	header("Location: ../createCompetitionStep2.php?compID=".$compID);
	?>
