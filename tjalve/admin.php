<!--Primary admin page-->

<?php
include "templates/adminheader.php";
?>

<table class ="adminTable">
	<thead>
		<tr>
			<th>Tävling</th>
			<th>Tävlande</th>
			<th>Fakturering</th>
    </tr>
		
		<tr>
			<td><button class="button">Skapa</button></td>
			<td><button class="button">Ändra</button></td>
			<td><button class="button">Fakturera</button></td>
		</tr>
		
		<tr>
			<td><button class="button">Ändra</button></td>
			<td><button class="button">Sen anmälan</button></td>
		</tr>
		
		<tr>
			<td><button class="button">Resultat</button></td>
			<td><button class="button">Tävlingsnummer</button></td>
		</tr>
		
		<tr>
			<td><button class="button">Utskrift</button></td>
		</tr>
	</thead>
</table>

<?php
include "templates/adminfooter.php";
?>