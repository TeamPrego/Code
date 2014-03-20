<?php
include "templates/adminheader.php";
?>
<div id="leftPartOfApplication">
	<h2>Välj Tävling</h2>
	<select name='chooseCompetition' id='chooseCompetition' style='textalign: center'>
	<?php
		include "database/config.php";
		$data = mysqli_query($con, 'SELECT * FROM competition');
		while($row = $data->fetch_object()) {
			echo "<option value='" .$row->compID. "'>" .$row->compName. "</option>";
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
				url: 'database/getAllParticipants.php?competitionName='+inp+'',
				success: function(content) {
					console.log(content);
					content = $.parseJSON(content);
					console.log(content);
					var dat_string = '<form method="POST" id="firstForm" name="firstForm" action="database/acceptLateReg.php">'
					dat_string += '<table class ="firstTableList">';
					dat_string += '<tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>';
					$count = 0;
					$evenOrOdd = 0;
					$.each(content, function(index, value) {
						if(value.prio == false)
						{
							if($evenOrOdd % 2 === 0)
								$which = "even";
							else
								$which = "odd"

							dat_string 	+= '<tr class="'+$which+'"><td><input type = "checkbox" name = "participant[]" value="'
													+ value.participantId+'">'
													+ '</input> </td><td>'+value.lName+', '+value.fName+'</td><td>'+value.club+'</td></tr>';
							$evenOrOdd++;
						}
						$count++;
					});
					dat_string += '</table>';
					if($count === 0)
						dat_string += '<div id="noParticipants"> Finns inga deltagare </div>';
					else if($evenOrOdd === 0)
						dat_string += '<div id="noParticipants"> Finns inga sena deltagare </div>';
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