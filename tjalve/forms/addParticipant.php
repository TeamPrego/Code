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
		echo "ParticipantId: ".$participantId;
	}

	$allDisciplines = getAllDisciplinesByParticipantId($participantId);
	$AllCompetitionDisciplineId = $_POST['competitionDisciplineId'];
	
	foreach ($AllCompetitionDisciplineId as $competitionDisciplineId) { 
		$check = true;

		//Check if the participant allready has applyed to this discipline
		foreach($allDisciplines as $eachDisciplines) {
			if($competitionDisciplineId == $eachDisciplines['competitionDisciplineId'])
				$check = false;
		}

		if($check) {
			$SB = "SB" . $competitionDisciplineId;
			$PB = "PB" . $competitionDisciplineId;
			$quary = "INSERT INTO participantdisciplines (participantId,competitionDisciplineId, SB, PB, prio)
			VALUES ('$participantId', '$competitionDisciplineId', '$_POST[$SB]', '$_POST[$PB]', '$prio')";

			if (!mysqli_query($con,$quary)) {
			  die('Error: ' . mysqli_error($con));
			}
		}
	}
	mysqli_close($con);
	header("Location: ../pagesUser/applyTwo.php?contactId=".$_POST['contactId']."&prio=".$_POST['prio']);
