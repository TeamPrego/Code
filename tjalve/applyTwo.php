<!--Granskad och godkänd 2014-03-04-->
<?php
session_start();
	include "templates/header.php";
?>	

<!--Headning -->
<h1>Anmälan till "tävlingsnamn"</h1>
<!--Line -->
<hr>

<!--The Form Part Two -->
<div id="leftPartOfApplication">
	<h2>Skriv in deltagarinformation</h2>
	<form method="post" id="firstForm" name="firstForm" action="database/addParticipant.php"> 
		<table id ="formDiv">
			<input type="hidden" value= <?php echo $_GET['contactId'] ?> name="contactId">
			<input type="hidden" value= <?php echo $_GET['prio'] ?> name="prio">
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
						<?php
							include "database/config.php";
							$getCompId = mysqli_query($con, "SELECT * FROM contact WHERE contactId = '$_GET[contactId]'");
							$competitionId = $getCompId->fetch_object()->competitionId;
							$data = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId= '$competitionId'");
							$array=[];
							while($row = $data->fetch_object()) {
								if(!in_array($row->yearClass, $array)) {
									array_push($array, $row->yearClass);
									echo "<option value='" .$row->yearClass. "'>" .$row->yearClass. "</option>";
								}
							}
						?>
					</select>
				</td>
			</tr>
		</table>
		<div id="disciplines">
		</form>
		</div>
</div>

<!--The Informationtext -->
<script type="text/javascript">

jQuery(document).ready(function() {
	jQuery("#infoText").hide();
	//toggle the componenet with class msg_body
	jQuery(".cthrough").click(function(e) {
		e.preventDefault();
		jQuery(this).next("#infoText").slideToggle(500);
		if(document.getElementById('dropDown').innerHTML == "För hjälp, klicka här")
			document.getElementById('dropDown').innerHTML = "För att ta bort info, klicka här";
		else
			document.getElementById('dropDown').innerHTML = "För hjälp, klicka här";
	});
});	
console.log($('#chooseClass'));

$('#chooseClass').change(function() {
	var inp = $(this).find(":selected").text();
	var contactId = getURLParameter('contactId');
	console.log(inp);
	$.ajax({
		url: 'getAvailableDisciplines.php?class='+inp+'&contactId='+contactId,
		success: function(content) {
			console.log(content);
			content = $.parseJSON(content);
			var dat_string = '<table id="whichDisciplines">';
			dat_string += '<tr><td></td> <th>Gren</th> <th>Åldersklass</th> <th>PB</th> <th>SB</th> </tr>';
			$.each(content, function(index, value) {
				dat_string += 	'<tr><td><input type = "checkbox" name = "gren[]" value="'+value.gren+'"/></td><td>'
								 + value.gren
								 + '</td><td>'+inp+'</td><td>'
								 + '<input type="text" name="PB'+value.gren+'" id="personBest"/></td>'
								 + '<td><input type="text" name="SB'+value.gren+'" id="seasonBest"/></td></tr>'
			});
			dat_string += '</table>';
			dat_string += '<input type="submit" name="addParticipator" id="addParticipator" value="Lägg till deltagare"/></form>';

			document.getElementById('disciplines').innerHTML = dat_string;
		}
	});
});

function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
}

jQuery(document).ready(function() {
	var inp = getURLParameter("contactId");
	console.log(inp);
	$.ajax({
		url: 'database/findParticipants.php?contactId='+inp+'',
		success: function(content) {
			console.log(content);
			content = $.parseJSON(content);
			var dat_string = "";
			$.each(content, function(index, value) {
				dat_string += '<div id="confirmedParticipantOneEach"><table id="confirmedParticipantTable"><tr><td>Namn</td>';
				dat_string += '<td>' + value.lastName + ', ' + value.firstName + '</td></tr>';
				$.each(value.disciplines, function(ind, val) {	
					dat_string += '<td></td><td>' + val.ageClass + '</td><td>' + val.discipline + '</td></tr>';
				});
				dat_string += '<td><a href="database/deleteParticipants.php?participantId=' + value.participantId + '&prio=' + value.prio + '"><button id="deleteButton">Radera</button></a></td>'
										+ '<td><button class="showButton" name="addClass" onclick="enableFunc()">Lägg till klass</button></td></tr>'
										+ '<tr><td><button class="hideButton" name="here" onclick=enableFunc()>Här</button></td></tr></table></div>';
			});		
			document.getElementById('confirmedDiv').innerHTML = dat_string;	
		}
	});
});
function enableFunc() {
		//jQuery("#showButton").hide();
		var a =  document.getElementsByName("addClass")[0];
		a.className = "hideButton";
		var b =  document.getElementsByName("here")[0];
		b.className = "showButton";

		//document.getElementsByClassName("hideButton")[0] = "showButton";
	}
</script>
<div id="rightPartOfApplication">
	<h2>Dina anmälda tävlande</h2>
	<div id="confirmedDiv">
		<?php
		//include "database/findParticipants.php";
		?>
	</div>
	<a id="dropDown" href="#" class="cthrough">För hjälp, klicka här</a>
	<div id="infoText">
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
</div>

<!--The Progress Bar -->
<div class=progressBar>
	<div class=progress>50% klart</div>
</div
	
<?php
	include "templates/footer.php";
?>

