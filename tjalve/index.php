
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
			<th>Anmälan</th>
			<th>Startlista</th>
			<th>Reslutatlista</th>
	</thead>	
<?php

	include "database/config.php";

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
				"<td><a href='applyOne.php?competitionId=".$row->compID."'>Anmäl dig här</a></td>".
				"<td>Länk</td>".
				"<td><a href='resultat.php?competitionId=".$row->compID."'>Se resultat här</a></td><tr>";
	}
?>
</table>

<?php
	include "templates/footer.php";
?>