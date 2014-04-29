<!--Primary admin page-->
<?php
include "templates/adminheader.php";
?>

<!--Heading for this pages-->
<h1>Faktureringsunderlag</h1>

<!--A Line -->
<hr>

<!-- 	This is the left part of this page
			includes a dropdownlist with all competitions -->
<div id="leftPartOfApplication">
	<label>Tävlingnamn:</label>
	<select id="competitionsInvoicing" autofocus>
	<!--All competitions will be included here-->
	</select>

	<label>Klubb:</label>
	<select id="clubInvoicing">
	<!--All clubs will be here-->
	</select>
</div>

<!--	This is the right part of the page
			This till show all participants form one club in a specifik competition choosen by the user -->
<div id="rightPartOfApplication">	
</div>

<!--Included just for now ... The page will fuck up without it-->
<div class=progressBar>
	<div class=progress>50% klart</div>
</div>

<script type="text/javascript">
// Global variable
var competitionName = "";

	// When the pages has been loaded do this
	// Load all competitions in the dropdownlist
	jQuery(document).ready(function() {
		$.ajax({
			url: 'Ajax/ajax.php?getAllCompetitions=1',
			success: function(content) {
				content = $.parseJSON(content);
				var string = "";
				var substring = "";
				$.each(content, function(index, value) {
					string += '<option id="'+value.competitionId+'"name="'+value.competitionName+'">'+value.competitionId+' - '+value.competitionName+'</option>';
					substring = value.competitionId + ' - ' + value.competitionName;
				});
				// Include the whole string in the div called competitionsInvoicing
				document.getElementById('competitionsInvoicing').innerHTML = string;
				// The last competition read from database will be chosen
				$('#competitionsInvoicing').val(substring);
				// Trigger a change in the competition downdownlist
				$('#competitionsInvoicing').trigger("change");
			}
		});
	});

	// If a change is done in the competition dorpdownlist
	$('#competitionsInvoicing').change(function() {

		// Set competitionId and competitionName
		var competitionId = $(this).find("option:selected").attr('id');
		competitionName = $(this).find("option:selected").attr('name');

			// time to get all clubs who is reg in one competition
			$.ajax({
			url: 'Ajax/ajax.php?getAllClubsFromCompetition=1&competitionId='+competitionId,
			success: function(content) {
				// parse the content
				content = $.parseJSON(content);
				// This string should contain all HTML-code which will be send to the div
				var string ="";
				$.each(content, function(index, value) {
					string += '<option id="'+value.clubId+'">'+value.clubId+' - '+ value.club +'</option>';
				});
				// Include the whole string in the div called clubInvoicing
				document.getElementById('clubInvoicing').innerHTML = string;

				// Trigger a change in the club-dropdown list
				$('#clubInvoicing').trigger("change");
			}
		});
	});

	// If the club-dropdownlist is changed
	$('#clubInvoicing').change(function() {
		// Get the clubId
		var clubId = $(this).find("option:selected").attr('id');
		// Gets all participants from one club
		$.ajax({
			url: 'Ajax/ajax.php?getAllParticipantFromClub=1&clubId='+clubId,
			success: function(content) {
				content = $.parseJSON(content);

				// This string should contain all information which should be included in a the div
				var string = "";
				// The sum of the cost for the club
				var sum = 0;
				// How many participants compeded for the club
				var count = 0;
				$.each(content, function(index, value) {
					// The first time contruct a table
					if (index == 0 ) {
						string += '<div style="text-align: center">Kostander för ' + value.clubId + ' i '+competitionName+'</div>';
						string += '<table class ="firstTableList" id="invoicingTable" cellspacing="0" cellpadding="0">';
					}
						string += '<tr><th>'+value.firstName+'</th><th>'+value.lastName+'</th><th></th><th></th></tr>'
										+ '<tr><td></td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td><td>1</td></tr>';
						// Add the sum and the count
						sum++;
						count++;
				});
				// If it exist some partcipants
				if(count > 0) {
					string += '<td></td><td></td><td>Total Kostnad:</td><td>'+sum+'</td></table>'
					document.getElementById('rightPartOfApplication').innerHTML = string;
				}
				// If no participant exists
				else
					document.getElementById('rightPartOfApplication').innerHTML = "Finns inga delagare ifrån denna klubb i tävlingen";
			}
		});
	});

</script>

<?php
	// include the footer for admin-pages
	include "templates/adminfooter.php";
?>