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
<<<<<<< HEAD
	echo "<img id ='compLogo' src=". $row->compIcon ." alt ='Image' />";
	mysqli_close($con);
	?>


=======
	
	mysqli_close($con);
	?>
>>>>>>> 58104874a8f6145812586926de92b0ebe2f36ec6
