<?php
	include "../config.php";

	$query = "SELECT club, clubId FROM clubs";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$allClubs = [];
	while($clubInfo = $data->fetch_object()) {
		$allClubs[] = ['clubName' => $clubInfo->club, 'clubId' => $clubInfo->clubId];
	}
	
	echo json_encode($allClubs);
	mysqli_close($con);
?>