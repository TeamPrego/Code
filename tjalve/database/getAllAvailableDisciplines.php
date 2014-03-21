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
	foreach ($disc as $key => $row) {
    $gren[$key]  = $row['gren'];
    $klass[$key] = $row['klass'];
	}
	
	array_multisort($klass, SORT_ASC, $gren, SORT_ASC , $disc);
	//sort($disc, SORT_REGULAR);
	//sort($disc['gren']);
	echo json_encode($disc);
	mysqli_close($con);
?>