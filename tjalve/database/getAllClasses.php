<?php
	include "config.php";
	
	$query = "SELECT * FROM classes";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$class=[];
	while($row = $data->fetch_object()){
	$class[] = ['class'=>$row->Klass];
	}
	echo json_encode($class);
	mysqli_close($con);
?>