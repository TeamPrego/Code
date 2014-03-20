<?php
	$compID = $_GET['compID'];
	include "config.php";
	
	$query = "SELECT * FROM age_class WHERE compId = '$compID'";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$disc = [];
	while($row = $data->fetch_object()) {
		$disc[] = ['gren' => $row->discipline, 'klass' => $row->ageClass];
	}

	echo json_encode($disc);
	mysqli_close($con);
?>