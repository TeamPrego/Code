<?php
	ob_start();
	include "../config.php";
	
	$pId = $_GET['pIndex'];
	echo $pId;

	$query = "DELETE FROM disciplines WHERE pIndex='$pId'";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	mysqli_close($con);
	header("Location: ../../editParticipants.php");
	ob_end_flush();
?>