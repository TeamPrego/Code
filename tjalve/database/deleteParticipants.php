<?php
 include "config.php";

	if (!isset($_GET['participantId'])) {
	    echo 'No ID was given...';
	    exit;
	}

	$participantId = $_GET['participantId'];
	$data = mysqli_query($con, "SELECT * FROM participant WHERE participantId='$participantId'");
	$contactId = $data->fetch_object()->contactId;

	$sql = "DELETE FROM participant WHERE participantId = $participantId";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	header("Location: ../applyTwo.php?contactId=".$contactId."&prio=".$_GET['prio']);
?>