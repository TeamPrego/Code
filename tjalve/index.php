
<?php
	include "templates/header.php";
?>
<!--Granskad och godkänd 2014-03-04-->	
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
	
	<tbody>
		<tr class="even">
			<td> Tjalvesupertävling </td>
			<td><a href="applyOne.php"> Anmäl här </a></td>
			<td> Yesbox </td>
			<td> <a href="resultat.php"> Fetaste Resultatlistan </td>
		</tr>

		<tr class="odd">
			<td>Hannes-super-tävling</td>
			<td>Yesbox</td>
			<td>Ligger ej uppe</td>
			<td>Ligger ej uppe</td>
		</tr>
	</tbody>
</table>

<?php
	include "templates/footer.php";
?>