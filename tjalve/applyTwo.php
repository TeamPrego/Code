
<?php
	include "templates/header.php";
?>	
<h1>Anmälan till "tävlingsnamn"</h1>
<hr>

<table class ="formDiv">
	<h2>Steg två</h2>
	<form id="firstForm" name="firstForm" method="post" action=" "> 
		<tr>
			<td>Förnamn:</td>
			<td><input type="text" name="firstName" id="firstName"/></td>
		</tr>

		<tr>
			<td>Efternamn:</td>
			<td><input type="text" name="lastName" id="lastName"/></td>
		</tr>
		
		<tr>
			<td>Födelseår:</td>
			<td>
				<input type="text" name="yearOfBirth" id="yearOfBirth"/>
			</td> 
		</tr>
		
		<tr>
			<td><label for="select">Klass:</label></td>
			
			<td>
				<select name="chooseClass" id="chooseClass">
				<option> - Välj klass - </option>
				<option value="P11"> P11 </option>
				<option value="P12"> P12 </option>
				<option value="P13"> P13 </option>
				<option value="P14"> P14 </option>
				</select>
			</td>

			<td>
				<input type="submit" name="addParticipator" id="addParticipator" value="Lägg till deltagare"/>
			</td>
		</tr>
	</form>
</table>

<div class="infoText">
	<h4>Instruktion:</h4>
	<ol>
		<li>Välj klubb och skriv in uppgifter om kontaktpersonen</li>
		<li class="importantText">I nästa formulär skriver du in deltagarens namn, födelseår och huvudklass. Om det är stafett kryssa i stafettanmälan och klubbnamn går in som efternamn och du kan sedan skriva in om det är Lag 1 osv, 
			Kryssa därefter i önskade grenar och ev PB/SB, tryck på knappen "Lägg till deltagare"</li>
		<li class="importantText">Skall deltagaren vara med i en gren i en annan klass, ändra klassen i klasslistan och välj grenar och tryck på knappen "Lägg till extra gren". Du ska alltså inte skriva in namnet igen.
			Skulle du råka lägga till fel gren kan du ta bort grenen i grenlistan, på det röda krysset</li>
		<li class="importantText">Upprepa ovan för alla dina deltagare och klicka sedan på "Visa alla", så ser du alla dina anmälningar. Samtidigt får du också ett mail med bekräftelse på din anmälan.
	 		Alla anmälda syns direkt i startlistan så fort du gjort färdigt din anmälan. Om en deltagare inte syns har anmälan inte lyckats. Försök i första hand igen och var noga med att följa instruktionerna 
			Skulle du få några problem maila till mail@mailadress.se
			Skriv gärna ut denna instruktion och ha den till hands innan du går vidare.
			Lycka till</li>
	</ol>
</div>

<div class=progressBar>
	<div class=progress>50% klart</div>
</div
	
<?php
	include "templates/footer.php";
?>