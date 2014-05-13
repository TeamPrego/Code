
<?php
	include "templates/header.php";
?>
<!-- Headning -->
<h1>Tjalve Friidrott</h1>

<!--A line-->
<hr>

<!--Make a table with all competitions-->
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
	// Set the time to Europe/Stockholm time
	date_default_timezone_set("Europe/Stockholm");
	$date = date('Y-m-d ', time());

	// Include competitionsclass to get all competitions.
	include "class/competition.php";
	$allCompetitions = getAllCompetitionsToArray();

	// For every competitions write out the informations
	foreach ($allCompetitions as $competition) {
		echo "<tr><td>" . $competition['competitionName'] . "</td>".
		"<td>". $competition['competitionDateFrom'] ." -> ".$competition['competitionDateTo']."</td>".
		"<td>". $competition['competitionLastDate'] ."</td>";
		// If the last reg-date are later. Prio sets to one
		if($competition['competitionLastDate'] > $date)
			echo "<td><a href='pagesUser/applyOne.php?competitionId=".$competition['competitionId']."&prio=1'>Anmäl dig här</a></td>";

		// If the date is between competitionsdate and last reg-date the prio sets to 0 and the participant is reg as late.
		elseif($competition['competitionDateFrom'] > $date)
			echo "<td><a href='pagesUser/applyOne.php?competitionId=".$competition['competitionId']."&prio=0'>Sen anmälan</a></td>";

		// If the competitions allready has taken place
		else 
			echo "<td>Too late</td>";

		// Link to the Startlist for this competition
		echo "<td><a href='pagesUser/startList.php?competitionId=".$competition['competitionId']."'>Klicka här</a></td>";

		// Link to the results for this competition
		echo "<td><a href='pagesUser/resultat.php?competitionId=".$competition['competitionId']."'>Se resultat här</a></td></tr>";
	}
?>
</table>

<?php
	// Include the footers for user-pages.
	include "templates/footer.php";
?>