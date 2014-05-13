<!--Granskad och godkänd 2014-03-04-->
<?php
session_start();
	include "templates/header.php";
?>	

<!--Headning -->
<h1>Anmälan till
	<?php
		include "../class/competition.php";
		$comp = new Competition();
		echo $comp->getCompNameByContactId($_GET['contactId']);
	?>
</h1>
<!--Line -->
<hr>

<!--The Form Part Two -->
<div id="leftPartOfApplication">
	<h2>Skriv in deltagarinformation</h2>
	<form method="post" id="firstForm" name="firstForm" action="../forms/addParticipant.php"> 
		<table id ="formDiv">
			<input type="hidden" value= <?php echo $_GET['contactId'] ?> name="contactId">
			<input type="hidden" value= <?php echo $_GET['prio'] ?> name="prio">
			<input type="hidden" value="" name="participantId" id="participantId">
			<tr>
				<td>Förnamn:</td>
				<td><input type="text" name="fName" id="firstName" required/></td>
				<td><input type="button" class="hideButton" name="addNewParticipant" value="Lägg till ny deltagare"/></td>
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
								$competitionId = getCompetitionIdFromContactId($_GET['contactId']);
								$classes = getAllClassesFromCompetition($competitionId); 
								foreach ($classes as $theClass) {
									echo "<option value='" .$theClass. "'>" .$theClass. "</option>";
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

$('#chooseClass').change(function() {
	var inp = $(this).find(":selected").text();
	if(inp === " - Välj klass - ") {
		document.getElementById('disciplines').innerHTML ="";
	}
	else {
		var contactId = getURLParameter('contactId');
		console.log(inp);
		$.ajax({
			url: '../Ajax/ajax.php?getAvalibleDisciplinesFromYearclassInCompetition=1&class='+inp+'&contactId='+contactId,
			success: function(content) {
				console.log(content);
				content = $.parseJSON(content);
				var dat_string = '<table id="whichDisciplines">';
				dat_string += '<tr><td></td> <th>Gren</th> <th>Åldersklass</th> <th>PB</th> <th>SB</th> </tr>';
				$.each(content, function(index, value) {
					dat_string += 	'<tr><td><input type = "checkbox" name="competitionDisciplineId[]" value="'+value.competitionDisciplineId+'"/></td><td>'
									 + value.discipline
									 + '</td><td>'+inp+'</td><td>'
									 + '<input type="text" name="PB'+value.competitionDisciplineId+'" id="personBest"/></td>'
									 + '<td><input type="text" name="SB'+value.competitionDisciplineId+'" id="seasonBest"/></td></tr>'
				});
				dat_string += '</table>';
				dat_string += '<input type="submit" name="addParticipator" id="addParticipator" value="Lägg till deltagare"/></form>';

				document.getElementById('disciplines').innerHTML = dat_string;
			}
		});
	}
});

function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
}

var count = 0;

jQuery(document).ready(function() {
	var contactId = getURLParameter("contactId");
	participantId.value = "";
	$.ajax({
		url: '../Ajax/ajax.php?getAllParticipantsAndDisciplinesFromContactId=1&contactId='+contactId+'',
		success: function(content) {
			content = $.parseJSON(content);
			var string = "";
			var prio;
			count = 0;
			$.each(content, function(index, value) {
				string += '<div id="confirmedParticipantOneEach"><table id="confirmedParticipantTable" cellspacing="0">';
				string += '<tr><th>' + value.lastName + ', ' + value.firstName + '</th><th>Född: '+value.birthYear+'</th><th>SB</th><th>PB</th></tr>';
				$.each(value.disciplines, function(ind, val) {	
					string += '<td>' + val.yearClass + '</td><td>' + val.discipline + '</td><td>' + val.SB + '</td><td>' + val.PB + '</td></tr>';
					prio = val.prio;
				});
				var fName = value.firstName;
				var lName = value.lastName;
				var pId = value.participantId;
				var bY = value.birthYear;

				string += '<td></td>'
										+ '<td><button class="showButton" name="addClass" onclick=enableFunc("'+pId+'","'+fName+'","'+lName+'",'+count+',"'+bY+'")>Lägg till klass</button>'
										+ '<div class="hideButton" name="infoAddClass"><div id="noParticipants">Lägg till gren till vänster</div></div></td><td></td>'
										+ '<td><a href="../database/deleteParticipants.php?participantId=' + value.participantId + '&prio=' + prio + '"><button>Radera</button></a></td></table></div>';
				count = count + 1;
			});		
			document.getElementById('confirmedDiv').innerHTML = string;	
		}
	});
});

$('input[name="addNewParticipant"]').click(function(){
	for (var i=0;i<count;i++) {
		console.log(i);
		var a =  document.getElementsByName("addClass")[i];
		a.className = "showButton";
		var b =  document.getElementsByName("infoAddClass")[i];
		b.className = "hideButton";
	}

	var c =  document.getElementsByName("addNewParticipant")[0];
	c.className = "hideButton";

	var firstName = document.getElementById("firstName");
	firstName.value = "";
	firstName.disabled = false;
	var lastName = document.getElementById("lastName");
	lastName.value = "";
	lastName.disabled = false;
	var yearOfBirth = document.getElementById("yearOfBirth");
	yearOfBirth.value = "";
	yearOfBirth.disabled = false;
	var participantId = document.getElementById("participantId");
	participantId.value = "";
	
	$("select option").filter(function() {
    return $(this).text() == " - Välj klass - "; 
	}).prop('selected', true);

	$('#chooseClass').trigger("change");
});

function enableFunc(Id, fName, lName, counter, birthYear) {
		for (var i=0;i<count;i++) {
			var a =  document.getElementsByName("addClass")[i];
			a.className = "showButton";
			var b =  document.getElementsByName("infoAddClass")[i];
			b.className = "hideButton";
		}
		
		var a =  document.getElementsByName("addClass")[counter];
		a.className = "hideButton";
		var b =  document.getElementsByName("infoAddClass")[counter];
		b.className = "showButton";
		var c =  document.getElementsByName("addNewParticipant")[0];
		c.className = "showButton";

		var firstName = document.getElementById("firstName");
		firstName.value = fName;
		firstName.disabled = true;
		var lastName = document.getElementById("lastName");
		lastName.value = lName;
		lastName.disabled = true;
		var yearOfBirth = document.getElementById("yearOfBirth");
		yearOfBirth.value = birthYear;
		yearOfBirth.disabled = true;
		var participantId = document.getElementById("participantId");
		participantId.value = Id;

		console.log(participantId.value);
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

