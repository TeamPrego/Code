<?php
	include "config.php";
	include "participant.php";

	$temp = new Participant();

	$temp->setContactId($_POST['contactId']);
	$temp->setfirstName($_POST['fName']);
	$temp->setlastName($_POST['lName']);
	$temp->setBirthYear($_POST['bYear']);
	$temp->setPrio($_POST['prio']);
	$temp->pushParticipanttoDB();
	$Id = $temp->getParticipantId();
	
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
