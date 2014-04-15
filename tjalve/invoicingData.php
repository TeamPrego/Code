<!--Primary admin page-->
<?php
include "templates/adminheader.php";
?>
<h1>Faktureringsunderlag</h1>
<hr>

<div id="leftPartOfApplication">
	<label>Tävlingnamn:</label>
	<select id="competitionsInvoicing" autofocus>
	<!--Här slängs alla tävlingar in-->
	</select>
	<label>Klubb:</label>
	<select id="clubInvoicing">
	<!--Här slängs alla tävlingar in-->
	</select>
</div>

<div id="rightPartOfApplication">	
</div>

<div class=progressBar>
	<div class=progress>50% klart</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		$.ajax({
			url: 'Ajax/ajax.php?getAllCompetitions=1',
			success: function(content) {
				content = $.parseJSON(content);
				var string = "";
				var substring = "";
				$.each(content, function(index, value) {
					string += '<option id="'+value.competitionId+'">'+value.competitionId+' - '+value.competitionName+'</option>';
					substring = value.competitionId + ' - ' + value.competitionName;
				});
				document.getElementById('competitionsInvoicing').innerHTML = string;
				$('#competitionsInvoicing').val(substring);
				$('#competitionsInvoicing').trigger("change");
			}
		});
	});

	$('#competitionsInvoicing').change(function() {
		var competitionId = $(this).find("option:selected").attr('id');
			$.ajax({
			url: 'database/getAllClubsFromCompetitionById.php?competitionId='+competitionId,
			success: function(content) {
				content = $.parseJSON(content);
				var string ="";
				var substring = "";
				$.each(content, function(index, value) {
					string += '<option id="'+value.clubId+'">'+value.clubId+'</option>';
					substring = value.clubId;
				});
				document.getElementById('clubInvoicing').innerHTML = string;
				$('#clubInvoicing').val(substring);
				$('#clubInvoicing').trigger("change");
			}
		});
	});
	$('#clubInvoicing').change(function() {
		var clubId = $(this).find("option:selected").attr('id');
		$.ajax({
			url: 'database/getAllParticipantsFromClubByClubId.php?clubId='+clubId,
			success: function(content) {
				content = $.parseJSON(content);
				var string = "";
				var sum = 0;
				var count = 0;
				$.each(content, function(index, value) {
					if (index == 0 ) {
						string += '<div style="text-align: center">Kostander för ' + value.clubId + ' i Tävlingsnamn</div>';
						string += '<table class ="firstTableList" id="invoicingTable" cellspacing="0" cellpadding="0">';
					}
						string += '<tr><th>'+value.firstName+'</th><th>'+value.lastName+'</th><th></th><th></th></tr>'
										+ '<tr><td></td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td><td>1</td></tr>';
						sum++;
						count++;
				});
				if(count > 0) {
					string += '<td></td><td></td><td>Total Kostnad:</td><td>'+sum+'</td></table>'
					document.getElementById('rightPartOfApplication').innerHTML = string;
				}
				else
					document.getElementById('rightPartOfApplication').innerHTML = "Finns inga deltagare i tävlingen";
			}
		});
	});

</script>

<?php
include "templates/adminfooter.php";
?>