<?php
	include "config.php";
	
	$sql = "INSERT INTO clubs (Name, Phonenumber, Adress, Zip, Email)
	VALUES
	('$_POST[newClub]','$_POST[newClubNumber]','$_POST[newClubAdress]' ,'$_POST[newClubZipAdress]' ,'$_POST[newClubEmail]')";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	header("Location: ../applyOne.php?competitionId=".$_GET['competitionId']);
?>