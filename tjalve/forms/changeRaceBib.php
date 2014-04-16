<?php
	include "../database/config.php";

	$dataCheck = mysqli_query($con, "SELECT * FROM participant");
	if (!$dataCheck) {
	  die('Error: ' . mysqli_error($con));
	}

	$check = 1;
	$checkBib = [];
	while($rowCheck = $dataCheck->fetch_object()) {
		$bib = $rowCheck->participantId;
		echo $bib;
		if(!empty($_POST["$bib"])) {
			echo "Inte tom";
			if(!in_array($_POST["$bib"], $checkBib)) {
				array_push($checkBib, $_POST[$rowCheck->participantId]);
				echo "Insert";
			}
			else {
				$check = 0;
				echo "STOPP";
				break;
			}
		}
	}

	if($check === 1) {
		$data = mysqli_query($con, "SELECT * FROM participant");
		
		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}

		while($row = $data->fetch_object()) {
			$bibs = $row->participantId;
			if(!empty($_POST["$bibs"])){
				$queryUpdate = "UPDATE `participant` SET `bib` = '$_POST[$bibs]' WHERE `participantId` = '$row->participantId'";
				$fjong = mysqli_query($con, $queryUpdate);
			}
		}
	}
	echo $check;
	header("Location: ../setRaceBib.php?check=".$check."");
?>