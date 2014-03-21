<?php
	include "database/config.php";
	$competitionId = $_GET['competitionId'];
	$data = mysqli_query($con, "SELECT * FROM competition WHERE compID = '$competitionId'");
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	echo $data->fetch_object()->compName;
?>