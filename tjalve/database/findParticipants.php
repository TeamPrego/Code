<?php
	include "config.php";

	$contactId = $_GET['contactId'];
	$query = "SELECT * FROM participant WHERE contactId = '$contactId'";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object()) {
		echo "<div id='confirmedParticipantOneEach'><table id='confirmedParticipantTable'><tr> <td>" . $row->firstName . "</td> <td> " . $row->lastName . "</td> <td></td> <td></td> </tr>" . 
		"<tr> <td></td> <td>" . $row->class . "</td> <td> " . "Gren" . 
		"</td><td><a href='database/deleteParticipants.php?participantId=".$row->participantId."'><button id='deleteButton'>Radera</button></a></td> </tr></table></div>";
		$count = $count + 1;
	}

	mysqli_close($con);							
?>