<?php
	include "config.php";

	$id = $_POST['participantId'];
	
	if($id === "") {
		$sql = "INSERT INTO participant (contactId, firstName, lastName, birthYear, prio)
		VALUES
		('$_POST[contactId]', '$_POST[fName]','$_POST[lName]','$_POST[bYear]','$_POST[prio]')";

		if (!mysqli_query($con,$sql)) {
		  die('Error: ' . mysqli_error($con));
		}
		$id = $con->insert_id;
	}
	else {
		$checkDiscipline = []; 
		$sqlDiscipline = mysqli_query($con, "SELECT * FROM participantdisciplines WHERE participantId = '$id'");

		while($row = $sqlDiscipline->fetch_object()) {
			$checkDiscipline[] = $row->discipline;
		}
	}

	$name = $_POST['gren'];
	foreach ($name as $grentyp) { 
		if(!in_array($grentyp, $checkDiscipline)) {
			array_push($checkDiscipline, $grentyp);
			$SB = "SB" . $grentyp;
			$PB = "PB" . $grentyp;
			$quary = "INSERT INTO participantdisciplines (participantId, yearClass, discipline, SB, PB)
			VALUES ('$id', '$_POST[chooseClass]', '$grentyp', '$_POST[$SB]', '$_POST[$PB]')";

			if (!mysqli_query($con,$quary)) {
			  die('Error: ' . mysqli_error($con));
			}
		}
	}

	mysqli_close($con);
	header("Location: ../applyTwo.php?contactId=".$_POST['contactId']."&prio=".$_POST['prio']);
