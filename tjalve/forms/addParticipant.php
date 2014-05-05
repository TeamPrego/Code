<?php
	include_once "../class/config.php";
	include_once "../class/participant.php";
	include_once "../class/participantdisciplines.php";

	$participantId = $_POST['participantId'];
	$prio = $_POST['prio'];

	if($participantId == 0) {
		$temp = new Participant();
		$temp->setContactId($_POST['contactId']);
		$temp->setfirstName($_POST['fName']);
		$temp->setlastName($_POST['lName']);
		$temp->setBirthYear($_POST['bYear']);
		$temp->pushParticipanttoDB();
		$participantId = $temp->getParticipantId();		
	}

	$allDisciplines = getAllDisciplinesByParticipantId($participantId);
	$name = $_POST['gren'];
	foreach ($name as $grentyp) { 
		$check = true;
		foreach($allDisciplines as $eachDisciplines) {
			if($grentyp == $eachDisciplines['discipline'] && $_POST['chooseClass'] == $eachDisciplines['yearClass'])
				$check = false;
		}

		if($check) {
			$SB = "SB" . $grentyp;
			$PB = "PB" . $grentyp;
			$quary = "INSERT INTO participantdisciplines (participantId, yearClass, discipline, SB, PB, prio)
			VALUES ('$participantId', '$_POST[chooseClass]', '$grentyp', '$_POST[$SB]', '$_POST[$PB]', '$prio')";

			if (!mysqli_query($con,$quary)) {
			  die('Error: ' . mysqli_error($con));
			}
		}
	}
	mysqli_close($con);
	header("Location: ../pagesUser/applyTwo.php?contactId=".$_POST['contactId']."&prio=".$_POST['prio']);
