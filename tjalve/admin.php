<!--Primary admin page-->
<!--Granskad och godkänd 2014-03-04-->
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
			<td>
        <form method="LINK" ACTION="createCompetition.php">
          <button class="button">Skapa</button>
        </form>
      </td>
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