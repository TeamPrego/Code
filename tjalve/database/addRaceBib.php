<?php
	include "config.php";

	$query = "SELECT * FROM participant";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = $_POST['bibBegin'];
	while($row = $data->fetch_object()) {
		$bib = $row->participantId;
		$queryUpdate = "UPDATE `participant` SET `bib` = '$count' WHERE `participantId` = '$row->participantId'";
		$fjong = mysqli_query($con, $queryUpdate);
		$count += 1;
	}
	header("Location: ../setRaceBib.php");
?>