

<?php
  include "database/config.php";
	
  $sql="UPDATE `submission`.`competition` SET `compName` = '$_POST[compName]',
  `compArr` = '$_POST[compArr]',
  `compDate` = '$_POST[compDate]',
  `compLastDate` = '$_POST[compLastDate]' WHERE `competition`.`compID` = '$_POST[compID]'";
	
  if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	header("Location: editCompetition.php");
?>

