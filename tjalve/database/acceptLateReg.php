<?php
	include "config.php";
	
	$participant = $_POST['participant'];
	foreach ($participant as $participantId) { 
		$queryUpdate = "UPDATE `participant` SET `prio` = '1' WHERE `participantId` = '$participantId'";
		mysqli_query($con, $queryUpdate);
	}
	header("Location: ../acceptLateReg.php");
?>