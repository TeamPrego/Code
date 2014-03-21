<?php
	include "config.php";
	
	$compID = $_GET['compID'];
	var_dump($compID);
	$name = $_POST['gren'];
	$ageClass = $_POST['chooseClass'];
	
	//kolla vilka grenar till resp ålder som redan finns i db så men inte kan lägga in dubbla...
	$query2 = "SELECT discipline FROM age_class WHERE compId = '$compID' && ageClass = '$ageClass'";
	$data2 = mysqli_query($con, $query2);
	
	if (!$data2) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$array=[];
	foreach ($name as $grentyp) { 
	while($row = $data2->fetch_object()){
		array_push($array, $row->discipline);
		echo 'name:  ' .$grentyp. '<br>';
		echo '$row->disc:  ' .$row->discipline. '<br>';	
	}
	
	
		if(!in_array($grentyp, $array)) {
			array_push($array, $grentyp);
			$quary = "INSERT INTO age_class (compId, ageClass, discipline)
			VALUES ('$compID', '$_POST[chooseClass]', '$grentyp')";
			if (!mysqli_query($con,$quary)) {
			  die('Error: ' . mysqli_error($con));
			}
		}
	}
	mysqli_close($con);
	header("Location: ../createCompetitionStep2.php?compID=".$compID);
	?>
