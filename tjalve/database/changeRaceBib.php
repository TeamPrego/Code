<?php
	include "config.php";

	$query = "SELECT * FROM participant";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object()) {
		$bib = $row->participantId;
		$queryUpdate = "UPDATE `participant` SET `bib` = '$_POST[$bib]' WHERE `participantId` = '$row->participantId'";
		$fjong = mysqli_query($con, $queryUpdate);
	}
	header("Location: ../setRaceBib.php");
?>