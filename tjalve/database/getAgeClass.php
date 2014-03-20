<?php
	include "config.php";
	
	$compID = $_GET['ageClass'];
	
	$query = "SELECT * FROM age_class WHERE ageClass = '$ageClass'";
	$data = mysqli_query($con, $query);
	//var_dump($compID);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	while($row = $data->fetch_object()){
	//echo "<div id='competition'> ålder: " . $row->ageClass . "</div>";	
	echo "<div id='competition'> gren: " . $row->discipline . "</div>";	
	}
	mysqli_close($con);
	?>