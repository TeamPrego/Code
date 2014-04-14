<?php
	include "config.php";
	$query = "SELECT * FROM competition";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$array = [];
	while($row = $data->fetch_object()) {
		$array[] = ['competitionName' => $row->competitionName,
								'competitionId' => $row->competitionId];
	}
	echo json_encode($array);
?>