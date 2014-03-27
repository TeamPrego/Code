
<?php
	include "templates/header.php";
?>
<!-- Headning -->
<h1>Tjalve Friidrott</h1>

<hr>
<table class ="firstTableList" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>Tävlingsnamn</th>
			<th>Datum</th>
			<th>Sista anmälningsdag</th>
			<th>Anmälan</th>
			<th>Startlista</th>
			<th>Reslutatlista</th>
		</tr>
	</thead>	
	<tr><td></td></tr>
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


	while($row = $data->fetch_object()){
		echo "<tr><td>" . $row->compName . "</td>".
		"<td>". $row->compDate."</td>".
		"<td>". $row->compLastDate ."</td>";

		if($row->compLastDate > $date)
			echo "<td><a href='applyOne.php?competitionId=".$row->compID."&prio=1'>Anmäl dig här</a></td>";

		elseif($row->compDate > $date)
			echo "<td><a href='applyOne.php?competitionId=".$row->compID."&prio=0'>Sen anmälan</a></td>";

		else 
			echo "<td>Too late</td>";

		echo "<td><a href='startList.php?competitionId=".$row->compID."'>Klicka här</a></td>".
		"<td><a href='resultat.php?competitionId=".$row->compID."'>Se resultat här</a></td></tr>";
	}
?>
</table>

<?php
	include "templates/footer.php";
?>