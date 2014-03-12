<!--Granskad och godkänd 2014-03-04-->
<?php
session_start();
	include "templates/header.php";
?>	

<!--Headning -->
<h1>Anmälan till "tävlingsnamn"</h1>
<!--Line -->
<hr>
<?php
	include "database/config.php";
	$contactId = $_GET['contactId'];
	echo "contactId " . $contactId;
?>

<h2>Steg två</h2>

<!--The Form Part Two -->
<div id="leftPartOfApplication">
	<table class ="formDiv">
		<form method="post" id="firstForm" name="firstForm" action="database/addParticipant.php"> 
			<input type="hidden" value= <?php echo $_GET['contactId'] ?> name="contactId">;
			<tr>
				<td>Förnamn:</td>
				<td><input type="text" name="fName" id="firstName" required/></td>
			</tr>

			<tr>
				<td>Efternamn:</td>
				<td><input type="text" name="lName" id="lastName" required/></td>
			</tr>
			<tr>
				<td>Födelseår:</td>
				<td>
					<input type="number" name="bYear" id="yearOfBirth" min="1900" max="2050" required/>
				</td> 
			</tr>
			<tr>
				<td><label for="select">Klass:</label></td>
				<td>
					<select name="chooseClass" id="chooseClass" required>
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
	<!-- Table of which sports the competitor should participate in -->
	<div id="tableOfDisciplines">
	</div>
</div>

<!--The Informationtext -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".infoText").hide();
		//toggle the componenet with class msg_body
		jQuery(".cthrough").click(function(e) {
			e.preventDefault();
			jQuery(this).next(".infoText").slideToggle(500);
		});
	});	

	console.log($('#chooseClass'));

	$('#chooseClass').change(function() {
		var inp = $(this).find(":selected").text();
		$.ajax({
			data: {
				'name': inp
			},
			url: 'getAvailableDisciplines.php',
			success: function(content) {
				content = $.parseJSON(content);

				var dat_string = '<table><tr><th></th> <th>Gren</th> <th>Åldersklass</th> <th>PB</th> <th>SB</th> </tr>';
				$.each(content, function(index, value) {
					dat_string += 	'<tr><td><input type = "checkbox" id = "check" value="check"/></td><td>'
									 + value.gren 
									 + '</td><td>Ålderklass</td><td><input type="text" name="personBest" id="personBest"/></td>'
									 + '<td><input type="text" name="seasonBest" id="seasonBest"/></td></tr>'
				});
				dat_string += '</table>';

				document.getElementById('tableOfDisciplines').innerHTML = dat_string;
				//$('#tableOfDisciplines').html(dat_string);
			}
		});
	});

	
</script>
<a id="dropDown" href="#" class="cthrough">För hjälp, klicka här</a>
<div class="infoText">
	<ol>
		<li>
      Välj klubb och skriv in uppgifter om kontaktpersonen
    	</li>
		<li class="importantText">
      I nästa formulär skriver du in deltagarens namn, födelseår och huvudklass. Om det är stafett kryssa i stafettanmälan och klubbnamn går in som efternamn och du kan sedan skriva in om det är Lag 1 osv, 
			Kryssa därefter i önskade grenar och ev PB/SB, tryck på knappen "Lägg till deltagare"
    	</li>
		<li class="importantText">
      Skall deltagaren vara med i en gren i en annan klass, ändra klassen i klasslistan och välj grenar och tryck på knappen "Lägg till extra gren". Du ska alltså inte skriva in namnet igen.
			Skulle du råka lägga till fel gren kan du ta bort grenen i grenlistan, på det röda krysset
    	</li>
		<li class="importantText">
      Upprepa ovan för alla dina deltagare och klicka sedan på "Visa alla", så ser du alla dina anmälningar. Samtidigt får du också ett mail med bekräftelse på din anmälan.
	 		Alla anmälda syns direkt i startlistan så fort du gjort färdigt din anmälan. Om en deltagare inte syns har anmälan inte lyckats. Försök i första hand igen och var noga med att följa instruktionerna 
			Skulle du få några problem maila till mail@mailadress.se
			Skriv gärna ut denna instruktion och ha den till hands innan du går vidare.
			Lycka till
    	</li>
	</ol>
</div>

<!--The Progress Bar -->
<div class=progressBar>
	<div class=progress>50% klart</div>
</div
	
<?php
	include "templates/footer.php";
?>

