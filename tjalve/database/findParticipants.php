<?php
	include "config.php";

	$contactId = $_GET['contactId'];
	$query = "SELECT * FROM participant WHERE contactId = '$contactId'";
	$data = mysqli_query($con, $query);

	$disciplinesquery = "SELECT * FROM participant WHERE contactId = '$contactId'";
	$disciplinesquerydata = mysqli_query($con, $disciplinesquery);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	while($row = $data->fetch_object()) {
		echo "<div id='confirmedParticipantOneEach'><table id='confirmedParticipantTable'><tr> <td>" . $row->firstName . "</td> <td> " . $row->lastName . "</td> <td></td> <td></td> </tr>";

		$disciplinesquery = "SELECT * FROM disciplines WHERE participantId = '$row->participantId'";
		$disciplinesquerydata = mysqli_query($con, $disciplinesquery);
		
		if (!$disciplinesquerydata) {
		  die('Error: ' . mysqli_error($con));
		}
		
		while($disciplineRow = $disciplinesquerydata->fetch_object()) {
			echo "<tr> <td></td> <td>" . $disciplineRow->class . "</td> <td>" . $disciplineRow->discipline . "</td></tr>";
		}

		echo "</td><td><a href='database/deleteParticipants.php?participantId=".$row->participantId."'><button id='deleteButton'>Radera</button></a></td> </tr></table></div>";
	}

	mysqli_close($con);							
?>