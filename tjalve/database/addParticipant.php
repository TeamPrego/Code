<?php
	include "config.php";
	
	$sql = "INSERT INTO participant (contactId, firstName, lastName, birthYear, prio)
	VALUES
	('$_POST[contactId]', '$_POST[fName]','$_POST[lName]','$_POST[bYear]','$_POST[prio]')";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	$id = $con->insert_id;
	$name = $_POST['gren'];
	foreach ($name as $grentyp) { 
		$SB = "SB" . $grentyp;
		$PB = "PB" . $grentyp;
		$quary = "INSERT INTO participantdisciplines (participantId, yearClass, discipline, SB, PB)
		VALUES ('$id', '$_POST[chooseClass]', '$grentyp', '$_POST[$SB]', '$_POST[$PB]')";

		if (!mysqli_query($con,$quary)) {
		  die('Error: ' . mysqli_error($con));
		}
	}
	mysqli_close($con);
	header("Location: ../applyTwo.php?contactId=".$_POST['contactId']."&prio=".$_POST['prio']);
