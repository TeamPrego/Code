<?php
// Include our adminheader
include "templates/adminheader.php";
?>

<!--	This is the left part of this page.
			Here will admin choose which competition to look at
-->
<div id="leftPartOfApplication">
	<h2>Välj Tävling</h2>

	<!--A scrolldownnlist with all competitons -->
	<select name='chooseCompetition' id='chooseCompetition' style='textalign: center'>
	<?php
		include "../class/competition.php";
		$allCompetitions = getAllCompetitionsToArray();
		$lastClub = "";
		foreach ($allCompetitions as $competition) {
			echo "<option value='" .$competition['competitionId']. "'>" .$competition['competitionName']. "</option>";

		}					
	?>
	</select>
</div>

<!--	This is the right part of this page.
			After the admin choose a competition the information will be shown here
-->
<div id="rightPartOfApplication">
	<h2>Sena registreringar</h2>
	<div id="lateRegistration">
	</div>
</div>

<!--All the scprit for this page -->
<script type="text/javascript">

	//When the scrolldown list is changed 
	//This scrpit will make an form with all late reg. partiipant in one competition
	$('#chooseCompetition').change(function() {
			var inp = $(this).find(":selected").text();
			$.ajax({
				url: '../Ajax/ajax.php?getAllParticipantAndDisciplinesFromCompetition=1&competitionName='+inp,
				success: function(content) {
					content = $.parseJSON(content);
					var count = 0;
					var theString= '<form method="POST" id="firstForm" name="firstForm" action="../forms/acceptLateReg.php">'
					theString += '<table class ="firstTableList" cellspacing="0" cellpadding="0">';
					theString += '<tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>';
					$.each(content, function(index, value) {
						if(value.prio == 0) {
							count ++;
						 	theString += '<tr><td><input type = "checkbox" name = "participant[]" value="'+ value.pIndex+'"></input>'
							+ ' </td><td>'+value.lName+', '+value.fName+'</td><td>'+value.club+'</td></tr>'
							+ '<tr><td></td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td></tr>';
						}
					});
					theString += '</table>';

					//If non participant has reg late
					if(!count)
						theString += '<div class="importantTextRed" style="margin-left: 5%">Inga sena anmälningar ännu</div>';
					//
					else
						theString += '<input type="submit" id="changeBib" value="Uppdatera"/>';				

					//Add theString to the div named lateReistretion - placed in the rightpartoftheapplication.
					document.getElementById('lateRegistration').innerHTML = theString;
				}
			});
		});

	//When the page are loaded - trigger a change in the scrolldownlist so information will be shown.
	$('#chooseCompetition').trigger("change");

	chooseCompetition.SelectedIndex = chooseCompetition.Items.Count-1;

</script>

<!--This is just temporary ... -->
<div class=progressBar>
	0% klart
</div>
<?php
//include our adminfooter
include "templates/adminfooter.php";
?>