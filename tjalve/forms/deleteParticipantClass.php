<?php
	include "../class/config.php";
	
	$pId = $_GET['pIndex'];
	echo $pId;

	$data = mysqli_query($con, "DELETE FROM participantdisciplines WHERE pIndex = '$pId'");

	mysqli_close($con);
	header("Location: ../pagesAdmin/editParticipant.php");
?>