
<?php
	include "templates/header.php";
?>
<!-- Headning -->
<h1>Tjalve Friidrott</h1>

<hr>
<table class ="firstTableList">
	<thead>
		<tr>
			<th>Tävlingsnamn</th>
			<th>Datum</th>
			<th>Sista anmälningsdag</th>
			<th>Anmälan</th>
			<th>Startlista</th>
			<th>Reslutatlista</th>
	</thead>	
<?php

	include "database/config.php";
	date_default_timezone_set("Europe/Stockholm");
	$date = date('Y-m-d ', time());
	echo "The current time is: " . $date;


	$query = "SELECT * FROM competition";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object()){
		if($count % 2 === 0)
			$which = "even";
		else
			$which = "odd";
		echo "<tr class='$which'><td>" . $row->compName . "</td>".
		"<td>". $row->compDate."</td>".
		"<td>". $row->compLastDate ."</td>";

		if($row->compLastDate > $date)
			echo "<td><a href='applyOne.php?competitionId=".$row->compID."&prio=1'>Anmäl dig här</a></td>";

		elseif($row->compDate > $date)
			echo "<td><a href='applyOne.php?competitionId=".$row->compID."&prio=0'>Sen anmälan</a></td>";

		else 
			echo "<td>Too late</td>";

		echo "<td>Länk</td>".
		"<td><a href='resultat.php?competitionId=".$row->compID."'>Se resultat här</a></td><tr>";
		$count++;
	}
?>
</table>

<?php
	include "templates/footer.php";
?>