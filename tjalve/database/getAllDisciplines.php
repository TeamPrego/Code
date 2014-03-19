<?php
	include "config.php";
	
	$query = "SELECT * FROM alldisciplines";
	$data = mysqli_query($con, $query);
	//var_dump($compID);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$disc=[];
	while($row = $data->fetch_object()){
	$disc[] = ['gren'=>$row->discipline];
	//echo "<tr><td>" . $row->discipline . "</td></tr>";
	}
	echo json_encode($disc);
	mysqli_close($con);
	?>