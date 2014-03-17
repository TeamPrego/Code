<?php
	include "config.php";
	
	$query = "SELECT * FROM alldisciplines";
	$data = mysqli_query($con, $query);
	//var_dump($compID);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	while($row = $data->fetch_object()){
	echo $row->discipline, "\n";
	}
	mysqli_close($con);
	?>