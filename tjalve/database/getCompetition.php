<?php
	include "config.php";
	
	$compID = $_GET['compID'];
	
	$query = "SELECT * FROM competition WHERE competitionId = '$compID'";
	$data = mysqli_query($con, $query);
	//var_dump($compID);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	$row = $data->fetch_object();
	echo "<div id='competition'><h1>" . $row->competitionName . "</h1></div>";	
  // echo "<div id='compLogoDiv'>";

	echo "<table id='bronk'>";
	echo "<tr><td>Arrangör: </td><td>" . $row->compArr . "</td></tr>";	
	echo "<tr><td>Tävlingsdatum: </td><td>" . $row->compDate . "</td></tr>";	
	echo "<tr><td>Sista anmälningsdag: </td><td>" . $row->compLastDate . "</td></tr>";	

	echo "</table>";
  // echo "</div>";
 
		echo "<img id ='compLogo' src=". $row->logo ." alt ='Image' />";
		
	mysqli_close($con);
	?>
