<?php
	include "config.php";

	$sql = "INSERT INTO participant (contactId, firstName, lastName, birthYear, class)
	VALUES
	('$_POST[contactId]', '$_POST[fName]','$_POST[lName]','$_POST[bYear]', '$_POST[chooseClass]')";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);

	header("Location: ../applyTwo.php?contactId=".$_POST['contactId']);
	//header("Location: ../../applyTwo.php?contactId=".$_POST['contactId']);
?>