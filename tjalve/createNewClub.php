<?php
	include "templates/header.php";
?>	

<!--Headning -->
<h1>Lägg till ny klubb</h1>
<!--Line -->
<hr>
<table id="createNewClubForm">
	<form method="post" action="database/addNewClubToDatabase.php">
		<tr>
			<td>
				Klubb:
			</td>
			<td>
				<input type="text" name="newClub" id="newClub" placeholder="Klubbnamn" required></input>
			</td>
		</tr>
		<tr>
			<td>
				Telefon: 
			</td>
			<td>
				<input type="text" name="newClubNumber" id="newClubNumber" placeholder="07x-xxx xxx xx"></input>
			</td>
		</tr>
		<tr>
			<td>
				Adress: 
			</td>
			<td>
				<input type="text" name="newClubAdress" id="newClubAdress"></input>
			</td>
		</tr>
		<tr>
			<td>
				Postadress: 
			</td>
			<td>
				<input type="text" name="newClubZipAdress" id="newClubZipAdress"></input>
			</td>
		</tr>
		<tr>
			<td>
				Email: 
			</td>
			<td>
				<input type="email" name="newClubEmail" id="newClubEmail"></input>
			</td>
			<td>
				<input type="submit" name="submitNewClub" id="submitNewClub" value="Lägg till klubb"/>
			</td>
		</tr>
	</form>	
</table>
<?php
	include "templates/footer.php";
?>