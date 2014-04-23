<?php
	include "templates/header.php";
?>	
<h1>Startlista för 
	<?php 
		include "class/competition.php";
		$comp = new Competition();
		echo $comp->getCompName($_GET['competitionId']); 
	?>
</h1>
<label>Välj klass: </label>
<select name="chooseClass" id="chooseClass" required>
	<option value="all">Alla</option>
	<?php
		$competitionId = $_GET['competitionId'];
		$classes = getAllClassesFromCompetition($competitionId); 
		foreach ($classes as $theClass)
			echo "<option value='" .$theClass. "'>" .$theClass. "</option>";
	?>
</select>
<label>Välj gren: </label>
<select name="chooseDiscipline" id="chooseDiscipline" required>
	<option value="all">Alla</option>
	<?php
		$competitionId = $_GET['competitionId'];
		$discilines = getAllDisciplinesFromCompetition($competitionId); 
		foreach ($discilines as $theDisciline)
			echo "<option value='" .$theDisciline. "'>" .$theDisciline. "</option>";
	?>
</select>

<div id="startList">
</div>

<script type="text/javascript">
$(document).ready( function () {
  Update();
});

$('#chooseClass').change(function() {
	Update();
});

$('#chooseDiscipline').change(function() {
	Update();
});

function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
}

function Update() {
	var ageClass = $('#chooseClass').find(":selected").text();
	var discipline = $('#chooseDiscipline').find(":selected").text();
	var competitionId = getURLParameter("competitionId");
	$.ajax({
		url: 'Ajax/ajax.php?ageClass='+ageClass+'&discipline='+discipline+'&competitionId='+competitionId+'',
		success: function(content) {
			content = $.parseJSON(content);
			var dat_string = 	'<table class ="firstTableList" cellspacing="0" cellpadding="0">';
			var countParticipant = 0;
			$.each(content, function(index, value) {
				var countParticipantDiscipline = 0;
				$.each(value.participants, function(ind, val) {
					countParticipantDiscipline++;
					if(val.prio == 0)	countParticipantDiscipline--; 
				});
				if(countParticipantDiscipline != 0) {
					dat_string += '<tr class="spaceOver"><td style="background-color:white"></td></tr>';
					dat_string += 	'<tr><th>'+ value.className + '</th><th> ' + value.discipline +'</th><th></th><th></th></tr><tr><th></th><th>Förnamn</th><th>Efternamn</th><th>Klubb</th></tr>';
					$.each(value.participants, function(ind, val) {
							dat_string += '<tr><td></td><td>' + val.firstName + '</td><td>' + val.lastName + '</td><td>' + val.club + '</td></tr>';
							countParticipant++;
					});
				}
			});
			if (countParticipant == 0) dat_string += '<tr><td class="importantTextRed"> Inga delagare anmälda till tävlingen</td></tr>'
			dat_string += '</table>'
			document.getElementById('startList').innerHTML = dat_string;
		}
	});
}
</script>

<?php
	include "templates/footer.php";
?>