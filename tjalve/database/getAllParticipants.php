<?php
	include "config.php";

	echo "<table id='confirmedParticipantTable'>
			. <tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>";

	$query = "SELECT * FROM participant";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object()) {
		echo "<tr><td>" . $row->bib . "</td><td>" . 
		$count += 1;
	}

	echo "</table>";

	if($count === 0)
		echo "<div id='noParticipants'>Finns än inga deltagare registrerade ännu</div>";

	mysqli_close($con);							
?>