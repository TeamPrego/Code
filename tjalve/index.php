
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
	date_default_timezone_set("Europe/Stockholm");
	$date = date('Y-m-d ', time());
	echo "The current time is: " . $date;

	include "class/competition.php";
	$comp = new Competition();
	$allCompetitions = $comp->getAllCompetitions();

	foreach ($allCompetitions as $competition) {
		echo "<tr><td>" . $competition->name . "</td>".
		"<td>". $competition->date ."</td>".
		"<td>". $competition->lastDate ."</td>";
		if($competition->lastDate > $date)
			echo "<td><a href='applyOne.php?competitionId=".$competition->id."&prio=1'>Anmäl dig här</a></td>";

		elseif($competition->date > $date)
			echo "<td><a href='applyOne.php?competitionId=".$competition->id."&prio=0'>Sen anmälan</a></td>";

		else 
			echo "<td>Too late</td>";

		echo "<td><a href='startList.php?competitionId=".$competition->id."'>Klicka här</a></td>".
		"<td><a href='resultat.php?competitionId=".$competition->id."'>Se resultat här</a></td></tr>";
	}
?>
</table>

<?php
	include "templates/footer.php";
?>