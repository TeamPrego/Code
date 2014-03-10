<?php
error_reporting(E_ALL);

?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>
			 Tjalve
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
		
	</head>
	<body>

	<!--Headning -->
	<h1> Dina ajojojaj </h1>
	<!--Line -->
	<h2> mina anmälningar </h2>
	<hr>
	<?php
		echo "Nejmen ";
		$connection = mysqli_connect("localhost", "root", "root" ,"submission");
		echo "hej ";
		/*if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}*/
		echo " du, ";
		$db_query = "SELECT contactPerson FROM contact WHERE contactPhone=0";
		$get_db = mysqli_query($connection, $db_query);
		$va = mysqli_fetch_array($get_db);
		// print_r($va);
		$updating = "UPDATE contact SET club='Norrpan' WHERE contactPerson = 'Anna Palmerius'"; 
		$upd_db = mysqli_query($connection, $updating);
		$ja = mysqli_fetch_array($upd_db);
		
		$insertion = "INSERT INTO contact (competitionId, contactId, club, contactPerson, contactEmail, contactPhone) VALUES ('1', '2', 'Norrköping', 'Emma', 'emma@mail.com', '123')";
		$insertiono = "INSERT INTO contact(`competitionId`, `contactId`, `club`, `contactPerson`, `contactEmail`, `contactPhone`) VALUES (1,2,Norrköping,Emma,emma@mail.com,123)";
		$inserted = mysqli_query($insertiono);


		$db_query = "SELECT contactPerson FROM contact WHERE contactPerson='Emma'";
		$get_db = mysqli_query($connection, $db_query);
		$vad = mysqli_fetch_array($get_db);
		// print_r($va);
		echo "Hejhej  " . $vad['contactPerson'] . " till lunch ";
		echo " hoppsan! ";

		mysqli_close($connection);
	?>
	<h1> hejdå </h1>
	<p> hej </p>
	</body>
</html>