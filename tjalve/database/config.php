
<?php  

	// 1: WAMP 2: MAMP 3: Binero
	$who = 1;

	switch($who) {

		case 1:
		  $dbhost="localhost";
		  $dbuser="root";
		  $dbpass="";
		  $dbname="submission";
		  break;
		case 2:
			$dbhost="localhost";
		  $dbuser="root";
		  $dbpass="root";
		  $dbname="submission";
		  break;
		 case 3:
		 	$dbhost="localhost";
		  $dbuser="root";
		  $dbpass="";
		  $dbname="submission";
		  break;
	}
  
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  mysqli_set_charset($con,"utf8");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}