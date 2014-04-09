
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
		echo "<tr><td>" . $row->competitionName . "</td>".
		"<td>". $row->date."</td>".
		"<td>". $row->lastDate ."</td>";

		if($row->lastDate > $date)
			echo "<td><a href='applyOne.php?competitionId=".$row->competitionId."&prio=1'>Anmäl dig här</a></td>";

		elseif($row->date > $date)
			echo "<td><a href='applyOne.php?competitionId=".$row->competitionId."&prio=0'>Sen anmälan</a></td>";

		else 
			echo "<td>Too late</td>";

		echo "<td><a href='startList.php?competitionId=".$row->competitionId."'>Klicka här</a></td>".
		"<td><a href='resultat.php?competitionId=".$row->competitionId."'>Se resultat här</a></td></tr>";
	}
?>
</table>

<?php
	include "templates/footer.php";
?>