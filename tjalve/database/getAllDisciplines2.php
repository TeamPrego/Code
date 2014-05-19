<?php
	include "config.php";
	
	$query = "SELECT * FROM alldisciplines";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$disc=array();
	while($row = $data->fetch_object()){
	$disc[] = ['gren'=>$row->discipline];
	}
	echo json_encode($disc);
	mysqli_close($con);
?>