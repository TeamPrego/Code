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
          <a href="createCompetition.php"><button class="button">Skapa</button></a>
      </td>
			<td><a href="editParticipants.php"><button class="button">Ändra</button></a></td>
			<td><a href=""><button class="button">Fakturera</button></a></td>
		</tr>
    
		<tr>
			<td><a href=""><button class="button">Ändra</button></a></td>
			<td><a href="acceptLateReg.php"><button class="button">Sen anmälan</button></a></td>
		</tr>
		
		<tr>
			<td><a href=""><button class="button">Resultat</button></a></td>
			<td><a href="setRaceBib.php"><button class="button">Tävlingsnummer</button></a></td>
		</tr>
		
		<tr>
			<td><a href=""><button class="button">Utskrift</button></a></td>
		</tr>
	</thead>
</table>

<?php
include "templates/adminfooter.php";
?>