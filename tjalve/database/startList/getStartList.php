<?php
	include "../config.php";
	
	$competitionId = $_GET['competitionId'];
	$ageClass = $_GET['ageClass'];
	$discipline = $_GET['discipline'];
	$disc = [];

	//Findning all classes and dicipilnes
	$dataAgeClass = mysqli_query($con, "SELECT * FROM age_class WHERE compID = '$competitionId'");
	if (!$dataAgeClass) {
	  die('Error: ' . mysqli_error($con));
	}

	while($rowAgeClass = $dataAgeClass->fetch_object()){
		$ok = false;

		if(($ageClass === "Alla" && $discipline === "Alla") ||
			($rowAgeClass->ageClass === $ageClass && $discipline === "Alla") ||
			($rowAgeClass->discipline === $discipline && $ageClass === "Alla") ||
			($rowAgeClass->discipline === $discipline && $rowAgeClass->ageClass === $ageClass))
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
					$dataDiscipline = mysqli_query($con, "SELECT * FROM disciplines WHERE participantId = '$participantId'");

					if (!$dataDiscipline) {
					  die('Error: ' . mysqli_error($con));
					}
					while($rowDiscipline = $dataDiscipline->fetch_object()){
						if($rowDiscipline->class === $rowAgeClass->ageClass && $rowDiscipline->discipline === $rowAgeClass->discipline)
							$participants[] = [	'firstName'=> $rowParticipant->firstName,
																	'lastName' => $rowParticipant->lastName,
																	'club' => $rowContact->club];
					}
				}
			}
			$disc[] = [ 'className' => $rowAgeClass->ageClass,
									'discipline' => $rowAgeClass->discipline,
									'participants' => $participants];

		}
	}
	echo json_encode($disc);
	mysqli_close($con);
