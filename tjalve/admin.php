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
			<td>
        <form method="LINK" ACTION="createCompetition.php">
          <button class="button">Skapa</button>
        </form>
      </td>
			<td><a href="editParticipants.php"><button class="button">Ändra</button></a></td>
			<td><button class="button">Fakturera</button></td>
		</tr>
    
		<tr>
			<td><button class="button">Ändra</button></td>
			<td><a href="acceptLateReg.php"><button class="button">Sen anmälan</button></a></td>
		</tr>
		
		<tr>
			<td><button class="button">Resultat</button></td>
			<td><a href="setRaceBib.php"><button class="button">Tävlingsnummer</button></a></td>
		</tr>
		
		<tr>
			<td><button class="button">Utskrift</button></td>
		</tr>
	</thead>
</table>

<?php
include "templates/adminfooter.php";
?>