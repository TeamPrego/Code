<?php
	include "config.php";
	$competitionId = $_GET['competitionId'];

	$query = "SELECT clubId FROM contact WHERE competitionId = '$competitionId'";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$array = [];
	while($row = $data->fetch_object()) {
		$array[] = ['clubId' => $row->clubId];
	}
	echo json_encode($array);
?>