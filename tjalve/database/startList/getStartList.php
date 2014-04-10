<?php
	include "../config.php";
	
	$competitionId = $_GET['competitionId'];
	$yearClass = $_GET['ageClass'];
	$discipline = $_GET['discipline'];
	$disc = [];

	//Findning all classes and dicipilnes
	$dataAgeClass = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId = '$competitionId'");
	if (!$dataAgeClass) {
	  die('Error: ' . mysqli_error($con));
	}

	while($rowAgeClass = $dataAgeClass->fetch_object()){
		$ok = false;

		if(($yearClass === "Alla" && $discipline === "Alla") ||
			($rowAgeClass->yearClass === $yearClass && $discipline === "Alla") ||
			($rowAgeClass->discipline === $discipline && $yearClass === "Alla") ||
			($rowAgeClass->discipline === $discipline && $rowAgeClass->yearClass === $yearClass))
			$ok = true;

		if($ok == true){
			$dataContact = mysqli_query($con, "SELECT * FROM contact WHERE competitionId = '$competitionId'");
			if (!$dataContact) {
			  die('Error: ' . mysqli_error($con));
			}

			$participants = [];
			while($rowContact = $dataContact->fetch_object()){
				$contactId = $rowContact->contactId;
				$dataParticipant = mysqli_query($con, "SELECT * FROM participant WHERE contactId = '$contactId'");

				if (!$dataParticipant) {
				  die('Error: ' . mysqli_error($con));
				}

				while($rowParticipant = $dataParticipant->fetch_object()){
					$participantId = $rowParticipant->participantId;
					$dataDiscipline = mysqli_query($con, "SELECT * FROM participantdisciplines WHERE participantId = '$participantId'");

					if (!$dataDiscipline) {
					  die('Error: ' . mysqli_error($con));
					}
					while($rowDiscipline = $dataDiscipline->fetch_object()){
						if($rowDiscipline->yearClass === $rowAgeClass->yearClass && $rowDiscipline->discipline === $rowAgeClass->discipline)
							$participants[] = [	'firstName'=> $rowParticipant->firstName,
																	'lastName' => $rowParticipant->lastName,
																	'club' => $rowContact->clubId,
																	'prio' => $rowDiscipline->prio];
					}
				}
			}
			$disc[] = [ 'className' => $rowAgeClass->yearClass,
									'discipline' => $rowAgeClass->discipline,
									'participants' => $participants];

		}
	}
	echo json_encode($disc);
	mysqli_close($con);
