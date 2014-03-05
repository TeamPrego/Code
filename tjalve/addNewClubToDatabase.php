<?php
	$con=mysqli_connect("localhost","root","","tjalve");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$sql="INSERT INTO klubbar (Name, Phonenumber, Adress, Zip, Email)
	VALUES
	('$_POST[newClub]','$_POST[newClubNumber]','$_POST[newClubAdress]' ,'$_POST[newClubZipAdress]' ,'$_POST[newClubEmail]')";

	if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }
	mysqli_close($con);
	header("Location: applyOne.php");
?>