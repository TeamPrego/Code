<?php  

	// 1: WAMP 2: MAMP 3: SurfTown
	$who = 1;

	switch($who) {

		case 1:
		  $dbhost="localhost";
		  $dbuser="root";
		  $dbpass="";
		  $dbname="tjalve";
		  break;
		case 2:
		  $dbhost="localhost";
		  $dbuser="root";
		  $dbpass="root";
		  $dbname="tjalve";
		  break;
		 case 3:
		  $dbhost="mydb9.surf-town.net";
		  $dbuser="Tjalve_prego";
		  $dbpass="4d5J886";
		  $dbname="192031-submission";
		  break;
	}
  
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  mysqli_set_charset($con,"utf8");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}