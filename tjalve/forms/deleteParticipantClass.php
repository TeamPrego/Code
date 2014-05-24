<?php
	include "../class/config.php";
	
	$pId = $_GET['pIndex'];
	$query = "SELECT c.*, comp.*, p.*
            FROM participantdisciplines pd
            INNER JOIN participant p 			ON pd.participantId = p.participantId		
            INNER JOIN contact c          ON p.contactId = c.contactId
            INNER JOIN competition comp   ON c.competitionId = comp.competitionId
            WHERE pd.pIndex = '$pId'";
	$data = mysqli_query($con, $query);
  $deleteData = $data->fetch_object();

  $competitionId = $deleteData->competitionId;
  $participantId = $deleteData->participantId;
	$data = mysqli_query($con, "DELETE FROM participantdisciplines WHERE pIndex = '$pId'");

	// If the participant no longer have any disciplines
	$query = "SELECT * FROM `participantdisciplines` WHERE participantId = '$participantId'";
	$data = mysqli_query($con, $query);
	$counter = 0;
	while($row=$data->fetch_object())
		$counter++;

  if($counter == 0){
   	$data = mysqli_query($con, "DELETE FROM participant WHERE participantId = '$participantId'");
   	$participantId = 0;
   }
	mysqli_close($con);
	header("Location: ../pagesAdmin/editParticipant.php?competitionId=".$competitionId."&participantId=".$participantId);
?>