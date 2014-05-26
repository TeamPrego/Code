<!--Primary admin page-->

<?php
	// Include the header for admin-page
	include "templates/adminheader.php";
?>

<!--Header for the page-->
<h1>Bestäm nummerlapp</h1>

<!-- 	The left part of the page
			Will include opetions for the adminuser-->
<div id = "leftPartOfApplication">
	<h2>Nummerlappsinformation</h2>
	<table>
		<tr>
			<td>Välj tävling:</td> 
			<td> 
				<!--Make a dropdown-list this all competitions-->
				<select name='chooseCompetition' id='chooseCompetition'>
					<?php
						include "../class/competition.php";
						$comp = new Competition();
						$allCompetitions = getAllCompetitionsToArray();
						foreach ($allCompetitions as $competition) {
							echo "<option value='" .$competition['competitionId']. "'>" .$competition['competitionName']. "</option>";
						}					
					?>
				</select>
			</td>
		</tr>
		<tr>
			<!--If all race bib:s are in a row the admin can use this function-->
			<td>Startnummer: </td>
			<td><input id='bibBegin' name='bibBegin' value='10'></input></td>
		</tr>
	</table>
	<input type='button' name='addParticipator' id='Update' value='Uppdatera'/>

	<div>
		Lite information hur det går till..
		Vill man att tävlarna skriv in bokstäver i fälten.. dock olika bokstäver om man vill ändra många samtidigt
	</div>
</div>

<!--	This is the right part of the page
			This will contain all Participants in a competition-->
<div id = "rightPartOfApplication">
	<h2>Tävlingsdeltagare</h2>
	<div id="up" class='importantTextRed' style="margin-left:5%">
		<?php
			// If someone tried to change racebib
			if(isset($_GET['check'])) {
				// If something was wrong
				if($_GET['check'] == 0)
					echo "<div id='korv'class='importantTextRed'>Fel: Finns en eller flera med samma nummerlapp, kolla igenom så ingen deltagare har samma nummerlapp</div>";
				// If everything was correct
				else
					echo "<div id='korv'class='importantTextRed'>Ändrat</div>";
			}
		?>
	</div>
	<!--This will contain all Participants in a competition-->
	<div id="getParticipantBibDiv"></div>
</div>

<script type="text/javascript">

	//When the Update-button is clicked the DB will be updated.
	$('#Update').click(function() {
		// Get some variables
		var competitionName =  $('#chooseCompetition').find(":selected").text();
		var startNumber = $('#bibBegin').val();
		// Update database with ajax
		$.ajax({
			url: '../Ajax/ajax.php?competitionName='+competitionName+'&startNumber='+startNumber+'',
			success: function(content) {
				content = $.parseJSON(content);
				$.each(content, function(index, value) {
					if(value.check == 0)
						var string = "Ändrat";
					else {
						var string = "Nummerlappen:" + value.check + " finns redan registrerad";
					}
						console.log(string);
						document.getElementById('up').innerHTML = string;
				});
				// Trigger a change in the competition-dropdownlist
				$('#chooseCompetition').trigger("change");
			}
		});
	});
	
	//When the dropdown list with all competitions is changed
	//Update the form to the right where all participants is shown
	$('#chooseCompetition').change(function() {
		//document.getElementById('up').innerHTML ="";
		var inp = $(this).find(":selected").text();
		$.ajax({
			url: '../Ajax/ajax.php?getAllParticipantCompetition=1&competitionName='+inp+'',
			success: function(content) {
				content = $.parseJSON(content);
				var dat_string = 	'<form method="POST" id="firstForm" name="firstForm" action="../forms/changeRaceBib.php">'
				dat_string += 		'<table class ="firstTableList" cellspacing="0" cellpadding="0">';
				dat_string += 		'<tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>';
				$count = 0;
				$.each(content, function(index, value) {
					dat_string += '<tr><td><input name="'+value.participantId+'" value="'+value.bib+'" style="width: 30px">'
											+ '</input> </td><td>'+value.lName+', '+value.fName+'</td><td>'+value.club+'</td></tr>';
					$count++;
				});

				dat_string += '</table>';
				if($count === 0)
					dat_string += '<div id="noParticipants"> Inga deltagare är anmälda till denna tävlingen </div>';
				else
					dat_string += '<input type="submit" id="changeBib" value="Uppdatera"/>';				

				document.getElementById('getParticipantBibDiv').innerHTML = dat_string;
			}
		});
	});
	
	// When everything is loaded - make a trigger on a change in the competition-dropdownlist
	$('#chooseCompetition').trigger("change");
</script>

<div class=progressBar>
</div>

<?php
	// Include the footer for admins-pages.
	include "templates/adminfooter.php";
?>