<?php
	include "templates/header.php";
?>	
<!--Headning -->
<h1> Anmälan till "tävlingsnamn" </h1>
<!--Line -->
<hr>

<!--Div for the form -->
<table class ="formDiv">
	<h2>Steg ett</h2>
	<form id="firstForm" name="firstForm" method="post" action=" "> 
		<tr>
			<td>
				<label for="select">
					Välj klubb:
				</label>
			</td>
			<td>
				<select name="chooseClub" id="chooseClub">
				<option>- Välj klubb -</option>
				<option value="Tjalve">Tjalve</option>
				<option value="Norrköping">Norrköping</option>
				<option value="Linköping">Linköping</option>
				<option value="Falköping">Falköping</option>
				</select>
				Saknas din förening? -->
			</td>
			<td>
				<div id="addTeam">+</div>
			</td>
		</tr>

		<tr>
			<td>Kontaktperson:</td>
			<td><input type="text" name="contactPerson" id="contactPerson" /></td>
		</tr>
		
		<tr>
			<td>E-mail:</td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		
		<tr>
			<td>Upprepa e-mail:	</td>
			<td><input type="text" name="repeatEmail" id="repeatEmail"/></td> 
		</tr>
		
		<tr>
			<td>Telefon:</td>
			<td><input type="text" name="telefonnumber" id="telephoneNumber"/></td>
		</tr>
		
		<tr>
			<td></td>
			<td><input type="submit" name="continues" id="continues" value="Fortsätt" /></td>
		</tr>
	</form>
</table>

<!--Div for the Infotext -->
<div class="infoText">
	<h4>Instruktion:</h4>
	<ol>
		<li class="importantText">Välj klubb och skriv in uppgifter om kontaktpersonen</li>
		<li>I nästa formulär skriver du in deltagarens namn, födelseår och huvudklass. Om det är stafett kryssa i stafettanmälan och klubbnamn går in som efternamn och du kan sedan skriva in om det är Lag 1 osv, 
			Kryssa därefter i önskade grenar och ev PB/SB, tryck på knappen "Lägg till deltagare"</li>
		<li>Skall deltagaren vara med i en gren i en annan klass, ändra klassen i klasslistan och välj grenar och tryck på knappen "Lägg till extra gren". Du ska alltså inte skriva in namnet igen.
			Skulle du råka lägga till fel gren kan du ta bort grenen i grenlistan, på det röda krysset</li>
		<li>Upprepa ovan för alla dina deltagare och klicka sedan på "Visa alla", så ser du alla dina anmälningar. Samtidigt får du också ett mail med bekräftelse på din anmälan.
	 		Alla anmälda syns direkt i startlistan så fort du gjort färdigt din anmälan. Om en deltagare inte syns har anmälan inte lyckats. Försök i första hand igen och var noga med att följa instruktionerna 
			Skulle du få några problem maila till mail@mailadress.se
			Skriv gärna ut denna instruktion och ha den till hands innan du går vidare.
			Lycka till</li>
	</ol>
</div>

<!--The Progress Bar -->
<div class=progressBar>
	0% klart
</div>
	
<?php
	include "templates/footer.php";
?>