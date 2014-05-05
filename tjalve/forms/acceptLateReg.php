<?php
	include "config.php";
	
	$index = $_POST['participant'];
	foreach ($index as $pIndex) { 
		$queryUpdate = "UPDATE `participantdisciplines` SET `prio` = '2' WHERE `pIndex` = '$pIndex'";
		mysqli_query($con, $queryUpdate);
	}
	header("Location: ../acceptLateReg.php");
?>