<?php
	// Include header for user-pages
	include "templates/header.php";
?>	

<!--Header for the page--> 
<h1>Startlista för 
	<?php 
		// Get the competitionName
		include "class/competition.php";
		$comp = new Competition();
		echo $comp->getCompName($_GET['competitionId']); 
	?>
</h1>

<!--This is an dropdown-list this all different classes in the competition-->
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

<!--This is an dropdown-list this all different disciplnes in the competition-->
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

<!--This div will contain the whole startlist-->
<div id="startList">
</div>

<script type="text/javascript">

// When the page has loaded everything Update!
$(document).ready( function () {
  Update();
});

// If the class-dropdownlist is changed Update!
$('#chooseClass').change(function() {
	Update();
});

// If the discipline-dropdownlist is changed Update!
$('#chooseDiscipline').change(function() {
	Update();
});

// Gets variableNamn in the URL
function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
}

// This function will display the startlist.
// The start list will look after the various parameters
function Update() {
	// Check the different variables
	var ageClass = $('#chooseClass').find(":selected").text();
	var discipline = $('#chooseDiscipline').find(":selected").text();
	var competitionId = getURLParameter("competitionId");

	// Get all infomation with Ajax
	$.ajax({
		url: 'Ajax/ajax.php?ageClass='+ageClass+'&discipline='+discipline+'&competitionId='+competitionId+'',
		success: function(content) {
			content = $.parseJSON(content);

			// This string will contain all HTML-code
			var string = 	'<table class ="firstTableList" cellspacing="0" cellpadding="0">';
			var countParticipant = 0;
			// For every Participant
			$.each(content, function(index, value) {
				var countParticipantDiscipline = 0;

				// For every discpline
				$.each(value.participants, function(ind, val) {
					// If the participant has Prio 0  he/her has reg to the competition to late and has not been accepted by admin
					if(val.prio != 0) countParticipantDiscipline++;
				});

				// If the participant has some disciplines with prio 1 or 2
				if(countParticipantDiscipline != 0) {
					string += '<tr class="spaceOver"><td style="background-color:white"></td></tr>';
					string += 	'<tr><th>'+ value.className + '</th><th> ' + value.discipline +'</th><th></th><th></th></tr><tr><th></th><th>Förnamn</th><th>Efternamn</th><th>Klubb</th></tr>';
					// Foreach discipline
					$.each(value.participants, function(ind, val) {
							string += '<tr><td></td><td>' + val.firstName + '</td><td>' + val.lastName + '</td><td>' + val.club + '</td></tr>';
							countParticipant++;
					});
				}
			});
			// If there are no participant = write out that!
			if (countParticipant == 0) string += '<tr><td class="importantTextRed"> Inga delagare anmälda till tävlingen</td></tr>'
			string += '</table>'

			// Send the whole HTML-string to the startList-div
			document.getElementById('startList').innerHTML = string;
		}
	});
}
</script>

<?php
	// Add footer for the user-pages
	include "templates/footer.php";
?>