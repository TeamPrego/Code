<!--Primary admin page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
	include "templates/adminheader.php";
?>
<h1>Bestäm nummerlapp</h1>

<div id = "leftPartOfApplication">
	<h2>Nummerlappsinformation</h2>
	<table>
		<tr><td>Välj tävling: </td> <td>Scroll</td>
		<tr><td>Antaltävlande</td> <td>Antal</td>
		<tr><td>Startnummer: </td> <td>0</td>
		<tr><td>Slutnummer: </td> <td>Antal</td>
	</table>
</div>

<div id = "rightPartOfApplication">
	<h2>Tävlingsdeltagare</h2>
	<?php
		include "database/getAllParticipants.php";
	?>
</div>

<div class=progressBar>
	0% klart
</div>

<?php
	include "templates/adminfooter.php";
?>