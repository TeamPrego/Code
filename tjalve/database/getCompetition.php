<?php
	include "config.php";
	
	$compID = $_GET['compID'];
	
	$query = "SELECT * FROM competition WHERE compID = '$compID'";
	$data = mysqli_query($con, $query);
	//var_dump($compID);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	$row = $data->fetch_object();
	echo "<div id='competition'><h1>" . $row->compName . "</h1></div>";	
	echo "<img id ='compLogo' src=". $row->compIcon ." alt ='Image' />";
	echo "<div id='competition'> Arrangör: " . $row->compArr . "</div>";	
	echo "<div id='competition'> Tävlingsdatum: " . $row->compDate . "</div>";	
	echo "<div id='competition'> Sista anmälningsdag: " . $row->compLastDate . "</div>";	
	
	mysqli_close($con);
	?>

