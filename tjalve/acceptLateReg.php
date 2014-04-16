<?php
include "templates/adminheader.php";
?>
<div id="leftPartOfApplication">
	<h2>Välj Tävling</h2>
	<select name='chooseCompetition' id='chooseCompetition' style='textalign: center'>
	<?php
		include "class/competition.php";
		$comp = new Competition();
		$allCompetitions = $comp->getAllCompetitions();
		foreach ($allCompetitions as $competition) {
			echo "<option value='" .$competition['competitionId']. "'>" .$competition['competitionName']. "</option>";
		}					
	?>
	</select>
</div>
<div id="rightPartOfApplication">
	<h2>Sena registreringar</h2>
	<div id="lateRegistration">
	</div>
</div>
<script type="text/javascript">
	$('#chooseCompetition').change(function() {
			var inp = $(this).find(":selected").text();
			$.ajax({
				url: 'Ajax/ajax.php?getAllParticipantAndDesciplinesFromCompetition=1&competitionName='+inp+'',
				success: function(content) {
					console.log(content);
					content = $.parseJSON(content);
					console.log(content);
					var count = 0;
					var dat_string = '<form method="POST" id="firstForm" name="firstForm" action="database/acceptLateReg.php">'
					dat_string += '<table class ="firstTableList" cellspacing="0" cellpadding="0">';
					dat_string += '<tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>';
					$.each(content, function(index, value) {
						if(value.prio == 0) {
							count ++;
						 	dat_string += '<tr><td><input type = "checkbox" name = "participant[]" value="'+ value.pIndex+'"></input>'
							+ ' </td><td>'+value.lName+', '+value.fName+'</td><td>'+value.club+'</td></tr>'
							+ '<tr><td></td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td></tr>';
						}
					});
					dat_string += '</table>';
					if(!count)
						dat_string += '<div class="importantTextRed" style="margin-left: 5%">Inga sena anmälningar ännu</div>';
					else
						dat_string += '<input type="submit" id="changeBib" value="Uppdatera"/>';				

					document.getElementById('lateRegistration').innerHTML = dat_string;
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