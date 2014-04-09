<?php
	$class = $_GET['class'];
	$contactId = $_GET['contactId'];
	include "database/config.php";

	$data = mysqli_query($con, "SELECT competitionId FROM contact WHERE contactId = '$contactId'");
	$competitionid = $data->fetch_object()->competitionId;

	$query = "SELECT * FROM competitiondisciplines WHERE yearClass = '$class' AND competitionId = '$competitionid'";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$disc = [];
	while($row = $data->fetch_object()) {
		$disc[] = ['gren' => $row->discipline, 'klass' => $row->yearClass];
	}
	
	echo json_encode($disc);
	mysqli_close($con);
?>
