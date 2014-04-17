<!--Primary admin page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
	include "templates/adminheader.php";
?>
<h1>Bestäm nummerlapp</h1>

<div id = "leftPartOfApplication">
	<h2>Nummerlappsinformation</h2>
	<table>
		<tr>
			<td>Välj tävling:</td> 
			<td> 
				<select name='chooseCompetition' id='chooseCompetition'>
				<?php
				include "class/competition.php";
				$comp = new Competition();
				$allCompetitions = $comp->getAllCompetitions();
				foreach ($allCompetitions as $competition) {
					echo "<option value='" .$competition['competitionId']. "'>" .$competition['competitionName']. "</option>";
				}					
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Startnummer: </td>
			<td><input id='bibBegin' name='bibBegin' value='10'></input></td>
		</tr>
	</table>
	<input type='button' name='addParticipator' id='Update' value='Uppdatera'/>
</div>

<div id = "rightPartOfApplication">
	<h2>Tävlingsdeltagare</h2>
	<div style="margin-left:5%">
		<?php
			if(isset($_GET['check'])) {
				if($_GET['check'] == 0)
					echo "<div id='noParticipants'>Fel: Finns en eller flera med samma nummerlapp, kolla igenom så ingen deltagare har samma nummerlapp</div>";
				else
					echo "<div id='noParticipants'>Ändrat</div>";
			}
		?>
	</div>
	<div id="getParticipantBibDiv"></div>
</div>

<script type="text/javascript">

	//When the Update-button is clicked the DB will be updated.
	$('#Update').click(function() {
		var competitionName =  $('#chooseCompetition').find(":selected").text();
		var startNumber = $('#bibBegin').val();
		$.ajax({
			url: 'Ajax/ajax.php?competitionName='+competitionName+'&startNumber='+startNumber+'',
			success: function(content){
				console.log("success");
				$('#chooseCompetition').trigger("change");
			}
		});
	});
	
	//When the dropdown list with all competitions is changed
	//Update the form to the right where all participants is shown
	$('#chooseCompetition').change(function() {
		var inp = $(this).find(":selected").text();
		$.ajax({
			url: 'Ajax/ajax.php?getAllParticipantCompetition=1&competitionName='+inp+'',
			success: function(content) {
				content = $.parseJSON(content);
				var dat_string = 	'<form method="POST" id="firstForm" name="firstForm" action="forms/changeRaceBib.php">'
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

	$('#chooseCompetition').trigger("change");
</script>

<div class=progressBar>
	0% klart
</div>

<?php
	include "templates/adminfooter.php";
?>